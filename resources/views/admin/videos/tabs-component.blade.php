<?php

$tabs = [
    [
        'title' => 'Informações',
        'link'  => !isset($video)?route('admin.videos.create') : route('admin.videos.edit', ['video' => $video->id])
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