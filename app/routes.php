<?php

$routes=[
    '/'=>['controller'=>'PageController',
          'action'    =>'indexAction'],

    '/about'=>['controller'=>'PageController',
              'action'     =>'aboutUsAction'],

    '/user/{id}'=>['controller'=>'PageController',
                    'action'   =>'userAction',
                    'guard'    =>'Authenticated'],
    '/404'=>['controller'=>'PageController',
                'action'=>'notFound',],
];