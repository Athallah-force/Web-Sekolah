<?php
include "koneksi_login.php";

$db = new Database();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Fetch user data from database
$userData = null;
$query = "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($db->koneksi, $username) . "' LIMIT 1";
$result = mysqli_query($db->koneksi, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
}

$role = $userData['role'] ?? '';
$password = $userData['password'] ?? '';

// For photo, use a default or user-specific photo if available
$photo = "dist/assets/img/user2-160x160.jpg"; // default photo path

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
    <link rel="stylesheet" href="profil.css" />

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

a[href="tambahjurusan.php"] i {
    font-size: 1rem;
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
               <span class="d-none d-md-inline">
  <?php echo $_SESSION['username']; ?>
</span>
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
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Profil User</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card mb-4" style="max-width: 600px; margin: auto;">
                    <div class="card-header">
                        <h3 class="card-title">Detail Profil</h3>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?php echo $photo; ?>" alt="Foto Profil" class="img-thumbnail rounded-circle mb-3" style="width: 150px; height: 150px;">
                        <h4><?php echo htmlspecialchars($username ?? ''); ?></h4>
                        <p><strong>Role:</strong> <?php echo htmlspecialchars($role ?? ''); ?></p>
                        <p><strong>Password:</strong> <?php echo htmlspecialchars($password); ?></p>
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditProfile">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </div>

                        <!-- Single Modal Edit -->
                        <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-labelledby="modalEditProfileLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="updateprofil.php" method="POST" id="formEditProfile">
                                <div class="modal-header bg-warning" style="border:none; box-shadow:none;">
                                  <h5 class="modal-title" id="modalEditProfileLabel">Edit Profil</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="padding:0;">
                                  <input type="hidden" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>">
                                  <div class="mb-3">
                                    <label for="nameProfile" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nameProfile" name="nama" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="passwordProfile" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="passwordProfile" name="password" value="<?php echo htmlspecialchars($password ?? ''); ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="roleProfile" class="form-label">Role</label>
                                    <select class="form-select" id="roleProfile" name="role" required>
                                      <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                      <option value="siswa" <?php echo ($role == 'siswa') ? 'selected' : ''; ?>>Siswa</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer" style="border:none; box-shadow:none;">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



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
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
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


  </body>
  <!--end::Body-->
</html>
