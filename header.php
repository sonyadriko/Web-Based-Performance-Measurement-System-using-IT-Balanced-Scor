<div class="page-header">
  <nav class="navbar navbar-expand-lg d-flex justify-content-between">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav" id="leftNav">
        <li class="nav-item">
          <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
        </li>
      </ul>
    </div>

    <div class="logo">
      <a class="navbar-brand" href="index.php"></a>
    </div>

    <div class="collapse navbar-collapse" id="headerNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="assets/images/img-user.jpg" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
            <p class="dropdown-item" style="font-weight: bold;"><?php echo $_SESSION['nama'] ?></p>
            <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i>Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>
