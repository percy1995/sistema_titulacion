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
    Route::post('monitoreos/media', 'MonitoreoApiController@storeMedia')->name('monitoreos.storeMedia');
    Route::apiResource('monitoreos', 'MonitoreoApiController');

    // Examen Sp
    Route::post('examen-sps/media', 'ExamenSpApiController@storeMedia')->name('examen-sps.storeMedia');
    Route::apiResource('examen-sps', 'ExamenSpApiController');

    // Trabajo Practico
    Route::post('trabajo-practicos/media', 'TrabajoPracticoApiController@storeMedia')->name('trabajo-practicos.storeMedia');
    Route::apiResource('trabajo-practicos', 'TrabajoPracticoApiController');
});
