<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'persona_create',
            ],
            [
                'id'    => 18,
                'title' => 'persona_edit',
            ],
            [
                'id'    => 19,
                'title' => 'persona_show',
            ],
            [
                'id'    => 20,
                'title' => 'persona_delete',
            ],
            [
                'id'    => 21,
                'title' => 'persona_access',
            ],
            [
                'id'    => 22,
                'title' => 'instituto_access',
            ],
            [
                'id'    => 23,
                'title' => 'programa_create',
            ],
            [
                'id'    => 24,
                'title' => 'programa_edit',
            ],
            [
                'id'    => 25,
                'title' => 'programa_show',
            ],
            [
                'id'    => 26,
                'title' => 'programa_delete',
            ],
            [
                'id'    => 27,
                'title' => 'programa_access',
            ],
            [
                'id'    => 28,
                'title' => 'docente_create',
            ],
            [
                'id'    => 29,
                'title' => 'docente_edit',
            ],
            [
                'id'    => 30,
                'title' => 'docente_show',
            ],
            [
                'id'    => 31,
                'title' => 'docente_delete',
            ],
            [
                'id'    => 32,
                'title' => 'docente_access',
            ],
            [
                'id'    => 33,
                'title' => 'programa_modular_create',
            ],
            [
                'id'    => 34,
                'title' => 'programa_modular_edit',
            ],
            [
                'id'    => 35,
                'title' => 'programa_modular_show',
            ],
            [
                'id'    => 36,
                'title' => 'programa_modular_delete',
            ],
            [
                'id'    => 37,
                'title' => 'programa_modular_access',
            ],
            [
                'id'    => 38,
                'title' => 'periodo_create',
            ],
            [
                'id'    => 39,
                'title' => 'periodo_edit',
            ],
            [
                'id'    => 40,
                'title' => 'periodo_show',
            ],
            [
                'id'    => 41,
                'title' => 'periodo_delete',
            ],
            [
                'id'    => 42,
                'title' => 'periodo_access',
            ],
            [
                'id'    => 43,
                'title' => 'grupo_create',
            ],
            [
                'id'    => 44,
                'title' => 'grupo_edit',
            ],
            [
                'id'    => 45,
                'title' => 'grupo_show',
            ],
            [
                'id'    => 46,
                'title' => 'grupo_delete',
            ],
            [
                'id'    => 47,
                'title' => 'grupo_access',
            ],
            [
                'id'    => 48,
                'title' => 'titulacion_access',
            ],
            [
                'id'    => 49,
                'title' => 'traplipro_create',
            ],
            [
                'id'    => 50,
                'title' => 'traplipro_edit',
            ],
            [
                'id'    => 51,
                'title' => 'traplipro_show',
            ],
            [
                'id'    => 52,
                'title' => 'traplipro_delete',
            ],
            [
                'id'    => 53,
                'title' => 'traplipro_access',
            ],
            [
                'id'    => 54,
                'title' => 'alumno_create',
            ],
            [
                'id'    => 55,
                'title' => 'alumno_edit',
            ],
            [
                'id'    => 56,
                'title' => 'alumno_show',
            ],
            [
                'id'    => 57,
                'title' => 'alumno_delete',
            ],
            [
                'id'    => 58,
                'title' => 'alumno_access',
            ],
            [
                'id'    => 59,
                'title' => 'monitoreo_create',
            ],
            [
                'id'    => 60,
                'title' => 'monitoreo_edit',
            ],
            [
                'id'    => 61,
                'title' => 'monitoreo_show',
            ],
            [
                'id'    => 62,
                'title' => 'monitoreo_delete',
            ],
            [
                'id'    => 63,
                'title' => 'monitoreo_access',
            ],
            [
                'id'    => 64,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 65,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 66,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 67,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 68,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 69,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 70,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 71,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 72,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 73,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 74,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 75,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 76,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 77,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 78,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 79,
                'title' => 'task_create',
            ],
            [
                'id'    => 80,
                'title' => 'task_edit',
            ],
            [
                'id'    => 81,
                'title' => 'task_show',
            ],
            [
                'id'    => 82,
                'title' => 'task_delete',
            ],
            [
                'id'    => 83,
                'title' => 'task_access',
            ],
            [
                'id'    => 84,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 85,
                'title' => 'titulacion_ex_access',
            ],
            [
                'id'    => 86,
                'title' => 'examen_sp_create',
            ],
            [
                'id'    => 87,
                'title' => 'examen_sp_edit',
            ],
            [
                'id'    => 88,
                'title' => 'examen_sp_show',
            ],
            [
                'id'    => 89,
                'title' => 'examen_sp_delete',
            ],
            [
                'id'    => 90,
                'title' => 'examen_sp_access',
            ],
            [
                'id'    => 91,
                'title' => 'trabajo_practico_create',
            ],
            [
                'id'    => 92,
                'title' => 'trabajo_practico_edit',
            ],
            [
                'id'    => 93,
                'title' => 'trabajo_practico_show',
            ],
            [
                'id'    => 94,
                'title' => 'trabajo_practico_delete',
            ],
            [
                'id'    => 95,
                'title' => 'trabajo_practico_access',
            ],
            [
                'id'    => 96,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
