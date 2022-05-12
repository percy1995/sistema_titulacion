<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Persona
    Route::apiResource('personas', 'PersonaApiController');

    // Programa
    Route::apiResource('programas', 'ProgramaApiController');

    // Docente
    Route::post('docentes/media', 'DocenteApiController@storeMedia')->name('docentes.storeMedia');
    Route::apiResource('docentes', 'DocenteApiController');

    // Programa Modular
    Route::apiResource('programa-modulars', 'ProgramaModularApiController');

    // Periodo
    Route::apiResource('periodos', 'PeriodoApiController');

    // Grupo
    Route::apiResource('grupos', 'GrupoApiController');

    // Traplipro
    Route::apiResource('traplipros', 'TrapliproApiController');

    // Alumno
    Route::post('alumnos/media', 'AlumnoApiController@storeMedia')->name('alumnos.storeMedia');
    Route::apiResource('alumnos', 'AlumnoApiController');

    // Monitoreo
    Route::apiResource('monitoreos', 'MonitoreoApiController');
});
