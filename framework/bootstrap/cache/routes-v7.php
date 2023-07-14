<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' =>
  array (
    0 => false,
    1 =>
    array (
      '/api/user' =>
      array (
        0 =>
        array (
          0 =>
          array (
            '_route' => 'generated::TkC2cSowohHD6Zzf',
          ),
          1 => NULL,
          2 =>
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 =>
    array (
    ),
    3 =>
    array (
    ),
    4 => NULL,
  ),
  'attributes' =>
  array (
    'generated::TkC2cSowohHD6Zzf' =>
    array (
      'methods' =>
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user',
      'action' =>
      array (
        'middleware' =>
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Actions\\User\\RegisterUserAction@__invoke',
        'controller' => 'App\\Http\\Actions\\User\\RegisterUserAction',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' =>
        array (
        ),
        'as' => 'generated::TkC2cSowohHD6Zzf',
      ),
      'fallback' => false,
      'defaults' =>
      array (
      ),
      'wheres' =>
      array (
      ),
      'bindingFields' =>
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
