<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sửa Thể Loại Phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles1.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



    <style>
        tr {
            text-align: center;
            border: 1px solid gray;
        }

        th,
        td {
            border-left: 1px solid gray;
        }
    </style>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Sửa Ghế</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->

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
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <div>
                        @if (session('delete'))
                            <div class="alert alert-success">
                                xóa thành công!
                            </div>
                        @endif
                        @if (session('update'))
                            <div class="alert alert-success">
                                sửa thành công!
                            </div>
                        @endif
                        @if (session('insert'))
                            <div class="alert alert-success">
                                Thêm thời gian thành công!
                            </div>
                        @endif
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên rạp</th>

                                        <th>Tên phim</th>
                                        <th>Ảnh</th>
                                        <th>Thời gian</th>
                                        <th>Ngày phát hành </th>

                                        <th>Chức Năng</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($movies as $movie)
                                        <tr>
                                            <td>
                                                {{ ++$i }}
                                            </td>
                                            <td>
                                                {{ $movie->Name_rap }}
                                            </td>
                                            <td>
                                                {{ $movie->movie_name }}
                                            </td>
                                            <td><img src="{{ asset($movie->img) }}"
                                                    style="width:150px; height:100px; object-fit:cover;"></td>

                                            <td>
                                                {{ $movie->Max_time }}
                                            </td>
                                            <td>
                                                {{ $movie->Ngay_chieu }}
                                            </td>
                                            

                                            <td>

                                                <a class="btn btn-danger"
                                                    href="{{ route('addtime', ['rapId' => $movie->Id_Rap, 'movieId' => $movie->ID_Phim]) }}">thêm
                                                    lịch chiếu</a>

                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
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
