<?php

/**
 * Akkar Global Services - Products Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 24 - 2016)
 */

use App\Product;
use App\ProductType;
use App\Brand;
use App\Technology;
use App\Scale;
use App\Family;
use App\Color;
use App\Helpers\DinamicsGP;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
      public function run()
      {

      $products = DinamicsGP::getListProducts(false);
      $colors = Color::all();
      $regex = trans('products.regex_colors');

      foreach ($products as $product) {
            $color = '';  
            //Busqueda de color, segun lo suministrado por GP                
            foreach ($regex as $key => $value) {
                  $find = stripos($product['Descripcion'], $key);
                  if ($find !== false) {
                        $color = $value;
                        break;
                  }
            }

            Product::create([
                  'producttype_id' => ProductType::where('description',$product['Clase'])->first()->id,
                  'family_id' => Family::where('description','')->first()->id,
                  'brand_id' => Brand::where('description',$product['Marca'])->first()->id,
                  'technology_id' => Technology::where('description','')->first()->id,
                  'scale_id' => Scale::where('description','MEDIUM')->first()->id,
                  'color_id' => Color::where('description',($color)?:'BLACK')->first()->id,
                  'code' => $product['Codigo'],
                  'model' => $product['Modelo'],
                  'part_number' => $product['NumerodeParte'],
                  'description' => $product['Descripcion'],
            ]);

        } //foreach
      }
}
