<?php
session_start();
include "./functions.php";

$_SESSION['error'] = null;

if ($_SERVER['REQUEST_METHOD'] != "POST" || empty($_POST)) // check if the form was submitted using POST method and is not empty
    die("You are a bad guy and you are trying to access this code directly!");

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$sales = isset($_POST['sales']) ? $_POST['sales'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

$error = false;
$error_msg = '';


if (!empty($firstname) && !empty($lastname) && !empty($id)) {
    update_customer($firstname, $lastname, $email, $phone, $sales, $id);
} else {
    $error_msg = "Please fillout the required information (First Name, Last Name)";
    $error = true;
}

if ($error) {
    $_SESSION['error'] = $error_msg;
    header("Location: ./");
} else {
    header("Location: ./customer.php?id=$id");
}