<?php include "server.php";
if ($_SESSION["userstat"] != "admin") {
    array_push($errors, "You do not have permission!");
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>thunninoi's page [admin]</title>
    <link rel="icon" type="image/x-icon" href="assets/pfp.ico">
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    SQL Managing
  </nav>

  <div class="container">
    <?php if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' .
            $msg .
            '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    } ?>
    <a href="admin_add.php" class="btn btn-dark mb-3">Add New</a>
    <a href="index.php" class="btn btn-dark mb-3">Back to home page</a>

    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">userID</th>
          <th scope="col">username</th>
          <th scope="col">password</th>
          <th scope="col">userStatus</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `members`";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row["userID"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["password"]; ?></td>
            <td><?php echo $row["userStatus"]; ?></td>
            <td>
                <a href="admin_edit.php?id=<?php echo $row[
                    "userID"
                ]; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="admin_delete.php?id=<?php echo $row[
                    "userID"
                ]; ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
          </tr>
        <?php }
        ?>
      </tbody>
    </table>
    <?php include "error.php"; ?>
    <?php include "success.php"; ?>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>