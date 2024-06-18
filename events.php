<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>evenements</title>
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
    header("Location:events.php");
    exit();
}
    ?>
    

</table>

</body>
</html>