<div class="auth-content">
  <form action="/users/signup" method="POST">
    <h2 class="form-title">Signup</h2>

    <div>
      <label>Email</label>
      <input type="email" name="email" class="text-input" value="<?php echo $email; ?>">
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password" class="text-input" value="<?php echo $password; ?>">
    </div>
    <div>
      <label>Password Confirmation</label>
      <input type="password" name="passwordConf" class="text-input" value="<?php echo $passwordConf; ?>">
    </div>
    <div>
      <button type="submit" name="signup-btn" class="btn btn-big">Signup</button>
    </div>
    <p>Or <a href="<?php echo BASE_URL . "/login" ?>">Login</a></p>
  </form>
</div>