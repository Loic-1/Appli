<?php

session_start();

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
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

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    switch ($_GET['action']) {
        case "clear":
            unset($_SESSION['products']);
            header("Location:recap.php");
            exit;
        case "delete":
            if (isset($_SESSION['products'][$id])) {
                unset($_SESSION['products'][$id]);
                // Re-index the array to maintain consistency
                $_SESSION['products'] = array_values($_SESSION['products']);
            }
            header("Location:recap.php");
            exit;
        case "up-qtt":
            if (isset($_SESSION['products'][$id])) {
                $_SESSION['products'][$id]['qtt']++;
                $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];
            }
            header("Location:recap.php");
            exit;
        case "down-qtt":
            if (isset($_SESSION['products'][$id])) {
                if ($_SESSION['products'][$id]['qtt'] > 1) {
                    $_SESSION['products'][$id]['qtt']--;
                    $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];
                } else {
                    unset($_SESSION['products'][$id]);
                    $_SESSION['products'] = array_values($_SESSION['products']);
                }
            }
            header("Location:recap.php");
            exit;
    }
}

// Redirect to index.php as fallback
header("Location:index.php");
