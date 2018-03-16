<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14 0014
 * Time: 16:59
 */

    require '/Public/Qiniu/autoload.php';
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