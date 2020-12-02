@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @component('admin.videos.tabs-component', ['video' => $form->getModel()])
                <div class="col-md-12"></div>
                <h4>Thumbnail e Arquivo de Vídeo</h4>
                <?php $icon = Icon::create('pencil');?>
                {!!
                    form($form->add('salve', 'submit', [
                        'attr' => ['class' => 'btn btn-primary btn-block'],
                        'label' => $icon
                    ]))
                !!}
            @endcomponent
        </div>
    </div>
@endsection