<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30 0030
 * Time: 9:48
 */
namespace Admin\Model;
use Think\Model;
class AddressModel extends Model {
    public function addAddress(){
        $userKey = I('get.userKey');
        $name = I('get.name');
        $mobile = I('get.mobile');
        $city = I('get.city');
        $address = I('get.address');
        $status = I('get.status');
        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        if($userId){
            if ($status == '1'){
                $dresData = $this->field('id')->where(array(
                    'user_id' => array('eq',$userId),
                    'status' => array('eq','1'),
                ))->select();
                if($dresData[0]['id']){
                    $this->save(array(
                        'id' => $dresData[0]['id'],
                        'status' => '0',
                    ));
                }
            }else{
                $dresData = $this->field('id')->where(array(
                    'user_id' => array('eq',$userId),
                    'status' => array('eq','1'),
                ))->select();
                if(!$dresData[0]['id']){
                    $status = '1';
                }
            }
            $data = array(
                'user_id' => $userId,
                'name' => $name,
                'mobile' => $mobile,
                'city' => $city,
                'address' => $address,
                'status' => $status,
            );
            $result = $this->add($data);
            if ($result){
                return '11';
            }else{
                return '10';
            }
        }else{
            return '0';
        }
    }
    public function addressList(){
        $userKey = I('get.userKey');
        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        if ($userId){
            $addressData = $this->where(array(
                'user_id' => array('eq',$userId)
            ))->select();
            $data = array(
                'flag' => 1,
                'addressData' => $addressData,
            );
        }else{
            $data = array(
                'flag' => 0,
            );
        }
        return $data;
    }
    public function editDefault(){
        $userKey = I('get.userKey');
        $id = I('get.id');
        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        if ($userId){
            $addressData = $this->where(array(
                'user_id' => array('eq',$userId),
                'status' => array('eq','1'),
            ))->select();
            $result = $this->where(array(
                'user_id' => array('eq',$userId),
                'id' => array('eq',$id),
            ))->save(array('status'=>'1'));
            if ($result){
                $this->save(array(
                    'id' => $addressData[0]['id'],
                    'status' => '0',
                ));
                $data = '11';
            }else{
                $data = '10';
            }
        }else{
            $data = '0';
        }
        return $data;
    }

    public function addressDef(){
        $userKey = I('get.userKey');
        session_id($userKey);
        session_start();
        $userId = $_SESSION['id'];
        if ($userId) {
            $addressData = $this->where(array(
                'user_id' => array('eq', $userId),
                'status' => array('eq', '1'),
            ))->select();
            $data = array(
                'flag' => '1',
                'address' => $addressData,
            );
        }else{
            $data = array(
                'flag' => '0',
            );
        }
        return $data;
    }
}