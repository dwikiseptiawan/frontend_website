<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pengguna</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="<?= URL_DASHBOARD ?>assets/img/favicon.png" rel="icon">
  <link href="<?= URL_DASHBOARD ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="<?= URL_DASHBOARD ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= URL_DASHBOARD ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= URL_DASHBOARD ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= URL_DASHBOARD ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= URL_DASHBOARD ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= URL_DASHBOARD ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= URL_DASHBOARD ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="<?= URL_DASHBOARD ?>assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="pengguna">
          <i class="bi bi-menu-button-wide"></i><span>User</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pengguna</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Pengguna</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Input Pengguna</h5>

              <form class="row g-3" action="tambah_user" method="post">
                <div class="col-12">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" id="nama">
                </div>
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>             
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Table Pengguna</h5>

              <table class="table mt-3">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  
                  $p = 0;
                  foreach($user->user as $u){
                    $p++;
                  
                  ?>
                  <tr>
                    <th scope="row"><?= $p ?></th>
                    <td><?= $u->nama ?></td>
                    <td><?= $u->username ?></td>
                    <td><?= $u->created ?></td>
                    <td>
                      <form action="hapus_user" method="post">
                        <input type="hidden" name="id" value="<?= $u->id ?>">
                        <button type="submit" class="btn btn-danger">HAPUS</button>
                      </form>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>              
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script src="<?= URL_DASHBOARD ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/chart.js/chart.min.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= URL_DASHBOARD ?>assets/js/main.js"></script>

</body>

</html>