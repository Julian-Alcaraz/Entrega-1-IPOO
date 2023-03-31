<?php
    class Pasajeros{
        private $nombre;
        private $apellido;
        private $dni;
        public function setNombre($valor){
            $this->nombre=$valor;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setApellido($valor){
            $this->apellido=$valor;
        }
        public function getApellido(){
            return $this->apellido;
        } public function setDni($valor){
            $this->dni=$valor;
        }
        public function getDni(){
            return $this->dni;
        }
        public function __construct($name,$surn,$doc){
            $this->nombre=$name;
            $this->apellido=$surn;
            $this->dni=$doc;
        }
        public function __toString(){
            return "Nombre: ".$this->nombre."\n Apellido: ".$this->apellido."\n Nombre: ".$this->nombre."\n Documento: ".$this->dni;
        }
    }
?>