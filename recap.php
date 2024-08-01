<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('header.php'); ?>
    
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
            "</tr>",
            "</thead>",
            "<tbody>";
            $totalGeneral = 0;
            $totalProduits = 0;
            foreach ($_SESSION['products'] as $index => $product) {
                echo    '<tr class="order">',
                "<td>" . $index . "</td>",
                "<td>" . $product['name'] . "</td>",
                "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                '<td><a href="traitement.php?action=up-qtt"><i class="fa-solid fa-plus"></i></a>' . $product['qtt'] . '<a href="traitement.php?action=down-qtt"><i class="fa-solid fa-minus"></i></a></td>',
                "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                '<td><a href="traitement.php?action=delete&id='.$index.'"><i class="fa-solid fa-trash"></i></a></td>',
                "</tr>";
                $totalGeneral += $product['total'];
                $totalProduits += $product['qtt'];
            }
            echo        "<tr>",
            "<td colspan=4>Total général : </td>",
            "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
            "</tr>",
            "<tr>",
            "<td colspan=6>Produits dans le panier : $totalProduits</td>",
            "</tr>",
            "</tbody>",
            "</table>";
            echo '</div>';
        }
        // session_destroy();
        ?>
        <div class="clear">
            <a href="traitement.php?action=clear">
                <i class="fa-solid fa-trash"></i>
            </a>
            <p>Clear Order</p>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>