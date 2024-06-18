<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="inscription en ALBANE">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        
        <title>
            bienvenue
        </title>
        
        <style>
            @font-face {
                font-family: rev;
                src: url(fonts/ProtestRevolution-Regular.ttf);
            }
            @font-face {
                font-family: GR ;
                src: url(fonts/ProtestGuerrilla-Regular.ttf);
            }
            @font-face {
                font-family:riot ;
                src: url(fonts/ProtestRiot-Regular.ttf);
            }
            @font-face {
                font-family:VR ;
                src: url(fonts/PlayfairDisplay-VariableFont_wght.ttf);
            }
            @keyframes agrandir-retrécir {
            0% {
    transform: scale(1); /* Taille normale */
                }
          50% {
    transform: scale(1.08); /* Agrandissement à 120% */
               }
         100% {
    transform: scale(1); /* Retour à la taille normale */
               }
}
*{
    scroll-behavior: smooth;
  
}         


body{
    background-image: url(IMAGE/blue-gradient-25907-2560x1440.jpg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
.header{
    background-image:url(IMAGE/purplerog.jpg);
    background-size:100% 100%;
    background-position: center; 
    background-repeat: no-repeat;
    
    
}
h1{
    text-align: center;
    font-family: GR;
    font-size:60px;
    padding-top:0.5px;
    text-shadow:7px 7px 3px rgba(255, 69, 0, 0.8),0 0 40px #000000;
    color:white;   
}
.liste{
   /* backdrop-filter:blur(2px);*/
    margin-top: 250px;
}
.navbar{
    list-style-type:none;
    /*padding-top:25px;*/
}
.nv{
display:inline-block;
padding:20px;
padding-left:130px;
}
.nv:hover a{
    font-size:25px ;
    color:gold;
    text-decoration: underline;
    text-decoration-color: turquoise;
}
a{
    text-decoration: none;
    color:white;
    font-size:1.5em;
    font-weight:bold;
    
}
h2{
    text-align: center;
    color: yellow;
    text-decoration: underline;
    text-decoration-color: turquoise;
    font-size: 35px;
}
p{
     font-family: VR; 
    font-size:20px;
}
.gamingpic{
    display: flex;
    justify-content: center;
}
.gamingpiic{
    width: 200px; /* Taille initiale de l'image */
  animation: agrandir-retrécir 2s ease-in-out infinite;
}
footer {
                padding-top: 50px;
                padding-bottom:50px;
                backdrop-filter:blur(10px);
                border-radius:5px;
                font-size:20px;
                
            }
.container{
    justify-content:flex-start;
    padding-left:25px;
    display:flex;
    margin-bottom:70px;
    flex-wrap: wrap;    

}
.img{
transition:0.2s ;
}
.img:hover{
    transform:scale(1.09);
    
}
.about{
    background-color:rgb(7, 19, 70);
}
.row_about{
display:flex;
}
.content_about{
    width:400px ;
    padding:0 50px;
}
.URS{
    list-style-type:none;
}
.RS{
display:inline-block;
padding-right: 30px;
}
.listeRS{
margin-top:90px;
}
.RS:hover{
    transform: translateY(-20px);
   
    

    
}
.fond{
    justify-content:space-evenly;
    align-items: center;
    padding-left:20px;
    display:flex;
    padding-bottom:50px;
}
.inside_fond{
    width:600px;
    
}
.contenu{
  max-width: 500px;
  border-radius :8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  transition:0.2s ;
  background-image: url(IMAGE/eff.jpeg);

}
.contenu:hover{
    transform:scale(1.04);
}
.container1{
    justify-content:space-between;
    align-items: center;
    /*padding-left:20px;*/
    display:flex;
    
}
.content{
    margin-right: 20px;
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
}?>
    <div class="header">
      <h1></h1>
        <div class="liste">
       <ul class="navbar">
        <li class="nv"><a href="inscription.php">Registration</a></li>
        <li class="nv"><a href="login.php">login</a></li>
        <li class="nv"><a target="_blank" href="mailto:mouadrguibi900@gmail.com">Contact us</a></li>
        <li class="nv"> <a href=#ab>About US</a></li>
        <li class="nv"> <a href=ash.php>NEWS</a></li>
       </ul>
        </div>
    </div>
    <hr>
    <main style="color:white;padding-left:30px;padding-right:30px">
        <h2>Bienvenue sur votre club:</h2>
     <p style="text-align: center; margin-right: 140px;margin-left:140px ;">
        Plongez dans l'univers du gaming à la Faculté des Sciences et Techniques à TANGER ! Rejoignez-nous pour des tournois, des événements spéciaux et une communauté de passionnés. Vivez des expériences uniques et créez des souvenirs inoubliables avec le Club Gaming de la FST. Rejoignez-nous et découvrez une nouvelle dimension du divertissement.
    </p>
    <div class="gamingpic"><img style="width:350px"class="gamingpiic"src="efficace/fstgaming.png"></div> 
    </main>
    <div>
        <h2>Quels sont les bénéfices d'être membre?</h2>
        <p style="text-align: center; margin-right: 140px;margin-left:140px ;color:white;">jouez avec vos amis et améliorez vos compétences de jeu pour devenir meilleur !!</p>
        <div style="margin-bottom:150px;margin-top:70px">
           <div class="container1">
             <div class="contenu">
                <img style="height:140px"src="IMAGE/time.webp">
            <h3>8 heures de STEM</h3>
            <p style="text-align:center;width:400px;color:rgba(206, 206, 206, 1)">Les membres peuvent assister jusqu'à 4 sessions de deux heures, totalisant 8 heures d'activités STEM mensuelles.</p>
             </div>
             <div class="contenu">
             <img style="height:140px"src="IMAGE/badge.png">
            <h3>De vrais badges</h3>
            <p style="text-align:center;width:400px;color:rgba(206, 206, 206, 1)">Comme les Scouts, chaque mois est une nouvelle activité avec la possibilité de gagner un nouveau badge physique.</p>
             </div>
             <div class="contenu">
             <img style="height:140px"src="IMAGE/download.png">
            <h3>Logiciel payant</h3>
            <p style="text-align:center;width:400px;color:rgba(206, 206, 206, 1)">Une partie du coût comprend les logiciels que les membres possèdent désormais pour s'entraîner et jouer.</p>
             </div>
           </div>
           <br>
           <div class="container1">
             <div class="contenu">
             <img style="height:140px"src="IMAGE/servers.png">
            <h3>Serveur minecraft</h3>
            <p style="text-align:center;width:400px;color:rgba(206, 206, 206, 1)">Les membres peuvent jouer sur un serveur exclusif auquel eux seuls ont accès depuis chez eux.</p>
             </div>
             <div class="contenu">
             <img style="height:110px"src="IMAGE/controlller.png">
            <h3>Soirée jeu vidéo de 3 heures</h3>
            <p style="text-align:center;width:400px;color:rgba(206, 206, 206, 1)">Chaque mois, nous nous réunissons et jouons à des jeux vidéo, des jeux de société et de la réalité virtuelle lors d'un événement social au DiVRgence de Huntsville !</p>
             </div>
             <div class="contenu">
             <img style="height:110px"src="IMAGE/discussion.webp">
            <h3>Site social</h3>
            <p style="text-align:center;width:400px;color:rgba(206, 206, 206, 1)">Access to the site also includes a safe and secure social media hosted in this site for interacting.</p>
             </div>
           </div>
            
        </div>

    </div>
   
    <!-- <footer style="color:white">
        <div id="news"style="text-align:center;font-size:50px">NOS ACTUALITES</div>
        <br>
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
        echo '<div class="content">';
        echo '<div class="img"><a href="login.php"><img style="width:300px" src="image_events/' . $row["image_path"] . '"></a></div> <br>';
        echo '<p>' . $row['description'] . '</p>'; // Ajoutez la description ici
        echo '</div>';
    }
} else {
    // Aucun événement trouvé
    echo "Aucun événement trouvé.";
}

// Fin du conteneur pour les événements
echo '</div>';
?>

    </footer> -->
    <div id="ab" class="about">
    <div class="container_about">
        <div class="row_about">
            <div class="content_about">
              <div><p style="color:rgba(206, 206, 206, 0.623);font-size: 17px;"><img style="width:120px"src="efficace/fstgaming.png"><br>Gaming Club,à Faculté des sciences et techniques TANGER</p></div> <br>
           </div>
        <div class="content_about">
              <div><p style="color:yellow;font-size:20px">Entrepreneuriat</p><p style="color:rgba(206, 206, 206, 0.623);font-size: 17px;">Notre capacité à identifier des opportunités et notre talent à les transformer en projets créateurs de valeur</p><p style="color:gold;font-size: 20px;">Us<p><p style="color:rgba(206, 206, 206, 0.623);font-size: 17px;">Une communauté de professionnels et d'enseignants qui soutiennent une nouvelle génération de jeunes leaders à devenir des acteurs du changement</p></div> <br>
           </div>
           <div class="content_about">
            <div>
                <p style="color:yellow;text-align: center;font-size: 20px;">Restez connectés</p>
             <div class="listeRS">
                    <ul class="URS">
                     <li class="RS"><a href="https://web.facebook.com/mouad.rguibi.1"><img style="width:40px"src="efficace/facebook.png"></a></li>
                     <li class="RS"><a href="https://www.instagram.com/mouadrguibi/"><img style="width:40px"src="efficace/instagram.png"></a></li>
                     <li class="RS"><a target="_blank" href="https://www.linkedin.com/in/mouad-rguibi-a9969b265/"><img style="width:40px"src="efficace/linkedin.png"></a></li>
                     <li class="RS"> <a href="https://github.com/mouadrguibi"><img style="width:40px"src="efficace/logo-github.png"></a></li>
                    </ul>
                     </div>
            </div> <br>
           </div>
          </div>
        </div>
        <hr>
        <div class="fond">
            <div class="inside_fond">
                  <p style="color:white;font-size: 15px;font-family:'Courier New', Courier, monospace"><b>GAMING CLUB </b> &copy;2024  TOUS LES DROITS RÉSERVÉS — POLITIQUE DE CONFIDENTIALITÉ</p>
            </div>
            <div class="inside_fond">
            <p style="color:white;font-size:15px;text-align: right;font-family:'Courier New', Courier, monospace">Réalisé par:RGUIBI MOHAMED MOUAD</p>
            </div>

        </div>
    </div>
    
</body> 
</html>