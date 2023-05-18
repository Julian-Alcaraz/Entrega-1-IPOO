<?php 
    class PasajeroEspecial extends Pasajeros{
        private $sillaRueda;
        private $asistencia;
        private $comidaEspeciales;

        public function setSillaRueda($valor){
            $this->sillaRueda=$valor;
        }
        public function getSillaRueda(){
            return $this->sillaRueda;
        }
        public function setAsistencia($valor){
            $this->asistencia=$valor;
        }
        public function getAsistencia(){
            return $this->asistencia;
        }
        public function setComidadEspeciales($valor){
            $this->comidaEspeciales=$valor;
        }
        public function getComidaEspeciales(){
            return $this->comidaEspeciales;
        }
        public function __construct($name,$surn,$doc,$tel,$asie,$tick,$silla,$asis,$comida){
            parent:: __construct($name,$surn,$doc,$tel,$asie,$tick);
            $this->sillaRueda=$silla;
            $this->asistencia=$asis;
            $this->comidaEspeciales=$comida;
        }
        public function __toString(){
            $cadena= parent:: __toString();
            $cadena=$cadena. "\n Necesita silla rueda: ".$this->getSillaRueda().
            "\n Necesita Asistencia: ".$this->getAsistencia().
            "\n Necesita Comida especial: ".$this->getComidaEspeciales();
            return $cadena;
        }
        public function darPorcentaje(){
            $porcentaje=0;
            if($this->getAsistencia()=="SI" && $this->getComidaEspeciales()=="SI" && $this->getSillaRueda()=="SI"){
                $porcentaje=0.30;
            }else if($this->getAsistencia()=="SI" || $this->getComidaEspeciales()=="SI" || $this->getSillaRueda()=="SI"){//uno o dos servicios
                $porcentaje=0.15;
            }
            return $porcentaje;
        }
    }
?>