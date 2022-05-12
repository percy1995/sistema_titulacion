<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traplipro extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const C_1_RADIO = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
    ];

    public const C_2_RADIO = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
    ];

    public const C_3_RADIO = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
    ];

    public const C_4_RADIO = [
        '1' => '2',
        '2' => '2',
        '3' => '3',
        '4' => '4',
    ];

    public $table = 'traplipros';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'nota',
        'programaacademico_id',
        'programamodular_id',
        'grupo_id',
        'docente_id',
        'c_1',
        'c_2',
        'c_3',
        'c_4',
        'ob_1',
        'ob_2',
        'ob_3',
        'ob_4',
        'presupuesto',
        'conclusiones',
        'estado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function programaacademico()
    {
        return $this->belongsTo(ProgramaModular::class, 'programaacademico_id');
    }

    public function programamodular()
    {
        return $this->belongsTo(ProgramaModular::class, 'programamodular_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
