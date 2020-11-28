<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationsForm extends Form
{
    public function buildForm()
    {
        $this->add('categories', 'entity',[
            'class' => Category::class,
            'property' => 'name',
            'selected' => $this->model ? $this->model->categories->pluck('id')->toArray() : null,
            'multiple' => true,
            'attr' => [
                'name' => 'categories[]'
            ],
            'label' => 'Categorias'
        ])
            ->add('series_id', 'entity',[
                'class' => Serie::class,
                'property' => 'title',
                'empty_value' => 'Selecione a Série',
                'label' => 'Série'
            ]);
    }
}
