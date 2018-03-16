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


<div class="form-div">
    <form action="/index.php/Admin/attribute/lst/type_id/1.html" name="searchForm">
    <p>
    属性名称：<input type="text" name="attr_name" size="15" value="<?php echo I('get.attr_name'); ?>" />
    </p>
    <p>
    属性类型：<input type="radio" name="attr_type" <?php if(I('get.attr_type') == "")echo 'checked="checked"'; ?> value="">全部
              <input type="radio" name="attr_type" <?php if(I('get.attr_type') == 1)echo 'checked="checked"'; ?> value="1">唯一
              <input type="radio" name="attr_type" <?php if(I('get.attr_type') == 2)echo 'checked="checked"'; ?> value="2">可选
    </p>
    <p>
    所属类型：<?php buildSelect('type','type_id','id','type_name',I('get.type_id')) ?>
    </p>
    <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
 
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>属性名称</th>
                <th>属性类型</th>
                <th>属性可选值</th>
                <th>所属类型</th>
                <th>操作</th>
            </tr>
            <?php foreach($data['data'] as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['attr_name'] ?></td>
                <td align="center"><?php echo ($v['attr_type']==1)?'唯一':'可选'; ?></td>
                <td align="center"><?php echo $v['attr_option_values'] ?></td>
                <td align="center"><?php echo $v['type_name'] ?></td>
                <td align="center">
                <a href="<?php echo U('edit?id='.$v['id']) ?>" >编辑</a> |
                <a href="<?php echo U('delete?id='.$v['id'].'&type_id='.$v['type_id']) ?>">移除</a>
                </td>
            </tr>
            <?php endforeach; ?>
 <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $data['page'] ?>
                </td>
            </tr>
        </table>
 <!--引入高亮显示-->
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>          



<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>