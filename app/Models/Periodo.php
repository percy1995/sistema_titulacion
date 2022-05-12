<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'periodos';

    protected $dates = [
        'fechainicio',
        'fechafin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'periodo',
        'fechainicio',
        'fechafin',
        'modo',
        'estado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getFechainicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechainicioAttribute($value)
    {
        $this->attributes['fechainicio'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFechafinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechafinAttribute($value)
    {
        $this->attributes['fechafin'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
