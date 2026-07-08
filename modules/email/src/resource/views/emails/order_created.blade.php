<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order created</title>
</head>
<body>
    <h1>Order #{{ $order->id }}</h1>
    <p>A new order was created.</p>

    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product?->name ?? 'Product' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
