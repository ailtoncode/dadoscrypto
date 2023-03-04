<div class="mt-1">
    @foreach ($tokens as $token)
    <div class="row">
        <div class="col border-bottom py-1">
            {{Str::upper($token->brokerName)}} - {{$token->currencySymbol}}
            <a href="#" class="token-add float-end" data-id="{{$token->currencyId}}">adicionar</a>
        </div>
    </div>
    @endforeach
</div>
