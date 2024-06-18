<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>evenement</title>
</head>
<style>
    table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="submit"] {
            background-color: #FFD700; /* Jaune */
            color: #000; /* Noir */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        </style>
<body>
<h2>Tableau des événements disponibles</h2>
<table>
    <tr>
        <th>Nom de l'événement</th>
        <th>Description</th>
        <th>Date de l'événement</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php 
    session_start();
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
</body>
</html>