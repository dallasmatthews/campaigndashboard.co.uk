<?php namespace Dashboard\Auth;

use Route, View;


// Session Routes
Route::group(array(
    'prefix' => 'app', 
    'namespace' => 'Dashboard\Auth',
    ), 
    function()
    {
        // Route::get('login',  function(){return 'yes';});
        Route::get('login',  array('as' => 'login', 'uses' => 'SessionController@create'));
        Route::get('logout', array('as' => 'logout', 'uses' => 'SessionController@destroy'));
        Route::resource('sessions', 'SessionController', array('only' => array('create', 'store', 'destroy')));
    }
);

