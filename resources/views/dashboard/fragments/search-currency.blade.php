<div class="mt-1">
    @foreach ($currencySymbols as $currency)
    <div class="row">
        <div class="col border-bottom py-1">
            {{Str::upper($currency->brokerName)}} - {{$currency->currencySymbol}}
            <a href="#" class="add-user-currency float-end" data-id="{{$currency->currencyId}}"><i class="bi bi-star"></i></a>
        </div>
    </div>
    @endforeach
</div>

<script>
    $(function(){
        $(".bi").hover(function(){
            $(this).removeClass('bi-star')
            $(this).addClass('bi-star-fill')
        }, function() {
            $(this).addClass('bi-star')
            $(this).removeClass('bi-star-fill')
        })
    })
</script>