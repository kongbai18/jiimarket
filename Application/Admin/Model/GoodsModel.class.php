<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/18 0018
 * Time: 10:20
 */
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model {
    //添加商品时接收的字段
    protected $insertFields = array('goods_name', 'shop_price', 'goods_desc', 'brand_id', 'cat_id', 'type_id', 'is_on_sale', 'is_new', 'is_hot', 'order_id','tag');
    protected $updateFields = array('id','goods_name', 'shop_price', 'goods_desc', 'brand_id', 'cat_id', 'type_id', 'is_on_sale', 'is_new', 'is_hot', 'order_id','tag');
    protected $_validate = array(
        array('goods_name', 'require', '商品名称不能为空！', 1),
        array('shop_price', 'currency', '本店价格必须是货币类型', 1),
        array('cat_id', 'require', '请选择商品分类！', 1),
    );

    //添加之前
    public function _before_insert(&$data,$option){
        $data['tag'] = str_replace('，',',',$data['tag']);
        //添加添加时间
        $data['addtime'] = time();
    }

    //添加之后
    public function _after_insert($data, $option)
    {
        /***************处理商品属性************************/
        //接收表单数据
        $attrVal = I('post.attr_value');
        $gaModel = D('goods_attr');
        foreach ($attrVal as $k => $v) {
            foreach ($v as $k1 => $v1) {
                if ($v1) {
                    $gaModel->add(array(
                        'attr_id' => $k,
                        'attr_value' => $v1,
                        'goods_id' => $data['id'],
                    ));
                }
            }
        }

        /***************处理扩展分类***********************/
        //接收表单数据
        $catId = I('post.ext_cat_id');
        //实例化商品分类扩展
        $_catId = array($data['cat_id']);
        $gcModel = D('goods_cat');
        foreach ($catId as $k => $v) {
            if (empty($v) || in_array($v, $_catId)) {
                continue;
            } else {
                $gcModel->add(array(
                    'cat_id' => $v,
                    'goods_id' => $data['id'],
                ));
                $_catId[] = $v;
            }
        }
        /***************处理商品相册***********************/
        $pics = array();
        foreach ($_FILES['pic']['name'] as $k => $v) {
            $pics[$k]['name'] = $_FILES['pic']['name'][$k];
            $pics[$k]['type'] = $_FILES['pic']['type'][$k];
            $pics[$k]['tmp_name'] = $_FILES['pic']['tmp_name'][$k];
            $pics[$k]['error'] = $_FILES['pic']['error'][$k];
            $pics[$k]['size'] = $_FILES['pic']['size'][$k];
        }
        $goodsImgModel = D('goods_img');
        foreach ($pics as $k => $v) {
            if ($v['error'] == 0) {
                $file = $v['tmp_name'];
                $key = 'view/images/goodsImg/' . date("Y/m/d") . '/' . rand() . $v['name'];
                $ret = qiniu_img_upload($key, $file);
                if ($ret['flag'] == 1) {
                    $goodsImgModel->add(array(
                        'img_src' => $ret['img'],
                        'goods_id' => $data['id'],
                    ));
                }
            }
        }
        /***************处理商品描述***********************/
        $imgs = array();
        foreach ($_FILES['desc_pic']['name'] as $k => $v) {
            $imgs[$k]['name'] = $_FILES['pic']['name'][$k];
            $imgs[$k]['type'] = $_FILES['pic']['type'][$k];
            $imgs[$k]['tmp_name'] = $_FILES['pic']['tmp_name'][$k];
            $imgs[$k]['error'] = $_FILES['pic']['error'][$k];
            $imgs[$k]['size'] = $_FILES['pic']['size'][$k];
        }
        $goodsDescModel = D('goods_desc');
        foreach ($imgs as $k => $v) {
            if ($v['error'] == 0) {
                $file = $v['tmp_name'];
                $key = 'view/images/goodsdesc/' . date("Y/m/d") . '/' . rand() . $v['name'];
                $ret = qiniu_img_upload($key, $file);
                if ($ret['flag'] == 1) {
                    $goodsDescModel->add(array(
                        'img_src' => $ret['img'],
                        'goods_id' => $data['id'],
                    ));
                }
            }
        }
    }

    //修改之前
    public function _before_update(&$data,$option)
    {
        $data['tag'] = str_replace('，',',',$data['tag']);
        if (!$data['is_new']) {
            $data['is_new'] = '0';
        }
        if (!$data['is_hot']) {
            $data['is_hot'] = '0';
        }
        /***************处理商品属性******************/
        $gaid = I('post.goods_attr_id');
        $typeId = I('post.type_id');
        $attrValue = I('post.attr_value');
        $gaModel = D('goods_attr');
        $goodsModel = D('goods');
        $oldTpye = $goodsModel->field('type_id')->find($option['where']['id']);
        if($oldTpye['type_id'] == $typeId){
            $_i = 0;
            foreach($attrValue as $k => $v){
                foreach($v as $k1 => $v1){
                    if($gaid[$_i]){
                        if($v1 == ''){
                            //删除
                            $gaModel->delete($gaid[$_i]);
                        }else{
                            //修改
                            $gaModel->where('id='.$gaid[$_i])->setField(array(
                                'attr_value' => $v1,
                            ));
                        }
                    }else{
                        //添加
                        if($v1){
                            $gaModel->add(array(
                                'attr_value' => $v1,
                                'attr_id' => $k,
                                'goods_id' => $option['where']['id'],
                            ));
                        }
                    }
                    $_i++;
                }
            }
        }else{
            $gaModel->where(array(
                'goods_id' => array('eq',$option['where']['id'])
            ))->delete();
            $_i = 0;
            foreach($attrValue as $k => $v){
                foreach($v as $k1 => $v1){
                    if($gaid[$_i]){
                        if($v1 == ''){
                            //删除
                            $gaModel->delete($gaid[$_i]);
                        }else{
                            //修改
                            $gaModel->where('id='.$gaid[$_i])->setField(array(
                                'attr_value' => $v1,
                            ));
                        }
                    }else{
                        //添加
                        if($v1){
                            $gaModel->add(array(
                                'attr_value' => $v1,
                                'attr_id' => $k,
                                'goods_id' => $option['where']['id'],
                            ));
                        }
                    }
                    $_i++;
                }
            }
        }

        /***************处理扩展分类***************/
        //删除原分类
        $gcModel = D('goods_cat');
        $gcModel->where(array(
            'goods_id' => array('eq', $option['where']['id'])
        ))->delete();
    }

    //修改后
    public function _after_update($data,$option)
    {
        /***************处理扩展分类***********************/
        //接收表单数据
        $catId = I('post.ext_cat_id');
        //实例化商品分类扩展
        $_catId = array($data['cat_id']);
        $gcModel = D('goods_cat');
        foreach ($catId as $k => $v) {
            if (empty($v) || in_array($v, $_catId)) {
                continue;
            } else {
                $gcModel->add(array(
                    'cat_id' => $v,
                    'goods_id' => $data['id'],
                ));
                $_catId[] = $v;
            }
        }
        /***************处理商品相册***********************/
        $pics = array();
        foreach ($_FILES['pic']['name'] as $k => $v) {
            $pics[$k]['name'] = $_FILES['pic']['name'][$k];
            $pics[$k]['type'] = $_FILES['pic']['type'][$k];
            $pics[$k]['tmp_name'] = $_FILES['pic']['tmp_name'][$k];
            $pics[$k]['error'] = $_FILES['pic']['error'][$k];
            $pics[$k]['size'] = $_FILES['pic']['size'][$k];
        }
        $goodsImgModel = D('goods_img');
        foreach ($pics as $k => $v) {
            if ($v['error'] == 0) {
                $file = $v['tmp_name'];
                $key = 'view/images/goodsImg/' . date("Y/m/d") . '/' . rand() . $v['name'];
                $ret = qiniu_img_upload($key, $file);
                if ($ret['flag'] == 1) {
                    $goodsImgModel->add(array(
                        'img_src' => $ret['img'],
                        'goods_id' => $data['id'],
                    ));
                }
            }
        }
        /***************处理商品描述***********************/
        $imgs = array();
        foreach ($_FILES['desc_pic']['name'] as $k => $v) {
            $imgs[$k]['name'] = $_FILES['desc_pic']['name'][$k];
            $imgs[$k]['type'] = $_FILES['desc_pic']['type'][$k];
            $imgs[$k]['tmp_name'] = $_FILES['desc_pic']['tmp_name'][$k];
            $imgs[$k]['error'] = $_FILES['desc_pic']['error'][$k];
            $imgs[$k]['size'] = $_FILES['desc_pic']['size'][$k];
        }
        $goodsDescModel = D('goods_desc');
        foreach ($imgs as $k => $v) {
            if ($v['error'] == 0) {
                $file = $v['tmp_name'];
                $key = 'view/images/goodsdesc/' . date("Y/m/d") . '/' . rand() . $v['name'];
                $ret = qiniu_img_upload($key, $file);
                if ($ret['flag'] == 1) {
                    $goodsDescModel->add(array(
                        'img_src' => $ret['img'],
                        'goods_id' => $data['id'],
                    ));
                }
            }
        }
    }
    //搜索商品信息
    public function search($perpage){
        $where = array();
        //商品名称搜索
        $keyword = I('get.keyword');
        if($keyword){
            $where['goods_name'] = array('like',"%$keyword%");
        }
        //品牌搜索
        $brandId = I('get.brand_id');
        if($brandId){
            $where['brand_id'] = array('eq',$brandId);
        }
        /*****************翻页*************************/
        //获取总记录数
        $count = $this->where($where)->count();
        //生成翻页对象类
        $pageObj = new \Think\Page($count,$perpage);
        //设置样式
        $pageObj->setConfig('next','下一页');
        $pageObj->setConfig('prev','上一页');
        //获取翻页字符串
        $pageString = $pageObj->show();
        /****************取一页的数据******************/
        $data = $this->field('a.*,b.name as brand_name,c.name as cat_name')
            ->alias('a')
            ->join('LEFT JOIN __BRAND__ b ON a.brand_id=b.id
		        LEFT JOIN __CATEGORY__ c ON a.cat_id=c.id')
            ->where($where)
            ->order('order_id asc')
            ->limit($pageObj->firstRow.','.$pageObj->listRows)
            ->select();
        return  array(
            'data' => $data,
            'page' => $pageString,
        );
    }
    //获取热卖商品信息
    public function goodsHot(){
        $gpModel = D('goods_img');
        $da = $gpModel->field('min(id) as id')
            ->group('goods_id')
            ->select();
        foreach ($da as $v){
            $imgId[] = $v['id'];
        }
        $where['is_on_sale'] = array('eq',1);
        $where['is_hot'] = array('eq',1);
        $where['b.id'] = array('in',$imgId);
        $data = $this->field('a.id,a.goods_name,a.shop_price,a.tag,b.img_src')
            ->alias('a')
            ->order('order_id asc')
            ->where($where)
            ->join('LEFT JOIN __GOODS_IMG__ b ON b.goods_id=a.id')
            ->select();
        foreach($data as &$v){
            $v['tag'] = explode(',',$v['tag']);
        }
        return $data;
    }
    //获取首页展示品牌商品
    public function indexBrand(){
        //获取首页展示品牌
       $brModel = D('brand');
       $brWhere['is_index'] = array('eq',1);
       $brandData = $brModel->field('id,name,img_src')
           ->where($brWhere)
           ->order('order_id asc')
           ->select();
       foreach ($brandData as $v){
           $brId[] = $v['id'];
       }
       //商品图片去重
        $gpModel = D('goods_img');
        $da = $gpModel->field('min(id) as id')
            ->group('goods_id')
            ->select();
        foreach ($da as $v){
            $imgId[] = $v['id'];
        }
        //获取商品信息
        $where['is_on_sale'] = array('eq',1);
        $where['b.id'] = array('in',$imgId);
        $where['brand_id'] = array('in',$brId);
        $goodsData = $this->field('a.id,a.goods_name,a.shop_price,a.tag,a.brand_id,b.img_src')
            ->alias('a')
            ->order('order_id asc')
            ->where($where)
            ->join('LEFT JOIN __GOODS_IMG__ b ON b.goods_id=a.id')
            ->select();
        foreach($goodsData as &$v){
            $v['tag'] = explode(',',$v['tag']);
        }
        foreach ($brandData as &$v){
            foreach ($goodsData as $v1){
                if($v['id'] == $v1['brand_id']){
                    $v['goods'][] = $v1;
                }
            }
        }

        return $brandData;
    }
    //APP商品分类
    public function goodsCat(){
        $cat = I('get.cateId');
        $kind = I('get.kind');
        $order = '';
        if(!empty($cat)){
            $where['cat_id'] = array('eq',$cat);
        }
        if(!empty($kind)){
            if($kind == 'zong'){
                $order = 'order_id asc';
            }else if($kind == 'new'){
                $order = 'addtime desc';
            }else if($kind == 'up'){
                $order = 'shop_price asc';
            }else if($kind == 'down'){
                $order = 'shop_price desc';
            }
        }
        //商品图片去重
        $gpModel = D('goods_img');
        $da = $gpModel->field('min(id) as id')
            ->group('goods_id')
            ->select();
        foreach ($da as $v){
            $imgId[] = $v['id'];
        }
        //获取商品信息
        $where['is_on_sale'] = array('eq',1);
        $where['b.id'] = array('in',$imgId);
        $data = $this->field('a.id,a.goods_name,a.shop_price,a.tag,a.brand_id,b.img_src')
            ->alias('a')
            ->order($order)
            ->where($where)
            ->join('LEFT JOIN __GOODS_IMG__ b ON b.goods_id=a.id')
            ->select();
        foreach($data as &$v){
            $v['tag'] = explode(',',$v['tag']);
        }
        return $data;
    }
    //APP商品详细信息
    public function goodsDetail(){
        $id = I('get.id');
        $where['a.id'] = array('eq',$id);
        $goodsData = $this->field('a.id,a.goods_name,a.shop_price,a.tag,b.id as brand_id,b.name as brand_name,c.id as cat_id,c.name as cat_name')
            ->alias('a')
            ->join('LEFT JOIN __BRAND__ b ON b.id=a.brand_id
                LEFT JOIN __CATEGORY__ c ON c.id=a.cat_id')
            ->where($where)
            ->select();
        $goodsData[0]['tag'] = explode(',',$goodsData[0]['tag']);

        $goodsPicModel = D('goods_img');
        $picWhere['goods_id'] = array('eq',$id);
        $goodsImg = $goodsPicModel->field('img_src')
            ->where($picWhere)
            ->select();
        foreach ($goodsImg as $v){
            $imgData[] = $v['img_src'];
        }

        $goodsDescModel = D('goods_desc');
        $descWhere['goods_id'] = array('eq',$id);
        $goodsDesc = $goodsDescModel->field('img_src')
            ->where($descWhere)
            ->select();
        foreach ($goodsDesc as $v){
            $descData[] = $v['img_src'];
        }

        $attrModel = D('goods_attr');
        $attrWhere['goods_id'] = array('eq',$id);
        $attrDa = $attrModel->field('a.*,b.attr_name,b.attr_type')
            ->alias('a')
            ->join('LEFT JOIN __ATTRIBUTE__ b ON a.attr_id=b.id')
            ->where($attrWhere)
            ->select();
        foreach ($attrDa as $v){
            $attrData[$v['attr_id']][] = $v;
        }
        $gnModel = D('goods_number');
        $gnData = $gnModel->field('goods_attr_id,goods_price,goods_number,img_src')
            ->where(array(
                'goods_id' => array('eq',$id),
                'goods_number' => array('gt','0')
            ))
            ->select();


         $attr = explode(',',$gnData[0]['goods_attr_id']);
         foreach ($attr as $v){
             foreach ($attrData as &$v1){
                 foreach ($v1 as &$v2){
                     if($v2['attr_type']==2 && $v2['id']==$v ){
                         $v1[0]['attr'] = $v;
                         $v2['attr'] = $v;
                     }
                 }
             }
         }
        //获取商品所有可选属性
        $att = array();
        foreach ($attrData as $k => $v){
             if ($v[0]['attr_type']=='2'){
                 foreach ($v as $v3){
                     $att[$k][] = $v3['id'];
                 }
             }
        }
        if(empty($gnData)){
            $atAll = 0;
            foreach ($attrData as $k12 => $v12){
                     if($attrData[$k12][0]['attr_type'] == '2'){
                         $atAll = $atAll+1;
                         foreach ($attrData[$k12] as $k13 => $v13){
                             $attrData[$k12][$k13]['num'] = 'false';
                         }
                     }
            }
            if ($atAll == 0){
                $gnData[0]['goods_attr_id'] = '00';
            }else{
                $gnData[0] = '';
            }
        }else {
            $n = count($attr);
            $sub_array = array();

            for ($i = 0; $i < $n; $i++) {
                $sub_attr = $attr;
                unset($sub_attr[$i]);
                $sub_array[] = $sub_attr;
            }
            foreach ($sub_array as $k4 => $v4) {
                $haAttr = array();
                foreach ($v4 as $k5 => $v5) {
                    foreach ($att as $k6 => $v6) {
                        if (in_array($v5, $v6)) {
                            $haAttr[] = $k6;
                        }
                    }
                }
                foreach ($att as $k7 => $v7) {
                    if (!in_array($k7, $haAttr)) {
                        foreach ($att[$k7] as $k8 => $v8) {
                            $num = 0;
                            foreach ($gnData as $k9 => $v9) {
                                $zuhe = explode(',', $v9['goods_attr_id']);
                                if ($v4 == array_intersect($v4, $zuhe) && in_array($v8, $zuhe)) {
                                    $num = $num + 1;
                                }
                            }
                            if ($num == 0) {
                                foreach ($attrData[$k7] as $k10 => $v10) {
                                    if ($v10['id'] == $v8) {
                                        $attrData[$k7][$k10]['num'] = 'false';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

/*            foreach ($attr as $k4 => $v4){
                foreach ($att as $k5 => $v5){
                    if(in_array($v4,$v5)){
                        foreach ($att as $k6 =>$v6){
                            if($k5 != $k6){
                                foreach ($att[$k6] as $k7 => $v7){
                                    $num = 0;
                                    foreach ($gnData as $k8 => $v8){
                                        $zuhe = explode(',',$v8['goods_attr_id']);
                                        if(in_array($v4,$zuhe) && in_array($v7,$zuhe)){
                                            $num = $num+1;
                                            }
                                        }
                                    }
                                    if($num==0){
                                        foreach ($attrData[$k6] as $k9 => $v9) {
                                            if ($v9['id'] == $v7) {
                                                $attrData[$k6][$k9]['num'] = 'false';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }*/

        $data = array(
            'goodsData' => $goodsData,
            'goodsImg' => $imgData,
            'attrData' => $attrData,
            'descData' => $descData,
            'gnData' => $gnData,
        );

        return $data;

    }
    //APP搜索商品
    public function goodsSearch(){
        $keyword = I('get.keyword');
        if($keyword){
        $where['goods_name'] = array('like',"%$keyword%");
        }
        //商品图片去重
        $gpModel = D('goods_img');
        $da = $gpModel->field('min(id) as id')
            ->group('goods_id')
            ->select();
        foreach ($da as $v){
            $imgId[] = $v['id'];
        }
        //获取商品信息
        $where['is_on_sale'] = array('eq',1);
        $where['b.id'] = array('in',$imgId);
        $data = $this->field('a.id,a.goods_name,a.shop_price,a.tag,a.brand_id,b.img_src')
            ->alias('a')
            ->order($order)
            ->where($where)
            ->join('LEFT JOIN __GOODS_IMG__ b ON b.goods_id=a.id')
            ->select();
        foreach($data as &$v){
            $v['tag'] = explode(',',$v['tag']);
        }
        return $data;
    }
    //选择商品时选择属性
    public function changeAttr(){
        $goodsId = I('get.goodsId');
        $goodsAttrId = I('get.goodsAttrId');
        $goodsAttrId = explode(',',$goodsAttrId);
        foreach ($goodsAttrId as $v){
            if($v != '' && $v != 'undefined'){
                $attr[] = $v;
            }
        }
        sort($attr,SORT_NUMERIC);//以数字形式升序
        $attrr = (string)implode(',',$attr);
        $gnModel = D('goods_number');
        $gnData = $gnModel->field('goods_price,goods_number,img_src')
            ->where(array(
                'goods_id' => array('eq',$goodsId),
                'goods_attr_id' =>array('eq',$attrr)
            ))->select();
        //获取所有库存不为0的属性
        $gnAllData = $gnModel->field('goods_attr_id,goods_price,img_src')
            ->where(array(
                'goods_id' => array('eq',$goodsId),
                'goods_number' => array('gt','0')
            ))
            ->select();

        $attrModel = D('goods_attr');
        $attrWhere['goods_id'] = array('eq',$goodsId);
        $attData = $attrModel->field('a.*,b.attr_name,b.attr_type')
            ->alias('a')
            ->join('LEFT JOIN __ATTRIBUTE__ b ON a.attr_id=b.id')
            ->where($attrWhere)
            ->select();
        foreach ($attData as $v){
            $attrData[$v['attr_id']][] = $v;
        }
        foreach ($attr as $v){
            foreach ($attrData as &$v1){
                foreach ($v1 as &$v2){
                    if($v2['attr_type']==2 && $v2['id']==$v ){
                        $v1[0]['attr'] = $v;
                        $v2['attr'] = $v;
                    }
                }
            }
        }
        //获取商品所有可选属性
        $att = array();
        $max = 0;
        foreach ($attrData as $k => $v){
            if ($v[0]['attr_type']=='2'){
                $max = $max+1;
                foreach ($v as $v3){
                    $att[$k][] = $v3['id'];
                }
            }
        }
        if(empty($gnData)){
            $gnData[0] = '';
        }

        $n = count($attr);
        $sub_array = array();
        if($n<=$max && $n > 1){
            for ($i = 0; $i < $n; $i++) {
                $sub_attr = $attr;
                unset($sub_attr[$i]);
                $sub_array[] = $sub_attr;
            }
            if($n < $max){
                $sub_array[] = $attr;
            }
        }else if($n=1){
            $sub_array[] = $attr;
        }

        if($n>=1){
            foreach ($sub_array as $k4 => $v4) {
                $haAttr = array();
                foreach ($v4 as $k5 => $v5) {
                    foreach ($att as $k6 => $v6) {
                        if (in_array($v5, $v6)) {
                            $haAttr[] = $k6;
                        }
                    }
                }
                foreach ($att as $k7 => $v7) {
                    if (!in_array($k7, $haAttr)) {
                        foreach ($att[$k7] as $k8 => $v8) {
                            $num = 0;
                            foreach ($gnAllData as $k9 => $v9) {
                                $zuhe = explode(',', $v9['goods_attr_id']);
                                if ($v4 == array_intersect($v4, $zuhe) && in_array($v8, $zuhe)) {
                                    $num = $num + 1;
                                }
                            }
                            if ($num == 0) {
                                foreach ($attrData[$k7] as $k10 => $v10) {
                                    if ($v10['id'] == $v8) {
                                        $attrData[$k7][$k10]['num'] = 'false';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        $data = array(
            'gnData' => $gnData,
            'attrData' => $attrData,
            'sub_array' => $attrr
        );
        return $data;
    }
}