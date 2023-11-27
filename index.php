<html>
    <title>DATA Veri Giriş</title><head><link rel="shortcut icon" href="img/data_fav.png" type= "img/data_fav.png" /></head>
<body>
<?php
session_start();

// Giriş yapılmamışsa listeleme.php'ye yönlendirme
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: in_dex.php');
    exit;
}
?>
<?php

include 'index2.php';
if(isset($_POST['resimyukle'])){
/*include_once "lib/image_upload.php";*/

 

$yukleklasor = "img/";
$tmp_name = $_FILES['yukle_resim']['tmp_name'];
$name = $_FILES['yukle_resim']['name'];
$boyut = $_FILES['yukle_resim']['size'];
$tip = $_FILES['yukle_resim']['type'];
$uzanti = substr($name, -4,4);
$rastgelesayi1 = rand(10000, 50000);
$rastgelesayi2 = rand(10000, 50000);
$resimad = $rastgelesayi1.$rastgelesayi2.$uzanti;


if(strlen($name) == 0){
echo "bir dosya seçiniz";
exit();


}
if($boyut> (1024*1024*3)){
echo "dosya boyutu çok fazla";
exit();

}

if($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti != '.jpg')
{

echo "YALNIZCA JPEG VEYA PNG FORMATINDA OLABİLİR!";

}

move_uploaded_file($tmp_name, "$yukleklasor/$resimad");

$resimsor = $db->prepare("INSERT INTO data3434 SET resim_ad=:ad");
$resimyukle = $resimsor->execute(array('ad' => $resimad));
} 





?>
<form action="index3.php" method="POST" enctype="multipart/form-data">
<center><div class="datapng"><div class="datapng2"><img src="img/data.png" alt="Resim" width="268" height="72" style=" margin-top : 18px;">
<br> <h3 style = "font-family: 'Interstate', sans-serif;">Bir veri kayıt platformudur</center></h3></div></div>
<thead>
    <center>
<table border="1"  width="400">
    <tr><th><font style="   font-family: sans-serif;">Veri Resim: </font><input type="file" name="yukle_resim"/>
    <P></P>
    <font style="   font-family: sans-serif;"> Adı: </font><input type="text" class="veri" name="veri" placeholder="veri giriniz..."/>
    <P></P>
    <font style="   font-family: sans-serif;"> Fiyat: </font><input type="text" class="veri2" name="veri2" placeholder="fiyat giriniz..."/>
    <P></P>
    <font style="   font-family: sans-serif;"> Para Birimi: </font><input type="radio" name="option1" value="₺"><font style="   font-family: sans-serif;">₺</font><input type="radio" name="option1" value="$"><font style="   font-family: sans-serif;">$</font><input type="radio" name="option1" value="€"><font style="   font-family: sans-serif;">€</font>
    <br>  <P></P>  <font style="   font-family: sans-serif;"> KDV Oranı Belirle: </font><select id="option2" name="option2">
    <option value="KDV SEÇİNİZ" name="option2" selected>KDV</option>
    <option value="10" name="option2"> %10 </option>
    <option value="20" name="option2"> %20 </option>
</select>
    <P></P>
    <font style="   font-family: sans-serif;">Oluşturulma Tarihi:</font> <input type="date" class="tarih" name="tarih">&nbsp;&nbsp;&nbsp;
    <font style="   font-family: sans-serif;">Teslim Tarihi:</font> <input type="date" class="tarih3" name="tarih3">
    <p></p>
    <font style="   font-family: sans-serif;">Adet:</font> <input type="number" max="2000"  min="1"class="adet"  name="adet" style="width: 69px;">
    <P></P>
    <button type="submit" value="Yükle" name="resimyukle" style="   font-family: sans-serif;">KAYDET</button></th></tr>
</table>
</center>
</thead>


</form></CENTER>

<?php

$resimsor = $db->prepare("select * from data3434");
$resimsor->execute(array());
$resimfet = $resimsor->fetchAll(PDO::FETCH_ASSOC);

?>
<CENTER>
<table border="1"  width="150">
    <tr><th><a href="index.php" class="aa2" style ="font-family: sans-serif;"> VERİ KAYDI </a>&nbsp;
    <a href="index3.php" class="aa3" style ="font-family: sans-serif;"> VERİLER </a>&nbsp;
    <a href="index13.php" class="aa5" style ="font-family: sans-serif;"> TESLİM EDİLENLER </a>&nbsp;
    <a href="in_dex.php?action=cikis" class="aa" style ="font-family: sans-serif;"> ÇIKIŞ </a><br></th></tr></div>
    </div>
</table>
</thead></CENTER>
<style>
    h2 {
        font-family: sans-serif;
    }


    

        table {
    
            width: 50%;
           
        
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #f2f2f2;
            border: none;
            margin-top: 50px;
        }

        th, td {
            border: 0px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
        a {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
                    }
                    a:hover
                    {
                        background-color: #BBBBBB;
                    }
                    button {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
                    }
                    button:hover
                    {


                        background-color: #BBBBBB;
                    }
                    yukle_resim:hover{

                        

                        background-color: #BBBBBB;
                    }
                    yukle_resim {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
                    }

                    .veri{
            border-radius: 15px;
            border: none;
            height: 34px;
        }
        .veri:hover{
            background-color: #aaa;
            border-radius: 15px;
            border: none;
            height: 34px;
            color:white;
        }
        .veri2{
            border-radius: 15px;
            border: none;
            height: 34px;
            width: 85px;
        }
        .veri2:hover{
            background-color: #aaa;
            border-radius: 15px;
            border: none;
            height: 34px;
            color:white;
        }
        .tarih{
            border-radius: 15px;
            border: none;
            height: 34px;
        }
        .tarih:hover{
            background-color: #aaa;
            border-radius: 15px;
            border: none;
            height: 34px;
            color:white;
        }
        .tarih3{
            border-radius: 15px;
            border: none;
            height: 34px;
        }
        .tarih3:hover{
            background-color: #aaa;
            border-radius: 15px;
            border: none;
            height: 34px;
            color:white;
        }
        .adet{
            border-radius: 15px;
            border: none;
            height: 34px;
        }
        .adet:hover{
            background-color: #aaa;
            border-radius: 15px;
            border: none;
            height: 34px;
            color:white;
            
        }
        a:hover{
            color:white;
        }
        .aa:hover{
            background-color:red;
        }
        .aa2:hover{
            background-color: #9dc900;
        }
        .aa3:hover{
            background-color: #2d94fc;
        }
        .aa5 {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
        }
                    .aa5:hover
                    {


                        background-color: #AB1CF7;
                    }

        
        .datapng {
    
    width: 910px;
   

    border-radius: 10px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #f2f2f2;
    border: none;
}
.datapng2 {
    
    width: 380px;
    border-radius: 100px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: white;
    border: none;
}
#option2{
            border-radius: 15px;
            border: none;
            height: 34px;
            width: 70px;
            text-align: center;
        }
        #option2:hover{
            background-color: #aaa;
            border-radius: 15px;
            border: none;
            height: 34px;
            color:white;

        }
</style>
<center><h4 style="position: absolute; bottom: 0; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA <sub>v1.8</sub> - &nbsp;</h4></center>
