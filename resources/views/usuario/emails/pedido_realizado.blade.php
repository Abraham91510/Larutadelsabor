<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pedido realizado</title>
</head>

<body>

<h1>Pedido realizado correctamente</h1>

<p>Tu pedido fue creado con éxito.</p>

<hr>

<p><b>Folio:</b> {{ $pedido->folio }}</p>

<p><b>Subtotal:</b> ${{ $pedido->subtotal }} MXN</p>

<p><b>Descuento aplicado:</b> ${{ $pedido->descuento }} MXN</p>

<p><b>Total final:</b> ${{ $pedido->total }} MXN</p>

<hr>

<h3>Productos:</h3>

<ul>
@foreach($pedido->detalles ?? [] as $detalle)
    <li>
        Producto ID: {{ $detalle->producto_id }} -
        Cantidad: {{ $detalle->cantidad }} -
        Precio: ${{ $detalle->precio }}
    </li>
@endforeach
</ul>

<hr>

<h3>QR del pedido</h3>

@if($pedido->qr)
    <img src="data:image/svg+xml;base64,{{ $pedido->qr }}" width="200">
@else
    <p>QR no disponible</p>
@endif

</body>
</html>