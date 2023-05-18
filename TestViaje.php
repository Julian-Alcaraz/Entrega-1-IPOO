<?php
include 'Viaje.php';
include 'Pasajero.php';
include 'Responsable.php';
include 'PasajeroVip.php';
include 'PasajeroEstandar.php';
include 'PasajeroEspecial.php';

$arregloViajes=[];
function encontrarCodigoIgual($arreglo,$codigo){
    $valor=false;
    for($r=0;$r<count($arreglo);$r++){
        if($arreglo[$r]->getCodigoViaje()==$codigo){
            $valor=true;
        }else{
            $valor=false; 
        }
    } 
    return $valor;
}
function verificarDocumento($arreglo,$dniQuiereIngresar){//recibe arreglo pasajeros, devuelve true si no existe ese documento, false si  existe
    $cantPasajeros=count($arreglo);
    $verdad=true;
    if($cantPasajeros!=0){
        for($i=0;$i<$cantPasajeros;$i++){
            $documento=$arreglo[$i]->getDni();
            if($documento==$dniQuiereIngresar){
                $verdad=false;
            }
        }
    }
    return $verdad;
}
function cargarPasajero(){
    echo "Ingrese el documento del pasajero";
    $dni = trim(fgets(STDIN));
    echo "Ingrese el nombre del pasajero";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido del pasajero";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese el numero de telefono";
    $telefono = trim(fgets(STDIN));
    echo "Ingrese Numero Asiento";
    $numeroAsiento=trim(fgets(STDIN));
    echo "Ingrese Numero Ticket";
    $numeroTicket=trim(fgets(STDIN));
    do{
        echo "Ingrese segun tipo Pasajero: 1:Vip ,2:especial ,3:Estandar ";
        $tipoPasajero=trim(fgets(STDIN));
        switch ($tipoPasajero){
            case 1: 
                echo "Ingrese el numero de viajero frecuente";
                $numeroViajeroFrecuente=trim(fgets(STDIN));
                echo "Ingrese el numerode millas";
                $numeroMillas=trim(fgets(STDIN));
                $pas = new PasajeroVip($nombre,$apellido,$dni,$telefono,$numeroAsiento,$numeroTicket,$numeroViajeroFrecuente,$numeroMillas);
                $ingresoCorrecto=false;
                break;
            case 2: 
                echo "Necesita silla de rueda (SI/NO)";
                $sillaRueda=strtoupper(trim(fgets(STDIN)));
                echo "Necesita asistencia para embarque (SI/NO)";
                $embarque=strtoupper(trim(fgets(STDIN)));
                echo "Necesita comida especial (SI/NO)";
                $comida=strtoupper(trim(fgets(STDIN)));
                $pas = new PasajeroEspecial($nombre,$apellido,$dni,$telefono,$numeroAsiento,$numeroTicket,$sillaRueda,$embarque,$comida);
                $ingresoCorrecto=false;

                break;
            case 3: //como no especifica nada del estandar uso pasajero normal
                $pas = new Pasajeros($nombre,$apellido,$dni,$telefono,$numeroAsiento,$numeroTicket);
                break;
            default: 
                echo "Numero mal ingresado vuelva a ingresarlo \n";
                $ingresoCorrecto=true;
            break;
        }
    }while($ingresoCorrecto);
    return $pas;
}
function cargarViaje($arreglo){
    echo "Ingrese codigo de viaje: "."\n";
    $codigoVia = trim(fgets(STDIN));
    $pasajeros=[];
    if(encontrarCodigoIgual($arreglo,$codigoVia)){
        echo"EL CODIGO DE VIAJE YA EXISTE \n";
        $viaje=null;
    }else{
        echo "Ingrese destino del viaje: "."\n";
        $lugar = trim(fgets(STDIN));
        echo "Ingrese cantidad maxima de pasajeros: \n";
        $cantidadMaxPasajeros = trim(fgets(STDIN));
        for($i=0;$i<$cantidadMaxPasajeros;$i++){
            if($i==0){
                echo "Ingrese el pasajero ".($i+1).": ";
                $pas = cargarPasajero();
                $pasajeros[$i] = $pas;
            }else{
                echo "Ingrese el pasajero ".($i+1).": ";
                do{
                    $pas = cargarPasajero();
                    $dniPas=$pas->getDni();
                    if(verificarDocumento($pasajeros,$dniPas)){
                        $pasajeros[$i] = $pas;
                        $bandera=false;
                    }else{
                        echo "Ingrese nuevamente el pasajero, el documento ingresado ya fue cargado \n";
                        $bandera=true;
                    }
                }while($bandera);
            }  
        }
        echo "Ingrese el Responsable del viaje";
        echo "Ingrese el numero de la empleado";
        $empleado=trim(fgets(STDIN));
        echo "Ingrese el numero de la licencia";
        $licencia=trim(fgets(STDIN));
        echo "Ingrese el numero de la persona Responsable";
        $nombreResp=trim(fgets(STDIN));
        echo "Ingrese el numero de la nombre";
        $apellidoResp=trim(fgets(STDIN));
        echo "Ingrese el costo del viaje";
        $costoViaje=trim(fgets(STDIN));
        $respon=new Responsable($empleado,$licencia,$nombreResp,$apellidoResp);
        $costoAbonado=0;
        $viaje = new Viaje($codigoVia,$lugar,$cantidadMaxPasajeros,$pasajeros,$respon,$costoViaje,$costoAbonado);
        for($i=0;$i<count($viaje->getPasajeros());$i++){
            $pasajeroVendido=$viaje->getPasajeros()[$i];
            $costoAbonado=$costoAbonado+$viaje->venderPasaje($pasajeroVendido);
        }
        $viaje->setCostoAbonado($costoAbonado);
    }
    return $viaje;
}

function modificarViaje($objeto){
    echo "Ingrese destino del viaje: "."\n";
    $lugar = trim(fgets(STDIN));
    $objeto->setDestino($lugar);
    echo "Ingrese cantidad de pasajeros: "."\n";
    $cantidadMaxPasajeros = trim(fgets(STDIN));
    $objeto->setCantMaxPasajeros($cantidadMaxPasajeros);
    for($i=0;$i<$cantidadMaxPasajeros;$i++){
        echo "Ingrese el pasajero ".($i+1).": \n";
        echo "Ingrese el nombre ";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido ";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el documento ";
        $dni = trim(fgets(STDIN));
        $objeto->getPasajeros()[$i]->setNombre($nombre);
        $objeto->getPasajeros()[$i]->setApellido($apellido);
        $objeto->getPasajeros()[$i]->setDni($dni);
    }
    echo "Ingrese el Responsable del viaje";
    echo "Ingrese el numero de la empleado";
    $empleado=trim(fgets(STDIN));
    $objeto->getReponsable()->setNumeroEmpleado($empleado);
    echo "Ingrese el numero de la licencia";
    $licencia=trim(fgets(STDIN));
    $objeto->getReponsable()->setNumeroLicencia($licencia);
    echo "Ingrese el numero de la persona Responsable";
    $nombreResp=trim(fgets(STDIN));
    $objeto->getReponsable()->setNombre($nombreResp);
    echo "Ingrese el numero de la nombre";
    $apellidoResp=trim(fgets(STDIN));
    $objeto->getReponsable()->setApellido($apellidoResp);

    echo "Ingrese el costo del viaje";
    $costoViaje=trim(fgets(STDIN));
    $objeto->setCostoViaje($costoViaje);
    $costoAbonado=0;
    for($i=0;$i<count($objeto->getPasajeros());$i++){
        $pasajeroVendido=$objeto->getPasajeros()[$i];
        $costoAbonado=$costoAbonado+$objeto->venderPasaje($pasajeroVendido);
    }
    $objeto->setCostoAbonado($costoAbonado);

    return $objeto;
}
function hayPasajeDisponible($viaje){
    $valor=false;
    if($viaje->getCantMaxPasajeros()>count($viaje->getPasajeros())){
        $valor=true;
    }
    return $valor;
}
do{
    echo "1: Cargar informacion de un nuevo viaje!\n";
    echo "2: Modificar informacion del viaje!\n";
    echo "3: Mostrar datos de todos los viajes!\n";
    echo "4: Mostrar datos de un viaje!\n";
    echo "5: salir!\n";

    $opc = trim(fgets(STDIN));
    if($opc>1 || $opc<5){
        switch($opc){
            case 1: //cargar viajes
                $i=0;
                do{
                    $arregloViajes[$i]=cargarViaje($arregloViajes);
                    echo "Desea cargar otro viaje?(si/no) ";
                    $cargar = trim(fgets(STDIN));
                    $i++;
                }while($cargar=='si');
            break;
            case 2:
                $cantViajes = count($arregloViajes);
                if($cantViajes!=0){
                    echo "Ingrese el codigo del viaje a modificar: ";
                    $codMod= trim(fgets(STDIN));
                    $noEncontroViaje=true;
                    for($j=0;$j<$cantViajes;$j++){
                        if($arregloViajes[$j]->getCodigoViaje()==$codMod){
                            $arregloViajes[$j]=modificarViaje($arregloViajes[$j]);
                            $j=$cantViajes;
                            $noEncontroViaje=false;
                        }
                    }
                    if($noEncontroViaje){
                        echo "El codigo ingreseado no a sido encontrado \n";
                    }
                }else{
                    echo "No hay viajes cargados \n";
                }
            break;
            case 3: //mostrar todos los viajes
                if(count($arregloViajes)!=0){
                    for($r=0;$r<count($arregloViajes);$r++){
                        echo "Viaje en posicion: ".$r."\n".$arregloViajes[$r];
                    }
                }else{
                    echo "No hay viajes cargados \n";
                }
            break;
            case 4://muestra un viaje
                if(count($arregloViajes)!=0){
                    echo "Ingrese el codigo del viaje que desea solicitar: ";
                    $cod=trim(fgets(STDIN));
                    for($r=0;$r<count($arregloViajes);$r++){
                        if($arregloViajes[$r]->getCodigoViaje()==$cod){
                            echo "Viaje con codigo: ".$cod."\n".$arregloViajes[$r];
                            $r=count($arregloViajes);
                        }else{
                            echo "El codigo Ingresado no exite \n"; 
                        }
                    }
                }else{
                    echo "No hay viajes cargados \n"; 
                }
            break;
            case 5: echo "SALISTE";
            break;
        }
    }else{
        echo "Ingrese un opcion valida:";
        $opc = trim(fgets(STDIN));
    }
}while($opc!=5)
?>