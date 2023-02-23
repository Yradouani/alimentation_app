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

function getAllFood()
{
    $bdd = getBdd();
    $query = $bdd->prepare('SELECT * FROM food');
    $query->execute();
    $food = $query->fetchAll();
    return $food;
}

function getOnefood($id)
{
    $bdd = getBdd();
    $query = $bdd->prepare("SELECT * FROM food WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $onefood = $query->fetch();
    return $onefood;
}