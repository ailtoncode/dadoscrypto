@extends('site.layout')
@section('title', 'Adicionat tokens')

@section('content')
    <h3>Adicionar Token</h3>
    <form method="GET" style="max-width: 450px">
    <div class="row mb-2">
        <div class="col" id="message" style="display: none">mensagem</div>
    </div>
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Nome token" name="symbolSearch" id="symbolSearch">
                <label for="symbolSearch">Nome Token</label>
            </div>
        </div>
    </div>
    <div id="viewListTokens">
    </div>
    </form>
@endsection

@section('script')
<script>
    $(function(){
        let term = ""
        let inputSearch = $("#symbolSearch")
        let viewListTokens = $("#viewListTokens")
        inputSearch.keyup(function(){
            if(inputSearch.val() == ""){
                viewListTokens.html('')
                return
            }

            let url = "{{route('dashboard.get.tokens')}}"
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
                        viewListTokens.html(data.searchResult)
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
            let url = "{{route('dashboard.store.tokens')}}"
            $.ajax({
                method: "GET",
                url: url,
                data: { currencyId: data.id },
                dataType: 'json',
                beforeSend: function(){
                    console.log('add token ajax')
                },
                success: function(data){
                    if(data.success) {
                        let message = $("#message")
                        // message.removeClass('message-error')
                        // message.addClass('message-success')
                        message.html(data.message)
                        message.fadeIn('slow', function() {
                            setTimeout(() => {
                                message.fadeOut('slow')
                            }, 1500);
                        })
                    }

                    if(data.error) {
                        let message = $("#message")
                        // message.removeClass('message-success')
                        // message.addClass('message-error')
                        message.html(data.message)
                        message.fadeIn('slow', function() {
                            setTimeout(() => {
                                message.fadeOut('slow')
                            }, 1500);
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
