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

    if($currentPlayer->getPassword() && $currentPlayer->getId()) {
        $statement->execute(array($currentPlayer->getId()));
        $password = '';

        //must not fetchAll more than once!!!!
        foreach($statement->fetchAll() as $result) {

            if($result['id'] == $currentPlayer->getId())
                $password = $result['password'];
        }
    }
    //compare password from login attempt to password from mysql query
    echo password_verify($currentPlayer->getPassword(), $password)
        ? '{"message": "Login successful"}'
        : '{"message": "Login fejlede. Der er fejl i brugernavn eller adgangskode"}';

