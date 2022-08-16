<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Ime i prezime</th>
        <th>Telefon</th>
        <th>Kod</th>
        <th>Cena</th>
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
            <td>{{$order->product->getAmountWithCurrency('price')}}</td>
            <td><p>{{$order->customer->address_and_city}}</p></td>
        </tr>
    @endforeach
    </tbody>
</table>
