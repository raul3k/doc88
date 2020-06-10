<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h1>Hello {{$sale->client->name}}, this is your order</h1>

<div>
    <p>Items: {{$sale->orders()->count()}}</p>
    <p>Total to pay: {{$currencyFormatter->format($totalInvoice)}}</p>
</div>

<h2>Items</h2>
<div>
    @foreach($sale->orders() as $order)
        <ol>
            <li><strong>Name:</strong> {{$order->pastel->name}}</li>
            <li><strong>Price:</strong> {{$currencyFormatter->format($order->pastel->price)}}</li>
        </ol>
    @endforeach
</div>

</body>
</html>
