<?php

use craft\helpers\App;

// By default always disable populate missing fields feature, when updating a large number of addresses this consumes a lot of api requests which incurs cost
$disablePopulateMissingFieldData = true;

// If the env settings is false then enable the populate feature
if (strtolower(App::env('DISABLE_MAP_POPULATE_MISSING_DATA')) === 'false')
    $disablePopulateMissingFieldData = false;

return [
    'disablePopulateMissingFieldData' => $disablePopulateMissingFieldData
];