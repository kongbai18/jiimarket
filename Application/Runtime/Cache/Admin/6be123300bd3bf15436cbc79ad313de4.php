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
    <form action="/index.php/Admin/Brand/lst.html" name="searchForm">
    <img src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="name" size="15" value="<?php echo I('get.name'); ?>"/>
    <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>品牌名称</th>
                <th>品牌LOGO</th>
                <th>排序</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
        <?php foreach($data['data'] as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['name'] ?></td>
                <td align="center"><img src="<?php echo $v['logo_src'] ?>" width="50px;" height="50px;"></td>
                <td align="center"><?php echo $v['order_id'] ?></td>
                <td align="center"><?php echo $v['is_index'] == 1 ? '显示': '不显示'; ?></td>
                <td align="center">
                <a href="<?php echo U('edit?id='.$v['id']) ?>" title="编辑">编辑</a> |
                <a href="<?php echo U('del?id='.$v['id']) ?>" title="移除">移除</a>
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