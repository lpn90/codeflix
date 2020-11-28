<?php

$tabs = [
    [
        'title' => 'Informações',
        'link'  => ''
    ],
    [
        'title' => 'Série e Categorias',
        'link'  => ''
    ],
    [
        'title' => 'Vídeo e Thumbnail',
        'link'  => ''
    ],
];
?>
<h3>Gerenciar Vídeo</h3>
<div class="text-right">
    {!! Button::link('Listar Vídeos')->asLinkto(route('admin.videos.index')) !!}
</div>
{!! Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>