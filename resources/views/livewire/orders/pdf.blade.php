<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Porudžbine</title>
    <style>
        * {
            font-family: DejaVu Sans;
            box-sizing: border-box;
        }

        @page {
            margin: 50px;
        }

        p, div{
            margin: 0;
            padding: 0;
        }

        .flex{
            /* padding: 20px; */
        }

        .square {
            margin: 10px auto;
            width: 50%;
            border: 1px solid #000;
            padding: 10px;
        }

        .page-break{
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="flex">
        @foreach($orders as  $index => $order)
        <div class="square">
            <p>ID: {{$order->id}}</p>
            <hr>
            <p>{{$order->product->code}}</p>
            <p>{{$order->product->type}}</p>
            <hr>
            <p>{{$order->customer->name}}</p>
            <p>{{$order->customer->address_and_city}}</p>
            <p>{{$order->customer->phone}}</p>
        </div>
        @if(($index + 1) % 3 == 0)
            <div class="page-break"></div>
        @endif
        @endforeach
    </div>
</body>
</html>