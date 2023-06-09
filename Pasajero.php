<?php
    class Pasajero{
        private $nombre;
        private $apellido;
        private $dni;
        private $numeroTel;
        //ahora
        private $numeroAsiento;
        private $numeroTicket;
        //private $tipoPasajero; va ono?
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
        public function setNumeroAsiento($valor){
            $this->numeroAsiento=$valor;
        }
        public function getNumeroAsiento(){
            return $this->numeroAsiento;
        }
        public function setNumeroTicket($valor){
            $this->numeroTicket=$valor;
        }
        public function getNumeroTicket(){
            return $this->numeroTicket;
        }
        public function __construct($name,$surn,$doc,$tel,$asie,$tick){
            $this->nombre=$name;
            $this->apellido=$surn;
            $this->dni=$doc;
            $this->numeroTel=$tel;
            $this->numeroAsiento=$asie;
            $this->numeroTicket=$tick;
        }
        public function __toString(){
            return "     Nombre: ".$this->getNombre().
            "\n     Apellido: ".$this->getApellido().
            "\n     Dni: ".$this->getDni().
            "\n     Numero Telefono: ".$this->getNumeroTel().
            "\n     Numero Asiento: ".$this->getNumeroTel().
            "\n     Numero Ticket: ".$this->getNumeroAsiento();
        }
        public function darPorcentaje(){
            $porcentaje=0.10;
            return $porcentaje;
        }
    }
?>