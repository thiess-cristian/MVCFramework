<?php

$routes=[
    '/'=>['controller'=>'CategoriesController',
          'action'    =>'showCategories'],

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

    '/category/{id}'=>['controller'=>'CategoryController',
                       'action'=>'showCategory'],

    '/thread/{id}'=>['controller'=>'ThreadController',
                     'action'=>'showThread'],

    '/post_reply'=>['controller'=>'ThreadController',
                    'action'=>'postReply'],

    '/logout'=>['controller'=>'AccountController',
                'action'=>'logoutUser'],

    '/post_thread'=>['controller'=>'CategoryController',
                     'action'=>'showThreadCreator'],

    '/create_thread'=>['controller'=>'CategoryController',
                        'action'=>'createThread'],

    '/reply'=>['controller'=>'ThreadController',
               'action'=>'addReplyText'],
];