<?php

$heading = "LOGIN";

function is_input_empty($username, $pwd) {
  if (empty($username) ||  empty($pwd)) {
      return true;
  } else {
      return false;
  }
}
function is_username_wrong($result) {
  if (!$result){
      return true;
  } else {
      return false;
  }
}
function is_password_wrong($pwd, $hashedPwd) {
  if (!password_verify($pwd, $hashedPwd)){
      return true;
  } else {
      return false;
  }
}

if (isLoggedIn()) {
    header('Location: /products?error=alreadyLoggedIn');
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
  require "views/login.view.php";
} elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
  $username = $_POST['username'];
  $pwd = $_POST['pwd'];

  try {
    require_once './model/user.model.php';
    require_once "./model/cart.model.php";
    //Error handlers
    $errors = [];
    if (is_input_empty($username, $pwd)) {
        $errors['empty_input'] = "Please fill in all fields!";
    }
    //Getting result
    $result = get_user($pdo, $username);
    if (is_username_wrong($result)) {
        $errors['login_incorrect'] = "Incorrect login info!";
    }
    if (!is_username_wrong($result) && is_password_wrong($pwd, $result['pwd'])) {
        $errors['login_incorrect'] = "Incorrect login info!";
    }

    if ($errors) {
        $_SESSION['errors_login'] = $errors;
        header('Location: /login?login=failed');
        die();
    }


    $cart = get_cart_by_id($pdo, $result['user_id']);
    $role = get_role($pdo, $result['user_id']);

    $newSessionID = session_create_id();
    $sessionID = $newSessionID . "_" . $result['user_id'];
    session_id($sessionID);

    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['user_username'] = htmlspecialchars($result['username']);
    $_SESSION['last_regeneration'] = time();
    $_SESSION['cart'] = $cart;
    $_SESSION['role'] = $role['role_name'];

    header('Location: /products?login=success');
    $pdo = null;
    $stmt = null;
    die();
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
}