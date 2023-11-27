<?php
$veri = $_POST['veri'];
$op = $_POST['option1'];
$veri2 = $_POST['veri2'];
$tarih = $_POST['tarih'];
$tarih3 = $_POST['tarih3'];
$adet = $_POST['adet'];
$yukleklasor = "img/";
$tmp_name = $_FILES['yukle_resim']['tmp_name'];
$name = $_FILES['yukle_resim']['name'];
$boyut = $_FILES['yukle_resim']['size'];
$tip = $_FILES['yukle_resim']['type'];
$uzanti = substr($name, -4, 4);
$rastgelesayi1 = rand(10000, 50000);
$rastgelesayi2 = rand(10000, 50000);
$resimad = $rastgelesayi1.$rastgelesayi2.$uzanti;
if(strlen($name) == 0){
    echo "Bir dosya seçiniz";
    exit();
}

if($boyut > (1024*1024*3)){
    echo "Dosya boyutu çok fazla";
    exit();
}

if($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti != '.jpg'){
    echo "YALNIZCA JPEG VEYA PNG FORMATINDA OLABİLİR!";
    exit();
}

move_uploaded_file($tmp_name, "$yukleklasor/$resimad");
?>