<head><link rel="shortcut icon" href="img/data_fav.png" type= "img/data_fav.png" /></head>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Detayları</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            background-color: grey;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 30px;
        }

        .product-details {
            text-align: center;
            margin-top: 20px;
        }

        .product-details img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: grey;
            color: white;
        }
        a {
    text-decoration: none; /* Alt çizgiyi kaldırır */
    color: black; /* Link rengini beyaz yapar */
}
a:hover {
    color: grey; /* Link rengini beyaz yapar */
}


    </style>
</head>

<body>
    <a href="index13.php"><h2>&#9668;Çıkış</h2></a>
    <div class="container">
        <?php
        include 'index4.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // İlgili ürünü veritabanından çekme
            $sorgu = $db->prepare("SELECT * FROM data3435 WHERE id = :id");
            $sorgu->bindParam(":id", $id);
            $sorgu->execute();
            $urun = $sorgu->fetch(PDO::FETCH_ASSOC);

            // Ürün bulunamazsa hata mesajı gösterilebilir
            if (!$urun) {
                echo "<h1>Ürün bulunamadı.</h1>";
            } else {
                $product_id2 = $urun['product_id2'];

                // data3436 tablosundan verileri çekme
                $sorgu2 = $db->prepare("SELECT * FROM data3436 WHERE product_id = :product_id");
                $sorgu2->bindParam(":product_id", $product_id2);
                $sorgu2->execute();
                $veriler = $sorgu2->fetchAll(PDO::FETCH_ASSOC);

                // Verileri ekrana yazdırma
                $php = "img/data.png"; // Resmin yolunu belirleyin

                echo "<center><div style='border: 3px solid #ddd; border-radius: 40px; padding: 10px;'><img src='$php' style='width: 190px; height: 50px;'></div></center>";



                echo "<h1 class='product-details'>Ürün Detayları</h1>";
                echo "<div class='product-details'><img src='img/" . $urun['resim_ad2'] . "' alt='Ürün Resmi'></div>";
                echo "<p><b>Ürün Adı:</b> " . $urun['resim_as2'] . "</p>";
                echo "<p><b>Oluşturulma Tarihi:</b> " . $urun['date_as2'] . "</p>";
                echo "<p><b>Teslim Edildiği Tarih:</b> " . $urun['date_sn2'] . "</p>";
                echo "<p><b>Adet:</b> " . $urun['adet2'] . "</p>";
                echo "<p><b>Fiyat:</b> " . $urun['fıyat2'] . "</p>";
                echo "<p><b>Para Birimi:</b> " . $urun['bırım2'] . "</p>";

                if (!empty($veriler)) {
                    echo "<h2 class='product-details'>İlgili Veriler</h2>";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Resim Adı</th><th>Ürün Adı</th><th>Oluşturulma Tarihi</th><th>Teslim Edildiği Tarih</th><th>Adet</th><th>Fiyat</th><th>Para Birimi</th></tr>";
                    foreach ($veriler as $veri) {
                        echo "<tr>";
                        echo "<td>" . $veri['id'] . "</td>";
                        echo "<td><img src='img/" . $veri['resim_ad3'] . "' alt='Ürün Resmi' style='max-width: 100px;'></td>";
                        echo "<td>" . $veri['resim_as3'] . "</td>";
                        echo "<td>" . $veri['date_as3'] . "</td>";
                        echo "<td>" . $veri['date_sn3'] . "</td>";
                        echo "<td>" . $veri['adet3'] . "</td>";
                        echo "<td>" . $veri['fıyat3'] . "</td>";
                        echo "<td>" . $veri['bırım3'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
        }
        ?>
    </div>
</body>

</html>
