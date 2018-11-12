<?php

return [
    //templates to the actions types
    'templates' => [
        'order:created_mail'                => 'Order #:order_number was notified by email.',
        'order:not_send_mail'               => 'Order #:order_number can not be notified by email.',
        'order:issued_case'                 => 'A new order #:order_number has been issued.',
        //'order:sent'                        => 'Order #:order_number was sent.',
        'order:received'                    => 'Order #:order_number has been received.',
        'order:repaired'                    => 'Order #:order_number has been repaired.',
        'order:sent_by_workshop'            => 'Order #:order_number has been sent by the workshop.',
        'order:delivered'                   => 'The order #:order_number was delivered.',
        'order:spare_part_not_available'    => 'Equipment Order #:order_number presents an unavailable component.',
        //'order:under_review'                => 'Equipment Order #:order_number is under review.',
        'order:failure_not_detected'        => 'No faults were found for the equipment Order #:order_number.',
        'order:cannot_be_repaired'          => 'Ther order #:order_number was cannot be repaired.',
        'order:swap'                        => 'Equipment change of Order #:order_number is executed.',
        'order:credit_note'                 => 'Credit Note Application for Order #:order_number.',
        'order:out_of_time'                 => 'Order #:order_number is Out of Time.',
        'order:voided'                      => 'The order #:order_number has been voided.',
        //'order:abandoned'                   => 'Your order #:order_number is abandoned.',
        'order:pending_client_approval'     => 'Actions Required for Order #:order_number are pending client approval.',
        //'order:not_approved_by_client'      => 'The actions required for Order #:order_number were not approved by the customer.',
        //'order:approved_by_client'          => 'The actions required for Order #:order_number were approved by the customer.',
    ],

    'all_title'   => 'Noticias',
    'all_summary' => 'Aquí podrás ver todos los avisos que te han llegado hasta ahora. También, puede hacer clic en el para ver su detalle.',
];
