<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    | 
    | General translations system
    |
    */
   
    //----------------------- Types ------------------------
    'language' => [
        'es' => 'Español',
        'en' => 'Ingles',
        'pt' => 'Portugues',
    ],

    'gender' => [
        'female' => 'Femenino',
        'male'   => 'Masculino',
    ],

    'type_data' => [
        'string'  => 'String',
        'integer' => 'Integer',
        'double'  => 'Double',
        'boolean' => 'Boolean',
    ],

    'type_status' => [
        'active'   => 'Activo',
        'inactive' => 'Inactivo',
    ],

    'type_state' => [
        'active' => 'Activo',
        'pasive' => 'Pasivo',
    ],

    'type_client' => [
        'person'    => 'Persona',
        'business' => 'Negocio',
    ],

    'type_workshop' => [
        'openmarket'  => 'Open Market',
        'operator' => 'Operador',
        'both' => 'Both',
    ],

    'status_class' => [
        'inactive' => 'label label-danger',
        'active' => 'label label-success',
        'delete' => 'label label-danger',
    ],

    'states_class' => [
        'active' => 'label label-success',
        'pasive' => 'label label-danger',
    ],

    'roles' => [
        'admin'      => 'Administrador',
        'callcenter' => 'Call Center',
        'analist'    => 'Analista',
        'manager'    => 'Manager',
        'workshop'   => 'Taller',
        'client'     => 'Cliente',
        'store'      => 'Punto de Venta (Tienda)',
    ],

    'verification' => [
        'yes' => 'Yes',
        'no'  => 'No',
    ],

    'type_management' => [
        'warranty' => 'Garantía',
        'out_of_warranty'   => 'Fuera de Garantía',
    ],

    'accesories' => [
        'earphone' => 'Auricular',
        'cover' => 'Forro',
        'battery' => 'Bateria',
        'dc_charger' => 'Cargador de Voltaje DC',
        'usb_cable' => 'Cable USB',
        'telephone' => 'Teléfono',
        'external_memory' => 'Memoria Externa',
    ],

    'type_failure' => [
        'doa'   => 'DOA',
        'dap'   => 'DAP',
        'none'  => 'NINGUNA',
    ],

    'time_zones' => [
        'america/montevideo' => '(GMT-03:00) Montevideo',
        'america/caracas' => '(GMT-04:00) Caracas',
        'america/bogota' => '(GMT-05:00) Bogota',
        'america/lima' => '(GMT-05:00) Lima',
        'america/guayaquil' => '(GMT-05:00) Ecuador',
        'america/mexico_city' => '(GMT-05:00) Mexico',
        'america/panama' => '(GMT-05:00) Panamá',
        'america/new_york' => '(GMT-05:00) Eastern Time (US & Canada)',
        'america/chicago' => '(GMT-06:00) Central Time (US & Canada)',
        'america/tegucigalpa' => '(GMT-06:00) Honduras',
        'america/costa_rica' => '(GMT-06:00) Costa Rica',
        'america/managua' => '(GMT-06:00) Managua',
        'america/guatemala' => '(GMT-06:00) Guatemala',
        'america/el_salvador' => '(GMT-06:00) El Salvador',
        'america/denver' => '(GMT-06:30) Mountain Time no DST (US & Canada)',
        'america/phoenix' => '(GMT-07:00) Mountain Time (US & Canada)',
        'america/los_angeles' => '(GMT-08:00) Pacific Time (US & Canada)',
        'america/anchorage' => '(GMT-09:00) Alaska',
    ],

    'countries_yezz' => ["VE", "CO", "MX", "UY", "US", "PE", "GT", "CR", "NI", "PA", "HN", "EC", "SV"],

    'source_types' => [
        'order'   => 'order',
        'client'  => 'client',
    ],
    
    'action_types' => [
        //Orders
        ['id' => 1, 'source_type' => 'order', 'action' => 'created_mail'],
        ['id' => 2, 'source_type' => 'order', 'action' => 'not_send_mail'],
        ['id' => 3, 'source_type' => 'order', 'action' => 'issued_case'],
        ['id' => 4, 'source_type' => 'order', 'action' => 'out_of_time'],
        ['id' => 5, 'source_type' => 'order', 'action' => 'received'],
        ['id' => 6, 'source_type' => 'order', 'action' => 'voided'],
        ['id' => 7, 'source_type' => 'order', 'action' => 'swap'],
        ['id' => 8, 'source_type' => 'order', 'action' => 'delivered'],
        ['id' => 9, 'source_type' => 'order', 'action' => 'sent_by_workshop'],
        ['id' => 10, 'source_type' => 'order', 'action' => 'failure_not_detected'],
        ['id' => 11, 'source_type' => 'order', 'action' => 'credit_note'],
        
        ['id' => 12, 'source_type' => 'order', 'action' => 'spare_part_not_available'],
        ['id' => 13, 'source_type' => 'order', 'action' => 'cannot_be_repaired'],
        ['id' => 14, 'source_type' => 'order', 'action' => 'pending_client_approval'],
        ['id' => 15, 'source_type' => 'order', 'action' => 'repaired'],
        
        //['id' => 4, 'source_type' => 'order', 'action' => 'sent'],
        //['id' => 10, 'source_type' => 'order', 'action' => 'under_review'],
        //['id' => 17, 'source_type' => 'order', 'action' => 'abandoned'],
        //['id' => 18, 'source_type' => 'order', 'action' => 'not_approved_by_client'],
        //['id' => 19, 'source_type' => 'order', 'action' => 'approved_by_client'],
    ],

    //------------------------------------------------------

    //Titles for Sections Pages
    'section_title' => [
        'home'  => 'Home',
        'brands' => [
            'add'    => 'Agregar nueva Marca',
            'edit'   => 'Editar Marca',
            'list'   => 'Lista de Marcas',
            'module' => 'Módulo Gestión de Marcas',
        ],
        'families' => [
            'add'    => 'Agregar nueva Familia',
            'edit'   => 'Editar Familia',
            'list'   => 'Lista de Familias',
            'module' => 'Módulo Gestión de Familiar',
        ],
        'producttypes' => [
            'add'    => 'Agregar nuevo Tipo de Producto',
            'edit'   => 'Editar Tipo de Producto',
            'list'   => 'Lista Tipo de Productos',
            'module' => 'Módulo Gestión de Tipos de Productos',
        ],
        'scales' => [
            'add'    => 'Agregar nueva Gamma',
            'edit'   => 'Editar Gamma',
            'list'   => 'Lista de Gammas',
            'module' => 'Módulo Gestión de Gammas',
        ],
        'routes' => [
            'add'    => 'Agregar nueva Ruta',
            'edit'   => 'Editar Ruta',
            'list'   => 'Lista de Rutas',
            'module' => 'Módulo Gestión de Rutas',
        ],
        'technologies' => [
            'add'    => 'Agregar nueva Tecnología',
            'edit'   => 'Editar Tecnología',
            'list'   => 'Lista de Tecnologías',
            'module' => 'Módulo Gestión de Tecnologías',
        ],
        'products' => [
            'add'    => 'Agregar nuevo Producto',
            'edit'   => 'Editar Producto',
            'list'   => 'Lista de Productos',
            'module' => 'Módulo Gestión de Productos',
        ],
        'countries' => [
            'add'    => 'Agregar nuevo País',
            'edit'   => 'Editar País',
            'list'   => 'Lista de Paises',
            'module' => 'Módulo Gestión de Paises',
        ],
        'provinces' => [
            'add'    => 'Agregar nueva Provincia',
            'edit'   => 'Editar Provincia',
            'list'   => 'Lista de Provincias',
            'module' => 'Módulo Gestión de Provincias',
        ],
        'cities' => [
            'add'    => 'Agregar nueva Ciudad',
            'edit'   => 'Editar Ciudad',
            'list'   => 'Lista de Ciudades',
            'module' => 'Módulo Gestión de Ciudades',
        ],
        'couriers' => [
            'add'    => 'Agregar nuevo Courier',
            'edit'   => 'Editar Courier',
            'list'   => 'Lista de Couriers',
            'module' => 'Módulo Gestión de Couriers',
        ],
        'chains' => [
            'add'    => 'Agregar nueva Cadena',
            'edit'   => 'Editar Cadena',
            'list'   => 'Lista de Cadenas',
            'module' => 'Módulo Gestión de Cadenas',
        ],
        'states' => [
            'add'    => 'Agregar nuevo Estado',
            'edit'   => 'Editar Estado',
            'list'   => 'Lista de Estados',
            'module' => 'Módulo Gestión de Estados',
        ],
        'colors' => [
            'add'    => 'Agregar nuevo Color',
            'edit'   => 'Editar Color',
            'list'   => 'Lista de Colores',
            'module' => 'Módulo Gestión de Colores',
        ],
        'failures' => [
            'add'    => 'Agregar nueva Falla',
            'edit'   => 'Editar Falla',
            'list'   => 'Lista de Fallas',
            'module' => 'Módulo Gestión de Fallas',
        ],
        'workshops' => [
            'add'    => 'Agregar nuevo Taller',
            'edit'   => 'Editar Taller',
            'list'   => 'Lista de Talleres',
            'module' => 'Módulo Gestión de Talleres',
            'workshop_information' => 'Información del Taller',
            'contact_info_address' => 'Información de Contacto y Dirección',
        ],
        'users' => [
            'add'    => 'Agregar nuevo Usuario',
            'edit'   => 'Editar Usuario',
            'list'   => 'Lista de Usuarios',
            'module' => 'Módulo Gestión de Usuarios',
            'personal_information' => 'Información Personal',
            'access_information' => 'Información de Acceso',
        ],
        'clients' => [
            'add'    => 'Agregar nuevo Cliente',
            'edit'   => 'Editar Cliente',
            'list'   => 'Lista de Clientes',
            'module' => 'Módulo Gestión de Clientes',
            'personal_information' => 'Información Personal',
            'address_information' => 'Información de Domicilio',
            'client_information' => 'Información del Cliente',
        ],
        'orders' => [
            'add'    => 'Agregar nueva Orden',
            'edit'   => 'Editar Orden',
            'edit_courier'  => 'Editar Courier',
            'list'   => 'Lista de Ordenes',
            'module' => 'Módulo Gestión de Ordenes',
            'equipment_information' => 'Información del Equipo',
            'return_address_information' => 'Información de Dirección de Retorno',
            'invoice_information' => 'Información de Facturación (Dinamics GP)',
            'service_order' => 'Orden de Servicio',
            'order_data_tab' => 'Datos de la Orden',
            'documents_tab' => 'Documentos Adjuntos',
            'histories_tab' => 'Histórico de Estados',
            'actions_diagnostics_tab' => 'Estados, Acciones y Diagnósticos',
            'notes_tab' => 'Notas y observaciones',
        ],
        'reports' => [
            'reports'  => 'Reportes',
            'create'   => 'Nuevo Reporte',
            'open'     => 'Abrir',
            'save'     => 'Guardar',
            'edit'     => 'Editar',
            'generate' => 'Generar',
            'export'   => 'Exportar',
            'select'   => 'Seleccionar',
        ],
    ],

    //App Identification
    'app_title'           => 'YWS YEZZCORP :: ',
    'contentheader_title' => 'YWS YezzCorp',

    //Modules
    'brand'               => 'Marca',
    'brands'              => 'Marcas',
    'family'              => 'Familia',
    'producttype'         => 'Tipo de Producto',
    'scale'               => 'Gamma',
    'technology'          => 'Tecnología',
    'color'               => 'Color',
    'product'             => 'Producto',
    'country'             => 'País',
    'countries'           => 'Países',
    'province'            => 'Provincia',
    'city'                => 'Ciudad',
    'courier'             => 'Courier',
    'route'               => 'Ruta',
    'chain'               => 'Cadena',
    'state'               => 'Estado',
    'workshop'            => 'Taller',
    'user'                => 'Usuario',
    'client'              => 'Cliente',
    'order'               => 'Orden',
    'failure'             => 'Falla',

    //Fields Forms Shorts
    'name'                       => 'Nombre',
    'description'                => 'Descripción',
    'status'                     => 'Estatus',
    'code'                       => 'Código',
    'brand_description'          => 'Descripción de Marca',
    'family_description'         => 'Descripción de Familia',
    'producttype_description'    => 'Descripción de Tipo de Producto',
    'scale_description'          => 'Descripción de Gamma',
    'technology_description'     => 'Descripción de Tecnología',
    'courier_description'        => 'Descripción de Courier',
    'route_description'          => 'Descripción de Ruta',
    'failure_description'        => 'Descripción de Falla',
    'models'                     => 'Modelos',
    'workshops'                  => 'Talleres',

    //Messages type Notifications
    'success_alert_title' => 'Success',
    'error_alert_title'   => 'Oh No!',
    'important'           => 'Importante!',

    //Messages Generals
    'success_procces'     => 'La solicitud se ha procesado satisfactoriamente!',
    'imei_registered_dinamicsgp' => 'Código IMEI registrado en DinamicsGP',
    'imei_not_registered_dinamicsgp' => 'Código IMEI no registrado en DinamicsGP',
    'imei_is_not_blank' => 'Código IMEI ingresado no puede estar en blanco',
    'not_data_products_dinamicsgp' => 'No se consiguieron datos en DinamicsGP',
    'email_resend'  => 'El email ha sido reenviado',

    //Social Networks
    'twitter_label'       => 'Twitter',
    'facebook_label'      => 'Facebook',

    //Sections Generals
    'search'              => 'Buscar',
    'menu_header'         => 'Menu',
    'actions'             => 'Acciones',
    'options'             => 'Opciones',
    'profile'             => 'Perfil',
    
    //Buttons
    'previous'              => '<< Anterior',
    'back'                  => '<< Atras',
    'next'                  => 'Siguiente >>',
    'save'                  => 'Guardar',
    'delete'                => 'Eliminar',
    'insert'                => 'Insertar',
    'edit'                  => 'Editar',
    'submit'                => 'Enviar',
    'submit_continue'       => 'Enviar y continuar',
    'finish'                => 'Finalizar',
    'sign_out'              => 'Cerrar sesión',
    'add_new'               => 'Agregar nuevo',
    'close'                 => 'Cerrar',
    'show'                  => 'Mostrar',
    'please_wait'           => 'Por favor espere',
    'show_more_information' => 'Mostrar más información',
    'show_attachment'       => 'Mostrar Adjunto',
    'download'              => 'Descargar',
    'show_invoice'          => 'Mostrar Factura',
    'sincronize'            => 'Sincronizar con Dinamics GP',

    //Others use
    'copyright'           => 'Copyright',
    'online'              => 'Online',
    'created_by'          => 'Creado por',
    'created_at'          => 'Creado el',
    'updated_at'          => 'Actualizado el',
    'registered_by'       => 'Registrado por',
    'deleted_by'          => 'Eliminado por',
    'member_since'        => 'Miembro desde :date',
    'select'              => 'Selecciona un valor',

    //Inputmask
    'inputmask' => [
        'date' => 'yyyy-mm-dd',
        'phone_mask' => '999-999-99-99',
        'phone_home_mask' => '999-99-99',
        'phone_placeholder' => '___-___-__-__',
        'phone_home_placeholder' => '___-__-__',
        'amount' => '$ 999.999.999,99',
    ],
    'format' => [
        'days_of_week' => [
            'sunday' => 'Do',
            'monday' => 'Lu',
            'tuesday' => 'Ma',
            'wednesday' => 'Mi',
            'thursday' => 'Ju',
            'friday' => 'Vi',
            'saturday' => 'Sa',
        ],
        'month_names' => [
            'january' => 'Enero',
            'february' => 'Febrero',
            'march' => 'Marzo',
            'april' => 'Abril',
            'may' => 'Mayo',
            'june' => 'Junio',
            'july' => 'Julio',
            'august' => 'Agosto',
            'september' => 'Septiembre',
            'optober' => 'Octubre',
            'november' => 'Noviembre',
            'december' => 'Diciembre',
        ],
        'date' => 'YYYY-MM-DD', //for library moment.js
    ],
];