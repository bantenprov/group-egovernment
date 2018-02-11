<?php

Route::group(['prefix' => 'api/group-egovernment', 'middleware' => ['web']], function() {

    $controllers = (object) [
        'index'     => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@index',
        'create'     => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@create',
        'store'     => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@store',
        'show'      => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@show',
        'update'    => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@update',
        'destroy'   => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@destroy',
    ];

    Route::get('/',$controllers->index)->name('group-egovernment.index');
    Route::get('/create',$controllers->create)->name('group-egovernment.create');
    Route::post('/store',$controllers->store)->name('group-egovernment.store');
    Route::get('/{id}',$controllers->show)->name('group-egovernment.show');
    Route::put('/{id}/update',$controllers->update)->name('group-egovernment.update');
    Route::post('/{id}/delete',$controllers->destroy)->name('group-egovernment.destroy');

});

