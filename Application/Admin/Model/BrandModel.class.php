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
    //修改品牌时允许接收的字段
    protected $updateFields = array('id','name','desc','order_id','is_index');
    //验证规则
    protected $_validate = array(
        array('name','require','品牌名称不能为空！',1),
    );
    //搜索品牌信息
    public function search(){
        $where = array();
        //品牌名搜索
        $brandName = I('get.name');
        if(!empty($brandName)){
            $where['name'] = array('like',"%$brandName%");
        }
        /*************翻页************************/
        //获取总记录数
        $count = $this->where($where)->count();
        //生成翻页对象
        $pageObj = new \Think\Page($count,$perPage);
        //设置样式
        $pageObj->setConfig('prev','上一页');
        $pageObj->setConfig('next','下一页');
        //获取翻页字符串
        $pageString = $pageObj->show();
        /**************取某一页数据********************/
        $data = $this->where($where)->limit($pageObj->firstRow.','.$pageObj->listRows)->select();
        return array(
            'data' => $data,
            'page' => $pageString,
        );
    }
    //添加之前
    public function _before_insert(&$data,$option){
        /*************处理LOGO*********************/
        if($_FILES['logo_src']['error']==0){
            $file = $_FILES['logo_src']['tmp_name'];
            $key = 'view/images/brandLogo/'.date("Y/m/d").'/'.rand().$_FILES['logo_src']['name'];
            $ret = qiniu_img_upload($key,$file);
            $data['logo_src'] = $ret['img'];
        }
        /*************处理IMG*********************/
        if($_FILES['img_src']['error']==0){
            $file = $_FILES['img_src']['tmp_name'];
            $key = 'view/images/brandImg/'.date("Y/m/d").'/'.rand().$_FILES['img_src']['name'];
            $ret = qiniu_img_upload($key,$file);
            $data['img_src'] = $ret['img'];
        }
        /*************处理首字母*********************/
        $data['first_char'] = getFirstCharter($data['name']);
    }
    //修改之前
    public function _before_update(&$data,$option){
        /*************处理LOGO*********************/
        if($_FILES['logo_src']['error']==0){
            //获取旧LOGO地址
            $oldLogo = $this->field('logo_src')->find($option['where']['id']);
            foreach($oldImg as  $v){
                $key = rtrim($v,'?');
                $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
                qiniu_img_delete($key);
            }
            $file = $_FILES['logo_src']['tmp_name'];
            $key = 'view/images/brandLogo/'.date("Y/m/d").'/'.rand().$_FILES['logo_src']['name'];
            $ret = qiniu_img_upload($key,$file);
            if($ret['flag'] == 1){
                //获取旧LOGO地址
                $oldLogo = $this->field('logo_src')->find($option['where']['id']);
                foreach($oldLogo as $v){
                    $key = rtrim($v,'?');
                    $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
                    qiniu_img_delete($key);
                }
                $data['logo_src'] = $ret['img'];
            }
        }
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
        /*************处理首字母*********************/
        $data['first_char'] = getFirstCharter($data['name']);

    }
    //删除之前
    public function _before_delete($option){
        //获取LOGO路径
        $oldImg = $this->field('logo_src,img_src')->find($option['where']['id']);
        //从七牛云删除
        foreach($oldImg as  $v){
            $key = rtrim($v,'?');
            $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
            qiniu_img_delete($key);
        }
    }

    //前台获取品牌列表信息
    public function brandList(){
        $alphabet = array(array(al=>A),array(al=>B), array(al=>C),array(al=>D),array(al=>E), array(al=>F), array(al=>G), array(al=>H), array(al=>I), array(al=>G), array(al=>K), array(al=>L), array(al=>M), array(al=>N), array(al=>O), array(al=>P), array(al=>Q), array(al=>R), array(al=>S), array(al=>T), array(al=>U), array(al=>V), array(al=>W), array(al=>X), array(al=>Y), array(al=>Z),);
        $brandData = $this->field('id,name,logo_src,first_char')->select();
        foreach ($alphabet as $k => $v){
            foreach ($brandData as $v1){
                if($v['al'] == $v1['first_char']){
                    $alphabet[$k]['brand'][] = $v1;
                }
            }
        }
        foreach ($alphabet as $v){
            if(isset($v['brand'])){
                $resut[] = $v;
            }
        }
        return $resut;
    }
    //前台获取品牌所有信息
    public function brandDetail($id){
        $data = $this->find($id);
        return $data;
    }
}