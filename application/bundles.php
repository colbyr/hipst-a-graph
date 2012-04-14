<?php

/*
|--------------------------------------------------------------------------
| Bundle Configuration
|--------------------------------------------------------------------------
*/

return array(

    // Aware Model Validation
    'aware' => array(
        'autoloads' => array(
            'map' => array(
                'Aware' => '(:bundle)/model.php'
            )
        )
    ),

    // Requests Library
    'requests' => array(
        'auto' => true
    )

);
