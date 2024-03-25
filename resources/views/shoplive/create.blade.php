<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <h2 class="mb-4">Detalles del Producto</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $product->image_url }}" class="card-img-top" alt="Imagen del producto">
                <div class="card-body">
                    <p class="card-text"><strong>Proveedor:</strong> {{ optional($product->provider)->name }}</p>
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Código:</strong> {{ $product->code }}</p>
                    <p class="card-text"><strong>Categoría:</strong> {{ optional($product->category)->name }}</p>
                    <p class="card-text"><strong>Stock disponible:</strong> {{ $product->current_stock }}</p>
                    <!-- Detalles del precio del producto -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Precio Unitario</th>
                                    <th>Tipo de moneda de cambio</th>
                                    <th>Descuento</th>
                                    <th>Impuesto aplicado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->prices as $price)
                                <tr>
                                    <td>{{ $price->unit_price }}</td>
                                    <td>{{ optional($price->currency)->name }}</td>
                                    <td>{{ $price->discount }}%</td>
                                    <td>{{ optional($price->tax)->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   <!-- Ajustes en el formulario -->
<!-- Ajustes en el formulario -->
<form id="reservationForm" method="POST" action="{{ route('reservations.create', $product->id) }}">
    @csrf
    <!-- Agregamos un campo oculto para enviar el precio unitario al controlador -->
    <input type="hidden" id="unitPrice" name="unit_price" value="{{ $product->prices[0]->unit_price }}">
    <div class="mb-3">
        <label for="quantity">Cantidad:</label>
        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" onchange="calculateTotal()">
    </div>
    <div class="mb-3">
        <label for="totalPrice">Precio Total:</label>
        <input type="text" class="form-control" id="totalPrice" name="price" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Enviar Solicitud de Reserva</button>
    <div id="reservationMessage" class="mt-3" style="display: none;"></div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function calculateTotal() {
        let unitPrice = parseFloat(document.querySelector('#unitPrice').value);
        let quantity = parseInt(document.querySelector('#quantity').value);
        let totalPrice = unitPrice * quantity;
        document.querySelector('#totalPrice').value = totalPrice.toFixed(2);
    }

    $('#reservationForm').submit(function(event) {
        // Evitar el envío del formulario si no se ha calculado el precio total
        if (document.querySelector('#totalPrice').value === "") {
            event.preventDefault();
            alert("Por favor, calcule el precio total antes de enviar el formulario.");
        } else {
            // Mostrar mensaje de éxito y continuar enviando el formulario
            $('#reservationMessage').html('<div class="alert alert-success" role="alert">Reserva solicitada. Espere la aprobación.</div>').fadeIn();
        }
    });
</script>

</body>

</html>
