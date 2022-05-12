<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'grupos';

    protected $dates = [
        'horafin',
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
        'estado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getHorafinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHorafinAttribute($value)
    {
        $this->attributes['horafin'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

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
