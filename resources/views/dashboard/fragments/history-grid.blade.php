@php
    $variationColor = $item->variation < 0 ? 'text-danger' : 'text-success';
    $variationPercentColor = $item->variation_percent < 0 ? 'text-danger' : 'text-success';
@endphp
<div class="history-grid">
        <div class="grid-container">
            <div class="grid-item grid-large">
                {{$item->dateTime}}
            </div>
            <div class="grid-item grid-large">
                {{$item->price}}
            </div>
            <div class="grid-item grid-large">
                {{$item->maximum}}
            </div>
            <div class="grid-item grid-large">
                {{$item->minimum}}
            </div>
            <div class="grid-item grid-large {{$variationColor}}">
                {{$item->variation}}
            </div>
            <div class="grid-item grid-large {{$variationPercentColor}}">
                {{$item->variation_percent}}
            </div>
            <div class="grid-item grid-large">
                {{$item->volume}}
            </div>
        </div>
        <div class="grid-container">
            <div class="grid-item grid-small">
                <b>Preço:</b> {{$item->price}}
            </div>
            <div class="grid-item grid-medium">
                <b>Preço:</b> {{$item->price}}
            </div>
            <div class="grid-item grid-small">
                <b>Volume:</b> {{$item->volume}}
            </div>
            <div class="grid-item grid-medium">
                <b>Max:</b> {{$item->maximum}}
            </div>
            <div class="grid-item grid-medium">
                <b>Variação:</b> <span class="{{$variationColor}}">{{$item->variation}}</span>
            </div>
        </div>
        <div class="grid-container">
            <div class="grid-item grid-small">
                <b>Max:</b> {{$item->maximum}}
            </div>
            <div class="grid-item grid-small">
                <b>Variação:</b> <span class="{{$variationColor}}">{{$item->variation}}</span>
            </div>
            <div class="grid-item grid-medium">
                <b>Volume:</b> {{$item->volume}}
            </div>
            <div class="grid-item grid-medium">
                <b>Min:</b> {{$item->minimum}}
            </div>
            <div class="grid-item grid-medium">
                <b>Variação %:</b> <span class="{{$variationPercentColor}}">{{$item->variation}}</span>
            </div>
        </div>
        <div class="grid-container">
            <div class="grid-item grid-small">
                <b>Min:</b> {{$item->minimum}}
            </div>
            <div class="grid-item grid-small">
                <b>Valiação %:</b> <span class="{{$variationPercentColor}}">{{$item->variation_percent}}</span>
            </div>
        </div>
        <div class="grid-container">
            <div class="grid-small-medium date-time">{{$item->dateTime}}</div>
        </div>
        <input type="hidden" class="offset" value="{{$history->offset}}">
    </div>
