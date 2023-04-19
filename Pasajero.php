<?php
    class Pasajeros{
        private $nombre;
        private $apellido;
        private $dni;
        private $numeroTel;
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
        } 
        public function setDni($valor){
            $this->dni=$valor;
        }
        public function getDni(){
            return $this->dni;
        }
        public function setNumeroTel($valor){
            $this->numeroTel=$valor;
        }
        public function getNumeroTel(){
            return $this->numeroTel;
        }
        public function __construct($name,$surn,$doc,$tel){
            $this->nombre=$name;
            $this->apellido=$surn;
            $this->dni=$doc;
            $this->numeroTel=$tel;
        }
        public function __toString(){
            return "     Nombre: ".$this->nombre.
            "\n     Apellido: ".$this->apellido.
            "\n     Nombre: ".$this->nombre.
            "\n     Dni: ".$this->dni.
            "\n     Numero Telefono: ".$this->numeroTel."\n";
        }
    }
?>