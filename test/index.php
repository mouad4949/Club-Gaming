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
session_start();
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

?>
<body>
	<!-- SIDEBAR -->
	<div id="sidebar">
		<a href="#" class="brand">
		<img src="fstgaming.png" style="width:40px;height:40px">
			<span class="text" style="padding-left:30px">MemberHub</span>
		</a>
		<ul class="side-menu top">
		<li>
				<a href="#" class="active" onclick="showSection('Gestion')">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Mes informations</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('ajout')">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Modifier mes données</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('delete')">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">particper aux evenements</span>
				</a>
		
		</ul>
		<ul class="side-menu">
			<li>
			<form method="post">
		<input class="logout" name="logout" type="submit" value="Logout" style="font-size:16px;color:red;background-color:transparent;border:0px solid grey;border-radius: 30px;margin-left:30px">
        </form>
		<?php
		if(isset($_POST["logout"])){
			session_start();

           session_unset();

          session_destroy();
		  header("Location:Acceuil.php");
		}
		?>
			</li>
		</ul>
	</div>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<div id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			
			<form action="#">
				
			
			<a href="#" class="profile">
				<img  src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
		<section id="Gestion">
            <h1 style="color:grey">Mon Profil</h1>
            <p><strong style="color:grey">Nom :</strong><?php  echo $_SESSION["username"]; ?></p>
            <p><strong style="color:grey">Email :</strong> <?php echo $_SESSION["email"]; ?></p>
            <p><strong style="color:grey">N° Tel :</strong> <?php echo $_SESSION["tel"]; ?></p>
				
			  </section>
			  <section id="ajout" style="display:none;">
              <form method="post">
            <h2 style="color:grey">Changer vos données</h2>
            <input type="text" name="nouveau_nom" placeholder="New Name" required>
            <input type="email" name="nouvel_email" placeholder="New Email" required>
            <input type="password" name="nouvel_mdp" placeholder="password" required>
            <input name="tel" type="tel" placeholder="PHONE_NUMBER" required>
            <input type="submit" name="modifier" value="Update ">

        </form>
			  </section>
			  </section>
			  <section id="delete" style="display:none;">
              <h2 style="color:grey">Participez aux evenements:</h2>
              <table>
    <tr>
        <th>Nom de l'événement</th>
        <th>Description</th>
        <th>Date de l'événement</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php 
    
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=club gaming', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
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
            
            echo '<form method="post">';
            echo '<input type="hidden" name="id_event" value="'.$row["id_events"].'">';
            echo '<input type="submit" name="participer_event" value="Participer">';
            echo '</form>';
            echo "</td>";
            echo "</tr>";
            
        }
    } else {
        echo "<tr><td colspan='5'>Aucun événement trouvé.</td></tr>";
    }
    if (isset($_POST["participer_event"])) {
        $id_event = $_POST["id_event"];
        $id_membre = $_SESSION["id"];
        
        // Récupérer le titre de l'événement
        $query = "SELECT nom_event FROM evenements WHERE id_events = :id_event";
        $statut = $bdd->prepare($query);
        $statut->execute(array(":id_event" => $id_event));
        $event = $statut->fetch(PDO::FETCH_ASSOC);
        $nom_event = $event['nom_event'];
        
        // Insérer la participation dans la table participations
        $requete = $bdd->prepare('INSERT INTO participations (id_events, id_membre, titre) VALUES (:id_events, :id_membre, :titre)');
        $requete->bindValue(':id_events', $id_event);
        $requete->bindValue(':id_membre', $id_membre);
        $requete->bindValue(':titre', $nom_event);
        
        // Vérifier si l'insertion a réussi
        if ($requete->execute()) {
            echo "<script>alert('Participation réussie');</script>";
            exit();
        } else {
            echo "<script>alert('Erreur lors de la participation');</script>";
        }
    }
    
    ?>
    

</table>
			  </section>
		</main>
		<!-- MAIN -->
</div>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
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