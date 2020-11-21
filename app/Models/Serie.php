<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;


class Serie extends Model implements TableInterface
{

    protected $fillable = ['title','description'];

    /**
     * @inheritDoc
     */
    public function getTableHeaders()
    {
        return ['#', 'Titulo', 'Descrição'];
    }

    /**
     * @inheritDoc
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Titulo':
                return $this->title;
            case 'Descrição':
                return $this->description;
        }
    }
}
