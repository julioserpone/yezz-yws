<?php

return [

    /*
    |-------------------------------------------------------------------------
    | Customs Messages
    |-------------------------------------------------------------------------
     */
    'insufficient_role'     => 'You do not have the necessary role to access the requested module',
    'credentials_invalid' => 'The credentials provided are invalid',
    'client_registered' => 'Hi. We cordially welcome you to our YWS Guarantee Management System. We invite you to manage your requirements through this system.',
    'errors' => [
        'globals'       => [
            'request_invalid'       => 'The request send is invalid',
            'not_section_allow'       => 'You are not allow to enter to that section',
            'file_upload_error'     => 'The attached file could not be sent to the application server',
            'file_maxsize_error'    => 'Maximum file size must be :MaxFilesize bytes',
        ],
        'users'         => [
            'insufficient_role'     => 'You do not have the necessary role to access the requested module',
        ],
        'brands'        => [
            'brand_already_exist'   => 'The brand trying to register already exists',
            'brand_not_exist'       => 'The Brand trying to edit does not exist',
        ],
        'failures'        => [
            'failure_already_exist'   => 'The Failure trying to register already exists',
            'failure_not_exist'       => 'The Failure trying to edit does not exist',
        ],
        'families'      => [
            'family_already_exist'   => 'The Family trying to register already exists',
            'family_not_exist'       => 'The Family trying to edit does not exist',
        ],
        'producttypes'  => [
            'producttype_already_exist'   => 'The Product Type trying to register already exists',
            'producttype_not_exist'       => 'The Product Type trying to edit does not exist',
        ],
        'scales'  => [
            'scale_already_exist'   => 'The Gamma trying to register already exists',
            'scale_not_exist'       => 'The Gamma trying to edit does not exist',
        ],
        'products'  => [
            'product_already_exist'   => 'The Product trying to register already exists',
            'product_not_exist'       => 'The Product trying to edit does not exist',
        ],
        'routes'   => [
            'route_already_exist'   => 'The Route trying to register already exists',
            'route_not_exist'       => 'The Route trying to edit does not exist',
        ],
        'technologies'  => [
            'technology_already_exist'   => 'The Technology trying to register already exists',
            'technology_not_exist'       => 'The Technology trying to edit does not exist',
        ],
        'countries'  => [
            'country_already_exist'   => 'The Country trying to register already exists',
            'country_not_exist'       => 'The Country trying to edit does not exist',
        ],
        'provinces'  => [
            'province_already_exist'   => 'The Province trying to register already exists',
            'province_not_exist'       => 'The Province trying to edit does not exist',
        ],
        'cities'  => [
            'city_already_exist'   => 'The City trying to register already exists',
            'city_not_exist'       => 'The City trying to edit does not exist',
        ],
        'couriers'   => [
            'courier_already_exist'   => 'The Courier trying to register already exists',
            'courier_not_exist'       => 'The Courier trying to edit does not exist',
        ],
        'chains'  => [
            'chain_already_exist'   => 'The Chain trying to register already exists',
            'chain_not_exist'       => 'The Chain trying to edit does not exist',
        ],
        'states'  => [
            'state_already_exist'   => 'The State trying to register already exists',
            'state_not_exist'       => 'The State trying to edit does not exist',
        ],
        'colors'  => [
            'color_already_exist'   => 'The color trying to register already exists',
            'color_not_exist'       => 'The Color trying to edit does not exist',
        ],
        'workshops'  => [
            'workshop_already_exist'   => 'The Workshop trying to register already exists',
            'workshop_not_exist'       => 'The Workshop trying to edit does not exist',
        ],
        'users'  => [
            'user_already_exist'   => 'The User trying to register already exists',
            'user_not_exist'       => 'The User trying to edit does not exist',
        ],
        'clients'  => [
            'client_already_exist'   => 'The Client trying to register already exists',
            'client_not_exist'       => 'The Client trying to edit does not exist',
            'client_same_attribute'  => 'There are other clients with the same attributes, such as identification, first name, or company description. Try to be more specific with the information requested',
        ],
        'orders' => [
            'not_process_order' => 'There were errors processing the order. Please contact your system administrator',
            'order_not_exist'   => 'The Order trying to edit does not exist',
            'order_not_can_modify' => 'Only orders with status ISSUED CASE can be modified',
            'imei_in_use'  => 'The IMEI trying to register is already in use in an order with status ISSUED CASE',
        ],
    ],
];
