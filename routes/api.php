<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('/permissions', 'RoleManager@permissionsIndex')
        ->name('permissions.index')
        ->middleware('permission:permission-list');
    
    Route::get('/roles', 'RoleManager@rolesIndex')
        ->name('roles.index')
        ->middleware('permission:role-list');

    Route::get('/roles/{role}/assign/{user}', 'RoleManager@rolesAddUser')
        ->name('roles.addUser')
        ->middleware('permission:role-assign');

    Route::get('/roles/{role}/unassign/{user}', 'RoleManager@rolesRemoveUser')
        ->name('roles.removeUser')
        ->middleware('permission:role-unassign');
    
});