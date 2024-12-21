<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        .sidebar {
            position: fixed;
            top: 56px;
            /* Adjust based on your navbar height */
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
        }

        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 56px;
            /* Adjust based on your navbar height */
            height: calc(100vh - 56px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
            /* Adjust as needed */
        }
    </style>
</head>

<body>
    @include('pages.landingpage.includes.navbar')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="/product">
                                {{-- <i class="fas fa-th-large"></i> --}}
                                Semua Kategori
                            </a>
                        </li>
                        @foreach ($list_category as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="/product?category={{ $item }}">
                                    {{ $item }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Produk</h1>
                </div>

                <div class="row">
                    @foreach ($items as $item)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="{{ url($item->thumbnail) }}" class="card-img-top" alt="Produk 1" />
                                <div class="card-body">
                                    <p class="text-muted mb-0">{{ $item->code }}</p>
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p class="card-text">
                                        {{ $item->description }}
                                    </p>
                                    <a href="/product/{{ $item->id }}" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
