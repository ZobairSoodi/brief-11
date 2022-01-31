<?php 
    $tarifs = array("tr1"=>0.794, "tr2"=>0.883, "tr3"=>0.9451, "tr4"=> 1.0489, "tr5"=>1.2915, "tr6"=>1.4975);
    $tva = 0.14;
    $timbre = 0.45;
    $trn1 = 100 * $tarifs["tr1"];
    $trn3 = 210 * $tarifs["tr3"];
    $trn4 = 100 * $tarifs["tr4"];
    $trn5 = 200 * $tarifs["tr5"];

    function setTranche($nbr,$Facture,$PU){
        global $tva;
        $Montant_HT = $Facture * $PU;
        $Montant_Taxes = $Montant_HT * $tva;
        return "<tr><td>Tranche $nbr</td><td>$Facture</td><td>$PU</td><td>" . $Montant_HT ."</td><td>$tva</td><td>" . $Montant_Taxes . "</td><td style='text-align:right;'> $nbr الشطر </td></tr>";
    }

    function setCal($cal){
        global $tva;
        return 
        "<tr>
            <td colspan='3' class='th'>REDEVANCE FIXE ELECTRICITE</td>
            <td>$cal</td>
            <td>$tva</td>
            <td>". $cal * $tva . "</td>
            <td style='text-align:right;' class='th'>إثاوة ثابتة الكهرباء</td>
        </tr>
        ";
    }

    
?>