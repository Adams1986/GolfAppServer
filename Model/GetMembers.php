<?php

    require 'Member.php';

    //get message from server. Saved as an array with 1 string
    //trim whitespace
    $search = $_GET['search'];


    $members = array();

    /*$data = [];
        //true to return an array
        $data = json_decode($json, true);*/

    $db = new PDO('mysql:host=localhost; dbname=xb10project', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $db->prepare('SELECT id, first_name, last_name, handicap FROM members
                                WHERE first_name
                                LIKE ?
                                OR last_name LIKE ?
                                OR id LIKE ?');

    //$statement->execute(array('%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
    $statement->execute(array('%'.'pet'.'%', '%'.'pet'.'%', '%'.'pet'.'%'));

    foreach($statement->fetchAll() as $result){

        $tempMember = new Member();
        $tempMember->setId($result['id']);
        $tempMember->setFirstName($result['first_name']);
        $tempMember->setLastName($result['last_name']);
        $tempMember->setHandicap($result['handicap']);
        array_push($members, $tempMember);

        //again probably ineffective as there are additional searches
        // determined by original sql query. Big database => big problem
        $statement = $db->prepare('SELECT club_name
                                    FROM clubs
                                    INNER JOIN memberships
                                    ON club_id = clubs.id
                                    WHERE member_id = ?');

        $statement->execute(array($tempMember->getId()));
        $clubs = array();

        foreach($statement->fetchAll() as $value){

            array_push($clubs, $value['club_name']);
        }
        $tempMember->setClubs($clubs);
    }

    echo json_encode($members);