<?php
include 'Viaje.php';
include 'Pasajero.php';
$arregloViajes=[];

function cargarViaje(){
    echo "Ingrese codigo de viaje: "."\n";
    $codigoVia = trim(fgets(STDIN));
    echo "Ingrese destino del viaje: "."\n";
    $lugar = trim(fgets(STDIN));
    echo "Ingrese cantidad maxima de pasajeros: \n";
    $cantidadMaxPasajeros = trim(fgets(STDIN));
    
    for($i=0;$i<$cantidadMaxPasajeros;$i++){
        echo "Ingrese el pasajero ".($i+1).": ";
        echo "ingrese el nombre del pasajero";
        $nombre = trim(fgets(STDIN));
        echo "ingrese el apellido del pasajero";
        $apellido = trim(fgets(STDIN));
        echo "ingrese el documento del pasajero";
        $dni = trim(fgets(STDIN));
        $pas = new Pasajeros($nombre,$apellido,$dni);
        $pasajeros[$i] = $pas;
    }
    $viaje = new Viaje($codigoVia,$lugar,$cantidadMaxPasajeros,$pasajeros);
    return $viaje;
}

function modificarViaje($objeto){
    echo "Ingrese destino del viaje: "."\n";
    $lugar = trim(fgets(STDIN));
    echo "Ingrese cantidad de pasajeros: "."\n";
    $cantidadMaxPasajeros = trim(fgets(STDIN));
    
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
    $objeto->setDestino($lugar);
    $objeto->setCantMaxPasajeros($cantidadMaxPasajeros);
    
    return $objeto;
}
do{
    echo "1: Cargar informacion de un nuevo viaje!\n";
    echo "2: Modificar informacion del viaje!\n";
    echo "3: Mostrar datos del viaje!\n";
    echo "4: salir!\n";
    $opc = trim(fgets(STDIN));
    if($opc>1 || $opc<4){
        switch($opc){
            case 1: 
                $i=0;
                do{
                    $arregloViajes[$i]=cargarViaje();
                    echo "Desea cargar otro viaje?(si/no) ";
                    $cargar = trim(fgets(STDIN));
                    $i++;
                }while($cargar=='si');
            break;
            case 2:
                echo "Ingrese el codigo del viaje a modificar: ";
                $codMod= trim(fgets(STDIN));
                $cantViajes = count($arregloViajes);
                for($j=0;$j<$cantViajes;$j++){
                    if($arregloViajes[$j]->getCodigoViaje()==$codMod){
                        $arregloViajes[$j]=modificarViaje($arregloViajes[$j]);
                        $j=$cantViajes;
                    }
                } 
            break;
            case 3: 
                for($r=0;$r<count($arregloViajes);$r++){
                    echo "Viaje en posicion: ".$r."\n".
                    "  Codigo Viaje: ".$arregloViajes[$r]->getCodigoViaje()."\n".
                    "  Destino Viaje: ".$arregloViajes[$r]->getDestino()."\n".
                    "  Cantidad de pasajeros: ".$arregloViajes[$r]->getCantMaxPasajeros()."\n".
                    "  Pasajeros: \n";
                    for($h=0;$h<$arregloViajes[$r]->getCantMaxPasajeros();$h++){
                       echo  "Pasajero ".($h+1). "\n".
                       "    Nombre: ".$arregloViajes[$r]->getPasajeros()[$h]->getNombre()."\n".
                       "    Apellido: ".$arregloViajes[$r]->getPasajeros()[$h]->getApellido()."\n".
                       "    Dni: ".$arregloViajes[$r]->getPasajeros()[$h]->getDni()."\n";
                    }
                }
            break;
            case 4: echo "SALISTE";
            break;
        }
    }else{
        echo "Ingrese un opcion valida:";
        $opc = trim(fgets(STDIN));
    }
}while($opc!=4)
?>