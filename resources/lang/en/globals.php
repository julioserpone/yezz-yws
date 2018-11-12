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
        'es' => 'Spanish',
        'en' => 'English',
        'pt' => 'Portuguese',
    ],

    'gender' => [
        'female' => 'Female',
        'male'   => 'Male',
    ],

    'type_data' => [
        'string'  => 'String',
        'integer' => 'Integer',
        'double'  => 'Double',
        'boolean' => 'Boolean',
    ],

    'type_status' => [
        'active'   => 'Active',
        'inactive' => 'Inactive',
    ],

    'type_state' => [
        'active' => 'Active',
        'pasive' => 'Pasive',
    ],

    'type_client' => [
        'person'    => 'Person',
        'business' => 'Business',
    ],

    'type_workshop' => [
        'openmarket'  => 'Open Market',
        'operator' => 'Operator',
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
        'admin'      => 'Admin',
        'callcenter' => 'Call Center',
        'analist'    => 'Analist',
        'manager'    => 'Manager',
        'workshop'   => 'Workshop',
        'client'     => 'Client',
        'store'      => 'Point of Sale (Store)',
    ],

    'verification' => [
        'yes' => 'Yes',
        'no'  => 'No',
    ],

    'type_management' => [
        'warranty' => 'Warranty',
        'out_of_warranty'   => 'Out of Warranty',
    ],

    'accesories' => [
        'earphone' => 'Earphone',
        'cover' => 'Cover',
        'battery' => 'Battery',
        'dc_charger' => 'DC Charger',
        'usb_cable' => 'USB Cable',
        'telephone' => 'Telephone',
        'external_memory' => 'External Memory',
    ],

    'type_failure' => [
        'doa'   => 'DOA',
        'dap'   => 'DAP',
        'none'  => 'NONE',
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
            'add'    => 'Add New Brand',
            'edit'   => 'Edit Brand',
            'list'   => 'Brands List',
            'module' => 'Management Module Brands',
        ],
        'families' => [
            'add'    => 'Add New Family',
            'edit'   => 'Edit Family',
            'list'   => 'Families List',
            'module' => 'Management Module Families',
        ],
        'producttypes' => [
            'add'    => 'Add New Product Type',
            'edit'   => 'Edit Product Type',
            'list'   => 'Product Types List',
            'module' => 'Management Module Product Types',
        ],
        'scales' => [
            'add'    => 'Add New Gamma',
            'edit'   => 'Edit Gamma',
            'list'   => 'Gammas List',
            'module' => 'Management Module Gammas',
        ],
        'routes' => [
            'add'    => 'Add New Route',
            'edit'   => 'Edit Route',
            'list'   => 'Routes List',
            'module' => 'Management Module Routes',
        ],
        'technologies' => [
            'add'    => 'Add New Technology',
            'edit'   => 'Edit Technology',
            'list'   => 'Technologies List',
            'module' => 'Management Module Technologies',
        ],
        'products' => [
            'add'    => 'Add New Product',
            'edit'   => 'Edit Product',
            'list'   => 'Products List',
            'module' => 'Management Module Products',
        ],
        'countries' => [
            'add'    => 'Add New Country',
            'edit'   => 'Edit Country',
            'list'   => 'Countries List',
            'module' => 'Management Module Countries',
        ],
        'provinces' => [
            'add'    => 'Add New Province',
            'edit'   => 'Edit Province',
            'list'   => 'Provinces List',
            'module' => 'Management Module Provinces',
        ],
        'cities' => [
            'add'    => 'Add New City',
            'edit'   => 'Edit City',
            'list'   => 'Cities List',
            'module' => 'Management Module Cities',
        ],
        'couriers' => [
            'add'    => 'Add New Courier',
            'edit'   => 'Edit Courier',
            'list'   => 'Couriers List',
            'module' => 'Management Module Couriers',
        ],
        'chains' => [
            'add'    => 'Add New Chain',
            'edit'   => 'Edit Chain',
            'list'   => 'Chains List',
            'module' => 'Management Module Chains',
        ],
        'states' => [
            'add'    => 'Add New State',
            'edit'   => 'Edit State',
            'list'   => 'States List',
            'module' => 'Management Module States',
        ],
        'colors' => [
            'add'    => 'Add New Color',
            'edit'   => 'Edit Color',
            'list'   => 'Colors List',
            'module' => 'Management Module Colors',
        ],
        'failures' => [
            'add'    => 'Add New Failure',
            'edit'   => 'Edit Failure',
            'list'   => 'Failures List',
            'module' => 'Management Module Failures',
        ],
        'workshops' => [
            'add'    => 'Add New Workshop',
            'edit'   => 'Edit Workshop',
            'list'   => 'Workshops List',
            'module' => 'Management Module Workshops',
            'workshop_information' => 'Workshop Information',
            'contact_info_address' => 'Contact Information & Address',
        ],
        'users' => [
            'add'    => 'Add New User',
            'edit'   => 'Edit User',
            'list'   => 'Users List',
            'module' => 'Management Module Users',
            'personal_information' => 'Personal Information',
            'access_information' => 'Access Information',
        ],
        'clients' => [
            'add'    => 'Add New Client',
            'edit'   => 'Edit Client',
            'list'   => 'Clients List',
            'module' => 'Management Module Clients',
            'personal_information' => 'Personal Information',
            'address_information' => 'Address Information',
            'client_information' => 'Client Information',
        ],
        'orders' => [
            'add'    => 'Add New Order',
            'edit'   => 'Edit Order',
            'edit_courier'   => 'Edit Courier',
            'list'   => 'Orders List',
            'module' => 'Management Module Orders',
            'equipment_information' => 'Equipment Information',
            'return_address_information' => 'Return Address Information',
            'invoice_information' => 'Invoice Information (Dinamics GP)',
            'service_order' => 'Service Order',
            'order_data_tab' => 'Order Data',
            'documents_tab' => 'Attachments',
            'histories_tab' => 'History of states',
            'actions_diagnostics_tab' => 'State, Actions & Diagnostics',
            'notes_tab' => 'Notes & Observations',
        ],
        
        'reports' => [
            'reports'  => 'Reports',
            'open'     => 'Open',
            'create'   => 'New Report',
            'save'     => 'Save',
            'edit'     => 'Edit',
            'generate' => 'Generate',
            'export'   => 'Export',
            'select'   => 'Select',

        ],
    ],

    //App Identification
    'app_title'           => 'YWS YEZZCORP :: ',
    'contentheader_title' => 'YWS YezzCorp',

    //Modules
    'brand'               => 'Brand',
    'brands'              => 'Brands',
    'family'              => 'Family',
    'producttype'         => 'Product Type',
    'scale'               => 'Gamma',
    'technology'          => 'Technology',
    'color'               => 'Color',
    'product'             => 'Product',
    'country'             => 'Country',
    'countries'           => 'Countries',
    'province'            => 'Province',
    'city'                => 'City',
    'courier'             => 'Courier',
    'route'               => 'Route',
    'chain'               => 'Chain',
    'state'               => 'State',
    'workshop'            => 'Workshop',
    'user'                => 'User',
    'client'              => 'Client',
    'order'               => 'Order',
    'failure'             => 'Failure',


    //Fields Forms Shorts
    'name'                       => 'Name',
    'description'                => 'Description',
    'status'                     => 'Status',
    'code'                       => 'Code',
    'brand_description'          => 'Brand Description',
    'family_description'         => 'Family Description',
    'producttype_description'    => 'Product Type Description',
    'scale_description'          => 'Gamma Description',
    'technology_description'     => 'Technology Description',
    'courier_description'        => 'Courier Description',
    'route_description'          => 'Route Description',
    'failure_description'        => 'Failure Description',
    'models'                     => 'Models',
    'workshops'                  => 'Workshops',

    //Messages type Notifications
    'success_alert_title' => 'Success',
    'error_alert_title'   => 'Oh No!',
    'important'           => 'Important!',

    //Messages Generals
    'success_procces'     => 'The request was processed successfully!',
    'imei_registered_dinamicsgp' => 'IMEI code registered DinamicsGP',
    'imei_not_registered_dinamicsgp' => 'IMEI code is Not registered DinamicsGP',
    'imei_is_not_blank' => 'Entered IMEI code can not be blank',
    'not_data_products_dinamicsgp' => 'Not get data products DinamicsGP',
    'email_resend'  => 'Email has been resend',

    //Social Networks
    'twitter_label'       => 'Twitter',
    'facebook_label'      => 'Facebook',

    //Sections Generals
    'search'              => 'Search',
    'menu_header'         => 'Menu',
    'actions'             => 'Actions',
    'options'             => 'Options',
    'profile'             => 'Profile',
    
    //Buttons
    'previous'              => '<< Previous',
    'back'                  => '<< Back',
    'next'                  => 'Next >>',
    'save'                  => 'Save',
    'delete'                => 'Delete',
    'insert'                => 'Insert',
    'edit'                  => 'Edit',
    'submit'                => 'Submit',
    'submit_continue'       => 'Submit and continue',
    'finish'                => 'Finish',
    'sign_out'              => 'Sign out',
    'add_new'               => 'Add new',
    'close'                 => 'Close',
    'show'                  => 'Show',
    'please_wait'           => 'Please wait',
    'show_more_information' => 'Show more information',
    'show_attachment'       => 'Show Attachment',
    'download'              => 'Download',
    'show_invoice'          => 'Show Invoice',
    'sincronize'            => 'sincronize with Dinamics GP',
    
    //Others use
    'copyright'           => 'Copyright',
    'online'              => 'Online',
    'created_by'          => 'Created by',
    'created_at'          => 'Created At',
    'updated_at'          => 'Updated At',
    'registered_by'       => 'Registered by',
    'deleted_by'          => 'Deleted by',
    'member_since'        => 'Member since :date',
    'select'              => 'Select a value',

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
            'sunday' => 'Su',
            'monday' => 'Mo',
            'tuesday' => 'Tu',
            'wednesday' => 'We',
            'thursday' => 'Th',
            'friday' => 'Fr',
            'saturday' => 'Sa',
        ],
        'month_names' => [
            'january' => 'January',
            'february' => 'February',
            'march' => 'March',
            'april' => 'April',
            'may' => 'May',
            'june' => 'June',
            'july' => 'July',
            'august' => 'August',
            'september' => 'September',
            'optober' => 'October',
            'november' => 'November',
            'december' => 'December',
        ],
        'date' => 'YYYY-MM-DD', //for library moment.js
    ],
];