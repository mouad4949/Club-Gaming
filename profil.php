<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mon Profil</title>
<style>
body {
            background-color: #87CEEB; /* Bleu ciel */
            font-family: Arial, sans-serif;
        }
.container {
  max-width: 800px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  background-image: url(IMAGE/ciel.jpg);
}

.profile-header {
  width: 100%;
  margin-bottom: 20px;
}

.profile-header h1 {
  font-size: 24px;
  color: #333;
  text-align: center;
}

.profile-info {
  display: flex;
  align-items: center;
}
.user-details {
  flex: 1;
  padding-right:400px;
}

.user-details p {
  margin: 5px 0;
  color: #333;
}

.user-details strong {
  font-weight: bold;
}
input[type="text"], input[type="email"],input[type="password"],input[type="tel"]{
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #FFD700; /* Jaune */
            color: #000; /* Noir */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top:20px;
        }
        a{
            color:red;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover{
           text-decoration: underline;
           text-decoration-color: blue;
        }


</style>
</head>
<body>
  <?php
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

  session_start();
  if (isset($_POST["modifier"])) {
    $id_membre = $_SESSION["id"];
    $nouveau_nom = $_POST["nouveau_nom"];
    $nouvel_email = $_POST["nouvel_email"];
    $nouvel_mdp=$_POST["nouvel_mdp"];
    $nouvel_tel=$_POST["tel"];
    $query = "UPDATE membres SET username = :nom, email = :email, tel= :tel, mdp= :pass WHERE id_membre = :id";
    $statement = $bdd->prepare($query);
    $statement->execute(array(":nom" => $nouveau_nom, ":email" => $nouvel_email, ":id" => $id_membre, ":tel"=>$nouvel_tel, ":pass"=>$nouvel_mdp));
    $message = "Vous aves bien changé vos Donnes veuillez reconnecter ";
    echo "<script>window.onload = function() { alert('$message'); window.location.href = 'login.php'; }</script>";
}?>

<div class="container">
  <div class="profile-header">
    <h1>Mon Profil</h1>
  </div>
  <div class="profile-info">
    <div class="user-details">
      <p><strong>Nom :</strong><?php  echo $_SESSION["username"]; ?></p>
      <p><strong>Email :</strong> <?php echo $_SESSION["email"]; ?></p>
      <p><strong>N° Tel :</strong> <?php echo $_SESSION["tel"]; ?></p>
    </div>
  </div>
  <form method="post">
            <h2>Changer vos données</h2>
            <input type="text" name="nouveau_nom" placeholder="New Name" required>
            <input type="email" name="nouvel_email" placeholder="New Email" required>
            <input type="password" name="nouvel_mdp" placeholder="password" required>
            <input name="tel" type="tel" placeholder="PHONE_NUMBER" required>
            <input type="submit" name="modifier" value="Update ">

        </form>
        <h2>Participez aux evenements:</h2>
        <a href="evenement.php">Consultez les evenements disponible</a>


</div>


</body>
</html>
