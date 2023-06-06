<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SAKAYCLE | A Web-based Tricycle Management</title>
  <link rel="icon" href="<?=ROOT?>/assets/images/logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/flash_messages.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/{{css}}">
</head>
<body>
  <?php display_flash_message(); ?>

  {{content}}
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script src="<?=ROOT?>/assets/js/flash_messages.js"></script>
  <script src="<?=ROOT?>/assets/js/password_toggle.js"></script>
</body>
</html>