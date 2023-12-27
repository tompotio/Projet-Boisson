<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
include("../treeData.php");
$connection = new pdo("mysql:host=localhost;dbname=projetBoisson","root");
$requete = "select Title,product_name,r.id from composition c JOIN recipes r on c.recipeID = r.id JOIN products p on p.productID = c.productID";
$stmt = $connection->query($requete);
$resultArr = $stmt->fetchAll();
$result = array();
$sortResult =[];
$count = [];
foreach($resultArr as $composition){
    if(!isset($sortResult[$composition['Title']])){
        $sortResult[$composition['Title']]=[];
    }
    array_push($sortResult[$composition['Title']],['product_name'=>$composition['product_name'],'id'=>$composition['id']]);
}

foreach($sortResult as $key => $composition){
    
    foreach($data['desiré'] as $wish){
       
        $arr = array();
        $categorieArr = findCat($arbre,$wish);
        chercherFeuilles($arr,$categorieArr,$wish);
        $orSuccess = false;
        foreach($arr as $leaf){
            
            if(in_array($leaf,array_column($composition,'product_name'))){
                $orSuccess = true;
            }
        }
        if($orSuccess){
            if(!isset($count[$key])){
                $count[$key]=[];
                $count[$key]['count']=0;
                $count[$key]['id']=$composition[0]['id'];
            }
            $count[$key]['count']++;
        }
    }
    foreach($data['indesiré'] as $unWish){
        $arr = array();
        $categorieArr = findCat($arbre,$unWish);
        chercherFeuilles($arr,$categorieArr,$unWish);
        $orSuccess = true;
        foreach($arr as $leaf){
            if(in_array($leaf,array_column($composition,'product_name'))){
                $orSuccess = false;   
            }
        }
        if($orSuccess){
              
            if(!isset($count[$key])){
        
                $count[$key]=[];
                $count[$key]['count']=0;
                $count[$key]['id']=$composition[0]['id'];
            }
            $count[$key]['count']++;
        }
    }   
}

$columns = array_column($count, 'count');
array_multisort($columns, SORT_DESC, $count);
$result =[];

foreach($count as $key=>$recipe){
    $nameFileArray= preg_split("/ /",$key);
            $i = 0;
            $nameFile ="";
            foreach($nameFileArray as $word){   
                if($i!=0){
                    $nameFile .="_".strtolower($word);
                }
                else{
                    $nameFile .=$word;     
                } 
                    $i++;
                }
               
                $path = "../../Photos/$nameFile.jpg";
    $result[] = ['recipe'=>$key,'id'=>$recipe['id'],'path'=>$path];
}
echo(json_encode($result,JSON_UNESCAPED_UNICODE));





?>