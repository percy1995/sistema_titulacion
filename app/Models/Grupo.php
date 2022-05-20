<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TIPO_SELECT = [
        'Presencial' => 'Presencial',
        'Virtual'    => 'Virtual',
    ];

    public const TIPOSUSTENTACION_SELECT = [
        '1' => 'Trabajo de Aplicación profesional',
        '2' => 'Examen de Suficiencia',
    ];

    public const DIA_SELECT = [
        'Lunes'     => 'Lunes',
        'Martes'    => 'Martes',
        'Miercoles' => 'Miercoles',
        'Jueves'    => 'Jueves',
        'Viernes'   => 'Viernes',
        'Sabado'    => 'Sabado',
        'Domingo'   => 'Domingo',
    ];

    public $table = 'grupos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'dia',
        'horainicio',
        'horafin',
        'tipo',
        'aula',
        'periodo_id',
        'docente_id',
        'programaestudio_id',
        'tiposustentacion',
        'estado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    public function programaestudio()
    {
        return $this->belongsTo(Programa::class, 'programaestudio_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
