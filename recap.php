<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('header.php');
    require './bdd.php'; ?>
    <div class="body">
        <?php
        if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo '<div class="pas_de_produit">';
            echo "<p>Aucun produit en session...</p>";
            echo '</div>';
        } else {
            echo '<div class="table_container">';
            echo    '<table id="table">',
            "<thead>",
            "<tr>",
            "<th>#</th>",
            "<th>Nom</th>",
            "<th>Prix</th>",
            "<th>Quantité</th>",
            "<th>Total</th>",
            "<th>Description</th>",
            "<th>Photo</th>",
            "<th>Dlt</th>",
            "</tr>",
            "</thead>",
            "<tbody>";
            $totalGeneral = 0;
            $totalProduits = 0;
            foreach ($_SESSION['products'] as $index => $product) { //nvl ligne par produit
                echo    '<tr class="order">',
                "<td>" . $index . "</td>",
                "<td>" . $product['nameP'] . "</td>",
                "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                '<td class="qtt_changer"><a href="traitement.php?action=up-qtt&id=' . $index . '"><i class="fa-solid fa-plus"></i></a>' . $product['qtt'] . '<a href="traitement.php?action=down-qtt&id=' . $index . '"><i class="fa-solid fa-minus"></i></a></td>',
                "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                "<td>" . $product['description'] . "</td>",
                "<td>" . "<img src=" . "upload/" . $product['file'] . " width='300px'>" . "</td>",
                '<td><a href="traitement.php?action=delete&id=' . $index . '"><i class="fa-solid fa-trash"></i></a></td>',
                "</tr>";
                $totalGeneral += $product['total'];
                $totalProduits += $product['qtt'];
            }
            echo        "<tr>",
            "<td colspan=4>Total général : </td>",
            "<td colspan=3><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
            "</tr>",
            "<tr>",
            "<td colspan=7>Produits dans le panier : $totalProduits</td>", //Produits dans le panier : $totalProduits
            "</tr>",
            "</tbody>",
            "</table>";
            echo '</div>';
        }
        ?>
        <div class="clear_container">
            <a href="traitement.php?action=clear" class="clear">
                Clear Order
            </a>
        </div>

        <!-- FONCTIONNE -->
        <?php
        // require './bdd.php';
        // $req = $db->query('SELECT name FROM file');
        // while ($data = $req->fetch()) {
        //     echo "<img src='./upload/" . $data['name'] . "' width='300px' ><br>";
        // }
        ?>


    </div>
</body>

</html>