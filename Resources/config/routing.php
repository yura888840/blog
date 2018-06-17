<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 13:04
 */

return [
    '/' => [
        'BlogEntry',
        'list'
    ],
    '/login' => [
        'Login',
        'login'
    ],
    '/logout' => [
        'Login',
        'logout'
    ],
    '/blog/add' => [
        'BlogEntry',
        'add'
    ],
    '/blog/list' => [
        'BlogEntry',
        'list'
    ],
    '/blog/detail' => [
        'BlogEntry',
        'detail',
        'parameters' => [
            'id'
        ],
        'alias' => '/blog/detail/{id}'
    ],
    '/imprint' => [
        'imprint',
        'index'
    ],
];