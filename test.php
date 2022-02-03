<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link  href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styl.css">
</head>
<body>

 

<?php 



class Tranche{
    public $min;
    public $max;
    public $PU;
    function __construct($min, $max, $PU){
        $this->min = $min;
        $this->max = $max;
        $this->PU = $PU;
    }
}

$montantTVA = 0;

$trnList = [
    new Tranche(0, 100, 0.794),
    new Tranche(101, 150, 0.883),
    new Tranche(151, 210, 0.9451),
    new Tranche(211, 310, 1.0489),
    new Tranche(311, 510, 1.2915),
    new Tranche(511, NULL, 1.4975)
];

$tva = 0.14;
$TVA = "14%";
$SMALL =22.65;
$MEDIUM =37.05;
$LARGE=46.20;
$TIMBRE = 0.45;
 

$index1 = $_POST["cons1"];
$index2 = $_POST["cons2"];
$cons = $index2 - $index1;

function show( $nbr,$facture,$PU){
    $montantHT = $facture * $PU;
    global $TVA;
    global $tva;
    $montantTaxes = $montantHT * $tva;
    echo "<tr>
    <td style='font-style: italic; color :gray;'>Tranche $nbr</td>
    <td>$facture</td>
    <td>$PU</td>
    <td>$montantHT</td>
    <td>$TVA</td>
    <td>$montantTaxes</td>
    <td colspan='4' class='th' style='font-style: italic; color :gray;text-align:right;' >$nbr الشطر</td>
</tr>";
}
$calc = array("smallCalibr"=>22.65,"mediumCalibr"=>37.05,"largeCalibr"=>46.20);

?>

<table  style=" margin-top:50px;" border="-1" id="table">
    <thead class="table">
        <tr >
            <td  colspan='4' > <span> Andex :</span><?php echo $index1?></td>
            <td > <span> Andex :</span> <?php echo $index2  ?></td>
            <td style='text-align:right;'> <span>Consommation : </span><?php echo $cons ?> Kwh</td>
        </tr>
        <td></td>
        <td> مفوتر<br> Facture</td>
        <td>س.و <br>PU</td>
        <td>المبلغ د.إ.ر <br> Montant HT </td>
        <td>ض.ق.م<br> TAUX TVA</td>
        <td>مبلغ الرسوم<br>Montant Taxes  </td>
        <td></td>
    </thead>
    <tbody>
        
        <?php
        
        echo "<tr><th  colspan='3' class='th'>E CONSOMMATIO</th><th  colspan='4' class='th' style='text-align:right;'>إستھلاك الكھرباء </th></tr>";
            if($cons <= 150){
                if($cons <= 100){
                    show(1,$cons, $trnList[0]->PU);
                    $montantHT =$cons*$trnList[0]->PU;
                }
                else{
                    show(1, 100, $trnList[0]->PU);
                    show(2,$cons-100, $trnList[1]->PU);
                    $montantHT = (100 * $trnList[0]->PU) + (($cons - 100) * $trnList[1]->PU);
                }
            }
            else{
                if($cons <= 210){
                    show(3,$cons, $trnList[2]->PU);
                    $montantHT =$cons*$trnList[2]->PU;
                }
                elseif($cons <= 310){
                    show(4,$cons, $trnList[3]->PU);
                    $montantHT =$cons*$trnList[3]->PU;
                }
                elseif($cons <= 510){
                    show(5,$cons, $trnList[4]->PU);
                    $montantHT =$cons*$trnList[4]->PU;
                }
                elseif($cons <= 310){
                    show(6,$cons, $trnList[5]->PU);
                    $montantHT =$cons*$trnList[5]->PU;
                }
            }
            $cal = $_POST["cal"];
            if($cal =="small"){
               $calibre = $calc ["smallCalibr"];
                 $montantHT += $SMALL;
            }
                elseif ($cal =="medium"){
                    $calibre = $calc ["mediumCalibr"];
                      $montantHT += $MEDIUM ;
                  
                }
                else{
                    $calibre = $calc ["largeCalibr"];
                    $montantHT += $LARGE;  
                }
                $tv= $MEDIUM *$tva; 
                echo "<tr colspan='3' class='th'> <th>REDEVANCE FIXE ELECTRICITE</th>  
                 <td></td> <td></td><td>   $calibre </td ><td>$TVA</td><td> $tv</td> <th colspan='4' class='th' style='text-align:right;'>إثاوة الكھرباء ثابتة</th></tr>";
                echo "<tr>
                        <th colspan='3' class='th'>TAXES POUR LE COMPTE DE L’ETAT</th>
                        <th colspan='4' class='th' style='text-align:right;' >الرسوم المؤداة لفائدة الدولة</th>
                    </tr>";
        ?>
        <tr>
            
            <td style=" font-style: italic; color :gray;">TVA TOTAL </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
            <td><?php echo $montantHT * 0.14;?></td>
            <td colspan='4' class='th' style="font-style: italic; color :gray;text-align:right;"> مجموع ض.ق.م </td>
        </tr>
        <tr>
            
            <td style="font-style: italic; color :gray;"> TIMBRE </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
            <td>0,45</td>
            <td  style="font-style: italic; color :gray;text-align:right;" colspan='4' class='th' > الطابع</td>
            <td>-</td>
        </tr>
    
        <tr>
            <th>SOUS-TOTAL </th>
            <td></td>
            <td></td>
            <td><?php echo $montantHT?></td>
            <td></td>
            
            <td><?php  echo $montantHT * 0.14 * $TIMBRE;  ?></td>
            <th colspan='4' class='th' style='text-align:right;'> الجزئي المجموع</th>
        </tr>
        <tr>
            <th>TOTAL ÉLECTRICITÉ </th>
            <td></td>
            <td></td>
            <td></td>
            <td><?php  echo $montantHT * 0.14 * $TIMBRE +  $montantHT ;  ?></td>
            <td></td>
            <th colspan='4' class='th' style='text-align:right;' >مجموع الكھرباء </th>
        </tr>
    



    </tbody>
</table>
<button  style= "margin-left:50%" type="print" id="print">print</button>
<script >
    
    document.getElementById("print"). addEventListener("click", function printData() {
    var div = document.getElementById("table");
    newwin = window.open("");
    newwin.document.write(div.outerHTML);
    newwin.print();
    newwin.close();
  });
  printData();
</script>
</body>
</html>