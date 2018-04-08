-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-08 09:04:36
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jiihomeshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `jii_address`
--

CREATE TABLE `jii_address` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `user_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户Id',
  `name` varchar(50) NOT NULL COMMENT '收件人',
  `mobile` varchar(20) NOT NULL COMMENT '手机号',
  `city` varchar(50) NOT NULL COMMENT '城市',
  `address` varchar(100) NOT NULL COMMENT '详细地址',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '是否默认 '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收货地址';

--
-- 转存表中的数据 `jii_address`
--

INSERT INTO `jii_address` (`id`, `user_id`, `name`, `mobile`, `city`, `address`, `status`) VALUES
(1, 1, '李钢', '18720920196', '北京市市辖区东城区', '三里屯', 1),
(2, 1, '李钢', '17621063261', '北京市市辖区东城区', '五道口', 0),
(3, 3, '李钢', '17621063261', '北京市市辖区东城区', '三里屯', 1),
(4, 4, '吴超', '13429345726', '浙江省宁波市慈溪市', '大创园', 1),
(5, 4, '吴先生', '13429345726', '北京市市辖区东城区', '你', 0);

-- --------------------------------------------------------

--
-- 表的结构 `jii_admin`
--

CREATE TABLE `jii_admin` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员';

--
-- 转存表中的数据 `jii_admin`
--

INSERT INTO `jii_admin` (`id`, `username`, `password`) VALUES
(1, 'root', '48601017c9c217061bc9c231f246ca7f'),
(2, 'ligo', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `jii_attribute`
--

CREATE TABLE `jii_attribute` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `attr_name` varchar(30) NOT NULL COMMENT '属性名称',
  `attr_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '属性类型',
  `attr_option_values` varchar(300) NOT NULL DEFAULT '' COMMENT '属性值',
  `type_id` mediumint(8) UNSIGNED NOT NULL COMMENT '类型ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性';

--
-- 转存表中的数据 `jii_attribute`
--

INSERT INTO `jii_attribute` (`id`, `attr_name`, `attr_type`, `attr_option_values`, `type_id`) VALUES
(1, '材质', 2, '美国黑胡桃木,水曲柳,金属,橡木,布艺,铁架,橡木,MDF台面,实木层板,夹板靠背', 1),
(2, '颜色', 2, '原木色,白色,黑色,玫瑰金色,雅黑,雅灰,砂红,镍色', 1),
(3, '重量', 1, '', 1),
(4, '材质', 1, '', 1),
(5, '规格', 1, '', 1),
(6, '颜色', 1, '', 1),
(7, '规格', 2, '75*85*36,85*95*46', 1);

-- --------------------------------------------------------

--
-- 表的结构 `jii_brand`
--

CREATE TABLE `jii_brand` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `name` varchar(30) NOT NULL COMMENT '品牌名称',
  `desc` varchar(500) NOT NULL COMMENT '品牌描述',
  `order_id` smallint(5) UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序',
  `is_index` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否显示',
  `img_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌图',
  `logo_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `first_char` varchar(2) NOT NULL DEFAULT '' COMMENT '首字母'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌';

--
-- 转存表中的数据 `jii_brand`
--

INSERT INTO `jii_brand` (`id`, `name`, `desc`, `order_id`, `is_index`, `img_src`, `logo_src`, `first_char`) VALUES
(1, 'marmo', '由 Marmo 所呈现的产品，工艺精湛，造型优美，并为 空间赋予您的独特印记。精简的造型与卓越的匠心是 我们对抗时间的准则。我们承诺所有 Marmo 产品均 采用高档原材料，通过一遍遍的精工细琢，只为传递 出好品质应有的温度，私人化以及融合性。我们相信 好设计的永恒性，所以上等的五金，低调的细节以及 灵 活 的 结 构 ，都 是 M a r m o 一 直 以 来 的 追 求 。在 尽 量 控制成本的前提下，我们不断探索着创意的可能性。 从设计到面料，我们关心产品生命周期里的每一个环 节，所以我们耐心地来回调整座椅靠背的曲线弧度， 细心地更换一块纹路更深的大理石台面，只为更好 的 出 品 。', 100, 1, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/9164品牌大图.jpg?', 'http://p5koaz6je.bkt.clouddn.com/view/images/brandLogo/2018/03/22/2559logo.png?', 'M'),
(2, 'TAZZ', '中国美术学院血统，全心全力主张“设计面前人人平等”的生态型原创设计品牌。', 100, 1, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/32042品牌大图.jpeg?', 'http://p5koaz6je.bkt.clouddn.com/view/images/brandLogo/2018/03/22/5653logo.png?', 'T'),
(3, 'umbra', 'Paul Rowan (保罗‧罗曼) 及 Les Mandelbaum (乐斯‧曼特巴)在1979年创立了Umbra。\r\nUmbra是拉丁语“窗帘”的意思，两位创始人当年苦于无法购买到自己喜欢的窗帘，无奈自己设计了一款，不料却迅速风靡市场，umbra品牌就此诞生。作为当代时尚休闲家居用品的领导者，Umbra尽管每件产品都经过精心设计和选材，但价格合理公道为大众所接受。\r\nUmbra是全世界提供原创、摩登、休闲且超值的时尚家居家饰产品的行业领袖。Umbra公司成立于1979年，总部位于加拿大多伦多。\r\n30多年来，Umbra在休闲时尚的家居设计行业独树一帜，公司产品覆盖118个国家的35，000 家零售店。来自全球各国的30多位男女设计师组成了Umbra 的明星设计团队，他们为每间居室设计与众不同的家居产品。', 100, 1, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/12472品牌大图.jpg?', 'http://p5koaz6je.bkt.clouddn.com/view/images/brandLogo/2018/03/22/18203品牌logo.png?', 'U');

-- --------------------------------------------------------

--
-- 表的结构 `jii_cart`
--

CREATE TABLE `jii_cart` (
  `user_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(50) NOT NULL COMMENT '商品属性ID',
  `cart_number` mediumint(8) UNSIGNED NOT NULL DEFAULT '1' COMMENT '购物数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车';

--
-- 转存表中的数据 `jii_cart`
--

INSERT INTO `jii_cart` (`user_id`, `goods_id`, `goods_attr_id`, `cart_number`) VALUES
(1, 1, '1,2,68', 2),
(1, 1, '65,67,68', 4),
(1, 1, '66,67,69', 2);

-- --------------------------------------------------------

--
-- 表的结构 `jii_category`
--

CREATE TABLE `jii_category` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'id',
  `name` varchar(30) NOT NULL COMMENT '分类名称',
  `parent_id` mediumint(8) UNSIGNED NOT NULL COMMENT '父级ID',
  `is_index` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否显示',
  `order_id` smallint(5) UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序',
  `img_src` varchar(150) NOT NULL DEFAULT '' COMMENT '分类图'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类';

--
-- 转存表中的数据 `jii_category`
--

INSERT INTO `jii_category` (`id`, `name`, `parent_id`, `is_index`, `order_id`, `img_src`) VALUES
(1, 'ALL', 0, 1, 100, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/18473ALL.png?'),
(2, '家具', 0, 1, 100, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/26542jj.png?'),
(3, '家居', 0, 1, 100, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/22863jiaju.png?'),
(4, '空间', 0, 1, 100, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/18652space.png?'),
(5, '专题', 0, 1, 100, 'http://p5koaz6je.bkt.clouddn.com/view/images/brandImg/2018/03/22/15845titil.png?'),
(6, '沙发', 2, 1, 100, ''),
(7, '桌几', 2, 1, 100, ''),
(8, '椅凳', 2, 1, 100, ''),
(9, '柜架', 2, 1, 100, ''),
(10, '灯具', 3, 1, 100, ''),
(11, '装饰', 3, 1, 100, ''),
(12, '客厅', 4, 1, 100, ''),
(13, '卧室', 4, 1, 100, ''),
(14, '书房', 4, 1, 100, ''),
(15, '厨房', 4, 1, 100, ''),
(16, '儿童房', 4, 1, 100, ''),
(17, '户外', 4, 1, 100, ''),
(18, '儿童', 5, 1, 100, ''),
(19, '优惠', 5, 1, 100, ''),
(20, '浴室', 4, 1, 100, '');

-- --------------------------------------------------------

--
-- 表的结构 `jii_goods`
--

CREATE TABLE `jii_goods` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `goods_name` varchar(150) NOT NULL COMMENT '商品名称',
  `shop_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_desc` longtext COMMENT '商品描述',
  `tag` varchar(30) NOT NULL COMMENT '标签',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否上架',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '添加时间',
  `brand_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '品牌ID',
  `cat_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类Id',
  `type_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '类型Id',
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否热卖',
  `order_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品';

--
-- 转存表中的数据 `jii_goods`
--

INSERT INTO `jii_goods` (`id`, `goods_name`, `shop_price`, `goods_desc`, `tag`, `is_on_sale`, `addtime`, `brand_id`, `cat_id`, `type_id`, `is_new`, `is_hot`, `order_id`) VALUES
(1, 'Egon埃贡', '1270.00', NULL, '8.8折', 1, 1521681217, 2, 8, 1, 0, 1, 100),
(2, 'Manet 马奈凳子', '970.00', NULL, '8折,新款', 1, 1521681314, 2, 8, 1, 0, 1, 100),
(3, 'morandi莫兰迪餐桌', '2970.00', NULL, '', 1, 1521681892, 2, 7, 1, 0, 0, 100),
(4, 'Egger凳', '89.00', NULL, '', 1, 1521682058, 2, 8, 0, 0, 0, 100),
(5, '哈伯阶梯挂衣架', '629.00', NULL, '', 1, 1521682482, 3, 9, 1, 0, 1, 100),
(6, '哈伯落地镜', '1299.00', NULL, '', 1, 1521682519, 3, 11, 1, 0, 1, 100),
(7, '骑兵椅凳', '1819.00', NULL, '', 1, 1521682678, 3, 8, 1, 0, 0, 100),
(8, '安尼克边桌', '1199.00', NULL, '', 1, 1521682741, 3, 7, 1, 0, 1, 100),
(9, 'LOOP餐椅', '1288.00', NULL, '', 1, 1521682819, 1, 8, 0, 0, 0, 100),
(10, 'LOOP长方形餐台', '6358.00', NULL, '', 1, 1521682912, 1, 7, 1, 0, 0, 100),
(11, 'monte圆几', '3318.00', NULL, '', 1, 1521682961, 1, 7, 1, 0, 1, 100),
(12, 'zafra休闲椅', '3128.00', NULL, '', 1, 1521683056, 1, 8, 1, 0, 0, 100);

-- --------------------------------------------------------

--
-- 表的结构 `jii_goods_attr`
--

CREATE TABLE `jii_goods_attr` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `attr_value` varchar(150) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_id` mediumint(8) UNSIGNED NOT NULL COMMENT '属性Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性';

--
-- 转存表中的数据 `jii_goods_attr`
--

INSERT INTO `jii_goods_attr` (`id`, `attr_value`, `attr_id`, `goods_id`) VALUES
(1, '美国黑胡桃木', 1, 1),
(2, '原木色', 2, 1),
(3, '美国黑胡桃木', 4, 1),
(4, '美国黑胡桃木', 1, 2),
(5, '原木色', 2, 2),
(6, '美国黑胡桃木', 4, 2),
(7, '450*350*400mm', 5, 2),
(8, '原木色', 6, 2),
(9, '美国黑胡桃木', 1, 3),
(10, '原木色', 2, 3),
(11, '美国黑胡桃木', 4, 3),
(12, 'L140*W70*H73cm', 5, 3),
(13, '水曲柳', 1, 5),
(14, '金属', 1, 5),
(15, '原木色', 2, 5),
(16, '黑色', 2, 5),
(17, '白色', 2, 5),
(18, '2.3kg', 3, 5),
(19, '410*1530*0mm', 5, 5),
(20, '水曲柳', 1, 6),
(21, '金属', 1, 6),
(22, '黑色', 2, 6),
(23, '原木色', 2, 6),
(24, '11kg', 3, 6),
(25, '1600*430*550mm', 5, 6),
(26, '黑色/原木色', 6, 6),
(27, '水曲柳', 1, 7),
(28, '金属', 1, 7),
(29, '白色', 2, 7),
(30, '原木色', 2, 7),
(31, '18.4kg', 3, 7),
(32, '1000*370*460mm', 5, 7),
(33, '金属', 1, 8),
(34, '玫瑰金色', 2, 8),
(35, '镍色', 2, 8),
(36, '10kg', 3, 8),
(37, '480*480*495mm', 5, 8),
(38, '镍色；玫瑰金色', 6, 8),
(46, '铁架', 1, 10),
(47, 'MDF台面', 1, 10),
(48, '雅黑', 2, 10),
(49, '56kg', 3, 10),
(50, '铁架/MDF台面', 4, 10),
(51, 'L185xW100xH73.5cm', 5, 10),
(52, '铁架', 1, 11),
(53, '实木层板', 1, 11),
(54, '布艺', 1, 11),
(55, '雅灰', 2, 11),
(56, '白色', 2, 11),
(57, '24kg；12kg', 3, 11),
(58, '大L97.5xW97.5xH39.5cm；小L53xW53xH47.5cm', 5, 11),
(59, '铁架', 1, 12),
(60, '布艺', 1, 12),
(61, '夹板靠背', 1, 12),
(62, '砂红', 2, 12),
(63, '22kg', 3, 12),
(64, 'L82xW89xH110cm', 5, 12),
(65, '橡木', 1, 1),
(66, '金属', 1, 1),
(67, '雅灰', 2, 1),
(68, '75*85*36', 7, 1),
(69, '85*95*46', 7, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jii_goods_cat`
--

CREATE TABLE `jii_goods_cat` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL COMMENT '分类id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='扩展分类';

--
-- 转存表中的数据 `jii_goods_cat`
--

INSERT INTO `jii_goods_cat` (`cat_id`, `goods_id`) VALUES
(18, 4),
(12, 8),
(20, 5);

-- --------------------------------------------------------

--
-- 表的结构 `jii_goods_desc`
--

CREATE TABLE `jii_goods_desc` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `img_src` varchar(150) NOT NULL COMMENT '图片路径',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `order_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品描述图片';

--
-- 转存表中的数据 `jii_goods_desc`
--

INSERT INTO `jii_goods_desc` (`id`, `img_src`, `goods_id`, `order_id`) VALUES
(8, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/7171详情图1.png?', 1, 100),
(9, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/1920详情图2.png?', 1, 100),
(10, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/25017详情图3.png?', 1, 100),
(11, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/10750详情图4.png?', 1, 100),
(12, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/30047详情图5.png?', 1, 100),
(13, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/7084详情图6.png?', 1, 100),
(14, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/28258详情图1.jpg?', 2, 100),
(15, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/3059详情图2.jpg?', 2, 100),
(16, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/20656详情图3.jpg?', 2, 100),
(17, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/11049详情图4.jpg?', 2, 100),
(20, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/5729详情图1.png?', 3, 100),
(21, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/17798详情图2.png?', 3, 100),
(22, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/7751详情图3.png?', 3, 100),
(23, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/13940详情图4.png?', 3, 100),
(24, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/14237详情图5.png?', 3, 100),
(25, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/13330详情图6.png?', 3, 100),
(26, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/22499详情图7.png?', 3, 100),
(29, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/30298详情图1.png?', 4, 100),
(30, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/139详情图2.png?', 4, 100),
(31, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/17768详情图3.png?', 4, 100),
(32, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/28033详情图4.png?', 4, 100),
(33, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/7718详情图5.png?', 4, 100),
(34, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/6759详情图7.png?', 4, 100),
(35, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/20500详情图8.png?', 4, 100),
(36, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/3500详情图1.jpg?', 6, 100),
(37, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/27253详情图2.jpg?', 6, 100),
(38, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/10762详情图3.jpg?', 6, 100),
(39, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/26180详情图1.jpg?', 7, 100),
(40, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/29485详情图2.jpg?', 7, 100),
(41, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/28770详情图3.jpg?', 7, 100),
(42, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/14812详情图1.jpg?', 8, 100),
(43, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/23269详情图2.jpg?', 8, 100),
(44, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/10682详情图3.jpg?', 8, 100),
(45, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/8299详情图4.jpg?', 8, 100),
(46, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/4734轮播图1.jpg?', 9, 100),
(47, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/29663轮播图2.jpg?', 9, 100),
(48, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/30764轮播图3.jpg?', 9, 100),
(49, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/28411轮播图1.jpg?', 10, 100),
(50, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/27416轮播图2.jpg?', 10, 100),
(51, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/29526详情图1.jpg?', 11, 100),
(52, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/32727详情图2.jpg?', 11, 100),
(53, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/8388详情图3.jpg?', 11, 100),
(54, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/23469详情图4.jpg?', 11, 100),
(55, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/28386详情图5.jpg?', 11, 100),
(56, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/17011详情图6.jpg?', 11, 100),
(57, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/1328详情图7.jpg?', 11, 100),
(64, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/10163详情图1.jpg?', 12, 100),
(65, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/8560详情图2.jpg?', 12, 100),
(66, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/3305详情图3.jpg?', 12, 100),
(67, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/11630详情图4.jpg?', 12, 100),
(68, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/3087详情图5.jpg?', 12, 100),
(69, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/25756详情图6.jpg?', 12, 100),
(70, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsdesc/2018/03/22/3749详情图7.jpg?', 12, 100);

-- --------------------------------------------------------

--
-- 表的结构 `jii_goods_img`
--

CREATE TABLE `jii_goods_img` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `img_src` varchar(150) NOT NULL COMMENT '图片路径',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品图片';

--
-- 转存表中的数据 `jii_goods_img`
--

INSERT INTO `jii_goods_img` (`id`, `img_src`, `goods_id`) VALUES
(11, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/24693轮播图1.png?', 1),
(12, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/26634轮播图2.png?', 1),
(13, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/2171轮播图3.png?', 1),
(14, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/18072轮播图4.png?', 1),
(15, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/3825轮播图1.jpg?', 2),
(16, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/31446轮播图2.jpg?', 2),
(17, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/12631轮播图3.jpg?', 2),
(18, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/13380轮播图4.jpg?', 2),
(19, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/10541轮播图5.jpg?', 2),
(20, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/18396轮播图1.png?', 3),
(21, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/20709轮播图2.png?', 3),
(22, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/17888轮播图4.png?', 4),
(23, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/12441详情图6.png?', 4),
(24, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/8827商品轮播图1.jpg?', 6),
(25, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/22680商品轮播图2.jpg?', 6),
(26, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/14577商品轮播图3.jpg?', 6),
(27, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/23766商品轮播图4.jpg?', 6),
(28, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/26099轮播图1.jpg?', 7),
(29, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/8880轮播图2.jpg?', 7),
(30, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/5417轮播图3.jpg?', 7),
(31, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/12462轮播图4.jpg?', 7),
(32, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/6088轮播图1.jpg?', 8),
(33, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/16481轮播图2.jpg?', 8),
(34, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/10118轮播图3.jpg?', 8),
(35, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/22599轮播图4.jpg?', 8),
(36, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/12931轮播图1.jpg?', 9),
(37, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/7168轮播图2.jpg?', 9),
(38, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/7225轮播图3.jpg?', 9),
(39, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/17141轮播图1.jpg?', 10),
(40, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/22666轮播图2.jpg?', 10),
(41, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/1449轮播图1.jpg?', 11),
(42, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/5934轮播图2.jpg?', 11),
(43, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/4815轮播图3.jpg?', 11),
(44, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/17500轮播图4.jpg?', 11),
(45, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/24070轮播图1.jpg?', 12),
(46, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/3271轮播图2.jpg?', 12),
(47, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/17140轮播图3.jpg?', 12),
(48, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsImg/2018/03/22/12922详情图4.jpg?', 5);

-- --------------------------------------------------------

--
-- 表的结构 `jii_goods_number`
--

CREATE TABLE `jii_goods_number` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(50) NOT NULL COMMENT '商品属性ID',
  `goods_price` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '商品价格',
  `goods_number` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '库存数量',
  `img_src` varchar(150) NOT NULL DEFAULT '' COMMENT '对应图片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品库存及图片';

--
-- 转存表中的数据 `jii_goods_number`
--

INSERT INTO `jii_goods_number` (`id`, `goods_id`, `goods_attr_id`, `goods_price`, `goods_number`, `img_src`) VALUES
(7, 1, '1,2,68', '1', 50, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsAttrImg/2018/03/28/19682轮播图1.png?'),
(8, 1, '1,2,69', '1238', 0, ''),
(9, 1, '1,67,68', '1239', 65, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsAttrImg/2018/03/28/18547轮播图4.png?'),
(10, 1, '1,67,69', '1240', 0, ''),
(11, 1, '2,65,68', '1241', 0, ''),
(12, 1, '2,65,69', '1243', 0, ''),
(13, 1, '65,67,68', '1423', 1, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsAttrImg/2018/03/28/4912轮播图4.png?'),
(14, 1, '65,67,69', '1425', 0, ''),
(15, 1, '2,66,68', '1248', 69, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsAttrImg/2018/03/28/31657详情图3.png?'),
(16, 1, '2,66,69', '1259', 45, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsAttrImg/2018/03/28/21806详情图6.png?'),
(17, 1, '66,67,68', '1237', 0, ''),
(18, 1, '66,67,69', '1486', 2, 'http://p5koaz6je.bkt.clouddn.com/view/images/goodsAttrImg/2018/03/28/30927详情图2.png?'),
(19, 4, '0', '789', 20, '');

-- --------------------------------------------------------

--
-- 表的结构 `jii_order`
--

CREATE TABLE `jii_order` (
  `order_id` varchar(20) NOT NULL COMMENT '订单编号',
  `user_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户Id',
  `message` varchar(200) NOT NULL DEFAULT '' COMMENT '用户留言',
  `address` varchar(200) NOT NULL COMMENT '收件信息',
  `price` decimal(10,2) NOT NULL COMMENT '总价格',
  `add_time` varchar(20) NOT NULL DEFAULT '' COMMENT '添加时间',
  `update_time` varchar(20) NOT NULL DEFAULT '' COMMENT '更新时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单状态 ',
  `prepay_id` varchar(50) NOT NULL DEFAULT '' COMMENT '微信订单号',
  `express` varchar(40) NOT NULL DEFAULT '' COMMENT '快递单号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单';

--
-- 转存表中的数据 `jii_order`
--

INSERT INTO `jii_order` (`order_id`, `user_id`, `message`, `address`, `price`, `add_time`, `update_time`, `status`, `prepay_id`, `express`) VALUES
('20180407090721986033', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523063241', '', 7, 'wx070907250609876637c862912735238904', ''),
('20180407093746889822', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523065066', '', 7, 'wx07093750127105f4413f9cf20220339584', ''),
('20180407135440431314', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523080480', '', 7, 'wx071354409937857b0df85efb4055651441', ''),
('20180407140439937568', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523081079', '', 7, 'wx07140440564669bf91a82a1b2029238538', ''),
('20180407141702656810', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523081822', '', 7, 'wx07141703372390848bc33b211924267145', ''),
('20180407142125109278', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523082085', '', 7, 'wx07142125751383fc70d3f2d70391057220', ''),
('20180407142907897997', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523082547', '', 7, 'wx0714290874960317a3d808470311057164', ''),
('20180407143814295585', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523083094', '', 7, 'wx0714381506978994901780b10470945954', ''),
('20180407161639422349', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523088999', '1523090561', 1, 'wx071616407047963dfb60278d0167401254', ''),
('20180407170811135526', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523092091', '1523092391', 7, 'wx07170812832169a8c11557d63950177333', ''),
('20180407172438211181', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523093078', '1523093113', 7, 'wx0717243984456699af247a6b0421929391', ''),
('20180408093927573228', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523151567', '1523169300', 7, 'wx080939284021809db9676f3d2032499640', '6476846595465446436'),
('20180408145119048554', 3, '', '李钢,17621063261,北京市市辖区东城区三里屯', '1.00', '1523170279', '1523170294', 7, 'wx0814512136956835617678993354718071', ''),
('20180408151807704280', 4, '', '吴超,13429345726,浙江省宁波市慈溪市大创园', '1.00', '1523171887', '1523171959', 7, 'wx081518101767089d3cee98512801451936', '');

-- --------------------------------------------------------

--
-- 表的结构 `jii_order_goods`
--

CREATE TABLE `jii_order_goods` (
  `order_id` varchar(20) NOT NULL COMMENT '订单编号',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(50) NOT NULL COMMENT '商品属性ID',
  `price` decimal(10,0) NOT NULL COMMENT '商品价格',
  `cart_number` mediumint(8) UNSIGNED NOT NULL COMMENT '购物数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品';

--
-- 转存表中的数据 `jii_order_goods`
--

INSERT INTO `jii_order_goods` (`order_id`, `goods_id`, `goods_attr_id`, `price`, `cart_number`) VALUES
('20180406142451363599', 1, '1,2,68', '1237', 1),
('20180406142451363599', 1, '2,66,68', '1248', 2),
('20180406175056534184', 1, '1,2,68', '1237', 1),
('20180406175932800195', 1, '1,2,68', '1237', 1),
('20180406181014129765', 1, '2,66,68', '1248', 1),
('20180406181101689639', 1, '2,66,68', '1248', 1),
('20180406181422409057', 1, '2,66,68', '1248', 1),
('20180406181542615473', 1, '2,66,68', '1248', 1),
('20180407090721986033', 1, '1,2,68', '1', 1),
('20180407091009873525', 1, '1,2,68', '1', 1),
('20180407092112881384', 1, '1,2,68', '1', 1),
('20180407093746889822', 1, '1,2,68', '1', 1),
('20180407135440431314', 1, '1,2,68', '1', 1),
('20180407140439937568', 1, '1,2,68', '1', 1),
('20180407141702656810', 1, '1,2,68', '1', 1),
('20180407142125109278', 1, '1,2,68', '1', 1),
('20180407142907897997', 1, '1,2,68', '1', 1),
('20180407143814295585', 1, '1,2,68', '1', 1),
('20180407161639422349', 1, '1,2,68', '1', 1),
('20180407170811135526', 1, '1,2,68', '1', 1),
('20180407172438211181', 1, '1,2,68', '1', 1),
('20180408093927573228', 1, '1,2,68', '1', 1),
('20180408145119048554', 1, '1,2,68', '1', 1),
('20180408145718692388', 1, '1,2,68', '1', 10),
('20180408150333140334', 1, '1,2,68', '1', 1),
('20180408151807704280', 1, '1,2,68', '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `jii_type`
--

CREATE TABLE `jii_type` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `type_name` varchar(30) NOT NULL COMMENT '类型名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='类型';

--
-- 转存表中的数据 `jii_type`
--

INSERT INTO `jii_type` (`id`, `type_name`) VALUES
(1, '通用');

-- --------------------------------------------------------

--
-- 表的结构 `jii_user`
--

CREATE TABLE `jii_user` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Id',
  `openid` varchar(150) NOT NULL DEFAULT '' COMMENT '微信ID',
  `name` varchar(150) NOT NULL DEFAULT '' COMMENT '用户名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';

--
-- 转存表中的数据 `jii_user`
--

INSERT INTO `jii_user` (`id`, `openid`, `name`) VALUES
(1, 'oxUsu5Qi6BcojYreiDZrYaOwTsmI', ''),
(2, 'oxUsu5foq-fts2Kpj2FpRgrp-OjY', ''),
(3, 'ogAUJ4zvF5IkF_4bqWlBE1XwheVk', ''),
(4, 'ogAUJ40ThO-3ZcAM3DG6mxrSocDI', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jii_address`
--
ALTER TABLE `jii_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jii_admin`
--
ALTER TABLE `jii_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jii_attribute`
--
ALTER TABLE `jii_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `jii_brand`
--
ALTER TABLE `jii_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jii_cart`
--
ALTER TABLE `jii_cart`
  ADD KEY `user_id` (`user_id`,`goods_id`,`goods_attr_id`);

--
-- Indexes for table `jii_category`
--
ALTER TABLE `jii_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jii_goods`
--
ALTER TABLE `jii_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_hot` (`is_hot`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `jii_goods_attr`
--
ALTER TABLE `jii_goods_attr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `attr_id` (`attr_id`);

--
-- Indexes for table `jii_goods_cat`
--
ALTER TABLE `jii_goods_cat`
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `jii_goods_desc`
--
ALTER TABLE `jii_goods_desc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Indexes for table `jii_goods_img`
--
ALTER TABLE `jii_goods_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Indexes for table `jii_goods_number`
--
ALTER TABLE `jii_goods_number`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Indexes for table `jii_order`
--
ALTER TABLE `jii_order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jii_order_goods`
--
ALTER TABLE `jii_order_goods`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `jii_type`
--
ALTER TABLE `jii_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jii_user`
--
ALTER TABLE `jii_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `openid` (`openid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `jii_address`
--
ALTER TABLE `jii_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `jii_admin`
--
ALTER TABLE `jii_admin`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `jii_attribute`
--
ALTER TABLE `jii_attribute`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `jii_brand`
--
ALTER TABLE `jii_brand`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `jii_category`
--
ALTER TABLE `jii_category`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `jii_goods`
--
ALTER TABLE `jii_goods`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `jii_goods_attr`
--
ALTER TABLE `jii_goods_attr`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=70;
--
-- 使用表AUTO_INCREMENT `jii_goods_desc`
--
ALTER TABLE `jii_goods_desc`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=71;
--
-- 使用表AUTO_INCREMENT `jii_goods_img`
--
ALTER TABLE `jii_goods_img`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=49;
--
-- 使用表AUTO_INCREMENT `jii_goods_number`
--
ALTER TABLE `jii_goods_number`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `jii_type`
--
ALTER TABLE `jii_type`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `jii_user`
--
ALTER TABLE `jii_user`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
