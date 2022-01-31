<?php include 'config.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="main.php" method="post">
        <input type="text" name="cons1" style="border: solid 2px rebeccapurple;">
        <input type="text" name="cons2" style="border: solid 2px rebeccapurple;">
        <input type="radio" name="cal" id="cal1" value="small"><label for="cal1">small</label>
        <input type="radio" name="cal" id="cal2" value="medium"><label for="cal2">medium</label>
        <input type="radio" name="cal" id="cal3" value="large"><label for="cal3">large</label>
        <input type="submit">
    </form>
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
        $total_tva = 0;
        
        
        $cons1 = $_POST["cons1"];
        $cons2 = $_POST["cons2"];
        $price = $cons2 - $cons1;

        if($price < 0){
            header("Location: index.html");
            ob_end_flush();
            die();
        }
        $cal = $_POST["cal"];
        if($price <= 150){
            if($price<=100){
                global $total_initial;
                $total_initial = $price * $tarifs["tr1"];
                array_push($myArray, setTranche(1, $price, $tarifs["tr1"]));
            }
            else{
                global $total_initial;
                $total_initial = $trn1 + (($price - 100)*$tarifs["tr2"]);
                array_push($myArray, setTranche(1, 100, $tarifs["tr1"]),
                    setTranche(2, ($price-100), $tarifs["tr2"]));
                
            }
        }
        else{
            if($price <= 210){
                global $total_initial;
                $total_initial = $price * $tarifs["tr3"];
                array_push($myArray, setTranche(3, $price, $tarifs["tr3"]));
            }
            elseif ($price <= 310) {
                global $total_initial;
                $total_initial = $trn3 + (($price - 100)*$tarifs["tr4"]);
                array_push($myArray, setTranche(3, 210, $tarifs["tr3"]),
                    setTranche(4, ($price-210), $tarifs["tr4"])
                );
            }
            elseif($price <= 510){
                global $total_initial;
                $total_initial;
                $total_initial = $trn3 + $trn4 + (($price - 310) * $tarifs["tr5"]);
                array_push($myArray, setTranche(3, 210, $tarifs["tr3"]),
                    setTranche(4, 100, $tarifs["tr4"]),
                    setTranche(5, ($price-310), $tarifs["tr5"])
                );
            }
            else{
                global $total_initial;
                $total_initial = $trn3 + $trn4 + $trn5 + (($price - 510) * $tarifs["tr6"]);

                array_push($myArray, setTranche(3, 210, $tarifs["tr3"]),
                    setTranche(4, 100, $tarifs["tr4"]),
                    setTranche(5, 200, $tarifs["tr5"]),
                    setTranche(6, ($price-510), $tarifs["tr6"])
                );
            }
        }
        $total_tva = $total_initial * $tva;
        
    ?>
    <div id='cons'>
        <div>Ancien index : <?php echo $cons1?> kWh</div>
        <div>Nouvel index : <?php echo $cons2?> kWh</div>
        <div>Consommation : <?php echo $price?> kWh</div>
    </div>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="th">
                <td width="20%"></td>
                <td>Facturé</td>
                <td>P.U</td>
                <td>Montant HT</td>
                <td>Taux TVA</td>
                <td>Montant Taxes</td>
                <td></td>
            </tr>
            
        </thead>
        <tbody>
            <tr>
                <td class="th" colspan="3" style="">CONSOMMATION ELECTRICITE</td>
                <td class='th' colspan="4" style="text-align:right;">إستھلاك الكھرباء </td>
            </tr>
            <?php 
                foreach ($myArray as $i) {
                    echo $i;
                }
                if($cal == "small"){
                    global $total_initial;
                    $total_initial += 22.65;
                    $total_tva += 22.65 * 0.14;
                    echo setCal(22.65);
                }   
                elseif($cal == "medium"){
                    global $total_initial;
                    $total_initial += 37.05;
                    $total_tva += 37.05 * 0.14;
                    echo setCal(37.05);
                }
                elseif($cal == "large"){
                    global $total_initial;
                    $total_initial += 46.20;
                    $total_tva += 46.20 * 0.14;
                    echo setCal(46.20);
                }
                echo "<tr>
                        <td colspan='3' class='th'>TAXES POUR LE COMPTE DE L’ETAT</td>
                        <td colspan='4' class='th' style='text-align:right;' >الرسوم المؤداة لفائدة الدولة</td>
                    </tr>";
                echo "<tr>
                        <td colspan='5'>TOTAL TVA</td>
                        <td>$total_tva</td>
                        <td style='text-align:right' colspan='5'>مجموع ض.ق.م</td>
                    </tr>";
                echo "<tr>
                        <td colspan='5'>Timbre</td>
                        <td>$timbre</td>
                        <td style='text-align:right' colspan='5'>الطابع</td>
                    </tr>";
                echo "<tr>
                        <td colspan='3' class='th'>SOUS-TOTAL</td>
                        <td class='th'>$total_initial</td><td></td>
                        <td class='th'>" . ($total_tva + $timbre) . "</td>
                        <td style='text-align:right;' class='th'>المجموع الجزئي</td>
                    </tr>";
                echo "<tr>
                        <td colspan='3' class='th'>TOTAL ÉLECTRICITÉ</td>
                        <td  style='text-align:center;' class='th'>" . ($total_initial + $total_tva + $timbre) . "</td>
                        <td style='text-align:right;' colspan='3' class='th'>مجموع الكهرباء</td>
                    </tr>"
            ?>
        </tbody>
    </table>
    
</body>
</html> 