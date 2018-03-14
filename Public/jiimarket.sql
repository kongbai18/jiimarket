
CREATE TABLE IF NOT EXISTS `jii_brand` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(30) NOT NULL COMMENT '品牌名称',
  `desc` varchar(500) NOT NULL COMMENT '品牌描述',
  `order_id` smallint unsigned NOT NULL DEFAULT 100 COMMENT '排序'，
  `is_index` tinyint unsigned NOT NULL DEFAULT 0 COMMENT '是否显示', 
  `img_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌图',
  `logo_src` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌';
