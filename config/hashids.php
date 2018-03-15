<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [
        'main' => [
            'salt' => 'main',
            'length' => '6',
        ],

        'user' => [
            'salt' => 'user',
            'length' => '6',
        ],

        'role' => [
            'salt' => 'role',
            'length' => '6',
        ],

        'permission' => [
            'salt' => 'permission',
            'length' => '6',
        ],

        'menu' => [
            'salt' => 'menu',
            'length' => '6',
        ],

        'company' => [
            'salt' => 'company',
            'length' => '6',
        ],

        'recursiverelation' => [
            'salt' => 'recursiverelation',
            'length' => '6',
        ],

        'drug' => [
            'salt' => 'drug',
            'length' => '6',
        ],
        'workflow' => [
            'salt' => 'workflow',
            'length' => '6',
        ],

        'workflownode' => [
            'salt' => 'workflownode',
            'length' => '6',
        ],

        'reportmainpage' => [
            'salt' => 'reportmainpage',
            'length' => '6',
        ],

        'reporttask' => [
            'salt' => 'reporttask',
            'length' => '6',
        ],
        
        'reporttab' => [
            'salt' => 'reporttab',
            'length' => '6',
        ],
        
        'regulation' => [
            'salt' => 'regulation',
            'length' => '6',
        ],

        'category' => [
            'salt' => 'category',
            'length' => '6',
        ],

        'source' => [
            'salt' => 'source',
            'length' => '6',
        ],

        /*附件*/
        'attachment' => [
            'salt' => 'attachment',
            'length' => '6',
        ],

        'logistics' => [
            'salt' => 'logistics',
            'length' => '6',
        ],


    ],

];
