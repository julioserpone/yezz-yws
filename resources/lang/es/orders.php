<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Clients Language Lines
    |--------------------------------------------------------------------------
    */

    'id' => 'ID',
    'identification' => 'Identificación',
    'first_name' => 'Nombres',
    'last_name' => 'Apellidos',
    'client' => 'Cliente',
    'product' => 'Producto',
    'customer' => 'Cliente',
    'country' => 'País',
    'province' => 'Provincia/Estado/Departamento',
    'city' => 'Ciudad',
    'workshop' => 'Taller',
    'workshop_to_send' => 'Taller a donde será enviado',
    'state' => 'Estado',
    'courier' => 'Courier',
    'order_number' => 'Orden Nro',
    'order_date' => 'Fecha de registro',
    'client_invoice_number' => 'Número Fact. Cliente',
    'client_invoice_doc' => 'Documento Fact. Cliente',
    'client_invoice_date' => 'Fecha Fact. Cliente',
    'type_management' => 'Tipo de Gestión',
    'type_failure' => 'Tipo de Falla',
    'gp_imei' => 'IMEI COD',
    'gp_num_doc' => 'Nro Factura Cliente',
    'gp_item_code' => 'Código Item',
    'gp_item_description' => 'Descripción Item',
    'gp_brand' => 'Marca',
    'gp_model' => 'Modelo',
    'gp_part_number' => 'Número de Parte',
    'gp_invoice_date' => 'Fecha de Facturación',
    'gp_purchase_date' => 'Fecha de Compra',
    'gp_customer_code' => 'Código Cliente',
    'gp_customer_name' => 'Nombre Distribuidor',
    'gp_country_name' => 'Nombre País',
    'tracking' => 'Seguimiento (tracking)',
    'failure' => 'Falla',
    'failure_description' => 'Descripción General de la Falla',
    'failures_list' => 'Lista de Fallas',
    'failure_select' => 'Seleccione las fallas e insertelas',
    'personal_retreat' => 'Retiro Personal',
    'devolution_zip_code' => 'Código Postal',
    'devolution_address' => 'Dirección de Devolución',
    'devolution_reference' => 'Referencia',
    'email_notify'  => 'Notificar por email?',
    'assign_courier' => 'Asignar un Courier',
    'upload_file' => 'Upload File',
    'comment_doc' => 'Comentarios del adjunto',
    'comment' => 'Comentario',
    'order_attachment' => 'Selecciona un adjunto',
    'register_reception' => 'Registrar recepcion',
    'accesories_received' => 'Accesorios recibidos',
    'actions' => 'Acciones',
    'diagnostics' => 'Diagnósticos',
    'register_action' => 'Nueva acción',
    'register_diagnostic' => 'Nuevo diagnóstico',
    'register_diagnostic_action' => 'Nuevo Estado|Diagnóstico|Acción',
    'register_state' => 'Nuevo estado',
    'change_type_management' => 'Cambiar Garantia',

    //Messages of process
    'order_registered' => 'Se ha registrado satisfactoriamente la Orden No. :order_number',
    'order_updated' => 'Se ha actualizado la Orden No. :order_number',
    'order_resent_title' => 'Envio de email con orden del cliente',
    'order_resend_request' => 'Estas seguro de enviar la orden al cliente?',
    'order_delete_state_title' => 'Eliminacion de Estado, Accion o Diagnostico',
    'order_delete_state_msg' => 'Esta usted seguro de continuar con la eliminación de este Estado, Acción o Diagnóstico?',
    'order_resend_email_success' => 'Se ha enviado el email al cliente satisfactoriamente',
    'remove_cellphone_personally' => 'El cliente retirará el celular personalmente en el taller a donde fue enviado el equipo',
    'diagnostic_not_registered' => 'Actualmente no se encuentra ningún diagnostico registrado al caso.',
    'action_not_registered' => 'Actualmente no se encuentra ninguna acción registrada al caso.',
    'diagnostics_actions_not_registered' => 'Para realizar un cambio de estado, deberá registrar un diagnostico y una acción al caso',

    'insert_action' => 'Insertar Acción',
    'insert_diagnostic' => 'Insertar Diagnóstico',
    'no_diagnostics' => 'El Estado no tiene Diagnósticos.',
    'no_actions' => 'El Estado no tiene Acciones.',
    //Grid options
    'resend_email_cliente' => 'Reenviar email al cliente',

    //Icos Accesories
    'icons' => [
        'earphone' => [
            'class' => 'fa fa-headphones',
            'name' => 'Earphone'
        ],
        'cover' => [
            'class' => 'fa fa-shield',
            'name' => 'Cover'
        ],
        'battery' => [
            'class' => 'fa fa-battery-full',
            'name' => 'Battery'
        ],
        'dc_charger' => [
            'class' => 'fa fa-plug',
            'name' => 'DC Charger'
        ],
        'usb_cable' => [
            'class' => 'fa fa-usb',
            'name' => 'USB Cable'
        ],
        'telephone' => [
            'class' => 'fa fa-mobile',
            'name' => 'Telephone'
        ],
        'external_memory' => [
            'class' => 'fa fa-microchip',
            'name' => 'External Memory'
        ],
    ],
];
