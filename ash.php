<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
if(isset($_POST["visit"])){
header("LOCATION:login.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
     @font-face {
                font-family: anton;
                src: url(fonts/Anton-Regular.ttf);
            }
    @font-face {
                font-family: GR ;
                src: url(fonts/ProtestGuerrilla-Regular.ttf);
                }

               
    
    .container{
    justify-content:flex-start;
    padding-left:25px;
    display:flex;
    margin-bottom:70px;
    flex-wrap: wrap; 

    }
    .content {
    background-image:url(efficace/blur.jpg);
    border-radius: 10px;
    margin-right: 20px;
    margin-bottom: 50px;
    
    background-attachment: fixed;
    background-repeat: no-repeat;
    
}

    
    .img{
        margin-top:20px;
        margin-bottom:20px;
    }
     p{
      
      font-family: anton;
      padding-left:17px;
    }
    h3{ 
        text-align: center;
        font-family:GR;
    }
    .link{
       justify-content: center;
       display: flex;

    }
    input[type="submit"] {
            background-color: #FFD700; /* Jaune */
            color: #000; /* Noir */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top:10px;
            margin-bottom:20px;
            font-weight:bold;
        }
body{
    background-color: #292b2c;
    background-attachment: fixed;
    background-size:cover;   
    background-repeat: no-repeat;
}
h1{
    color:white;
    text-align: center;
}
.header{
    justify-content:center;
    padding-left:25px;
    display:flex;
    
    flex-wrap: wrap; 
}
</style>
<body>
    <div class="header">
    <img src="efficace/fstgaming.png" style="height:80px">
    <h1>NOS ACTUALITES</h1>
</div>
    <hr>
        <?php
$query = "SELECT * FROM evenements ORDER BY id_events DESC";
$stmt = $bdd->prepare($query);
$stmt->execute();

// Début du conteneur pour les événements
echo '<div class="container">';

// Vérifier s'il y a des événements
if ($stmt->rowCount() > 0) {
    // Afficher les événements
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="content" ">';
        echo '<div class="img"><img style="width:300px;" src="image_events/' . $row["image_path"] . '"></div> <br>';
        echo '<h3>Description:</h3>';
        echo '<p>' . $row['description'] . '</p>';
        ?>
        <form action="ash.php" method="post">
            <div class="link">
                <input  type="submit" name="visit" value="visiter">
            </div>
        </form>
        <?php
        echo '</div>';    
    }
    

    
    
} else {
    // Aucun événement trouvé
    echo "Aucun événement trouvé.";
}

// Fin du conteneur pour les événements
echo '</div>';
?>

</body>
</html>