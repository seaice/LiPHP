<?php

$config = array(
    'debug'=>true,
    'import'=>array(
        'model',
        'service',
    ),
    
    'log'=>array(
        // 'multi'=>true,
        'config'=>array(
            // 'name'=>'Y',
            // 'debug'=>false //if no define, use $config debug 
        ),

        // 必须包含default
        // 'config'=>array(
        //     // 'default'=>array(
        //     //     'name'=>'Ymd',
        //     //     'debug'=>true,
        //     // ),
        //     'trade'=>array(
        //         'name'=>'Ymd',
        //         'debug'=>true //if no define, use $config debug 
        //     ),
        // ),
    ),

    // 'session'=>array(
    //     'driver'=>'database',
    //     'config'=>array(
    //         'dbName'=>'default',
    //         'tableName'=>'session',
    //     )
    // ),

    'route'=>array(
        'rules'=>array(
            // 'test'=>'site/haha'
            // 'test/(\d*)'=>'site/index/id/(id)',
            // 'product/(\d*)'=>'product/view/id/$0',
        ),
    ),

    'redis'=>array(
        'default'=>array(
            'ip'=>'127.0.0.1',
            'port'=>'6379',
            'pconnect'=>true,
        ),
        'test'=>array(
            'ip'=>'127.0.0.1',
            'port'=>'63791',
            'pconnect'=>true,
        ),
    ),

    // 'captcha'=>array(
    //     'width'=>200,
    //     'height'=>100,
    //     'fontSize'=>50,
    // ),

);

include("database.php");