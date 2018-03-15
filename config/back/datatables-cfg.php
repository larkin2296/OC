<?php
    return [
        'basic' => [
            'language' => [
                'url' => '/vendor/datatables/lang/zh_CN.json',
            ],
            'bStateSave' => true,
            'pagingType' => "bootstrap_extended", 
            'autoWidth' => false, 
            'drawCallback' => 'function(){PVJs.tableInit.apply(this,arguments);}',
        ]
    ];