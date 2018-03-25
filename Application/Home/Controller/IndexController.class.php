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
}