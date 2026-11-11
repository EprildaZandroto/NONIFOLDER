<?php
$status_member="Silver";
$metode_bayar="Kartu Kredit";
$diskon=0;

echo "Status Member : ".$status_member."<br>";
echo "Metode Pembayaran : ".$metode_bayar."<br><hr>";

if($status_member=="Gold"){
    if($metode_bayar=="Kartu Kredit"){
        $diskon=20;
    }elseif($metode_bayar=="E-Wallet"){
        $diskon=15;
    }else{
        $diskon=10; 
    }
}elseif($status_member=="Silver"){
    if($metode_bayar=="Kartu Kredit"){
        $diskon=15;
    }else{
        $diskon=5; 
    }
}else{
    $diskon=0;
}

echo "Diskon : ".$diskon."<br>";