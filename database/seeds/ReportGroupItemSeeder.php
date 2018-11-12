<?php

use Illuminate\Database\Seeder;
use App\ReportGroup;
use App\ReportGroupItem;
class ReportGroupItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ["report_group_id"=> 1,
             "code" => "order_number as Order_Number", 
             "name_es" => "Número de Orden", 
             "name_en" => "Order Number",
             "order"   => 1
            ],
            ["report_group_id"=> 1,
             "code"    => "countries.description as Country", 
             "name_es" => "País", 
             "name_en" => "Country",
             "order"   => 2
            ],
             ["report_group_id"=> 1,
             "code"    => "workshops.description as Workshop", 
             "name_es" => "Taller", 
             "name_en" => "Workshop",
             "order"   => 3
            ],
            ["report_group_id"=> 1,
             "code"    => "(case when (clients.type = 'person') THEN CONCAT(persons.first_name,' ',persons.last_name) ELSE businesses.description END)  as Client", 
             "name_es" => "Cliente", 
             "name_en" => "Client",
             "order"   => 4
            ],
            ["report_group_id"=> 1,
             "code"    => "gp_imei as IMEI", 
             "name_es" => "IMEI", 
             "name_en" => "IMEI",
             "order"   => 5
            ],
            ["report_group_id"=> 1,
             "code"    => "gp_brand as Brand", 
             "name_es" => "Marca", 
             "name_en" => "Brand",
             "order"   => 6 
            ],
            ["report_group_id"=> 1,
             "code"    => "products.model as Model", 
             "name_es" => "Modelo", 
             "name_en" => "Model",
             "order"   => 7
            ],
            ["report_group_id"=> 1,
             "code"    => "gp_part_number as NumberPart", 
             "name_es" => "Número de Parte", 
             "name_en" => "Part Number",
             "order"   => 8
            ],
            ["report_group_id"=> 1,
             "code"    => "gp_item_description as Description", 
             "name_es" => "Descripción", 
             "name_en" => "Description",
             "order"   => 9
            ],
            ["report_group_id"=> 1,
             "code"    => "orders.client_invoice_date Client_Invoice_Date", 
             "name_es" => "Fecha Factura Cliente", 
             "name_en" => "Customer Invoice Date",
             "order"   => 10
            ],
            ["report_group_id"=> 1,
             "code"    => "orders.gp_invoice_date INVOICE_DATE", 
             "name_es" => "Fecha Factura", 
             "name_en" => "Invoice Date",
             "order"   => 11
            ],
            ["report_group_id"=> 1,
             "code"    => "orders.created_at Created_Date", 
             "name_es" => "Fecha Registro Orden", 
             "name_en" => "Entered Order Date",
             "order"   => 12
            ],
            ["report_group_id"=> 1,
             "code"    => "orders.updated_at Updated_Date", 
             "name_es" => "Fecha Modificación", 
             "name_en" => "Order Update Date",
             "order"   => 13
            ],
            ["report_group_id"=> 1,
             "code"    => "orders.type_management Management_Type", 
             "name_es" => "Tipo Gestión", 
             "name_en" => "Management Type",
             "order"   => 14
            ],
            ["report_group_id"=> 1,
             "code"    => "orders.failure_description as Failure_Description", 
             "name_es" => "Falla", 
             "name_en" => "Failure",
             "order"   => 15
            ],
            ["report_group_id"=> 1,
             "code"    => "failures.failures as Failure_Types", 
             "name_es" => "Tipos de Falla", 
             "name_en" => "Failure Types",
             "order"   => 16
            ],
            ["report_group_id"=> 1,
             "code"    => "state_translations.name as state", 
             "name_es" => "Estado", 
             "name_en" => "State",
             "order"   => 17
            ],
            ["report_group_id"=> 1,
             "code"    => "comments.comments as Comments", 
             "name_es" => "Comentarios", 
             "name_en" => "Comments",
             "order"   => 18
            ],
            ["report_group_id"=> 1,
             "code"    => "diagnostics.diagnostics as Diagnostics", 
             "name_es" => "Diagnósticos", 
             "name_en" => "Diagnostics",
             "order"   => 19
            ],
            ["report_group_id"=> 1,
             "code"    => "actions.actions as Actions", 
             "name_es" => "Acciones", 
             "name_en" => "Actions",
             "order"   => 20
            ],


            
        ];

     $report_group =  $report_group = ReportGroup::create([
            'name' => 'Orders'
        ]);


        foreach ($items as $item) {
            $report_group_items = ReportGroupItem::create([
                'report_group_id'=> $report_group->id,
                'code' => $item['code'],
                'order'=> $item['order'],
                'en'   => ['name' => $item['name_en']],
                'es'   => ['name' => $item['name_es']]
            ]);

        }
    }
}
