<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub</title>
	<style>
		input[type="text"], input[type="email"],input[type="password"],input[type="tel"],input[type="int"],textarea,input[type="date"]{
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
            margin-top:10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid grey;
        }
        th {
            background-color: var(--dark-grey)
        }
	</style>
</head>
<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Ajouter un membre
if (isset($_POST["ajouter"])) {
    $nouveau_nom = $_POST["nouveau_nom"];
    $nouvel_email = $_POST["nouvel_email"];
    $nouvel_mdp=$_POST["nouvel_mdp"];
    $nouvel_tel=$_POST["nouvel_tel"];
    $nouvel_age=$_POST["nouvel_age"];
    $nouvel_role=$_POST["nouvel_role"];
    $query = "INSERT INTO membres (username, email,mdp,tel,age,role) VALUES (:nom, :email,:pass,:tel,:age,:role)";
    $statement = $bdd->prepare($query);
    $statement->execute(array(":nom" => $nouveau_nom, ":email" => $nouvel_email, ":pass"=>$nouvel_mdp, ":tel"=>$nouvel_tel, ":age"=>$nouvel_age, ":role"=>$nouvel_role));

    echo "<script>alert('Membre ajouté avec succés');</script>";
}

// Modifier un membre
if (isset($_POST["modifier"])) {
    $id_membre = $_POST["id_membre"];
    $nouveau_nom = $_POST["nouveau_nom"];
    $nouvel_email = $_POST["nouvel_email"];
    $nouvel_mdp=$_POST["nouvel_mdp"];
    $nouvel_tel=$_POST["tel"];
    $query = "UPDATE membres SET username = :nom, email = :email, tel= :tel, mdp= :pass WHERE id_membre = :id";
    $statement = $bdd->prepare($query);
    $statement->execute(array(":nom" => $nouveau_nom, ":email" => $nouvel_email, ":id" => $id_membre, ":tel"=>$nouvel_tel, ":pass"=>$nouvel_mdp));

    echo "<script>alert('Membre modifié avec succés');</script>";
}

// Supprimer un membre
if (isset($_POST["supprimer"])) {
    $id_membre = $_POST["id_membre"];

    $query = "DELETE FROM membres WHERE id_membre = :id";
    $statement = $bdd->prepare($query);
    $statement->execute(array(":id" => $id_membre));
    echo "<script>alert('Membre supprimé avec succés');</script>";
}
if (isset($_POST["ajouter_event"])) {
  // Traitement de l'image
// Définir le chemin absolu pour le dossier de destination des images
$target_dir = "C:\\xampp\\htdocs\\FRONT\\image_events\\";

// Nom du fichier téléchargé
$nom_fichier = basename($_FILES["nouvelle_image"]["name"]);

// Chemin complet du fichier
$chemin_complet = $target_dir . $nom_fichier;

// Déplacer le fichier téléchargé vers le dossier de destination
move_uploaded_file($_FILES["nouvelle_image"]["tmp_name"], $chemin_complet);

// Ajouter l'événement à la base de données
$nouveau_titre = $_POST["nouveau_titre"];
$nouvelle_description = $_POST["nouvelle_description"];
$nouvelle_date = $_POST["nouvelle_date"];

// Enregistrer uniquement le nom du fichier dans la base de données
$nouveau_chemin_image = $nom_fichier;

$query = "INSERT INTO evenements (nom_event, description, date_event, image_path) VALUES (:titre, :description, :date, :image)";
$statement = $bdd->prepare($query);
$statement->execute(array(":titre" => $nouveau_titre, ":description" => $nouvelle_description, ":date" => $nouvelle_date, ":image" => $nouveau_chemin_image));

echo "<script>alert('Événement ajouté avec succès');</script>";
header("Location: admin.php");
    exit();
}
if(isset($_POST["logout"])){
	session_start();

   session_unset();

  session_destroy();
  header("Location:acceuil.php");
}

?>
<body>


	<!-- SIDEBAR -->
	<div id="sidebar">
	<a href="#" class="brand">
			<img src="efficace/fstgaming.png" style="width:40px;height:40px">
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="#" class="active" onclick="showSection('Gestion')">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Gestion des membres</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('inscrits')">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Membres inscrits</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('ajout')">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">ajout des evenements</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('delete')">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">suppression des evenements</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu">
			<li>
			<form method="post" action="lml.php">
		<input class="logout" name="logout" type="submit" value="Logout" style="font-size:16px;color:red;background-color:transparent;border:0px solid grey;border-radius: 30px;margin-left:30px">
        </form>
		
			</li>
		</ul>
</div>
	<!-- SIDEBAR -->



	<div id="content">
	
	<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="profile">
            <?php
            $id_membre=$_SESSION["id"];
            $sql = "SELECT * FROM membres where id_membre =:id";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(array(":id"=>$id_membre));
            if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<img src="image_events/'.$row["image_path"].'"';
            }
            /*echo '<img src="image_events/'.$stmt.'>';*/
                ?>
			</a>
		</nav>
		
		
		<main>
			<section id="Gestion">
            
				<form method="post">
				  <h2>Add Member</h2>
				  <input type="text" name="nouveau_nom" placeholder="Name" required>
				  <input type="email" name="nouvel_email" placeholder="Email" required>
				  <input type="password" name="nouvel_mdp" placeholder="password" required>
				  <input type="int" name="nouvel_age" placeholder="user age" required>
				  <input type="tel" name="nouvel_tel" placeholder="user phone number" required>
				  <input type="text" name="nouvel_role" placeholder="user role">
				  <input type="submit" name="ajouter" value="Add Member">
			  </form>
			  <form method="post">
				<h2>Update Member</h2>
				<input type="text" name="id_membre" placeholder="Member ID" required>
				<input type="text" name="nouveau_nom" placeholder="New Name" required>
				<input type="email" name="nouvel_email" placeholder="New Email" required>
				<input type="password" name="nouvel_mdp" placeholder="password" required>
				<input name="tel" type="tel" placeholder="PHONE_NUMBER" required>
				<input type="submit" name="modifier" value="Update Member">
	  
			</form>
			<form method="post">
				  <h2>Delete Member</h2>
				  <input type="text" name="id_membre" placeholder="Member ID" required>
				  <input type="submit" name="supprimer" value="Delete Member">
			  </form>
			  </section>
			  <section id="ajout" style="display:none;">
				<div style="margin-top:100px;margin-bottom:100px">
				  <h2>Ajouter des evenements</h2>
				  <hr>
				  <form method="post" enctype="multipart/form-data">
			  <input type="text" name="nouveau_titre" id="titre" placeholder="titre de l evenement"><br><br>
			  
			  <br>
			  <textarea placeholder="description de l'evenement" name="nouvelle_description" id="description" rows="4" required></textarea><br><br>
			  
			  <label for="date">Date de l'evenement :</label><br>
			  <input type="date" name="nouvelle_date" id="date" required><br><br>
			  
			  <label for="image">Image :</label>
			  <input type="file" name="nouvelle_image" id="image" accept="image/*" required><br><br>
			  
			  <input style="margin-bottom:20px" type="submit" name="ajouter_event" value="Ajouter Événement">
		  </form>
			  </section>
			  <section id="delete" style="display:none;">
				  <h2>Tableau des événements existants</h2>
				  <table>
					  <tr>
						  <th>Nom de l'événement</th>
						  <th>Description</th>
						  <th>Date de l'événement</th>
						  <th>Image</th>
						  <th>Action</th>
					  </tr>
					  <?php 
		  $sql = "SELECT * FROM evenements";
		  $stmt = $bdd->prepare($sql);
		  $stmt->execute();
		  if($stmt->rowCount() > 0){
			  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				  echo "<tr>";
				  echo "<td>".$row["nom_event"]."</td>";
				  echo "<td>".$row["description"]."</td>";
				  echo "<td>".$row["date_event"]."</td>";
				  echo '<td><img src="image_events/'.$row["image_path"].'" alt="'.$row["nom_event"].'" style="width:100px;height:auto;"></td>';
				  echo "<td>";
				  // Formulaire de suppression de l'événement
				  echo '<form method="post">';
				  echo '<input type="hidden" name="id_event" value="'.$row["id_events"].'">';
				  echo '<input type="submit" name="supprimer_event" value="Supprimer">';
				  echo '</form>';
				  echo "</td>";
				  echo "</tr>";
			  }
		  } else {
			  echo "<tr><td colspan='5'>Aucun événement trouvé.</td></tr>";
		  }
		  // Supprimer un événement
	  if (isset($_POST["supprimer_event"])) {
		  $id_event = $_POST["id_event"];
	  
		  // Récupérer le nom de l'image pour la suppression du fichier
		  $query = "SELECT image_path FROM evenements WHERE id_events = :id";
		  $stmt = $bdd->prepare($query);
		  $stmt->execute(array(":id" => $id_event));
		  $row = $stmt->fetch(PDO::FETCH_ASSOC);
		  $image_path = $row["image_path"];
	  
		  // Supprimer l'image du dossier
		  $target_dir = "C:\\xampp\\htdocs\\FRONT\\image_events\\";
		  $image_path_full = $target_dir . $image_path;
		  if (file_exists($image_path_full)) {
			  unlink($image_path_full);
		  }
	  
		  // Supprimer l'événement de la base de données
		  $query = "DELETE FROM evenements WHERE id_events = :id";
		  $stmt = $bdd->prepare($query);
		  $stmt->execute(array(":id" => $id_event));
		  echo "<script>alert('Événement supprimé avec succès');</script>";
		  header("Location:admin.php");
		  
	  }
		  ?>
				  </table>
			  </section>
			  <section id="inscrits" style="display:none;">
			  <div>
			  <h2>tableau des membres existants</h2>
			  <table>
		  <tr>
			  <th>Nom d'utilisateur</th>
			  <th>Mot de passe</th>
			  <th>Age</th>
			  <th>Téléphone</th>
			  <th>Email</th>
			  <th>Rôle</th>
			  <th>ID Membre</th>
		  </tr>
			  <?php 
			  $sql = "SELECT * FROM membres";
			  $stmt = $bdd->prepare($sql);
			  $stmt->execute();
			  if($stmt->rowCount()>0){
			  while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				  echo "<tr>";
				  echo "<td>".$row["username"]."</td>";
				  echo "<td>".$row["mdp"]."</td>";
				  echo "<td>".$row["age"]."</td>";
				  echo "<td>".$row["tel"]."</td>";
				  echo "<td>".$row["email"]."</td>";
				  echo "<td>".$row["role"]."</td>";
				  echo "<td>".$row["id_membre"]."</td>";
				  echo "</tr>";
			  }
			   
		  }
		  else {
			  echo "<tr><td colspan='7'>Aucun résultat trouvé.</td></tr>";}
			  ?>
			  </table>
			  </div>
		  </div>
			  </section>
		</main>
		<!-- MAIN -->
		  </div>
	<!-- CONTENT -->
	

	<script>
  function showSection(sectionId) {
    var sections = document.getElementsByTagName("section");
    for (var i = 0; i < sections.length; i++) {
        if (sections[i].id === sectionId) {
            sections[i].style.display = "block";
        } else {
            sections[i].style.display = "none";
        }
    }

    var links = document.querySelectorAll("nav ul li a");
    for (var j = 0; j < links.length; j++) {
        if (links[j].getAttribute("onclick") === "showSection('" + sectionId + "')") {
            links[j].classList.add("active");
        } else {
            links[j].classList.remove("active");
        }
    }
}

</script>
</body>
</html>