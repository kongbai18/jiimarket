<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
    //品牌列表
     public function lst(){
         $this->display();
     }
     //品牌添加
    public function add(){
        $model = D('brand');
        //判断是否接收了表单
        if(IS_POST){
            //判断数据是否验证成功
            if($model->create(I('post.'),1)){
                //判断数据是否添加成功
                if($model->add()){
                    $this->success('品牌添加成功！',U('lst'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $this->display();
    }
    //品牌修改
    public function edit(){
        $this->display();
    }
    //品牌删除
    public function del(){

    }
}
