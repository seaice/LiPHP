<?php

$config = array(

    'import'=>array(
        'model',
        'service',
    ),
    
    'database'=>array(

    ),

    'log'=>array(
        ''
    ),

    'route'=>array(
        'rules'=>array(
            // 'test'=>'site/haha'
            // 'test/(\d*)'=>'site/index/id/(id)',
            // 'product/(\d*)'=>'product/view/id/$0',
        ),
    ),
);

include("database.php");