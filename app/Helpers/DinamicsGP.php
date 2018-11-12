<?php namespace app\Helpers;

/**
 * Akkar Global Services - Dinamics GP Functions Helper
 *
 * CONFIGURACION DE SQL SERVER EN LINUX (VM Homestead)
 *   1) Iniciar vagrant (vagrant up)
 *   2) conectarse a la consola mediante ssh con el comando "vm". Primero debes configurar el comando vm con esto
 *   -> alias vm="ssh vagrant@127.0.0.1 -p 2222"
 *   3) ejecutar comando vm
 *   4) para estar seguro que los repositorios estan actualizados, ejecutar "sudo apt-get update"
 *   5) luego, ejecutar "sudo apt-get install php7.2-sybase"
 *   6) ejecutar comando "php -m" para crear pdo_dblib
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 * 
 */
use App\Product;

class DinamicsGP {
  /**
   * get data by IMEI CODE
   * @return [json | null]
   *
   * @author  Julio Hernandez <juliohernandezs@gmail.com>
   */
  public static function getDataByImei($serial, $json = true) {

		try 
    {
      $data = null;
      if ($serial) {
        $db_ext = \DB::connection('sqlsrv');
      	$sql = "exec GA_FindSopSerialNumberPostVenta '$serial';";
        $result = $db_ext->select($sql);
        //Trim Result
        if (!$result) {
          //Search in Techland
          $db_ext = \DB::connection('sqlsrv_techland');
          $result = $db_ext->select($sql);
          if (!$result) {
            $data["ERROR"] = trans("globals.imei_not_registered_dinamicsgp");
          }
        } else {
          $data = self::trim_array($result[0]);
          $data['product_data'] = Product::where('code', $data['ITEMNMBR'])->first();
        }
      }
      else {
        $data["ERROR"] = trans("globals.imei_is_not_blank");
      }
      
      return ($json)?json_encode($data):$data;
		} 
    catch (\Illuminate\Database\QueryException $e) {
      $data["ERROR"] = $e->getMessage();
      return ($json)?json_encode($data):$data;
    }
  }

  /**
   * get lists Products
   * @return json or array
   *
   * @author  Julio Hernandez <juliohernandezs@gmail.com>
   */
  public static function getListProducts($json = true, $instance = 'akkarg') {

    try {

      $data = null;
      $server = ($instance=='akkarg') ? 'sqlsrv' : 'sqlsrv_techland';
      $db_ext = \DB::connection($server);
      $sql = "select * from ConsultaArticuloPostVenta;";
      $result = $db_ext->select($sql);
      //Trim Result
      if (!$result) $data["ERROR"] = trans("globals.not_data_products_dinamicsgp");
      else $data = self::trim_array($result);
      
      return ($json)?json_encode($data):$data;

    } catch (ModelNotFoundException $e) {
      throw new NotFoundHttpException();
    }
  }

  /**
   * get lists items inventory by Warehouse and Instance (Akkarg USA01 or Techland USA6)
   * @return json or array
   *
   * @author  Julio Hernandez <juliohernandezs@gmail.com>
   */
  public static function getProductsByWarehouse($location = 'GSWAP', $instance = 'akkarg', $json = true) {

    try 
    {
      $data = null;
      $server = ($instance=='akkarg') ? 'sqlsrv' : 'sqlsrv_techland';
      $db_ext = \DB::connection($server);
      $sql = "exec GA_Products_GetListAllByWarehouse '$location';";
      $result = $db_ext->select($sql);
      //Trim Result
      if (!$result) $data["ERROR"] = trans("globals.not_data_products_dinamicsgp");
      else $data = self::trim_array($result);
      return ($json)?json_encode($data):$data;
    } 
    catch (\Illuminate\Database\QueryException $e) {
      $data["ERROR"] = $e->getMessage();
      return ($json)?json_encode($data):$data;
    }
  }

  public static function trim_array(&$data)
  {
      $trimmed_array = [];
      if ($data) {
        foreach ($data as $key => $value) {
          if (!is_string($value)) {
            $array_temp_trimmed = [];
            foreach ($value as $field => $text) {
              $array_temp_trimmed[$field] = trim(utf8_encode($text));
            }
            $trimmed_array[$key] = $array_temp_trimmed;
            unset($array_temp_trimmed);
          } else {
            $trimmed_array[$key] = trim(utf8_encode($value)); //Se debe aplicar el utf8 porque si guardo letras acentuadas, por algun motivo la conversion a json se daña, agregando una letra fuera de la cadena de texto, Ejem: b"TELECOMUNICACION"
          }
        }
      }
      
      return $trimmed_array;
  }
}
