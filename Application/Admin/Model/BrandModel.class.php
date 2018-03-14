<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14 0014
 * Time: 15:41
 */
namespace Admin\Model;
use Think\Model;
class BrandModel extends Model {
    //添加品牌时允许接收的表单
    protected $insertFields = array('name','desc','order_id','is_index');
}