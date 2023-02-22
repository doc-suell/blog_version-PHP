<?php
require __DIR__ . '/header.php';
require_once __DIR__ . '/navbar.php';
require_once PATH_PROJECT . '/connect.php';

//On a recuperer tous les articles avec leurs utilisateurs
//Puis on mets le résultat de notre SQL dans variable $req

// var_dump($req);
//fetchAll nous permettre de obtenir le resultat d'un seul coup
//FETCH_OBJ Récupère la prochaine ligne et la retourne en tant qu'objet

$req = $bdd->prepare("
SELECT a.id, a.id_user, a.title, a.content, a.created_at , u.first_name, u.last_name
FROM articles AS a 
LEFT JOIN users AS u 
ON a.id_user = u.id
ORDER BY a.created_at DESC ");



$req->execute();
$articles = $req->fetchAll(PDO::FETCH_OBJ);
?>
<h2 class="title">Les Articles  </h2> 



<?php 
foreach($articles as $value) :
    $id_article = $value->id; 
?>
<div class="articles">
    <p>Ecrit par : <?php echo sanitize_html($value->first_name) . ' ' . sanitize_html($value->last_name); ?></p>
    <h3><?php echo sanitize_html($value->title); ?></h3> 
    <p><?php echo sanitize_html($value->content); ?></p>
    <p><?php echo sanitize_html($value->created_at); ?></p>

</div>

<?php endforeach; ?>


<!-- // var_dump($bdd->errorInfo()); pour afficher les errors 😂

// while($donnees = $req->fetch()){

//     echo <strong>TITLE :</strong> .  $donnees['title']. '<br/>';
//     echo $donnees['content']. '<br/>';
//     echo <strong>created by :</strong>' . $donnees['first_name'].  $donnees['last_name'] . '<br/>';
//     echo $donnees['created_at']. '<br/>';

// }
// $req ->closeCursor(); -->






<?php
require __DIR__ . '/footer.php';?>