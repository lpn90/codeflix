<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TableInterface
{

    protected $fillable = ['name'];

    /**
     * @inheritDoc
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome'];
    }

    /**
     * @inheritDoc
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
        }
    }

    public function videos(){
        return $this->belongsToMany(Video::class);
    }
}
