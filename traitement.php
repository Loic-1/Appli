<?php

session_start();

if (isset($_POST['submit'])) {
    // $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $name = htmlspecialchars("name" ?? '');
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

    if ($name && $price && $qtt) {
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price * $qtt,
        ];

        $_SESSION['products'][] = $product;
    }
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "clear":
            session_destroy();// ou unset($_SESSION['products']);
            header("Location:recap.php");
            break;
        case "delete":
            // unset($_SESSION['products']['id']);
            header("Location:recap.php");
            break;
        case "up-qtt":
            $_SESSION['products'][$index]['qtt']++;
            header("Location:recap.php");
            exit;
        case "down-qtt":
            if($_SESSION['products']['qtt']>1){
                $_SESSION['products']['qtt']['id']--;
            }
            else{
                //delete at index
            }
            header("Location:recap.php");
            break;
    }
}

// header("Location:index.php");
echo "<SCRIPT type='text/javascript'>";
echo "window.location.href='index.php';";
echo "window.alert('szss');";
echo "</SCRIPT>";
