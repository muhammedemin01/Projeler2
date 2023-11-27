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
    // Diğer form verilerini alın
    $veri = $_POST['veri'];
    $veri2 = $_POST['veri2'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $tarih = $_POST['tarih'];
    $tarih3 = $_POST['tarih3'];
    $adet = $_POST['adet'];
    
    // Dosya yükleme işlemi
    $yukleklasor = "img/";
    $tmp_name = $_FILES['yukle_resim']['tmp_name'];
    $name = $_FILES['yukle_resim']['name'];
    $uzanti = substr($name, -4);
    $rastgelesayi1 = rand(10000, 50000);
    $rastgelesayi2 = rand(10000, 50000);
    $resimad = $rastgelesayi1 . $rastgelesayi2 . $uzanti;
    $product_id = $_POST['product_id'];
    if(strlen($name) == 0){
        echo "Bir dosya seçiniz";
        exit();
    }
    
    if($_FILES['yukle_resim']['size'] > (1024*1024*3)){
        echo "Dosya boyutu çok fazla";
        exit();
    }
    
    if($uzanti != '.jpg' && $uzanti != '.jpeg' && $uzanti != '.png'){
        echo "Yalnızca JPG veya PNG formatında olabilir!";
        exit();
    }
    
    move_uploaded_file($tmp_name, "$yukleklasor/$resimad");
    
    // Veritabanına kayıt eklemesi
    $sorgu = $db->prepare("INSERT INTO data3436 (product_id, resim_ad3, resim_as3, date_as3, date_sn3, adet3, fıyat3, bırım3, kdvfıyat3) VALUES (:product_id, :resimad, :veri, :tarih, :tarih3, :adet, :veri2, :option1, :option2)");
    $sorgu->bindParam(':product_id', $product_id);
    $sorgu->bindParam(':resimad', $resimad);
    $sorgu->bindParam(':veri', $veri);
    $sorgu->bindParam(':tarih', $tarih);
    $sorgu->bindParam(':tarih3', $tarih3);
    $sorgu->bindParam(':adet', $adet);
    $sorgu->bindParam(':veri2', $veri2);
    $sorgu->bindParam(':option1', $option1);
    $sorgu->bindParam(':option2', $option2);
    $sorgu->execute();
    if($sorgu->rowCount() > 0){
        header("Location: index15.php?id=" . $product_id);
    }else{
        die("Veri eklenemedi");
    }
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id']; // Retrieve the id from the form
    $product_id = $_POST['product_id']; // Retrieve the product_id

    $sorgu = $db->prepare("DELETE FROM data3436 WHERE id = :id");
    $sorgu->bindParam(':id', $delete_id, PDO::PARAM_INT);
    // Sorguyu çalıştırın
    if ($sorgu->execute()) {
        header("Location: index15.php?id=" . $product_id);
    } else {
        die("Veri silinemedi");
    }
}



?>
<form action="index15.php" method="POST" enctype="multipart/form-data">
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
    <input type="hidden" name="product_id" value="<?php echo $_GET['id'] ?>">
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

</thead>
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
        #delbutton{
            background-color: red;
            color : white;
        }
        #delbutton:hover{
            background-color: #CC0000;
            color : white;
        }
        #delbutton2{
            border-radius : 25px;
            background-color: #3366FF;
            color : white;
        }
        #delbutton2:hover{
            background-color: #3399FF;
            color : white;
        }
        #eklenenler1{
            width: auto;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #339933;
            border: none;
            font-family: Arial, sans-serif, bold;
            color:white;
            font-weight: bold;
        }
        #eklenenler1:hover{
            background-color: #339900;
        }
        @keyframes blink {
            0% { opacity: 1; } /* Başlangıç durumu, tamamen görünür */
            50% { opacity: 0; } /* Yarıda kaybolur, görünmez olur */
            100% { opacity: 1; } /* Son durum, tekrar tamamen görünür */
        }
        
        .blinking-dot {
            width: 20px; /* Noktanın genişliği */
            height: 20px; /* Noktanın yüksekliği */
            background-color: orange; /* Noktanın rengi */
            border-radius: 50%; /* Noktanın yuvarlak olması için */
            animation: blink 1s infinite; /* 'blink' animasyonunu saniyede bir tekrarla */
            display: inline-block; /* Yan yana gelmelerini sağlamak için */
            margin-right: 5px; /* Noktalar arasında boşluk bırakmak için (isteğe bağlı) */
            margin-bottom:-4px;
        }
</style>

<?php
$resimsor = $db->prepare("SELECT * FROM data3436 WHERE product_id = ?");
$resimsor->execute(array($_GET['id']));
$resimfet = $resimsor->fetchAll(PDO::FETCH_ASSOC);
?>

<CENTER>
<?php
     $product_id = $_GET['id'];
    
     $sorgu = $db->prepare("SELECT `id`, `resim_ad`, `resim_as`, `date_as`, `date_sn`, `adet`, `fıyat`, `bırım`, `kdvfıyat` FROM `data3434` WHERE id = :product_id");
     $sorgu->bindParam(':product_id', $product_id, PDO::PARAM_INT);
     $sorgu->execute();
     $veriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
     
?>
<table border="1" width="100%">
    <tr>
        <th>Resim Adı</th>
        <th>Adı</th>
        <th>Fiyat</th>
        <th>Para Birimi</th>
        <th>KDV Oranı</th>
        <th>Oluşturulma Tarihi</th>
        <th>Teslim Tarihi</th>
        <th>Adet</th>
        <th>Sil</th>
    </tr>
    <?php foreach ($veriler as $veri) { ?>
        <tr>
            <td><img src="img/<?php echo $veri['resim_ad']; ?>" width="100"></td>
            <td><?php echo $veri['resim_as']; ?></td>
            <td><?php echo $veri['fıyat']; ?></td>
            <td><?php echo $veri['bırım']; ?></td>
            <td><?php echo "% "; echo $veri['kdvfıyat']; ?></td>
            <td><?php echo $veri['date_as']; ?></td>
            <td><?php echo $veri['date_sn']; ?></td>
            <td><?php echo $veri['adet']; ?></td>
            <td><button type="submit" id="delbutton2">Main</button></td>
            <tr>
        <td colspan="9" id="eklenenler"><div id="eklenenler1">Eklenenler &nbsp; ⬇</td></div>
    </tr>
    <?php if (empty($resimfet)) { ?>
    <tr>
        <td colspan="9" style="text-align: center; font-family: sans-serif; "><div class="blinking-dot"></div>Eklenen ürün yok</td>
    </tr>
<?php } else { ?>
    <?php foreach ($resimfet as $veri) { ?>
        <tr>
            <td><img src="img/<?php echo $veri['resim_ad3']; ?>" width="100"></td>
            <td><?php echo $veri['resim_as3']; ?></td>
            <td><?php echo $veri['fıyat3']; ?></td>
            <td><?php echo $veri['bırım3']; ?></td>
            <td><?php echo "% "; echo $veri['kdvfıyat3']; ?></td>
            <td><?php echo $veri['date_as3']; ?></td>
            <td><?php echo $veri['date_sn3']; ?></td>
            <td><?php echo $veri['adet3']; ?></td>
            <td>
    <form action="index15.php" method="POST">
        <input type="hidden" name="delete_id" value="<?php echo $veri['id']; ?>">
        <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>"> <!-- Add this line -->
        <button type="submit" name="delete" id="delbutton">SİL</button>
    </form>
</td>
        </tr>
    <?php } ?>
    <?php } ?>
    <?php } ?>
</table>
<CENTER>
<table border="1"  width="150">
    <tr><th><a href="index.php" class="aa2" style ="font-family: sans-serif;"> VERİ KAYDI </a>&nbsp;
    <a href="index3.php" class="aa3" style ="font-family: sans-serif;"> VERİLER </a>&nbsp;
    <a href="index13.php" class="aa5" style ="font-family: sans-serif;"> TESLİM EDİLENLER </a>&nbsp;
    <a href="in_dex.php?action=cikis" class="aa" style ="font-family: sans-serif;"> ÇIKIŞ </a><br></th></tr></div>
    </div>
</table>
</CENTER>
<center><h4 style="position: absolute; bottom: auto; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA <sub>v1.8</sub> - &nbsp;</h4></center>
    
    
