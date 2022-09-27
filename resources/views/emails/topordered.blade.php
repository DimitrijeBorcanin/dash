@component('mail::message')
<h1>Upozorenje!</h1>
<p>Niste poručili ploču za sledeće narudžbine:</p>
<ol>
    @foreach($orders as $order)
        <li>ID {{$order->id}}</li>
    @endforeach
</ol>
<hr>
{{ config('app.name')}}
@endcomponent