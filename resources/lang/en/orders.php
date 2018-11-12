<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Clients Language Lines
    |--------------------------------------------------------------------------
    */

    'id' => 'ID',
    'identification' => 'Identification',
    'first_name' => 'First Name',
    'last_name' => 'Last Name',
    'client' => 'Client',
    'product' => 'Product',
    'customer' => 'Customer',
    'country' => 'Country',
    'province' => 'Province/State/Department',
    'city' => 'City',
    'workshop' => 'Workshop',
    'workshop_to_send' => 'Workshop where it will be sent',
    'state' => 'State',
    'courier' => 'Courier',
    'order_number' => 'Order Number',
    'order_date' => 'Order Date',
    'client_invoice_number' => 'Client Invoice Number',
    'client_invoice_doc' => 'Client Invoice Doc',
    'client_invoice_date' => 'Client Invoice Date',
    'type_management' => 'Type Management',
    'type_failure' => 'Type Failure',
    'gp_imei' => 'IMEI COD',
    'gp_num_doc' => 'Customer Invoice Number',
    'gp_item_code' => 'Item Code',
    'gp_item_description' => 'Item Description',
    'gp_brand' => 'Brand',
    'gp_model' => 'Model',
    'gp_part_number' => 'Part Number',
    'gp_invoice_date' => 'Customer Invoice Date',
    'gp_purchase_date' => 'Purchase Date',
    'gp_customer_code' => 'Customer Code',
    'gp_customer_name' => 'Distributor Name',
    'gp_country_name' => 'Country Name',
    'tracking' => 'Tracking',
    'failure' => 'Failure',
    'failure_description' => 'General description of the fault',
    'failures_list' => 'Failures List',
    'failure_select' => 'Select the faults and insert',
    'personal_retreat' => 'Personal Retreat',
    'devolution_zip_code' => 'Zip Code',
    'devolution_address' => 'Devolution Address',
    'devolution_reference' => 'Reference',
    'email_notify'  => 'Email Notify?',
    'assign_courier' => 'Assing a Courier',
    'upload_file' => 'Upload File',
    'comment_doc' => 'Comments for attachment',
    'comment' => 'Comment',
    'order_attachment' => 'Select to attachment',
    'register_reception' => 'Register Reception',
    'accesories_received' => 'Accesories received',
    'actions' => 'Actions',
    'diagnostics' => 'Diagnostics',
    'register_action' => 'New action',
    'register_diagnostic' => 'New diagnostic',
    'register_diagnostic_action' => 'New State|Diagnostic|Action',
    'register_state' => 'New state',
    'insert_action' => 'Insert Action',
    'insert_diagnostic' => 'Insert Diagnostic',
    'no_diagnostics' => 'State does not have diagnostics.',
    'no_actions' => 'State does not have actions.',
    'change_type_management' => 'Change Warranty',

    //Messages of process
    'order_registered' => 'There has been successfully Order No. :order_number',
    'order_updated' => 'There has been updated the Order No. :order_number',
    'order_resent_title' => 'Send email with customer order',
    'order_resend_request' => 'Are you sure forward the order to the customer?',
    'order_delete_state_title' => 'Elimination of State, Action or Diagnosis',
    'order_delete_state_msg' => 'Are you sure to continue with the elimination of this State, Action or Diagnosis?',
    'order_resend_email_success' => 'It sent an email to the customer successfully',
    'remove_cellphone_personally' => 'The customer will remove the cell phone personally in the workshop where the equipment was sent',
    'diagnostic_not_registered' => 'There are currently no registered diagnoses to the case.',
    'action_not_registered' => 'There are currently no registered action to the case.',
    'diagnostics_actions_not_registered' => 'To make a change of status, you must register a diagnosis and an action to the case',

    //Grid options
    'resend_email_cliente' => 'Re-sent Email to Client',

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
