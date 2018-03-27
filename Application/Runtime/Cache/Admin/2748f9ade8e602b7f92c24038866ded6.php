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


<div class="list-div" id="listDiv">
<?php
$CombineCount = 1; foreach($gaData as $k => $v) { $CombineCount *= count($v); } $RepeatTime = $CombineCount; foreach($gaData as $k => $v) { $RepeatTime = $RepeatTime / count($v); $StartPosition = 1; foreach($v as $v1) { $TempStartPosition = $StartPosition; $SpaceCount = $CombineCount / count($v) / $RepeatTime; for($J = 1; $J <= $SpaceCount; $J ++) { for($I = 0; $I < $RepeatTime; $I ++) { $Result[$TempStartPosition + $I][$k] = $v1['id']; } $TempStartPosition += $RepeatTime * count($v); } $StartPosition += $RepeatTime; } } ?>
 <form method="post" action="/index.php/Admin/Goods/goods_number/id/1.html" name="listForm" enctype="multipart/form-data">
       <table cellpadding="3" cellspacing="1">
            <tr>
                <?php foreach($gaData as $k => $v): ?>
                <th><?php echo $k; ?></th>
                <?php endforeach; ?>
                <?php if(empty($gaData)){ ?>
                <th>无属性</th>
                <?php } ?>
                <th>商品价格</th>
                <th>商品库存</th>
                <th>商品图</th>
            </tr>


           <?php if(empty($gaData)){ ?>
           <input type="hidden" name="goods_attr_id[]" value="0">
           <td align="center">默认</td>
           <input type="hidden" name="id[]" value="<?php echo $gnData[0]['id']; ?>">
           <td align="center"><input type="text" name="goods_price[]" value="<?php echo $gnData[0]['goods_price']; $gnData[0]['goods_price'] = ''; ?>"></td>
           <td align="center"><input type="text" name="goods_number[]" value="<?php echo $gnData[0]['goods_number']; $gnData[0]['goods_number'] = ''; ?>"></td>
           <td align="center"><input type="file" name="goods_img[]" ><image src="<?php echo $gnData[0]['img_src']; ?>" style="width: 50px;height: 50px;"></td>
            <?php } ?>

            <?php foreach($Result as $k0 => $v0): sort($v0,SORT_NUMERIC); $ret = implode(',',$v0); ?>
            <tr class="tron">
               <?php foreach($gaData as $k => $v): ?>
                   <td align="center">
                     <select name="goods_attr_id[]">
                     <option value="">请选择...</option>
                     <?php foreach($v as $k1 => $v1): if(in_array($v1['id'],$v0)){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                     <option <?php echo $select; ?> value="<?php echo $v1['id'];?>"><?php echo $v1['attr_value'];?></option>
                     <?php endforeach; ?>
                     </select>
                   </td>
                <?php endforeach; ?>
                <?php foreach($gnData as $k2 => $v2): if($v2['goods_attr_id']==$ret){ $id = $v2['id']; $goodsNum = $v2['goods_number']; $goodsPri = $v2['goods_price']; $goodsImg = $v2['img_src']; } ?>
                <?php endforeach;?>
                <input type="hidden" name="id[]" value="<?php echo $id; ?>">
                <td align="center"><input type="text" name="goods_price[]" value="<?php echo $goodsPri; $goodsPri = ''; ?>"></td>
                <td align="center"><input type="text" name="goods_number[]" value="<?php echo $goodsNum; $goodsNum = ''; ?>"></td>
                <td align="center"><input type="file" name="goods_img[]" ><image src="<?php echo $goodsImg; ?>" style="width: 50px;height: 50px;"></td>
            </tr>
            <?php endforeach; ?>
      </table>
      <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
            </div>
 </form>
</div>
 <!--引入高亮显示-->
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>          



<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>