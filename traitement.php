<?php

session_start();

if (isset($_GET['action'])) {
    $index = isset($_GET['id']) ? $_GET["id"] : "";
    switch ($_GET['action']) {
        case "add":
            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // 
                // PHOTO

                // if (isset($_FILES['file'])) {
                //     $tmpName = $_FILES['file']['tmp_name'];
                //     $nameP = $_FILES['file']['name'];
                //     $size = $_FILES['file']['size'];
                //     $error = $_FILES['file']['error'];

                //     $tabextension = explode('.', $nameP);
                //     $extension = strtolower(end($tabextension));
                //     $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                //     $maxSize = 400000;

                //     if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                //         $uniqueName = uniqid('', true);
                //         $file = $uniqueName . '.' . $extension;
                //         move_uploaded_file($tmpName, './upload/' . $nameP);
                //         $req = $db->prepare('INSERT INTO file (name) VALUES (?)');
                //         $req->execute([$file]);
                //     } else {
                //         echo 'mauvaise extension';
                //     }
                // }

                // PHOTO
                // 

                if ($name && $price && $qtt && $description) {
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt,
                        "description" => $description,
                    ];

                    $_SESSION['products'][] = $product;
                    $_SESSION['message'] = "Le produit a été ajouté avec succès!!";
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
