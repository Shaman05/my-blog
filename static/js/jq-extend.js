/*
 *此文件是讲常用的一些方法扩展到了jq上
 *作者： shaman
 *2011-09-06
 */

/*----------------------------jQuery静态属性或方法扩展---------------------------------*/
/*
 * 图片预加载 
 * @param 参数为图片的url,参数个数可以多个 
 */
jQuery.preloadImage=function(){
	//console.log(typeof(arguments[0]))
	for(var i=0; i<arguments.length; i++){
		$("<img/>").attr("src",arguments[i]).load(function(){
			//console.log($(this).attr("src")+" hasbeen loaded");
		});
	}
};

/*
 *获取浏览器版本
 */
jQuery.nv=function(){
	var isIE=!-[1,];
	if(!isIE){
		var str=navigator.userAgent;
		if(str.indexOf("Firefox")>0){
			return str.substr(str.indexOf("Firefox"),str.length);
		}else if(str.indexOf("Chrome")>0 && str.indexOf("Safari")>0){
			return str.substr(str.indexOf("Chrome"),str.length-str.indexOf("Safari"));
		}else if(str.indexOf("Safari")>0){
			return str.substr(str.indexOf("Safari"),str.length);
		}else{
			return "其他浏览器";
		}
	}else{
		var str=navigator.appVersion;
		return "IE"+str.charAt(22);
	}
};

/*
 *信息提示
 *此方法使用需要shark_tips的样式支持
 */
jQuery.tips=function(msg,type){
	var topDoc=window.top.document;
	var scrollObj=$.nv().indexOf("Chrome")==-1 && $.nv().indexOf("Safari")==-1?$("html",topDoc):$("body",topDoc);
	$(".shark_tips",topDoc).remove();
	$("<div/>",{
		"class":!!type?"shark_tips "+type:"shark_tips",
		"html":msg
	}).appendTo($("body",topDoc));
	var tip=$(".shark_tips",topDoc);
	tip.css("margin",-tip.outerHeight()/2+scrollObj.scrollTop()+"px 0 0 "+(-tip.outerWidth()/2)+"px").delay(1000).fadeOut(350,function(){$(".shark_tips",topDoc).remove()});
};

/*
 *获取url中某个参数的值
 */
jQuery.getQueryString=function(name){      
    var reg=new RegExp("(^|&)"+name+"=([^&]*)(&|$)");      
    var r=window.location.search.substr(1).match(reg);      
    if(r!=null)
		return unescape(r[2]);
	return null;      
};

/*
 * 设置页面中是否启用右键菜单
 * value:Boolean
 */
jQuery.contextMenu=true;  
(function($){
	$(document).bind('contextmenu',function(e){
		return jQuery.contextMenu;
	})
}(jQuery));



/*-----------------------------jQuery对象的属性或方法扩展---------------------------------*/
/*
 * 页面自动回滚到设定的元素位置(正中)
 * @param 目标元素选择器(请确认其是唯一的,否则将会以第一个匹配的元素为准)  
 */
jQuery.fn.autoFocus=function(){
	var o=$(this),
		h=o.outerHeight(),
		wh=window.top.document.documentElement.clientHeight;
	$("body,html").animate({scrollTop:o.offset().top-(wh-h)/2},300);
};

/*
 * 文本框自动显示或者隐藏默认值
 */
jQuery.fn.toggleValue=function(){
	var values=[];
	this.each(function(i){
		values[i]=$(this).val();
		$(this).bind({
			focusin:function(){
					if($(this).val()==values[i])
						$(this).val("");
				},
			focusout:function(){
					if($.trim($(this).val())=="")
						$(this).val(values[i]);
				}
		})
	})
};

jQuery.fn.version="1.0";  //新增一个jQuery对象的属性 

    