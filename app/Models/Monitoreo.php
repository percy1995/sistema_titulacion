<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Monitoreo extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'monitoreos';

    protected $appends = [
        'archivo',
    ];

    protected $dates = [
        'fechaasesoria',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'grupo_id',
        'docente_id',
        'traplipro_id',
        'fechaasesoria',
        'horainicio',
        'horafin',
        'observacion',
        'estado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    public function traplipro()
    {
        return $this->belongsTo(Traplipro::class, 'traplipro_id');
    }

    public function getFechaasesoriaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaasesoriaAttribute($value)
    {
        $this->attributes['fechaasesoria'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getArchivoAttribute()
    {
        return $this->getMedia('archivo');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
