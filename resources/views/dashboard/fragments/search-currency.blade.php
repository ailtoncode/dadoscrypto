<div class="mt-1">
    @foreach ($currencySymbols as $currency)
    <div class="row">
        <div class="col border-bottom py-1">
            {{Str::upper($currency->brokerName)}} - {{$currency->currencySymbol}}
            <a href="#" class="add-user-currency float-end" data-id="{{$currency->currencyId}}">adicionar</a>
        </div>
    </div>
    @endforeach
</div>
