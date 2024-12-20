<header>
  <a href="/" class="logo">
    <h1 class="logo-text">
      Blog
    </h1>
  </a>
  <ul class="nav">
    <li><a href="/">Home</a></li>

    <!-- TO HAVE ACCESS TO $_SESSION WE NEED TO STARTING IT. WE DO THAT IN db.php FILE THAT IS INCLUDED IN index.php AND THIS FILE IS INCLUDED IN IT -->
    <?php if (isset($_SESSION['id'])): ?>
      <li>
        <a href="#">
          <i class="fa fa-user"></i>
          <?php echo $_SESSION['email']; ?>
          <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
        </a>
        <ul>
          <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
            <li><a href="<?php echo BASE_URL . '/admin/dashboard' ?>">Admin Dashboard</a></li>
          <?php endif; ?>
          <li><a href="<?php echo BASE_URL . '/users/logout' ?>" class="logout">Logout</a></li>
        </ul>
      </li>
    <?php else: ?>
      <li><a href="<?php echo BASE_URL . '/signup' ?>">Sign Up</a></li>
      <li><a href="<?php echo BASE_URL . '/login' ?>">Login</a></li>
    <?php endif; ?>

  </ul>
</header>