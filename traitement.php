<?php

session_start();

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);//DEPRECATDED ???
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
        $_SESSION['message'] = "Le produit a été ajouté avec succès!!";
    }
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $index = $_GET['id'];
    switch ($_GET['action']) {
        case "clear":
            unset($_SESSION['products']);
            header("Location:recap.php");
            break;
        case "delete":
            if (isset($_SESSION['products'][$index])) {//isset() regarde si une variable est déclarée et non NULL
                unset($_SESSION['products'][$index]);
            }
            header("Location:recap.php");
            exit;
        case "up-qtt":
            if (isset($_SESSION['products'][$index])) {
                $_SESSION['products'][$index]['qtt']++;
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt']; //update car qtt++
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
            if (isset($_SESSION['products'][$index])) {
                if ($_SESSION['products'][$index]['qtt'] > 1) {
                    $_SESSION['products'][$index]['qtt']--;
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt']; //update car qtt++
                } else {
                    unset($_SESSION['products'][$index]); //qtt == 0 => ligne peut disparaître
                }
            }
            header("Location:recap.php");
            break;
    }
}

header("Location:index.php");
// echo "<SCRIPT type='text/javascript'>";
// echo "window.location.href='index.php';";
// echo "window.alert('szss');";
// echo "</SCRIPT>";
