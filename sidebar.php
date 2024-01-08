<div class="page-sidebar">
                <ul class="list-unstyled accordion-menu">
                  <li class="sidebar-title">
                    Main
                  </li>
                  <li class="active-page">
                    <a href="index.php"><i data-feather="home"></i>Dashboard</a>
                  </li>
              <?php if($_SESSION['role'] == '1') { ?>
                  <li class="active-page">
                    <a href="perspektif.php"><i data-feather="home"></i>Perspektif</a>
                  </li>
                  <li class="active-page">
                    <a href="peta_strategi.php"><i data-feather="home"></i>Peta Strategi</a>
                  </li>
                  <li class="active-page">
                    <a href="action_plan.php"><i data-feather="home"></i>Action Plan</a>
                  </li>
      <?php } ?>
              <?php if($_SESSION['role'] == '2') { ?>
                <li class="active-page">
                    <a href="hitung.php"><i data-feather="home"></i>Hitung</a>
                  </li>
      <?php } ?>
                  
                </ul>
            </div>