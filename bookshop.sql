
-- servername: codd.cs.gsu.edu
-
--
-- database: `bookshop`
--

-- --------------------------------------------------------

--
-- table `book_cart`
--

CREATE TABLE IF NOT EXISTS `book_cart` (
  `cart_id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) DEFAULT NULL COMMENT 'Member_ID',
  `book_id` int(12) NOT NULL COMMENT 'Book_ID',
  `cart_session_id` varchar(32) NOT NULL COMMENT 'User_session',
  `buy_num` int(12) NOT NULL DEFAULT '1' COMMENT 'Quantity',
  `cart_time` int(12) NOT NULL,
  `order_id` int(10) NOT NULL DEFAULT '0' COMMENT 'Order_ID, (o means noneffective)',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Book_cart information' AUTO_INCREMENT=4 ;

--
-- Insert data into `book_cart`
--

INSERT INTO `book_cart` (`cart_id`, `user_id`, `book_id`, `cart_session_id`, `buy_num`, `cart_time`, `order_id`) VALUES
(1, '123', 1, '127.0.0.1', 2, 0, 0),
(2, '123', 2, '127.0.0.1', 1, 0, 0),
(3, '123', 3, '127.0.0.1', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table `book_class`
--

CREATE TABLE IF NOT EXISTS `book_class` (
  `book_class_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Book_subclass id',
  `book_class_name` varchar(30) NOT NULL COMMENT 'Book_subclass name',
  `book_type_id` int(12) NOT NULL COMMENT 'Book-type id',
  PRIMARY KEY (`book_class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Book_subclass information' AUTO_INCREMENT=7 ;

--
-- Insert data into `book_class`
--

INSERT INTO `book_class` (`book_class_id`, `book_class_name`, `book_type_id`) VALUES
(1, 'Business ', 1),
(2, 'Computer Technology', 2),
(3, 'Education', 3),
(4, 'Health', 4),
(5, 'Entertainment', 5),
(6, 'Literature', 6);

-- --------------------------------------------------------

--
-- Table `book_hot`
--

CREATE TABLE IF NOT EXISTS `book_hot` (
  `hot_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Hotbook_ID',
  `book_id` int(10) NOT NULL COMMENT 'Book_ID',
  `hot_order` int(10) NOT NULL COMMENT 'Hotbook_order',
  PRIMARY KEY (`hot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  COMMENT='Hotbook information' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table `book_info`
--

CREATE TABLE IF NOT EXISTS `book_info` (
  `book_id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Book_id',
  `book_no` varchar(30)  NOT NULL COMMENT 'Book_ISBN',
  `book_name` varchar(40) NOT NULL COMMENT 'Book_name',
  `author` varchar(30) NOT NULL COMMENT 'Author',
  `publisher` varchar(40) NOT NULL COMMENT 'Publisher',
  `pub_date` datetime NOT NULL COMMENT 'publish date',
  `price` float NOT NULL COMMENT 'Original Price',
  `price_m` float NOT NULL COMMENT 'Member price',
  `price_d` float NOT NULL COMMENT 'Discounted_ price',
  `book_storenum` int(5) NOT NULL COMMENT 'Book store_number',
  `book_class_id` int(5) NOT NULL COMMENT 'Book class_id',
  `book_type_id` int(5) NOT NULL COMMENT 'Book type_id',
  `book_index` mediumtext COMMENT 'Book index',
  `book_abstract` mediumtext COMMENT 'Book abstract',
  `book_level` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Book rate',
  `book_level_pic` varchar(255)  NOT NULL COMMENT 'Book rate picture',
  `book_pic` varchar(255) NOT NULL COMMENT 'Book cover',
  `input_date` datetime NOT NULL COMMENT 'Book input date',
  `book_bs` varchar(2) NOT NULL DEFAULT '1' COMMENT 'Book wrap: hardcover or papercover',
  `book_view` int(10) NOT NULL DEFAULT '0' COMMENT 'Book view',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Book information' AUTO_INCREMENT=4 ;

--
-- Insert data into `book_info`
--

INSERT INTO `book_info` (`book_id`, `book_no`, `book_name`, `author`, `publisher`, `pub_date`, `price`, `price_m`, `price_d`, 
`book_storenum`, `book_class_id`, `book_type_id`, `book_index`, `book_abstract`, `book_level`, `book_level_pic`, `book_pic`, 
`input_date`, `book_bs`, `book_view`) VALUES
(1, '1451648537', 'Steve Jobs', 'Steve Jobs', 'Simon&Schuster', '2011-10-24 00:00:00', 35, 21, 21, 5, 6, 6, 
NULL, NULL, 4, 'images/level/4.gif', 'images/bookpic/stevejobs.jpg', '2012-10-28 00:00:00', '2', 0),
(2, '1594480001', 'Kite Runner', 'Khaled Hosseini ', 'Riverhead Trade', '2004-04-27 00:00:00', 16, 10.88, 10.88, 3, 6,
 6, 'The timely and critically acclaimed debut novel that is becoming a word-of-mouth phenomenon. 
 An epic tale of fathers and sons, of friendship and betrayal, that takes us from Afghanistan 
 in the final days of the monarchy to the atrocities of the present. ', NULL, 5, 'images/level/5.gif', 
 'images/bookpic/kite_runner.jpg', '2012-10-28 00:00:00', '1', 0),
(3, '0672329166', 'PHP and MySQL Web Development ', 'Laura Thomson', 'Addison-Wesley Professional', '2008-10-11 00:00:00', 54.99, 34.43, 34.43, 2, 2, 2, NULL, NULL, 5, 'images/level/5.gif', 'images/bookpic/php_mysql.jpg', '2012-04-18 00:00:00', '1', 0);

-- --------------------------------------------------------

--
-- Table `book_new`
--

CREATE TABLE IF NOT EXISTS `book_new` (
  `new_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'New ID',
  `book_id` int(10) NOT NULL COMMENT 'Book_ID',
  `new_order` int(10) NOT NULL DEFAULT '0' COMMENT 'New order',
  PRIMARY KEY (`new_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='New Book information' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table `book_recommend`
--

CREATE TABLE IF NOT EXISTS `book_recommend` (
  `recom_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Recommend ID',
  `book_id` int(10) NOT NULL COMMENT 'Book_ID',
  `recom_order` int(10) NOT NULL DEFAULT '0' COMMENT 'Recommend order',
  PRIMARY KEY (`recom_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='Recommendation information' AUTO_INCREMENT=4 ;

--
-- Insert data into `book_recommend`
--

INSERT INTO `book_recommend` (`recom_id`, `book_id`, `recom_order`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table `book_type`
--

CREATE TABLE IF NOT EXISTS `book_type` (
  `book_type_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'book type id',
  `book_type_name` varchar(30) NOT NULL COMMENT 'book type name',
  PRIMARY KEY (`book_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='book type information' AUTO_INCREMENT=5 ;

--
-- Insert data into `book_type`
--

INSERT INTO `book_type` (`book_type_id`, `book_type_name`) VALUES
(1, 'Business '),
(2, 'Computer Technology'),
(3, 'Education'),
(4, 'Health'),
(5, 'Entertainment'),
(6, 'Literature');

-- --------------------------------------------------------

--
-- Table`member_card`
--

CREATE TABLE IF NOT EXISTS `member_card` (
  `serial` int(5) NOT NULL AUTO_INCREMENT COMMENT 'member_card serial',
  `cardno` varchar(20) NOT NULL COMMENT 'member_card no',
  `cardpsd` varchar(20) NOT NULL COMMENT 'member_card password',
  `balance` float NOT NULL COMMENT 'member_card > 10',
  `cardlevel` varchar(10) NOT NULL DEFAULT 'Ordinary' COMMENT 'card level',
  `cardstatus` varchar(2) NOT NULL COMMENT 'card status',
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='member card information' AUTO_INCREMENT=4 ;

--
-- insert data into `member_card`
--

INSERT INTO `member_card` (`serial`, `cardno`, `cardpsd`, `balance`, `cardlevel`, `cardstatus`) VALUES
(1, 'chao31415', '123456', 600, 'Golden', 'Y'),
(2, '00868101', '123456', 50, 'Silver', 'Y'),
(3, '00868102', '123456', 20, 'Ordinary', 'Y');

-- --------------------------------------------------------

--
-- Table `member_user`
--

CREATE TABLE IF NOT EXISTS `member_user` (
  `serial` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Member serial',
  `userid` varchar(30)  NOT NULL COMMENT 'user id',
  `username` varchar(20) NOT NULL COMMENT 'username',
  `password` varchar(30) NOT NULL COMMENT 'password',
  `email` varchar(50)  DEFAULT NULL COMMENT 'email',
  `addr` varchar(100) DEFAULT NULL COMMENT 'address',
  `post` varchar(30)  DEFAULT NULL COMMENT 'post code',
  `phone` varchar(20)  DEFAULT NULL COMMENT 'phone',
  `createtime` datetime DEFAULT NULL COMMENT 'create time',
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  COMMENT='member information' AUTO_INCREMENT=2 ;

--
-- insert data into `member_user`
--

INSERT INTO `member_user` (`serial`,`userid`, `username`, `password`, `email`, `addr`, `post`, `phone`, `createtime`) VALUES
(1,'123', 'sliu15', '123456', 'liusha@817.com', NULL, NULL, NULL, NULL),
(2,'456', 'sliu17', '123456', 'liusha@234.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table `member_user_card`
--

CREATE TABLE IF NOT EXISTS `member_user_card` (
  `serial` int(10) NOT NULL COMMENT 'member serial',
  `userid` varchar(30) NOT NULL COMMENT 'userid',
  `cardno` varchar(30) NOT NULL COMMENT 'card no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='member-card relationship';

-- --------------------------------------------------------

--
-- Table `order_fmonry`
--

CREATE TABLE IF NOT EXISTS `order_fmonry` (
  `fmoney_ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'order ID',
  `fmoney_name` varchar(20)  NOT NULL COMMENT 'Payment type',
  `order_fcon` varchar(60)  NOT NULL COMMENT 'Payment description',
  PRIMARY KEY (`fmoney_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Payment information' AUTO_INCREMENT=5 ;

--
-- insert data into `order_fmonry`
--

INSERT INTO `order_fmonry` (`fmoney_ID`, `fmoney_name`, `order_fcon`) VALUES
(1, 'member card', 'Pay from member card'),
(3, 'cash on delivery', 'Pay on delivery'),
(4, 'credit card', 'Pay online: credit card');

-- --------------------------------------------------------

--
-- Table `order_info`
--

CREATE TABLE IF NOT EXISTS `order_info` (
  `order_ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Order ID',
  `user_name` varchar(30) NOT NULL,
  `order_post` varchar(10) NOT NULL,
  `order_addr` varchar(255) NOT NULL COMMENT 'delivery address',
  `order_phone` varchar(20) NOT NULL COMMENT 'contact phone number',
  `order_mail` varchar(30) NOT NULL COMMENT 'email',
  `order_send` tinyint(2) NOT NULL COMMENT 'order send',
  `order_fmoney` tinyint(2) NOT NULL COMMENT 'payment type',
  `order_num` int(4) NOT NULL COMMENT 'order number',
  `order_money` float NOT NULL DEFAULT '0' COMMENT 'order money',
  `order_state` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'order status',
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'order time',
  `order_note` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'order note',
  PRIMARY KEY (`order_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='order infomation' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table `order_send`
--

CREATE TABLE IF NOT EXISTS `order_send` (
  `send_ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Order ID',
  `send_name` varchar(20) NOT NULL COMMENT 'send name',
  `send_con` varchar(60)  NOT NULL COMMENT 'send description',
  PRIMARY KEY (`send_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='order send information' AUTO_INCREMENT=5 ;

--
-- Insert data into `order_send`
--

INSERT INTO `order_send` (`send_ID`, `send_name`, `send_con`) VALUES
(1, 'On door', 'Send scope: Atlanta'),
(2, 'Over-night', '20$ on whole order'),
(3, '3-5 business day', 'freeshipping'),


-- --------------------------------------------------------

--
-- Table`user_message`
--

CREATE TABLE IF NOT EXISTS `user_message` (
  `M_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'message ID',
  `book_id` int(10) NOT NULL COMMENT 'Book ID',
  `user_id` varchar(30)  NOT NULL COMMENT 'user ID',
  `book_level` varchar(10) NOT NULL COMMENT 'book rate',
  `message_content` text NOT NULL COMMENT 'message content',
  `message_time` int(12) NOT NULL COMMENT 'message time',
  PRIMARY KEY (`M_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User evaluation information' AUTO_INCREMENT=4 ;

--
--Insert data into `user_message`
--

INSERT INTO `user_message` (`M_id`, `book_id`, `user_id`, `book_level`, `message_content`, `message_time`) VALUES
(1, 1, 'sliu15', 'Good', '', 0),
(2, 1, 'wuya', 'Normal', 'Lots of mistakes', 0);
