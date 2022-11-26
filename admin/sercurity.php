<?php
// make a ramdom token
function makeToken(int $length = 50)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%&*';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// check token
function checkToken($connect_DB, string $token)
{

    $sql = "select count(*) from customers where token = '$token'";
    $result = mysqli_query($connect_DB, $sql);
    $num_row = mysqli_fetch_array($result)[0];
    if ($num_row) {
        return true;
    } else {
        return false;
    }
}

// check admin if admin using feature of page
function checkAdmin($connect_DB)
{
    $token = $_COOKIE['admin_token'];
    $id = $_SESSION['admin_id'];
    $email = $_SESSION['admin_email'];
    $name = $_SESSION['admin_name'];
    $sql = "select count(*) from admin where token = '$token' and id = $id and email = '$email' and name = '$name'";
    $result = mysqli_query($connect_DB, $sql);
    $num_row = mysqli_fetch_array($result)[0];
    if ($num_row) {
        return true;
    } else {
        return false;
    }
}

// check customer if customer using feature of page
function checkCustomer($connect_DB)
{
    $token = $_COOKIE['customer_token'];
    $id = $_SESSION['customer_id'];
    $email = $_SESSION['customer_email'];
    $name = $_SESSION['customer_name'];
    $sql = "select count(*) from customers where token = '$token' and id = $id and email = '$email' and name = '$name'";
    $result = mysqli_query($connect_DB, $sql);
    $num_row = mysqli_fetch_array($result)[0];
    if ($num_row) {
        return true;
    } else {
        return false;
    }
}
