<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

$trnList = [
    new Tranche(0, 100, 0.794),
    new Tranche(101, 150, 0.883),
    new Tranche(151, 210, 0.9451),
    new Tranche(211, 310, 1.0489),
    new Tranche(311, 510, 1.2915),
    new Tranche(511, NULL, 1.4975)
];

$tva = 0.14;
$total = 0;

$index1 = $_POST["cons1"];
$index2 = $_POST["cons2"];
$cons = $index2 - $index1;

function show($nbr,$facture,$PU){
    $montantHT = $facture * $PU;
    global $tva;
    $montantTaxes = $montantHT * $tva;
    echo "<tr>
                <td>Tranche $nbr</td>
                <td>$facture</td>
                <td>$PU</td>
                <td>$montantHT</td>
                <td>$tva</td>
                <td>$montantTaxes</td>
                <td>$nbr الشطر</td>
            </tr>";
}

?>

<table class="table">
    <thead>
        <td></td>
        <td>Facture</td>
        <td>PU</td>
        <td>Montant HT</td>
        <td>TAUX TVA</td>
        <td>Montant Taxes</td>
        <td></td>
    </thead>
    <tbody>
        <?php
            if($cons <= 150){
                if($cons <= 100){
                    show(1, $cons, $trnList[0]->PU);
                    
                }
                else{
                    show(1, 100, $trnList[0]->PU);
                    show(2, ($cons - 100), $trnList[1]->PU);
                }
            }
            else{
                if($cons <= 210){
                    show(3, $cons, $trnList[2]->PU);
                }
                elseif($cons <= 310){
                    show(4, $cons, $trnList[3]->PU);
                }
                elseif($cons <= 510){
                    show(5, $cons, $trnList[4]->PU);
                }
                elseif($cons > 510){
                    show(6, $cons, $trnList[5]->PU);
                }
            }
        ?>
    </tbody>
</table>
</body>
</html>