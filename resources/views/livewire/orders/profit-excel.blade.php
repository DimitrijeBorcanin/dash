<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Proizvod</th>
        <th>Kupac</th>
        <th>Datum</th>
        <th>Zarada</th>
    </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>
                <p>{{$order->product->code}}</p>
            </td>
            <td>
                <p>{{$order->customer->email}}</p>
                <p>{{$order->customer->phone}}</p>
                <p>{{$order->customer->address_and_city}}</p>
            </td>
            <td>{{$order->paid}}</td>
            <td>{{$order->product->price}} {{$order->product->currency}}</td>
        </tr>
    @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Ukupno: <br/> {{$totalRSD}} RSD <br /> {{$totalEUR}} EUR</td>
        </tr>
    </tbody>
</table>
