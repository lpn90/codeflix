<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255'
            ])
            ->add('email', 'email',[
                'label' => 'E-mail',
                'rules' => 'required|max:255|email|unique:users,email' //unique:tabel,campo_a_ser_consultado
            ]);
    }
}
