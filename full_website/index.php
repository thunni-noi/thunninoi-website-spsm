<?php
include "server.php";
if (isset($_GET["logout"])) {
    session_destroy();
    unset($_SESSION["username"]);
    unset($_SESSION["userstat"]);
    header("location: index.php");
}
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>thunninoi's page</title>
    <link rel="icon" type="image/x-icon" href="assets/pfp.ico">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    

    <!-- Bootstrap core CSS -->
<link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap');
        :root {
            --bs-font-sans-serif: Nunito;
        }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white  bg-dark"
  style="background-image: linear-gradient(rgba(0, 0, 0, 0.400), rgba(0, 0, 0, 0.400)), 
    url('assets/furina_bg.gif'); background-size:cover; background-repeat:no-repeat;
            height: 100vh">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Home Page</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <?php if (!isset($_SESSION["username"])) {
            echo '<a class="nav-link" href="sign-in.php">Login</a>';
            echo '<a class="nav-link" href="register.php">Register</a>';
        } else {
            echo '<a class="nav-link" href="index.php?logout=yes">Logout</a>';
        } ?>
        
        <?php if (isset($_SESSION["username"])) {
            echo '<a class="nav-link disabled"> ';
            echo $_SESSION["userstat"];
            echo " : ";
            echo $_SESSION["username"];
            echo "</a>";
        } ?>
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>This is main page!</h1>
    <p class="lead">You can click on button below after login to see contents</p>
    <?php include "error.php"; ?>
    <p class="lead">
      <?php if (isset($_SESSION["username"])) {
          echo '<a href="content.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white mx-2">View content</a>';
          if ($_SESSION["userstat"] == "admin") {
              echo '<a href="admin.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white mx-2">Admin page</a>';
          }
      } else {
          echo '<a href="sign-in.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Login</a>';
      } ?>
    </p>
  </main>

  <footer class="mt-auto text-white-50">
    <p>Made by thunninoi, yours truly - with Bootstrap 5, PHP, HTML and MySQL</p>
  </footer>
</div>


    
  </body>
</html>
