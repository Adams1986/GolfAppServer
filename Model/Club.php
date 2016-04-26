<?php


    class Club implements \JsonSerializable{

        private $id;
        private $name;
        private $courses;
        

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
        public function getName() {

            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name) {

            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getCourses() {

            return $this->courses;
        }

        /**
         * @param mixed $courses
         */
        public function setCourses($courses = array()) {

            $this->courses = $courses;
        }


        public static function fromJson($json){

            $club = json_decode($json);

            return new Club($club->name);
        }

        public function toJson(){

            return json_encode(get_object_vars($this));
        }

        /**
         * Specify data which should be serialized to JSON
         * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
         * @return mixed data which can be serialized by <b>json_encode</b>,
         * which is a value of any type other than a resource.
         * @since 5.4.0
         */
        function jsonSerialize() {
            // TODO: Implement jsonSerialize() method.
            return get_object_vars($this);
        }
    }