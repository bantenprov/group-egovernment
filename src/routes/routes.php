<?php

Route::group(['prefix' => 'api/group-egovernment', 'middleware' => ['web']], function() {
    $controllers = (object) [
        'index'     => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@index',
        'create'    => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@create',
        'show'      => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@show',
        'store'     => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@store',
        'edit'      => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@edit',
        'update'    => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@update',
        'destroy'   => 'Bantenprov\GroupEgovernment\Http\Controllers\GroupEgovernmentController@destroy',
    ];

    Route::get('/',             $controllers->index)->name('group-egovernment.index');
    Route::get('/create',       $controllers->create)->name('group-egovernment.create');
    Route::get('/{id}',         $controllers->show)->name('group-egovernment.show');
    Route::post('/',            $controllers->store)->name('group-egovernment.store');
    Route::get('/{id}/edit',    $controllers->edit)->name('group-egovernment.edit');
    Route::put('/{id}',         $controllers->update)->name('group-egovernment.update');
    Route::delete('/{id}',      $controllers->destroy)->name('group-egovernment.destroy');
});

