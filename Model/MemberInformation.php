<?php
    require 'Member.php';
    //post workaround
    parse_str(file_get_contents("php://input"), $_POST);

    //get message from server. Saved as an array with 1 string
    $json = $_POST['message'];

    //parsing json data to a Player object
    $currentPlayer = Member::fromJson($json);

    /*$data = [];
    //true to return an array
    $data = json_decode($json, true);*/


    $db = new PDO('mysql:host=localhost; dbname=xb10project', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $db->prepare('SELECT * FROM members WHERE id = ?');


    $statement->execute(array($currentPlayer->getId()));


    //must not fetchAll more than once!!!!
    foreach($statement->fetchAll() as $result) {

        if($result['id'] == $currentPlayer->getId()) {
            $currentPlayer->setFirstName($result['first_name']);
            $currentPlayer->setLastName($result['last_name']);
            $currentPlayer->setHandicap($result['handicap']);
            $currentPlayer->setAddress($result['address']);
        }
    }

    $statement = $db->prepare('SELECT club_name FROM clubs INNER JOIN memberships ON club_id = clubs.id WHERE member_id = ?');

    $statement->execute(array($currentPlayer->getId()));
    $clubs = array();

    foreach($statement->fetchAll() as $result){

        array_push($clubs, $result['club_name']);
    }
    $currentPlayer->setClubs($clubs);

    echo $currentPlayer->toJson();

