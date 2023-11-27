<head><link rel="shortcut icon" href="img/data_fav.png" type= "img/data_fav.png" /></head>
<title>DATA Veriler</title>
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

if(isset($_POST['resimyukle'])){
    /*include_once "lib/image_upload.php";*/
    $veri = $_POST['veri'];
    $op = $_POST['option1'];
    $op2 = $_POST['option2'];
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

    $sql = "INSERT INTO data3434 (resim_as, resim_ad, date_as, date_sn, adet, fıyat, bırım, kdvfıyat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$veri, $resimad, $tarih, $tarih3, $adet, $veri2, $op, $op2]);

    header("Location: index3.php");
    exit();
}

$resimsor = $db->prepare("SELECT * FROM data3434");
$resimsor->execute();
$resimfet = $resimsor->fetchAll(PDO::FETCH_ASSOC);
?>
<thead>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        
        a {
            color: #333333;
            text-decoration: none;
            font-family: sans-serif;
        }
        
        a:hover {
            text-decoration: underline;
            font-family: sans-serif;
            color: white;
            text-decoration: none;
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
            background-color: #FF8125;
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
        .styled-button4:hover {
            background-color: #2d94fc;
            font-family: sans-serif;
            color: white;
        }
        .styled-button5 {
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
        .styled-button5:hover {
            background-color: #9dc900;

            font-family: sans-serif;
            color: white;
        }
        .styled-button6 {
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
        .styled-button6:hover {
            background-color: #7913ac;

            font-family: sans-serif;
            color: white;
        }
        .custom-select {
            display: inline-block;
            /*position: relative;*/
            font-family: sans-serif;
            appearance: none;
            padding: 8px 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background-color: #fff;
            color: #333;
            transition: border-color 0.3s, box-shadow 0.3s;
        
        }

        .custom-select:hover {
        border-color: #aaa;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
        }

        .custom-select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .custom-select::after {
        content: '\25BC';
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        font-size: 12px;
        pointer-events: none;
        transition: color 0.3s;
        }

        .custom-select:hover::after {
        color: #666;
        transform: translateY(-50%) rotate(180deg);
        }

        .custom-select:focus::after {
        color: #007bff;
        }

        .custom-select option {
        background-color: #fff;
        color: #333;
        transition: background-color 0.3s, color 0.3s;
        }

        .custom-select option:hover {
        background-color: white;
        color: #333;
        
        
        }

        .custom-select:focus option {
        background-color: #007bff;
        color: #fff;
       
        }
        .sea{
            border-radius: 20px;
            border: none;
            height: 34px;
            display : inline-block;
        }
                .sea:hover{
                    background-color: #aaa;
                    border-radius: 20px;
                    border: none;
                    height: 34px;
                    color:white;
                    
                }
        .sea2{
            border-radius: 20px;
            border: 1px solid #aaa;
            height: 34px;
            width: 74px;
            display : inline-block;
        }
                .sea2:hover{
                    background-color: #aaa;
                    color:white;

                }
        .sea3{
            border-radius: 20px;
            border: 1px solid #aaa;
            height: 34px;
            width: 200px;
            display : inline-block;
        }
                .sea3:hover{
                    background-color: #aaa;
                    color:white;

                }    
        .as {
                text-decoration: none;
                color: black;
                border-radius: 10px;
                padding: 10px 20px;
                font-size: 16px;
                background-color: #A7A7A7;
                border: none;
                    }
                        .as:hover
                        {


                            background-color: #9dc900;
                        }
        .as2 {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
        }
                    .as2:hover
                    {


                        background-color: #2d94fc;
                    }
                    .as4 {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
        }
                    .as4:hover
                    {


                        background-color: #AB1CF7;
                    }


                    .aa3 {
            text-decoration: none;
            color: black;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #A7A7A7;
            border: none;
            
                    }
                    .aa3:hover{
            background-color: red;
        }

        input::placeholder,
textarea::placeholder{
    color: black;
    font-size: 15px;
    
}

.styled-button5 {
  cursor: pointer;
}
.buyuyenresim:hover{
cursor: pointer;/*help-wait-curser-move*/
transform: scale(1.2, 1.2);
transition-duration: 0.3s;
box-shadow: 0 0 10px 5px #836fff;
}
 /* Temel düğme stilleri */
 .refresh-button {
            width: 35px;
            height: 34px;
            border: none;
            border-radius: 50%; /* Yuvarlak düğme için */
            background-color: #3498db; /* Düğme rengi */
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease; /* Transform animasyonu için geçiş efekti */
            padding-top : 0px;
            padding-bottom : 8px;
        }

        /* Düğme üzerine gelindiğinde stil */
        .refresh-button:hover {
            background-color: #2980b9; /* Düğme rengini değiştir */
        }

        /* Düğme tıklandığında stil */
        .refresh-button:active {
            transform: rotate(360deg); /* Tıklandığında döndürme animasyonu */
            transition: transform 0.5s ease;
            background-color: #33CC00; /* Düğme rengini değiştir */
        }
    </style>
</head>
<body>
    <table width="150" ;>
        <tr>
        <th><a href="index.php"><img src="img/data.png" alt="Resim" width="200" height="200" ></th></a>
            <th><a href="index.php" class="as"> VERİ KAYDI </a></th>
            <th><a href="index3.php" class="as2"> VERİLER </a><br></th>
            <th><a href="index13.php" class="as4"> TESLİM EDİLENLER </a><br></th>
            <th><a href="in_dex.php?action=cikis" class="aa3"> ÇIKIŞ </a><br></th></tr></div>
        </div>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th colspan="10"><h3>- VERİLER -</h3></th>
            </tr>
            <tr>
                <form method="POST" action="index3.php" style=" display : inline-block;">
                    <th>ID</th>
                    <th>VERİ</th>
                    <th>VERİ ADI</th>
                    <th>OLUŞTURULMA TARİH</th>
                    <th>TESLİM TARİH</th>
                    <th>TESLİM KALAN GÜN</th>
                    <th>ADET</th>
                    <th>FİYAT</th>
                    <th>PARA BİRİMİ</th>
                    <th>             
                    <select class="custom-select" style="text-align: center;" name="siralama" onchange="this.form.submit()">
                        <option value="">Filtrele</option>
                        <option value="tl">TL ile Sırala</option>
                        <option value="eu">Euro ile Sırala</option>
                        <option value="us">Dolar ile Sırala</option>
                        <option value="newtg">Teslim Tarihi Geçmiş Sipariş</option>
                        <option value="newtg2">Teslim Tarihi Yaklaşan Sipariş</option>
                        <option value="new">Oluşturma'ya Göre En Yeni</option></form>
                        <option value="old">Oluşturma'ya Göre En Eski</option></form>
                        <option value="2023">Oluşturulma'ya Göre 2023</option>
                        <option value="2022">Oluşturulma'ya Göre 2022</option>
                        <option value="2021">Oluşturulma'ya Göre 2021</option>
                        <option value="2020">Oluşturulma'ya Göre 2020</option>
                        <option value="2019">Oluşturulma'ya Göre 2019</option>
                        <option value="2018">Oluşturulma'ya Göre 2018</option>
                        <option value="2017">Oluşturulma'ya Göre 2017</option>
                        <option value="2016">Oluşturulma'ya Göre 2016</option>
                        <option value="2015">Oluşturulma'ya Göre 2015</option>
                    </select>
                </form>            
                <form action="" method="post" style=" display : inline-block;">
                    <input type="text" class="sea" name="search" placeholder=" Veri ara..." />
                    <button type="submit" class="sea2">Ara</button>
                    
                </form>
                <form  style="display : inline-block;">
                <button type="submit" class="refresh-button" style="">&#8635;</button>
                </form>
            </tr>
        </thead>
        <tbody>
            
            <?php
            $sorgu = $db->query("SELECT * FROM data3434");
            /* siralama*/
            if(isset($_POST['siralama'])){
                $siralama = isset($_POST['siralama']) ? $_POST['siralama'] : date("y");
                $sorgu = $db->prepare("SELECT * FROM data3434 WHERE YEAR(date_as) = :date");
                $sorgu->bindParam(":date", $siralama);
                $sorgu->execute();
                $siralama = isset($_POST['siralama']) ? $_POST['siralama'] : '';

                if ($siralama == 'new') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 ORDER BY date_as DESC");
                    $sorgu->execute();
                }
                if ($siralama == 'old') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 ORDER BY date_as ASC");
                    $sorgu->execute();
                }
                if ($siralama == 'new2') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 ORDER BY date_sn DESC");
                    $sorgu->execute();
                }
                if ($siralama == 'old2') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 ORDER BY date_sn ASC");
                    $sorgu->execute();
                }
                if ($siralama == 'tl') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE bırım = '₺'");
                    $sorgu->execute();
                }
                if ($siralama == 'eu') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE bırım = '€'");
                    $sorgu->execute();
                }
                if ($siralama == 'us') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE bırım = '$'");
                    $sorgu->execute();
                }
                if ($siralama == 'newtg') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE date_sn <= CURDATE()");
                    $sorgu->execute();
                }
                if ($siralama == 'newtg2') {
                    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE DATEDIFF(date_sn, CURDATE()) > 0 AND DATEDIFF(date_sn, CURDATE()) < 5");
                    $sorgu->execute();
                }    
            }
            

         

/* arama */
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE resim_as LIKE :search OR id = :id");
    $sorgu->bindValue(":search", "%" . $search . "%");
    $sorgu->bindValue(":id", $search);
    $sorgu->execute();
}

$resimfet = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>


    <tbody>
        <?php foreach ($resimfet as $resimcek) { ?>
            <tr>

<?php
    $tarih = $resimcek['date_as'];
    $tarih2 = $resimcek['date_sn'];
    $baslangic_tarihi = $tarih;
    $bitis_tarihi = $tarih2;
    $baslangic_zamani = strtotime($baslangic_tarihi);
    $bitis_zamani = strtotime($bitis_tarihi);
    $gun_farki = floor(($bitis_zamani - $baslangic_zamani) / (60 * 60 * 24));
?>

                <td><?php echo $resimcek['id']; ?></td>
                <td>
                    <img src="img/<?php echo $resimcek['resim_ad']; ?>" alt="Resim" class="buyuyenresim">
                </td>
                <td><?php echo $resimcek['resim_as']; ?></td>
                <td><?php echo $resimcek['date_as']; ?></td>
                <td><?php echo $resimcek['date_sn']; ?></td>
                <td><?php
                
                $tarih_sn = strtotime($resimcek['date_sn']);
                $bugun = strtotime(date("Y-m-d"));
                
                if ($tarih_sn <= $bugun) {
                    echo '0<span style="color: red;"><br>Teslim Tarihi Geçti</span>';
                } else {
                    $gun_farki = floor(($tarih_sn - $bugun) / (60 * 60 * 24));
                    echo $gun_farki;
                    if ($gun_farki < 5) {
                        ?><br>
                        <?php echo '<span style="color: blue;">Yaklaşan Tarihli Sipariş</span>';
                    }
                }
                
                ?></td>
                <td><?php echo $resimcek['adet']; ?></td>
                <td><?php echo $resimcek['fıyat']; ?><br> <?php
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
                                echo "<span class='blinking-dot'></span><span style='background-color: red; color: black;' ><b>KDV BELİRLEMEDİNİZ</b></span>";
                            }?></td>
                <td><?php echo $resimcek['bırım']; ?></td>
                <td>
                    <div class="button-container">
                        <button class="styled-button2"><a href="index5.php?id=<?php echo $resimcek['id']; ?>">SİL</a></button>
                        <button class="styled-button3"><a href="index6.php?id=<?php echo $resimcek['id']; ?>">DÜZENLE</a></button>
                        <button class="styled-button6"><a href="index15.php?id=<?php echo $resimcek['id']; ?>">+ EKLE</a></button>
                        <button class="styled-button4"><a href="index8.php?id=<?php echo $resimcek['id']; ?>">AYRINTILI GÖR</a></button>
                        <form action="index13.php" method="post" style="display: inline-block;">
    <input type="hidden" name="id" value="<?php echo $resimcek['id']; ?>">
    <button class="styled-button5" name="submit" type="submit">TESLİM EDİLDİ</button>
</form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
        </tbody>
    </table>
</body>
</html>
<!-- $gercek_saat = date("Y-m-d H:i:s");
echo "SAAT: " . $gercek_saat; -->
<?php
// index13.php

include 'index4.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];

    // İlgili satırı veritabanından çekme
    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE id = :id");
    $sorgu->bindParam(":id", $id);
    $sorgu->execute();
    $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
    
    // Verileri data3435 tablosuna ekleme
    $sql = "INSERT INTO data3435 (product_id2, resim_ad2, resim_as2, date_as2, date_sn2, adet2, fıyat2, bırım2) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id, $satir['resim_ad'], $satir['resim_as'], $satir['date_as'], $satir['date_sn'], 
                    $satir['adet'], $satir['fıyat'], $satir['bırım']]);
    
}

// Verileri tablo şeklinde ekrana yazdırma
$sorgu2 = $db->prepare("SELECT * FROM data3435");
$sorgu2->execute();
$veriler = $sorgu2->fetchAll(PDO::FETCH_ASSOC);
?>
<center><h4 style="position: absolute; bottom: auto; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA <sub>v1.8</sub> - &nbsp;</h4></center>
<div class="fullDiv">
    <button class="close">kapat</button>
    <img src="img/1988115084.png">
</div>
<style>
    .fullDiv {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        background-color: rgba(0, 0, 0, 0.7); /* Gece modu gibi bir arkaplan ekleyin */
        display: none;
        justify-content: center;
        align-items: center;
    }

    .fullDiv img {
        max-width: 700px; /* Büyütülen fotoğrafın maksimum genişliği 500px olacak */
    max-height: 700px; /* Büyütülen fotoğrafın maksimum yüksekliği 500px olacak */
    width: auto; /* Genişlik otomatik ayarlanacak */
    height: auto; /* Yükseklik otomatik ayarlanacak */
    }

    .fullDiv .close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }
    .fullDiv .close:hover {
color: #;
    }
    @keyframes blink {
            0% { opacity: 1; } /* Başlangıç durumu, tamamen görünür */
            50% { opacity: 0; } /* Yarıda kaybolur, görünmez olur */
            100% { opacity: 1; } /* Son durum, tekrar tamamen görünür */
        }
        
        .blinking-dot {
            width: 20px; /* Noktanın genişliği */
            height: 20px; /* Noktanın yüksekliği */
            background-color: red; /* Noktanın rengi */
            border-radius: 50%; /* Noktanın yuvarlak olması için */
            animation: blink 1s infinite; /* 'blink' animasyonunu saniyede bir tekrarla */
            display: inline-block; /* Yan yana gelmelerini sağlamak için */
            margin-right: 5px; /* Noktalar arasında boşluk bırakmak için (isteğe bağlı) */
            margin-bottom:-4px;
        }
</style>

<script>
    var images = document.querySelectorAll(".buyuyenresim");
    var fullDiv = document.querySelector(".fullDiv");
    var closeButton = document.querySelector(".close");

    for (let i = 0; i < images.length; i++) {
        images[i].addEventListener("click", function () {
            var fullImage = document.querySelector(".fullDiv img");
            fullImage.src = images[i].src;
            fullDiv.style.display = 'flex'; // Overlay'i göster
        });
    }

    closeButton.addEventListener("click", function () {
        fullDiv.style.display = 'none'; // Overlay'i gizle
    });

    fullDiv.addEventListener("click", function (e) {
        if (e.target === fullDiv) {
            fullDiv.style.display = 'none'; // Overlay'in dışına tıklandığında gizle
        }
    });
</script>
