<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        .product-carousel img {
            object-fit: cover;
            height: 500px;
            /* Adjust as needed */
        }

        .carousel-indicators li {
            background-color: #000;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
        }
    </style>
</head>

<body>
    @include('pages.landingpage.includes.navbar')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide product-carousel" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#productCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#productCarousel" data-slide-to="1"></li>
                        <li data-target="#productCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ url($item->thumbnail) }}" class="d-block w-100" alt="Image 1" />
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url($item->thumbnail) }}" class="d-block w-100" alt="Image 2" />
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url($item->thumbnail) }}" class="d-block w-100" alt="Image 3" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <h2>{{ $item->name }}</h2>
                <p>
                    {{ $item->description }}
                </p>
                <p>Stok: <span id="productStock">
                        {{ $item->stock }}
                    </span></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-4">
        <div class="container text-center">
            <p>Alamat: Jl. Contoh Alamat No. 123, Kota, Negara</p>
            <a href="https://shopee.co.id" target="_blank">Shopee</a>
            <a href="https://instagram.com" target="_blank">Instagram</a>
            <a href="https://tiktok.com" target="_blank">TikTok</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
