<!DOCTYPE html>
<html>
<head>
  <title>Sidebar Example</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    #sidebar {
      width: 200px;
      height: 100vh;
      background-color: #090C1B;
      color: #fff;
      padding: 20px;
      position: fixed;
      left: 0;
      top: 0;
      overflow-y: auto;
    }

    #content {
      margin-left: 200px;
      padding: 20px;
    }

    h1 {
      color: #333;
    }

    @media only screen and (max-width: 768px) {
      #sidebar {
        width: 100%;
        height: auto;
        position: static;
      }

      #content {
        margin: 20px;
      }
    }
  </style>
</head>
<body>
  <div id="sidebar">
    <h1>Sidebar</h1>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </div>
  <div id="content">
    <h1>Content Area</h1>
    <p>This is the main content of the page.</p>
  </div>
</body>
</html>