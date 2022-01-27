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
        // $above_310 = (210 * 0.9451) + (100 * 1.0489);
        // $above_510 = (210 * 0.9451) + (100 * 1.0489) + (200 * 1.2915);
        // echo $above_510;
        // echo "<br>";

        $price = $_POST["price"];
        if($price <= 150){
            if($price<=100){
                echo $price * 0.794;
            }
            else{
                echo (100*0.794) + (($price - 100)*0.883);
            }
        }
        else{
            if($price <= 210){
                echo $price * 0.9451;
            }
            elseif ($price <= 310) {
                echo 198.471 + (($price - 210) * 1.0489);
            }
            elseif($price <= 510){
                echo 303.361 + (($price - 310) * 1.2915);
            }
            else{
                echo 561.661 + (($price - 510) * 1.4975);
            }
        }
        
    ?>
</body>
</html>