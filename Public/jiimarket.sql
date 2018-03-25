
CREATE TABLE IF NOT EXISTS `jii_brand` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(30) NOT NULL COMMENT '品牌名称',
  `desc` varchar(500) NOT NULL COMMENT '品牌描述',
  `order_id` smallint(5) UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序',
  `is_index` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否显示',
  `img_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌图',
  `logo_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `first_char` varchar(2) NOT NULL DEFAULT '' COMMENT '首字母',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌';

CREATE TABLE IF NOT EXISTS `jii_category` (
  `id` mediumint unsigned NOT NULL auto_increment comment 'id',
  `name` VARCHAR(30) NOT NULL COMMENT '分类名称',
  `parent_id` mediumint unsigned NOT NULL COMMENT '父级ID',
  `is_index` tinyint unsigned NOT NULL DEFAULT 0 COMMENT '是否显示',
  `order_id` SMALLINT unsigned NOT NULL DEFAULT 100 COMMENT '排序',
  `img_src` VARCHAR(150) NOT NULL DEFAULT '' COMMENT '分类图',
  PRIMARY KEY (`id`)
)engine=InnoDb DEFAULT CHARSET=utf8 COMMENT='分类';

CREATE TABLE IF NOT EXISTS `jii_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `type_name` varchar(30) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='类型';

CREATE TABLE IF NOT EXISTS `jii_attribute` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `attr_name` varchar(30) NOT NULL COMMENT '属性名称',
  `attr_type` tinyint unsigned NOT NULL DEFAULT 1 COMMENT '属性类型',
  `attr_option_values` varchar(300) NOT NULL DEFAULT '' COMMENT '属性值',
  `type_id` mediumint(8) unsigned NOT NULL COMMENT '类型ID',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性';

CREATE TABLE IF NOT EXISTS `jii_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_name` varchar(150) NOT NULL COMMENT '商品名称',
  `shop_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_desc` longtext COMMENT '商品描述',
  `tag` VARCHAR(30) NOT NULL comment '标签',
  `is_on_sale` tinyint NOT NULL DEFAULT '1' COMMENT '是否上架',
  `addtime` INT unsigned NOT NULL COMMENT '添加时间',
  `brand_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '品牌ID',
  `cat_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '分类Id',
  `type_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '类型Id',
  `is_new` tinyint NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_hot` tinyint NOT NULL DEFAULT '0' COMMENT '是否热卖',
  `order_id` mediumint unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `is_hot` (`is_hot`),
  KEY `brand_id` (`brand_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品';

CREATE TABLE IF NOT EXISTS `jii_goods_desc` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `img_src` varchar(150) NOT NULL COMMENT '图片路径',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `order_id` mediumint unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品描述图片';

CREATE TABLE IF NOT EXISTS `jii_goods_img` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `img_src` varchar(150) NOT NULL COMMENT '图片路径',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品图片';

CREATE TABLE IF NOT EXISTS `jii_goods_cat` (
  `cat_id` mediumint(8) unsigned NOT NULL COMMENT '分类id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  KEY `goods_id` (`goods_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='扩展分类';

CREATE TABLE IF NOT EXISTS `jii_goods_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `attr_value` varchar(150) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_id` mediumint(8) unsigned NOT NULL COMMENT '属性Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品属性';

CREATE TABLE IF NOT EXISTS `jii_goods_number` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品Id',
  `goods_attr_id` varchar(50) NOT NULL COMMENT '商品属性ID',
  `goods_price` decimal(10,0) NOT NULL COMMENT '商品价格',
  `goods_number` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '库存数量',
  `img_src` VARCHAR(150) NOT NULL COMMENT '对应图片',
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品库存及图片';

CREATE TABLE IF NOT EXISTS `jii_user`(
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `oppenid` varchar(150) NOT NULL DEFAULT '' COMMENT '微信ID',
  `name` varchar(150) NOT NULL DEFAULT '' COMMENT '用户名',
  PRIMARY KEY (`id`),
  KEY `oppenid` (`oppenid`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户';

