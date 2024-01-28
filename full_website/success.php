<?php if (isset($_SESSION["success"])):

echo $_SESSION["success"];
echo '<div class="alert alert-success" role="alert">';
switch ($_SESSION["success"]) {
    case "login":
        echo "Logged in! <br> Welcome ",
            $_SESSION["username"],
            "(",
            $_SESSION["userstat"],
            ")";
        $redirect_url = "index.php";
        break;
    case "register":
        echo "Registered! <br> Welcome ",
            $_SESSION["username"],
            "(",
            $_SESSION["userstat"],
            ")";
        $redirect_url = "index.php";
        break;
    case "edit":
        echo "Edited!";
        break;
    case "admin-add":
        echo "User added!";
        break;
    case "admin-delete":
        echo "User deleted!";
        break;
}
echo "</div>";
#unset($_SESSION['success']);
$_SESSION["success"] = "";
if (isset($redirect_url)) {
    echo '<meta http-equiv = "refresh" content = "2; url =',
        $redirect_url,
        ' " />';
}
?>
<?php
endif; ?>
