<?php

session_start();

if (isset($_POST['submit'])) {
    // $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $name = htmlspecialchars("name");
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
            header("Location:recap.php");
            session_destroy();
            break;
        case "delete":
            header("Location:recap.php");
            break;
        case "up-qtt":
            header("Location:recap.php");
            break;
        case "down-qtt":
            header("Location:recap.php");
            break;
    }
}

// header("Location:index.php");
echo "<SCRIPT type='text/javascript'>",
"window.alert('szss');",
"window.location.href='index.php';",
"</SCRIPT>";
