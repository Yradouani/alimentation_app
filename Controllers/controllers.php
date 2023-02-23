<?php
require('././Models/modelsUser.php');
require('././Models/modelsFood.php');
require('././Models/modelsDate.php');

// Affiche la liste de tous les employés de l'entreprise
function accueil()
{
    // $clients = getClients();
    require './Vues/VueAccueil.php';
}

function signInUser()
{
}

function logInUser()
{
    if (isset($_POST)) {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        $user = logIn($email, $pwd);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
        }
    }
}

function logOutUser()
{
    session_destroy();
}

function addUserInfo()
{
}

// Affiche une erreur
function erreur($msgErreur)
{
    require './Vues/vueErreur.php';
}
