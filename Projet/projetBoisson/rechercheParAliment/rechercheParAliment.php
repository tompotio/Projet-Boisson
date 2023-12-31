<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rechercheParAliment</title>
    <link rel="stylesheet" href="../arbreStyle.css">
    <link rel="stylesheet" href="rechercheParAliment.css">
    <script src="index.js" defer></script>
</head>
<body>
    <?php
    include_once("../tree.php");
    ?>
    <div class='page'>
        <div class="container">
            <div style = "display: flex; flex-direction: column; padding-right:10px">
                <h1 style='text-align:center;  '>configuration</h1>
                <div class='searchContainer'>  
                <h3 style='margin:auto;'>aliment souhaité</h3>
                <div class='inputSearch'>
                    <input class='' type="text">
                    <div></div>
                </div>
                    <div class='searchProductContainer desiré'></div>
                </div>
                <div class="mode">
                <label for="Intersection">Intersection</label>
                <input type="radio" value='Intersection' name='mode' checked="checked">
                <label for="Union">Union</label>
                <input type="radio" value='Union' name='mode'>
                </div>
                <div class='searchContainer'>
                    <h3 style='margin:auto;'>aliment non souhaité</h3>
                    <div class='inputSearch'>
                        <input class='' type="text">
                        <div></div>
                    </div>
                    <div class='searchProductContainer indesiré '></div>
                </div>
                <button class='addToCart' >rechercher</button>
            </div>
        </div>
        <div class="recipeContainer">
            <div class="grid"></div>
        </div>
    </div>
</body>
</html>