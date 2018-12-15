<?php

$routes=[
    '/'=>['controller'=>'PageController',
          'action'    =>'indexAction'],

    '/about'=>['controller'=>'PageController',
              'action'     =>'aboutUsAction'],

    '/user/{id}'=>['controller'=>'UserController',
                    'action'   =>'show',],

    '/404'=>['controller'=>'PageController',
                'action'=>'notFound',],

    '/user'=>['controller'=>'UserController',
                'action'=>'show'],

    '/register'=>['controller'=>'PageController',
                'action'=>'showRegister'],

    '/login'=>['controller'=>'PageController',
                'action'=>'showLogin'],

    '/register_user'=>['controller'=>'AccountController',
                        'action'=>'registerUser'],

    '/login_user'=>['controller'=>'AccountController',
                    'action'=>'loginUser'],
];