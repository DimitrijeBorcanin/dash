@component('mail::message')
<p>Poštovani/a {{$order->customer->name}}, <br> Vaša porudžbina je prihvaćena i bićete obavešteni kada bude spremna.</p>
<hr>
<h1>ID: {{$order->id}}</h1>
<p>Vrsta: {{$order->product->type}}</p>
<p>Boja: {{$order->product->color}}</p>
<p>Visina: {{$order->product->height}}</p>
<p>Vrsta ploče: {{$order->product->top_type}}</p>
<p>Dimenzija ploče: {{$order->product->dimensions}}</p>
<p>Oblik ploče: {{$order->product->top_shape}}</p>
<p>Obrada ivice: {{$order->product->edge_type}}</p>
<p>Zaštita: {{$order->product->protection}}</p>
<p>Količina: {{$order->product->quantity}}</p>
<hr>
<p>Cena: {{$order->product->price}} {{$order->product->currency}}</p>
@if($order->customer->phone)
<p>Vaš telefon je: {{$order->customer->phone}}</p>
@endif
<p>Vaša adresa je: {{$order->customer->address_and_city}}</p>
<hr>
{{ config('app.name')}}
@endcomponent