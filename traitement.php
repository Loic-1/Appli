<?php

session_start();

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    // $name = htmlspecialchars("name" ?? '');
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
            unset($_SESSION['products']);
            header("Location:recap.php");
            break;
        case "delete":
            // foreach ($_SESSION['products'] as $index => $product) {
            //     if ('id' == $index) {
            //         unset($_SESSION['products']['id']);
            //         exit;
            //     }
            // }
            if (isset($_SESSION['products']['id'])) {
                unset($_SESSION['products']['id']);
                // Re-index the array to maintain consistency
                $_SESSION['products'] = array_values($_SESSION['products']);
            }
            header("Location:recap.php");
            exit;
        case "up-qtt":
            if (isset($_SESSION['products']['id'])) {
                $_SESSION['products']['id']['qtt']++;
                $_SESSION['products']['id']['total'] = $_SESSION['products']['id']['price'] * $_SESSION['products']['id']['qtt'];
            }
            header("Location:recap.php");
            exit;
        case "down-qtt":
            // if ($_SESSION['products'][$index]['qtt'] > 1) {
            //     $_SESSION['products'][$index]['qtt']--;
            // } else {
            //     foreach ($_SESSION['products'] as $index => $product) {
            //         if ('id' == $index) {
            //             unset($_SESSION['product'][$index]); //supprime la ligne du panier si qtt == 0
            //         }
            //     }
            // }
            // header("Location:recap.php");
            // break;

    }
}

// header("Location:index.php");
echo "<SCRIPT type='text/javascript'>";
echo "window.location.href='index.php';";
echo "window.alert('szss');";
echo "</SCRIPT>";
