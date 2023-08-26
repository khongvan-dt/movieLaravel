<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Table</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles1.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="{{ route('TablePage') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                        <a class="nav-link" href="{{ route('addCategory') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Thêm thể loại phim
                        </a>
                        <a class="nav-link" href="{{ route('addProducts') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Thêm rạp
                        </a>

                        <a class="nav-link" href="{{ route('addMovie') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thêm Phim
                        </a>
                        <a class="nav-link" href="{{ route('phimRaps') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thêm Phim Rạp
                        </a>

                        <a class="nav-link collapsed" href="{{ route('addChair') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Thêm ghế
                        </a>
                        <a class="nav-link collapsed" href="{{ route('addShowTime') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Thêm thời gian chiếu
                        </a>
                        <a class="nav-link" href="login_out.php">
                            <div class="sb-nav-link-icon"><i class="fa-sharp fa-light fa-right-from-bracket"></i></div>
                            Đăng Xuất
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">

            <div class="container-fluid px-4">

                <div class="card mb-4" style="    margin-top: 30px;">
                    <div class="card-header">
                        <form action="{{ route('insertData') }}" method="post">
                            <button class="btn btn-primary" type="submit">save</button>
                            <main>

                                <div>
                                    <h3>Chọn Rạp</h3>
                                </div>

                                <div class="container-fluid px-4">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @if (session('insert'))
                                                <div class="alert alert-success">
                                                    Insert thành công!
                                                </div>
                                            @endif

                                            @csrf

                                            <div class="d-flex flex-wrap">
                                                @if ($ListCinema->isEmpty())
                                                    <div class="alert alert-info">Không có tên rạp.</div>
                                                @else
                                                    @foreach ($ListCinema as $cinema)
                                                        <div
                                                            style="margin: 10px; padding: 10px; border: 1px solid #ebebeb;">
                                                            <p>Name: {{ $cinema->Name_rap }}</p>
                                                            <p>Address: {{ $cinema->adress }}</p>


                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="cinemaCheck[]"
                                                                    value="{{ $cinema->rap_chieu_id }}">

                                                                <label class="form-check-label">
                                                                    Add
                                                                </label>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h3>Chọn Phim</h3>
                                </div>
                                <div class="container-fluid px-4">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @if (session('r'))
                                                <div class="alert alert-success">
                                                    Insert thành công!
                                                </div>
                                            @endif
                                            @if (session('delete'))
                                                <div class="alert alert-success">
                                                    Xóa rạp chiếu thành công
                                                </div>
                                            @endif

                                            @csrf
                                            <div class="d-flex flex-wrap">
                                                @if ($ListMovie->isEmpty())
                                                    <div class="alert alert-info">không có tên rap.</div>
                                                @else
                                                    @foreach ($ListMovie as $movie)
                                                        <div
                                                            style="margin: 10px; padding: 10px; border: 1px solid #ebebeb; width: 200px;
                                                                text-align: center;">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="movieCheck[]"
                                                                    value="{{ $movie->movie_id }}">

                                                            </div>

                                                            <div>
                                                                <img src="{{ asset($movie->img) }}" width="150px"
                                                                    height="100px">
                                                            </div>
                                                            <div>Name: {{ $movie->movie_name }}</div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </main>
                        </form>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
                </script>
                <script src="js/scripts.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                <script src="assets/demo/chart-area-demo.js"></script>
                <script src="assets/demo/chart-bar-demo.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
                    crossorigin="anonymous"></script>
                <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
