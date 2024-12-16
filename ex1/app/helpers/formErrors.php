<?php if (!empty($errors)): ?>
  <div class="msg error">
    <?php foreach($errors as $error): ?>
      <li>
        <?php echo $error ?>
      </li>
    <?php endforeach; ?>
  </div>
<?php endif; ?>