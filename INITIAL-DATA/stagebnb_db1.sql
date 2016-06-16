-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2016 at 11:05 AM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stagebnb_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE IF NOT EXISTS `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custid` int(11) NOT NULL,
  `custstyleid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subtext` varchar(100) NOT NULL,
  `subtext2` varchar(100) NOT NULL,
  `fastener` varchar(100) NOT NULL,
  `frame` varchar(100) NOT NULL,
  `printorderid` int(11) NOT NULL,
  `rqty` int(11) NOT NULL,
  `font1` varchar(50) DEFAULT '0',
  `font2` varchar(50) DEFAULT '0',
  `font3` varchar(50) DEFAULT '0',
  `fontsize1` varchar(50) DEFAULT '0',
  `fontsize2` varchar(50) DEFAULT '0',
  `fontsize3` varchar(50) DEFAULT '0',
  `dome` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `content` mediumtext,
  `date` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `permanent_link` varchar(255) DEFAULT NULL,
  `link_anchor` varchar(255) DEFAULT NULL,
  `meta_description` mediumtext,
  `meta_keyword` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `date`, `active`, `permanent_link`, `link_anchor`, `meta_description`, `meta_keyword`) VALUES
(7, 'Buying Name Badges Online', 'Do you have a huge and important event coming up? Do you want to make a good impression to your boss? Or you just don''t have the time to make the name badges on your own? Then buying or purchasing name badges online is the answer for you.\r\n\r\nLuckily, nowadays, the Internet is a very useful and powerful tool to use. Everything you want to look for is in the Web. Buying name badges over the Internet can be as easy as ABC. With thousands of companies to choose from, the first thing you have to do is to decide on the best one. In trying to make up your mind on a company, make sure to do research so that you can sleep soundly at night knowing that you put your money in good hands and your product will come out properly.\r\n\r\nThere are many websites that already make you design the name badges yourselves. This will lessen the chore of calling them up and trying to explain to them what you want to happen. The company can give a number of ideas so take your time in choosing the perfect one. After choosing the design, the size of badge comes next. This is relatively easy because the site can give you the actual layout of your product so there is nothing to worry about. With everything in place, the names come next. Double check the number of guests and the spelling of each name because once you have submitted everything to the company it might be close to impossible to recall the badges once you''ve placed your order. So now that everything is in place, you have to do the final step, which is to pay for your orders.\r\n\r\nYou might think twice sending them money online because you''re not sure if the company can be trusted. This is where research comes in. Purchase badges from companies that are known in the industry. To do this, get hold of a list of companies in the industry and read their company profile because usually the longer they have been in the service means that they have solidified their name in the trade. Don''t be afraid to compare prices amongst these companies too. Prices are usually the source of competition amongst them so find a reasonable one. A little tip in payment: A company that supports Paypal can trusted more than those that don''t.\r\n\r\nYou have designed, paid, and ordered the product so now read how long the shipment takes. Shipment usually takes 1 -2 days only but it would better if you would order it at least a week before the scheduled event just in case you encounter any delay. When orders are finalized, make sure to keep the receipt because this will be your proof that you placed an order and that you''re expecting the product on a specific date. You have nothing to worry about now, since you''ve ordered the name badges online and you can concentrate on the other details of the event. Everything can be worry free knowing that in a couple of days the badges will be shipped and the whole thing will come out the way you want it to be.', NULL, 1, 'buying-name-badges-online', 'Buying Name Badges', '', ''),
(8, 'The perfect Valentines gift is name tags', 'Valentines'' day is just around the corner. Aren''t you excited? But wait, one thing, one very important thing that comes into your mind- Valentines gift. What is the perfect Valentines'' gift? May it be for a loved one, for friends, for your sweet sister or tough little brother; we have the perfect gift for you. Name tags are the perfect valentines'' gift for anyone. Name tags are not exclusively given for girls, but for boys as well. Because we believe that everyone values their belongings, or simply, just wants to show off their name. For the lovers, show your loved one how much you value him or her for his or her name, not only that but more importantly, how proud you are for having met him or her. Name tags will give you that. Name tags are customizable, you can actually show him or her how you feel through the design of the name badge and how you actually want to present it. Do you want to show her the sparkle that you see in her eyes? You can through a metallic name badge, you can also choose from silver or gold. Do you want to tell him how much your heart screams his name, you can give him a name badge that is shaped as a heart and a very big "John" for example. You can also choose the font, you would probably want to choose a thick, bubble like font which is reflective of fun and jolly. Is your boy friend a basketball lover? Then give him a basketball shaped name badge that actually bears his name or how you address each other like "honey" or "baby" or "sweetie". You can actually put your ideas into one name badge. The name badge will say it all.\r\n\r\nWell, valentines'' day isn''t just for the lovers out there, it is for families as well. Do you want to tell your brother that you are thankful for his being tough and that he is always there when you need someone to count on? Well, you could give him a name badge in the shape of a dog tag, similar to that being worn by military men, to tell him that you are thankful that he is your brother. That is something he would really appreciate. How about for your sister? Is she a sweet sister, does she love cats or maybe dogs? Furry name tags are perfect for her. The fur can be additional details. You may ask the name badge maker if they have those designs. Give that to your sister on Valentine''s Day and she would surely be sweeter to you. How about for your mom? Most moms are professional, while some choose to stay at home and take care of the family. You can give your mom an executive looking name badge with black and silver details, then her name on it, or nickname or how you like to address her, then for moms who love the kitchen, you can give her a name badge shaped like a pot holder. The name badge is the perfect gift you can give this Valentine''s Day!', NULL, 1, 'perfect-valentines-gift-name-tags', 'Valentines Gifts: Name Tags?', '', ''),
(9, 'Photo ID Badges, Handy Necessities Like Cell Phones', 'What stuffs can you usually find in wallets, pockets, pouches or handbags of almost every individual? Most surveys would definitely result in coins, vanity things, gadgets like cell phones and iPods, but you''ll be surprised that identification cards, especially photo ID badges, would be in the top 10.\r\n\r\nPhoto ID badges and other means of identification are indispensable part of our daily lives. In fact, it has become a necessity that even children are now being subjected to photo ID badges systems as a means to protect and safeguard them.\r\n\r\nBut how exactly do photo ID badges have become a very important part of our daily lives?\r\n\r\nIf you are a student, it is definitely a requirement that you show your photo ID badges to guards or perhaps swipe them through a scanner before you can enter the school premises. These can also be implemented as access keys to libraries, canteens and other school facilities.\r\n\r\nBody buffs certainly have photo ID badges as membership cards on their favorite gyms and health spas. Aside on being a proof of membership, other gyms are tying up with other establishments such as sports wear stores so that their photo ID badges can also serve as discount cards.\r\n\r\nIt is a fact that employees would certainly be in frustration if their photo ID badges are left at home. They cannot enter the workplace and thus their day would be unproductive. Large corporations also use the photo ID badges as security keys on restricted areas such as hazardous areas and places where vaults and other pertinent documents are stored.\r\n\r\nImagine how relieved someone in an emergency situation if health officers, fire marshals or policemen flash their photo ID badges before them. Anyone in an operating room would want an expert doctor to administer the operations.\r\n\r\nIn department stores, restaurants and other establishments, photo ID badges such as credit cards, debit cards and electronic cash cards are also valuable to someone who wants cashless transactions.\r\n\r\nGovernment agencies have also implemented the use of photo ID badges as a means of identification of their employees. The government has long before used photo ID badges when issuing driving license and professional licenses.\r\n\r\nAnother great proof of photo ID badges as a necessity is for a multi-chaptered organization. These types of organizations usually hold meetings and seminars and photo ID badges would be a great way of introducing the members to each and everyone. The photo ID badges can even be customized to bear the chapter''s logo.\r\n\r\nThe many uses of photo ID badges prove that they have become a necessity to everyone''s daily routine. Photo ID badges of all sorts are now playing an important role in different organizational structures such as educational institutions, corporations, clubs, government agencies, and businesses. They have even become hot commodities that some individuals or small businesses see them as a potential source of income. Thus, they have engaged in the production of photo ID badges for others.\r\n\r\nNow who needs photo ID badges, anyway?', NULL, 1, 'photo-id-badges-like-cell-phones', 'Photo ID Badges, Handy Necessities Like Cell Phones', '', ''),
(10, 'The Very Personal Name Badge', 'Andee loves to personalize her things. Her mobile phone has butterfly stickers on them, her laptop is colored pink because that is her favourite color, her books have these cute and colourful bookmarks on them, she doesn''t buy pens that are not colourful and girly. Andee knows how to put color into her world. More importantly, she likes to spice up boring materials in school so that she becomes more inspired to study or read. But one thing is missing with Andee. She likes to personalize her things, but she might have forgotten that cute stuff can actually attract others to just get what isn''t theirs. Andee realized she needed name badges.\r\n\r\nShe didn''t just want to lose her things because she invests time on designing them and these are really personal and very important for her. Andee searched the web for the best way to actually show her ownership of her books, pens, folders and bag and she found name badges! There are a lot of name badge makers all over the internet. Some even offer free shipment. Since Andee is a very personal kind of girl, name badges best suite her because these name badges can actually be personalized according to the style and color that the customers want. What''s more interesting is even the shape can be modified. Andee wouldn''t want a simple symmetric name badge wouldn''t she? Considering that she is a really creative person and is also very particular with details.\r\n\r\nThere are a whole range of choices from rectangle, circle, square, star and since Valentines'' day is just around the corner, you can also have your name badge shaped as a heart. Andee is very keen on details. She loves to modify the details of things like what colour should match her shoes, what pen ink goes for a black page, what hairclip will match her outfit for the day. You can do almost the same thing with the name badges. Since they are very personal and since they carry your name, better make it yours right? You can modify and choose which font you would like to use, what the colour of your name should be, how big should it appear and what is the design of the background. Hmm... should it be a solid colour, patterned or textured? In terms of detail design, what specific elements would you like to use? You can choose from butterflies, stars, hearts, fruits, cats or flowers. There are so many designs to choose from. Would you like your name badge to appear 3D or embossed or do you want an outline for your name or drop shadow?\r\n\r\nAndee is definitely getting a name badge! She doesn''t want to end up losing her things right? You may ask where I can get those name badges at an affordable price. Well, you are exactly at the right place and at the right time- the internet! Go ahead and surf the net for websites that offer name badge making at an affordable price!', NULL, 1, 'very-personal-name-badge', 'The Very Personal Name Badge', '', ''),
(12, 'Best Name Badges Coupon Codes', '<p>Best Name Badges Current Coupon and Promotional Promo Codes:</p>\r\n<p><strong>Current Code:&nbsp;</strong> <span style="font-size: large; color: #ff6600;"><strong>WINTER10</strong></span> (save 10% on your order)</p>\r\n<p>&nbsp;</p>\r\n<h3>Did you know?</h3>\r\n<p>Best Name Badges <span style="text-decoration: underline;">accepts coupon codes from competitors!</span>&nbsp; Please call us right away at 888-445-7601 and we''ll honor most competitors coupons.</p>', NULL, 1, 'best-name-badges-coupon-codes', 'Best Name Badges Coupon Codes', '', ''),
(13, 'Name Badges For Nurses', '<p>I never really noticed name badges at doctors offices until I started working here at Best Name Badges.&nbsp; But I can tell you one thing, I notice them now!</p>\r\n<p>We seem to get orders for nurse name badges almost every single day.&nbsp; And medical facilities make up a huge portion of our business.</p>\r\n<p>Are you a nurse or doctors office that needs name badges?&nbsp; We can help you out!&nbsp; You can order your name badges by clicking the button above or just call us anytime.&nbsp;&nbsp; We have a lot of experience working with nurses and would love to provide you with the best quality name tags available.</p>\r\n<p>Looking forward to working with you soon!</p>\r\n<p>-Ryan<br />888-445-7601</p>', NULL, 1, 'name-badges-for-nurses', 'Name Badges For Nurses', '', 'name badges for nurses, medical name badges, doctors office name badges, name tags'),
(14, 'We Now Do Laser Engraving', '<p>Best Name Badges is proud to announce that we now do laser engraving!</p>\r\n<p>We just secured our world class, high resolution laser system.&nbsp; We have conveniently added the order option to our website to make it easier for you to order your badges.</p>\r\n<p>Many customers are having us print their logo in full color, then laser engrave the names.&nbsp; And the badges come out beautiful.</p>\r\n<p>Don''t get stuck with inferior quality engraving, like the old style rotary engravers.&nbsp; Our laser can produce even the finest details.&nbsp; We can even engrave photos!</p>\r\n<p>If you need <a href="../engraved-name-badges.php">engraved name badges</a>, please don''t hesitate to reach out to us.</p>\r\n<p>&nbsp;</p>\r\n<p>If you aren''t familiar with laser engraving, it''s a process that uses a very high power laser light to etch/engrave into material.&nbsp; Not only can we engrave the material, but we are also able to cut with the laser.&nbsp; This means even fine detailed custom shaped name badges can be made.</p>\r\n<p>We have had some interesting requests lately from our customers, and we have made some really cool laser cut badges for them - even including a Sheriff Star for a fun event.</p>', NULL, 1, 'laser-engraving', 'Laser Engraved Name Badges', 'Laser engraved name badges, name tags, and more.  Our world class laser provides for even the finest detailed badges.', ''),
(15, 'Custom Signs - Easier Than Ever', '<p>Ordering custom signs has never been easier. &nbsp;Don''t think you have to chose from premade signs - take advantage of our super efficient system and have a fully custom sign created for the price of a generic one.</p>\r\n<p>Many customers have great ideas for their designs. &nbsp;But if you don''t quite know what you want, our staff is more than happy to help you come up with a great design that will be perfect for your sign.</p>\r\n<p>Our custom signs are available in almost any size up to 24", in full color, engraved, or both!</p>\r\n<p>Call or email us right away, we''ll provide a free price quote right away.</p>', NULL, 1, 'custom-signs', 'Custom Signs - Easier Than Ever', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `styleid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `imglink` varchar(100) NOT NULL,
  `backgroundimage` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `styleid`, `name`, `imglink`, `backgroundimage`) VALUES
(25, 18, 'Silver', 'silver.jpg', 'AL-Silver-1x3.jpg'),
(24, 17, 'Gold', 'gold.jpg', 'PVC-Gold-1x3.jpg'),
(20, 16, 'Silver', 'silver.jpg', 'PVC-Silver-15x3.jpg'),
(19, 16, 'White', 'white.jpg', 'PVC-White-15x3.jpg'),
(23, 17, 'Silver', 'silver.jpg', 'PVC-Silver-1x3.jpg'),
(22, 17, 'White', 'white.jpg', 'PVC-White-1x3.jpg'),
(21, 16, 'Gold', 'gold.jpg', 'PVC-Gold-15x3.jpg'),
(26, 18, 'Gold', 'gold.jpg', 'AL-Gold-1x3.jpg'),
(27, 19, 'Silver', 'silver.jpg', 'AL-Silver-15x3.jpg'),
(28, 19, 'Gold', 'gold.jpg', 'AL-Gold-15x3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `customer_bucketname` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inventory` int(11) NOT NULL,
  `finventory` int(11) NOT NULL,
  `street` varchar(150) NOT NULL,
  `street2` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(15) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `country` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `dminventory` int(11) DEFAULT '0',
  `notes` mediumtext,
  `status` varchar(50) NOT NULL DEFAULT 'new',
  `sale_id` int(11) NOT NULL COMMENT 'sale id is id of user(admin)',
  `is_sent` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not sent to sale, 1: had sent to sale',
  `follow_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `firstname`, `lastname`, `companyname`, `customer_bucketname`, `password`, `email`, `timestamp`, `inventory`, `finventory`, `street`, `street2`, `city`, `state`, `zip`, `phone`, `country`, `ip`, `dminventory`, `notes`, `status`, `sale_id`, `is_sent`, `follow_user_id`) VALUES
(1, 'qwe', 'qwe', 'Kumar', 'CGT', '1_1448962235', '123456', 'kapil@cgt.co.in', '2015-12-01 09:30:35', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(2, 'sdf', 'sdf', 'Kumar', 'CGT', '2_1448962220', '123456', 'kapil@cgt.co.in', '2015-12-01 09:30:20', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(3, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(4, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(5, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(6, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(7, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(8, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(9, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(10, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(11, 'kk kk ', 'qwe', 'Kumar', 'CGT', '11_kk_kk__1445325099', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:39', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(12, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-09-30 11:29:19', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(13, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-10-20 07:11:18', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(14, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(15, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(16, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(17, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(18, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(19, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(20, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(21, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(22, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(23, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(24, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(25, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(26, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(27, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(28, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(29, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(30, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(31, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(32, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(33, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(34, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(35, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(36, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(37, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(38, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(39, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(40, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(41, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(42, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(43, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(44, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(45, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(46, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(47, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(48, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(49, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(50, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(51, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(52, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(53, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(54, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(55, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(56, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(57, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(58, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(59, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(60, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(61, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(62, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(63, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(64, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(65, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(66, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(67, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(68, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(69, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(70, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(71, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(72, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(73, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(74, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(75, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(76, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(77, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(78, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(79, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(80, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(81, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(82, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(83, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(84, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(85, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(86, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(87, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(88, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(89, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(90, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(91, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(92, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(93, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(94, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(95, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(96, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(97, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(98, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(99, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(100, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(101, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(102, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(103, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(104, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(105, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(106, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(107, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(108, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(109, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(110, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(111, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(112, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(113, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(114, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(115, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(116, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(117, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(118, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(119, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(120, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(121, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(122, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(123, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(124, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(125, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(126, 'qwe', 'qwe', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:21', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(127, 'sdf', 'sdf', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:25', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(128, 'gnbbv', 'gnbbv', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:29', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(129, 'tyfb', 'tyfb', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-08-04 09:40:32', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(130, 'kapil', 'Kapil', 'Kumar', 'CGT', '', '123456', 'kapil@cgt.co.in', '2015-06-16 18:26:54', 1, 1, 'test', 'test', 'jodhpur', 'IN', '342001', '78946546645', 'US', '202.78.172.179', 2, NULL, 'Archive', 6, 1, 6),
(131, 'abhay', 'Abhay', 'Sharma', 'CGT', '', 'techno#123', 'abhay@cgt.co.in', '2016-01-21 09:52:59', 0, 0, '6th chopsani road', '', 'Jodhpur', 'IN', '342001', '44465465487654', 'US', '202.78.172.178', 0, NULL, 'new', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `custstyle`
--

CREATE TABLE IF NOT EXISTS `custstyle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stylename` varchar(100) NOT NULL,
  `subtext` int(11) NOT NULL DEFAULT '0',
  `custid` int(11) NOT NULL,
  `styleid` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `logo1` varchar(100) NOT NULL,
  `logo2` varchar(100) NOT NULL,
  `logo3` varchar(100) NOT NULL,
  `proof` varchar(100) NOT NULL,
  `notes` longtext NOT NULL,
  `whitebox` int(11) NOT NULL DEFAULT '0',
  `tweak` int(11) NOT NULL DEFAULT '0',
  `reusable` int(11) NOT NULL DEFAULT '0',
  `tag` int(11) NOT NULL,
  `lines` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `custstyle`
--

INSERT INTO `custstyle` (`id`, `stylename`, `subtext`, `custid`, `styleid`, `color`, `logo1`, `logo2`, `logo3`, `proof`, `notes`, `whitebox`, `tweak`, `reusable`, `tag`, `lines`, `paid`) VALUES
(1, 'Test', 0, 1, 16, 19, '', '', '', '', '', 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of table invoice',
  `invoice_number` char(50) CHARACTER SET utf8 NOT NULL COMMENT 'invoice number',
  `data_of_issue` char(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Date if issue',
  `discount` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `paid_to_date` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `po_number` char(50) CHARACTER SET utf8 NOT NULL COMMENT 'PO number',
  `invoice_status` char(10) CHARACTER SET utf8 NOT NULL DEFAULT 'unpaid' COMMENT 'paid or unpaid of payment',
  `customer_id` int(11) NOT NULL COMMENT 'Id of customer',
  `internal_note` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Internal notes',
  `note_visible_to_client` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Notes Visible to Clients',
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companyname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `rand_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_client_public` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `total` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remove_tax` tinyint(1) NOT NULL DEFAULT '0',
  `sale_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=161 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `data_of_issue`, `discount`, `paid_to_date`, `po_number`, `invoice_status`, `customer_id`, `internal_note`, `note_visible_to_client`, `firstname`, `lastname`, `companyname`, `address`, `address2`, `city`, `country`, `state`, `zip`, `phone`, `email`, `rand_code`, `is_client_public`, `total`, `remove_tax`, `sale_id`) VALUES
(1, '61246', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(2, '61247', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(3, '61248', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(4, '61249', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(5, '61250', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(6, '61251', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(7, '61252', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(8, '61253', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(9, '61254', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(10, '61255', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(11, '61256', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(12, '61257', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(13, '61258', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(14, '61259', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(15, '61260', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(16, '61261', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(17, '61262', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(18, '61263', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(19, '61264', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(20, '61265', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(21, '61266', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(22, '61267', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(23, '61268', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(24, '61269', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(25, '61270', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(26, '61271', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(27, '61272', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(28, '61273', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(29, '61274', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(30, '61275', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(31, '61276', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(32, '61277', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(33, '61278', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(34, '61279', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(35, '61280', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(36, '61281', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(37, '61282', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(38, '61283', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(39, '61284', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(40, '61285', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(41, '61286', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(42, '61287', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(43, '61288', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(44, '61289', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(45, '61290', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(46, '61291', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(47, '61292', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(48, '61293', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(49, '61294', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(50, '61295', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(51, '61296', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(52, '61297', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(53, '61298', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(54, '61299', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(55, '61300', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(56, '61301', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(57, '61302', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(58, '61303', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(59, '61304', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(60, '61305', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(61, '61306', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(62, '61307', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(63, '61308', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(64, '61309', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(65, '61310', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(66, '61311', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(67, '61312', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(68, '61313', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(69, '61314', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(70, '61315', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(71, '61316', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(72, '61317', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(73, '61318', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(74, '61319', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(75, '61320', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(76, '61321', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(77, '61322', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(78, '61323', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(79, '61324', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(80, '61325', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(81, '61326', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(82, '61327', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(83, '61328', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(84, '61329', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(85, '61330', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(86, '61331', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(87, '61332', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(88, '61333', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(89, '61334', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(90, '61335', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(91, '61336', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(92, '61337', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(93, '61338', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(94, '61339', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(95, '61340', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(96, '61341', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(97, '61342', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(98, '61343', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(99, '61344', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(100, '61345', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(101, '61346', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(102, '61347', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(103, '61348', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(104, '61349', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(105, '61350', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(106, '61351', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(107, '61352', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(108, '61353', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(109, '61354', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(110, '61355', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(111, '61356', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(112, '61357', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(113, '61358', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(114, '61359', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(115, '61360', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(116, '61361', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(117, '61362', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(118, '61363', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(119, '61364', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(120, '61365', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(121, '61366', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(122, '61367', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(123, '61368', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(124, '61369', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(125, '61370', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(126, '61371', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(127, '61372', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(128, '61373', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(129, '61374', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(130, '61375', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(131, '61376', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(132, '61377', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(133, '61378', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(134, '61379', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(135, '61380', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(136, '61381', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(137, '61382', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(138, '61383', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(139, '61384', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(140, '61385', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(141, '61386', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(142, '61387', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(143, '61388', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(144, '61389', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(145, '61390', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(146, '61391', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(147, '61392', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(148, '61393', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(149, '61394', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(150, '61395', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(151, '61396', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(152, '61397', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(153, '61398', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '1.5', 0, 6),
(154, '61399', '06/06/2015', '', '<br /><b>Warning</b>:  number_format() expects parameter 1 to be double string given in <b>/opt/lampp/htdocs/sites/BNB_stage/admin/invoice_payment.php</b> on line <b>288</b><br />', '', 'unpaid', 1, 'test', 'test', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'FX4NPLwtVTq3QJMYhKmcxWfy7Rdjp9vCHkZG8bnrBDg2z6', 'yes', '0', 0, 6),
(155, '61400', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(156, '61401', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '0', 0, 6),
(157, '157', '06/10/2015', '', '1.75', '20', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '0', 0, 6),
(158, '61403', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '1.75', 0, 6),
(159, '61404', '06/10/2015', '', '1.75', '', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '0', 0, 6),
(160, '160', '06/10/2015', '', '1.75', '20', 'paid', 1, '', '', 'Kapil', 'Kumar', 'CGT', 'test', 'test', 'jodhpur', 'US', 'IN', '342001', '78946546645', 'kapil@cgt.co.in', 'kvGYncRF8dBpW3QHCmt4wyzjV7MgPZ92JX6DhqxKrbfNTL', 'yes', '0', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `item_invoice`
--

CREATE TABLE IF NOT EXISTS `item_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of item',
  `item` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `unit_cost` char(50) CHARACTER SET utf8 NOT NULL,
  `qty` char(50) CHARACTER SET utf8 NOT NULL,
  `tax` char(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `total` char(50) CHARACTER SET utf8 NOT NULL,
  `invoice_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `item_invoice`
--

INSERT INTO `item_invoice` (`id`, `item`, `description`, `unit_cost`, `qty`, `tax`, `total`, `invoice_id`) VALUES
(1, 'Test', 'Item1', '1.50', '1', '0', '1.50', 1),
(2, 'item 1', 'test', '1.75', '1', '0', '1.75', 2);

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE IF NOT EXISTS `logos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_placement` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo_engraving` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_order_wizard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `path`, `logo_placement`, `logo_engraving`, `id_order_wizard`) VALUES
(1, '/logosnew/about_img01.png', '', '', 8),
(2, '/logosnew/anspic3.jpg', '', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `styleid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` int(11) NOT NULL,
  `fqty` int(11) NOT NULL,
  `newstyle` int(11) NOT NULL DEFAULT '0',
  `totalprice` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `paid` int(11) NOT NULL DEFAULT '0',
  `dmqty` int(11) DEFAULT '0',
  `invoice_id1` int(11) DEFAULT '0',
  `invoice_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerid`, `styleid`, `timestamp`, `qty`, `fqty`, `newstyle`, `totalprice`, `status`, `paid`, `dmqty`, `invoice_id1`, `invoice_id`) VALUES
(1, 1, 0, '2015-06-08 09:33:36', 1, 0, 0, 1.5, 0, 0, 0, 0, 1),
(2, 1, 0, '2015-06-08 10:28:43', 1, 0, 0, 1.5, 0, 0, 0, 0, 1),
(3, 1, 0, '2015-06-08 10:34:52', 1, 0, 0, 1.5, 0, 0, 0, 0, 1),
(4, 1, 0, '2015-06-10 12:37:33', 1, 0, 0, 1, 0, 0, 0, 0, 2),
(5, 1, 0, '2015-06-10 12:40:21', 1, 0, 0, 1, 0, 0, 0, 0, 2),
(6, 1, 0, '2015-06-11 18:27:46', 1, 1, 0, 14.12, 0, 0, 1, 0, 0),
(7, 1, 0, '2015-06-11 18:29:25', 1, 0, 0, 1, 0, 0, 0, 0, 2),
(8, 1, 0, '2015-06-16 16:47:04', 1, 0, 0, 1, 0, 0, 0, 0, 2),
(9, 1, 0, '2015-06-16 16:48:04', 1, 0, 0, 1, 0, 0, 0, 0, 2),
(10, 1, 0, '2015-06-16 16:49:48', 1, 0, 0, 1.75, 0, 0, 0, 0, 2),
(11, 1, 0, '2015-06-16 18:20:54', 1, 0, 0, 1.75, 0, 0, 0, 0, 2),
(12, 1, 0, '2015-06-16 18:26:54', 0, 0, 0, 2.75, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_wizard`
--

CREATE TABLE IF NOT EXISTS `order_wizard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `badge_color` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `frame` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `backing_fastener` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `num_baged` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `num_plates` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `num_holders` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `type_holder` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `material_holder` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `holder_color_first` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `holder_color_second` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plate_color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imprint_method` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `delivery` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1: Standard ,0:Expedited ',
  `delivered_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pre_print_logo` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'value = yes or no',
  `software` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'value="yes" or "no"',
  `velvet_carry_pouch` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'value="yes" or "no"',
  `printer_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'value= "InkJet" or "Laser" or "Not Sure"',
  `orientation` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1: Horizontal,0: Vertical',
  `lanyard` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1: yes, 0: no',
  `lanyard_color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `your_photo_id_badge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `your_file_name_plate` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `order_wizard`
--

INSERT INTO `order_wizard` (`id`, `size`, `badge_color`, `frame`, `dome`, `backing_fastener`, `notes`, `num_baged`, `num_plates`, `num_holders`, `type_holder`, `material_holder`, `holder_color_first`, `holder_color_second`, `attachment`, `plate_color`, `imprint_method`, `delivery`, `delivered_by`, `created_date`, `customer_id`, `sale_id`, `type`, `pre_print_logo`, `software`, `velvet_carry_pouch`, `printer_type`, `orientation`, `lanyard`, `lanyard_color`, `your_photo_id_badge`, `your_file_name_plate`, `status`) VALUES
(1, '1x3', 'Plastic-Gold', 'GF', '1', 'Magnet', 'Test Message', '2', '0', '0', '', '', '', '', '', '', '', '1', '', '05/22/2015 03:18:22', 1, 0, 'Engraved Name Tags', 'no', 'no', 'Yes', '', '1', '1', '', '', '', 'new'),
(2, '15x3', 'Plastic-Silver', 'GF', '0', '', 'test', '2', '0', '0', '', '', '', '', '', '', '', '1', '', '05/22/2015 03:25:50', 1, 0, 'Digitally Printed Pro Badges', 'no', 'no', 'No', '', '1', '1', '', '', '', 'new'),
(3, '1x3', 'Plastic-White', 'GF', '1', 'Magnet', 'test', '10', '0', '0', '', '', '', '', '', '', '', '1', '', '05/27/2015 06:24:35', 1, 0, 'Digitally Printed Pro Badges', 'no', 'no', 'No', '', '1', '1', '', '', '', 'new'),
(4, '15x3', 'Plastic-Gold', 'SF', '0', '', 'test', '1', '0', '0', '', '', '', '', '', '', '', '1', '', '05/27/2015 06:24:42', 1, 0, 'Engraved Name Tags', 'no', 'no', 'No', '', '1', '1', '', '', '', 'new'),
(5, '1x3', 'Plastic-White', 'GF', '1', 'Magnet', 'test', '10', '0', '0', '', '', '', '', '', '', '', '1', '', '05/27/2015 06:26:16', 1, 0, 'Digitally Printed Pro Badges', 'no', 'no', 'No', '', '1', '1', '', '', '', 'new'),
(6, '1x3', 'Plastic-White', 'GF', '1', 'Magnet', 'test', '10', '0', '0', '', '', '', '', '', '', '', '1', '', '05/27/2015 06:26:32', 1, 0, 'Digitally Printed Pro Badges', 'no', 'no', 'No', '', '1', '1', '', '', '', 'sent'),
(7, '1x3', 'Plastic-Silver', 'none', '0', 'Magnet', 'Test<br> <b>01/21/2016 - 04:42 am-Ryan Ellis</b> test{note}<br> <b>01/21/2016 - 04:51 am-Ryan Ellis</b> test 1{note}', '1', '0', '0', '', '', '', '', '', '', '', '1', '', '01/21/2016 04:54:57', 131, 6, 'Digitally Printed Pro Badges', 'no', 'no', 'No', '', '1', '1', '', '', '', 'sent'),
(8, '15x3', 'Plastic-Silver', 'none', '1', 'Magnet', '', '5', '0', '0', '', '', '', '', '', '', '', '1', '', '01/21/2016 05:11:53', 131, 0, 'Engraved Name Tags', 'no', 'no', 'No', '', '1', '1', '', '', '', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `preceipts`
--

CREATE TABLE IF NOT EXISTS `preceipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `preceipts`
--

INSERT INTO `preceipts` (`id`, `oid`, `date`, `name`, `address`, `address2`, `city`, `state`, `zip`) VALUES
(1, 0, '2015/06/08', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(2, 0, '2015/06/08', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(3, 1, '2015/06/08', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(4, 2, '2015/06/10', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(5, 3, '2015/06/10', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(6, 4, '2015/06/11', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(7, 5, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(8, 6, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(9, 7, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001'),
(10, 8, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001');

-- --------------------------------------------------------

--
-- Table structure for table `printorders`
--

CREATE TABLE IF NOT EXISTS `printorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `paid` int(11) NOT NULL DEFAULT '0',
  `note` mediumtext NOT NULL,
  `priority` int(11) DEFAULT '0',
  `customer_note` mediumtext,
  `proof_product` char(1) DEFAULT NULL,
  `proof_status` char(50) NOT NULL DEFAULT 'new',
  `new_old` char(50) NOT NULL DEFAULT 'new' COMMENT 'new or old order',
  `tracking_number` char(50) NOT NULL,
  `payment_method` tinyint(4) NOT NULL COMMENT '1: fedex, 0: USPS',
  `invoice_id1` int(11) DEFAULT '0',
  `invoice_id` int(11) DEFAULT '0',
  `type` tinyint(4) NOT NULL,
  `prod_status` varchar(20) NOT NULL DEFAULT 'New',
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `printorders`
--

INSERT INTO `printorders` (`id`, `custid`, `timestamp`, `status`, `paid`, `note`, `priority`, `customer_note`, `proof_product`, `proof_status`, `new_old`, `tracking_number`, `payment_method`, `invoice_id1`, `invoice_id`, `type`, `prod_status`, `created_time`) VALUES
(1, 1, '2015-06-08 10:34:52', 0, 1, 'test', 0, 'test', NULL, 'new', 'new', '', 0, 0, 1, 0, 'New', '2015-06-08 06:34:52'),
(2, 1, '2015-06-10 12:37:33', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-10 08:37:33'),
(3, 1, '2015-06-10 12:40:21', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-10 08:40:21'),
(4, 1, '2015-06-11 18:29:25', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-11 14:29:25'),
(5, 1, '2015-06-16 16:47:04', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-16 16:47:04'),
(6, 1, '2015-06-16 16:48:04', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-16 12:48:04'),
(7, 1, '2015-06-16 16:49:48', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-16 12:49:48'),
(8, 1, '2015-06-16 18:20:54', 0, 1, '', 0, '', NULL, 'new', 'new', '', 0, 0, 2, 0, 'New', '2015-06-16 14:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE IF NOT EXISTS `promo_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `name`, `percentage`, `type`) VALUES
(5, 'CAPLAN10', 'Friends of Caplan 10%', 10, 2),
(13, 'SETUP100', '100% Discount of Setup Fee', 100, 1),
(4, '50SETUP', '50% Off Setup Fee', 50, 1),
(8, 'MIL15', 'Your Service Is Appreciated.', 15, 2),
(9, '5PERCENT', '5 Percent Discount', 5, 2),
(10, 'CHAT5', 'Thank you for chatting with us!', 5, 2),
(14, 'DINNER', 'Thanks!', 15, 2),
(15, 'SUMMER10', 'It''s A Name Badge Summer!', 10, 2),
(16, 'APR5', 'Competitor Coupon Code Match!', 5, 2),
(17, 'WINTER10', 'Thank You!', 10, 2),
(18, 'CYBERMONDAY', 'Cyber Monday 30%', 30, 2),
(19, 'CYBER20', 'Cyber Monday 20%', 20, 2),
(20, 'MAXWELL', 'Maxwell Promo Code', 5, 2),
(21, '7PERCENT', '7 Percent Discount', 7, 2),
(22, 'WINTER5', 'Save 5', 5, 2),
(23, 'AKAALO', 'Special Pricing Discount', 32.5, 2),
(24, '8PERCENT', '8% off total order', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bqty` int(11) NOT NULL,
  `bunit` double NOT NULL,
  `fqty` int(11) NOT NULL,
  `funit` double NOT NULL,
  `blankqty` int(11) NOT NULL,
  `blankunit` double NOT NULL,
  `tax` double NOT NULL,
  `shipping` double NOT NULL,
  `setup` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `promocode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `discount` double NOT NULL,
  `dmqty` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `oid`, `date`, `name`, `address`, `address2`, `city`, `state`, `zip`, `bqty`, `bunit`, `fqty`, `funit`, `blankqty`, `blankunit`, `tax`, `shipping`, `setup`, `status`, `promocode`, `discount`, `dmqty`) VALUES
(1, 1, '2015/06/08', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(2, 2, '2015/06/08', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(3, 3, '2015/06/08', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(4, 4, '2015/06/10', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(5, 5, '2015/06/10', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(6, 6, '2015/06/11', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 1, 9.37, 1, 2, 0, 0, 0, 0, 0, 0, '', 0, 1),
(7, 7, '2015/06/11', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(8, 8, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(9, 9, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(10, 10, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(11, 11, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 0),
(12, 12, '2015/06/16', 'Kapil Kumar', 'test', 'test', 'jodhpur', 'IN', '342001', 0, 9.37, 0, 2, 0, 0, 0, 0, 0, 0, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE IF NOT EXISTS `styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `imglink` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `name`, `size`, `imglink`) VALUES
(17, ' Plastic Pro Badge', '1" x 3"', '10_1x3-name-badge.jpg'),
(16, 'Plastic Pro Badge', '1.5" x 3"', '10_15x3-name-badge.jpg'),
(18, 'Brushed Aluminum Badge', '1" x 3"', '10_1x3-aluminum-name-badge.jpg'),
(19, 'Brushed Aluminum Badge', '1.5" x 3"', '10_15x3-aluminum-name-badge.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `content` mediumtext,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `permanent_link` varchar(255) DEFAULT NULL,
  `link_anchor` varchar(255) DEFAULT NULL,
  `meta_description` mediumtext,
  `meta_keyword` mediumtext,
  `proof` varchar(255) DEFAULT NULL,
  `stylename` varchar(255) DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `frame` tinyint(1) DEFAULT '1' COMMENT '1: none, 2: silver, 3: gold',
  `dome` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `title`, `content`, `date`, `permanent_link`, `link_anchor`, `meta_description`, `meta_keyword`, `proof`, `stylename`, `private`, `frame`, `dome`) VALUES
(12, 'CVS', '<p>A common CVS name badge.</p>\r\n<p><span style="text-decoration: underline;"><strong>We can make fully custom CVS name badges as well, please reach out to use for FREE design assistance.</strong></span></p>', '2011-09-19 18:50:30', 'cvs-template', 'CVS Template', 'CVS Name badge', 'CVS Name badge', '../proofs/13164583619919692482_style1.jpg', 'CVS-1', 0, 1, 0),
(13, 'VSPDT Badge C01', '<p>1.5" x 3" - VSPDT Name Badge</p>\r\n<p>To Order:</p>\r\n<ul>\r\n<li>Click "Order Now" below</li>\r\n<li>Enter your information on the next page and submit</li>\r\n<li>Enter your name on "Line 1" and location on "Line 2"</li>\r\n<li>Continue through checkout</li>\r\n</ul>', '2011-09-19 19:03:34', 'vspdt-c01', 'vspdt c01', '', '', '../proofs/13174044528425729193_stylec01.jpg', 'C01', 0, 1, 0),
(14, 'VSPDT Badge B02', '<p>1" x 3" - VSPDT Name Badge</p>\r\n<p>To Order:</p>\r\n<ul>\r\n<li>Click "Order Now" below</li>\r\n<li>Enter your information on the next page and submit</li>\r\n<li>Enter your name on "Line 1" and location on "Line 2"</li>\r\n<li>Continue through checkout</li>\r\n</ul>', '2011-09-30 17:42:06', 'vspdt-b02', 'vspdt-b02', '', '', '../proofs/13174045475633379205_styleb02.jpg', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `textlines`
--

CREATE TABLE IF NOT EXISTS `textlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `font` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_order_wizard` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `userlevel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `userlevel`) VALUES
(6, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Ryan Ellis', 'ryan@crucialclick.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
