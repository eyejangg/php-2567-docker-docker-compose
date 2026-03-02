<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="Npru-logo.png" alt="NPRU Logo" width="40" class="me-2">
        <span class="fw-bold">NPRU Personnel</span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class='bx bx-home-alt-2'></i> หน้าแรก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rank.php"><i class='bx bx-list-ul'></i> รายชื่อบุคลากร แยกตามตำแหน่ง</a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-3">
        <form action="search.php" method="POST" class="d-flex">
            <div class="input-group">
                <input type="text" name="p_data" class="form-control form-control-sm" placeholder="ค้นชื่อหรือนามสกุล..." required>
                <button class="btn btn-primary btn-sm" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </form>
        
        <?php if(isset($_SESSION['p_id'])): ?>
            <div class="dropdown">
                <a class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-user-circle fs-5 me-1'></i> <?php echo explode(' ', $_SESSION['p_name'])[0]; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item py-2" href="<?php echo ($_SESSION['p_level'] == 'a' ? 'admin_page.php' : 'user_page.php'); ?>"><i class='bx bx-dashboard'></i> แดชบอร์ด</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="logout.php"><i class='bx bx-log-out'></i> ออกจากระบบ</a></li>
                </ul>
            </div>
        <?php else: ?>
            <a href="login.php" class="btn btn-outline-light btn-sm px-3"><i class='bx bx-log-in'></i> เข้าสู่ระบบ</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<!-- Add Boxicons CSS for Navbar icons -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
