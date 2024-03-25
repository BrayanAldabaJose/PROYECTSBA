@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content_header')
    <h1>Crear Producto</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información del Producto</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario para crear producto -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Campos del producto -->
                        <div class="form-group">
                            <label for="name">Nombre del Producto</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Código del Producto</label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción del Producto</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>


                        <div class="form-group">
    <label for="image_path">Imágenes:</label>
    <input type="file" class="form-control" id="image_path" name="images" multiple>
    @error('image_path')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>



                        <div class="form-group">
                            <label for="status">Estado del Producto</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="DESACTIVADO">DESACTIVADO</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="initial_stock">Stock Inicial</label>
                                    <input type="number" name="initial_stock" id="initial_stock" class="form-control" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="current_stock">Stock Actual</label>
                                    <input type="number" name="current_stock" id="current_stock" class="form-control" min="0" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provider_id">Proveedor</label>
                                    <select name="provider_id" id="provider_id" class="form-control">
                                        <option value="">Seleccionar Proveedor</option>
                                        @foreach($providers as $provider)
                                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select para categorías -->
                                <div class="form-group">
                                    <label for="category_id">Categoría</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Seleccionar Categoría</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

    <!-- Otros campos del producto -->
    <div class="form-group">
    <label for="discount">Descuento (%)</label>
    <input type="number" name="discount" id="discount" class="form-control" min="0" max="100">
</div>

<div class="form-group">
    <label for="tax_id">Impuesto</label>
    <select name="tax_id" id="tax_id" class="form-control" required>
        <option value="">Seleccionar Impuesto</option>
        @foreach($taxes as $tax)
            <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->rate }}%)</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="currency_id">Moneda</label>
    <select name="currency_id" id="currency_id" class="form-control" required>
        <option value="">Seleccionar Moneda</option>
        @foreach($currencies as $currency)
            <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->code }})</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="base_price">Precio Base del Producto</label>
    <input type="number" name="base_price" id="base_price" class="form-control" min="0" step="0.01" required>
</div>

<div class="form-group">
    <label for="unit_price">Precio Inicial del Producto</label>
    <input type="number" name="unit_price" id="unit_price" class="form-control" min="0" required readonly>
</div>

<div class="form-group">
    <label for="amount">Monto del Producto</label>
    <input type="text" name="amount" id="amount" class="form-control" readonly>
</div>



                        <!-- Botón de guardar -->
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </form>
                    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Ejecutar la función updateAmount al cargar la página
    updateAmount();

    // Escuchar cambios en los campos relevantes y actualizar los cálculos
    $('#base_price, #discount, #tax_id, #currency_id, #current_stock').on('input change', function() {
        updateAmount();
    });
});

function updateAmount() {
    var basePrice = parseFloat($('#base_price').val()) || 0;
    var discount = parseFloat($('#discount').val()) || 0;
    var selectedTaxId = $('#tax_id').val(); // Obtener el ID del impuesto seleccionado
    var currentStock = parseInt($('#current_stock').val()) || 0;

    // Obtener la tasa de impuesto correspondiente al ID del impuesto seleccionado
    var taxRate = obtenerTasaDeImpuesto(selectedTaxId); // Debes implementar esta función para obtener la tasa de impuesto correcta del seeder

    var unitPrice = basePrice * (1 + taxRate / 100) * (1 - discount / 100); // Aplicar el impuesto al precio base
    var totalAmount = unitPrice * currentStock;

    $('#unit_price').val(unitPrice.toFixed(2));
    $('#amount').val(totalAmount.toFixed(2));
}

// Función para obtener la tasa de impuesto correspondiente al ID del impuesto seleccionado
function obtenerTasaDeImpuesto(selectedTaxId) {
    // Aquí deberías implementar la lógica para obtener la tasa de impuesto correcta del seeder
    // Buscar el impuesto en la base de datos utilizando el ID seleccionado
    // En este caso, como estamos simulando el seeder, usaremos un array estático

    // Array de impuestos del seeder
    var taxes = [
        { id: 1, rate: 12.00 },
        { id: 2, rate: 5.00 },
        { id: 3, rate: 10.00 },
        { id: 4, rate: 15.00 }
    ];

    // Buscar el impuesto en el array por ID
    var tax = taxes.find(function(tax) {
        return tax.id == selectedTaxId;
    });

    // Retornar la tasa de impuesto correspondiente
    return tax ? tax.rate : 0; // Si no se encuentra el impuesto, retornar 0
}
</script>

@stop
