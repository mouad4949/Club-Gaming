<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        @font-face {
            font-family: guerilla;
            src: url(fonts/ProtestGuerrilla-Regular.ttf);
        }
        
        @font-face {
            font-family: riot;
            src: url(fonts/ProtestRiot-Regular.ttf);
        }
        
        body {
            background-image: url(IMAGE/controller.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-attachment: fixed;
        }
        
        h1 {
            text-align: center;
            font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 50px;
            color: white;
        }
        
        .text {
            border-collapse: collapse;
            padding-left: 100px;
            margin: 30px 400px 0px;
            box-shadow: 0 0 10px gold, 0 0 90px;
            background-color: transparent;
            backdrop-filter: blur(5px);
            border-radius: 40px;
            padding-bottom: 30px;
            padding-top: 40px;
        }
        
        .in {
            background-color: aliceblue;
            border-radius: 20px;
            font-size: 25px;
            border: 3px solid turquoise;
            padding: 10px;
            width: 280px;
            margin-left: 10px;
            background-color: transparent;
            backdrop-filter: blur(100px);
            text-align: center; /* Centrer le texte dans les input */
        }
        
        .in input {
            background-color: transparent;
            border: 0px;
            color: white;
            font-weight: bold;
            font-size:20px; /* Mettre le texte en gras */
        }
        
        .in input::placeholder {
            font-weight: bold;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            color: #999;
            letter-spacing: 1px;
            opacity: 1;
        }
        
        #submit {
            margin-left: 100px;
            border-radius: 10px;
            border: 2px solid gold;
            font-size: large;
            font-weight: bold;
            background-color: transparent;
            color: white; /* Couleur du texte */
            width: 100px; /* Largeur réduite */
        }
        
        @font-face {
            font-family: reg;
            src: url(fonts/ProtestRevolution-Regular.ttf);
        }
        
        .in input:focus {
            color: turquoise;
            outline: none;
        }
    </style>
</head>
<body>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST["signup"])) {
    $target_dir = "C:\\xampp\\htdocs\\FRONT\\image_events\\";
    $nom_fichier = basename($_FILES["nouvelle_image"]["name"]);
    $chemin_complet = $target_dir . $nom_fichier;
    move_uploaded_file($_FILES["nouvelle_image"]["tmp_name"], $chemin_complet);
    $nouveau_chemin_image = $nom_fichier;
    $username = $_POST["username"];
    $mdp = $_POST["mdp"];
    $age = $_POST["BD"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];

    if (!empty($username) && !empty($email) && !empty($mdp) && !empty($age) && !empty($tel)) {
        try {
            $requete = $bdd->prepare('INSERT INTO membres(username,mdp,age,tel,email,image_path) VALUES(:username,:mdp,:age,:tel,:email,:image)');
            $requete->bindValue(':username', $username);
            $requete->bindValue(':mdp', $mdp);
            $requete->bindValue(':age', $age);
            $requete->bindValue(':tel', $tel);
            $requete->bindValue(':email', $email);
            $requete->bindValue(':image', $nouveau_chemin_image);
            $result = $requete->execute();

            if (!$result) {
                // La requête a échoué pour une raison autre que la duplication d'email
                echo "L'inscription a échoué.";
            } else {
                $message = "Vous êtes bien enregistré. ";
                echo "<script>window.onload = function() { alert('$message'); window.location.href = 'login.php'; }</script>";
                exit();
            }
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                // L'erreur 1062 indique une contrainte d'unicité violée, ce qui signifie que l'email est déjà enregistré
                echo "<script>alert('ereur L\'email fournis est déjà enregistré veuillez sasir un autre email valide.');</script>";
            } else {
                echo "Erreur: " . $e->getMessage();
            }
        }
    } else {
        echo "Tous les champs sont requis";
    }
}

?>
<h1>Inscrivez vous</h1>
<hr>
<form action="inscription.php" method="post" enctype="multipart/form-data">
    <div class="text">
        <div class="formulaire">
            <div class="in">
                <input name="username" type="text" minlength="6" maxlength="15" required placeholder="USERNAME">
            </div>
            <br><br>
            <div class="in">
                <input name="mdp" minlength="6" maxlength="6" type="password" required placeholder="PASSWORD">
            </div>
            <br><br>
            <div class="in">
                <input name="BD" type="int" placeholder="age" required>
            </div>
            <br><br>
            <div class="in">
                <input name="tel" type="tel" placeholder="PHONE_NUMBER" required>
            </div>
            <br><br>
            <div class="in">
                <input name="email" type="email" placeholder="@EMAIL" required>
            </div>
            <br>
            <label style="color:white" for="image">Photo de profil :</label>
            <input type="file" name="nouvelle_image" id="image" accept="image/*" required><br>
            <br><br>

        </div id=submit>
        <input type="submit" name="signup" value="SIGN UP" id="submit">
    </div>
</form>
</body>
</html>
