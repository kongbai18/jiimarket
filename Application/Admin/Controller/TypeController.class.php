<?php
namespace Admin\Controller;
class TypeController extends BaseController {
    //类别列表
    public function lst(){
      $model = D('type');
      $data = $model->search(10);
      //数据assign到页面中
      $this->assign(array(
           'data'  => $data,
           'title' => '类型列表',
           'btn_name' => '添加类型',
           'btn_url' => U('add')
      ));
      $this->display();
    }
    //类别增加
    public function add(){
      $model = D('type');
      //判断是否接收表单
      if(IS_POST){
      	//判断是否验证成功
      	if($model->create(I('post.'),1)){
      		//判断是否添加成功
      		if($model->add()){
      			$this->success('类型添加成功！',U('lst'));
      		}
      	}
      	//添加失败
      	$this->error($model->getError());
      }
      //数据assign到页面中
      $this->assign(array(
           'title' => '添加类型',
           'btn_name' => '类型列表',
           'btn_url' => U('lst')
      ));
      $this->display();
    }
    //类别修改
    public function edit(){
      //获取需要修改类型的ID
      $id = I('get.id');
      $model = D('type');
      //判断是否接收表单
      if(IS_POST){
      	//判断是否验证成功
      	if($model->create(I('post.'),2)){
      		//判断是否修改成功
      		if(FALSE !== $model->save()){
      			$this->success('类型修改成功！',U('lst'));
      		}
      	}
      	//添加失败
      	$this->error($model->getError());
      }
      //获取修改类型数据
      $data = $model->find($id);
      //数据assign到页面中
      $this->assign(array(
           'data' => $data,
           'title' => '修改类型',
           'btn_name' => '类型列表',
           'btn_url' => U('lst')
      ));
      $this->display();
    }
    //类别删除
    public function delete(){
      //接收要删除类型的ID
      $id = I('get.id');
      $model = D('type');
      //判断是否删除成功
      if($model->delete($id)){
      	$this->success('类型删除成功！',U('lst'));
      }
      $this->error($model->getError());
    }
}