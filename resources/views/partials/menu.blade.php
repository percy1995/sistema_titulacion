<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/personas*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('persona_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.personas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/personas") || request()->is("admin/personas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.persona.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('instituto_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/programas*") ? "c-show" : "" }} {{ request()->is("admin/programa-modulars*") ? "c-show" : "" }} {{ request()->is("admin/docentes*") ? "c-show" : "" }} {{ request()->is("admin/periodos*") ? "c-show" : "" }} {{ request()->is("admin/alumnos*") ? "c-show" : "" }} {{ request()->is("admin/grupos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-university c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.instituto.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('programa_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.programas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/programas") || request()->is("admin/programas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.programa.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('programa_modular_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.programa-modulars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/programa-modulars") || request()->is("admin/programa-modulars/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-bookmark c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.programaModular.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('docente_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.docentes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/docentes") || request()->is("admin/docentes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.docente.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('periodo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.periodos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/periodos") || request()->is("admin/periodos/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.periodo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('alumno_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.alumnos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/alumnos") || request()->is("admin/alumnos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.alumno.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('grupo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.grupos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/grupos") || request()->is("admin/grupos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.grupo.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('titulacion_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/traplipros*") ? "c-show" : "" }} {{ request()->is("admin/monitoreos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.titulacion.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('traplipro_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.traplipros.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/traplipros") || request()->is("admin/traplipros/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-sticky-note c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.traplipro.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('monitoreo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.monitoreos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/monitoreos") || request()->is("admin/monitoreos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-pie c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.monitoreo.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('titulacion_ex_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/examen-sps*") ? "c-show" : "" }} {{ request()->is("admin/trabajo-practicos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-pen-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.titulacionEx.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('examen_sp_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.examen-sps.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/examen-sps") || request()->is("admin/examen-sps/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-sticky-note c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.examenSp.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('trabajo_practico_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.trabajo-practicos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/trabajo-practicos") || request()->is("admin/trabajo-practicos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bookmark c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.trabajoPractico.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>