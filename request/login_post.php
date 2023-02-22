<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';
// var_dump($_POST);

if(empty($_POST['email']) || empty($_POST['password'])):
    $msg_error = "<div class=\"red\">Merci de remplir tous les champs</div>";
else:
    $email = filter_var(strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
    if(!$email):
        $msg_error = "<div class=\"red\">Merci de renseigner un email valide</div>";
    else:
        $req = $bdd->prepare("
        SELECT u.*, r.role_name , r.role_slug FROM users AS u
        INNER JOIN roles AS r
        ON u.id_role = r.id
        WHERE u.email = :email
        ");

        $req->execute(array(
			// variable SQL => variable PHP
			'email' => $email
		));

        $result = $req->fetch(PDO::FETCH_OBJ);

        if(!$result) : // donc l'email n'est pas dans la BDD
			$msg_error = "<div class=\"red\">Le mot de passe ou l'identifiant ne sont pas valides</div>";
        else :
            $password = trim($_POST['password']); //le password dans le input  
            
            if (!password_verify($password, $result->password)) :
				$msg_error = "<div class=\"red\">Le mot de passe ou l'identifiant ne sont pas valides</div>";

            else :
                $_SESSION['id_user'] 	= $result->id;
                $_SESSION['id_role'] 	= $result->id_role;
                $_SESSION['first_name'] = $result->first_name;
                $_SESSION['last_name'] 	= $result->last_name;
                $_SESSION['email'] 		= $result->email;
                $_SESSION['pseudo'] 	= $result->pseudo;
                $_SESSION['role_name'] 	= $result->role_name;
                $_SESSION['role_slug'] 	= $result->role_slug;
                $msg_success = "<div class='green'>Vous êtes bien connecté</div>";

            endif;
        endif;

    endif;
endif;
if(isset($msg_error)) { // isset vérifie si la variable existe et qu'elle n'est pas nulle
	header('Location: ' . HOME_URL . '?msg=' . $msg_error);
}
else {
	header('Location: ' . HOME_URL . '?msg=' . $msg_success);
}

