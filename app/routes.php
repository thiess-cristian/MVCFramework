<?php

$routes=[
    '/'=>['controller'=>'CategoriesController',
          'action'    =>'showCategories'],


    '/user/{id}'=>['controller'=>'UserController',
                    'action'   =>'show',],

    '/404'=>['controller'=>'IndexController',
                'action'=>'notFound',],

    '/user'=>['controller'=>'UserController',
                'action'=>'show'],

    '/register'=>['controller'=>'IndexController',
                'action'=>'showRegister'],

    '/login'=>['controller'=>'IndexController',
                'action'=>'showLogin'],

    '/register_user'=>['controller'=>'AccountController',
                        'action'=>'registerUser'],

    '/login_user'=>['controller'=>'AccountController',
                    'action'=>'loginUser',
                    'guard'=>'FormGuard'],

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

    '/user_page/{id}'=>['controller'=>'UserPageController',
                        'action'=>'showUserPage'],

    '/thread/delete_post'=>['controller'=>'ThreadController',
                        'action'=>'deletePost'],

    '/thread/delete_thread'=>['controller'=>'ThreadController',
                            'action'=>'deleteThread'],

    '/thread/report_post'=>['controller'=>'ThreadController',
                            'action'=>'reportPost'],

    '/thread/vote_post'=>['controller'=>'ThreadController',
                            'action'=>'votePost'],

];