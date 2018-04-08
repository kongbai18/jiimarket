<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28 0028
 * Time: 8:55
 */
namespace Admin\Model;
use Think\Model;
class CartModel extends Model {
    public function addCart(){
        $goodsId = I('get.goodsId');
        $userKey = I('get.userKey');
        $attrId = I('get.attrId');
        $goodsNum = I('get.goodsNum');
        $attrId = explode(',',$attrId);
        foreach ($attrId as $v){
            if($v != ''){
                $attr[] = $v;
            }
        }
        sort($attr,SORT_NUMERIC);//以数字形式升序
        $attr = (string)implode(',',$attr);

        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        if (empty($userId)){
            $data = array(
                'flag' => '0',
            );
        }else{
            $gnModel = D('goods_number');
            $gnData = $gnModel->field('id')
                ->where(array(
                    'goods_id' => array('eq',$goodsId),
                    'goods_attr_id' =>array('eq',$attr),
                    'goods_number' => array('gt','0')
                ))->select();
            if(!empty($gnData)){
                $cart = $this->field('cart_number')->where(array(
                    'user_id' => $userId,
                    'goods_id' => $goodsId,
                    'goods_attr_id' => $attr
                ))->select();
                if(empty($cart)){
                    $cartData = array(
                        'user_id' => $userId,
                        'goods_id' => $goodsId,
                        'goods_attr_id' => $attr,
                        'cart_number' => $goodsNum
                    );
                    $result = $this->add($cartData);
                    if($result){
                        $data = array(
                            'flag' => '11',
                        );
                    }else{
                        $data = array(
                            'flag' => '10',
                        );
                    }
                }else{
                    $data = array(
                        'flag' => '20',
                    );
                }
            }
        }
        return $data;
    }
    public function listCart(){
        $userKey = I('get.userKey');
        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        $cartData = $this->where(array(
            'user_id' => array('eq',$userId)
        ))->select();
        $gnModel = D('goods_number');
        $gaModel = D('goods_attr');
        $goodsModel = D('goods');
        if (empty($userId)){
            $data = array(
                'flag' => '0',
            );
        }else{
            foreach ($cartData as $k => $v){
                $gnData = $gnModel->field('goods_price,goods_number,img_src')->where(array(
                    'goods_id' => array('eq',$v['goods_id']),
                    'goods_attr_id' => array('eq',$v['goods_attr_id']),
                    'goods_number' => array('gt','0')
                ))->select();
                if(empty($gnData)){
                    $this->where(array(
                        'user_id' => array('eq',$userId),
                        'goods_id' => array('eq',$v['goods_id']),
                        'goods_attr_id' => array('eq',$v['goods_attr_id'])
                    ))->delete();
                    unset($cartData[$k]);
                }else{
                    $goodsData = $goodsModel->field('is_on_sale,goods_name')->find($v['goods_id']);
                    if($goodsData['is_on_sale'] == 0){
                        unset($cartData[$k]);
                    }else{
                        if($v['cart_number'] > $gnData['goods_number']){
                            $cartData[$k]['cart_number'] = '1';
                        }
                        $attrId = explode(',',$v['goods_attr_id']);
                        $cartDa = array();
                        foreach ($attrId as $v1){
                            $attrData = $gaModel->field('attr_value')->find($v1);
                            if(!empty($attrData)){
                                $cartDa[] = $attrData['attr_value'];
                            }else{
                                $cartDa[] = '默认';
                            }
                        }
                        $cartData[$k]['goods_name'] = $goodsData['goods_name'];
                        $cartData[$k]['goods_attr'] = $cartDa;
                        $cartData[$k]['goods_price'] = $gnData[0]['goods_price'];
                        $cartData[$k]['img_src'] = $gnData[0]['img_src'];
                        $cartData[$k]['max_num'] = $gnData[0]['goods_number'];
                    }
                }
            }
            $data = array(
                'flag' => '1',
                'cartData' => $cartData,
            );
        }
        return $data;
    }
    public function delCart(){
        $goodsId = I('get.goodsId');
        $attrId = I('get.attrId');
        $userKey = I('get.userKey');
        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        if ($userId){
            $result = $this->where(array(
                'goods_id' => array('eq',$goodsId),
                'attr_id' => array('eq',$attrId),
                'user_id' => array('eq',$userId),
            ))->delete();
            if ($result){
                return '1';
            }else{
                return '0';
            }
        }else{
            return '00';
        }


    }
}