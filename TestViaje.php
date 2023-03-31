<?php
include 'Viaje.php';
include 'Pasajero.php';
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
function cargarViaje($arreglo){
    echo "Ingrese codigo de viaje: "."\n";
    $codigoVia = trim(fgets(STDIN));
    if(encontrarCodigoIgual($arreglo,$codigoVia)){
        echo"EL CODIGO DE VIAJE YA EXISTE \n";
        $viaje=null;
    }else{
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
    }
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