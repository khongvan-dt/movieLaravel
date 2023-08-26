<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles1.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        input {
            width: 500px;
            border-color: whitesmoke;
            border-radius: 10px;
            padding: 10px;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <form action="#" method="post" enctype="multipart/form-data">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>

            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="login_out.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                            <a class="nav-link" href="./more_product.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Thêm các loại sản phẩm
                            </a>
                            <a class="nav-link" href="./product_company.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Thêm hãng
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
                            <a class="nav-link collapsed" href="{{ route('oder') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                danh sách đặt vé
                            </a>
                            <a class="nav-link" href="login_out.php">
                                <div class="sb-nav-link-icon"><i class="fa-sharp fa-light fa-right-from-bracket"></i>
                                </div>
                                Đăng Xuất
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <h1>Edit</h1>
                <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <form >
                                @csrf 
                                <div class="card-body">
                                    <table id="" style="width: 100%;">
                                        <tr>
                                            <th> Loại Sản Phẩm </th>
                                            <th>
                                                <input type="text" name="nameCinema" class="form-control"
                                                    value=" {{ $EditCinema->Name_rap }}">

                                            </th>
                                        </tr>
                                        <tr>
                                            <th> Địa Chỉ</th>
                                            <th>
                                                <input type="text" name="adress" class="form-control"
                                                    value=" {{ $EditCinema->adress }}">

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>SĐT</th>
                                            <th>
                                                <input type="text" name="sdt" class="form-control"
                                                    value=" {{ $EditCinema->sdt }}">
                                            </th>
                                        </tr>


                                        <tr>
                                            <th>Email</th>
                                            <th>
                                                <input type="text" name="Email" class="form-control"
                                                    value=" {{ $EditCinema->Email }}">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Website</th>
                                            <th>
                                                <input type="text" name="Website" class="form-control"
                                                    value=" {{ $EditCinema->Website }}">
                                            </th>
                                        </tr>

                                        <tr>
                                            <th>Chức năng</th>
                                            <th>
                                                <button class="btn btn-primary" type="submit"
                                                    name="save">Save</button>
                                            </th>
                                        </tr>

                                    </table>
                            </form>
                        </div>
                    </div>
            </div>
            </main>
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
            crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>
