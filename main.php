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
    <table>
        <thead>
            <td>ancien index</td>
            <td>nouvel index</td>
            <td>consumation</td>

        </thead>
    </table>
    <?php
        // $above_210 = (210 * 0.9451);
        // $tva_210 = $above_210 * 0.14;
        // $above_310 = $above_210 + (100 * 1.0489);
        // $tva_310 = $above_310 * 0.14;
        // $above_510 = $above_310 + (200 * 1.2915);
        // $tva_510 = $above_510 * 0.14;
        // echo $above_510;
        // echo "<br>";

        

        $total_initial = 0;

        $price = $_POST["price"];
        if($price <= 150){
            if($price<=100){
                $total_initial = $price * $tarifs["tr1"];
            }
            else{
                $total_initial = $trn1 + (($price - 100)*0.883);
            }
        }
        else{
            if($price <= 210){
                $total_initial = $price * 0.9451;
            }
            elseif ($price <= 310) {
                $total_initial = $trn3 + (($price - 210) * 1.0489);
            }
            elseif($price <= 510){
                $total_initial = $trn3 + $trn4 + (($price - 310) * 1.2915);
            }
            else{
                $total_initial = $trn3 + $trn4 + $trn5 + (($price - 510) * 1.4975);
            }
        }
    ?>
</body>
</html>