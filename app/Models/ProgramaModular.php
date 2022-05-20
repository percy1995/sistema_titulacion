<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramaModular extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'programa_modulars';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'programaacademico_id',
        'nombreprograma',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function programaacademico()
    {
        return $this->belongsTo(Programa::class, 'programaacademico_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
