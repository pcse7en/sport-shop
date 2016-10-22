-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql304.byetcluster.com
-- Generation Time: Dec 27, 2015 at 11:26 AM
-- Server version: 5.6.25-73.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skyf5_16915276_cshop1`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'پیراهن آستین بلند', 'پیراهن آستین بلند فوتبال'),
(2, 'پیراهن آستین کوتاه', 'پیراهن آستین کوتاه فوتبال'),
(3, 'شورت', 'شورت فوتبالی'),
(4, 'کفش فوتبال', 'کفش فوتبالی استوک دار'),
(5, 'ساق بند', 'ساق بند فوتبالی'),
(6, 'توپ فوتبال', 'توپ فوتبال'),
(7, 'گرمکن ورزشی', 'گرمکن تمرینی تیم های فوتبال'),
(8, 'جوراب ورزشی', 'جوراب های ورزشی جدید فوتبال'),
(9, 'کفش فوتسال', 'کفش فوتسال جدید در اینجا قابل تهیه است'),
(10, 'دست لباس فوتبال', 'دست لباس فوتبالیست ها');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `text` text NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `block` tinyint(1) DEFAULT '0',
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`,`email`,`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(12) unsigned NOT NULL,
  `number_exist` int(6) unsigned NOT NULL,
  `category_id` int(6) unsigned NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `date_of_production` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `number_exist`, `category_id`, `picture`, `text`, `expiration_date`, `date_of_production`) VALUES
(1, 'پیراهن فوتبالی تیم ملی آلمان 2014', 400000, 20, 2, '1.png', 'پیراهن ورزشی تیم ملی فوتبال آلمان در جام جهانی 2014 هم اکنون قابل تهیده در فروشگاه ورزشی فیفا است جهت افزودن به سبد خرید روی سبد کلیک کنید.', '2014-01-01', '2017-01-07'),
(2, 'شورت ورزش مشکی', 250000, 15, 3, '2.png', 'شورت ورزشی مخصوص دروازه بان با قیمت استثنایی همینک در فروشگاه فیفا قابل تهیه است.', '2013-01-07', '2016-01-07'),
(3, 'توپ فوتبالی اصل 2010 آفریقای جنوبی', 1000000, 13, 6, '3.png', 'همینک می توانید توپ فوتبالی اصل جام جهانی 2010 آفریقای جنوبی را با قیمیت استثنایی فقط 1 میلیون ریال از فروشگاه ورزشی فیفا تهیه کنید .این توپ فوتبالی دارای ضمانت نامه از خود شرکت آدیداس آلمان می باشد.', NULL, NULL),
(4, 'گرمکن سبز رنگ ورزشی تیم بارسلونا', 1400000, 0, 7, '4.png', 'پس از قهرمانی این فصل بارسلونا در جام قهرمانان فوتبال اروپا طرفداران فوتبال حجوم قابل توجهی برای خرید لباس های این تیم محبوب داشته اند و از این بین پر طرفدارترین محصول این تیم گرمکن سبز رنگ این تیم بود که امروز با قیمتی باور نکردنی در فروشگاه فیفا عرضه می شود.', '2015-06-01', '2017-11-05'),
(5, 'پیراهن سفید تمرینی', 150000, 10, 2, '5.png', 'امروز با یک محصول فوق العاده محبوب و بی نظیر خدمت دوستان هستیم .پیراهن طرح ساده تمرینی فوتبال محصولی بی نظیر از کمپانی نایک که با داشتن طرحی ساده اما شیک توانسته فروش فوق العاده باور نکردنی 2 میلیون در یک ماه را کسب کند. همینک با قیمت مناسب در دسترس دوستان است.', '2013-11-23', '2015-03-09'),
(6, 'جوراب ورزشی دورتموند', 140000, 14, 8, '6.png', 'جوراب ورزشی اصل تیم دورتموند هم اکنون در وبسایت ما قابل تهیه است.', '2014-11-09', '2016-11-10'),
(7, 'کفش استوک دار T90', 1450000, 16, 4, '7.png', 'کفش ستوک دار T90 یکی از محبوب ترین کفش های فوتبالی با قیمت کاملا مناسب و باورنکردنی در فروشگاه فیفا برای شما دوستان.', '2013-11-02', '2016-11-10'),
(8, 'کفش فوتسال آبی نایک', 750000, 10, 9, '8.jpg', 'کفش فوتسالی جدید و محبوب با رنگ نایک آبی در دسترس دوستان است.', '2011-11-02', '2014-11-02'),
(9, 'دست لباس منچستر یونایتد', 2000000, 24, 10, '10.png', 'دست لباس تیم محبوب یونایتد در فصل 2015-2016 از امروز برای مشتریان گرامی در فروشگاه فیفا قابل تهیه است', '2015-12-07', '2016-12-07'),
(10, 'پیراهن منچستر سیتی', 500000, 30, 2, '11.png', 'پیراهن جدید تیم محبوب منچستر سیتی انگلستان امروز بر روی سایت قرار گرفت شما می توانید با قیمت مناسب آن را تهیه فرمایید.', '2015-09-07', '2016-12-21'),
(11, 'پیراهن رئال مادرید', 800000, 18, 2, '13.jpg', 'پیراهن تیم محبوب رئال مادرید با رنگ آبی برای دوستداران این تیم هم اکنون آماده سفارش است پس عجله کنید که تعداد محدود است.', '2015-11-07', '2017-12-08'),
(12, 'گرمکن تیم ملی آلمان', 1100000, 12, 7, '14.jpg', 'گرمکن تیم ملی فوتبال آلمان کلاسیک برای دوستداران تیم ملی آلمان قابل تهیه است', '2013-12-28', '2015-12-08'),
(13, 'پیراهن تیم فنر پاغچه', 450000, 10, 2, '16.jpg', 'پیراهن تیم فوتبال فنرباغچه ترکیه برای دوست داران این تیم هم اکنون از فیفا شاپ قابل تهیه است.', '2014-12-07', '2016-06-01'),
(14, 'توپ تمرینی تیم یونتوس', 500000, 10, 6, '17.jpg', 'توپ تمرینی تیم یونتوس ایتالیا برای فوتبال دوستان از جمله طرفداران راه راه پوشان شهر تورین هم اکنون قابل سفارش است.', '2015-12-16', '2016-12-08'),
(15, 'توپ فوتبال تمرینی منچستر یونایتد', 450000, 23, 6, '18.jpg', 'شیاطین سرخ شهر منچستر همواره یکی از آماده ترین و پرطرفدارترین تیم های جهان بوده اند و در سراسر دنیا محصولات این باشگاه به فروش می رسد امروز یکی از محصولات محبوب این تیم یعنی توپ فوتبال منچستر همراه لوگوی باشگاه در این فروشگاه قابل تهیه است.', '2012-12-15', '2014-12-16'),
(16, 'کفش فوتبالی نایک مدل S12', 1400000, 0, 4, '12.jpg', 'باز هم محصولی جدید از کمپانی بزرگ نایک پیشکش به تمامی فوتبالیست ها هم اکنون برای سفارش اقدام کنید تعداد محدود است.', '2015-11-14', '2017-12-15'),
(17, 'گرمکن ورزشی طرح آبی رنگ', 1000000, 4, 7, '15.jpg', 'امروز برای دوستان گرمکن ورزشی طرح آبی در فروشگاه فیفا برای فروش آماده شده ، این گرمکن با رنگبندی زیبا و  دارای پارچه مرغوب با فناوری نانو ایجاد شده و ساخت کشور ایالات متحده است. ', '2015-12-07', '2020-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `number` int(11) unsigned NOT NULL,
  `price` int(12) unsigned NOT NULL,
  `payment_model` enum('1','2') NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `is_sended` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `block` tinyint(1) DEFAULT '0',
  `register_date` varchar(16) NOT NULL,
  `position` enum('ADMIN','SALER','WRITER','CUSTOMER') NOT NULL DEFAULT 'CUSTOMER',
  `admin_access` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`username`,`email`,`mobile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `address`, `mobile`, `block`, `register_date`, `position`, `admin_access`) VALUES
(1, 'مهدی حاجت پور', 'admin', '4564545456', 'mehdihajatpour0098@gamail.com', 'امیدیه کوی گلستان', '09165043171', 0, '1449013218', 'ADMIN', 1),
(2, 'صمد شریفی', 'samadsh', '1111', 'samadsharifi@yahoo.com', 'امیدیه منازل نیروی انتظامی', '09123244323', 0, '1449013218', 'CUSTOMER', 1),
(3, 'سید خیرالله بهور', 'behvar20', '642411', 'behvar20@gmail.com', 'امیدیه مطهری پشت تدارکات سپاه', '09359949943', 0, '1449013218', 'CUSTOMER', 0),
(4, 'مجتبی جعفرزاده', 'mojtaba.omd', '123456789', 'mojtabajafarzadeh@yahoo.com', 'امیدیه میانکوه', '09168882233', 1, '1449013218', 'CUSTOMER', 0),
(5, 'طاهر شریفات', 'taher70', '1234', 'tahersharifat70@mail.com', 'امیدیه روستای عشاره', '09357778888', 0, '1449013218', 'CUSTOMER', 0),
(6, 'خلیل مطوری', 'khalil1', 'tert54525', 'khalil.sharaifat@gmil.com', 'امیدیه خودیاری', '09168886543', 0, '1449013218', 'CUSTOMER', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
