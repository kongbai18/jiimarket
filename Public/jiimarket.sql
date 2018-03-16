
CREATE TABLE IF NOT EXISTS `jii_brand` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(30) NOT NULL COMMENT '品牌名称',
  `desc` varchar NOT NULL COMMENT '品牌描述',
  `order_id` smallint unsigned NOT NULL DEFAULT 100 COMMENT '排序'，
  `is_index` tinyint unsigned NOT NULL DEFAULT 0 COMMENT '是否显示', 
  `img_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌图',
  `logo_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
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
