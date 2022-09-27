@component('mail::message')
<h1>Upozorenje!</h1>
<p>Prošlo je 30 dana od porudžbine sa ID {{$order->id}}, a nije proizvedena.</p>
<a href="{{config('app.url')}}/kupci/{{$order->customer_id}}/porudzbina/{{$order->id}}">Pogledaj na aplikaciji</a>
<hr>
{{ config('app.name')}}
@endcomponent