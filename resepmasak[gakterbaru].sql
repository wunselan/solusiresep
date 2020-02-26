-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 31, 2019 at 03:08 AM
-- Server version: 10.2.27-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u363466214_resepmasak`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `id_resep` int(12) NOT NULL,
  `komentar` text NOT NULL,
  `rating` int(11) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT current_timestamp(),
  `update_add` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_user`, `id_resep`, `komentar`, `rating`, `create_add`, `update_add`) VALUES
(42, 1, 42, 'Biasa aja', 3, '2019-09-27 14:20:24', '2019-09-27 14:20:24'),
(44, 1, 46, 'Kuranggg', 3, '2019-09-28 07:28:46', '2019-09-28 07:28:46'),
(45, 35, 43, 'Mantap nih.', 5, '2019-09-30 07:53:40', '2019-09-30 07:53:40'),
(46, 1, 49, 'Enakkk banget resepnya', 5, '2019-10-06 15:32:33', '2019-10-06 15:32:33'),
(48, 1, 86, 'Enakk banget pas ', 5, '2019-10-06 15:33:49', '2019-10-06 15:33:49'),
(49, 1, 87, 'Enakkk', 5, '2019-10-23 09:08:50', '2019-10-23 09:08:50'),
(50, 1, 48, 'Tezttt', 5, '2019-10-23 09:11:03', '2019-10-23 09:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `id_komentar` int(12) DEFAULT NULL,
  `id_teman` int(12) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `id_komentar`, `id_teman`, `status`) VALUES
(17, 2, NULL, 15, 1),
(20, 3, NULL, 16, 0),
(31, 2, NULL, 17, 1),
(32, 14, NULL, 18, 1),
(46, 1, NULL, 19, 1),
(47, 15, NULL, 20, 1),
(49, 24, NULL, 21, 0),
(50, 4, NULL, 22, 0),
(51, 19, NULL, 23, 1),
(52, 1, NULL, 24, 1),
(63, 31, NULL, 27, 1),
(64, 32, NULL, 28, 0),
(65, 33, NULL, 29, 1),
(67, 1, 42, NULL, 1),
(68, 31, NULL, 30, 0),
(69, 32, NULL, 31, 0),
(72, 35, NULL, 33, 1),
(73, 35, 44, NULL, 1),
(74, 1, NULL, 34, 1),
(75, 1, 45, NULL, 1),
(76, 19, 46, NULL, 1),
(78, 19, 48, NULL, 1),
(79, 19, 49, NULL, 0),
(80, 35, 50, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resepmasakan`
--

CREATE TABLE `resepmasakan` (
  `id_resep` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `nama_resep` varchar(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `porsi` int(11) NOT NULL,
  `bahan_makanan` text NOT NULL,
  `langkah_memasak` text NOT NULL,
  `resep_foto` varchar(50) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT current_timestamp(),
  `update_add` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resepmasakan`
--

INSERT INTO `resepmasakan` (`id_resep`, `id_user`, `nama_resep`, `durasi`, `porsi`, `bahan_makanan`, `langkah_memasak`, `resep_foto`, `create_add`, `update_add`) VALUES
(42, 1, 'Mie Ayam', 16, 1, '500 gr mie basah/mie telor, 250 gr dada ayam potong kecil-kecil, Daun cesim sck, Bawang goreng, Daun bawang sck, 10 bh cabe rawit goreng lalu haluskan, Kecap asin, 500 ml Minyak ayam, Kecap manis, Sauce, 5 siung bawang merah, 5 siung bawang putih, 4 biji kemiri, 1 ruas jahe, Garam, 2000 ml Air, 2 sdt Lada bubuk, 1 sdt Kaldu bubuk, Gula merah sck', 'Pertama masak ayamnya dl cuci lalu potong kecil-kecil,siapkan bumbu (haluskan 2siung bawang merah,2siung bawang putih)panaskan minyak tumis bumbu lalu masukan ayam kasih garam + jahe keprek + gula merah + kecap sck + daun salam,koreksi rasa lalu angkat| Selanjutnya buat kuahnya goreng 3siung bawang putih,3siung bawang merah,4biji kemiri,lalu haluskan,rebus air kl udah mendidih masukan bumbu yg sudah dihaluskan tambah kaldu bubuk + garam,sampai mendidih lagi| Rebus air sampe mendidih lalu rebus mie sama daun cesim| Siapkan dlm mangkok minyak ayam,kecap asin,kecap manis,lada bubuk,selanjutnya masukan mie yg sudah direbus dan cesim lalu diaduk| Tambahkan toping ayam,daun bawang,bawang goreng lalu siram kuah tambah sambal + sauce bila suka,mie ayam siiiap disantap', 'img_27092019020900.jpg', '2019-09-27 14:09:00', '2019-09-27 14:21:02'),
(43, 1, 'Ayam Bakar ala Wong Solo', 30, 4, '1 ekor ayam kampung. potong-potong., 500 ml air kelapa tua, 4 lembar daun salam, 2 batang serai dan memarkan, 2 cm lengkuas dan memarkan, 3 sendok makan gula merah, 4 sendok makan kecap manis, 2 sendok makan air asam Jawa, 6 siung bawang putih, 10 siung bawang merah, 4 cm kunyit, 1/2 sendok teh jinten, 3 cm jahe, garam secukupnya', 'Tumis bumbu halus. Masukkan lengkuas, daun salam dan serai. Tumis hingga harum.| Masukkan daging ayam ke dalam bumbu. Masukkan gula Jawa, kecap, dan air asam Jawa, aduk rata.| Tuang air kelapa dan campur rata. Masak ayam hingga kuah berkurang dan ayam matang. Bakar ayam sambil mengoleskan bumbu hingga kecokelatan.| Hidangkan dengan nasi hangat, sambal dan lalapan.', 'img_27092019055746.jpg', '2019-09-27 17:57:46', '2019-10-09 14:42:02'),
(44, 1, 'Ayam Goreng', 20, 3, '1 Kg ayam, 2 batang serai, 4 lembar daun jeruk, 1 buah jeruk nipis, bumbu halus, 6 buah bawang putih, 7 buah bawang merah, 2 sdt ketumbar bubuk, 3 butir kemiri, 1 ruas jempol kunyit, 1 ruas jempol lengkuas, Garam, Gula, Penyedap rasa', 'Cuci ayam terlebih dahulu sampai bersih lalu perasi eruk nipis supaya bau amis nya hilang| Haluskan semua bumbu halus. Bisa dg blender. supaya cepat halus merata saat sebelum mem blender campurkan sedikit minyak.| Setelah bumbu halus semua, masukkan ke penggorengan bersamaan dg ayam. Beri minyak secukupnya jangan terlalu banyak, Aduk aduk hingga merata seluruh ayam terlumuri dg bumbu halus. Lalu tambahkan setengah gelas kecil air. Aduk rata. Masukkan serai dan daun jeruk purut. Lalu Kecilkan api, tutup wajan biarkan sampai ayam empuk, air habis dan bumbu mengental.| Matikan api apabila air dalam wajan sudah habis dan bumbu mengental.  Ayam Goreng Ungkep (bumbu kuning) langkah memasak 4 foto   | Panaskan minyak di wajan lain, lalu goreng jgn terlalu lama. hingga kuning kecoklatan. Lalu angkat. Sajikan', 'img_27092019060643.jpg', '2019-09-27 18:06:43', '2019-09-27 18:06:43'),
(46, 35, 'Spaghetti Bolognese Ricecooker Ala Anak Kost', 25, 1, '1 kaleng kornet, 1 bungkus saus la fonte bolognese, 1 bungkus spaghetti la fonte, bawang merah bawang putih 1 siung masing2, sudah di iris, bawang Bombay kecil, iris (optional), keju (optional), saus tomat (optional), air minum untuk rebus spaghetti, sedikit garam, sedikit merica', 'Garam sedikit, campur ke air untuk merebus spaghetti. jika sudah mendidih, masuk spaghetti nya. kalau saya, patah2in jadi setengah panjang asli spaghetti nya biar muat di jar rice cooker mini saya. porsi spaghetti atur sesuai selera, tapi ingat kalau sudah di rebus, banyak nya akan double dari yg sebelum di rebus.| Biarkan spaghetti mendidih selama 8 menit sejak masuk rice cooker.| Angkat, buang air nya dan spaghetti taruh di piring.| Masih dengan jar ricecooker yg sama, tuang saus spaghetti sesuai selera banyak nya. tambah sedikit air minum. masukan kornet, bawang merah bawang putih yg sudah di iris, aduk2 dan hancur kan sedikit. tidak perlu lama ya, 2 menit sudah cukup. tuangkan di atas spaghetti.', 'img_28092019060428.jpg', '2019-09-28 06:04:28', '2019-09-28 06:04:28'),
(47, 35, 'Sayur Asam', 25, 2, '2 lt air, 250 gr daging sapi, 150 gr melinjo, 1 genggam daun melinjo (so), 2 lmb kobis, 1 bh jagung manis, 1 bh wortel, 1/2 bh labu siam, 1 batang daun bawang, 1 tangkai daun seledri, 2 ruas lengkuas, 3 lmb daun salam, 3 mata asam jawa, 1 bh tomat, 1 sdt royco rasa sapi, secukupnya Gula merah, 4 btr bawang merah, 4 btr bawang putih, 1/2 sdt terasi matang, 1 bh cabai rawit, 3 bh cabai merah besar', 'Didihkan air, rebus daging sapi hg lunak| Masukan melinjo, jagung manis, wortel, labu siam, asam jawa, lengkuas & daun salam. Masak hingga 1/2 matang.| Masukan sisa sayuran daun dan bumbu halus. Masak hg matang.| Masukan kaldu bubuk & gula. Angkat. Test rasa,...', 'img_28092019061307.jpg', '2019-09-28 06:13:07', '2019-09-28 06:15:43'),
(48, 35, 'Beef Teriyaki ', 30, 3, 'slice Daging sapi, 3 sdm teriyaki untuk marinasi, 1/2 bawang bombay, 3 siung bawang putih, 1 ruas jahe, 3 sdm teriyaki, secukupnya Air, 2 sdm minyak wijen, 2 sdm kecap asin, Sejumput garam', 'Marinasi daging dengan saos teriyaki 3 sdm| Potong bawang bombay dan bawang putih serta jahe| Tumis bawang putih bawang bombay dan jahe| Masukkan daging, teriyaki, minyak wijen, kecap asin, air dan garam. Tunggu hingga mendididih| Sajikan selagi hangat', 'img_28092019062638.jpg', '2019-09-28 06:26:38', '2019-09-28 06:26:38'),
(49, 19, 'Capjay Goreng', 30, 2, '10 udang, 1 wortel besar, 1 brokoli kecil, 1/2 kembang kol, sedikit jamur kuping, sedikit kapri, sedikit jagung muda', 'Cuci sayur dan potong-potong| Tumis bawang putih sampai wangi, masukkan jahe cincang dan udang sampai berubah warna| Masukkan wortel dan air secukupnya, lalu semua bumbu lainnya, cek rasa| Masukkan semua sayuran lainnya kecuali brokoli. Jangan masak terlalu lama, kira-kira sayur sudah setengah matang.| Terakhir masukkan brokoli aduk sebentar lalu larutan maizena. Aduk sampai air berubah agak kental, matikan api.', 'img_30092019061137.jpg', '2019-09-30 06:11:37', '2019-09-30 06:11:37'),
(50, 19, 'Pepes Ikan Pedas', 90, 3, '500 gram ikan tenggiri atau ikan lain yang Anda suka, potong sesuai selera, 2 lembar daun salam, 5 lembar daun jeruk purut, 1 sdm air asam jawa, 100 ml santan kental dan  1 butir kelapa, 10 buah cabe rawit, kemangi seckupny, beberapa lembar daun pisang, beberapa tusuk gigi, 6 butir bawang merah, 2 siung bawang putih, 5 buah cabe merah, 4 buah kemiri, 1 sdt garam, 1/2 sdt garam', 'Campur bumbu halus dengan santan, cabai rawit, daun salam, daun jeruk, air asam jawa, ikan dan kemangi. Aduk hingga rata.| Bungkus ikan dengan bumbu pepes dalam daun pisang, sematkan ujungnya dengan tusuk gigi.| Agar mudah, Anda bisa membungkus masing-masing ikan atau potongan ikan pada daun pisang yang berbeda.| Kukus Pepes Ikan Pedas selama 30 menit, angkat.| Jika suka, Anda bisa memanggang Pepes Ikan Pedas yang masih dibungkus daun pisang. Tidak perlu lama, sebentar saja hingga daun pisang menjadi kehitaman.| Sajikan selagi hangat', 'img_30092019062000.jpg', '2019-09-30 06:20:00', '2019-10-09 13:20:00'),
(51, 19, 'Cah Kangkung', 30, 3, '1 ikat kangkung, 4 siung bawang merah, 2 siung bwg putih, 2 cabe merah besar, 3 cabe rawit, 2 cm lengkuas, 1 lembar daun salam, sedikit asam jawa, 1 sdm margarin, 3 sdm kecap manis, 1 sdm kecp asin, 1 sdm saus tiam, 1 sdt gula pasir, 1/2 sdt garam, 1/4 sdt penyedap masakan, sedikit air', 'Cuci bersih kangkung yang sudah disiapkan, lalu potong-potong sesuai selera.| Iris tipis bawang putih, bawang  merah dan cabe.| Panaskan margarine, kemudian tumis bawang merah dan bawang putih hingga harum, masukkan semua bumbu aduk-aduk.| Tuang sedikit air dan masukkan kangkung.| Jika kangkung sudah matang masukkan penyedap makanan, angkat| *Masak kangkungny jgn lama2 nnt lembek!', 'img_30092019062506.jpg', '2019-09-30 06:25:06', '2019-09-30 06:25:06'),
(52, 19, 'Pecel Lele', 30, 3, '1/2 kg ikan lele, 3 siung bwg putih, 1/2 sdm garam, 1/2 sdt ketumbar, 2 cm kunyit, sedikit air, 1 buah jeruk nipis', 'Cuci bersih lele, lumuri dengan air jeruk nipis (untuk menghilangkan amis).| Haluskan semua bumbu, kemudian beri sedikit air.| Lumurkan lele dengan bumbu-bumbu, rendam 10 menit agar meresap.| Goreng dalam minyak banyak dan panas, hingga kecoklatan. Angkat.| Hidangkan dengan lalap kol, daun kemangi, kacang panjang, terong goreng dan Sambal Tomat.', 'img_30092019062820.jpg', '2019-09-30 06:28:20', '2019-09-30 06:28:20'),
(53, 19, 'Ikan Pindang telur', 30, 5, '10 biji ikan layang pindang (sudah asin, biasanya dalam wadah kotak bambu), 2 siung bwg putih, 1 sdt garam, 1/4 sdt merica, 3 telur, minyak goreng secukupnya', 'Cuci bersih ikan pindang, buang duri tengahnya hingga tinggal daging ikan.| Haluskan semua bumbu, kemudian campur dengan telur, kocok.| Masukkan ikan dalam telur, kemudian goreng di wajan teflon.| Goreng dengan api kecil hingga 1 sisi coklat, baru dibalik sisi satunya. Angkat.', 'img_30092019063021.jpg', '2019-09-30 06:30:21', '2019-10-09 13:18:36'),
(54, 2, 'Martabak Telur Kulit Lumpia', 15, 4, '4 lbr kulit lumpia, 1 bgks mie goreng, 2 butir telur, 1 batang bawang daun potong halus, Secukupnya garam/kaldu bubuk, Secukupnya mentega', 'Rebus mie goreng seperti biasa. Tapi jangan lupa mienya diremas atau dihancurkan dulu sebelum direbus. Mie yang matang disajikan di mangkuk ya biar lebih mudah.| Kocok lepas dua butir telur tambahkan bawang daun dan secukupnya garam/kaldu bubuk.| Campurkan kocokan telur dengan mie yg sudah matang, aduk rata.| Panaskan secukupnya mentega di atas teflon, letakkan selembar kulit lumpia di atas teflon.| Letakkan isian martabak di atas kulit lumpia secukupnya, kemudian lipat menjadi dua.| Bolak-balik hingga martabak matang.| Lakukan hingga adonan isian habis. Kalau saya sih, dengan resep isian segitu bisa jadi 4buah ya..| Isian bisa dikreasi sesuai selera. Mungkin ditambah bakso sapi, sosis, sayuran dsb.', 'img_08092019112119.jpg', '2019-10-04 10:06:22', '2019-10-04 10:07:15'),
(55, 2, 'Soto ayam lamongan', 45, 4, '1/2 dada ayam, 1 buah kentang (potong melingkar), 3 batang sereh, 3 biji kapulaga, 3 lembar daun salam, 3 lembar daun jeruk, Garam, Gula, Royco, Air, 2 ruas jahe, 1 ruas lengkuas, 1 sdt ketumbar, 3 biji kemiri, 3 ruas kunyit, 4 siung bawang putih, 8 siung bawang merah, Bahan tambahan, 2 bungkus soun (rebus), 1/4 kol, Daun bawang, Sambel, Jeruk nipis, Bahan koya, 3 siung bawang putih (goreng lalu tumbuk), 6 biji kerupuk udang (goreng lalu tumbuk)', 'Bersihkan dada ayam dengan perasan jeruk nipis 15 menit lalu cuci bersih.| Rebus dada ayam sebentar lalu air rebusannya buang.| Tumis bumbu yg dihaluskan tambahkan daun salam, jeruk dan sereh masak hingga wangi lalu masukan dada ayam aduk hingga rata.| Kemudian tambahkan air jangan lupa garam, gula, royco dan kapulaga masak hingga matang lalu tes rasa.| Siapkan bahan tambahan lalu tata dimangkok lalu tambahkan koya.', 'img_08092019113819.jpg', '2019-10-04 10:09:14', '2019-10-04 10:09:14'),
(56, 2, 'Silky Puyo Orange', 45, 10, '1 bungkus nutrijell rasa orange, 1000 ml susu UHT, 1 kaleng kental manis, 5 bungkus nutrisari rasa jeruk, 300 ml air matang, Gula pasir (jika suka lebih manis), Cocktail (jika ingin pakai topping)', 'Campurkan susu UHT, kental manis, nutrisari dan air matang. Aduk rata.| Masukkan nutrijell sambil terus diaduk rata. Koreksi rasa (tambah gula jika kurang manis), Rebus hingga mendidih sambil terus diaduk.| Masukkan bubuk Fruity acid setelah api dimatikan.| Tuang ke dalam wadah. Wadah yang digunakan sesuai selera. Saya pakai gelas mini kaca supaya bisa dipakai lagi (tidak langsung buang)| Tunggu hingga uap panas benar-benar hilang baru dimasukkan kulkas. Ini mencegah puyo cepat berair.| Jika suka bisa ditambahkan topping cocktail. Lebih enak.| Setelah dingin puyo siap dinikmati. Selamat mencoba', 'img_08092019122415.jpg', '2019-10-04 10:11:29', '2019-10-04 10:11:29'),
(57, 2, 'Bala-Bala', 20, 10, '2 bh wortel, 1/3 bh kol, 2 btg sledri, 2 btg daun bawang, 2 bh bawang merah, 3 bh bawang putih, 1/4 tepung terigu, Secukupnya air, 1 sdt merica bubuk, 1 1/2 bks royco', 'Parut wortel yg hasilnya sebesar biji korek api, iris kol, daun bawang dan sledri, cuci, tiriskan| Siapkan baskom, tuang terigu kedalamnya, tambahkan semua sayuran dan bumbu juga dua bawang yg sudah di ulek lalu tambah air, aduk rata| Goreng dalam minyak panas sampai kuning keemasan, tiriskan, sajikan', 'img_08092019120018.jpg', '2019-10-04 10:11:29', '2019-10-04 10:11:29'),
(58, 2, 'Salad Buah', 10, 2, '1 Buah Mangga Harum Manis Premium, 1 Buah Apel Fuji, 1 Buah Nanas Madu, 1 Buah Kiwi, 1 Buah Pepaya California Mateng tapi tidak lembek, 1 sdt Perasan Jeruk Nipis, 5 sendok Mayonaise, 2 Sendok Greek Yoghurt, 1 Sendok Madu', 'Cuci bersih semua Buah lalu dikuliti, Potong dadu atau sesuai selera masing-masing buah| Siapkan tempat terpisah untuk mencampur sauce salad, Campurkan Mayonaise, Greek Yoghurt, Madu dan terakhir perasan jeruk nipis| Agar salad bisa disimpan lebih lama jangan lgsg mencampur buah dan sauce saladnya| Tips tambahan juga setelah buah-buah dipotong-potong, Perasin jeruk nipis agar buah tetap segar| Sajikan di Bowl Saji, agar lebih cantik bisa ditambahin irisan buah kiwi dan anggur diatasnya| Selamat Mencoba dan Menikmati', 'img_08092019122301.jpg', '2019-10-04 10:13:59', '2019-10-04 10:13:59'),
(59, 4, 'Mozarella Potato Ball', 90, 6, '1 kg kentang, 1 sdm atau secukupnya garam utk rebus kentang, 2 sdt garam, 1 sdt gula, 4 sdt kaldu bubuk, 2 sdt bawang putih halus, 2 sdm tepung tapioka, secukupnya keju mozarella potong dadu, secukupnya tepung terigu, 1 butir telur kocok lepas, secukupnya tepung panir/roti', 'Cuci bersih kentang, potong dadu. kemudian rebus dengan secukupnya air dan garam, sampai lembut.| Tiriskan dan haluskan kentang.| Campurkan semua bahan adonan kentang.| Ambil segenggam kecil adonan kentang, bentuk pipih.| Isi dengan potongan keju mozarella. kemudian bentuk menjadi bola. lakukan sampai adonan habis.| Lapisi bola kentang dengan tepung terigu, kemudian telur. baluri dengan tepung roti.| Goreng dengan minyak panas dan api sedang.', 'img_08092019112736.jpg', '2019-10-04 17:14:42', '2019-10-04 17:14:42'),
(60, 4, 'Mashed Potato Mozarella', 90, 1, '2 buah kentang, Secukupnya keju disini aku pake mozarella dan keju kraft biasa, Secukupnya garam dan merica, 1 sdt margarin', 'Rebus 2 buah kentang sampai matang, setelah direbus buang kulitnya dan haluskan| Campur semua bahan mentega, garam, merica bubuk dan keju| Kukus kembali mushed potato supaya mozarellanya lebih meleleh, taraaa enak dimakan selagi anget', 'img_08092019113449.jpg', '2019-10-04 17:15:49', '2019-10-04 17:15:49'),
(61, 4, 'Baked Garlic Parmesan Potato Wedges', 60, 1, '3-4 buah kentang yang telah teriris berbentuk potato wedges, ½ cangkir keju parut parmesan, 4 sendok makan minyak zaitun, 4 buah bawang putih, 1 sdt ketumbar, 2 sdt garam, Blackpaper secukupnya, Daun parsley sebagai pelengkap', 'Cuci bersih kentang kemudian tiriskan| Olesi kentang dengan minyak zaitun dan bumbu-bumbu yang telah dihaluskan (bawang putih, ketumbar, dan garam)| Diamkan 15 menit hingga meresap| Taburi adonan kentang tersebut dengan parsley kering dan tambahkan blackpaper (optional)| Panggang adonan kentang tersebut dengan suhu 190 derajat celcius sampai berwarna golden brown| Setelah berwarna cantik, angkat dan sajikan beserta mayonaise dan saus sambal', 'img_08092019114343.jpg', '2019-10-04 17:16:40', '2019-10-04 17:16:40'),
(62, 14, 'Pempek Panggang', 90, 40, '1/2 kg ikan tenggiri giling, 300 gr sagu cap tani, 2 sdt garam halus, 150 ml air es, 1/2 ons udang rebon, 1/2 ons cabe rawit, Kecap manis', 'Masukkan ikan giling, garam dan air es lalu aduk rata| Tambahkan sagu lalu aduk kembali sampai tercampur rata| Bentuk adonan bulat pipih (gunakan sagu untuk melumuri tangan) lalu panggang sampai matang/merekah (jgn lupa dibalik)| Bila sudah matang angkat dan belah tengahnya (jgn sampai putus)| Setelah dibelah tambahkan isian dan sajikan bersama cuko selagi hangat| Isian pempek : udang rebon yg telah disangrai dan dicincang halus, cabe rawit giling dan kecap manis', 'img_08092019120516.jpg', '2019-10-04 17:17:31', '2019-10-04 17:17:31'),
(63, 14, 'Brownies Kukus Coklat', 60, 10, '300 gr coklat batang, 75 gram coklat bubuk, 200 gram tepung terigu, 200 ml susu segar, 300 gram mentega, 6 butir telur ayam, 250 gram gula pasir, 1 sdt garam, 1 sdt baking powder', 'Tim coklat batang dan mentega pada panci yang sama. Setelah leleh tambahkan garam. Aduk sampai rata.| Siapkan wadah untuk mengocok telur. Kocok telur dengan gula pasir hingga berbusa.| Masukkan coklat dan mentega yang telah dilelehkan perlahan-lahan bersamaan dengan susu. Aduk sampai rata.| Kemudian tambahkan tepung terigu sedikit demi sedikit. Aduk hingga rata.| Tuang adonan ke dalam 2 loyang. Sebelumnya olesi dulu loyang dengan mentega.| Kukus selama 20 menit atau sampai matang.| Olesi kue dengan coklat batang dan mentega yang dilelehkan lalu tumpuk. Brownies siap disajikan.', 'img_08092019120401.jpg', '2019-10-04 17:18:26', '2019-10-04 17:18:26'),
(64, 14, 'Sayur Kangkung', 45, 2, '1 ikat kangkung siangi, 3 siung bawang putih iris tipis, 2 siung bawang merah iris tipis, 3 buah cabai rawit iris serong, Garam secukupnya, Gula secukupnya, Kaldu ayam bubuk secukupnya, Saus tiram secukupnya, Minyak secukupnya', 'Panaskan minyak lalu tumis bawang putih dan bawang merah hingga harum, Tambahkan cabai rawit dan sayur kangkung lalu aduk rata.| Tambahkan garam gula dan kaldu ayam secukupnya.| Tambahkan sedikit air agar sayur kangkung lekas matang dan empuk.| Tambahkan saus tiram.| Koreksi rasa, masak hingga matang sesuai selera.| Siap disajikan.', 'img_08092019122042.JPG', '2019-10-04 17:19:36', '2019-10-04 17:20:02'),
(65, 24, 'Semanggi Enak Khas Surabaya', 10, 1, '2 ikat kangkung pot rebus, 1/4 kg kecambah rebus, 1 kg ubi putih rebus kupas halus, 2 genggam kacang tanah goreng, 6 siung bawang putih iris goreng kering, 1 sendok makan gula pasir, 1 1/2 lingkaran besar gula merah sisir, petis udang, sambal, kerupuk puli', 'potong-potong kacang tanah + bawang putih goreng sampe runyah| Aduk gula merah, gula pasir dengan sedikit air matang sampai rata & larut| Campur ubi dengan campuran kacang aduk rata lalu tuang campuran gula merah aduk sampai rata (Boleh tambahkan sedikit air matang bila adonan ubi kurang lembek)| PENYAJIAN : Ambil bumbu semanggi tambahkan sambal & air matang secukupnya aduk rata. Lalu siram diatas sayuran (Semanggi, kangkung, kecambah). Sajiakan dengan kerupuk puli| tambahkan petis sesuai selera', 'img_09092019084538.jpg', '2019-10-04 17:20:51', '2019-10-04 17:20:51'),
(66, 24, 'Rujak Cingur Khas Surabaya', 15, 1, '2 sendok makan kacang goreng, 1/2 sendok teh garam, 1 sendok teh gula merah, 2 buah cabe rawit, 1/2 buah pisang batu diparut, 1 sendok teh petis udang, 1/2 sendok teh petis ikan, 1/2 sendok teh terasi, 1 sendok makan air asam, 2 siung bawang putih goreng, lontong atau ketupat, cingur atau kulit sapi, kangkung, kacang panjang, tauge, mentimun, bengkoang, nanas, mangga muda, kedondong, tahu goreng, tempe goreng, kerupuk', 'Uleg semua bahan bumbu rujaknya hingga halus.| Rebus kangkung, tauge, kacang panjang sampe matang. Lalu tiriskan| Untuk bumbu cingur bawang putih, kunyit, garam di hapuskan lalu direbus bersama cingur hingga empuk dan bumbu meresap. Angkat dan tiriskan setelah itu goreng cingur sebentar dengan minyak panas.| Untuk menyajikan rujak. Tata sayuran yg sudah direbus tambahkan irisan bengkuang, mentimun, nanas, kedondong, tahu, tempe dan cingur diatas piring. Kemudian siram dengan bumbu rujak yg telah diuleg halus. Lengkapi denga kerupuk agr lebih nikmat saat disantap.', 'img_09092019085117.jpg', '2019-10-04 17:22:10', '2019-10-04 17:22:10'),
(67, 24, 'Tempe Mendoan Crispy', 10, 1, '3 bungkus tempe, 12 sendok makan tepung terigu, 1 sendok makan tepung maizena, 1 sendok makan tepung beras, 1/2 sendok teh baking powder, 2 batang daun bawang, 3 siung bawang putih, 1 sendok teh ketumbar, 2 cm kunyit, garam secukupnya, kaldu ayam bubuk secukupnya', 'Siapkan tempe, potong tempe menjadi lembaran tipis. Saya menggunakan tempe kotak dan saya potong menjadi 5 bagian untuk 1 bungkusnya.| Haluskan bumbu. Campur jadi satu dengan terigu, maizena, tepung beras, baking powder, air, dan daun bawang hingga didapat adonan yg kental.| Celupkan tempe ke adonan kemudian goreng pada minyak yang panas dan banyak.', 'img_09092019085440.jpg', '2019-10-04 17:23:04', '2019-10-04 17:23:04'),
(68, 32, 'Nasi goreng spesial', 20, 1, 'Nasi 600 gr, Daging ayam 125 g. Cincang halus, Telur 1 butir. Kocok, Bawang merah 5 siung, bawang putih 3 siung, Cabai merah 3 buah, Daun bawang 1 batang. Iris halus, Kecap manis 2 sdm, Garam 1 sdt, Merica ¼ sdt, Minyak', 'Masukkan bawang merah, bawang putih, dan cabai merah ke dalam cobek kemudian haluskan.| Goreng telur menjadi orak-arik lalu sisihkan.| Bumbu yang telah dihaluskan kemudian di tumis dengan minyak secukupnya. Tumis terus hingga harum.| Masukkan ayam cincang, telur, dan daun bawang ke dalam bumbu. Tumis lagi hingga merata.| Tambahkan kecap, garam, dan merica. Aduk hingga rata.| Baru kemudian masukkan nasi dan aduk hingga rata.| Nasi goreng telah jadi dan sajikan pada piring saji.', 'img_06102019122845.jpg', '2019-10-06 12:27:58', '2019-10-06 12:28:45'),
(69, 32, 'Dadar tahu', 10, 1, '2 butir Telur, Tahu 2-3potong atau sesuai selera, 1 batang Daun bawang, sesuai selera Cabe rawit, secukupnya Kaldu bubuk ayam non msg, Merica secukupnya', 'Kocok telur, kaldu bubuk, merica. Masukkan tahu dan hancurkan. Masukkan daun bawang dan cabe rawit. Kocok lagi sebentar.| Goreng dadar tahu dengan api kecil dan tutup wajan supaya telur nya bagian dalam matang. Sajikan.', 'img_06102019124223.jpg', '2019-10-06 12:42:02', '2019-10-06 12:42:23'),
(70, 32, 'Jengkol balado pedas', 20, 4, '1/2 kg Jengkol tua, 15 cabe rawit, 4 bawang merah, 3 bawang putih, 2 buah tomat, 1 buah gula merah, 2 serai, 4 daun salam, secukupnya Gula pasir, secukupnya Garam, secukupnya Penyedap, 300 ml air', 'Rebus jengkol dengan serai dan daun salam selama 1 jam agar benar benar empuk dan baunya tidak menyengat| Setelah selesai direbus ditiriskan dan pipihkan agar nanti bumbu dapat merasuk sempurna| Haluskan bumbu : bawang merah, bawang putih, cabe rawit, garam, gula, penyedap,tomat, lalu ditumis sampai harum| Setelah bumbu ditumis & harum masukkan jengkol diaduk\" sampai merata| Tambahkan air 300ml, lalu sesekali diaduk agar bumbu meresap semua, setelah air menyusut, cek rasa,dan siap disajikan', 'img_06102019124735.png', '2019-10-06 12:46:02', '2019-10-09 09:35:26'),
(71, 32, 'Indomie carbonara', 20, 1, '2 bks mie instan (saya Indomie Ayam Bawang), 1 buah bawang bombay kecil iris dadu, 3 siung bawang putih cincang, 2 buah cabe rawit iris halus, 3 buah sosis, 2 sdm kornet beef, 300 ml susu cair, 2 bks bumbu mie instan, Sejumput gula pasir, 2 sdm tepung terigu, Secukupnya keju cheddar, 2 sdm margarin untuk menumis, Secukupnya keju parut, Secukupnya bubuk cabe (Boncabe)', 'Rebus mie instant seperti biasa. Sisihkan.| Dalam teflon, lelehkan mentega dan masukkan bawang bombay dan bawang putih, tumis hingga harum. Masukkan kornet, sosis dan cabe rawit aduk rata. Tumis hingga sosis agak matang. Tuang bumbu mie instan aduk kembali.| Tuangkan susu cair dan masukkan keju parut. Tambah sejumput gula dan lada. Lakukan test rasa.| Masak hingga mendidih dan tambahkan tepung terigu aduk rata hingga mengental. Masukkan mie dan aduk hingga rata.| Tuang dalam piring, tambahkan keju parut dan cabe bubuk. Siap disantap.', 'img_06102019010409.png', '2019-10-06 13:03:51', '2019-10-06 13:04:09'),
(72, 32, 'Orak arik buncis wortel', 15, 2, '1/4 kg buncis, 1 buah wortel, 2 butir telur, 3 siung bawang putih, 4 siung bawang merah, secukupnya Garam, secukupnya Gula pasir, 1 lembar daun jeruk, 1 sendok teh lada', 'Iris buncis dan wortel serong.| Cuci bersih sayur.| Iris tipis tipis bawang putih dan bawang merah.| Siapkan wajan untuk menumis.| Masukkan sedikit minyak goreng.| Tumis lada, bawang putih dan bawang merah sampai harum.| Masukkan sedikit air. Tunggu hingga mendidih.| Masukkan sayuran yang sudah dicuci ke dalam wajan, hingga setengah matang.| Tambahkan 1 lembar daun jeruk. Masukkan dua butir telur sambil diaduk agar merata.| Tunggu hingga matang. Angkat dan sajikan.', 'img_06102019011439.png', '2019-10-06 13:13:33', '2019-10-06 13:16:09'),
(73, 18, 'Mi goreng ', 20, 1, 'Baput cincang, Mi telor burung dara rebus, Telur ayam, Sawi, Sosis, Saos tomat, Kecap manis, Minyak wijen, Kecap asin/kecap ikan, Saos Raja rasa, Kaldu ayam/sapi', 'Rebus mi hingga mtg tp tdk benyek,tiriskan.. beri minyak wijen dan kecap manis,aduk rata.. sisihkan.| Tumis baput hingga harum,masukkan pelengkap (sawi,di susul ayam,sosis,dll),aduk rata.| Beri saos2an + penyedap rasa sapi dikit.. kasih kuah kaldu biarkan mendidih..tes rasa.| Masukkan mi,aduk rata,sesuaikan rasanya.| Tambahkan air kaldu jika mi kurang empuk ya mom.. lalu aduk2 hgga empuk,boleh tmbah dikit minyak goreng supaya glossy.. tunggu hingga aroma mi matang. Done', 'img_06102019012337.png', '2019-10-06 13:23:14', '2019-10-06 13:23:37'),
(74, 18, 'Asem asem iga sapi', 20, 2, '1 kg Iga Sapi, 8 siung bawah merah, 6 siung bawang putih, secukupnya Lada bubuk, 2 buah tomat, 10 cabe', 'Jadi iga sapi nya di presto dulu sekiranya sampek empuk, sambil nunggu iga sapi, bamer, baput tomat nya di rajang kasar.| Kaldu dari iga tadi dibuat kuah trus di masukkan bahan yang dirajang tadi, masukkan tambahan air iga,cabe sampai mendidih ditambahkan garam sama lada bubuk.| Jadi deh.', 'img_06102019012822.jpg', '2019-10-06 13:27:44', '2019-10-06 13:28:22'),
(75, 18, 'Ayam rica-rica', 20, 2, '250 gr dada ayam tanpa tulang potong dadu, 1/2 ikat daun kemangi ambil daun nya saja, 150 ml air, 2 siung bawang putih, 4 siung bawang merah, 2 buah cabe (sesuai selera), 1 buah kemiri, 1 ruas kunyit, 1 ruas jahe, 1/2 sdt garam, 1 sdt kaldu ayam, 1 sdt merica bubuk, 1/4 potong gula jawa, 1/4 potong bawang bombay iris memanjang, 2 lembar daun jeruk iris halus, 1/2 batang sereh iris halus, 1/2 lembar daun bawang iris halus, 1/2 lembar daun pandan iris acak, 1/2 cm Lengkuas ukuran sedang', 'Siapkan semua bahan²| Pertama panaskan minyak, masukan bawang bombay tumis sampai harum| Tambahkan bumbu halus, masak sampai matang dan harum| Masukan bumbu iris kecuali daun bawang, tambahkan ayam, masak sampai berubah warna| Tambahkan air dan bumbu rasa aduk rata tunggu sampai agak menyusut airnya dan ayam matang, jangan lupa test rasa| Setelah ayam matang, tambahkan daun bawang dan daun kemangi aduk sebentar dan matikan kompor, ayam rica2 siap dihidangkan', 'img_06102019013534.png', '2019-10-06 13:35:13', '2019-10-06 13:35:34'),
(76, 18, 'Sate ayam merah', 30, 3, 'Daging ayam 1 kg (3/4 bagian daging dan 1/4 bagian kulit), Cabai 150 gram (cabai merah atau cabai rawit), 150 gram Gula merah, secukupnya Bawang putih, secukupnya Bawang merah, secukupnya Terasi, Jeruk nipis, Gula pasir, Garam, Merica, Lada, Kecap (sesuai selera)', 'Uleg semua bumbu hingga halus. Bisa ditambahkan atau dikurangi sesuai selera| Tumis bumbu dengan minyak selama 30 menit atau hingga harum| Daging ayam dipotong dadu (berkisar 2x2cm) dan direndam dengan bumbu yang sudah ditumis selama 3 jam. Rendam daging ayam dalam wadah tertutup dan dapat disimpan di kulkas atau di suhu normal| Setelah selesai direndam, daging ayam ditusuki dengan tusuk sate. Satu tusuk sate, komposisinya 3 potongan ayam dan 1 potongan kulit. Atau bisa sesuai selera| Panasi arang batok lalu bakar sate ayam yang sudah ditusuki selama kurang lebih 15 menit. Pastikan sate ayam dibakar hingga minyaknya keluar. Saat dibakar, oleskan beberapa kali bumbu merah yang digunakan untuk merendam ayam.| Sate ayam merah sudah siap dihidangkan. Sajikan dengan nasi putih hangat', 'img_06102019014550.jpg', '2019-10-06 13:45:29', '2019-10-06 13:45:50'),
(77, 18, 'Pindang telur', 20, 6, '6 btr telur ayam, Bumbu rempah, 2 lbr daun salam, 1 cm lengkuas, 1 ptg lengkuas geprek Bumbu halus, 6 sg bawang merah, 4 sg bawang putih, 4 btr kemiri, 4 bh cabe merah buang bijinya, secukupnya Garam, Secukupnya gula, secukupnya lada bubuk, secukupnya kecap, secukupnya Kaldu bubuk', 'Siapkan bahan| Tumis bumbu halus smp.harum tambahkn bumbu rempah.tumis smp harum tambahkan air aduk rata.masukan gula garam kecap,lada bubuk dn kaldu bubuk.masukan telur masak sampai air menyusut.| Bisa dsesuaikan tingkat kekentalan nya.koreksi rasa angkat sajikan', 'img_06102019015618.jpg', '2019-10-06 13:54:47', '2019-10-06 13:56:52'),
(78, 18, 'Sambal goreng terong', 20, 3, '3 buah terong ungu. potong-potong. goreng. sisihkan, 6 siung bawang putih. iris tipis, 8 siung bawang merah, 15 buah cabai merah keriting, 1 buah tomat, 3 lembar daun salam, 2 lembar daun jeruk, Garam, Gula merah, Minyak untuk menumis', 'Haluskan bawang merah, cabai merah dan tomat. Sisihkan.| Panaskan minyak, tumis irisan bawang putih hingga layu. Kemudian masukkan cabai yang telah dihaluskan, daun jeruk, daun salam, gula merah dan garam. Aduk hingga air menyusut.| Kemudian masukkan irisan terong yang telah digoreng tadi, aduk sebentar.| Angkat dan sajikan.', 'img_06102019021505.jpg', '2019-10-06 14:13:11', '2019-10-09 09:15:53'),
(79, 33, 'Penyetan Sambel terasi udang', 30, 3, '25 buah cabai rawit merah, 15 buah cabai rawit ijo, 8 siung bawang merah, 4 siung bawang putih, 1 tomat sedang, 2 bungkus terasi, udang', 'Bahan di atas goreng semua sampai agak layu| Uleg jangan halus-halus beri garam dan gula sesuai rasa yang diinginkan| Tinggal siapkan lauk bisa tempe goreng, telur rebus, ayam, udang, dan lain-lain. ', 'img_06102019023118.jpg', '2019-10-06 14:31:18', '2019-10-06 14:31:18'),
(80, 33, 'Indomie seblak macaroni', 30, 2, '1 bungkus Indomie (mi rasa ayam bawang) rebus, 30 gram macaroni rebus tiriskan, sedikit kerupuk bawang mentah rendam air panas hingga empuk beri sedikit minyak supaya tidak lengket, secukupnya daun bawang iris, 1 buah sosis iris, 1buah telur kocok lepas, 2 gelas air, sedikit garam, gula, bumbu indomi, 3 bawang merah, 2 bwg putih, 5 cabe merah keriting, 3 rawit , 1 cm kencur', 'Tumis bumbu halus dengan sedikit minyak| masukkan air, setelah mendidih masukkan kocokan telur diaduk| masukkan macaroni, lalu sosis kerupuk dan mi, beri gula garam bumbu indomi| Aduk rata test rasa angkat sajikan taburi dengan daun bawang', 'img_06102019023759.jpg', '2019-10-06 14:37:59', '2019-10-09 09:11:24'),
(81, 33, 'Jengkol Kalio', 30, 3, '20 biji jengkol tua, 500 gram santan, 6 butir telur, 1/2 ons teri besar, 100 gr cabe merah, 8 siung bwg merah, 3 siung bwg putih, 1 ruas jari kunyit, 2 ruas jari jahe, 4 ruas jari lengkuas, 3 lembar daun jeruk, 2 lembar daun jeruk, 1 batang serai, garam secukupny', 'Rebus jengkol dan telur| Lalu giling bumbu,cabe,b.merah, b.putih, kunyit,jahe,lengkuas nya digeprek aja| Campur santan dan bumbu giling lalu masak| Jangan lupa masuk kan daun salam, daun jeruk dan serai| Masuk kan langsung jengkol yang udah di geprek dan telur    | Setelah mendidih masukan ikan teri nya.... Lalu masak hingga sampai keluar minyak', 'img_06102019030016.jpg', '2019-10-06 15:00:16', '2019-10-06 15:00:16'),
(82, 33, 'Sambal Goreng Ati', 30, 3, '1/2 kg ati ayam, 2 bh kentang, 7 siung bwg merah, 7 siung bwg putih, 2 bh cabe, 1/2 sdt garam, 1/4 sdt terasi, secukupny kaldu bubuk, secukupnya saos raja sasa, secukupnya saos tiram, minyak goreng', 'Potong dan cuci Kentang, Wortel, Ati ayam. Lalu digoreng, sisihkan.| Iris bawang merah, bawang putih dan cabe. Garam dan terasi dicampur rata.| Panaskan minyak, goreng duo bawang sampai mendekati kering. Buang Minyak nya dulu. Masukkan cabe, Aduk sebentar. Kali masukkan Terasi+garam, lanjut masukkan Kentang, Wortel dan ati, aduk2. Tambahkan kaldu bubuk, saos raja rasa, saos tiram. Koreksi rasa.', 'img_06102019030510.jpg', '2019-10-06 15:05:10', '2019-10-06 15:05:10'),
(83, 33, 'Makarel cepat Saji', 20, 3, 'bawang putih, cabai, makarel kaleng', 'tumis bawang putih, cabe| masukkan makarel', 'img_06102019030746.jpg', '2019-10-06 15:07:46', '2019-10-06 15:07:46'),
(84, 33, 'Sempol Ayam', 30, 3, '375 gr daging ayam giling halus, 200 gr tepung tapioka, 2 butir telur, 1 buah wortel parut, 2 sdt garam, 1 sdt garam, 1 sdt gula, 1 sdt kaldu jamur, 3 sdm tepung roti, iris cabai rawit, --bahan Pelapis--, tepung roti secukupnya, 5sdm tepung bumbu, cairkan dengan air secukupnya', 'Campur daging ayam giling dengan semua bahan, kecuali cabai. aduk sampai tercampur rata. atau jika menggunakan food processor blend sampai semua menyatu membentuk adonan.| Bagi 2 adonan yang original dan yang ditambahkan cabai rawit iris.| Basahi tangan dengan minyak. ambil adonan, tusuk dengan tusuk sate. lakukan sampai adonan habis.| Rebus sempol dengan air mendidih sekitar 5 menit. Angkat tiriskan.| Beri lapisan teung roti dengan mencelup ke larutan tepung kemudian balur tepung roti. Goreng hingga kecoklatan dengan api sedang.', 'img_06102019031203.jpg', '2019-10-06 15:12:03', '2019-10-06 15:12:03'),
(85, 19, 'Ayam Goreng', 30, 3, '½ ekor ayam, potong–potong sesuai selera,  3 siung bawang putih , ½ sdm garam , ½ sdt ketumbar,  2 cm kunyit,  Sedikit air', 'Cuci bersih daging ayam.| Haluskan semua bumbu, kemudian beri sedikit air.| Lumurkan ayam dengan bumbu-bumbu hingga rata, rendam 10 menit agar bumbu meresap.| Goreng dengan api sedang hingga kuning kecoklatan. Angkat.', 'img_06102019031836.jpg', '2019-10-06 15:18:36', '2019-10-06 15:18:36'),
(86, 19, 'Tahu Telur', 30, 3, '3 potong tahu kotak putih. potong–potong 1x1x1/2 cm ., 4 butir telur,  ½ sdt garam , ¼ sdt merica bubuk,  1 siung bawang putih, Sambal Kacang kecap, bumbu pecel yg sdh jadi, kecap secukupnya, air panas secukupnya', 'Kocok telur dengan semua bumbu hingga merata.| Masukkan tahu, aduk hati-hati agar tahu tidak hancur| Bagi 2 adonan (agar tidak susah membaliknya).| Goreng ½ adonan dengan sedikit minyak dalam api kecil dan wajan anti lengket.| Tunggu hingga 1 sisi matang kecoklatan, baru dibalik. Tunggu matang sisi berikutnya, angkat. Goreng ½ adonan sisanya.| Untuk sambal kacang kecap :Campur bumbu sambal pecel dengan air panas, aduk hingga rata. Tuangkan kecap. Siramkan keatas tahu telur.', 'img_06102019032144.jpg', '2019-10-06 15:21:44', '2019-10-09 14:44:58'),
(87, 19, 'Udang Goreng Mentega', 30, 3, '½ kg udang galah ukuran agak kecil aja ,  2 siung bawang putih,   1 sdt garam,  1/4 sdt merica,   1 buah bawang bombay ,  2 sdm margarine untuk menumis,   1 sdm minyak wijen,   2 sdm kecap manis,  1 sdm kecap asin , ½ sdt gula,   ½ sdt Royco ayam ,  Air secukupny', 'Cuci udang buang kepalanya. Iris halus bawang bombay. Haluskan garam, merica dan bawang putih. Kemudian panaskan margarine dan minyak wijen, tumis bawang bombay dan bawang putih halus, masukkan udang dan air, tunggu hingga udang matang. Masukkan semua kecap, gula dan penyedap. Angkat.', 'img_06102019032848.jpg', '2019-10-06 15:28:48', '2019-10-06 15:28:48'),
(88, 19, 'Puding Coklat', 30, 3, 'susu cair tawar 800 ml , coklat bubuk 20 gr,  gula pasir 125 gr,  agar-agar bubuk 1 bungkus,  dark cooking chocolate 100 gr (dipotong-potong),  telur 1 butir (gunakan kuningnya saja),  garam 1/8 sdt', 'Siapkan panci lebih dahulu. Masukkan susu cair, coklat bubuk, gula pasir, garam, dan agar-agar bubuk| Gunakan nyala api sedang pada kompor Anda. Aduk adonan perlahan-lahan sampai mendidih.| Potongan dark cooking chocolate dimasukkan, aduk-aduk adonan hingga larut dan tercampur rata.| Matikan api kompor dulu| Siapkan kuning telur dalam mangkok, lalu tuangkan sedikit rebusan adonan diatas ke dalamnya, aduk sampai merata.| Lalu masukkan campuran kuning telur tersebut ke dalam panci berisi rebusan adonan pertama.| Gunakan api sedang untuk memasak rebusan adonan hingga mendidih sambil diaduk-aduk. | Matikan api kompor lalu tuang cairan rebusan adonan ke dalam cetakan.| Biarkan dulu adonan puding selama 30 menit| Bila adonan sudah dingin, masukkan ke dalam kulkas.| Saat adonan sudah mengeras, maka puding coklat siap dihidangkan.', 'img_06102019033906.jpg', '2019-10-06 15:39:06', '2019-10-06 15:39:06'),
(89, 27, 'Capcay bakso seafood', 20, 2, '1/2 Brokoli, 3 siung bawang putih (parut cacah), 1-2 iris jahe (saya 1 iris jaheny besar), 6 buah bakso seafood, 3 helai sawi putih (skip lg g ada), 1 buah Pokcoy (potong2 pengganti sawi), 1 buah wortel sedang, 3 buah baby corn (skip lagi abis), 1 batang daun bawang. 2 sdm saos tiram, 1 sdm kecap asin, 1 sdm kecap ikan, 2 sdm minyak wijen, 1 sdt kaldu jamur, Secukupnya gula, Secukupnya lada putih bubuk, 250-300 ml air (tergantung selera y mau banyak air apa gak), 1 sdm Tepung maizena (+ 20-30 ml air), 1 sdm Tepung maizena (+ 20-30 ml air)', 'Bahan yang disiapkan(maaf brand g harus sama y ?) btw brokoli saya potong2 lalu dibersihkan| Panaskan olive oil (4-5 sdm) lalu tumis bawang putih hingga harum, lalu masukkan bakso, jahe dan daun bawang| Masukkan sayur2anny aduk2, lalu beri bumbu2 kecap asin, kecap ikan, saos tiram, minyak wijen aduk2 hingga rata, kemudian tambahkan air, aduk rata beri lada bubuk dan kaldu jamur, koreksi rasa.| Tambahkan tepung maizena aduk2 hingga mengental. Siap disajikan.| Setelah koreksi rasa baru penambahan tepung maizena nya y, jangan setelah nya. Penambahan tepung maizena itu udh finishing nya ya| Tambahkan tepung maizena aduk2 hingga mengental. Siap disajikan.| Setelah koreksi rasa baru penambahan tepung maizena nya y, jangan setelah nya. Penambahan tepung maizena itu udh finishing nya ya', 'img_07102019015116.jpg', '2019-10-07 01:50:56', '2019-10-07 01:51:16'),
(90, 27, 'Tumis tempe kacang panjang', 20, 2, '1 1/2 papan tempe, 10 lajur kacang panjang, 7 siung bawang merah, 3 siung bawang putih, 3 buah cabe merah besar, 17 buah cabe rawit, 1 cm lengkuas, 1 sdt garam, 1/2 sdt kaldu ayam bubuk, 4 sdm kecap manis, 2 buah tomat', 'Potong dadu tempe kemudian goreng| Sambil menunggu tempe iris tipis cabe merah, cabe rawit, bawang putih, bawang merah dan tomat. Kemudian geprek lengkuas| Setelah tempe matang, tumis bumbu iris kecuali tomat. Oseng sebentar sampai harum kemudian masukkan tomat. oseng lagi sampai sedikit layu dan harum| Potong-potong kacang panjang kemudian masukkan dan campur dengan bahan yg telah di oseng. Ungkep selama ±5 menit dengan di oseng sesekali agar tidak gosong.| Terakhir masukkan tempe yg sudah digoreng bersama dengan garam, gula kaldu ayam bubuk dan kecap. Kemudian aduk sampai rata. Oseng sebentar dan siap disajikan', 'img_07102019015537.png', '2019-10-07 01:55:23', '2019-10-07 01:55:37'),
(91, 27, 'Sup ayam', 15, 1, '1 potong Ayam, 2 Ati Ampela, 1 biji Kentang, biji Wartel1, 2 Bawang Putih, 1/2 sendok teh Merica biji, Air, Bawang merah goreng, Daun seledri, Daun bawang', 'Siapkan bahannya.. bawang merah dan merica biji sudah dihaluskan..| Tumis bahan tumisan sampai wangi, setelah wangi masukkan Air..| Masukkan kentang, wartel dan ayam.. biarkan sampai kentang mateng.. baru di angkat| Setelah itu sajikan.. taburi bawang goreng, daun bawang dan daun seladri..', 'img_07102019015856.jpg', '2019-10-07 01:58:36', '2019-10-07 01:58:56'),
(92, 27, 'Ceker bumbu sederhana', 15, 2, '1/4 kg Ceker, 4 b. Merah, 2 b. Puttih, Cabe kriting, Cabe rawit, Ladaku, Sasa, Royco, Sedikit gula merah (sesuai selera), Sasa', 'Berihkan ceker dari kulitnya dan kukunya kemudian rebus sampe matang.| Siapkan bumbu Ulek b.putih b.merah dan cabe rawit| Masak bumbu yang sudah di ulek sampe harum kemudian beri sedikit air ketika mendidih masukan ceker yang sudah di rebus selesai dan hidangkan', 'img_07102019020243.jpg', '2019-10-07 02:01:56', '2019-10-07 02:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `teman`
--

CREATE TABLE `teman` (
  `id_teman` int(12) NOT NULL,
  `id_usera` int(12) NOT NULL,
  `id_ikuti` int(12) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT current_timestamp(),
  `update_add` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teman`
--

INSERT INTO `teman` (`id_teman`, `id_usera`, `id_ikuti`, `create_add`, `update_add`) VALUES
(15, 3, 2, '2019-09-05 23:29:36', '2019-09-05 23:29:36'),
(16, 2, 3, '2019-09-08 14:13:07', '2019-09-08 14:13:07'),
(17, 14, 2, '2019-09-08 12:26:56', '2019-09-08 12:26:56'),
(18, 2, 14, '2019-09-08 12:28:41', '2019-09-08 12:28:41'),
(19, 24, 1, '2019-09-09 08:37:44', '2019-09-09 08:37:44'),
(20, 24, 15, '2019-09-09 08:37:58', '2019-09-09 08:37:58'),
(21, 1, 24, '2019-09-09 14:08:07', '2019-09-09 14:08:07'),
(22, 1, 4, '2019-09-09 15:02:28', '2019-09-09 15:02:28'),
(23, 1, 19, '2019-09-09 15:45:03', '2019-09-09 15:45:03'),
(24, 19, 1, '2019-09-09 15:46:14', '2019-09-09 15:46:14'),
(27, 32, 31, '2019-09-27 13:52:08', '2019-09-27 13:52:08'),
(28, 31, 32, '2019-09-27 14:03:35', '2019-09-27 14:03:35'),
(29, 1, 33, '2019-09-27 14:19:00', '2019-09-27 14:19:00'),
(30, 1, 31, '2019-09-27 14:28:37', '2019-09-27 14:28:37'),
(31, 1, 32, '2019-09-27 14:28:47', '2019-09-27 14:28:47'),
(33, 1, 35, '2019-09-28 07:28:29', '2019-09-28 07:28:29'),
(34, 35, 1, '2019-09-30 07:12:41', '2019-09-30 07:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `user_foto` varchar(50) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT current_timestamp(),
  `update_add` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jenis_kelamin`, `username`, `password`, `email`, `nomor_telepon`, `user_foto`, `create_add`, `update_add`) VALUES
(1, 'Wunsel Arto Negoro', 'Laki-laki', 'wunselan', '1234', 'wunselan@gmail.com', '082222222', 'img_16102019015021.JPG', '2019-07-30 21:36:55', '2019-10-16 13:50:21'),
(2, 'Rizki', 'Laki-laki', 'rizki2500', '123', 'rizki@gmail.com', '081231231321', 'img_08092019111007.jpg', '2019-07-30 21:56:15', '2019-09-09 16:50:02'),
(3, 'albert', 'Laki-laki', 'albert', '123', 'al@gmail.com', '123', 'img_05092019062335.jpeg', '2019-09-05 23:23:35', '2019-09-09 16:35:19'),
(4, 'Chef Jamet', 'Laki-laki', 'chefjamet', 'qwe123', 'chefjamet@digiwork.com', '085372947271', 'img_08092019010807.jpg', '2019-09-08 11:14:41', '2019-09-09 16:35:23'),
(14, 'Masayu Vidya', 'Perempuan', 'Msyvidya', 'msyvidya', 'Vidya@gmail.com', '085279013475', 'img_08092019122927.jpg', '2019-09-08 11:27:48', '2019-09-08 12:29:27'),
(15, 'chef ganang', 'Laki-laki', 'Ganang', 'ganang', 'ganang07@gmail.com', '082211215277', 'img_08092019053423.jpg', '2019-09-08 11:39:52', '2019-09-08 17:34:23'),
(16, 'Najla', 'Perempuan', 'Najlazdihar', 'najlacantik', 'Najla.izdihar@gmail.com', '082235222265', 'img_08092019113955.jpeg', '2019-09-08 11:39:55', '2019-09-08 11:39:55'),
(17, 'Maulana', 'Laki-laki', 'Maulana', 'mauapakamu', 'Qwerty@gmail.con', '082154307769', 'img_08092019121341.jpeg', '2019-09-08 12:13:41', '2019-09-08 12:13:41'),
(18, 'Lutpi P', 'Laki-laki', 'mantul', 'paladin', 'luthfip20.lp@gmail.com', '081259565502', 'img_09102019091412.jpg', '2019-09-08 12:30:18', '2019-10-09 09:14:12'),
(19, 'Pit', 'Perempuan', 'Pit', 'wunsel', 'pit@gmail.com', '082223456789', 'img_08092019035006.jpg', '2019-09-08 12:47:33', '2019-09-08 15:50:06'),
(21, 'Dwikygantengsboys', 'Laki-laki', 'Dwikygantengsboys', 'dwikydwiky', 'Dwikyananda630@gmail.com', '081529951990', 'img_08092019010918.jpg', '2019-09-08 13:09:18', '2019-09-08 13:09:18'),
(22, 'Hafizgntg', 'Laki-laki', 'Hafizmln', '102hafiz', 'hafizmaullana193@gmail.com', '085774133233', 'img_08092019031059.jpeg', '2019-09-08 15:10:59', '2019-09-08 15:10:59'),
(23, 'Albert Bill Alroy', 'Laki-laki', 'billbert', '12345', 'albertbillalroy@gmail.com', '081336829587', 'img_08092019051846.jpeg', '2019-09-08 17:18:46', '2019-09-08 17:18:46'),
(24, 'Ekky', 'Laki-laki', 'ekkypram', 'ekkyganteng123', 'epramudito@gmail.com', '082243850478', 'img_09092019082859.jpg', '2019-09-09 08:28:59', '2019-09-09 08:28:59'),
(25, 'Incess', 'Laki-laki', 'Ipehaliasincess', 'incesspalingcantik', 'Rifahrifkie@icloud.com', '082233460933', 'img_09092019122514.jpeg', '2019-09-09 12:25:14', '2019-09-09 12:25:14'),
(26, 'om telolet om', 'Laki-laki', 'username', 'password', 'chalifnurfaizi6@gmail.com', '081217435180', 'img_10092019041839.jpg', '2019-09-10 04:18:39', '2019-09-10 04:28:16'),
(27, 'bima anggara', 'Laki-laki', 'bima', 'bima', 'bimanggara02@gmail.com', '08989776', 'img_07102019020430.jpg', '2019-09-10 10:05:00', '2019-10-07 02:04:41'),
(28, 'wqew', 'Laki-laki', 'weq', 'qweq', 'qewqeq@gmail.com', '3e3', 'img_21092019051420.jpg', '2019-09-21 17:14:20', '2019-09-21 17:14:20'),
(29, 'Babas', 'Laki-laki', 'aicebear', 'wunselan', 'babas@gmail.com', '081249708716', 'img_25092019043119.jpg', '2019-09-25 16:31:19', '2019-09-25 16:31:19'),
(30, 'Hari Cahyanto', 'Laki-laki', 'Hari', '12345678', 'Haricahyanto1@gmail.com', '0812973658888', 'img_27092019012339.jpg', '2019-09-27 13:23:39', '2019-09-27 13:23:39'),
(31, 'Aqil fadhilah', 'Laki-laki', 'Aqilf', 'persija46', 'Aqilfadhilah0@gmail.com', '81291377091', 'img_27092019013349.jpg', '2019-09-27 13:33:49', '2019-09-27 13:33:49'),
(32, 'ululssss', 'Laki-laki', 'ulul', 'ulul', 'ulul@gmail.com', '00000000000', 'img_06102019101156.jpg', '2019-09-27 13:37:49', '2019-10-06 10:11:56'),
(33, 'Frengki Alfiansyahreza', 'Laki-laki', 'Frengkyimut', '1234bego', 'and.frengky@gmail.com', '081293775218', 'img_06102019101134.jpg', '2019-09-27 13:55:58', '2019-10-06 10:11:34'),
(34, 'Nadyashavira', 'Perempuan', 'Nadyashavira', 'nadyashavira22', 'nadyashavira90@gmail.com', '81285887919', 'img_27092019020344.jpeg', '2019-09-27 14:03:44', '2019-09-27 14:03:44'),
(35, 'Indah R. S.', 'Perempuan', 'indah_rs', '12345', 'indahrs05@gmail.com', '081336736552', 'img_28092019054503.jpg', '2019-09-28 05:45:03', '2019-09-28 05:45:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_user(komentar)` (`id_user`),
  ADD KEY `id_resep(komentar)` (`id_resep`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user(notifikasi)` (`id_user`),
  ADD KEY `id_komentar(notifikasi)` (`id_komentar`),
  ADD KEY `id_teman(notifikasi)` (`id_teman`);

--
-- Indexes for table `resepmasakan`
--
ALTER TABLE `resepmasakan`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `teman`
--
ALTER TABLE `teman`
  ADD PRIMARY KEY (`id_teman`),
  ADD KEY `id_usera(teman)` (`id_usera`),
  ADD KEY `id_ikuti(teman)` (`id_ikuti`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `resepmasakan`
--
ALTER TABLE `resepmasakan`
  MODIFY `id_resep` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `teman`
--
ALTER TABLE `teman`
  MODIFY `id_teman` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `id_resep(komentar)` FOREIGN KEY (`id_resep`) REFERENCES `resepmasakan` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user(komentar)` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `id_komentar(notifikasi)` FOREIGN KEY (`id_komentar`) REFERENCES `komentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_teman(notifikasi)` FOREIGN KEY (`id_teman`) REFERENCES `teman` (`id_teman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user(notifikasi)` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resepmasakan`
--
ALTER TABLE `resepmasakan`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teman`
--
ALTER TABLE `teman`
  ADD CONSTRAINT `id_ikuti(teman)` FOREIGN KEY (`id_ikuti`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usera(teman)` FOREIGN KEY (`id_usera`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
