<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14 0014
 * Time: 16:59
 */
    require '__PUBLIC__/Qiniu/autoload.php';
    use Qiniu\Auth;
    use Qiniu\Storage\UploadManager;
    use Qiniu\Processing\Operation;
    public function qiniu_img_upload($file)
    {
        //$file = $_FILES['_goodsFile']['tmp_name']; //获取到文件的临时副本的名称

        $accessKey = 'aEY-lKi3FC2LI4Ip6HK6PNkC4t6mt30xd6ro1UQD';
        $secretKey = 'Pp1p447OMbdsI81rHiaPG2-CA6cr_0QHjyvL4_Bs';
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'jiihome'; //你的七牛空间名
        // 设置put policy的其他参数
        $opts = array(
            'callbackBody' => 'name=$(fname)&hash=$(etag)'
        );
        $token = $auth->uploadToken($bucket, null, 3600, $opts);
        $uploadMgr = New UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, null, $file);


        if ($err !== null) {
            var_dump($err);
        } else {
            $str=$ret['key'];
            $key = $str;
            $domain = 'oqvis4z2h.bkt.clouddn.com';
            $op = New Operation($domain);
            $ops = '';
            $url = $op->buildUrl($key, $ops);
            $result = array(
                'flag'=> 1,
                'img' => $url
            );
            return $result;
        }
    }