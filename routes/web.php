<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

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
    Route::resource('users', 'UsersController');

    // Persona
    Route::delete('personas/destroy', 'PersonaController@massDestroy')->name('personas.massDestroy');
    Route::resource('personas', 'PersonaController');

    // Programa
    Route::delete('programas/destroy', 'ProgramaController@massDestroy')->name('programas.massDestroy');
    Route::resource('programas', 'ProgramaController');

    // Docente
    Route::delete('docentes/destroy', 'DocenteController@massDestroy')->name('docentes.massDestroy');
    Route::post('docentes/media', 'DocenteController@storeMedia')->name('docentes.storeMedia');
    Route::post('docentes/ckmedia', 'DocenteController@storeCKEditorImages')->name('docentes.storeCKEditorImages');
    Route::resource('docentes', 'DocenteController');

    // Programa Modular
    Route::delete('programa-modulars/destroy', 'ProgramaModularController@massDestroy')->name('programa-modulars.massDestroy');
    Route::resource('programa-modulars', 'ProgramaModularController');

    // Periodo
    Route::delete('periodos/destroy', 'PeriodoController@massDestroy')->name('periodos.massDestroy');
    Route::resource('periodos', 'PeriodoController');

    // Grupo
    Route::delete('grupos/destroy', 'GrupoController@massDestroy')->name('grupos.massDestroy');
    Route::resource('grupos', 'GrupoController');

    // Traplipro
    Route::delete('traplipros/destroy', 'TrapliproController@massDestroy')->name('traplipros.massDestroy');
    Route::resource('traplipros', 'TrapliproController');

    // Alumno
    Route::delete('alumnos/destroy', 'AlumnoController@massDestroy')->name('alumnos.massDestroy');
    Route::post('alumnos/media', 'AlumnoController@storeMedia')->name('alumnos.storeMedia');
    Route::post('alumnos/ckmedia', 'AlumnoController@storeCKEditorImages')->name('alumnos.storeCKEditorImages');
    Route::resource('alumnos', 'AlumnoController');

    // Monitoreo
    Route::delete('monitoreos/destroy', 'MonitoreoController@massDestroy')->name('monitoreos.massDestroy');
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
