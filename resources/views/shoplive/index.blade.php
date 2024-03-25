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


    <link rel="stylesheet" href="@vite('resources/css/shoplive-custom.css')

</head>

<body>
<header class="header rounded" style="border-bottom: 2px solid white; padding: 30px 0; width: 80%; margin: 20px auto 0; position: relative; overflow: hidden;">
    <div class="background-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(0, 183, 255, 0.7), rgba(0, 123, 255, 0.7)); z-index: -1;"></div>
    <div class="container">
        <h1 style="color: #fff; font-size: 2.5rem;">Grupo SBACB Tecnologi S.R.L.</h1>
        <nav class="navbar navbar-expand-lg justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;"><i class="fas fa-fw fa-user"></i> Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;"><i class="fas fa-fw fa-tags"></i> Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;"><i class="fas fa-fw fa-shopping-cart"></i> Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;"><i class="fas fa-fw fa-phone"></i> Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;"><i class="fas fa-fw fa-cogs"></i> Servicios</a>
                    </li>
                </ul>
            </div>
        </nav>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex justify-content-center mt-3">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" style="max-width: 200px;">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
        </form>
    </div>
</header>
<!-- Slider de imágenes -->
<section class="container mt-6 p-4 rounded">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://hikacademia.com/wp-content/uploads/2020/08/Cursos-de-conceptos-b%C3%A1sicos-CCTV.png" class="d-block w-100" style="max-height: 350px; object-fit: cover; border-radius: 15px;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.technosystems.cl/wp-content/uploads/2018/12/Hikvision-banner-pag33.png" class="d-block w-100" style="max-height: 350px; object-fit: cover; border-radius: 15px;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.securimport.com/distribuidor/wp-content/uploads/brizy/imgs/bannerhikvision-1136x428x23x0x1090x428x1666877638.png" class="d-block w-100" style="max-height: 350px; object-fit: cover; border-radius: 15px;" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<div class="container">
    <h2 class="mb-4">Novedades</h2>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $product->image_url }}" class="card-img-top" alt="Imagen del producto">
                <div class="card-body">
                    <p class="card-text"><strong>Proveedor:</strong> {{ optional($product->provider)->name }}</p>
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Código:</strong> {{ $product->code }}</p>
                    <p class="card-text"><strong>Categoría:</strong> {{ optional($product->category)->name }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $product->current_stock }}</p>

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

                    <!-- Botones de solicitud de reserva -->
                    <form method="POST" action="{{ route('reservations.create', $product->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">formulario de reserva</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


    <h2 class="mt-5">Ofertas</h2>
    <div class="row">
        <!-- Aquí puedes agregar contenido relacionado con las ofertas -->
        <div class="col-md-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Título de la oferta</h5>
                    <p class="card-text">Descripción de la oferta.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Repite este bloque para cada oferta -->
    </div>

    <h2 class="mt-5">Proveedores</h2>
    <div class="row">
        <!-- Aquí puedes agregar contenido relacionado con los proveedores -->
        <div class="col-md-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Nombre del proveedor</h5>
                    <p class="card-text">Descripción del proveedor.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Repite este bloque para cada proveedor -->
    </div>
</section>



<section class="presentation-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 presentation-content">
                <img src="tu-imagen-logo.png" alt="Logo de la empresa" class="presentation-image">
            </div>
            <div class="col-md-6 presentation-content">
                <p class="presentation-text custom-text">"¡Bienvenidos a nuestra empresa! En [nombre de la empresa], nos enorgullece ofrecer soluciones innovadoras y de alta calidad para satisfacer las necesidades de nuestros clientes. Con un equipo comprometido y apasionado, nos esforzamos por superar las expectativas y crear un impacto positivo en la comunidad. Esperamos que disfruten explorando nuestros productos y servicios, y estamos aquí para ayudarles en cada paso del camino. ¡Gracias por elegirnos y esperamos construir un futuro exitoso juntos!"</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <!-- Logo de la empresa -->
        <div class="logo">
            <img src="logo.png" alt="Logo de la empresa">
        </div>
        <!-- Redes sociales -->
        <div class="social-links">
            <a href="#" class="social-link"><i class="fab fa-facebook fa-2x" style="color: white;"></i></a>
            <a href="#" class="social-link"><i class="fab fa-twitter fa-2x" style="color: white;"></i></a>
            <a href="#" class="social-link"><i class="fab fa-instagram fa-2x" style="color: white;"></i></a>
            <a href="#" class="social-link"><i class="fab fa-linkedin fa-2x" style="color: white;"></i></a>
        </div>
        <!-- Información útil -->
        <div class="useful-info">
            <p>Teléfono: 123-456-789</p>
            <p>Email: info@empresa.com</p>
            <a href="#" class="btn btn-primary">Contactar</a>
        </div>
    </div>
</footer>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
