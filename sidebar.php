<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="index.php" class="brand-link">
             <img src="./dist/assets/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 30px; height: 30px;">
             <span class="brand-text font-weight-light"></span>
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <?php if ($_SESSION['role'] === 'admin'): ?>
              <li class="nav-item menu-open">
                <a href="index.php" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Data
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="datasiswa.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="datajurusan.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Jurusan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="dataagama.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Agama</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                <i class="bi bi-pencil-square"></i>
                  <p>
                    Tambah 
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="tambahsiswa.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Tambah Data Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="tambahjurusan.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Tambah Data Jurusan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="tambahagama.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Tambah Data Agama</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-header">EXAMPLES</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                  <p>
                    Auth
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="profil.php" class="nav-link">
                          <i class="nav-icon bi bi-person"></i>
                          <p>Profil</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="users.php" class="nav-link">
                          <i class="bi bi-people"></i>
                          <p>Users</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="tambahusers.php" class="nav-link">
                          <i class="bi bi-person-add"></i>
                          <p>Tambah Users</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </a>
                      </li>
                </ul>
              </li>
              <?php endif; ?>
              <?php if ($_SESSION['role'] === 'siswa'): ?>
              <li class="nav-item menu-open">
                <a href="index.php" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Data
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="datasiswa.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="datajurusan.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Jurusan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="dataagama.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Agama</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-header">EXAMPLES</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                  <p>
                    Auth
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="profil.php" class="nav-link">
                          <i class="nav-icon bi bi-person"></i>
                          <p>Profil</p>
                        </a>
                      </li>
                      <!-- Hide users and tambahusers for siswa -->
                      <!-- <li class="nav-item">
                        <a href="users.php" class="nav-link">
                          <i class="bi bi-people"></i>
                          <p>Users</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="tambahusers.php" class="nav-link">
                          <i class="bi bi-person-add"></i>
                          <p>Tambah Users</p>
                        </a>
                      </li> -->
                      <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </a>
                      </li>
                </ul>
              </li>
              <?php endif; ?>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
