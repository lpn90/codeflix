<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Media\VideoPaths;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable, TableInterface
{
    use TransformableTrait, VideoPaths, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'published',
        'series_id'
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    public function series(){
        return $this->belongsTo(Serie::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#'];
    }

    /**
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
                break;
        }
    }
}
