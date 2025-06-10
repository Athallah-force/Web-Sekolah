 <?php
include "koneksi.php";
$db = new Database();

// Pagination settings
$items_per_page = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Get total number of students for pagination
$total_students_result = mysqli_query($db->koneksi, "SELECT COUNT(*) as total FROM siswa");
$total_students_row = mysqli_fetch_assoc($total_students_result);
$total_students = $total_students_row['total'];
$total_pages = ceil($total_students / $items_per_page);

// Proses form edit jika ada POST request
if ($_POST && isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $jurusan = $_POST['jurusan'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $nohp = $_POST['nohp'];
    
    // Update data siswa
    $db->update_data_siswa($nisn, $nama, $jeniskelamin, $kelas, $alamat, $nohp, $jurusan, $agama);
    
    // Redirect untuk menghindari double submit
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Simple Tables</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Simple Tables" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

  </head>
  <style>
    .app-content, .container-fluid, .content-wrapper {
    padding-top: 20px !important;
    margin-top: 0 !important;
  }

  /* Hilangkan jarak atas pada card */
  .card {
    margin-top: 0 !important;
  }

.navbar-nav .nav-link {
    padding: 0.5rem 1rem;
    color: #495057;
}

.navbar-nav .nav-link:hover {
    color: #0d6efd;
}


.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

.card-title {
    margin-bottom: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: #2c3e50;
}

/* Table Styles */
.table {
    margin-bottom: 0;
    width: 100%;
    table-layout: fixed;
    word-wrap: break-word;
}

.table thead th {
    background-color: #f8f9fa;
    border-bottom-width: 1px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: #6c757d;
    vertical-align: middle;
    padding: 1rem;
}


.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.02);
}

.table td, .table th {
    padding: 0.75rem 1rem;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
    overflow-wrap: break-word;
}

/* Button Styles */
.btn {
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.2s;
}

.btn-sm {
    padding: 0.4rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 0.3rem;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
    color: #212529;
    transform: translateY(-1px);
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;
    transform: translateY(-1px);
}

/* Modal Styles */
.modal-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
}

.modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #dee2e6;
}

.bg-warning {
    background-color: #ffc107 !important;
}

/* Form Styles */
.form-control, .form-select {
    padding: 0.5rem 0.75rem;
    border-radius: 0.3rem;
    border: 1px solid #ced4da;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Pagination Styles */
.pagination {
    margin-bottom: 0;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.page-link {
    color: #0d6efd;
    border: 1px solid #dee2e6;
    padding: 0.5rem 0.9rem;
    transition: all 0.2s;
}

.page-link:hover {
    color: #0a58ca;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

/* Add Jurusan Link */
a[href="tambahjurusan.php"] {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
    padding: 0.6rem 1.2rem;
    background-color: #0d6efd;
    color: white;
    text-decoration: none;
    border-radius: 0.3rem;
    transition: all 0.2s;
    font-weight: 500;
}

a[href="tambahjurusan.php"]:hover {
    background-color: #0b5ed7;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 0.75rem;
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    
    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
    }
    
    a[href="tambahjurusan.php"] {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}

/* Animation for table rows */
.table tbody tr {
    transition: background-color 0.2s;
}

.table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05) !important;
}

/* Icon styles */
  </style>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user1-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user8-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user3-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
               <span class="d-none d-md-inline"><?php echo $_SESSION['username']; ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="dist/assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    <?php echo $_SESSION['username']; ?> - <?php echo $_SESSION['role']; ?>
                    <small>Member since <?php echo date("M. Y"); ?></small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="profil.php" class="btn btn-default btn-flat">Profile</a>
                  <a href="logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <?php include 'sidebar.php'; ?>
      <!--begin::App Main-->
      <main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Data Siswa</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content-->
  <div class="app-content">
    <div class="container-fluid">
      <!--begin::Card-->
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">Tabel Siswa</h3>
        </div>

        <!--begin::Card Body-->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>No HP</th>
                <th>Label</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = $offset + 1;
              foreach ($db->tampil_relasi($items_per_page, $offset) as $x) :
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $x['nisn']; ?></td>
                  <td><?= $x['nama']; ?></td>
                  <td><?= $x['kelas']; ?></td>
                  <td><?= $x['namajurusan']; ?></td>
                  <td><?= $x['jeniskelamin']; ?></td>
                  <td><?= $x['alamat']; ?></td>
                  <td><?= $x['agama']; ?></td>
                  <td><?= $x['nohp']; ?></td>
                  <td>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                      <!-- Tombol Edit -->
                      <button 
                        class="btn btn-warning btn-sm mb-2 btn-edit"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit"
                        data-nisn="<?= $x['nisn']; ?>"
                        data-nama="<?= htmlspecialchars($x['nama']); ?>"
                        data-jeniskelamin="<?= $x['jeniskelamin']; ?>"
                        data-jurusan="<?= $x['kodejurusan']; ?>"
                        data-kelas="<?= htmlspecialchars($x['kelas']); ?>"
                        data-alamat="<?= htmlspecialchars($x['alamat']); ?>"
                        data-agama="<?= $x['agama_id']; ?>"
                        data-nohp="<?= htmlspecialchars($x['nohp']); ?>"
                      >Edit</button>

                      <!-- Tombol Hapus -->
                      <button 
                        class="btn btn-danger btn-sm mb-2 btn-delete"
                        data-bs-toggle="modal"
                        data-bs-target="#modalHapus"
                        data-nisn="<?= $x['nisn']; ?>"
                        data-nama="<?= htmlspecialchars($x['nama']); ?>"
                        data-jeniskelamin="<?= $x['jeniskelamin']; ?>"
                        data-jurusan="<?= $x['kodejurusan']; ?>"
                        data-kelas="<?= htmlspecialchars($x['kelas']); ?>"
                        data-alamat="<?= htmlspecialchars($x['alamat']); ?>"
                        data-agama="<?= $x['agama']; ?>"
                        data-nohp="<?= htmlspecialchars($x['nohp']); ?>"
                      >Hapus</button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <!-- Tombol Tambah Data -->
          <?php if ($_SESSION['role'] === 'admin') : ?>
            <a href="tambahsiswa.php" class="btn btn-primary float-end m-3">
              <i class="bi bi-plus-circle"></i> Tambah Data Siswa
            </a>
          <?php endif; ?>
        </div>
        <!--end::Card Body-->

        <!--begin::Card Footer - Pagination-->
        <div class="card-footer d-flex justify-content-center">
          <nav aria-label="Page navigation example">
            <ul class="pagination mb-0">
              <?php if ($page > 1) : ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>

              <?php if ($page < $total_pages) : ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
        <!--end::Card Footer-->
      </div>
      <!--end::Card-->
    </div>
  </div>
  <!--end::App Content-->
</main>

      <!--end::App Main-->

      <!--end::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2024&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->

    <!-- Single Modal Edit -->
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelEdit" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" method="POST" id="formEdit">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="labelEdit">Edit Data Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="nisn" id="editNisn" value="">
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="editNama" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jeniskelamin" class="form-select" id="editJenisKelamin">
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
            <div class="mb-3">
              <label class="form-label">Jurusan</label>
              <select name="jurusan" class="form-select" id="editJurusan" required>
                <?php foreach ($db->tampil_jurusan() as $jur) : ?>
                  <option value="<?= $jur['kodejurusan']; ?>"><?= $jur['namajurusan']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" class="form-control" name="kelas" id="editKelas" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="editAlamat">
          </div>
          <div class="mb-3">
            <label class="form-label">Agama</label>
            <select name="agama" class="form-select" id="editAgama" required>
              <?php foreach ($db->tampil_agama() as $agm) : ?>
                <option value="<?= $agm['idagama']; ?>"><?= htmlspecialchars($agm['namaagama']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" class="form-control" name="nohp" id="editNoHp">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelHapus" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="hapus.php" method="GET" id="formHapus">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="labelHapus">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus data siswa ini?</p>
          <p><strong>NISN:</strong> <span id="hapusNisn"></span></p>
          <p><strong>Nama:</strong> <span id="hapusNama"></span></p>
          <p><strong>Jenis Kelamin:</strong> <span id="hapusJenisKelamin"></span></p>
          <p><strong>Jurusan:</strong> <span id="hapusJurusan"></span></p>
          <p><strong>Kelas:</strong> <span id="hapusKelas"></span></p>
          <p><strong>Alamat:</strong> <span id="hapusAlamat"></span></p>
          <p><strong>Agama:</strong> <span id="hapusAgama"></span></p>
          <p><strong>No HP:</strong> <span id="hapusNoHp"></span></p>
        </div>
        <input type="hidden" name="id" id="hapusId" value="">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('modalEdit');
    const editNisn = document.getElementById('editNisn');
    const editNama = document.getElementById('editNama');
    const editJenisKelamin = document.getElementById('editJenisKelamin');
    const editJurusan = document.getElementById('editJurusan');
    const editKelas = document.getElementById('editKelas');
    const editAlamat = document.getElementById('editAlamat');
    const editAgama = document.getElementById('editAgama');
    const editNoHp = document.getElementById('editNoHp');

    document.querySelectorAll('.btn-edit').forEach(button => {
      button.addEventListener('click', () => {
        editNisn.value = button.getAttribute('data-nisn');
        editNama.value = button.getAttribute('data-nama');

        // Set Jenis Kelamin select option with mapping
        let jeniskelaminValue = button.getAttribute('data-jeniskelamin');
        if (jeniskelaminValue === 'Laki-laki') jeniskelaminValue = 'L';
        else if (jeniskelaminValue === 'Perempuan') jeniskelaminValue = 'P';
        for (const option of editJenisKelamin.options) {
          option.selected = option.value === jeniskelaminValue;
        }

        editJurusan.value = button.getAttribute('data-jurusan');
        editKelas.value = button.getAttribute('data-kelas');
        editAlamat.value = button.getAttribute('data-alamat');
        //set agama select option
        const agamaValue = button.getAttribute('data-agama');
        for (const option of editAgama.options) {
          option.selected = option.value === agamaValue;
        }
        editNoHp.value = button.getAttribute('data-nohp');
      });
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
  const modalHapus = document.getElementById('modalHapus');
  const hapusNisn = document.getElementById('hapusNisn');
  const hapusNama = document.getElementById('hapusNama');
  const hapusId = document.getElementById('hapusId');
  const hapusJenisKelamin = document.getElementById('hapusJenisKelamin');
  const hapusJurusan = document.getElementById('hapusJurusan');
  const hapusKelas = document.getElementById('hapusKelas');
  const hapusAlamat = document.getElementById('hapusAlamat');
  const hapusAgama = document.getElementById('hapusAgama');
  const hapusNoHp = document.getElementById('hapusNoHp');

  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', () => {
      hapusNisn.textContent = button.getAttribute('data-nisn');
      hapusNama.textContent = button.getAttribute('data-nama');
      hapusId.value = button.getAttribute('data-nisn');
      hapusJenisKelamin.textContent = button.getAttribute('data-jeniskelamin');
      hapusJurusan.textContent = button.getAttribute('data-jurusan');
      hapusKelas.textContent = button.getAttribute('data-kelas');
      hapusAlamat.textContent = button.getAttribute('data-alamat');
      hapusAgama.textContent = button.getAttribute('data-agama');
      hapusNoHp.textContent = button.getAttribute('data-nohp');
    });
  });
});

</script>



  </body>
  <!--end::Body-->
</html>

 