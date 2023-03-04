@extends('site.layout')
@section('title', 'Login')

@section('content')
    <h3>Adicionar Token</h3>
    <form method="GET" style="max-width: 450px">
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
            
            let url = "{{route('admin.get.tokens')}}"
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
    });
</script>
@endsection
