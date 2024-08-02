<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter produit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('header.php'); ?>
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo '<div id="info-message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
        // echo "<script>",
        // 'alert('.$_SESSION['message'].');',
        // "</script>";
    }
    ?>
    <div class="body">
        <div class="forms">
            <div title="Tooltip">
                <h1>Ajouter un produit</h1>
            </div>
            <form action="traitement.php" method="post" class="main_forms">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="submit">
                </p>
            </form>
        </div>
    </div>
    <script>
        // https://stackoverflow.com/questions/5988909/php-echo-message-for-a-specified-amount-of-time
        setTimeout(function() {
            document.getElementById('info-message').style.display = 'none';
            /* or
            var item = document.getElementById('info-message')
            item.parentNode.removeChild(item); 
            */
        }, 5000);
    </script>
</body>

</html>