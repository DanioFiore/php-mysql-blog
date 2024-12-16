<?php if(isset($_SESSION['msg'])): ?>
  <div class="msg <?php echo $_SESSION['type']; ?>">
    <li><?php echo $_SESSION['msg']; ?></li>
  </div>
  <!-- UNSET THESE PROPS TO AVOID THE MSG IS ALWAYS DISPLAYED -->
  <?php 
    unset($_SESSION['msg']);
    unset($_SESSION['type']);
  ?>
<?php endif; ?>