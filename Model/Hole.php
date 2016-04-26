<?php

    class Hole implements \JsonSerializable {

        private $id;
        private $number;
        private $par;
        private $hcp;
        private $length;

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
        public function getNumber() {

            return $this->number;
        }

        /**
         * @param mixed $number
         */
        public function setNumber($number) {

            $this->number = $number;
        }

        /**
         * @return mixed
         */
        public function getPar() {

            return $this->par;
        }

        /**
         * @param mixed $par
         */
        public function setPar($par) {

            $this->par = $par;
        }

        /**
         * @return mixed
         */
        public function getHcp() {

            return $this->hcp;
        }

        /**
         * @param mixed $hcp
         */
        public function setHcp($hcp) {

            $this->hcp = $hcp;
        }

        /**
         * @return mixed
         */
        public function getLength() {

            return $this->length;
        }

        /**
         * @param mixed $length
         */
        public function setLength($length) {

            $this->length = $length;
        }



        function jsonSerialize() {
            // TODO: Implement jsonSerialize() method.
            return get_object_vars($this);
        }
    }