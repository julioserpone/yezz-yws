<?php

return [

    /*
    |-------------------------------------------------------------------------
    | Customs Messages
    |-------------------------------------------------------------------------
     */
    'insufficient_role'     => 'Usted no tiene el role necesario para acceder al módulo solicitado',
    'credentials_invalid' => 'Las credenciales proporcionadas no son válidas',
    'client_registered' => 'Hola. te damos la más cordial bienvenida a nuestro sistema para la Gestión de Garantias YWS. Te invitamos a que gestiones tus requerimientos a traves de este sistema.',
    'errors' => [
        'globals'       => [
            'request_invalid'       => 'La solicitud enviada no es válida',
            'not_section_allow'       => 'No se le permite entrar en esta sección',
            'file_upload_error'     => 'No se pudo enviar el archivo adjunto al servidor de la aplicacion',
            'file_maxsize_error'    => 'El tamaño maximo del archivo debe ser de :MaxFilesize bytes',
        ],
        'users'         => [
            'insufficient_role'     => 'No tienes el role necesario para acceder al módulo solicitado',
        ],
        'brands'        => [
            'brand_already_exist'   => 'La Marca que intentas registrar ya existe',
            'brand_not_exist'       => 'La Marca que intentas editar no existe',
        ],
        'failures'        => [
            'failure_already_exist'   => 'La Falla que intentas registrar ya existe',
            'failure_not_exist'       => 'La Falla que intentas editar no existe',
        ],
        'families'      => [
            'family_already_exist'   => 'La Familia que intentas registrar ya existe',
            'family_not_exist'       => 'La Familia que intentas editar no existe',
        ],
        'producttypes'  => [
            'producttype_already_exist'   => 'El Tipo de Producto que intentas registrar ya existe',
            'producttype_not_exist'       => 'El Tipo de Producto que intentas editar no existe',
        ],
        'scales'  => [
            'scale_already_exist'   => 'La Gamma que intentas registrar ya existe',
            'scale_not_exist'       => 'La Gamma que intentas editar no existe',
        ],
        'products'  => [
            'product_already_exist'   => 'El Producto que intentas registrar ya existe',
            'product_not_exist'       => 'El Producto que intentas editar no existe',
        ],
        'routes'   => [
            'route_already_exist'   => 'La Ruta que intentas registrar ya existe',
            'route_not_exist'       => 'La Ruta que intentas editar no existe',
        ],
        'technologies'  => [
            'technology_already_exist'   => 'La Tecnología que intentas registrar ya existe',
            'technology_not_exist'       => 'La Tecnología que intentas editar no existe',
        ],
        'countries'  => [
            'country_already_exist'   => 'El País que intentas registrar ya existe',
            'country_not_exist'       => 'El País que intentas editar no existe',
        ],
        'provinces'  => [
            'province_already_exist'   => 'La Provincia que intentas registrar ya existe',
            'province_not_exist'       => 'La Provincia que intentas editar no existe',
        ],
        'cities'  => [
            'city_already_exist'   => 'La Ciudad que intentas registrar ya existe',
            'city_not_exist'       => 'La Ciudad que intentas editar no existe',
        ],
        'couriers'   => [
            'courier_already_exist'   => 'El Courier que intentas registrar ya existe',
            'courier_not_exist'       => 'El Courier que intentas editar no existe',
        ],
        'chains'  => [
            'chain_already_exist'   => 'La Cadena que intentas registrar ya existe',
            'chain_not_exist'       => 'La Cadena que intentas editar no existe',
        ],
        'states'  => [
            'state_already_exist'   => 'El Estado que intentas registrar ya existe',
            'state_not_exist'       => 'El Estado que intentas editar no existe',
        ],
        'colors'  => [
            'color_already_exist'   => 'El Color que intentas registrar ya existe',
            'color_not_exist'       => 'El Color que intentas editar no existe',
        ],
        'workshops'  => [
            'workshop_already_exist'   => 'El Taller que intentas registrar ya existe',
            'workshop_not_exist'       => 'El Taller que intentas editar no existe',
        ],
        'users'  => [
            'user_already_exist'   => 'El Usuario que intentas registrar ya existe',
            'user_not_exist'       => 'El Usuario que intentas editar no existe',
        ],
        'clients'  => [
            'client_already_exist'   => 'El Cliente que intentas registrar ya existe',
            'client_not_exist'       => 'El Cliente que intentas editar no existe',
            'client_same_attribute'  => 'Existen otros clientes con poseen los mismos atributos, como identificacion, primer nombre, o descripcion de empresa. Intente ser mas especifico con la informacion solicitada',
        ],
        'orders' => [
            'not_process_order' => 'Hubo errores de procesamiento de la orden. Por favor, póngase en contacto con el administrador del sistema',
            'order_not_exist'   => 'La Orden que intentas registrar no existe',
            'order_not_can_modify' => 'Solo las Ordenes con estatus ISSUED CASE pueden ser modificadas',
            'imei_in_use'  => 'El IMEI que intenta registrar ya se encuentra en uso en una order con estatus CASO EMITIDO',
        ],
    ],
];
