@extends('site.layout')
@section('title', 'Show')

@section('content')
<h3 class="mx-3 mt-2 fw-semibold fs-6">{{Str::ucfirst($history->brokerName)}}/{{Str::upper($history->symbol)}}</h3>
<div class="history">
    <div class="grid-container">
        <div class="grid-item grid-large fw-semibold">
            Data/Hora
        </div>
        <div class="grid-item grid-large fw-semibold">
            Preço
        </div>
        <div class="grid-item grid-large fw-semibold">
            Maximo
        </div>
        <div class="grid-item grid-large fw-semibold">
            Minimo
        </div>
        <div class="grid-item grid-large fw-semibold">
            Variação
        </div>
        <div class="grid-item grid-large fw-semibold">
            Variação %
        </div>
        <div class="grid-item grid-large fw-semibold">
            Volume
        </div>
    </div>
    @foreach ($history->dataJson as $item)
     @include('dashboard.fragments.history-grid', compact('item'))
    @endforeach
    <div id="viewLoadMore"></div>
    <a href="#" id="loadMore">Carregar mais</a>
</div>
@endsection

@section('script')
<script>
    $(function(){
        $("#showCollapse").click(function(){
            $('#collapseExample').collapse('show')
        })

        $("#loadMore").click(function() {
            let offset = $(".offset").last().val()
            offset += 25
            $.ajax({
                method: "GET",
                url: 'http://exchange.test/{{$history->brokerName}}/currency/{{Str::lower($history->symbol)}}/more/' + offset,
                dataType: 'json',
                beforeSend: function(){
                    console.log('request ...')
                },
                success: function(data){
                    console.log('success ..')
                    if(!data.error) {
                        $("#viewLoadMore").append(data)
                    }

                    if(data.error) {
                        $("#loadMore").remove()
                    }
                },
                error: function(erro) {
                    console.log('erro ...');
                }
            })
        })
    });
</script>
@endsection
