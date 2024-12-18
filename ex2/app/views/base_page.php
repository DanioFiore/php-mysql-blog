<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?? 'Blog'; ?></title>
  <link rel="stylesheet" href="<?php echo ROOT_PATH . '/public/css/style.css'; ?>">
</head>
<body>

  <!-- HEADER -->
  <?php include(ROOT_PATH . '/app/views/components/header.php'); ?>

  <!-- MAIN CONTENT -->
  <main>
    <?php include($content); ?>
  </main>

  <!-- FOOTER -->
  <?php include(ROOT_PATH . '/app/views/components/footer.php'); ?>

</body>
</html>