<?php 
    class PasajeroVip extends Pasajeros{
        private $numeroViajeroFrecuente;
        private $cantidadMillas;
        
        public function setNumeroViajeroFrecuente($valor){
            $this->numeroViajeroFrecuente=$valor;
        }
        public function getNumeroViajeroFrecuente(){
            return $this->numeroViajeroFrecuente;
        }
        public function setCantidadMillas($valor){
            $this->cantidadMillas=$valor;
        }
        public function getCantidadMillas(){
            return $this->cantidadMillas;
        }
        public function __construct($name,$surn,$doc,$tel,$asie,$tick,$numeroViajero,$cantidadMillas){
            parent:: __construct($name,$surn,$doc,$tel,$asie,$tick);
            $this->numeroViajeroFrecuente=$numeroViajero;
            $this->cantidadMillas=$cantidadMillas;
        }
        public function __toString(){
            $cadena= parent:: __toString();
            $cadena=$cadena. "\n Numero Viajero: ".$this->getNumeroViajeroFrecuente().
                    "\n Cantidad Millas: ".$this->getCantidadMillas()."\n";
            return $cadena;
        }
        public function darPorcentaje(){
            $porcentaje=0;
            if($this->getCantidadMillas()>300){
                $porcentaje=0.30;
            }else{
                $porcentaje=0.35;
            }
            return $porcentaje;
        }
    }
?>