<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>

    <style>
        body {
            background-image: url(efficace/anim.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        h1 {
            text-align: center;
            font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 50px;
            color: white;
            
        }

        input {
            background: transparent;
            border-radius: 40px;
            font-size: 20px;
            border: 2px solid gold;
            padding: 20px;
            width: 250px;
            color:white;
        }
        input:focus{
            color:blue;
            font-weight: bolder;
        }

        input::placeholder {
            color: white;
            
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: larger;
        }

        div {
            text-align: center;
        }

        @font-face {
            font-family: guerilla;
            src: url(fonts/ProtestGuerrilla-Regular.ttf);
        }

        @font-face {
            font-family: riot;
            src: url(fonts/ProtestRiot-Regular.ttf);
        }

        @font-face {
            font-family: reg;
            src: url(fonts/ProtestRevolution-Regular.ttf);
        }

        button {
            background-color: rgb(38, 13, 66);
            border-radius: 15px;
            font-size: 15px;
            border: 2px solid rgb(70, 46, 46);
            padding: 8px;
            width: 150px;
        }

        .box {
            box-shadow: 0 0 10px gold, 0 0 70px turquoise;
            margin: 50px auto;
            background-color: transparent;
            backdrop-filter: blur(5px);
            border-radius: 40px;
            padding-bottom: 50px;
            max-width: 500px;
            padding: 20px;
        }

        .inside_box {
            font-size: 20px;
            color: white;
        }

        h2 {
            font-size: 40px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
//echo "<script>alert('Vous êtes bien enregistré.');</script>";
// Vérification du formulaire
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Requête préparée pour éviter les injections SQL
    $query = "SELECT * FROM membres WHERE email = :email AND mdp = :password";
    $result = $bdd->prepare($query);
    $result->execute(array(":email" => $email, ":password" => $password));
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        session_start();
        $_SESSION["id"] = $row["id_membre"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["tel"] = $row["tel"];
        $_SESSION["age"] = $row["age"];
        header("Location: lml.php"); // Rediriger vers le tableau de bord après connexion réussie
        exit();
    } else {
        echo "<script>alert('Membre introuvable');</script>";
    }
} else {
    echo "Tous les champs sont requis";
}
?>
<h1>Remplissez le formulaire</h1>
<hr>
<div class="box">
    <div class="inside_box">
        <h2 style="padding-top:15px">Login</h2>
        <br>
        <form method="post" action="login.php">
            <input id="@" type="email" placeholder="Email" name="email" required>
            <br>
            <br>
            <input id="mdp" type="password" placeholder="Password" name="password" required>
            <br>
            <br>
            <input style="color:white" type="submit" value="Login" name="submit">
        </form>
        <br>
        <p style="font-family: 'Courier New', Courier, monospace;"><strong>Vous n'avez pas un compte? <a style="color:rgb(115, 200, 240);"
                                                                  href="inscription.php">Créez un compte!</a></strong></p>
<p style="font-family: 'Courier New', Courier, monospace;"><strong>Etes vous un admin? <a style="color:rgb(115, 200, 240);"
                                                                  href="Admin_logo.php">Acceder a votre compte!</a></strong></p>
        <br>
    </div>
</div>
</body>
</html>
