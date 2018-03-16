<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16 0016
 * Time: 10:12
 */
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model {
    //添加时允许接收的字段
    protected $inserField = array('name','parent_id','is_index','order_id');
    //添加时允许接收的字段
    protected $updateField = array('id','name','parent_id','is_index','order_id');
    //验证规则
    protected $_validate = array(
        array('name', 'require', '分类名不能为空！', 1, 'regex', 3),
        array('name', '1,30', '的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('parent_id', 'number', '必须是一个整数！', 2, 'regex', 3),
    );
    //获取分类子ID
    public function getChildren($catId){
        //获得所有分类数据
        $data = $this->order('order_id asc')->select();
        $children = $this->_getChildren($catId,$data,true);
        $children[] = $catId;
        return $children;
    }
    private function _getChildren($catId,$data,$isClear = FALSE){
        static $children = array();
        if($isClear){
            $children = array();
        }
        //循环从数据中找出子类
        foreach($data as $k => $v){
            if($v['parent_id']==$catId){
                $children[] = $v['id'];
                $this->_getChildren($v['id'],$data,FALSE);
            }
        }
        return $children;
    }
    //无限极排序
    public function getTree(){
        //获得所有分类数据
        $data = $this->order('order_id asc')->select();
        return $this->_getTree($data);
    }
    private function _getTree($data,$parentId=0,$level=0){
        static $ret =array();
        foreach($data as $k => $v){
            if($v['parent_id']==$parentId){
                $v['level'] = $level;
                $ret[] = $v;
                //找子分类
                $this->_getTree($data,$v['id'],$level+1);
            }
        }
        return $ret;
    }
    //添加之前
    public function _before_insert(&$data,$option){
        /*************处理IMG*********************/
        if($_FILES['img_src']['error']==0){
            $file = $_FILES['img_src']['tmp_name'];
            $key = 'view/images/category/'.date("Y/m/d").'/'.rand().$_FILES['img_src']['name'];
            $ret = qiniu_img_upload($key,$file);
            $data['img_src'] = $ret['img'];
        }
    }
    //更新之前
    public function _before_update(&$data,$option){
        /*************处理IMG*********************/
        if($_FILES['img_src']['error']==0){
            $file = $_FILES['img_src']['tmp_name'];
            $key = 'view/images/brandImg/'.date("Y/m/d").'/'.rand().$_FILES['img_src']['name'];
            $ret = qiniu_img_upload($key,$file);
            if($ret['flag'] == 1){
                //获取旧LOGO地址
                $oldImg = $this->field('img_src')->find($option['where']['id']);
                foreach($oldImg as $v){
                    $key = rtrim($v,'?');
                    $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
                    qiniu_img_delete($key);
                }
                $data['img_src'] = $ret['img'];
            }
        }
    }
    //删除之前
    public function _before_delete($option){
        //获取LOGO路径
        $oldImg = $this->field('img_src')->find($option['where']['id']);
        //从七牛云删除
        if(!empty($oldImg)){
            foreach($oldImg as  $v){
                $key = rtrim($v,'?');
                $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
                qiniu_img_delete($key);
            }
        }
    }

    //小程序获取两级分类
    public function getCate(){
        $data = $this->order('order_id asc')->select();
        $ret = array();
        foreach ($data as $k => &$v) {
            if($v['parent_id'] == 0){
                foreach ($data as $k1 => $v1) {
                    if ($v1['parent_id'] == $v['id']) {
                        $v['child'][] = $v1;
                    }
                }
                $ret[] = $v;
            }
        }
        return $ret;
    }
}