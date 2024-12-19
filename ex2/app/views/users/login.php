<div class="auth-content">

  <form action="/users/login_user" method="POST">
    <h2 class="form-title">Login</h2>

    <div>
      <label>Email</label>
      <input type="text" name="email" value="<?php echo $email; ?>" class="text-input">
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
    </div>
    <div>
      <button type="submit" name="login-btn" class="btn btn-big">Login</button>
    </div>
    <p>Or <a href="<?php echo BASE_URL . "/users/signup" ?>">Sign Up</a></p>
  </form>

</div>