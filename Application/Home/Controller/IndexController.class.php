<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    //APP品牌列表
    public function brandList(){
        $brandModel = D('Admin/Brand');
        echo json_encode($brandModel->brandList());
    }
    //APP品牌详情
    public function brandDetail(){
        $id = I('get.brandId');
        $brandModel = D('Admin/Brand');
        echo json_encode($brandModel->brandDetail($id));
    }
    //APP分类
    public function getCate(){
        $cateModel = D('Admin/Category');
        echo json_encode($cateModel->getCate());
    }
    //APP热卖商品
    public function goodsHot(){
        $goodsModel = D('Admin/Goods');
        echo json_encode($goodsModel->goodsHot());
    }
    //APP首页品牌商品
    public function indexBrand(){
        $goodsModel = D('Admin/Goods');
        echo json_encode($goodsModel->indexBrand());
    }
    //APP获取分类商品
    public function goodsCat(){
        $goodsModel = D('Admin/Goods');
        echo json_encode($goodsModel->goodsCat());
    }
    //APP获取商品详情
    public function goodsDetail(){
        $goodsModel = D('Admin/Goods');
        //var_dump($goodsModel->goodsDetail());
        echo json_encode($goodsModel->goodsDetail());
    }
    //APP搜索
    public function goodsSearch(){
        $goodsModel = D('Admin/Goods');
        echo json_encode($goodsModel->goodsSearch());
    }
    //单品选择属性时改变价格
    public function changeAttr(){
        $goodsModel = D('Admin/Goods');
        //var_dump($goodsModel->changAttr());
        echo json_encode($goodsModel->changeAttr());
    }
    //微信小程序登陆
    public function login(){
        $userModel = D('Admin/User');
        echo json_encode($userModel->login());
    }
    //添加商品到购物车
    public function addCart(){
        $cartModel = D('Admin/Cart');
        echo json_encode($cartModel->addCart());
    }
    //购物车列表
    public function listCart(){
        $cartModel = D('Admin/Cart');
        echo json_encode($cartModel->listCart());
    }
    //删除购物车中物品
    public function delCart(){
        $cartModel = D('Admin/Cart');
        echo json_encode($cartModel->delCart());
    }
    //添加地址
    public function addAddress(){
        $addressModel = D('Admin/Address');
        echo json_encode($addressModel->addAddress());
    }
    //地址列表
    public function addressList(){
        $addressModel = D('Admin/Address');
        echo json_encode($addressModel->addressList());
    }
    //修改默认地址
    public function editDefault(){
        $addressModel = D('Admin/Address');
        echo json_encode($addressModel->editDefault());
    }
    //获取默认地址
    public function addressDef(){
        $addressModel = D('Admin/Address');
        echo json_encode($addressModel->addressDef());
    }
    //生成订单
    public function addOrder(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->addOrder());
    }
    //订单信息
    public function userOrder(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->userOrder());
    }
    //取消信息
    public function removeOrder(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->removeOrder());
    }
    //取消信息
    public function payOrder(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->payOrder());
    }
    //完成支付
    public function comPay(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->comPay());
    }
    //订单状态
    public function orderState(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->orderState());
    }
    //完成订单
    public function comOrder(){
        $orderModel = D('Admin/Order');
        echo json_encode($orderModel->comOrder());
    }
    public function test(){
        var_dump(refund('20180408093927573228',100));

    }
}