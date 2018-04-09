<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14 0014
 * Time: 16:59
 */

    require (APP_PATH.'../Public/Qiniu/autoload.php');
    use Qiniu\Auth;
    use Qiniu\Storage\UploadManager;
    use Qiniu\Processing\Operation;
    /**
     * @brief 上传图片至七牛云
     */
    function qiniu_img_upload($key,$file)
    {
        $accessKey = 'aEY-lKi3FC2LI4Ip6HK6PNkC4t6mt30xd6ro1UQD';
        $secretKey = 'Pp1p447OMbdsI81rHiaPG2-CA6cr_0QHjyvL4_Bs';
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'daishu'; //你的七牛空间名
        // 设置put policy的其他参数
        $opts = array(
            'callbackBody' => 'name=$(fname)&hash=$(etag)'
        );
        $token = $auth->uploadToken($bucket, null, 3600, $opts);
        $uploadMgr = New UploadManager();

        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if ($err !== null) {
            //var_dump($err);
            $result = array(
                'flag'=> 0,
                'img' => ''
            );
        } else {
            $str=$ret['key'];
            $key = $str;
            $domain = 'p5koaz6je.bkt.clouddn.com';
            $op = New Operation($domain);
            $ops = '';
            $url = $op->buildUrl($key, $ops);
            $result = array(
                'flag'=> 1,
                'img' => $url
            );
        }
        return $result;
    }
    /**
     * @brief 图片从七牛云删除的方法
     */
    function qiniu_img_delete($key)
    {
        $accessKey = 'aEY-lKi3FC2LI4Ip6HK6PNkC4t6mt30xd6ro1UQD';
        $secretKey = 'Pp1p447OMbdsI81rHiaPG2-CA6cr_0QHjyvL4_Bs';
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'daishu'; //你的七牛空间名
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete($bucket, $key);
        /*if($err){
            print_r($err);
        }*/
    }
    //获取字符串首字母
   function getFirstCharter($str)
    {
        if (empty($str)) {
            return '';
        }
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
        $s1 = iconv('UTF-8', 'gb2312', $str);
        $s2 = iconv('gb2312', 'UTF-8', $s1);
        $s = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) return 'A';
        if ($asc >= -20283 && $asc <= -19776) return 'B';
        if ($asc >= -19775 && $asc <= -19219) return 'C';
        if ($asc >= -19218 && $asc <= -18711) return 'D';
        if ($asc >= -18710 && $asc <= -18527) return 'E';
        if ($asc >= -18526 && $asc <= -18240) return 'F';
        if ($asc >= -18239 && $asc <= -17923) return 'G';
        if ($asc >= -17922 && $asc <= -17418) return 'H';
        if ($asc >= -17417 && $asc <= -16475) return 'J';
        if ($asc >= -16474 && $asc <= -16213) return 'K';
        if ($asc >= -16212 && $asc <= -15641) return 'L';
        if ($asc >= -15640 && $asc <= -15166) return 'M';
        if ($asc >= -15165 && $asc <= -14923) return 'N';
        if ($asc >= -14922 && $asc <= -14915) return 'O';
        if ($asc >= -14914 && $asc <= -14631) return 'P';
        if ($asc >= -14630 && $asc <= -14150) return 'Q';
        if ($asc >= -14149 && $asc <= -14091) return 'R';
        if ($asc >= -14090 && $asc <= -13319) return 'S';
        if ($asc >= -13318 && $asc <= -12839) return 'T';
        if ($asc >= -12838 && $asc <= -12557) return 'W';
        if ($asc >= -12556 && $asc <= -11848) return 'X';
        if ($asc >= -11847 && $asc <= -11056) return 'Y';
        if ($asc >= -11055 && $asc <= -10247) return 'Z';
        return '';
    }
    //制作下拉框
    function buildSelect($mdName,$selName,$val,$valName,$selelctVal = '',$firstName = '请选择...'){
        $model = D($mdName);
        $data = $model->field($val.','.$valName)->select();
        $select = '<select name="'.$selName.'"><option value="">'.$firstName.'</option>';
        foreach($data as $k => $v){
            //判断是否有默认选择
            if($selelctVal && $selelctVal==$v[$val]){
                $selected = 'selected="selected"';
            }else{
                $selected = '';
            }
            $select .= '<option '.$selected.' value="'.$v[$val].'">'.$v[$valName].'</option>';
        }
        $select .= '</select>';
        echo $select;
    }

    function create_unique() {
        list($usec, $sec) = explode(" ", microtime());
        $usec = substr(str_replace('0.', '', $usec), 0 ,4);
        $str  = rand(10,99);
        return date("YmdHis").$usec.$str;
    }

  function wxorder($orderId,$price,$openid) {

      $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
      $str ="";
      for ( $i = 0; $i < 32; $i++ )  {
          $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
      }
      $dataNow = strval(date('YmdHis',time()));
      $dataLat = strval(date('YmdHis',time()+60*60*24));
      $order = array(
        'appid'=>'wx800bf4746022a63c',
        'body'=>'jiihome商城',
        'device_info'=>'WEB',
        'mch_id'=>'1501109211',
        'nonce_str'=>$str,
        'time_start'=>$dataNow,
        'time_expire'=>$dataLat,
        'notify_url'=>'http://npshgi.natappfree.cc/jiiMarket/index.php',//接受微信异步通知地址
        'openid'=>$openid,
        'out_trade_no'=>$orderId,//商户唯一订单号，可包含字母序
        'spbill_create_ip'=>$_SERVER['SERVER_ADDR'],//产生订单号的服务器IP
        'total_fee'=>$price,//订单金额，单位/分
        'trade_type'=>'JSAPI',
     );

      ksort($order);

      $sign = '';
      foreach ($order as $k => $v){
          $sign = $sign.$k.'='.$v.'&';
      }

    $sign = $sign.'key=JBkjkj54adDSskjKL54SDjsd35sdsJHs';
    $sign = md5($sign);
    //转大写
    $sign = strtoupper($sign);
    $order['sign'] = $sign;
    //转换成一维XML格式
    $xml = '<xml>';
    foreach($order as $k=>$v){
        $xml.='<'.$k.'>'.$v.'</'.$k.'>';
    }
    $xml.='</xml>';
    //CURL会话
    $ch = curl_init();
    // 设置curl允许执行的最长秒数
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    // 获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //发送一个常规的POST请求。
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://api.mch.weixin.qq.com/pay/unifiedorder');
    //要传送的所有数据
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    // 执行操作
    $response = curl_exec($ch);
    //将xml格式的$response 转成数组
    $response = json_decode( json_encode( simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA) ), true );
    //若预下单成功，return_code 和result_code为SUCCESS。
    if ( $response['return_code'] ==='SUCCESS' && $response['result_code'] ==='SUCCESS') {
        //返回trade_type和prepay_id供前端调用
        return $response['prepay_id'];
        //echo json_encode( ['trade_type'=>$response['trade_type'], 'prepay_id'=>$response['prepay_id']] );
    }else{
        //return 'false';
        return 'false';
    }
  }
  function wxpay($prepayId){
      $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
      $str ="";
      for ( $i = 0; $i < 32; $i++ )  {
          $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
      }
      $data = array(

          'timeStamp'=>strval(time()),
          'appId'=>'wx800bf4746022a63c',
          'nonceStr'=>$str,
          'signType'=>'MD5',
          'package'=>'prepay_id='.$prepayId,
      );
      ksort($data);
      $sign = '';
      foreach ($data as $k => $v){
          $sign = $sign.$k.'='.$v.'&';
      }

      $sign = $sign.'key=JBkjkj54adDSskjKL54SDjsd35sdsJHs';
      $sign = md5($sign);
      //转大写
      $paySign = strtoupper($sign);
      $data['paysign'] = $paySign;
      return $data;
  }
    //退款
function refund($orderId,$price,$aHeader=array())
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str = "";
    for ($i = 0; $i < 32; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    $dataNow = strval(date('YmdHis', time()));
    $dataLat = strval(date('YmdHis', time() + 60 * 60 * 24));
    $order = array(
        'appid' => 'wx800bf4746022a63c',
        'mch_id' => '1501109211',
        'nonce_str' => $str,
        'out_trade_no' => $orderId,//商户唯一订单号，可包含字母序
        'out_refund_no' => $orderId,
        'spbill_create_ip' => $_SERVER['SERVER_ADDR'],//产生订单号的服务器IP
        'total_fee' => $price,//订单金额，单位/分
        'refund_fee' => $price,
    );

    ksort($order);

    $sign = '';
    foreach ($order as $k => $v) {
        $sign = $sign . $k . '=' . $v . '&';
    }

    $sign = $sign . 'key=JBkjkj54adDSskjKL54SDjsd35sdsJHs';
    $sign = md5($sign);
    //转大写
    $sign = strtoupper($sign);
    $order['sign'] = $sign;
    //转换成一维XML格式
    $xml = '<xml>';
    foreach ($order as $k => $v) {
        $xml .= '<' . $k . '>' . $v . '</' . $k . '>';
    }
    $xml .= '</xml>';

    $ch = curl_init();
    //超时时间
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //这里设置代理，如果有的话
    //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
    //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
    curl_setopt($ch, CURLOPT_URL, 'https://api.mch.weixin.qq.com/secapi/pay/refund');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    //以下两种方式需选择一种

    //第一种方法，cert 与 key 分别属于两个.pem文件
    //默认格式为PEM，可以注释
    curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
    curl_setopt($ch, CURLOPT_SSLCERT, 'D:\wamp\wamp64\www\jiiMarket\Public\cert\apiclient_cert.pem');
    //默认格式为PEM，可以注释
    curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
    curl_setopt($ch, CURLOPT_SSLKEY, 'D:\wamp\wamp64\www\jiiMarket\Public\cert\apiclient_key.pem');

    //第二种方式，两个文件合成一个.pem文件
    //curl_setopt($ch,CURLOPT_SSLCERT,'http://www.jiixcx.com/Public/cert/apiclient_key.pem');

    if (count($aHeader) >= 1) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
    }

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    $data = curl_exec($ch);
    //将xml格式的$response 转成数组
    $data = json_decode(json_encode(simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    if ($data['return_code'] === 'SUCCESS' && $data['result_code'] === 'SUCCESS') {
        curl_close($ch);
        return 'success';
    } else {
        //$error = curl_errno($ch);
        //echo "call faild, errorCode:$error\n";
        curl_close($ch);
        return 'false';
    }
}
    //微信支付订单查询
    function inquery($orderId){
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $str ="";
    for ( $i = 0; $i < 32; $i++ )  {
        $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
    }
    $order = array(
        'appid'=>'wx800bf4746022a63c',
        'mch_id'=>'1501109211',
        'nonce_str'=>$str,
        'out_trade_no'=>$orderId,//商户唯一订单号，可包含字母序
    );

    ksort($order);

    $sign = '';
    foreach ($order as $k => $v){
        $sign = $sign.$k.'='.$v.'&';
    }

    $sign = $sign.'key=JBkjkj54adDSskjKL54SDjsd35sdsJHs';
    $sign = md5($sign);
    //转大写
    $sign = strtoupper($sign);
    $order['sign'] = $sign;
    //转换成一维XML格式
    $xml = '<xml>';
    foreach($order as $k=>$v){
        $xml.='<'.$k.'>'.$v.'</'.$k.'>';
    }
    $xml.='</xml>';
    //CURL会话
    $ch = curl_init();
    // 设置curl允许执行的最长秒数
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    // 获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //发送一个常规的POST请求。
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://api.mch.weixin.qq.com/pay/orderquery');
    //要传送的所有数据
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    // 执行操作
    $response = curl_exec($ch);
    //将xml格式的$response 转成数组
    $response = json_decode( json_encode( simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA) ), true );
    //若预下单成功，return_code 和result_code为SUCCESS。
    if ( $response['return_code'] ==='SUCCESS' && $response['result_code'] ==='SUCCESS' && $response['trade_state'] ==='SUCCESS') {
        //返回trade_type和prepay_id供前端调用
        return 'success';
        //echo json_encode( ['trade_type'=>$response['trade_type'], 'prepay_id'=>$response['prepay_id']] );
    }else{
        //return 'false';
        return 'false';
    }
   }
