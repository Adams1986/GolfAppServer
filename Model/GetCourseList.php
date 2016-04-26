<?php

    require 'Club.php';
    require 'Course.php';
    require 'Hole.php';

    //get message from server. Saved as an array with 1 string
    //trim whitespace
    $search = $_GET['search'];


    $clubs = array();
    $courses = array();

    /*$data = [];
        //true to return an array
        $data = json_decode($json, true);*/

    $db = new PDO('mysql:host=localhost; dbname=xb10project', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $db->prepare('SELECT * FROM clubs WHERE club_name LIKE ?');

    $statement->execute(array('%'.$search.'%'));
    //$statement->execute(array('%'.'s'.'%'));

    foreach($statement->fetchAll() as $result){

        $tempClub = new Club();
        $tempClub->setName($result['club_name']);
        $tempClub->setId($result['id']);
        array_push($clubs, $tempClub);

        $statement = $db->prepare('SELECT * FROM courses WHERE club_id = ?');
        $statement->execute(array($tempClub->getId()));

        $courses = array();

        //redundant if inner join and somehow separation of club and courses...
        foreach($statement->fetchAll() as $value) {

            $tempCourse = new Course();
            $tempCourse->setId($value['id']);
            $tempCourse->setName($value['course_name']);
            $tempCourse->setSlope($value['course_slope']);
            $tempCourse->setRating($value['course_rating']);

            array_push($courses, $tempCourse);
            $tempClub->setCourses($courses);

            $holes = array();

            $statement = $db->prepare('SELECT * FROM holes WHERE course_id = ?');
            $statement->execute(array($tempCourse->getId()));

            foreach($statement->fetchAll() as $item){
                $tempHole = new Hole();
                $tempHole->setId($item['hole_id']);
                $tempHole->setNumber($item['number']);
                $tempHole->setPar($item['par']);
                $tempHole->setHcp($item['hcp']);
                $tempHole->setLength($item['length']);

                array_push($holes, $tempHole);
                $tempCourse->setHoles($holes);
            }
        }
    }

    //todo: Looking into more effective solution without a huge amount of mysql calls
/*    $statement = $db->prepare('SELECT courses.*, clubs.club_name
                                FROM clubs
                                INNER JOIN courses
                                ON courses.club_id = clubs.id
                                WHERE club_name
                                LIKE ?');

    $statement->execute(array('%'.'s'.'%'));

    //must not fetchAll more than once!!!!
    foreach($statement->fetchAll() as $result) {


        if(!in_array($result['club_id'], $clubs)) {
            $tempClub = new Club();
            $tempClub->setId($result['club_id']);
            $tempClub->setName($result['club_name']);
            $tempCourse = new Course($result['id'], $result['course_name'], $result['course_rating'], $result['course_slope']);
            $tempClub->setCourses(array($tempCourse->toJson()));
            array_push($clubs, $tempClub);
        }
    }*/
    echo json_encode($clubs);