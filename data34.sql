-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Kas 2023, 09:03:20
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `data34`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `data3434`
--

CREATE TABLE `data3434` (
  `id` int(11) NOT NULL,
  `resim_ad` varchar(250) NOT NULL,
  `resim_as` text NOT NULL,
  `date_as` date NOT NULL,
  `date_sn` date NOT NULL DEFAULT current_timestamp(),
  `adet` int(11) NOT NULL,
  `fıyat` int(11) NOT NULL,
  `bırım` text NOT NULL,
  `kdvfıyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `data3434`
--

INSERT INTO `data3434` (`id`, `resim_ad`, `resim_as`, `date_as`, `date_sn`, `adet`, `fıyat`, `bırım`, `kdvfıyat`) VALUES
(416, '3106836697.png', 'Modern Sandalye', '2023-10-21', '2023-12-08', 8, 9500, '₺', 20),
(422, '2184539415.png', 'Bahçe Sandalye', '2023-11-22', '2023-12-21', 22, 98000, '₺', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `data3435`
--

CREATE TABLE `data3435` (
  `id` int(11) NOT NULL,
  `product_id2` int(11) NOT NULL,
  `resim_ad2` text NOT NULL,
  `resim_as2` text NOT NULL,
  `date_as2` date NOT NULL,
  `date_sn2` date NOT NULL,
  `adet2` int(11) NOT NULL,
  `fıyat2` int(11) NOT NULL,
  `bırım2` text NOT NULL,
  `kdvfıyat2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `data3435`
--

INSERT INTO `data3435` (`id`, `product_id2`, `resim_ad2`, `resim_as2`, `date_as2`, `date_sn2`, `adet2`, `fıyat2`, `bırım2`, `kdvfıyat2`) VALUES
(156, 414, '4864020312.png', 'Sarı Sandalye', '2023-10-02', '2023-10-30', 100, 90000, '₺', 0),
(157, 415, '2871640282.png', 'Kırmızı Sandalye', '2023-10-20', '2023-10-29', 52, 58000, '₺', 0),
(158, 419, '3223437718.png', 'Plastik sandalye', '2023-10-26', '2023-11-02', 2, 1500, '₺', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `data3436`
--

CREATE TABLE `data3436` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `resim_ad3` text NOT NULL,
  `resim_as3` text NOT NULL,
  `date_as3` date NOT NULL,
  `date_sn3` date NOT NULL,
  `adet3` int(11) NOT NULL,
  `fıyat3` int(11) NOT NULL,
  `bırım3` text NOT NULL,
  `kdvfıyat3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `data3436`
--

INSERT INTO `data3436` (`id`, `product_id`, `resim_ad3`, `resim_as3`, `date_as3`, `date_sn3`, `adet3`, `fıyat3`, `bırım3`, `kdvfıyat3`) VALUES
(1, 408, '3776037536.png', 'j', '2023-10-09', '2023-10-28', 78, 78, '₺', 20),
(7, 373, '1357435243.png', 'dsf', '2023-10-13', '2023-10-17', 5, 45, '₺', 10),
(8, 373, '1299424992.png', 'xcvcx', '2023-10-05', '2023-10-21', 12, 123, '₺', 10),
(9, 373, '3224944472.png', 'xcvcx', '2023-10-05', '2023-10-21', 12, 123, '₺', 10),
(10, 373, '1487535298.png', 'asd', '2023-10-19', '2023-09-26', 12, 56, '$', 20),
(28, 22, '2990329370.png', 'op', '0000-00-00', '0000-00-00', 0, 0, '$', 0),
(51, 386, '2437344203.png', 'Salon Sandalye', '2023-10-10', '2023-10-29', 25, 520, '₺', 10),
(55, 387, '1275722855.png', 'ıpo', '2023-09-29', '2023-10-20', 90, 90, '₺', 10),
(56, 387, '2769211917.png', 'jmkjh', '2023-10-03', '2023-10-22', 78, 768, '₺', 10),
(57, 387, '4086735031.png', 'ty', '0000-00-00', '0000-00-00', 0, 0, '₺', 0),
(59, 403, '4025737950.png', '98uy', '0000-00-00', '0000-00-00', 0, 7, '$', 0),
(60, 409, '3839120512.png', 'oıpıop', '2023-10-02', '2023-10-28', 90, 908, '$', 20),
(61, 410, '1793040055.png', 'uıuy', '0000-00-00', '0000-00-00', 0, 67, '$', 0),
(62, 411, '3631834049.png', 'ıop', '2023-09-26', '2023-10-15', 90, 90, '$', 10),
(63, 411, '4951549698.png', '879', '2023-10-03', '2023-10-14', 89, 98, '$', 10),
(64, 411, '4729232073.png', 'uı78', '2023-10-09', '2023-10-21', 78, 78, '$', 10),
(65, 412, '2960410589.png', 'uyı', '0000-00-00', '0000-00-00', 0, 8, '₺', 0),
(66, 414, '2961427931.png', 'Şık Lüx Sandalye', '2023-10-02', '2023-10-29', 12, 28000, '₺', 20),
(67, 414, '3968610226.png', 'Şık Metal Sandalye', '2023-10-02', '2023-10-28', 52, 56000, '₺', 20),
(68, 414, '4684940914.png', 'Fileli Metal Sandalye', '2023-10-16', '2023-10-29', 30, 50200, '₺', 10),
(69, 415, '1391439582.png', 'Fileli Metal Sandalye', '2023-10-02', '2023-10-29', 26, 89000, '₺', 10),
(71, 415, '4748230124.png', 'Demir Metal Sandalye', '2023-10-21', '2023-11-04', 15, 12000, '₺', 20),
(72, 415, '4448526536.png', 'Lacivert Lüx Sandalye', '2023-10-21', '2023-11-05', 20, 23000, '₺', 10),
(73, 416, '2770114119.png', 'Beyaz Lüx Sandalye', '2023-10-21', '2023-12-07', 20, 20300, '$', 0),
(74, 416, '1504932993.png', 'Şık Bahçe Sandalye', '2023-10-21', '2023-12-10', 20, 25000, '₺', 20),
(75, 422, '2411246491.png', 'Lüx Metal Ayaklı Sandalye ', '2023-11-22', '2023-11-30', 12, 65000, '₺', 10),
(76, 422, '3184045725.png', 'Metal Tel Sandalye', '2023-11-06', '2023-11-26', 3, 6900, '₺', 10),
(77, 422, '1707128076.png', 'Kırmızı Şık Sandalye', '2023-11-22', '2023-12-01', 25, 8900, '$', 0),
(78, 422, '1453728798.png', 'Örmeli Şık Bahçe Tipi Sandalye', '2023-11-22', '2023-12-08', 9, 6900, '€', 0),
(79, 422, '1183521303.png', 'Lüx Metal Sandalye', '2023-11-22', '2023-12-09', 26, 59000, '₺', 10),
(80, 422, '2763218980.png', 'Arka Metal Fileli Şık Sandalye', '2023-11-22', '2023-11-26', 6, 9800, '₺', 10),
(81, 422, '4060534793.png', 'Kırmızı Modern Metal Sandalye', '2023-11-22', '2023-12-29', 10, 9800, '₺', 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `inpu`
--

CREATE TABLE `inpu` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `inpu`
--

INSERT INTO `inpu` (`id`, `username`, `password1`) VALUES
(2, 'emin', '123');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `data3434`
--
ALTER TABLE `data3434`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `data3435`
--
ALTER TABLE `data3435`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `data3436`
--
ALTER TABLE `data3436`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `inpu`
--
ALTER TABLE `inpu`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `data3434`
--
ALTER TABLE `data3434`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- Tablo için AUTO_INCREMENT değeri `data3435`
--
ALTER TABLE `data3435`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- Tablo için AUTO_INCREMENT değeri `data3436`
--
ALTER TABLE `data3436`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Tablo için AUTO_INCREMENT değeri `inpu`
--
ALTER TABLE `inpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
