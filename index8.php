<head><link rel="shortcut icon" href="img/data_fav.png" type= "img/data_fav.png" /></head>
<title>DATA Ayrıntılı Gör</title>

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
    $adet = $_POST['adet'];
    $op = $_POST['option1'];
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
        echo "YALNIZCA JPEG VEYA PNG FORMATINDA OLABİLİR!";
        exit();
    }

    move_uploaded_file($tmp_name, "$yukleklasor/$yeni_resimad");

    $resimguncelle = $db->prepare("UPDATE data3434 SET resim_ad=:ad, resim_as=:metin, date_as=:tarih ,adet=:adet WHERE id=:id");
    $resimguncelle->execute(array('ad' => $yeni_resimad, 'metin' => $metin, 'id' => $id , 'tarih' => $tarih, 'adet' => $adet));

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
<div id="printTable">
    <table border="1" width="1000" style="border-collapse: separate; border-spacing: 0;">
        <tr><th colspan="11"><font style="font-family: sans-serif;">- AYRINTILI GÖR -</font></th></tr>
        <tr>
            <th style="border: 1px solid black;">Firma</th>
            <th style="border: 1px solid black;">Resim</th>
            <th style="border: 1px solid black;">ID</th>
            <th style="border: 1px solid black;">Resim Adı</th>
            <th style="border: 1px solid black;">Ürün Adı</th>
            <th style="border: 1px solid black;">Adet</th>
            <th style="border: 1px solid black;">Oluşturulma Tarihi</th>
            <th style="border: 1px solid black;">Teslim Tarihi</th>
            <th style="border: 1px solid black;">Para Birimi</th>
            <th style="border: 1px solid black;">Fiyat</th>
            <th style="border: 1px solid black;">KDV Dahil Fiyat</th>
        </tr>
        <tr>
        <?php
$php = "img/data.png"; // Resmin yolunu belirleyin
?>
<td style="border: 1px solid black;"><img src="<?php echo $php; ?>" style="width: 150px; height: 40px; border: 3px solid #ddd;"></td>
            <td style="border: 1px solid black;">
                <center><img src="img/<?php echo $resimcek['resim_ad']; ?>" style="width: 200px; height: 200px; border: 3px solid #ddd;">
            </td>
            <td style="border: 1px solid black;"><?php echo $resimcek['id']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['resim_ad']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['resim_as']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['adet']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['date_as']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['date_sn']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['bırım']; ?></td>
            <td style="border: 1px solid black;"><?php echo $resimcek['fıyat']; ?></td>
            <?php
                   $kdvOrani = $resimcek['kdvfıyat']; // KDV oranı
                   if($resimcek['kdvfıyat'] > 4){
                   $bol = $resimcek['fıyat'] / 100;
                    $kdvTutari = $bol * $kdvOrani;
                    $kdvtoplamı = $kdvTutari + $resimcek['fıyat'];
                   }
                    ?>
            <td style="border: 1px solid black;"><?php if($resimcek['kdvfıyat'] > 4){
echo $kdvtoplamı;
            } 
            else{
                echo "<span style='background-color: red; color: black;' >KDV BELİRLENMEDİ</span>";
            } 
             if($resimcek['kdvfıyat'] > 4){
                echo "<br>"; echo "KDV ORANI : "; echo $resimcek['kdvfıyat'];  echo "%"; }

$resimsor = $db->prepare("SELECT * FROM data3436 WHERE product_id = ?");
$resimsor->execute(array($_GET['id']));
$resimfet = $resimsor->fetchAll(PDO::FETCH_ASSOC);
?>
            <?php foreach ($resimfet as $veri) {
    echo "<tr>";
   ?><td style="border: 1px solid black;"><img src="<?php echo $php; ?>" style="width: 150px; height: 40px; border: 3px solid #ddd;"></td>
    <td style="border: 1px solid black;">
    <center><img src="img/<?php echo $veri['resim_ad3']; ?>" style="width: 200px; height: 200px; border: 3px solid #ddd;">
</td><?php
    echo "<td style='border: 1px solid black;'>" . $veri['id'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['resim_ad3'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['resim_as3'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['adet3'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['date_as3'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['date_sn3'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['bırım3'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $veri['fıyat3'] . "</td>";
    $kdvOrani = $veri['kdvfıyat3']; // KDV oranı
    if ($veri['kdvfıyat3'] > 4) {
        $bol = $veri['fıyat3'] / 100;
        $kdvTutari = $bol * $kdvOrani;
        $kdvtoplamı = $kdvTutari + $veri['fıyat3'];
        echo "<td style='border: 1px solid black;'>" . $kdvtoplamı . "</td>";
    } else {
        echo "<td style='border: 1px solid black;'><span style='background-color: red; color: black;'>KDV BELİRLENMEDİ</span></td>";
    }
    echo "</tr>";
}?>
        </tr>
    </table>
        
        </td>
        </tr>
    </table>
</div>
<br>
<table border="1" width="150">
    <tr><th><a href="index.php" class="bot1">VERİ KAYDI</a></button>
    <a href="index3.php"class="bot2" >VERİLER</a></th></tr><tr><th>
    <button class="bot3"onclick="printTable()"><span class="printer-icon">🖨️|💾</span> Yazdır | Kaydet


</table>
</thead>
<script>
    function printTable() {
        var printContents = document.getElementById('printTable').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    </script>
<style>
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
        
        .button-container {
            text-align: center;
            margin-top: 20px;
            font-family: sans-serif;
        }
        .bot1{
            display: inline-block;
            padding: 10px 20px;
            background-color: #ACACAC;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s ease;
            font-family: sans-serif;

        }
        .bot1:hover{
            
            background-color: #9dc900;
            font-family: sans-serif;
            color: white;

        }
        .bot2{
            display: inline-block;
            padding: 10px 20px;
            background-color: #ACACAC;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s ease;
            font-family: sans-serif;
        }
        .bot2:hover{
            background-color: #2d94fc;
            font-family: sans-serif;
            color: white;
        }
        .bot3{
            display: inline-block;
    padding: 10px 20px;
    background-color: #ACACAC;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    color: black;
    transition: background-color 0.3s ease;
    font-family: sans-serif;
    margin-right: 5px;
        }
        .bot3 .printer-icon {
    margin-right: 5px;
}
        .bot3:hover{
            background-color: #87ceeb;
    font-family: sans-serif;
    color: white;
    cursor:pointer;
        }
        .bot4{
            display: inline-block;
    padding: 10px 20px;
    background-color: #ACACAC;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    color: black;
    transition: background-color 0.3s ease;
    font-family: sans-serif;
        }
        .bot4 .printer-icon {
    margin-right: 5px;
}
        .bot4:hover{
            background-color: #FFCC00;
    font-family: sans-serif;
    color: white;
    cursor:pointer;
        }

    </style>
    <center><h4 style="position: absolute; bottom: auto; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA <sub>v1.8</sub> - &nbsp;</h4></center>
  