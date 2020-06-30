<?php

return [
    [
        'route' => '/',
        'controller' => 'Dashboard',
        'action' => 'main',
        'methods' => [
            'GET',
        ]
    ],

    // Some other route examples
    /*[
        'route' => '/foo/:id/bar/:other_id',
        'controller' => 'Foo',
        'action' => 'baz',
        'methods' => [
            'GET',
        ]
    ],
    [
        'route' => '/foo',
        'controller' => 'Foo',
        'action' => 'save',
        'methods' => [
            'POST',
        ]
    ],
    [
        'route' => '/bar/:id/baz',
        'controller' => 'Bar',
        'action' => 'foo',
        'methods' => [
            'GET',
        ]
    ],
    [
        'route' => '/bar/more-bar',
        'controller' => 'Bar',
        'action' => 'update',
        'methods' => [
            'PUT',
        ]
    ]*/
];