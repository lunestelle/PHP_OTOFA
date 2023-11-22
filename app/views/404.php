<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>404 Not Found</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/fontawesome/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    .error-container {
      text-align: center;
      padding: 20px;
      border-radius: 10px;
    }

    .error-code {
      font-size: 120px;
      font-weight: bold;
      color: #dc3545;
    }

    .error-message {
      font-size: 24px;
      margin-top: 10px;
      color: #6c757d;
    }

    .back-to-home {
      margin-top: 30px;
    }

    .back-to-home a {
      text-decoration: none;
      font-size: 18px;
      padding: 12px 24px;
      background-color: #007bff;
      color: #fff;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .back-to-home a:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <!-- 404 Page -->
  <div class="error-container">
    <div class="error-code">404</div>
    <div class="error-message">Oops! The page you're looking for doesn't exist.</div>
    <?php if (!is_authenticated()): ?>
      <p class="error-message">You can navigate back to the homepage by clicking on the button below.</p>
    <?php elseif (is_authenticated()): ?>
      <p class="error-message">You can navigate back to the dashboard by clicking on the button below.</p>
    <?php endif; ?>
    <p class="back-to-home">
      <?php if (!is_authenticated()): ?>
        <a href="<?=ROOT?>" class="btn btn-primary">Back to Homepage</a>
      <?php elseif (is_authenticated()): ?>
        <a href="<?= ROOT . '/dashboard' ?>" class="btn btn-primary">Back to Dashboard</a>
      <?php endif; ?>
    </p>
  </div>

  <script src="<?=ROOT?>/assets/bootstrap/js/jquery.min.js"></script>
  <script src="<?=ROOT?>/assets/bootstrap/js/popper.min.js"></script>
  <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>