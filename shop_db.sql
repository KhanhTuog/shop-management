-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2022 lúc 04:58 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `size` int(10) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(5, 6, 'Khánh Tường', 'bindh125@gmail.com', '387816916', 'sản phẩm rất tuyệt vời '),
(6, 9, 'Nguyễn Khánh Tuong', 'bindh125@gmail.com', '38781691', 'hello');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(20) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `total_products` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `size`, `total_price`, `placed_on`, `payment_status`) VALUES
(19, 5, 'admin', 123, 'tuongnk.21it@vku.udn.vn', 'cash on delivery', 'Thành phố đông hà', 'Vans OLD SKOOL SHOE (1200000 x 2) - ', 38, 2400000, '2022-11-30', 'completed'),
(20, 6, 'Nguyễn Khánh Tường', 387816916, 'bindh125@gmail.com', 'cash on delivery', 'Thành phố đông hà', 'Nike Blazer Mid 77 Premium (3239000 x 2) - ', 39, 6478000, '2022-12-03', 'completed');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(30) NOT NULL,
  `size` int(11) NOT NULL,
  `image_01` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_02` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_03` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `size`, `image_01`, `image_02`, `image_03`) VALUES
(9, ' Stan Smith Adidas', 'Luôn mới mẻ. Giày adidas Stan Smith đã viết nên định nghĩa về phong cách trên sân tennis từ hơn 50 năm trước, và thiết kế gọn gàng tối giản ấy giờ đây vẫn rất thịnh hành. Kinh điển pha thêm nét mới mẻ, phiên bản này có viền gót giày khâu nổi mang hơi hướng bóng chày.', 2500000, 0, '29cae7d606754d34872cae7000162cbc_9366.webp', '6450f98709e449e29449ae700016438e_9366.webp', '88cddee3d8424c53bdb5ae7000164f2e_9366.webp'),
(10, 'HARDEN STEPBACK ADIDAS', 'Không có thứ vũ khí nào đáng sợ hơn cú step-back trong những trận đấu bóng rổ hiện đại, và không một ai làm được điều này tốt hơn James Harden. Đôi giày signature adidas này tôn vinh lối chơi sáng tạo của anh trên sân bóng rổ. Đế giữa Bounce đàn hồi mang đến cảm giác thoải mái trên từng sải bước, bất kể bạn đang rèn luyện kỹ năng xử lý bóng hay ném bóng từ khoảng cách xa.', 2300000, 0, '4fe6de58d560492ebfdfaebd0159710a_9366.webp', 'e05540c2020544b28d6baebd01586876_9366.webp', 'dcd228954ad543879459aebd015936e5_9366.webp'),
(13, 'ADIDAS Forum Low', 'Bùng cháy tình yêu dành cho thập niên 80, khi phong cách thể thao hiện diện từ trong sân đấu đến phong cách thường ngày. Đôi giày adidas Forum Low huyền thoại này có thêm phiên bản cập nhật hiện đại với các điểm nhấn màu sắc mới mẻ. Thân giày bằng da và đế ngoài bằng cao su tăng cường thoải mái mà bạn xứng đáng có được.', 2000000, 0, 'd699f1e03b934c89983aae9e01057988_9366.webp', '27488689a6344592bb97ae9e0104e169_9366.webp', 'a6ca787a272d49f98d63ae9e01055633_9366.webp'),
(14, 'Nike Jordan Delta 3 Mid', 'Lấy cảm hứng từ thiết bị trên sân của thập niên 90 và tính thẩm mỹ của Thời đại Không gian, Delta 3 đã sẵn sàng ra mắt. Với các vật liệu kỹ thuật siêu nhẹ, chúng có kiểu dáng và cảm giác hoài cổ. Đây là đôi giày thế hệ tiếp theo sẽ đưa bạn đến với ngày mai.', 4000000, 0, 'fbcc50e0-a5e6-43ce-8775-56447c9e7480.webp', 'e5c222ca-4902-48ec-8291-16ee35d4b4a3.webp', '095adf90-1bec-470d-8972-6f34cb99f457.webp'),
(15, 'Vans OLD SKOOL SHOE', 'The Color Theory Collection allows you to create a unique color story by pairing vibrant, unexpected hues with our iconic footwear silhouettes. Made with sturdy suede and canvas uppers, the Color Theory Old Skool honors our signature low top, sidestripe shoe with eye-catching colorways ideal for the season. This timeless lace-up style also includes reinforced toe caps, supportive padded collars, and signature rubber waffle outsoles. • Vans’ iconic low top, sidestripe shoe • Durable suede and can', 1200000, 0, 'VN0A4BW21NU-ALT3.webp', 'VN0A4BW21NU-ALT3.webp', 'VN0A4BW21NU-ALT4.webp'),
(18, 'New balance 574', 'The most New Balance shoe ever’ says it all, right? No, actually. The 574 might be our unlikeliest icon. The 574 was built to be a reliable shoe that could do a lot of different things well rather than as a platform for revolutionary technology, or as a premium materials showcase. This unassuming, unpretentious versatility is exactly what launched the 574 into the ranks of all-time greats. As hybrid road/trail design built on a wider last than the previous generation’s narrow racing silhouettes', 1850000, 0, 'u574rz2_nb_02_i.webp', 'u574rz2_nb_04_i.webp', 'u574rz2_nb_16_i.webp'),
(20, 'Converse Chuck Taylor All Star 70 Plus', 'Lấy cảm hứng từ dòng Chuck 70s, Chuck 70s Plus là một thiết kế “lệch pha\" với sự kết hợp của hai loại vải 12oz và 16oz tái chế. Về tổng thể, đây là một kết cấu mới dựa trên sự tách rời - chắp vá - tái tạo đầy ấn tượng phá vỡ mọi quy tắc nhưng vẫn giữ được nét cổ điển của dòng giày kinh điển này.', 2500000, 0, 'A00916C_P1-650x650.jpg', 'A00916C_2-650x650.jpg', 'A00916C_4-650x650.jpg'),
(21, 'Nike Blazer Mid 77 Premium', 'Styled for the 70s. Loved in the 80s. Classic in the 90s. Ready for the future. The Nike Blazer Mid gets you ready for wintertime with a cosy collar that pairs perfectly with your favourite seasonal jumper.', 3239000, 0, 'f75474b9-1b5a-4e90-bbf4-468706655042.webp', '20784809-5514-4bdf-96a3-a67385681d61.webp', 'b4432890-cbd8-4299-b9b2-bd4596243b0a.webp'),
(22, 'Vans OLD SKOOL SHOE', 'vans old scholll', 950000, 0, '2-36.jpg', '3-37.jpg', '4-30.jpg'),
(24, 'PUMA BARI MULE 371318 01', 'Giày Puma Skye Clean là mẫu giày sneaker được yêu thích của thương hiệu Puma.\r\nMẫu giày được thiết kế theo phong cách cố điển đặc trưng\r\nPhần thân trên được làm bằng da mang đến sự sang trọng\r\nLớp lót SoftFoam + sockliner êm ái giúp đôi chân dễ chịu suốt cả ngày.\r\nĐế ngoài bằng cao su chống trượt tạo cảm giác linh hoạt khi di chuyển.\r\nSở hữu gam màu ấn tượng, giày Puma Skye Clean chắc chắn sẽ mang lại trải nghiệm tuyệt vời cho phong cách của bạn\r\n', 950000, 0, 'puma-bari-mule-371318-01-white-mau-trang-00-5ee1bae941e46.jpg', 'puma-bari-mule-371318-01-white-mau-trang-2-5ee1ba7524eb1.jpg', 'VN0A4BW21NU-ALT4.webp'),
(25, 'Converse Chuck Taylor All Star Dainty', 'Phiên bản Converse Dainty vô cùng duyên dáng, nhẹ nhàng giúp các bạn nữ tỏa sáng với phong cách thời trang thanh lịch, trẻ trung. Kiểu dáng thanh mảnh, ôm form cùng chất liệu Canvas cao cấp, miếng đệm giày và lớp lót trong mềm mại giúp bạn có được sự thoải mái, êm nhẹ dù diện giày cả ngày dài.', 1500000, 0, '564981C_1-650x650.jpg', '564981C_2-650x650.jpg', '564981C_4-650x650.jpg'),
(26, 'Nike Waffle One Leather', 'Bringing a new look to the iconic Waffle franchise, we have balanced everything you love most about heritage Nike running with fresh innovations. The Waffle outsole has been updated with moulded lugs for extra support and traction—providing a level of comfort you have to feel to believe. Plus, the durable heel clip and leather upper add to the classic look', 2500000, 0, '45b5b19b-7564-478f-aa5b-cde66581e979.webp', '68f31089-7c4d-4e3e-afcb-136342a218c2.webp', '37294fda-b839-4f84-9998-732a902a5f83.webp'),
(27, 'Vans UA Era Varsity', 'Vans Varsity Canvas đã mang tới một sắc màu mới mẻ hiện đại, cùng với lối thiết kế đậm chất cổ điển. Với chất liệu chính là 57.7% da và 42.3% vải đã đem tới sự khác biệt lớn cho dòng Era này. Phối màu Varsity Canvas Green/ Blue sẽ giúp bạn chinh phục mọi outfit khác nhau. Bên cạnh đó, bộ đệm lót OrthoLite êm ái cũng hỗ trợ trong quá trình chuyển động tốt hơn. Giúp bạn có một trải nghiệm đáng nhớ hơn với đôi giày thể thao đường phố này.', 1450000, 0, 'VN0A5KX524O_1-650x650.jpg', 'VN0A5KX524O_2-650x650.jpg', 'VN0A5KX524O_3-650x650.jpg'),
(28, 'Adidas Yeezy 350 V2', '- Cam kết chính hãng 100% nhập từ US, UK, JP.\r\n- Hàng đi kèm full box, tem, tag, giấy gói chính hãng.\r\n- Miễn phí đổi size, đổi mẫu trong vòng 5 ngày.\r\n- Dịch vụ hỏa tốc, hàng được giao nhanh từ 1-4 ngày kể từ ngày đặt hàng.\r\n- Đa dạng mẫu mã, luôn cập nhập các mẫu mới , giá sale rẻ.', 5000000, 0, 'hp7870021663497778174.webp', 'hp7870031663497778197.webp', 'hp7870041663497778222.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(5, 'user', 'bindh125@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(6, 'Nguyễn Khánh Tuong', 'tuongnk.21it@vku.udn.vn', '202cb962ac59075b964b07152d234b70', 0),
(7, 'tuong', 'tuong@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(8, 'Khánh Tường', 'bindhZ5@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(9, 'bin bin', 'user02@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(20, 7, 9, 'Stan Smith ', 2500000, '29cae7d606754d34872cae7000162cbc_9366.webp');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
