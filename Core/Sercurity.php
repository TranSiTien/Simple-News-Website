<?php


namespace Core;


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



function is_admin()
{
    global $connect_DB;
    if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name']) && isset($_SESSION['admin_email'])) {
        $id = $_SESSION['admin_id'];
        $email = $_SESSION['admin_email'];
        $name = $_SESSION['admin_name'];

        $sql = "select count(id) from admin where id = $id and email = '$email' and name = '$name'";
        $result = $connect_DB->execute_sql($sql);
        $num_row = mysqli_fetch_array($result)[0];
        if ($num_row) {
            return true;
        } else {
            return false;
        }
    }
}

function is_super_admin()
{
    global $connect_DB;
    if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name']) && isset($_SESSION['admin_email'])) {
        $id = $_SESSION['admin_id'];
        $email = $_SESSION['admin_email'];
        $name = $_SESSION['admin_name'];

        $sql = "select count(id) from super_admin where id = $id and email = '$email' and name = '$name' and manager_id is null";
        $result = $connect_DB->execute_sql($sql);
        $num_row = mysqli_fetch_array($result)[0];
        if ($num_row) {
            return true;
        } else {
            return false;
        }
    }
}

function is_customer()
{
    global $connect_DB;
    require_once __DIR__ . "/database/db-handeler/bootstrap.php";
    if (isset($_SESSION['customer_id'])  && isset($_SESSION['customer_email'])) {
        $id = $_SESSION['customer_id'];
        $email = $_SESSION['customer_email'];
        $name = $_SESSION['customer_name'];

        $sql = "select count(id) from customers where id = $id and email = '$email'";
        $result = $connect_DB->execute_sql($sql);
        $num_row = mysqli_fetch_array($result)[0];
        if ($num_row) {
            return true;
        } else {
            return false;
        }
    }
}
