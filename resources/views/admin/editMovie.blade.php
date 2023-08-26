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
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Sửa Ghế</a>
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
            <main>
                <div class="container-fluid px-4">
                    <div class="card mb-4">


                        <div class="card-body">
                            <form action="{{ route('updateMovies', ['movieId' => $movie->movie_id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <table style="width: 100%;">


                                    <tr>
                                        <td style="width: 10%;">Thể loại: </td>

                                        <td>
                                            <select class="form-control" id="sel1" name="theLoai">
                                                @foreach ($theLoaiData as $theLoai)
                                                    <option value="{{ $theLoai->the_loai_id }}">
                                                        {{ $theLoai->tenTheLoai }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td style="width: 10%;">Tên phim:</td>
                                        <td>
                                            <input type="text" value="{{ $movie->movie_name }}"
                                                class="form-control" name="editNameMovie">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ảnh:</td>
                                        <td>
                                            <input type="file" name="editImg" class="form-control">
                                            <img style="margin-left: 21px;" src="{{ asset($movie->img) }}"
                                                width="150px" height="100px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%;"> Thời gian:</td>
                                        <td>
                                            <input type="text" value="{{ $movie->Max_time }}"
                                                class="form-control" name="editTime">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%;">Ngày chiếu:</td>

                                        <td>
                                            <input type="text" value="{{ $movie->Ngay_chieu }}"
                                                class="form-control" name="editDay">


                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 10%;"> Đạo Diễn:</td>
                                        <td>
                                            <input type="text" value="{{ $movie->dao_dien }}"
                                                class="form-control" name="editDD">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%;">Diễn viên chính:</td>
                                        <td>
                                            <input type="text" value="{{ $movie->dv_chinh }}"
                                                class="form-control" name="editDV">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%;"> Giá Bán:</td>
                                        <td>
                                            <input type="text" value="{{ $movie->priceMovie }}"
                                                class="form-control" name="editPrice">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%;"> Chi Tiết:</td>
                                        <td>
                                            <textarea class="form-control" rows="5" id="comment" name="Description">{{ $movie->description }}</textarea>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Chức năng:</td>
                                        <td>
                                            <button class="btn btn-primary" type="submit"
                                                name="save">Save</button>
                                        </td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
