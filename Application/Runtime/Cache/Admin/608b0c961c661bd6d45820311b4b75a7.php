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


<style>
#pic_list li{float:left;list-style-type:none;margin:8px;}
#old_pic_list li{float:left;list-style-type:none;margin:20px;}
#old_desc_list li{float:left;list-style-type:none;margin:20px;}
#cat_list li{float:left;list-style-type:none;}
</style>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" >通用信息</span>
            <span class="tab-back" >商品描述</span>
            <span class="tab-back" >商品属性</span>
            <span class="tab-back" >商品图片</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/index.php/Admin/Goods/edit" method="post">
            <!--通用信息-->
            <table width="90%" class="general-table" align="center">
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo $data['goods_name'] ?>"size="30" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id">
                        <option value="">请选择...</option>
                        <?php foreach($catData as $k => $v): if($v['id']==$data['cat_id']){ $select = 'selected="selected"'; }else{ $select = ""; } ?>
                        <?php echo '<option ' .$select.' value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                        <?php endforeach; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">扩展分类：</td>
                    <td>
                    <input type="button" id="btn_add_cat" value="添加一个分类">
                    <ul id="cat_list">
                        <li>
                        <select name="ext_cat_id[]">
                        <option value="">请选择...</option>
                        <?php foreach($catData as $k => $v): ?>
                        <?php echo '<option value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                        <?php endforeach; ?>
                        </select>
                        </li>
                        <?php foreach($gcData as $k1 => $v1): ?>
                        <li>
                        <select name="ext_cat_id[]">
                        <?php foreach($catData as $k => $v): if($v['id']==$v1['cat_id']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                        <?php echo '<option '.$select.' value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                        <?php endforeach; ?>
                        </select>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <?php buildSelect('brand','brand_id','id','name',$data['brand_id']) ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo $data['shop_price'] ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="1" <?php if($data['is_on_sale']=='1') echo 'checked="checked"'; ?>/> 是
                        <input type="radio" name="is_on_sale" value="0" <?php if($data['is_on_sale']=='0') echo 'checked="checked"'; ?>/> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_new" value="1" <?php if($data['is_new']=='1') echo 'checked="checked"'; ?>/> 新品
                        <input type="checkbox" name="is_hot" value="1" <?php if($data['is_hot']=='1') echo 'checked="checked"'; ?>/> 热销
                    </td>
                </tr>
                <tr>
                    <td class="label">商品标签：</td>
                    <td>
                        <input type="text" name="tag" value="<?php echo $data['tag'] ?>"  /> (多种标签属性用逗号‘,’隔开，建议不超过两个)
                    </td>
                </tr>
                <tr>
                    <td class="label">推荐排序：</td>
                    <td>
                        <input type="text" name="order_id" size="5" value="<?php echo $data['order_id'] ?>"/>
                    </td>
                </tr>
        </table>
        <!--商品描述-->
        <table width="90%" style="display:none" class="general-table" align="center">
            <tr>
                <td>
                    <ul id="pic_list">
                        <li>
                            <input type="file" name="desc_pic[]" multiple>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    <ul id="old_desc_list">
                        <?php foreach($descData as $k => $v): ?>
                        <li>
                            <input type="button" class="desc_del" desc_id="<?php echo $v['id']; ?>" value="删除"></br>
                            <img src="<?php echo $v['img_src'] ?>" style="width: 80px;height: 80px;">
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        </table>
        <!--商品属性-->
        <table width="90%" style="display:none" class="general-table" align="center"> 
                <tr>
                    <td class="label">商品类型：</td>
                    <td>
                        <?php buildSelect('type','type_id','id','type_name',$data['type_id']) ?>
                        <ul id='attr_list'>
                          <?php  $attrId = array(); foreach($attData as $k => $v): if(in_array($v['attr_id'],$attrId)){ $pot = '-'; }else{ $pot = '+'; $attrId[] = $v['attr_id']; } ?>
                          <li>
                          <input type="hidden" name="goods_attr_id[]" value="<?php echo $v['id'] ?>">
                          <?php if($v['attr_type'] == '2'): ?>
                          <a onclick="addNewAttr(this)" href="#">[<?php echo $pot; ?>]</a>
                          <?php endif; ?>
                          <?php echo $v['attr_name'] ?>
                          <?php if($v['attr_option_values']): $attr = explode(',',$v['attr_option_values']); ?>
                          <select name="attr_value[<?php echo $v['attr_id'] ?>][]">
                              <option value="">请选择...</option>
                              <?php foreach($attr as $k1 => $v1 ): if($v1 == $v['attr_value']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                              <option <?php echo $select?> value="<?php echo $v1?>"><?php echo $v1?></option>
                              <?php endforeach; ?>
                          </select>
                          <?php else: ?>
                          <input type="text" name="attr_value[<?php echo $v['attr_id'] ?>][]" value="<?php echo $v['attr_value'] ?>">
                          <?php endif; ?>
                          </li>
                          <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>    
          </table>
          <!--商品图片-->
          <table width="90%" style="display:none" class="general-table" align="center">   
                 <tr>
                    <td>
                        <ul id="pic_list">
                           <li>
                             <input type="file" name="pic[]" multiple>
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <ul id="old_pic_list">
                        <?php foreach($gpiData as $k => $v): ?>
                        <li>
                          <input type="button" class="pic_del" pic_id="<?php echo $v['id']; ?>" value="删除"></br>
                          <img src="<?php echo $v['img_src'] ?>" style="width: 80px;height: 80px;">
                        </li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
          </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>
<script>
$('#tabbar-div p span').click(function(){
	//获取点击的哪个
	var i = $(this).index();
	//隐藏所有table
	$('.general-table').hide();
	//显示点击的
	$('.general-table').eq(i).show();
	//改变所有
	$('.tab-front').removeClass('tab-front').addClass('tab-back');
	$(this).removeClass('tab-back').addClass('tab-front');
});
</script>
<script>
$('.pic_del').click(function(){
	//选择删除按钮所在LI标签
	var li = $(this) .parent();
	//获取pic_id属性
	var pid = $(this).attr("pic_id");
	
	$.ajax({
		type:"GET",
		url:"<?php echo U('ajaxDelPic','',FALSE);?>/picid/"+pid,
		success:function(data){
			//把图片从页面删除
			li.remove();
		}
	});
})
$('.desc_del').click(function() {
    //选择删除按钮所在LI标签
    var li = $(this).parent();
    //获取desc_id属性
    var did = $(this).attr("desc_id");

    $.ajax({
        type: "GET",
        url: "<?php echo U('ajaxDelDesc','',FALSE);?>/descid/" + did,
        success: function (data) {
            //把图片从页面删除
            li.remove();
        }
    });
})
</script>
<script>
$('#btn_add_cat').click(function(){
	$('#cat_list').append($('#cat_list').find('li').eq(0).clone());
});
</script>
<!--根据商品类型获取商品属性-->
<script>
$("select[name=type_id]").change(function(){
	var typeId = $(this).val();
	var self = <?php echo $data['type_id']; ?>;
    var attr = '';
	//如果选择了类型就执行AJAX
	if(typeId > 0){
        if(type = self){
            var data = <?php echo json_encode($attData); ?>;
            console.log(data);
            var li = '';
            $(data).each(function(k,v){
                li += '<li>';
                //如果属性有可选值就做下拉框。否则文本框
                if(v.attr_type == '1' && v.attr_value != null){
                    li += '<input type="hidden" name="goods_attr_id[]" value="'+v.id+'">' +v.attr_name+':'+
                        '<input type="text" name="attr_value['+v.attr_id+'][]" value="'+v.attr_value+'" />';
                }else if(v.attr_type == '1' && v.attr_value == null){
                    li += '<input type="hidden" name="goods_attr_id[]" value="">'+v.attr_name+':'+'<input type="text" name="attr_value['+v.attr_id+'][]" />';
                }else{
	               if(v.attr_id != attr){
                       li += '<a  onclick="addNewAttr(this)" href="#">[+]</a>';

                   }else{
                       li += '<a  onclick="addNewAttr(this)" href="#">[-]</a>';
                   }
                   attr = v.attr_id;
                    li += '<select name="attr_value['+v.id+'][]"><option value="" >请选择...</option>';
                    //把可选值转换为数组
                    var _attr = v.attr_option_values.split(',');
                    //循环每个值制作option
                    for(var i=0;i<_attr.length;i++){
                         if(_attr[i] == v.attr_value){
                             li += '<option value="'+_attr[i]+'" selected="selected">'+_attr[i]+'</option>';
                         }else{
                             li += '<option value="'+_attr[i]+'">'+_attr[i]+'</option>';
                         }
                     }
                    li += '</select>';
                }
                li += '</li>';
            });
            //把拼好的LI放到页面中
            $('#attr_list').html(li);
        }else{
            $.ajax({
                type : "GET",
                url : "<?php echo U('ajaxGetAttr','',FALSE); ?>/type_id/"+typeId,
                dataType : "json",
                success : function(data){
                    /*******把服务器返还的属性循环拼成LI字符串********/
                    var li = '';
                    $(data).each(function(k,v){
                        li += '<li>';
                        //如果属性可选前面就有一个＋
                        if(v.attr_type == '2'){
                            li += '<a  onclick="addNewAttr(this)" href="#">[+]</a>';
                        }
                        li += v.attr_name+':';
                        //如果属性有可选值就做下拉框。否则文本框
                        if(v.attr_type == '1'){
                            li += '<input type="text" name="attr_value['+v.id+'][]" />';
                        }else{
                            li += '<select name="attr_value['+v.id+'][]"><option value="" >请选择...</option>';
                            //把可选值转换为数组
                            var _attr = v.attr_option_values.split(',');
                            //循环每个值制作option
                            for(var i=0;i<_attr.length;i++){
                                li += '<option value="'+_attr[i]+'">'+_attr[i]+'</option>';
                            }
                            li += '</select>';
                        }
                        li += '</li>';
                    });
                    //把拼好的LI放到页面中
                    $('#attr_list').html(li);
                }
            });
        }
	}else{
		$('#attr_list').html('');
	}
});
//点击属性的【+】号
function addNewAttr(a){
	var li = $(a).parent();
	if($(a).text() == '[+]'){
		var newLi = li.clone();
		newLi.find("option:selected").removeAttr('selected');
		newLi.find("input[name='goods_attr_id[]']").val('');
		newLi.find('a').text('[-]')
		li.after(newLi);
	}else{
		//获取该属性ID
		var gaid = li.find("input[name='goods_attr_id[]']").val();
		if(gaid == ''){
		  li.remove();
		}else{
			if(confirm('如果删除这个属性，那么相关库存量也会删除，确定删除吗？')){
				$.ajax({
					type : "GET",
					url : "<?php echo U('ajaxDelAttr?goods_id='.$data['id'],'',FALSE) ?>/gaid/"+gaid,
					success : function(data){
						li.remove();
					}
				});
			}
		}
	}
}
</script>

<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>