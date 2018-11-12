<?php

return [

/*
|--------------------------------------------------------------------------
| Days to wait to do actions on the Cron Jobs
|--------------------------------------------------------------------------
|
| This options control the day to wait for each cron job action, ep.
| How many days would the system wait to close an order marked as
| ISSUED_CASE by the callcenter, but not RECEIVED by the workshop
|
*/
    'days_to_remind' => 3,
    'days_to_close'  => 15,
];
