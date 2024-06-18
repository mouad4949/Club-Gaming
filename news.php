<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

$stmt = $bdd->prepare('SELECT * FROM evenements');
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-color:grey;
            height:100vh;
            background-image: url(efficace/GAMER-SETUP-BACKGROUND@2x.png);
            backdrop-filter: blur(10px);
        }
        .container{
            justify-content:flex-start;
            padding-left:25px;
            display:flex;
            margin-bottom:70px;
            flex-wrap: wrap;  height:100%;  
        }
        img{
            transition:0.2s ;
            height:70vh;
            margin-top:60px;
            margin-bottom:60px;
            margin-right:10px;
            
        }
        /* img:hover{
            transform:scale(1.09);
        } */
        .content{
            margin-right: 20px;
        }
        h1{
            color:white;
            text-align: center;
        }
        p{
            padding-bottom:50px;
            font-size:larger;
            color:yellow;
            font-weight: bolder;
            font-family:Verdana, Geneva, Tahoma, sans-serif
        }
        
    </style>
</head>
<body>
    <h1>NOS EVENEMENTS</h1>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <?php
    $i = 0;
    foreach($row as $value ){
        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" class="' . ($i == 0 ? 'active' : '') . '" aria-current="' . ($i == 0 ? 'true' : 'false') . '" aria-label="Slide ' . ($i + 1) . '"></button>';
        $i++;
    }
    ?>
  </div>
  <div class="carousel-inner">
    <?php
    $i = 0;
    foreach($row as $value ){
        echo '<div class="carousel-item ' . ($i == 0 ? 'active' : '') . '">';
        echo '<a href="login.php"><img src="image_events/' . $value["image_path"] . '" class="d-block w-100" alt="..."></a>';
        echo '<div class="carousel-caption d-none d-md-block">';
       
        echo '<p>' . $value['description'] . '</p>';
        echo '</div>';
        echo '</div>';
        $i++;
    }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- <div class="container">
    <?php
    foreach($row as $value ){
        echo '<div class="content">';
        echo '<div class="img"><a href="login.php"><img style="width:300px" src="image_events/' . $value["image_path"] . '"></a></div> <br>';
        echo '<p>' . $value['description'].'</p>'; // Ajoutez la description ici
        echo '</div>';
    }
    ?>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
