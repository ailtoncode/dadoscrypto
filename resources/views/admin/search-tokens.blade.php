<div>
    @foreach ($tokens as $token)
    <div class="row">
        <div class="col border-bottom">
            {{Str::upper($token->name)}} - {{$token->symbol}}
            <a href="#" class="float-end">adicionar</a>
        </div>
    </div>
    @endforeach
</div>