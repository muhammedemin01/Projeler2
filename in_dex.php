<!-- Bu yazılım Muhammed Emin Ergül tarafından yazılmıştır-->
<?php
session_start();

// Eğer çıkış yapıldıysa oturumu kapat
if (isset($_GET['action']) && $_GET['action'] === 'cikis') {
    $_SESSION['authenticated'] = false;
    header('Location: index3.php');
    exit;
}

$servername = "localhost";
$db_username = "root"; 
$db_password = "";     
$dbname = "data34";

// Veritabanı bağlantısı
$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

// Bağlantı kontrolü
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Giriş yapılmamışsa veya yanlış bilgi girilmişse hata mesajı gösterilir.
$error = '';
if (isset($_POST['submit'])) {
    // Verileri sorgula
    $query = "SELECT id, username, password1 FROM inpu";
    $result = mysqli_query($conn, $query);

    // Verileri ekrana yazdır
    while ($row = mysqli_fetch_assoc($result)) {
        $veri1 = $row['password1'];
        $veri2 = $row['username'];

        // Kullanıcı adı ve şifre kontrolü
        if ($_POST['u12'] === $veri2 && $_POST['p12'] === $veri1) {
            $_SESSION['authenticated'] = true;
            header('Location: index.php');
            exit;
        } else {
            $error = "Kullanıcı adı veya şifre yanlış";
        }
    }
}

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>DATA Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="img/data_fav.png" type="img/data_fav.png" />
    <style>
body {
    font-family: sans-serif;
    background-color: /*#f2f2f2*/;
    background-image: url('img/WALL3.jpg');
    background-size: 1920px 1080px; /* Resmin sabit boyutu */
    animation: zoomBackground 30s linear infinite;
    transform-origin: center;
}

@keyframes zoomBackground {
    0% {
        background-size: 1920px 1080px; /* Başlangıçta sabit boyutta başlasın */
    }
    50% {
        background-size: 2100px 1200px; /* Orta noktada büyük boyuta ulaşsın */
    }
    100% {
        background-size: 1920px 1080px; /* Sonunda tekrar sabit boyutta kalsın */
    }
}





        .container {
    max-width: 400px;
    margin: 50px auto;
    padding: 60px;
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 2px solid #ff00ff; /* Neon çerçeve rengi */
    position: relative;
    animation: glow 2s infinite; /* Neon parlama efekti */
}

@keyframes glow {
    0% {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), 0 0 20px #ff00ff, 0 0 20px #ff00ff; /* Neon parlama efekti */
    }
    50% {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), 0 0 30px #ff00ff, 0 0 40px #ff00ff; /* Neon parlama efekti */
    }
    100% {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), 0 0 20px #ff00ff, 0 0 20px #ff00ff; /* Neon parlama efekti */
    }
}


        .img {
            align: center;
            text-align: center;
            margin-bottom: 30px;
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            font-family: sans-serif;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 30px;
            border: 1px solid #ccc;
            border-radius: 30px;
        }

        button[type="submit"] {
            width: 422px;
            padding: 10px;
            background-color: #1BCBE7;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #4DECEA;
        }

        .box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .rounded-box {
    margin-top: 40px;
    margin-left: 740px;
    font-family: sans-serif;
    padding: 10px;
    width: 400px;
    border-radius: 100px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    background-color: white;
    display: inline-block;
    position: relative;
    animation: neon-glow 2s infinite alternate;
}

@keyframes neon-glow {
    0% {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    100% {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), 0 0 40px #ff00ff, 0 0 30px #ff00ff;
    }
}


        .image {
            vertical-align: middle;
        }

        .hr {
            text-decoration: none;
            color: black;
        }

        .hr:hover {
            text-decoration: none;
            color: darkgray;
        }
        .error{
            color: #dc3545;
            background: #ffdbdb;
            padding: 10px 25px;
            border-radius: 5px;
            text-align: center;
        }
        @keyframes blink {
            0% { opacity: 1; } /* Başlangıç durumu, tamamen görünür */
            50% { opacity: 0; } /* Yarıda kaybolur, görünmez olur */
            100% { opacity: 1; } /* Son durum, tekrar tamamen görünür */
        }
        
        .blinking-dot {
            width: 77px; /* Noktanın genişliği */
            height: 63px; /* Noktanın yüksekliği */
            background-image:  url('img/data22.png'); /* Noktanın rengi */
            border-radius: 23%; /* Noktanın yuvarlak olması için */
            animation: blink 1s infinite; /* 'blink' animasyonunu saniyede bir tekrarla */
            display: inline-block; /* Yan yana gelmelerini sağlamak için */
            margin-right: -41px; /* Noktalar arasında boşluk bırakmak için (isteğe bağlı) */
            margin-bottom:10px;
            margin-left: 15px;
            animation-delay: 0.5s; /* İkinci dot'un animasyona başlama gecikmesi */
        }
        .blinking-dot2 {
            width: 77px; /* Noktanın genişliği */
            height: 63px; /* Noktanın yüksekliği */
            background-image: url('img/data11.png');/* Noktanın rengi */
            border-radius: 23%; /* Noktanın yuvarlak olması için */
            animation: blink 1s infinite; /* 'blink' animasyonunu saniyede bir tekrarla */
            display: inline-block; /* Yan yana gelmelerini sağlamak için */
            margin-right: 5px; /* Noktalar arasında boşluk bırakmak için (isteğe bağlı) */
            margin-bottom:2px;
            margin-left: -20px;
        }
        .img-container {
  display: inline-block; /* Resimleri yatayda hizalamak için kullanılacak */
  vertical-align: middle; /* Yatayda ve dikeyde hizalama için kullanılacak */
  text-align: center; /* Resimleri yatayda ortalamak için kullanılacak */
}

.image {
  transform: rotate(0deg); /* Başlangıçta 0 derece dönüş */
  transition: transform 0.7s; /* Dönüşün süresi 1 saniye */

  /* Mouse üzerine gelindiğinde 60 derece döndürme */
  transition: transform 0.7s; /* Dönüşün süresi 1 saniye */
}

.img-container:hover .image {
  transform: rotate(80deg); /* 60 derece döndürme */
}
/* Mouse üzerine gelindiğinde 180 derece döndürmek için bir hover durumu tanımlayın */
.image:hover {
  transform: rotate(80deg); /* 180 derece döndürme */
}
h4 {
    position: absolute;
    bottom: 0;
    left: 50px; /* Yatayda merkeze al */
    transform: translateX(-50%); /* Yatayda merkeze al */
    font-family: 'Interstate', sans-serif;
    text-transform: uppercase; /* Büyük harf kullan */
    text-align: center;
    background: linear-gradient(250deg, #ff00ff, white);
    background-clip: text; /* Metne uygula */
    -webkit-background-clip: text; /* Safari için metne uygula */
    color: transparent; /* Metni gizle */
}
   /* Diğer stiller buraya eklenir */
   .james-webb {
            position: relative;
            overflow: hidden;
        }
        .james {
            transform: translate(5%, 100%);
            transition: transform 0.9s ease;
        }
        .james-webb:hover .james {
            transform: translate(0, 0);
        }
    </style>
</head>
<body>
    <div class="rounded-box">
        <div class="box"><b>Data'ya hoşgeldiniz..</b>&nbsp;&nbsp;&nbsp;<a href="index11.php"><img class="image" src="img/e2l.png" alt="data34" width="40" height="40">
</a></div>
    </div>

    <div class="container">
    <div class="img-container">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<span class='blinking-dot'></span><span class='blinking-dot2'></div><img src="img/dataaa.png" alt="data34" height="50" width="164" style="position: relative; top: 16px; position: relative; left: 15px;" />


        <h3>Giriş Paneli</h3>
        <form action="" method="POST">
            <input type="text" name="u12" placeholder="Kullanıcı Adı" required>
            <input type="password" name="p12" placeholder="Şifre" required>

            <button type="submit" name="submit">Giriş Yap</button>
        </form>
        <br>
        <a href="#" class="hr" onclick="fun()">Şifremi Unuttum</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://artsandculture.google.com/story/_gVxzu3pcbyygw"><p class="james1"></p>
        <?php 
        if($error != ""){
        ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
    </div>
    </div>
    <center>
        <h4 style="position: absolute; bottom: 0; margin-left : 900px; font-family: 'Interstate', sans-serif;">- DATA
            <sub>v1.8</sub> - &nbsp;</h4>
    </center>

    <span class="james-webb" onmouseover="slideIn()" onmouseout="slideOut()">
        <img class="james" src="img/james.webb.png" alt="James webb uzay teleskobu" width="74" height="81">
    </span>
    <script>
            function fun() {
    const intervalId = setInterval(() => {
        clearInterval(intervalId);
        alert("Kullanıcı Adı : emin");
        
        const intervalId2 = setInterval(() => {
            clearInterval(intervalId2);
            alert("Şifre : 123");
        }, 760);
    }, 500);
}
           /* alert("Bu hizmet şu anda kullanılamıyor..");*/
    
        function fun() {
            const intervalId = setInterval(() => {
                clearInterval(intervalId);
                alert("Kullanıcı Adı : emin");
                
                const intervalId2 = setInterval(() => {
                    clearInterval(intervalId2);
                    alert("Şifre : 123");
                }, 760);
            }, 500);
        }
        function slideIn() {
            var jamesImage = document.querySelector('.james');
            jamesImage.style.transform = 'translate(0, 0)';
            document.querySelector('.james1').style = 'color:blue; text-align: center; display: inline-block;'
            document.querySelector('.james1').innerHTML = 'Bu bir James Webb uzay teleskobu...';
        }

        function slideOut() {
            var jamesImage = document.querySelector('.james');
            jamesImage.style.transform = 'translate(100%, 100%)';
        }
    </script>
</body>
</html>

