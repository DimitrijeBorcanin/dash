<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Ime i prezime</th>
        <th>Telefon</th>
        <th>Kod</th>
        @if(Auth::user()->hasRoles([1,2,4,5]))
        <th>Cena</th>
        @endif
        <th>Adresa</th>
    </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->customer->name}}</td>
            <td>{{$order->customer->phone}}</td>
            <td>{{$order->product->code}}</td>
            @if(Auth::user()->hasRoles([1,2,4,5]))
            <td>{{$order->product->getAmountWithCurrency('price')}}</td>
            @endif
            <td><p>{{$order->customer->address_and_city}}</p></td>
        </tr>
    @endforeach
    </tbody>
</table>
