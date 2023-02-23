<?php

function getBDD()
{
    try {
        $bdd = new PDO('mysql:host=localhost; dbname=alimentation_app; charset=utf8', 'root', 'root');
        return $bdd;
    } catch (Exception $e) {
        die('Erreur :' . $e->getMessage());
    }
}

function isEmailUnique($email)
{
    $bdd = getBdd();
    $query = $bdd->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $query->execute([$email]);
    $count = $query->fetchColumn();
    return $count == 0;
}

function signIn($email, $password)
{
    $bdd = getBdd();
    if (isEmailUnique($email)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = $bdd->prepare("INSERT INTO users (email, pwd) VALUES (:email, :pwd)");
        $query->bindParam(':email', $email);
        $query->bindParam(':pwd', $hashed_password);
        $query->execute();
    } else {
        echo "adresse mail déjà enregistrée";
    }
}

function logIn($email, $password)
{
    $bdd = getBdd();
    $query = $bdd->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch();

    if ($user && password_verify($password, $user['pwd'])) {
        echo "Le mot de passe est correct";
        return $user;
    } else {
        echo 'Le mot de passe est incorrect ou l\'utilisateur n\'a pas été trouvé';
    }
}

function getAllUsers()
{
    $bdd = getBdd();
    $query = $bdd->prepare('SELECT * FROM users');
    $query->execute();
    $users = $query->fetchAll();
    return $users;
}

function getOneUser($id)
{
    $bdd = getBdd();
    $query = $bdd->prepare("SELECT * FROM users WHERE id=:id");
    $query->bindParam(':id', $id);
    $query->execute();
    $oneUser = $query->fetch();
    return $oneUser;
}

function updateOneUser($id, $firstname, $lastname, $email, $pwd, $weight_user, $height, $sexe, $date_of_birth)
{
    $bdd = getBdd();
    $query = $bdd->prepare("UPDATE users 
    SET firstname=:firstname, lastname=:lastname, email=:email, pwd=:pwd, weight_user=:weight_user, height =:height, sexe =:sexe, date_of_birth =:date_of_birth
    WHERE id=:id");
    $query->bindParam(':id', $id);
    $query->bindParam(':firstname', $firstname);
    $query->bindParam(':lastname', $lastname);
    $query->bindParam(':email', $email);
    $query->bindParam(':pwd', $pwd);
    $query->bindParam(':weight_user', $weight_user);
    $query->bindParam(':height', $height);
    $query->bindParam(':sexe', $sexe);
    $query->bindParam(':date_of_birth', $date_of_birth);
    $query->execute();
}

function deleteUser($id)
{
    $bdd = getBdd();
    $query = $bdd->prepare("DELETE FROM users WHERE id=:id");
    $query->bindParam(':id', $id);
    $query->execute();
}
