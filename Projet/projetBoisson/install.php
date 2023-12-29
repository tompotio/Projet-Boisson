<?php
include("../Donnees.inc.php");
include("../Identifiiant/identifiantSQL.inc.php");
$sql = "create DATABASE projetBoisson";
$successfull;
try{
       $connection = new PDO("mysql:host=$servername;dbname=$dataBase", $username);
       $creationUser  = "CREATE TABLE USER(id INT UNSIGNED AUTO_INCREMENT primary key,
        login varchar(50),
        password varchar(50),
        nom varchar(50) null,
        prenom varchar(50) null,
        mail varchar(50) null,
        sexe varchar(50) null,
        birthday DATE null,
        Street varchar(50) null,
        zipCode varchar(50) null,
        telephone varchar(10) null,
        city varchar(50) null)";
        $creationRecipes= "CREATE TABLE RECIPES(id int unsigned auto_increment primary key,
        Title text,
        ingredient text,
        recipe text)";
        $creationCart = "CREATE TABLE CART(userID INT unsigned,recipesID int,primary key(userID,recipesID),FOREIGN KEY (userID) REFERENCES USER(id))";
        $creationProducts = "CREATE TABLE PRODUCTS(productID int unsigned auto_increment primary key, product_name varchar(50))";
        $creationSubCat = "CREATE  TABLE SUBCAT(productID int unsigned,childID int unsigned, primary key(productID,childID),foreign key (productID) REFERENCES PRODUCTS(productID),foreign key (childID) references PRODUCTS(productID))";
        $creationSuperCat = "CREATE TABLE SUPCAT(productID int unsigned,parentID int unsigned, primary key(productID,parentID),foreign key (productID) REFERENCES PRODUCTS(productID),foreign key (parentID) references PRODUCTS(productID))"; 
        $creationCompose = "CREATE TABLE COMPOSITION(productID int unsigned,recipeID int unsigned, primary key(productID,recipeID),foreign key (productID) references PRODUCTS(productID),foreign key (recipeID) references RECIPES (id))";
        $connection->exec($creationUser);
        $connection->exec($creationRecipes);
        $connection->exec($creationCart);
        $connection->exec($creationProducts);
        $connection->exec($creationSubCat);
        $connection->exec($creationSuperCat);
        $connection->exec($creationCompose);
        echo "table created successfully<br>";
        $successfull = true;
    }

    catch(PDOException $error){
        echo($error->getMessage());
        $successfull = false;
    }
    if($successfull){
        $list = '';
        $numItem = 0;
        $length =count($Hierarchie,COUNT_NORMAL);
       
        foreach( $Hierarchie as $key => $product){
            $numItem=$numItem+1;
            if($numItem==$length){
                $list = $list.'("'.$key.'")';
            }
            else{
                $list = $list.'("'.$key.'")'.',';
            }  
        }
        $insertRequest = "insert INTO PRODUCTS(product_name) values" . $list;
        $connection->exec($insertRequest);
        foreach( $Hierarchie as $key => $product){
            $requete = "SELECT productID FROM PRODUCTS WHERE product_name = :nomProduit";
            $statement = $connection->prepare($requete);
            $statement->bindParam(':nomProduit', $key, PDO::PARAM_STR);
            $statement->execute();
            $productID = $statement->fetch(PDO::FETCH_ASSOC);
            $productID =$productID['productID'];
            if(isset($product['sous-categorie'])){ 
                foreach($product['sous-categorie'] as $sub){
                $requete = "SELECT productID FROM PRODUCTS WHERE product_name = :nomProduit";
                $statement = $connection->prepare($requete);
                $statement->bindParam(':nomProduit', $sub, PDO::PARAM_STR);
                $statement->execute();
                $childID = $statement->fetch(PDO::FETCH_ASSOC);
                $childID = $childID['productID'];
                $insertCatRequest = "INSERT INTO SUBCAT(productID,childID) values ($productID,$childID)";
                $connection->exec($insertCatRequest);
                }
            }
            if(isset($product['super-categorie'])){
                foreach($product['super-categorie'] as $sup){
                    $requete = "SELECT productID FROM PRODUCTS WHERE product_name = :nomProduit";
                    $statement = $connection->prepare($requete);
                    $statement->bindParam(':nomProduit', $sup, PDO::PARAM_STR);
                    $statement->execute();
                    $parentID = $statement->fetch(PDO::FETCH_ASSOC);
                    $parentID = $parentID['productID'];
                    $insertCatRequest = "INSERT INTO SUPCAT(productID,parentID) values ($productID,$parentID)";
                    $connection->exec($insertCatRequest);
                }
            }
            
           
        }

        
       
        foreach($Recettes as $keyRecettes=> $value){
            $titre = $value['titre'];
            $ingredients = $value['ingredients'];
            $recipe = $value['preparation'];
           $insertRecipeRequest ='INSERT INTO RECIPES(Title,ingredient,recipe) values (:nomProduits,:ingredients,:recette)';
           $statement = $connection->prepare($insertRecipeRequest);
           $statement->bindParam(':nomProduits', $titre, PDO::PARAM_STR);
           $statement->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
           $statement->bindParam(':recette', $recipe, PDO::PARAM_STR);
           $statement->execute();
            foreach($value['index'] as $keyIngredients => $ingredient){
                $idRecipe = $keyRecettes+1;
                $idIngredientRequest = "select productID from products where product_name=?";
                $statement = $connection->prepare($idIngredientRequest);
                $statement->execute([$ingredient]);
                $idIngredient = $statement->fetch();
                $checkRequest = "select count(productID) from COMPOSITION where productID = ? and recipeID = ? ";
                $statement = $connection->prepare($checkRequest);
                $statement->execute([$idIngredient["productID"],$idRecipe]);
                $checkResult = $statement->fetch();
                if($checkResult['count(productID)']==0){
                    $insertComposeRequest = 'insert into COMPOSITION(productID,recipeID) values ('.$idIngredient["productID"].",".$idRecipe.")";
                    $connection->exec($insertComposeRequest);
                }
                
            }
        }

    }
    

?>