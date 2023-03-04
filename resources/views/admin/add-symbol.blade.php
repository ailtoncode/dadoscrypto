@extends('site.layout')
@section('title', 'Login')

@section('content')
    <form action="}" method="POST" style="max-width: 450px">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Nome token" name="symbolSearch" id="symbolSearch">
                <label for="symbolSearch">Nome Token</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection

@section('script')
<script>
    $(function(){
        let term = ""
        let inputSearch = $("#symbolSearch")
        inputSearch.keydown(function(){
            let url = "{{route('admin.get.tokens')}}"
            $.ajax({
                method: "GET",
                url: url,
                data: { name: "John", location: "Boston" },
                dataType: 'json',
                beforeSend: function(){
                    console.log('search ajax')
                },
                success: function(data){
                    console.log(data)
                },
                error: function(erro) {
                    console.log(erro);
                }
            })
        })
    });
</script>
@endsection
