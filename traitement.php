<?php

session_start();

if (isset($_GET['action'])) {
    $index = isset($_GET['id']) ? $_GET["id"] : "";
    switch ($_GET['action']) {
        case "add":
            if (isset($_POST['submit'])) {
                $nameP = filter_input(INPUT_POST, "nameP", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // 
                // PHOTO

                require './bdd.php';

                if (isset($_FILES['file'])) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];

                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));

                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    $maxSize = 400000;

                    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {

                        $uniqueName = uniqid('', true);
                        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                        $file = $uniqueName . "." . $extension;
                        //$file = 5f586bf96dcd38.73540086.jpg

                        move_uploaded_file($tmpName, './upload/' . $file);
                    }
                }

                // PHOTO
                // 

                if ($name && $price && $qtt && $description && $file) {
                    $product = [
                        "nameP" => $nameP,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt,
                        "description" => $description,
                        "file" => $file,
                    ];

                    $_SESSION['products'][] = $product;
                    $_SESSION['message'] = "Le produit a été ajouté avec succès!!";
                    // $_SESSION['messageN'] = "Il semble que quelque chose se soit mal passé!!";
                }

                header("Location:index.php");
                exit;
            }
            break;
        case "clear":
            unset($_SESSION['products']);
            header("Location:recap.php");
            exit;
            break;
        case "delete":
            if (isset($_SESSION['products'][$index])) { //isset() regarde si une variable est déclarée et non NULL
                unset($_SESSION['products'][$index]);
            }

            header("Location:recap.php");
            exit;
            break;
        case "up-qtt":
            if (isset($_SESSION['products'][$index])) {
                $_SESSION['products'][$index]['qtt']++;
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt']; //update car qtt++
            }
            header("Location:recap.php");
            exit;
            break;
        case "down-qtt":
            if (isset($_SESSION['products'][$index])) {
                if ($_SESSION['products'][$index]['qtt'] > 1) {
                    $_SESSION['products'][$index]['qtt']--;
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt']; //update car qtt++
                } else {
                    unset($_SESSION['products'][$index]); //qtt == 0 => ligne peut disparaître
                }
            }
            header("Location:recap.php");
            exit;
    }
}
