<?php


    class Course implements \JsonSerializable{

        private $id;
        private $name;
        private $holes;
        private $slope;
        private $rating;
        private $metaData;

        /**
         * Course constructor.
         * @param $id
         * @param $name
         * @param $holes
         * @param $slope
         * @param $rating
         * @param $metaData
         */
        public function __construct($id = null, $name = null, $slope = null, $rating = null, $holes = null, $metaData = null) {

            $this->id = $id;
            $this->name = $name;
            $this->holes = $holes;
            $this->slope = $slope;
            $this->rating = $rating;
            $this->metaData = $metaData;
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
        public function getHoles() {

            return $this->holes;
        }

        /**
         * @param mixed $holes
         */
        public function setHoles($holes) {

            $this->holes = $holes;
        }

        /**
         * @return mixed
         */
        public function getSlope() {

            return $this->slope;
        }

        /**
         * @param mixed $slope
         */
        public function setSlope($slope) {

            $this->slope = $slope;
        }

        /**
         * @return mixed
         */
        public function getRating() {

            return $this->rating;
        }

        /**
         * @param mixed $rating
         */
        public function setRating($rating) {

            $this->rating = $rating;
        }

        /**
         * @return mixed
         */
        public function getMetaData() {

            return $this->metaData;
        }

        /**
         * @param mixed $metaData
         */
        public function setMetaData($metaData) {

            $this->metaData = $metaData;
        }



        public static function fromJson($json){

            $course = json_decode($json);

            return new Course($course->id);
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

            return get_object_vars($this);
        }
    }