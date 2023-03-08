@extends('site.layout')
@section('title', 'Adicionat tokens')

@section('content')
    <h3>Adicionar Moeda</h3>
    <form method="GET" style="max-width: 450px">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row mb-2">
        <div class="col" id="message" style="display: none">mensagem</div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Nome token" name="symbolSearch" id="symbolSearch">
                <label for="symbolSearch">Nome Token</label>
            </div>
        </div>
    </div>
    <div id="viewListCurrency">
    </div>
    </form>
@endsection

@section('script')
<script>
    $(function(){
        let term = ""
        let inputSearch = $("#symbolSearch")
        let viewListCurrency = $("#viewListCurrency")
        inputSearch.keyup(function(){
            if(inputSearch.val() == ""){
                viewListCurrency.html('')
                return
            }

            let url = "{{route('dashboard.currency.get')}}"
            $.ajax({
                method: "GET",
                url: url,
                data: { term: inputSearch.val() },
                dataType: 'json',
                beforeSend: function(){
                    console.log('search ajax')
                },
                success: function(data){
                    console.log(data.searchResult)
                    if(data.searchResult) {
                        viewListCurrency.html(data.searchResult)
                    }
                },
                error: function(erro) {
                    console.log(erro);
                }
            })
        })

        //add tokens
        $(document).on("click", ".add-user-currency", function(){
            let data = $(this).data()
            let currencySelected = $(this).parent()
            let url = "{{route('dashboard.currency.store')}}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: url,
                data: { currencyId: data.id },
                dataType: 'json',
                beforeSend: function(){
                    console.log('add token ajax')
                },
                success: function(data){
                    if(data.success) {
                        let message = $("#message")
                        message.html(data.message)
                        currencySelected.fadeOut('slow')
                        message.fadeIn('slow', function() {
                            setTimeout(() => {
                                message.fadeOut('slow')
                            }, 3000);
                        })
                    }

                    if(data.error) {
                        let message = $("#message")
                        message.html(data.message)
                        message.fadeIn('slow', function() {
                            setTimeout(() => {
                                message.fadeOut('slow')
                            }, 3000);
                        })
                    }
                },
                error: function(erro) {
                    console.log(erro);
                }
            })
        })
    });
</script>
@endsection
