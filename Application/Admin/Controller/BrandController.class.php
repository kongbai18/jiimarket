<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
    //品牌列表
     public function lst(){
         $model = D('brand');
         $data = $model->search();
         //数据assign到页面中
         $this->assign(array(
             'data' => $data,
             'title' => '品牌列表',
             'btn_name' => '添加品牌',
             'btn_url' => U('add')
         ));
         $this->display();
     }
     //品牌添加
    public function add(){
        $model = D('brand');
        //判断是否接收了表单
        if(IS_POST){
            var_dump($_POST);
            var_dump($_FILES);die;
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
        //数据assign到页面中
        $this->assign(array(
            'title' => '添加品牌',
            'btn_name' => '品牌列表',
            'btn_url' => U('lst')
        ));
        $this->display();
    }
    //品牌修改
    public function edit(){
        //获取要修改品牌的ID
        $id = I('get.id');
        //取出该品牌信息
        $model = D('brand');
        $data = $model->find($id);
        //判断是否提交数据
        if(IS_POST){
            //判断是否通过验证
            if($model->create(I('post.'),2)){
                //判断是否修改成功
                if(FALSE !== $model->save()){
                    $this->success('品牌修改成功！',U('lst'));
                }
            }
            $this->error($model->getError());
        }
        //数据assign到页面中
        $this->assign(array(
            'data' => $data,
            'title' => '品牌修改',
            'btn_name' => '品牌列表',
            'btn_url' => U('lst')
        ));
        $this->display();
    }
    //品牌删除
    public function del(){
        //获取要删除品牌的ID
        $id = I('get.id');
        $model = D('brand');
        //判断是否删除成功
        if($model->delete($id)){
            $this->success('品牌删除成功！',U('lst'));
        }
        $this->error($model->getError());
    }
}
