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
    $id_membre=$_SESSION["id"];
    $target_dir = "C:\\xampp\\htdocs\\FRONT\\image_events\\";
    $nom_fichier = basename($_FILES["nouvelle_image"]["name"]);
    $chemin_complet = $target_dir . $nom_fichier;
    move_uploaded_file($_FILES["nouvelle_image"]["tmp_name"], $chemin_complet);
    $nouveau_nom = $_POST["nouveau_nom"];
    $nouvel_email = $_POST["nouvel_email"];
    $nouvel_mdp=$_POST["nouvel_mdp"];
    $nouvel_tel=$_POST["tel"];
    $nouveau_chemin_image = $nom_fichier;
    $query = "UPDATE membres SET image_path =:image,username = :nom, email = :email, tel= :tel, mdp= :pass WHERE id_membre = :id";
    $statement = $bdd->prepare($query);
    $statement->execute(array(":nom" => $nouveau_nom, ":email" => $nouvel_email, ":id" => $id_membre, ":tel"=>$nouvel_tel, ":pass"=>$nouvel_mdp , ":image" => $nouveau_chemin_image));

    echo "<script>alert('Membre modifié avec succés');</script>";
}

		if(isset($_POST["logout"])){
		  header("Location:Acceuil.php");
          exit();
		}
        if (isset($_POST["participer_event"])) {
            $id_event = $_POST["id_event"];
            $id_membre = $_SESSION["id"];
            
            // Récupérer le titre de l'événement
            $query = "SELECT nom_event FROM evenements WHERE id_events = ?";
            $statut = $bdd->prepare($query);
            $statut->execute([$id_event]);
            $event = $statut->fetch(PDO::FETCH_ASSOC);
            $nom_event = $event['nom_event'];
            $req = "SELECT * FROM participations WHERE id_events=? AND id_membre=?";
            $statutm = $bdd->prepare($req);
            $statutm->execute( [$id_event,$id_membre]);
            $row = $statutm->fetch(PDO::FETCH_ASSOC);

                       
            if(!$row){

           
            // Insérer la participation dans la table participations
            $requete = $bdd->prepare('INSERT INTO participations (id_events, id_membre, titre) VALUES (:id_events, :id_membre, :titre)');
            $requete->bindValue(':id_events', $id_event);
            $requete->bindValue(':id_membre', $id_membre);
            $requete->bindValue(':titre', $nom_event);
            
            // Vérifier si l'insertion a réussi
            try{$requete->execute();
                $message = "votre participation est reussite ";
                echo "<script>window.onload = function() { alert('$message'); window.location.href = 'lml.php'; }</script>";

            }catch(PDOException $e){
                echo "Erreur de connexion : " . $e->getMessage();
            }
        }
        else{
            $message = "vous avez deja particper à cet evenement ";
                    echo "<script>window.onload = function() { alert('$message'); window.location.href = 'lml.php'; }</script>";
        }
    }
		?>
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
        h2 {
            color: #555;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        img {
            width: 80px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .action-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-btn:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details p {
            margin: 5px 0;
            color: #555;
        }

        h1 {
            color: #555;
            text-align: center;
        }
        .container1 {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
	</style>
</head>
<body>
	<!-- SIDEBAR -->
	<div id="sidebar">
		<a href="#" class="brand">
		<img src="efficace/fstgaming.png" style="width:40px;height:40px">
			<span class="text" style="padding-left:30px">MemberHub</span>
		</a>
		<ul class="side-menu top">
		<li>
				<a href="#" class="active" onclick="showSection('infos')">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Mes informations</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('modify')">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Modifier mes données</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="showSection('participate')">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">particper aux evenements</span>
				</a>
		
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
	<!-- CONTENT -->
	<div id="content">
		<!-- NAVBAR -->
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
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
		<section id="infos">
        <div class="container">
        <h1>Mon Profil</h1>
        <div class="profile-info">
            <?php
            $id_membre = $_SESSION["id"];
            $sql = "SELECT * FROM membres WHERE id_membre = :id";
            $stmt = $bdd->prepare($sql);
            $stmt->execute(array(":id" => $id_membre));
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<img src="image_events/' . $row["image_path"] . '" alt="Profile Picture">';
            }
            ?>
            <div class="profile-details">
                <p><strong>Nom :</strong><?php echo $_SESSION["username"]; ?></p>
                <p><strong>Email :</strong> <?php echo $_SESSION["email"]; ?></p>
                <p><strong>N° Tel :</strong> <?php echo $_SESSION["tel"]; ?></p>
            </div>
        </div>
    </div>
			  </section>
			  <section id="modify" style="display:none;">
              
            <h2 style="color:grey">Changer vos données</h2>
            <form method="post" enctype="multipart/form-data">
            <input type="text" name="nouveau_nom" placeholder="New Name" required>
            <input type="email" name="nouvel_email" placeholder="New Email" required>
            <input type="password" name="nouvel_mdp" placeholder="password" required>
            <input name="tel" type="tel" placeholder="PHONE_NUMBER" required>
            <br>
            <label for="image">Image :</label>
            <input type="file" name="nouvelle_image" id="image" accept="image/*" required><br>
            <br>
            <input type="submit" name="modifier" value="Update ">

        </form>
			  </section>
			  <section id="participate" style="display:none;">
              <div class="container1">
        <h2>Participez aux événements</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'événement</th>
                    <th>Description</th>
                    <th>Date de l'événement</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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
                        echo '<td><img src="image_events/'.$row["image_path"].'" alt="'.$row["nom_event"].'"></td>';
                        echo "<td>";
                        echo '<form method="post">';
                        echo '<input type="hidden" name="id_event" value="'.$row["id_events"].'">';
                        echo '<button type="submit" name="participer_event" class="action-btn">Participer</button>';
                        echo '</form>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun événement trouvé.</td></tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>
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
