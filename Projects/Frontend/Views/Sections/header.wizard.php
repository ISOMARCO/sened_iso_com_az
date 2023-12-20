<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- SEARCH FORM -->
    <form method="post" class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::base('home')}}" class="brand-link">
      <span class="brand-text font-weight-light">Sənəd</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Session::ad()}} {{Session::soyad()}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{URL::base('home')}}" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p>Ana Səhifə</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::base('words')}}" class="nav-link">
              <i class="fas fa-book nav-icon"></i>
              <p>Sözlər</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::base('manifest')}}" class="nav-link">
              <i class="fas fa-file-excel nav-icon"></i>
              <p>Manifest</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::base('fileupload')}}" class="nav-link">
              <i class="fas fa-file-upload nav-icon"></i>
              <p>Sənəd Yüklə</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::base('logs')}}" class="nav-link">
              <i class="fas fa-history nav-icon"></i>
              <p>Logs</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<div class="content-wrapper">
<section class="content">
<div class="container-fluid">