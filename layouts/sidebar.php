<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="./index.html">
      <img src="./assets/img/brand/Logo_PLN.svg.png" class="navbar-brand-img" alt="...">
    </a>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      <!-- Navigation -->
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') : ?>
          <li class="nav-item  active ">
            <a class="nav-link active" href="user.php?page=daftar">
              <i class="fa fa-address-card text-dark"></i> Daftar
            </a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff') : ?>
          <li class="nav-item  active ">
            <a class="nav-link  active " href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php?page=tarif' : 'staff.php?page=tarif' ?>">
              <i class="fa fa-bolt text-primary"></i> Tarif
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php?page=pelanggan' : 'staff.php?page=pelanggan' ?>">
              <i class="fa fa-user-tie text-info"></i> Pelanggan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php?page=penggunaan' : 'staff.php?page=penggunaan' ?>">
              <i class="fa fa-plug"></i> Penggunaan
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link " href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php?page=tagihan' : (($_SESSION['role'] == 'staff') ? 'staff.php?page=tagihan' :
                                        'user.php?page=tagihan') ?>">
            <i class="fa fa-paper-plane text-danger"></i> Tagihan
          </a>
        </li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') : ?>
          <li class="nav-item">
            <a class="nav-link " href="<?= ($_SESSION['role'] == 'user') ? 'user.php?page=pembayaran' : 'staff.php?page=pembayaran' ?>">
              <i class="fa fa-credit-card text-primary"></i> Pembayaran
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item active active-pro">
          <a class="nav-link" href="https://www.creative-tim.com/product/argon-dashboard" target="_blank">
            <i class="ni ni-send text-dark"></i> Design By Creative-Tim
          </a>
        </li>
      </ul>
      <!-- END OF NAVIGATION -->
    </div>
  </div>
</nav>