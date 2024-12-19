<?php include_once(ROOT_PATH . '/bootstrap.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?? 'Blog'; ?></title>
  <!-- here it already takes public folder -->
  <link rel="stylesheet" href="/css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
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