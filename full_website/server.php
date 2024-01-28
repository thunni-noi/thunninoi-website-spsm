<?php
session_start();

// initializing variables
$username = "";
$errors = [];
$table_name = "members";

// connect to the database
$db = mysqli_connect("localhost", "root", "", "thunninoi_db");

// REGISTER USER
if (isset($_POST["reg_user"])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $user_perm = mysqli_real_escape_string($db, $_POST["userStatus"]);
    $password_1 = mysqli_real_escape_string($db, $_POST["password_1"]);
    $password_2 = mysqli_real_escape_string($db, $_POST["password_2"]);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM " . $table_name. " WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // if user exists
        if ($user["username"] === $username) {
            array_push($errors, "Username already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO " . $table_name. " (username, password, userStatus) 
  			  VALUES('$username', '$password', '$user_perm')";
        mysqli_query($db, $query);
        $_SESSION["username"] = $username;
        $_SESSION["success"] = "register";
        $_SESSION["userstat"] = $user_perm;
    }
}

// LOGIN USER
if (isset($_POST["login_user"])) {
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM " . $table_name. " WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        $result_val = mysqli_fetch_array($results, MYSQLI_ASSOC);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["success"] = "login";
            $_SESSION["userstat"] = $result_val["userStatus"];
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

//EDIT USER
if (isset($_POST["edit_user"])) {
    // receive all input values from the form
    $user_id = $_POST["user_id"];
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $userstat = mysqli_real_escape_string($db, $_POST["userStatus"]);

    echo $user_id;

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if ($userstat != "admin" and $userstat != "user") {
        array_push($errors, "Stat can only be admin or user");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM " . $table_name. " WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password_md5 = md5($password); //encrypt the password before saving in the database

        $query = $sql = "UPDATE `" . $table_name. "` SET `username`='$username',`password`='$password_md5',`userStatus`='$userstat' WHERE " . $table_name. ".userID = $user_id";
        mysqli_query($db, $query);
        $_SESSION["success"] = "edit";
    }
}

//ADMIN ADD USER
if (isset($_POST["add_user"])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $user_perm = mysqli_real_escape_string($db, $_POST["userStatus"]);
    $password_1 = mysqli_real_escape_string($db, $_POST["password_1"]);
    $password_2 = mysqli_real_escape_string($db, $_POST["password_2"]);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM " . $table_name. " WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // if user exists
        if ($user["username"] === $username) {
            array_push($errors, "Username already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO " . $table_name. " (`username`, `password`, `userStatus`) 
  			  VALUES('$username', '$password', '$user_perm')";
        mysqli_query($db, $query);
        $_SESSION["success"] = "admin-add";
    }
}

if (isset($_POST["delete_user"])) {
    // receive all input values from the form
    $conf_delete = mysqli_real_escape_string($db, $_POST["conf_delete"]);
    $user_id = $_POST["user_id"];

    //get username
    $sql = "SELECT * FROM " . $table_name. " WHERE UserID = $user_id LIMIT 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row["username"] != $conf_delete) {
        array_push($errors, "Incorrect username, please try again");
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $query = "DELETE FROM `" . $table_name. "` WHERE userID = $user_id";
        mysqli_query($db, $query);
        $_SESSION["success"] = "admin-delete";
    }
}
?>

