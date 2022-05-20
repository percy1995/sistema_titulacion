<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Persona
    Route::delete('personas/destroy', 'PersonaController@massDestroy')->name('personas.massDestroy');
    Route::post('personas/parse-csv-import', 'PersonaController@parseCsvImport')->name('personas.parseCsvImport');
    Route::post('personas/process-csv-import', 'PersonaController@processCsvImport')->name('personas.processCsvImport');
    Route::resource('personas', 'PersonaController');

    // Programa
    Route::delete('programas/destroy', 'ProgramaController@massDestroy')->name('programas.massDestroy');
    Route::post('programas/parse-csv-import', 'ProgramaController@parseCsvImport')->name('programas.parseCsvImport');
    Route::post('programas/process-csv-import', 'ProgramaController@processCsvImport')->name('programas.processCsvImport');
    Route::resource('programas', 'ProgramaController');

    // Docente
    Route::delete('docentes/destroy', 'DocenteController@massDestroy')->name('docentes.massDestroy');
    Route::post('docentes/media', 'DocenteController@storeMedia')->name('docentes.storeMedia');
    Route::post('docentes/ckmedia', 'DocenteController@storeCKEditorImages')->name('docentes.storeCKEditorImages');
    Route::post('docentes/parse-csv-import', 'DocenteController@parseCsvImport')->name('docentes.parseCsvImport');
    Route::post('docentes/process-csv-import', 'DocenteController@processCsvImport')->name('docentes.processCsvImport');
    Route::resource('docentes', 'DocenteController');

    // Programa Modular
    Route::delete('programa-modulars/destroy', 'ProgramaModularController@massDestroy')->name('programa-modulars.massDestroy');
    Route::post('programa-modulars/parse-csv-import', 'ProgramaModularController@parseCsvImport')->name('programa-modulars.parseCsvImport');
    Route::post('programa-modulars/process-csv-import', 'ProgramaModularController@processCsvImport')->name('programa-modulars.processCsvImport');
    Route::resource('programa-modulars', 'ProgramaModularController');

    // Periodo
    Route::delete('periodos/destroy', 'PeriodoController@massDestroy')->name('periodos.massDestroy');
    Route::resource('periodos', 'PeriodoController');

    // Grupo
    Route::delete('grupos/destroy', 'GrupoController@massDestroy')->name('grupos.massDestroy');
    Route::post('grupos/parse-csv-import', 'GrupoController@parseCsvImport')->name('grupos.parseCsvImport');
    Route::post('grupos/process-csv-import', 'GrupoController@processCsvImport')->name('grupos.processCsvImport');
    Route::resource('grupos', 'GrupoController');

    // Traplipro
    Route::delete('traplipros/destroy', 'TrapliproController@massDestroy')->name('traplipros.massDestroy');
    Route::post('traplipros/parse-csv-import', 'TrapliproController@parseCsvImport')->name('traplipros.parseCsvImport');
    Route::post('traplipros/process-csv-import', 'TrapliproController@processCsvImport')->name('traplipros.processCsvImport');
    Route::resource('traplipros', 'TrapliproController');

    // Alumno
    Route::delete('alumnos/destroy', 'AlumnoController@massDestroy')->name('alumnos.massDestroy');
    Route::post('alumnos/media', 'AlumnoController@storeMedia')->name('alumnos.storeMedia');
    Route::post('alumnos/ckmedia', 'AlumnoController@storeCKEditorImages')->name('alumnos.storeCKEditorImages');
    Route::resource('alumnos', 'AlumnoController');

    // Monitoreo
    Route::delete('monitoreos/destroy', 'MonitoreoController@massDestroy')->name('monitoreos.massDestroy');
    Route::post('monitoreos/media', 'MonitoreoController@storeMedia')->name('monitoreos.storeMedia');
    Route::post('monitoreos/ckmedia', 'MonitoreoController@storeCKEditorImages')->name('monitoreos.storeCKEditorImages');
    Route::post('monitoreos/parse-csv-import', 'MonitoreoController@parseCsvImport')->name('monitoreos.parseCsvImport');
    Route::post('monitoreos/process-csv-import', 'MonitoreoController@processCsvImport')->name('monitoreos.processCsvImport');
    Route::resource('monitoreos', 'MonitoreoController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Examen Sp
    Route::delete('examen-sps/destroy', 'ExamenSpController@massDestroy')->name('examen-sps.massDestroy');
    Route::post('examen-sps/media', 'ExamenSpController@storeMedia')->name('examen-sps.storeMedia');
    Route::post('examen-sps/ckmedia', 'ExamenSpController@storeCKEditorImages')->name('examen-sps.storeCKEditorImages');
    Route::post('examen-sps/parse-csv-import', 'ExamenSpController@parseCsvImport')->name('examen-sps.parseCsvImport');
    Route::post('examen-sps/process-csv-import', 'ExamenSpController@processCsvImport')->name('examen-sps.processCsvImport');
    Route::resource('examen-sps', 'ExamenSpController');

    // Trabajo Practico
    Route::delete('trabajo-practicos/destroy', 'TrabajoPracticoController@massDestroy')->name('trabajo-practicos.massDestroy');
    Route::post('trabajo-practicos/media', 'TrabajoPracticoController@storeMedia')->name('trabajo-practicos.storeMedia');
    Route::post('trabajo-practicos/ckmedia', 'TrabajoPracticoController@storeCKEditorImages')->name('trabajo-practicos.storeCKEditorImages');
    Route::post('trabajo-practicos/parse-csv-import', 'TrabajoPracticoController@parseCsvImport')->name('trabajo-practicos.parseCsvImport');
    Route::post('trabajo-practicos/process-csv-import', 'TrabajoPracticoController@processCsvImport')->name('trabajo-practicos.processCsvImport');
    Route::resource('trabajo-practicos', 'TrabajoPracticoController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
