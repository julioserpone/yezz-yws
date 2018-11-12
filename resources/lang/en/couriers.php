<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Couriers Language Lines
    |--------------------------------------------------------------------------
    */
    'code' => 'Code',
    'description' => 'Description',
    'tracking' => [
    	'dhl' => [
            'url' => 'http://www.dhl.com/en/express/tracking.shtml',
            'method' => 'GET',
            'parameters' => [
                'brand' => 'DHL',
                'AWB' => ':number_tracking',
            ],
        ],
    	'usps' => [
            'url' => 'https://tools.usps.com/go/TrackConfirmAction',
            'method' => 'GET',
            'parameters' => [
                'tRef' => 'fullpage',
                'tLc' => '1',
                'text28777' => '',
                'tLabels' => ':number_tracking',
            ],
        ],
    	'zoom' => [
            'url' => 'http://www.zoomenvios.com/zoomtrack/zoom-track-res.php',
            'method' => 'POST',
            'parameters' => [
                'identificacion' => ':number_tracking',
                'rastreoenvio' => 'guia',
            ],
        ],
    	'tealca' => '',
    	'domesa' => '',
    	'mrw' => '',
    ],
];
