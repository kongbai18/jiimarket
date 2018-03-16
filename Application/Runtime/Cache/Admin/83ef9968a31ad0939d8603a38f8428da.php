<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>JiiHOME 管理中心 - 添加新商品 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/Admin/Js/jquery-1.10.2.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo $btn_url; ?>"><?php echo $btn_name; ?></a>
    </span>
    <span class="action-span1"><a href="/index.php/Admin/index/index">JiiHOME 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $title ?> </span>
    <div style="clear:both"></div>
</h1>


<div class="main-div">
    <form method="post" action="/index.php/Admin/Attribute/add/type_id/1.html"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">属性名称</td>
                <td>
                    <input type="text" name="attr_name" maxlength="60" value="" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">属性类型</td>
                <td>
                    <input type="radio" name="attr_type"  value="2">可选
                    <input type="radio" name="attr_type" value="1" checked="checked">唯一
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">属性可选值</td>
                <td>
                    <input type="text" name="attr_option_values" maxlength="60" value="" />（可选的时候将可选值用逗号'，'隔开，唯一不用填写）
                </td>
            </tr>
            <tr>
                <td class="label">所属类型</td>
                <td>
                    <?php buildSelect('type','type_id','id','type_name',I('get.type_id')) ?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>



<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>