<?php include 'config.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        // $above_210 = (210 * 0.9451);
        // $tva_210 = $above_210 * 0.14;
        // $above_310 = $above_210 + (100 * 1.0489);
        // $tva_310 = $above_310 * 0.14;
        // $above_510 = $above_310 + (200 * 1.2915);
        // $tva_510 = $above_510 * 0.14;
        // echo $above_510;
        // echo "<br>";

        
        $myArray = array();
        $total_initial = 0;
        
        $price = $_POST["price"];
        if($price <= 150){
            if($price<=100){
                $total_initial = $price * $tarifs["tr1"];
                array_push($myArray, setTranche($price, $tarifs["tr1"]));
            }
            else{
                $total_initial = $trn1 + (($price - 100)*0.883);
                array_push($myArray, setTranche(100, $tarifs["tr1"]),
                    setTranche(($price-100), $tarifs["tr2"]));
                
            }
        }
        else{
            if($price <= 210){
                array_push($myArray, setTranche($price, $tarifs["tr3"]));
            }
            elseif ($price <= 310) {
                array_push($myArray, setTranche(210, $tarifs["tr3"]),
                    setTranche(($price-210), $tarifs["tr4"])
                );
            }
            elseif($price <= 510){
                $total_initial = $trn3 + $trn4 + (($price - 310) * 1.2915);
                array_push($myArray, setTranche(210, $tarifs["tr3"]),
                    setTranche(100, $tarifs["tr4"]),
                    setTranche(($price-310), $tarifs["tr5"])
                );
            }
            else{
                $total_initial = $trn3 + $trn4 + $trn5 + (($price - 510) * 1.4975);
                array_push($myArray, setTranche(210, $tarifs["tr3"]),
                    setTranche(100, $tarifs["tr4"]),
                    setTranche(200, $tarifs["tr5"]),
                    setTranche(($price-510), $tarifs["tr6"])
                );
            }
        }
        
    ?>
    <table border="1">
        <thead>
            <td>Facturé</td>
            <td>P.U</td>
            <td>Montant HT</td>
            <td>Taux TVA</td>
            <td>Montant Taxes</td>
        </thead>
        <tbody>
            <?php 
                foreach ($myArray as $i) {
                    echo $i;
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>