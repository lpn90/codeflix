<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Media\SeriePaths;
use Illuminate\Database\Eloquent\Model;


class Serie extends Model implements TableInterface
{

    use SeriePaths;


    protected $fillable = ['title', 'description', 'thumb'];

    /**
     * @inheritDoc
     */
    public function getTableHeaders()
    {
        return ['#', 'Descrição'];
    }

    /**
     * @inheritDoc
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
        }
    }
}
