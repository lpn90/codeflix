@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Nova Série')->asLinkTo(route('admin.series.create')) !!}
        </div>
        <div class="row">

            {!! Table::withContents($series->items())->striped()
                ->callback('Ações', function ($field, $serie){
                    $linkEdit = route('admin.series.edit', ['serie' => $serie->id]);
                    $linkShow = route('admin.series.show', ['serie' => $serie->id]);

                    return Button::link(Icon::create('pencil'))->addClass(['text-warning'])->asLinkTo($linkEdit).' '.
                            Button::link(Icon::create('remove'))->addClass(['text-danger'])->asLinkTo($linkShow);
                })
            !!}
        </div>

        {!! $series->links() !!}

    </div>
@endsection

@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(3){
            width: 50%;
        }
    </style>
@endpush