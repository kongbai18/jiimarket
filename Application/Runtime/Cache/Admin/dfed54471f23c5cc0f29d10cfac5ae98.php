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
    <form action="/index.php/Admin/Category/edit/id/1.html" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <input type="hidden" name="id" value="<?php echo $idData['id'] ?>">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='name' maxlength="20" value='<?php echo $idData['name'] ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        <?php foreach($data as $k => $v): if($v['id']==$idData['parent_id']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                        <?php if(in_array($v['id'],$children)){ continue; }else{ echo '<option '.$select.' value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; } ?>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">排序:</td>
                <td>
                    <input type="text" name='order_id'  value="<?php echo $idData['order_id'] ?>" size="15" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="is_index" value="1" <?php if($idData['is_index']==1) echo 'checked="true"'; ?>/> 是
                    <input type="radio" name="is_index" value="0" <?php if($idData['is_index']==0) echo 'checked="true"'; ?>  /> 否
                </td>
            </tr>
            <tr>
                <td class="label">分类展示图</td>
                <td>
                    <input type="file" name="img_src" id="logo" size="45"><br/>
                    <span class="notice-span" style="display:block"  id="warn_brandlogo">如作为顶级分类且显示请上传展示图</span>
                </td>
            </tr>
        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>
</div>


<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>