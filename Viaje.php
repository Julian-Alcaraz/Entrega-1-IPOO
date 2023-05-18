<?php
class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros=[];
    private $responsable;

    private $costoViaje;
    private $costoAbonado;


    public function __construct($codVia,$dest,$cantM,$arregloPasajeros,$resp,$costo,$costoAbon){
        $this->codigoViaje = $codVia;
        $this->destino = $dest;
        $this->cantMaxPasajeros = $cantM;
        $this->pasajeros = $arregloPasajeros;
        $this->responsable=$resp;
        $this->costoViaje=$costo;
        $this->costoAbonado=$costoAbon;

    }
    public function getCostoAbonado(){
        return $this->costoAbonado;    
    }
    public function setCostoAbonado($cost){
        $this->costoAbonado=$cost;    
    }
    public function getCostoViaje(){
        return $this->costoViaje;    
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
    public function setCostoViaje($costo){
        $this->costoViaje=$costo;    
    }
    public function setResponsable($valor){
        $this->responsable = $valor;
    }
    public function getResponsable($valor){
        $this->responsable = $valor;
    }
    public function __toString(){
        $mensaje="  Codigo Viaje: ".$this->codigoViaje."\n".
        "  Destino Viaje: ".$this->destino."\n".
        "  Cantidad de pasajeros: ".$this->cantMaxPasajeros."\n".
        "  Costo Viaje: ".$this->costoViaje."\n".
        "  Pasajeros: \n";
        for($h=0;$h<($this->cantMaxPasajeros);$h++){
            $mensaje=$mensaje."\nPasajero ".($h+1)."\n".($this->pasajeros)[$h];
        }
        $mensaje=$mensaje.$this->responsable."\n";
        return $mensaje;
    }
    public function venderPasaje($pasa){
        $this->getPasajeros()[]=$pasa;
        $precioPasajero=$this->getCostoViaje()+$this->getCostoViaje()*$pasa->darPorcentaje();
        $totalAbonados=$this->getCostoAbonado()+$precioPasajero;
        $this->setCostoAbonado($totalAbonados);
        return $precioPasajero;
    }
    
}
?>