<head><link rel="shortcut icon" href="img/data_fav.png" type= "img/data_fav.png" /></head>
<?php
session_start();

// Giriş yapılmamışsa listeleme.php'ye yönlendirme
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: in_dex.php');
    exit;
}
?>
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

    // Verileri data3435 tablosuna eklem
                    header("Location: index13.php");
}

// Verileri tablo şeklinde ekrana yazdırma
$sorgu2 = $db->prepare("SELECT * FROM data3435");
$sorgu2->execute();
$veriler = $sorgu2->fetchAll(PDO::FETCH_ASSOC);
// index13.php

include 'index4.php';

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sorgu = $db->prepare("SELECT * FROM data3435 WHERE resim_as2 LIKE :search");
    $sorgu->bindValue(":search", "%" . $search . "%");
    $sorgu->execute();
    $veriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
}


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
    $id = $_POST['id'];

    // İlgili satırı veritabanından çekme
    $sorgu = $db->prepare("SELECT * FROM data3434 WHERE id = :id");
    $sorgu->bindParam(":id", $id);
    $sorgu->execute();
    $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
    
    // İlgili satırı data3434 tablosundan silme
    $sorgu2 = $db->prepare("DELETE FROM data3434 WHERE id = :id");
    $sorgu2->bindParam(":id", $id);
    $sorgu2->execute();

    header("Location: index13.php");
   
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teslim Edilenler</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            
        }
        
        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            height: 50px;
            
        }
        
        th {
            background-color: #f2f2f2;
            
        }
        
        img {
            width: 100px;
            height: auto;
            border-radius: 12px;
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
        .styled-button2 {
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
        .styled-button2:hover {
            background-color: red;
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
        .styled-button3:hover {
            background-color: #99CCCC;
            font-family: sans-serif;
        }
.asd{
padding-left: 50px;
padding-top: 20px;
padding-right: 20px;
padding-bottom: 20px;
margin-left: 50px;
}

.thead{
width: 100%;
height: 65px;
background-color: #f2f2f2;
border-radius: 50px;
}
.assa{
padding-top: 4px;
margin-left: 39%;
color: black;
width: 910px;
border-radius: 50px;
   

}
.head2{
   border-radius: 50px;
   padding: 10px 20px;
   font-size: 16px;
   background-color: white;
   border: none;
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
        .refresh-button:active {
            transform: rotate(360deg); /* Tıklandığında döndürme animasyonu */
            transition: transform 0.5s ease;
            background-color: #33CC00; /* Düğme rengini değiştir */
        }
    </style>
</head>
<body>
<div class="head2"><div class="thead"><div class="assa"><th><h3  style="font-family: sans-serif;">
<form action="" method="post" style=" display : inline-block;">
                    <input type="text" class="sea" name="search" placeholder=" Veri ara..." />
                    <button type="submit2" class="sea2">Ara</button>&nbsp;&nbsp;<form  style="display : inline-block;">
                <button type="submit" class="refresh-button" style="">&#8635;</button>
                </form>
                </form>&nbsp;&nbsp;TESLİM EDİLENLER</h3></th></div></div></div>
    <table>
        <thead>
            <tr>  
                <th style="font-family: sans-serif;">DURUMU</th>
                <th style="font-family: sans-serif;">ID</th>
                <th style="font-family: sans-serif;">RESİM</th>
                <th style="font-family: sans-serif;">VERİ ADI</th>
                <th style="font-family: sans-serif;"><span style="color: #9dc900;">OLUŞTURULMA TARİHİ</th>
                <th style="font-family: sans-serif;"><span style="color: #6472FF;">TESLİM EDİLDİĞİ TARİHİ</th></span>
                <th style="font-family: sans-serif;">ADET</th>
                <th style="font-family: sans-serif;">FİYAT</th>
                <th style="font-family: sans-serif;">PARA BİRİMİ</th>
                <th style="font-family: sans-serif;">SİL</th>
                <th style="font-family: sans-serif;"><a href="index.php" class="as"> VERİ KAYDI </a></th>
            <th><a href="index3.php" class="as2"> VERİLER </a><br></th>
            <th><a href="in_dex.php?action=cikis" class="aa3"> ÇIKIŞ </a><br></th></tr>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veriler as $veri) { ?>
                <tr><td><img style="width:30px" src="img/data_yes.png" alt=""></td>
                    <td><?php echo $veri['id']; ?></td>
                    <td>
                        
                        <?php
                        $resim_uzantisi = pathinfo($veri['resim_ad2'], PATHINFO_EXTENSION);
                        if (in_array($resim_uzantisi, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo '<img src="img/' . $veri['resim_ad2'] . '" alt="Resim">';
                        } else {
                            echo 'Geçersiz Resim Formatı';
                        }
                        ?>
                    </td>
                    <td><div style="font-family: sans-serif;"><?php echo $veri['resim_as2']; ?></td>
                    <td><div style="font-family: sans-serif;"><span style="color: #9dc900;"><b><?php echo $veri['date_as2']; ?></b></td></span>
                    <td><div style="font-family: sans-serif;"><span style="color: #6472FF;"><b><?php echo $veri['date_sn2']; ?></b></td></span>
                    <td><div style="font-family: sans-serif;"><?php echo $veri['adet2']; ?></td>
                    <td><div style="font-family: sans-serif;"><?php echo $veri['fıyat2']; ?><?php
                   $kdvOrani = $veri['kdvfıyat2']; // KDV oranı
                   if($veri['kdvfıyat2'] > 4){
                   $bol = $veri['fıyat2'] / 100;
                    $kdvTutari = $bol * $kdvOrani;
                    $kdvtoplamı = $kdvTutari + $veri['fıyat2'];
                    echo " <br><span style='background-color: #33FF33; color: black;' ><b>KDV Dahil Fiyatı : "; echo $kdvtoplamı ;
                    

                                ?></span><br><span style='background-color: #3366FF; color: black;' ><?php
                                
                                echo "KDV Oranı : "; echo $veri['kdvfıyat2']; echo "% </span></b>";
                            }
                            else {
                                echo "<span style='background-color: red; color: black;' ><b><br>KDV BELİRLEMEDİNİZ</b></span>";
                            }?></td>
                    <td><div style="font-family: sans-serif;"><?php echo $veri['bırım2']; ?></td>
                    <td><button class="styled-button2"><a href="index14.php?id=<?php echo $veri['id']; ?>">SİL</a></button></td>
                    <td><?php echo "" ?><button class="styled-button3" name="ayrıntılı"><a href="index12.php?id=<?php echo $veri['id']; ?>">Ayrıntılı Gör</a></button></td></td>
                    <td><a href="index13.php"><img src="img/data.png" alt="Resim" width="200" height="200" ></a></td>
                    <td><?php echo "" ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<center><h4 style="position: absolute; bottom: auto; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA <sub>v1.8</sub> - &nbsp;</h4></center>

