<?php
$usuario=''; 
$sw='';

if ($_SERVER["REQUEST_METHOD"] == "POST") //Esto significa que se espera que el formulario se envíe mediante el método POST.
{
    if(!isset($_POST['Rut']))       {$usuario='';       }else{$usuario=$_POST['Rut'];}
    if(!isset($_POST['sw']))         {$sw='';         }else{$sw=$_POST['sw'];}
}
?>


<form method="post" action="index.php">  
    <input type="text"    name="Rut"   value="<?php echo $usuario;?>">          
    <input type="hidden"    name="sw" value="validar">
    <input type="submit" value="verificar">
</form>
<br>
<br>

<?php

if($sw=='validar'){

$ruta=validarut($usuario);
echo $ruta;
echo '<hr>';

$detalle1 =agregaCero($usuario);
echo$detalle1;
echo '<hr>'; 
        

}

?>
 


<?php



function validarut($rut){

    $respuesta = "MAL";
    
    $RutAValidar = strlen($rut); 
    $constantes=array(3, 2, 7, 6, 5, 4, 3, 2 );
    $suma=0;

    
    if ($RutAValidar < 10)
    {
        $rut=str_pad($rut,10,"0",STR_PAD_LEFT); /*str_pad toma esta cadena, especifica la longitud final deseada (10 en este caso), 
        el carácter que quieres añadir (en este caso "0"), y especifica que deseas añadir esos caracteres al principio con STR_PAD_LEFT.*/
    }
    if ($rut[0] == "K" || $rut[0] == "k" ||
    $rut[1] == "K" || $rut[1] == "k" ||
    $rut[2] == "K" || $rut[2] == "k" ||
    $rut[3] == "K" || $rut[3] == "k" ||
    $rut[4] == "K" || $rut[4] == "k" ||
    $rut[5] == "K" || $rut[5] == "k" ||
    $rut[6] == "K" || $rut[6] == "k" ||
    $rut[7] == "K" || $rut[7] == "k" )
    {
        $respuesta= "MAL";
    }
    else if ($rut[8] != '-')
    {
        $respuesta="MAL";
    }
    //Control de error de la posicion de la letra - en el rut, en cas de que se repirta en otra posicion que no se la correcta
    else if ($rut[0] == '-' ||
            $rut[1] == '-' ||
            $rut[2] == '-' ||
            $rut[3] == '-' ||
            $rut[4] == '-' ||
            $rut[5] == '-' ||
            $rut[6] == '-' ||
            $rut[7] == '-' ||
            $rut[9] == '-')
    {
        $respuesta="MAL";
    }else{
   
        for ($i = 0; $i < 8; $i++)
            {
                $rutSuma[$i] = $constantes[$i] * $rut[$i];
                $suma += $rutSuma[$i];
            }


    $d1 = $suma / 11.0;
    $d2 = floor($d1);//Aproxima al entero mas bajo
    $d3 = $d1 - $d2;
    $d4 = 11 - (11 * $d3);
    $d5 = round($d4); //d5 contiene el valor de digito verificador segun el calculo


    if ($rut[9] == 'k' || $rut[9] == 'K')
    {
    $n9 = 10;
    }
    else if ($rut[9] == '0')
    {
        $n9 = 11;
    }
    else
    {
        $n9 = $rut[9];
    }

    // FIN DEL PASO 4 //

    // INICIO PASO 5 //

    if ($d5 == 10)
    {
        $d5="K";

    }

    if ($d5 == $n9)
    {
            $respuesta="BIEN";
    }
    }
return($respuesta);
};


function agregaCero($rut) {
    
    ECHO 'RUT INGRESADO POR FORM: 9937528-0'.'<BR>';
    $constantes=array(3, 2, 7, 6, 5, 4, 3, 2 );
    $suma=0;
    $RutAValidar = strlen($rut);

    if ($RutAValidar < 10) {
        // Si la longitud de $ruting es menor que 10, rellenar con ceros al principio yel valor de rut es actualizado
        $rut = str_pad($rut, 10, "0", STR_PAD_LEFT);
    }
    // Obtener la longitud después de agregar ceros
    $longitudDespues = strlen($rut);

    if ($rut[0] == "K" || $rut[0] == "k" ||
    $rut[1] == "K" || $rut[1] == "k" ||
    $rut[2] == "K" || $rut[2] == "k" ||
    $rut[3] == "K" || $rut[3] == "k" ||
    $rut[4] == "K" || $rut[4] == "k" ||
    $rut[5] == "K" || $rut[5] == "k" ||
    $rut[6] == "K" || $rut[6] == "k" ||
    $rut[7] == "K" || $rut[7] == "k" )
    {
        $respuesta= "MAL";
    }
    else if ($rut[8] != '-')
    {
        $respuesta="MAL";
    }
    //Control de error de la posicion de la letra - en el rut, en cas de que se repirta en otra posicion que no se la correcta
    else if ($rut[0] == '-' ||
            $rut[1] == '-' ||
            $rut[2] == '-' ||
            $rut[3] == '-' ||
            $rut[4] == '-' ||
            $rut[5] == '-' ||
            $rut[6] == '-' ||
            $rut[7] == '-' ||
            $rut[9] == '-')
    {
        $respuesta="MAL";
    }else{

   //PASO 2, EL RUT YA OK, SE MULRPLICADO Y SUMADO PARA EL POSTERIOR CALCULO CON 11// 
   
   
    for ($i = 0; $i < 8; $i++)
    {
        $rutSuma[$i] = $constantes[$i] * $rut[$i];
        $suma += $rutSuma[$i];
    }

    // FIN PASO 2 OK //

    // INICIO  PASO 3: //
    //Hacemos el calculo matematico para determinar el valor resultante ($d5) de la multiplicacion y suma de los gititos del rut//
    //que despues usaremos para comparar con $rut[9] que es el digito verificador del rut ingresado al inicio  //

    $d1 = $suma / 11.0;
    $d2 = floor($d1);//Floor da el numero entero hacia abajo.
    $d3 = $d1 - $d2;// resto en numero entero y con el numero con decimales para obtener solo los decimales y quedan en $d3
    $d4 = 11 - (11 * $d3);//multiplico los decimales x 11, y luego a ese resultado le resto 11. 
    $d5 = round($d4); //d5 contiene el valor de digito verificador segun el calculo que se aproxima.

    // FIN PASO 3 //


    //INICIO PASO 4: //
    // a rut[9] digito verificador le asignamos un valor numerico para que despues pueda ser comparado con d5. 
    //si el Verificador original es K 4N9 valdra 10 o si el verificador original es "0", $n9 valdra 11.
    
    
    if ($rut[9] == 'k' || $rut[9] == 'K')
    {
    $n9 = 10;
    }
    else if ($rut[9] == '0')
    {
        $n9 = 11;
    }
    else
    {
        $n9 = $rut[9];
    }

    // FIN DEL PASO 4 //

    // INICIO PASO 5 //

    if ($d5 == 10)
    {
        $d5="K";

    }

    elseif ($d5 == $n9)
    {
            $respuesta="BIEN";
    }

    //FIN DEL PASO 5 //


    // Preparar una cadena de respuesta con información sobre la longitud y el nuevo valor
    $respuesta = 'Original RUT: ' . $rut . '<br>' .
     'Largo del RUT después de agregar ceros: ' . $longitudDespues . '<br>' .
     'Nuevo valor del RUT: ' . $rut.'<br>'.
    'la suma del calculo luego de multiplicar con las contantes es: '.$suma.'<br>'.
    'El digito verificador del rut ingresado $rut[9] es : '. $rut[9].'<br>'.
    'el resultado del calculo "d5" para luego comparar con el digito verificador original : '.$d5.'<br>'.
    'El Valor asignado a n9 es: '.$n9;
    }

    return $respuesta;



}


?>


