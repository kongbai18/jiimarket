<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/27 0027
 * Time: 14:51
 */
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {
    public function login(){
         $code = I('get.code');
         $file_contents = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid=wx800bf4746022a63c&secret=f921054f2590237ed990e11d4111daf5&js_code='.$code.'&grant_type=authorization_code');
         $wxData = json_decode($file_contents,true);
         $openid = $wxData['openid'];
         if($openid){
             $id = $this->field('id')->where(array(
                 'openid' => array('eq',$openid)
             ))->find();
             session_start();
             $key = session_id();
             if($id['id']){
                 $_SESSION['id'] = $id['id'];
                 return $key;
             }else{
                 $data['openid'] = $openid;
                 $result = $this->add($data);
                 $_SESSION['id'] = $result;
                 if($result){
                     return $key;
                 }else{
                     return 'false';
                 }
             }
         }else{
             return 'false';
         }
    }
}