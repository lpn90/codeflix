<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Media\SeriePaths;
use Illuminate\Database\Eloquent\Model;


class Serie extends Model implements TableInterface
{

    use SeriePaths;

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
