<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter produit</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>

<body>
    <?php require_once('header.php'); ?>
    <div class="body">

        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo '<div id="info-message">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <div class="forms">
            <div title="Tooltip">
                <h1>Ajouter un produit</h1>
            </div>
            <form action="traitement.php?action=add" method="post" class="main_forms" enctype="multipart/form-data"> <!-- enctype -->
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="nameP" class="color">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price" min="0" class="color">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value="1" min="0" class="color">
                    </label>
                </p>
                <p>
                    <label for="description">
                        Description
                    </label>
                    <textarea name="description" id="description" class="color"></textarea><!--color-->
                </p>
                <p>
                    <label for="file">Photo</label>
                    <input type="file" name="file">
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="submit" class="color">
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>