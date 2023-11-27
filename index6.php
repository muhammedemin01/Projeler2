<head><link rel="shortcut icon" href="img/data_fav.png" type= "img/data_fav.png" /></head>
<title>DATA Güncelle</title>
<?php
session_start();

// Giriş yapılmamışsa listeleme.php'ye yönlendirme
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: in_dex.php');
    exit;
}
?>
<?php

include 'index4.php';

if(isset($_POST['guncelle'])){
    $id = $_POST['id'];
    $metin = $_POST['yukle_metin'];
    $tarih = $_POST['tarih'];
    $tarih3 = $_POST['tarih3'];
    $adet = $_POST['adet'];
    $op = $_POST['option1'];
    $op2 = $_POST['option2'];
    $veri2 = $_POST['veri2'];
    $resimad = $_FILES['yukle_resim']['name'];

    if(strlen($resimad) == 0 && strlen($metin) == 0){
        echo "Bir dosya veya metin giriniz";
        exit();
    }

    $yukleklasor = "img/";
    $tmp_name = $_FILES['yukle_resim']['tmp_name'];
    $boyut = $_FILES['yukle_resim']['size'];
    $tip = $_FILES['yukle_resim']['type'];
    $uzanti = substr($resimad, -4, 4);
    $rastgelesayi1 = rand(10000, 50000);
    $rastgelesayi2 = rand(10000, 50000);
    $yeni_resimad = $rastgelesayi1.$rastgelesayi2.$uzanti;

    if($boyut > (1024*1024*3)){
        echo "Dosya boyutu çok fazla";
        exit();
    }

    if($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti != '.jpg'){
        echo "FOTOĞRAF GİRİNİZ!","<br>"; 
        ?><br><?php
        echo "YALNIZCA JPEG VEYA PNG FORMATINDA OLABİLİR!";
        exit();
    }

    move_uploaded_file($tmp_name, "$yukleklasor/$yeni_resimad");

    $resimguncelle = $db->prepare("UPDATE data3434 SET resim_ad=:ad, resim_as=:metin, date_as=:tarih, date_sn=:tarih3 ,adet=:adet , fıyat=:veri2 ,bırım=:option1, kdvfıyat=:option2 WHERE id=:id");
    $resimguncelle->execute(array('ad' => $yeni_resimad, 'metin' => $metin, 'id' => $id , 'tarih' => $tarih,'tarih3' => $tarih3, 'adet' => $adet, 'option1' => $op, 'veri2' => $veri2, 'option2' => $op2,));

    // Güncelleme işlemi tamamlandıktan sonra başka bir sayfaya yönlendirme yapabilirsiniz
    header("Location: index3.php");
    exit();
}
$id = $_GET['id'];
$resimsor = $db->prepare("SELECT * FROM data3434 WHERE id=:id");
$resimsor->execute(array('id' => $id));
$resimcek = $resimsor->fetch(PDO::FETCH_ASSOC);
?>
<thead>
<table border="1" width="1080">
    <tr><th colspan="9"><font
      style=" font-family: sans-serif;">
</style>- GÜNCELLE -</th></tr></font>
    <tr>
        <th>Resim</th>
        <th>ID</th>
        <th>Resim Adı</th>
        <th>Ürün Adı</th>
        <th>Adet</th>
        <th>Oluşturulma Tarihi</th>
        <th>Teslim Tarihi</th>
        <th>Para Birimi</th>
        <th>Fiyat</th>
    </tr>
    <tr>
        <td>
        <center> <img src="img/<?php echo $resimcek['resim_ad']; ?>" style="width: 200px; height: 200px; border: 3px solid #ddd;"></center>
        </td>
        <td><?php echo $resimcek['id']; ?></td>
        <td><?php echo $resimcek['resim_ad']; ?></td>
        <td><?php echo $resimcek['resim_as']; ?></td>
        <td><?php echo $resimcek['adet']; ?></td>
        <td><?php echo $resimcek['date_as']; ?></td>
        <td><?php echo $resimcek['date_sn']; ?></td>
        <td><?php echo $resimcek['bırım']; ?></td>
        <td><?php echo $resimcek['fıyat']; ?><br><?php
                   $kdvOrani = $resimcek['kdvfıyat']; // KDV oranı
                   if($resimcek['kdvfıyat'] > 4){
                   $bol = $resimcek['fıyat'] / 100;
                    $kdvTutari = $bol * $kdvOrani;
                    $kdvtoplamı = $kdvTutari + $resimcek['fıyat'];
                    echo " <span style='background-color: #33FF33; color: black;' ><b>KDV Dahil Fiyatı : "; echo $kdvtoplamı ;
                    

                                ?></span><br><span style='background-color: #3366FF; color: black;' ><?php
                                
                                echo "KDV Oranı : "; echo $resimcek['kdvfıyat']; echo "% </span></b>";
                            }
                            else {
                                echo "<span style='background-color: red; color: black;' ><b>KDV BELİRLEMEDİNİZ</b></span>";
                            }?></td>
    </tr>
    <tr>
        <td colspan="9">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $resimcek['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                <font style="   font-family: sans-serif;"> KDV Oranı Belirle: </font><select id="option2" name="option2">
    <option value="KDV SEÇİNİZ" name="option2" selected>KDV</option>
    <option value="10" name="option2"  <?php if ($resimcek['kdvfıyat'] == "10") echo "selected"; ?>> %10 </option>
    <option value="20" name="option2"  <?php if ($resimcek['kdvfıyat'] == "20") echo "selected"; ?>> %20 </option>
</select>
                Metin Giriniz: <input type="text" name="yukle_metin" value='<?php echo $resimcek['resim_as']; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              
              <input type="file" name="yukle_resim">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Oluşturulma Tarih Güncelleyiniz : <input type="date" name="tarih" value='<?php echo $resimcek['date_as']; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Teslim Tarih Güncelleyiniz : <input type="date" name="tarih3" value='<?php echo $resimcek['date_sn']; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <br>
              <br>
              Adet Güncelleyiniz: <input  style="width: 69px;" type="number" name="adet" value="<?php echo $resimcek['adet']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font style="   font-family: sans-serif;"> Fiyat: </font><input type="text" class="veri2" name="veri2" value="<?php echo $resimcek['fıyat']; ?>" placeholder="fiyat giriniz..."/>
   
<font style="font-family: sans-serif;">Para Birimi:</font>
<input type="radio" name="option1" value="₺" <?php if ($resimcek['bırım'] == "₺") echo "checked"; ?>>
<label>₺</label>
<input type="radio" name="option1" value="$" <?php if ($resimcek['bırım']  == "$") echo "checked"; ?>>
<label>$</label>
<input type="radio" name="option1" value="€" <?php if ($resimcek['bırım']  == "€") echo "checked"; ?>>
<label>€</label>

    <P></P>
                <center><button type="submit" name="guncelle">GÜNCELLE</button></center>
            </form>
        </td>
    </tr>
</table>
<br>
<table border="1" width="150">
    <tr><th><a href="index.php">- VERİ KAYDI -</a></th></tr>
    <tr><th><a href="index3.php">- VERİLER -</a><br></th></tr>
   
</table>
</thead>
<style>
    h1 {
        font-family: sans-serif;
    }
    

        table {
            border-collapse: collapse;
            width: 100%;
            border: 3px solid #ddd;
            border-radius: 10px;
            font-family: sans-serif;
        }
        th, td {
            padding: 10px;
            text-align: center;
            font-family: sans-serif;
        }
        
        th {
            background-color: #f2f2f2;
            font-family: sans-serif;
        }
        
        td {
            background-color: #ffffff;
            border-bottom: 1px solid #dddddd;
            border-right: 1px solid #dddddd; /* Sütunları ayıran siyah çizgi */
            font-family: sans-serif;
        }
        
        img {
            width: 150px;
            height: auto;
            border: 3px solid #ddd;
            border-radius: 8px;
        }
        
        a {
            color: #333333;
            text-decoration: none;
            font-family: sans-serif;
        }
        
        a:hover {
            text-decoration: underline;
            font-family: sans-serif;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
            font-family: sans-serif;
        }
        
        .styled-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #333333;
            transition: background-color 0.3s ease;
            font-family: sans-serif;
        }
        
        .styled-button:hover {
            background-color: #dddddd;
            font-family: sans-serif;
        }
        .styled-button2:hover{
            background-color:red;
            font-family: sans-serif;

        }

             .styled-button3 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #333333;
            transition: background-color 0.3s ease;
            font-family: sans-serif;
        }
        .styled-button3:hover{
            background-color:63FE44;
            font-family: sans-serif;

        }
        .styled-button2{
            display: inline-block;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s ease;
            font-family: sans-serif;
        }
        .styled-button4:hover {
    background-color: orange;
    font-family: sans-serif;
    color: white;
}
        .styled-button4 {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s ease;
            font-family: sans-serif;
        }
    </style>
    <center><h4 style="position: absolute; bottom: 0; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA <sub>v1.8</sub> - &nbsp;</h4></center>