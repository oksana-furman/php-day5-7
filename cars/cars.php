<?php
    session_start();
    require "../components/db-connect.php";

    $sqlAdm = "SELECT * FROM cars";
    $resultAdm = mysqli_query($connect, $sqlAdm);
    

    $sql = "SELECT * FROM cars WHERE status = 1";
    $result = mysqli_query($connect, $sql);
    $body = "";
    if (mysqli_num_rows($result)>0) {
        if(!isset($_SESSION['adm'])){
            while ($row = mysqli_fetch_assoc($result)) { 
                $body .= "
            <div class='card cardLoop'>
            <img src='./img/{$row['picture']}' class='card-img-top' alt='{$row['brand']}'>
            <div class='card-body'>
                <h5 class='card-title'>{$row['brand']} {$row['model']}</h5>
                <p class='card-text'>{$row['pricePerDay']}  &#8364;</p>
                <a class='btn btn-primary' href='./details.php?id={$row['id']}'>See more</a>
            </div>
        </div>";
            }
        } else {
            while ($row2 = mysqli_fetch_assoc($resultAdm)) { 
                if($row2['status'] == 0){
                    $body .= "
                    <div class='card cardStatus'>
                        <img src='./img/{$row2['picture']}' class='card-img-top' alt='{$row2['brand']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row2['brand']} {$row2['model']}</h5>
                            <p class='card-text'>{$row2['pricePerDay']}  &#8364;</p>
                            <a class='btn btn-secondary' href='./details.php?id={$row2['id']}'>See more</a>
                        </div>
                    </div>";
                } else{
                    $body .= "
                    <div class='card cardStatusAvail'>
                        <img src='./img/{$row2['picture']}' class='card-img-top' alt='{$row2['brand']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row2['brand']} {$row2['model']}</h5>
                            <p class='card-text'>{$row2['pricePerDay']}  &#8364;</p>
                            <a class='btn btn-primary' href='./details.php?id={$row2['id']}'>See more</a>
                        </div>
                    </div>";
                }
            }
        }
    } else {
        $body .= "
        <div>
        <p>No results</p>
        </div>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boot.php"; ?>
    <?php linkFun(1);  ?>
    <title>Document</title>
</head>
<body>
    <?php require "./navbar.php"; ?>

    <div class="container">
    <h2 class="text-center m-3 p-3 mt-5">Our cars</h2>
    <div class="row row-cols-3">
            <?= $body ?>
    </div>
    </div>
    
    <?php require "./footer.php"; ?>
</body>
</html>