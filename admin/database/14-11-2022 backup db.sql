-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for simple_news_website
CREATE DATABASE IF NOT EXISTS `simple_news_website` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `simple_news_website`;

-- Dumping structure for table simple_news_website.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` int DEFAULT NULL,
  `maneger_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_and_token` (`email`,`token`) USING BTREE,
  KEY `FK_admin_admin` (`maneger_id`),
  CONSTRAINT `FK_admin_admin` FOREIGN KEY (`maneger_id`) REFERENCES `admin` (`id`),
  CONSTRAINT `admin_email_check` CHECK ((`email` like _utf8mb4'%gmail.com')),
  CONSTRAINT `admin_phone_number_check` CHECK ((`phone_number` > 99999999))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table simple_news_website.admin: ~1 rows (approximately)
DELETE FROM `admin`;
INSERT INTO `admin` (`id`, `email`, `token`, `name`, `password`, `phone_number`, `maneger_id`) VALUES
	(6, 'tien@gmail.com', '7MMDwm2yzPIEzIoo**K6L&pEZkli6pnE7cW@RK@BPuQE7#d8#r', 'Tiến', 'nhanha123', NULL, NULL);

-- Dumping structure for table simple_news_website.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table simple_news_website.categories: ~8 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
	(1, 'genshin', 'đáy xã hội conetent'),
	(2, 'hutao', 'hầy'),
	(3, 'cosplayer', 'siêu cấp vipro'),
	(5, 'cat4', 'a'),
	(6, 'cat5', 'ab'),
	(7, 'cat6', 'abc'),
	(8, 'cat7', 'acd'),
	(9, 'cat8', 'awe');

-- Dumping structure for table simple_news_website.classify
CREATE TABLE IF NOT EXISTS `classify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `news_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_classify_category` (`category_id`),
  KEY `FK_classify_news` (`news_id`),
  CONSTRAINT `FK_classify_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_classify_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table simple_news_website.classify: ~15 rows (approximately)
DELETE FROM `classify`;
INSERT INTO `classify` (`id`, `category_id`, `news_id`) VALUES
	(1, 1, 156),
	(10, 6, 160),
	(11, 2, 160),
	(12, 1, 160),
	(13, 3, 161),
	(14, 2, 161),
	(15, 1, 161),
	(16, 1, 162),
	(17, 2, 163),
	(18, 1, 163),
	(19, 2, 164),
	(20, 1, 164),
	(21, 2, 165),
	(22, 3, 165),
	(23, 5, 167);

-- Dumping structure for table simple_news_website.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_and_token` (`email`,`token`) USING BTREE,
  CONSTRAINT `customer_email_check` CHECK ((`email` like _utf8mb4'%@gmail.com')),
  CONSTRAINT `customer_phone_number_check` CHECK ((`phone_number` > 99999999))
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table simple_news_website.customers: ~10 rows (approximately)
DELETE FROM `customers`;
INSERT INTO `customers` (`id`, `email`, `token`, `name`, `birthday`, `password`, `phone_number`) VALUES
	(12, 'sang@gmail.com', 'wnCsZdTo8xym2YXb45cQsy0bZRRV$#fUS6F18tGmGeRtYNV%9E', 'sang', NULL, 'sangprovl', NULL),
	(17, 'phong@gmail.com', 'cgDbcUnh7#86uyYLZUA2UmIt%KDunxDqk#uR1268zg5i3fPie1', NULL, NULL, 'nhanha123', NULL),
	(18, 'phongvippro@gmail.com', 'Pz8VrNqiNy8OmGhbPmNWdwHUxgI8nGN*qe6sy&DYJr9tvtCM$P', NULL, NULL, '11111111', NULL),
	(19, 'quy@gmail.com', 'SqH@5oZc@eVy&vyYKPnMrK1TkHxdivCXWxH9LiCD&2NMkkEXgP', 'quy', NULL, '11111111', NULL),
	(20, 'b@gmail.com', 'Twi5OmpCL%u7S*Iunnw#ST#tvGTFcYXjEL8oL6kVOuSNu4vJWd', NULL, NULL, 'nhanha123', NULL),
	(21, 'huce@gmail.com', 'Wgla4OP&eIvKiFI2MWDt&MSx4YwLIKXD4HI*REAxnAFE@0BsEn', NULL, NULL, 'nhanha123', NULL),
	(22, '222@gmail.com', '8J6HgLbf*7XZpdsjWcvrVCNXfpG00B&pGj5&Ynf1Kra7#Rt8l5', NULL, NULL, 'nhanha123', NULL),
	(23, 'thanhdtrz@gmail.com', '4X8mMCEnyXzE0#0yqgFwglVeKM8F7sdiZjEoGRyqjbYvCpKgJ6', NULL, NULL, 'nhanha123', NULL),
	(24, 'cus@gmail.com', 'j#rEDZF%e8*7cosJgdg*cMkxh7frbn1$SyhpMGJX4UhWc%xiPy', NULL, NULL, '11111111', NULL),
	(25, '1@gmail.com', '2EHOL0d&aN%Jtj$Q3umJQp@sDxmg$DfEIxb1P4CZbn6YAwHJa7', NULL, NULL, '11111111', NULL);

-- Dumping structure for table simple_news_website.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `browse_admin_id` int DEFAULT NULL,
  `title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_pinned` bit(1) NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_news_admin` (`browse_admin_id`),
  KEY `customers_id` (`customer_id`) USING BTREE,
  CONSTRAINT `FK_news_admin` FOREIGN KEY (`browse_admin_id`) REFERENCES `admin` (`id`),
  CONSTRAINT `FK_news_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `is_pinned_check` CHECK ((`is_pinned` < 2)),
  CONSTRAINT `status_check` CHECK ((`status` < 4))
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='status:\r\n0 - this news have been denied by admin or super admin\r\n1 - customer recently push this news and waiting for admin check\r\n2 - admin says news not available need to change\r\n3 - admin accept this news and push request for supper admin browse\r\n 4 - supper admin accept this news and push to website\r\n';

-- Dumping data for table simple_news_website.news: ~12 rows (approximately)
DELETE FROM `news`;
INSERT INTO `news` (`id`, `customer_id`, `browse_admin_id`, `title`, `content`, `image`, `create_at`, `update_at`, `is_pinned`, `status`) VALUES
	(156, 12, 6, 'giải cứu kunasali', 'kunasali bị bắt rồi huhu', 'https://znews-photo.zingcdn.me/w660/Uploaded/qhj_yvobvhfwbv/2018_07_18/Nguyen_Huy_Binh1.jpg', '2022-11-14 11:25:47', '2022-11-14 11:25:47', b'1', b'1'),
	(157, 17, 6, '4.000 "đảo bất khả chiến bại" giúp Ukraine đối phó màn tập kích tên lửa Nga', '(Dân trí) - Các "trung tâm bất khả chiến bại" được ví như những hòn đảo nhằm giúp người dân Ukraine tiếp cận các dịch vụ khẩn cấp sau loạt trận tập kích tên lửa của Nga.', 'https://icdn.dantri.com.vn/thumb_w/680/2022/11/25/ukraine-1669363841203.png', '2022-11-25 12:34:48', '2022-11-25 12:34:48', b'1', b'1'),
	(158, 20, 6, 'Phó Chủ tịch UBND tỉnh Quảng Ninh được cho thôi chức', '(Dân trí) - Ban Thường vụ Tỉnh ủy Quảng Ninh thống nhất chủ trương cho ông Phạm Văn Thành thôi đảm nhiệm chức vụ Phó Chủ tịch UBND tỉnh theo nguyện vọng.', 'https://icdn.dantri.com.vn/thumb_w/680/2022/11/25/pho-chu-tich-tinh-quang-ninh-15480926-1669372381924.jpg', '2022-11-25 12:35:59', '2022-11-25 12:35:59', b'0', b'1'),
	(159, 24, NULL, '"Nếm mật nằm gai", Cameroon bất ngờ hạ Brazil ở phút bù giờ', 'Brazil không tung ra đội hình mạnh nhất thi đấu với Cameroon do họ đã giành vé vào vòng 1/8 trước lượt đấu cuối. Dẫu Brazil sử dụng đội hình hai, lối chơi tấn công còn chưa mượt mà song họ vẫn làm chủ trận đấu, tạo sức ép lớn về phía cầu môn của Cameroon suốt từ đầu trận. \r\n\r\nThống kê sau trận đấu cho thấy Brazil kiểm soát bóng 65% thời gian, tung ra 21 lần dứt điểm, 8 lần bóng đi trúng khung thành. Với 35% thời gian cầm bóng, Cameroon cũng có được 7 lần dứt điểm và 3 lần bóng đi trúng cầu môn.\r\n\r\nNhững con số chỉ ra sự vượt trội của Brazil, tuy nhiên đội bóng của Tite lại không thể ghi bàn. Một phần do các chân sút của đội bóng này vô duyên, một phần bởi thủ thành Epassy của Cameroon đã chơi tốt, có nhiều pha cứu thua xuất sắc.\r\n\r\nNếm mật nằm gai, Cameroon bất ngờ hạ Brazil ở phút bù giờ - 1\r\nThủ thành Epassy (phải) có nhiều pha cứu thua xuất sắc.\r\n\r\nTrước khi bước vào thời gian thi đấu bù giờ cuối trận, Cameroon chỉ có hai cú dứt điểm trúng đích, trong đó chỉ có một lần khiến Ederson phải trổ tài cản phá. Đội bóng tới từ châu Phi chấp nhận chơi ở thế cửa dưới trong suốt thời gian dài, khi có lẽ tất cả mọi người nghĩ rằng Cameroon hướng tới một trận hòa thì họ đã ghi bàn. \r\n\r\nPhút bù giờ thứ hai, Aboubakar thoát xuống nhận đường chuyền của đồng đội và đánh đầu tung lưới Brazil mở tỉ số. Cầu thủ 30 tuổi đang thi đấu tại Saudi Arabia bất chấp việc từng bị phạt thẻ vàng trước đó mà vẫn cởi áo ăn mừng, hậu quả Aboubakar bị đuổi. Tuy nhiên, với 10 người trên sân Cameroon vẫn bảo toàn được chiến thắng. \r\n\r\nNếm mật nằm gai, Cameroon bất ngờ hạ Brazil ở phút bù giờ - 2\r\nBàn thắng để đời của Aboubakar vào lưới Brazil.\r\n\r\nChiến thắng của Cameroon không mang nhiều ý nghĩa do ở trận đấu cùng giờ Thụy Sĩ đã thắng 3-2 trước Serbia. Brazil vẫn đứng đầu bảng H, họ sẽ gặp Hàn Quốc ở vòng 1/8. Thụy Sĩ đứng thứ hai, sẽ đối đầu với Bồ Đào Nha. Cameroon đứng thứ ba, Serbia đứng thứ tư, cùng bị loại.', '316814421_530344328742350_1221968189031239001_n.png', '2022-12-02 19:05:16', '2022-12-03 02:05:16', b'0', b'1'),
	(160, 24, NULL, 'Ván cược của Nga khi dựng phòng tuyến "Răng rồng" ngăn Ukraine phản công', '(Dân trí) - Những hình ảnh vệ tinh gần đây cho thấy nhiều vị trí phòng thủ của Nga ở khu vực phía đông Kherson, khi Moscow đang tìm cách chặn đà tiến công của quân đội Ukraine.\r\nVán cược của Nga khi dựng phòng tuyến Răng rồng ngăn Ukraine phản công - 1\r\nẢnh vệ tinh chụp các chiến hào, công sự và chướng ngại vật xe tăng của Nga ở Stepne, Ukraine ngày 15/11 (Ảnh: Maxar).\r\n\r\nTheo đánh giá trong tuần này của Viện Nghiên cứu Chiến tranh (ISW) tại Washington, các vị trí phòng thủ của Nga đã được xây dựng dọc theo các tuyến giao thông quan trọng như đường bộ và đường cao tốc, đồng thời kết nối các lực lượng Nga tại sông Dnipro với các khu vực khác do Nga kiểm soát ở Đông Nam Ukraine, như Crimea, Kherson và Zaporizhia.\r\n\r\nĐánh giá của ISW cho biết, những vị trí phòng thủ của Nga tồn tại dưới hình thức các chiến hào và tuyến phòng thủ chống tăng "Răng rồng". Đây là chiến thuật phòng thủ được sử dụng trong nhiều thập niên qua, bao gồm các công sự kiên cố được xây dựng để làm chậm và ngăn cản các loại xe bọc thép hạng nặng. Thay vì kết nối các tuyến giao thông liên lạc trên khắp chiến trường, các vị trí này giống như "các rào cản phức tạp" được bố trí cách không quá xa các tuyến đường hoặc nằm sâu trong các cánh đồng.\r\n\r\nVán cược của Nga khi dựng phòng tuyến Răng rồng ngăn Ukraine phản công - 2\r\nChiến hào, công sự, chướng ngại vật của Nga ở Velyka Blahovischenka, Ukraine (Ảnh: Maxar).\r\n\r\nISW nhận định, các vị trí phòng thủ này cho thấy lãnh đạo quân đội Nga dường như lo ngại các lực lượng Ukraine có thể tiến qua sông Dnipro và tiến vào vùng hạ lưu Kherson. Tuy nhiên, bản chất của những vị trí này là một ván cược, vì trong khi Nga đang tập trung vào việc bảo vệ các tuyến đường bộ và đường cao tốc, Moscow dường như lại bỏ qua thực tế rằng Ukraine có thể tiến quân qua các khu vực có địa hình mở.\r\n\r\nCác xe tăng và phương tiện quân sự của Ukraine có thể di chuyển qua các cánh đồng và tấn công các vị trí của Nga từ các khu vực dễ bị tổn thương.\r\n\r\nCác lực lượng Nga gần đây đã xây dựng nhiều hàng rào chướng ngại vật từ các khối bê tông cỡ lớn kết hợp với mìn chống tăng tại các khu vực Donetsk, Lugansk, Kherson, Mariupol và Zaporizhia ở Ukraine. Các nguồn tin cho biết hệ thống công sự này do công ty quân sự tư nhân Wagner xây dựng và còn được biết đến với tên gọi tuyến phòng thủ "Răng rồng".\r\n\r\nVán cược của Nga khi dựng phòng tuyến Răng rồng ngăn Ukraine phản công - 3\r\nCác vị trí phòng thủ của Nga ở Novotroitsky, Ukraine (Ảnh: Maxar).\r\n\r\nTheo George Barros, một chuyên gia của ISW, các tuyến phòng thủ cho thấy Nga cũng dự tính rằng họ có những điểm yếu trên các tuyến đường bộ và đường cao tốc. Với địa hình trên thực tế và cách thức bố trí các vị trí phòng thủ, các lực lượng Nga cũng có thể dễ bị lực lượng Ukraine bao vây nếu họ tiến công từ sườn phía đông và phía tây ở Kherson. Ngoài ra, Ukraine có thể sử dụng các cuộc tấn công chính xác để đe dọa các tuyến liên lạc của Nga. Chuyên gia Barros cũng cho rằng, khi thiết lập các tuyến phòng thủ như vậy, các lực lượng Nga dường như đang tự hạn chế khả năng của mình trong việc tiến hành các hoạt động tấn công trong khu vực.\r\n\r\nKherson là thủ phủ của tỉnh Kherson, miền Nam Ukraine. Nga kiểm soát hầu hết tỉnh này từ tháng 3 năm nay. Tuy nhiên, trước đà phản công mạnh của Kiev, hôm 9/11, Bộ Quốc phòng Nga thông báo rút quân khỏi thành phố, di chuyển lực lượng và thiết bị từ bờ tây sang bờ đông sông Dnipro.\r\n\r\nVán cược của Nga khi dựng phòng tuyến Răng rồng ngăn Ukraine phản công - 4\r\nVị trí vùng Kherson ở miền Nam Ukraine (Ảnh: Bộ Quốc phòng Mỹ).\r\n\r\nHoạt động rút quân của Nga khỏi Kherson hoàn tất hôm 11/11. Tuy nhiên, từ đó đến nay, Nga liên tục pháo kích qua sông Dnipro nhắm vào các mục tiêu của Ukraine ở bờ tây. \r\n\r\nHiện chưa rõ mục đích của Nga đằng sau các cuộc pháo kích dồn dập trở lại thành phố Kherson. Giới quan sát nhận định, Nga đã củng cố hệ thống phòng thủ ở bờ đông Dnipro để ngăn chặn Ukraine tiến xa hơn, mặt khác tìm cách khôi phục lực lượng sẵn sàng cho một cuộc phản công trong tương lai.', '638ae8ab52d27@ukraine-5443.jpg', '2022-12-02 23:11:55', '2022-12-03 06:11:55', b'0', b'1'),
	(161, 24, NULL, 'Cắm 3 sổ đỏ chơi lan đột biến, bỏ cả nửa tỷ đồng mua mầm lan, giờ ngồi khóc', '(Dân trí) - Cắm 3 sổ đỏ cho ngân hàng, anh Ngọc đầu tư tiền tỷ mua lan, có những mầm giá nửa tỷ đồng nhưng hiện thanh lý vài trăm nghìn đồng cũng không có người mua. Bây giờ, anh phải đi bốc vác kiếm tiền trả nợ.\r\nSau một ngày bốc hàng, anh Thế Ngọc (Phú Thọ) vẫn miệt mài tưới nước cho hơn 500 giỏ lan đang ế khách vì dù đã được đại hạ giá nhưng không có người mua. Sau gần 4 năm rót tiền trồng lan đột biến theo phong trào, anh vẫn nợ ngân hàng hơn 1 tỷ đồng với lãi suất 11%/năm mà chưa rõ ngày nào mới hết nợ. \r\n\r\nChi nửa tỷ đồng mua một mầm lan đột biến\r\nAnh Ngọc rót tiền vào lan năm 2018, bắt đầu từ dòng lan 5 cánh trắng Phú Thọ, sau đó "cơn sốt" lan tiếp tục lan sang những dòng lan cánh trắng Hiển Oanh (HO), lan Bạch tuyết... \r\n\r\nTrong đó, dòng lan 5 cánh trắng Phú Thọ có nguồn gốc từ chính quê anh sống. "Trước đây dòng này hiếm, trong xã chỉ 1-2 nhà có. Họ thổi giá và gọi đây là dòng đột biến. Ban đầu, giá chênh cao hơn các dòng khác nhưng không quá nhiều, sau đó mới bị hét giá lên", anh kể. \r\n\r\nCắm 3 sổ đỏ chơi lan đột biến, bỏ cả nửa tỷ đồng mua mầm lan, giờ ngồi khóc - 1\r\nNhững giỏ lan đột biến của anh Ngọc vẫn ế khách. Anh Ngọc còn hơn 500 giỏ lan (Ảnh: Nhân vật cung cấp).\r\n\r\nAnh Ngọc là một trong nhiều người đã tham gia vào trào lưu trồng lan. Để gây được lan, anh phải mua mầm. "Tôi mua mầm của tất cả các loại lan hiếm thời điểm đó để gây cho đa dạng. Có những mầm vài triệu, có mầm vài chục triệu nhưng cũng có những mầm lên tới 500 triệu đồng. Mỗi mầm chỉ dài 1-2 cm", anh cho hay. \r\n\r\nSố tiền lớn nên anh Ngọc phải vay mượn thêm họ hàng để đầu tư. Ngoài ra, anh "cắm" 3 sổ đỏ ở ngân hàng để vay hơn 2 tỷ đồng, với hy vọng những giỏ lan sau vài năm sẽ giúp anh đổi đời. \r\n\r\nThực tế, thời điểm bắt đầu "sốt" lan, giao dịch dễ vì có nhiều người mua bán. "Năm 2021 là thời điểm lan đột biến có giá đỉnh điểm, nhưng đỉnh diễn ra không lâu. Lan lên giá nhanh nhưng xuống giá cũng nhanh hơn nhiều lần", anh bộc bạch. \r\n\r\n"Cả khu cùng đua nhau trồng lan đột biến khiến nó không còn hiếm nữa. Vào vườn nhà ai cũng thấy lan đột biến. Sau 2-3 năm, họ cũng giống tôi, nhận ra những chậu cây tiền tỷ không còn giá trị gì nữa", anh Ngọc nói.\r\n\r\nTá hỏa phát hiện ra lan đột biến tiền tỷ chỉ là giao dịch ảo\r\nTrong gần 3 năm từ lúc trồng lan cho đến khi diễn ra "cơn sốt" lan năm 2021, anh Ngọc có tổng hơn 500 giỏ lan. Ban đầu, anh có vài mầm, sau mua thêm và khi lan lớn lại tiếp tục gây thêm lan.\r\n\r\nSở hữu nhiều song lan không còn "đột biến". Anh Ngọc cũng từng chốt lời nhiều giỏ lan nhưng niềm vui diễn ra không lâu. Giá lan bất ngờ lao dốc mà theo anh Ngọc là "không kịp chống đỡ".\r\n\r\n"Tôi đã chứng kiến một thời cây cảnh cũng bị đẩy giá và lao dốc. Cũng biết lan rồi sẽ có ngày giảm, nhưng tôi nghĩ sẽ giảm từ từ chứ không ngờ đẩy lên cao vút như vậy xong rồi sập luôn. Chỉ trong vòng vài tháng, giá lan sập, tôi không kịp trở tay", anh chua chát nói.\r\n\r\nCắm 3 sổ đỏ chơi lan đột biến, bỏ cả nửa tỷ đồng mua mầm lan, giờ ngồi khóc - 2\r\nMấy chậu lan kiếm đột biến của anh Ngọc ở Phú Thọ gần 2 năm trước từng được định giá cả tỷ đồng, giờ nằm chỏng chơ, chẳng ai mua (Ảnh: Nhân vật cung cấp).\r\n\r\nBất ngờ nhất với anh Ngọc là các thông tin giao dịch lan tiền tỷ trên mạng xã hội chỉ là ảo. Anh kể: "Lúc đó không chỉ tôi, tất cả người xung quanh trồng lan đều tá hỏa. Anh em không phải ai cũng có tiền, đều đi cắm sổ đỏ vay nợ như tôi cả. Thời điểm phát hiện ra và lan xuống giá không còn người mua nữa, tôi vẫn nợ gần 2 tỷ đồng ở ngân hàng". \r\n\r\nChưa kể, trồng lan, theo anh Ngọc, không hề đơn giản. Suốt một thời gian dài, anh Ngọc không đi làm gì, chỉ ở nhà nghiên cứu cách chăm lan, dồn bao tâm huyết. Vậy nhưng mấy chậu lan đột biến tưởng được định giá vài tỷ đồng giờ nằm chỏng chơ, chẳng ai mua. Mức giá chênh nhau giữa giá hiện tại và trước đó lên tới hàng nghìn lần.\r\n\r\nBốc vác kiếm tiền trả nợ "nghiệp chơi lan" \r\nSau này, khi lan xuống giá cũng là lúc hàng loạt cảnh báo về lan đột biến và nguy cơ vỡ nợ khi đầu tư vào loại này. Các nguyên nhân gồm thổi giá quá cao so với giá trị thực sự của lan, nguy cơ mua phải lan giả mạo, nhân giống đại trà...\r\n\r\nBiết sẽ không bao giờ quay trở lại thời kỳ "đột biến" như trước nên thay vì tiếp tục chăm sóc lan, anh Ngọc giao cho người nhà làm và đi bốc vác kiếm tiền trả nợ. Lan đột biến một thời "đắt hơn vàng", giờ lâm cảnh để đó cho đỡ trống vườn. \r\n\r\nAnh Ngọc từng hạ giá với 20.000 đồng/cm lan để thanh lý nhưng không có người mua. "Quanh đây các nhà cũng diễn ra tình trạng tương tự. Có nhà nợ vài tỷ đồng, tôi thì vẫn nợ hơn 1 tỷ đồng", anh nói.\r\n\r\nThất thu vì cơn sốt lan đột biến thoái trào, anh Ngọc đi làm bốc vác với mức thu nhập 300.000 đồng/ngày để trả dần nợ. "Nhưng làm còn phải nuôi sống gia đình, lãi ngân hàng còn không trả đủ thì biết bao giờ mới hết nợ. Chắc chỉ còn nước bán nhà", anh Ngọc chua chát nói.\r\n\r\nThời điểm đầu năm 2021, thị trường xuất hiện những giao dịch lan đột biến trên khắp cả nước. Các thương vụ được livestreams rầm rộ, với số tiền thông báo lên tới hàng chục tỷ đồng.\r\n\r\nTùy vào đặc điểm màu của cánh, mắt, lưỡi hoa, nhà vườn, địa điểm phát hiện, giới chơi cây đặt cho lan những cái tên như 5 cánh trắng Phú Thọ, 5 cánh trắng HO, Bạch Tuyết, Ngọc Sơn Cước... Không ít hộ dân vay nợ, chi hàng tỷ đồng đầu tư vào lan đột biến với hy vọng đổi đời. Tuy nhiên lan đột biến dần hết thời, bị hạ giá thấp hơn hàng nghìn lần, ế chỏng chơ.\r\n\r\nTổng cục Thuế từng phải vào cuộc bằng cách phối hợp với các cơ quan chuyên ngành để xác minh thực tế và đưa ra hàng loạt quy định để thu thuế, quản lý hoạt động giao dịch lan đột biến.\r\n\r\nCông an tại nhiều tỉnh cũng ra khuyến cáo người dân cần tỉnh táo, tìm hiểu kỹ thông tin về giá cả, mặt hàng trước âm mưu, thủ đoạn của các đối tượng lợi dụng hoạt động mua bán lan đột biến gen nhằm mục đích trục lợi, lừa đảo chiếm đoạt tài sản.\r\n\r\nĐơn vị chức năng cũng cảnh báo dấu hiệu lừa đảo liên quan đến các giao dịch mua, bán lan đột biến gen nhằm trục lợi.\r\n\r\nCác chi nhánh ngân hàng, tổ chức tín dụng trên địa bàn một số tỉnh cũng được yêu cầu phải chấn chỉnh hoạt động cho vay các giao dịch có nguy cơ rủi ro cao, nhất là có liên quan đến yếu tố lan đột biến.', '638aea654cbfa@3178523658118718001095212044378550186910091n-1670029573677.webp', '2022-12-02 23:19:17', '2022-12-03 06:19:17', b'0', b'1'),
	(162, 24, NULL, 'DRX BeryL cảm thấy rất vui khi được cộng đồng gọi là \'Ông bạn Genshin\'', '(Thethaovanhoa.vn) - Tuyển thủ BeryL không thấy khó chịu với biệt danh mới của mình.\r\n\r\nDoinb chỉ ngủ hơn 5 tiếng mỗi ngày để vô địch CKTG 2019 \r\nChovy kể lại sự cố đi lạc tại New York, tuyên bố sẽ ủng hộ GAM Esports vì lí do này \r\nDeft, Chovy và Keria khiến khán giả ngưỡng mộ vì tình bạn đẹp \r\nNgay từ thời điểm khoác áo DAMWON Gaming và giành chức vô địch Chung kết thế giới (CKTG) 2020, BeryL đã nổi tiếng là người hâm mộ Genshin Impact. Cụ thể tại thời điểm năm 2020, BeryL đã “cống hiến” vào Genshin Impact gần 8 triệu Won (khoảng 150 triệu VNĐ).\r\n\r\nVì vậy mà biệt danh “Ông bạn Genshin” của BeryL đã ra đời ngay sau khi tuyển thủ này vô địch CKTG 2020. Xuyên suốt mùa giải 2021, biệt danh này thường được dùng để chỉ trích BeryL khi DK thất bại ở 2 trận Chung kết quan trọng (MSI, CKTG).\r\n\r\n\r\nDRX BeryL cảm thấy rất vui khi được cộng đồng gọi là Ông bạn Genshin - Ảnh 1.\r\nTuyển thủ BeryL nổi tiếng đam mê Genshin Impact - nguồn: Tùng Hoàng\r\n\r\nTrong một buổi lên sóng đặc biệt cách đây ít ngày, BeryL đã có dịp “trải lòng” về biệt danh này của mình. Về cơ bản, tuyển thủ này biết về cụm từ “Ông bạn Genshin” và hiểu ý nghĩa của nó. Tuy nhiên sau khi giành chức vô địch CKTG 2022 cùng DRX, biệt danh này lại được BeryL yêu quý vì nó trở thành lời khen hơn là sự chỉ trích.\r\n\r\nDRX BeryL cảm thấy rất vui khi được cộng đồng gọi là Ông bạn Genshin - Ảnh 2.\r\nDù BeryL vẫn chơi rất tốt trong năm 2021 nhưng DK lại để thua cả 2 trận Chung kết quan trọng nhất - nguồn: LoL Esports\r\n\r\n“Các bạn ở xứ Trung gọi tôi là ‘Ông bạn Genshin’ à? Ở Hàn Quốc tôi cũng được gọi bằng biệt danh tương tự luôn đó. Tôi hiểu ý nghĩa ban đầu của nó là gì. Hiện giờ thì biệt danh này lại chỉ điều tích cực nên tôi rất vui vì được cộng đồng gọi như vậy” - BeryL chia sẻ trên sóng trực tiếp.\r\n\r\nDRX BeryL cảm thấy rất vui khi được cộng đồng gọi là Ông bạn Genshin - Ảnh 3.\r\nBeryL không hề cảm thấy khó chịu với biệt danh "Ông bạn Genshin" - nguồn: LoL Esports\r\n\r\nPhẩm chất đáng khâm phục nhất của BeryL đó là anh cân bằng được sở thích cá nhân (Genshin Impact) và công việc (LMHT). BeryL vừa là tuyển thủ Hỗ Trợ hàng đầu thế giới, đồng thời vẫn có đủ thời gian đầu tư cho tài khoản Genshin, Honkai… Hy vọng rằng BeryL sẽ tiếp tục giữ vững sự cân bằng này và gặt hái thêm danh hiệu trong tương lai.', '638aeba36b5c5@3dadb574ad2d2ee17bddf7eeb4b139b9_215874307024019063.jpg', '2022-12-02 23:24:35', '2022-12-03 06:24:35', b'0', b'1'),
	(163, 24, NULL, 'aaa', 'aaaa', '638af03fd43e0', '2022-12-02 23:44:15', '2022-12-03 06:44:15', b'0', b'1'),
	(164, 24, NULL, 'aasdas', 'asdasd', '638af077c60ef.webp', '2022-12-02 23:45:11', '2022-12-03 06:45:11', b'0', b'1'),
	(165, 24, NULL, 'yvggk', 'hhkbhj', '638af21b1fa46.jpg', '2022-12-02 23:52:11', '2022-12-03 06:52:11', b'0', b'1'),
	(166, 24, NULL, 'ghyjgvky', 'hjkjkl', '638af22eea5f0.jpg', '2022-12-02 23:52:30', '2022-12-03 06:52:30', b'0', b'1'),
	(167, 24, NULL, 'Test upload', 'dsjklf;sj', '638b0c74811b2.webp', '2022-12-03 01:44:36', '2022-12-03 08:44:36', b'0', b'1');

-- Dumping structure for table simple_news_website.rating_comment
CREATE TABLE IF NOT EXISTS `rating_comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `customer_id` (`customer_id`),
  KEY `news_id` (`news_id`),
  KEY `FK_rating_comment_rating_comment` (`reply_id`),
  CONSTRAINT `FK_rating_comment_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `FK_rating_comment_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  CONSTRAINT `FK_rating_comment_rating_comment` FOREIGN KEY (`reply_id`) REFERENCES `rating_comment` (`id`),
  CONSTRAINT `rating` CHECK ((`rating` < 6))
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table simple_news_website.rating_comment: ~3 rows (approximately)
DELETE FROM `rating_comment`;
INSERT INTO `rating_comment` (`id`, `news_id`, `customer_id`, `rating`, `comment`, `create_at`, `reply_id`) VALUES
	(28, 156, 12, 3, 'huhu', '2022-11-14 11:32:49', NULL),
	(29, 156, 12, NULL, 'burh vl', '2022-11-14 11:33:16', 28),
	(30, 156, 19, 5, 'hmmmm', '2022-11-26 06:34:14', 28);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
