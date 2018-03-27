<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/18 0018
 * Time: 9:29
 */
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    //商品列表
    public function lst(){
        $model = D('goods');
        $data = $model->search(15);
        //数据assign到页面中
        $this->assign(array(
            'data' => $data,
            'title' => '商品列表',
            'btn_name' => '添加商品',
            'btn_url' => U('add')
        ));
        $this->display();
    }
    //添加商品
    public function add(){
        //判断是否接收表单
        if(IS_POST){
            $model = D('goods');
            //判断表单是否验证成功
            if($model->create(I('post.'),1)){
                //判断数据是否添加成功
                if($model->add()){
                    $this->success('商品添加成功！',U('lst'));
                    exit;
                }
            }
            //添加失败
            $this->error($model->getError());
        }
        //获取分类数据
        $catModel = D('category');
        $catData = $catModel->getTree();
        //数据assign到页面中
        $this->assign(array(
            'catData' => $catData,
            'title' => '添加商品',
            'btn_name' => '商品列表',
            'btn_url' => U('lst')
        ));
        $this->display();
    }
    //修改列表
    public function edit(){
        //获取要修改商品的ID并取出商品信息
        $id = I('get.id');
        $model = D('goods');
        $data = $model->find($id);
        //判断是否接收表单
        if(IS_POST){
            $model = D('goods');
            //判断表单是否验证成功
            if($model->create(I('post.'),2)){
                //判断是否修改成功
                if(FALSE !== $model->save()){
                    $this->success('修改成功！',U('lst'));
                }
            }
            $this->error($model->getError());
        }
        //获取商品图片
        $gpiModel = D('goods_img');
        $gpiData = $gpiModel->where(array(
            'goods_id' => array('eq',$id),
        ))->select();
        //获取商品图片
        $descModel = D('goods_desc');
        $descData = $descModel->where(array(
            'goods_id' => array('eq',$id),
        ))->select();
        //获取分类数据
        $catModel = D('category');
        $catData = $catModel->getTree();
        //获取扩展分类数据
        $gcModel = D('goods_cat');
        $gcData = $gcModel->where(array(
            'goods_id' => array('eq',$id)
        ))->select();
        //获取类型属性
        $attModel = D('attribute');
        $attData = $attModel->alias('a')
            ->field('a.id attr_id,a.attr_name,a.attr_type,a.attr_option_values,b.id,b.attr_value')
            ->join('LEFT JOIN __GOODS_ATTR__ b ON a.id=b.attr_id AND b.goods_id='.$data['id'])
            ->where(array(
                'a.type_id' => array('eq',$data['type_id']),
            ))->select();
        //var_dump($attData);die;
        //数据assign到页面中
        $this->assign(array(
            'descData' => $descData,
            'attData' => $attData,
            'gcData' => $gcData,
            'catData' => $catData,
            'gpiData' => $gpiData,
            'data' => $data,
            'title' => '修改商品',
            'btn_name' => '商品列表',
            'btn_url' => U('lst')
        ));
        $this->display();
    }
    //删除列表
    public function del(){
    }
    //AJAX获取属性值
    public function ajaxGetAttr(){
        $typeId = I('get.type_id');
        $attrModel = D('attribute');
        $attrData = $attrModel->where(array(
            'type_id' => array('eq',$typeId),
        ))->select();
        echo json_encode($attrData);
    }
    //AJAX删除商品图片
    public function ajaxDelPic(){
        //获得商品图片ID
        $id = I('get.picid');
        //获得旧图片路径
        $gpiModel = D('goods_img');
        $oldImg = $gpiModel->field('img_src')->where(array(
            'id' => array('eq',$id),
        ))->select();
        //从七牛云删除
        foreach($oldImg as  $v){
            $key = rtrim($v['img_src'],'?');
            $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
            qiniu_img_delete($key);
        }
        //从数据库上删除
        $gpiModel->where(array(
            'id' => array('eq',$id),
        ))->delete();
    }
    //库存量
    public function goods_number(){
        //获取商品ID
        $goodsId = I('get.id');
        $gnModel = D('goods_number');
        //取出商品所有可选属性值
        $gaModel = D('goods_attr');
        $gaData = $gaModel->alias('a')
            ->field('a.*,b.attr_name,b.attr_type,b.attr_option_values,b.type_id')
            ->join('LEFT JOIN __ATTRIBUTE__ b ON a.attr_id=b.id')
            ->where(array(
                'a.goods_id' => array('eq',$goodsId),
                'b.attr_type' => array('eq','2'),
            ))->select();
        //判断是否接收表单
        if(IS_POST){
            //var_dump($_POST);die;
            $id = I('post.id');
            $gaid = I('post.goods_attr_id');
            $gn = I('post.goods_number');
            $gp = I('post.goods_price');
            //计算商品属性和库存量比例
            $gaidCount = count($gaid);
            $gnCount = count($gn);
            $rate = $gaidCount/$gnCount;
            //循环库存量
            $_i = 0;
            foreach($gn as $k => $v){
                echo $v;
                $_goodsAttrId = array();
                for($i=0;$i<$rate;$i++){
                    $_goodsAttrId[] = $gaid[$_i];
                    $_i++;
                }
                sort($_goodsAttrId,SORT_NUMERIC);//以数字形式升序
                $_goodsAttrId = (string)implode(',',$_goodsAttrId);
                if($_FILES['goods_img']['error'][$k] == 0){
                    $file = $_FILES['goods_img']['tmp_name'][$k];
                    $key = 'view/images/goodsAttrImg/'.date("Y/m/d").'/'.rand().$_FILES['goods_img']['name'][$k];
                    $ret = qiniu_img_upload($key,$file);
                    if($ret['flag'] == 1){
                        if($id[$k] != ''){
                            //获取旧LOGO地址
                            $oldImg = $gnModel->field('img_src')->find($id[$k]);
                            //var_dump($oldImg);die;
                            foreach($oldImg as $v1) {
                                if ($v1 != '') {
                                    $key = rtrim($v, '?');
                                    $key = ltrim($key, 'http://p5koaz6je.bkt.clouddn.com/');
                                    qiniu_img_delete($key);
                                }
                            }
                        }
                        $img = $ret['img'];
                    }else{
                        $img = '';
                    }
                    if($id[$k] != ''){
                        $data=array(
                            'goods_id' => $goodsId,
                            'goods_attr_id' => $_goodsAttrId,
                            'goods_number' => $v,
                            'goods_price' => $gp[$k],
                            'img_src' => $img,
                        );
                        echo $v;
                        $gnModel->where('id='.$id[$k])->save($data);
                    }else{
                        $gnModel->add(array(
                            'goods_id' => $goodsId,
                            'goods_attr_id' => $_goodsAttrId,
                            'goods_number' => $v,
                            'goods_price' => $gp[$k],
                            'img_src' => $img,
                        ));
                    }
                }else{
                    if($id[$k] != ''){
                        $data=array(
                            'goods_id' => $goodsId,
                            'goods_attr_id' => $_goodsAttrId,
                            'goods_number' => $v,
                            'goods_price' => $gp[$k],
                        );
                        $gnModel->where('id='.$id[$k])->save($data);
                    }else{
                        $gnModel->add(array(
                            'goods_id' => $goodsId,
                            'goods_attr_id' => $_goodsAttrId,
                            'goods_number' => $v,
                            'goods_price' => $gp[$k],
                        ));
                    }
                }
            }
            echo "<script language=\"JavaScript\">alert(\"库存修改完成!\");</script>";
        }
        $_gaData = array();
        foreach($gaData as $k => $v){
            $_gaData[$v['attr_name']][] = $v;
        }
        //获取商品库存
        $gnData = $gnModel->where(array(
            'goods_id' => array('eq',$goodsId),
        ))->select();
        $this->assign(array(
            'gnData' => $gnData,
            'gaData' => $_gaData,
            'title' => '商品库存',
            'btn_name' => '商品列表',
            'btn_url' => U('lst')
        ));
        $this->display();
    }
    //AJAX删除描述图片
    public function ajaxDelDesc(){
        //获得描述图片ID
        $id = I('get.descid');
        //获得旧图片路径
        $descModel = D('goods_desc');
        $oldImg = $descModel->field('img_src')->where(array(
            'id' => array('eq',$id),
        ))->select();
        //从七牛云删除
        foreach($oldImg as  $v){
            $key = rtrim($v['img_src'],'?');
            $key = ltrim($key,'http://p5koaz6je.bkt.clouddn.com/');
            qiniu_img_delete($key);
        }
        //从数据库上删除
        $descModel->where(array(
            'id' => array('eq',$id),
        ))->delete();
    }
    //AJAX删除属性和相关库存
    public function ajaxDelAttr(){
        $goodsId = I('get.goods_id');
        $gaid = I('get.gaid');
        $gaModel = D('goods_attr');
        $gaModel->delete($gaid);
        //库存
        /*$gnModel = D('goods_number');
        $gnModel->where(array(
            'goods_id' => array('EXP',"=$goodsId AND FIND_IN_SET($gaid,goods_attr_id)"),
        ))->delete();*/
    }
}