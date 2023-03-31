<?php
class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros=[];

    public function __construct($codVia,$dest,$cantM,$arregloPasajeros){
        $this->codigoViaje = $codVia;
        $this->destino = $dest;
        $this->cantMaxPasajeros = $cantM;
        $this->pasajeros = $arregloPasajeros;
    }
    public function getCodigoViaje(){
        return $this->codigoViaje;    
    }
    public function getDestino(){
        return $this->destino;    
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;    
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function setCodigoViaje($codVia){
        $this->codigoViaje = $codVia;
    }
    public function setDestino($dest){
        $this->destino = $dest;
    }
    public function setCantMaxPasajeros($cantM){
        $this->cantMaxPasajeros = $cantM;
    }
    public function setPasajeros($arregloPasajeros){
        $this->pasajeros = $arregloPasajeros;
    }
    public function __toString(){
        //return "Codigo de viaje: ".$this->codigoViaje."\n Destino: ".$this->destino."\n Cantidad pasajeros: ".$this->cantMaxPasajeros." \n Pasajeros: ".print_r($this->pasajeros);
       $mensaje="  Codigo Viaje: ".$this->codigoViaje."\n".
        "  Destino Viaje: ".$this->destino."\n".
        "  Cantidad de pasajeros: ".$this->cantMaxPasajeros."\n".
        "  Pasajeros: \n";
        for($h=0;$h<($this->cantMaxPasajeros);$h++){
            $mensaje=$mensaje."\nPasajero ".($h+1). "\n".($this->pasajeros)[$h];
        }
        return $mensaje;
        
    }
        
    }
?>