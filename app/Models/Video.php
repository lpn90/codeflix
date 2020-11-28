<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'published',
        'series_id'
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
