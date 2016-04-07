<?php

    class Member {

        private $firstName;
        private $lastName;
        private $id;
        private $password;
        private $handicap;
        private $address;
        private $clubs = [];

        /*public function __construct($firstName='', $lastName='', $golfBoxNumber, $password, $membershipClub='', $handicap='', $marker = false) {

            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->golfBoxNumber = $golfBoxNumber;
            $this->password = $password;
            $this->membershipClub = $membershipClub;
            $this->handicap = $handicap;
            $this->marker = $marker;
        }*/

        public function __construct($id, $password) {

            $this->id = $id;
            $this->password = $password;
        }

        /**
         * @return mixed
         */
        public function getFirstName() {

            return $this->firstName;
        }

        /**
         * @param mixed $firstName
         */
        public function setFirstName($firstName) {

            $this->firstName = $firstName;
        }

        /**
         * @return mixed
         */
        public function getLastName() {

            return $this->lastName;
        }

        /**
         * @param mixed $lastName
         */
        public function setLastName($lastName) {

            $this->lastName = $lastName;
        }

        /**
         * @return mixed
         */
        public function getId() {

            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id) {

            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getPassword() {

            return $this->password;
        }

        /**
         * @param mixed $password
         */
        public function setPassword($password) {

            $this->password = $password;
        }

        /**
         * @return mixed
         */
        public function getHandicap() {

            return $this->handicap;
        }

        /**
         * @param mixed $handicap
         */
        public function setHandicap($handicap) {

            $this->handicap = $handicap;
        }

        /**
         * @return mixed
         */
        public function getAddress() {

            return $this->address;
        }

        /**
         * @param mixed $address
         */
        public function setAddress($address) {

            $this->address = $address;
        }

        /**
         * @return array
         */
        public function getClubs() {

            return $this->clubs;
        }

        /**
         * @param array $clubs
         */
        public function setClubs($clubs) {

            $this->clubs = $clubs;
        }


        public static function fromJson($json){

            $player = json_decode($json);

            return new Member($player->id, $player->password);
        }

        public function toJson(){

            return json_encode(get_object_vars($this));
        }

        public function __toString() {
            // TODO: Implement __toString() method.
            return print_r($this, true);
        }
    }