<?php
$nilai1=41;

// if($nilai1 <> 0){
//     echo "variabel ini isinya lebih atau kurang dari nol";
// }else{
//     echo "variabel ini isinya Nol";
// }

if($nilai1 >= 0 && $nilai1 <= 40){
    echo "Nilai berada diantara 0 sampai 40";
}else{
    echo "Nilai tidak berada diantara 0 sampai 40";
}
/**
if($nilai1 == 10){
    echo "Nilai 10";
}elseif($nilai1 == 20){
    echo "Nilai 20";
}elseif($nilai1 == 30){
    echo "Nilai 30";
}elseif($nilai1 == 40){
    echo "Nilai 40";
}else{
    echo "Nilainya bukan 10, 20, 30, atau 40";
}
**/

/**
switch($nilai1){
    case 10:
        echo "Nilai 10";
        break;
    case 20:
        echo "Nilai 20";
        break;
    case 30:
        echo "Nilai 30";
        break;
    case 40:
        echo "Nilai 40";
        break;
    default:
        echo "Nilainya bukan 10, 20, 30, atau 40";
}
*/