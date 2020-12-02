<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoUploadForm extends Form
{
    public function buildForm()
    {
        $this->add('thumb', 'file',[
            'required' => false,
            'label' => 'Thumbnail',
            'rules' => 'image|max:10240'
            ])
            ->add('file', 'file',[
                'required' => false,
                'label' => 'Arquivo de Vídeo',
                'rules' => 'mimetypes:video/mp4'  //unique:tabel,campo_a_ser_consultado
            ])
            ;
    }
}
