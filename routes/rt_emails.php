<?php

Route::group(['prefix' => 'emails'], function(){
    Route::get('inicio', 'EmailsController@index');
    Route::get('send', 'EmailsController@indexSend');
    Route::get('listData', 'EmailsController@listData');             
    Route::get('sendEmails', 'EmailsController@sendEmails');    
});
