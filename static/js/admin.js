/**
 * Created with JetBrains PhpStorm.
 * Author: Shaman
 * Date: 12-8-23
 * Time: 下午1:31
 * To change this template use File | Settings | File Templates.
 */

$(function(){
	//创建点击触发异步请求的队列
	var clickQueue = [];

    $("a:not(.home)").live("click", loadPage);
    $("tbody tr",".content").live({
    	"mouseover" : function(){
    		$(this).addClass("trHover");
    	},
    	"mouseout" : function(){
    		$(this).removeClass("trHover");
    	}
    })
    ajaxPage("ad_article");

    function loadPage(event){
    	if($(this).attr("rel") !== "del" || $(this).attr("rel") !== "eidt"){
			clickQueue.push($(this));
		}    	
		if($(this).attr("rel") == "del"){
			if(!confirm("确定删除吗？"))return false;
		}
		var url = $(this).attr("href");
		if(url.indexOf("http://") < 0){
			ajaxPage(url);
			return false;
		}
	}

	function ajaxPage(url){
		var content = $("#page");
		var parseUrl = 'api/' + url.split("index.php/").pop() + "?t=" + new Date().getTime();
		$.ajax({
			dataType: "JSON",
			url : parseUrl,
			success: function(data){
				if(data.html)content.html(data.html);
				//有更新，刷新最后一次点击页面
				if(data.message){
					alert(data.message);
					if(clickQueue.length > 0)
						clickQueue.pop().trigger("click");
					else
						window.location.href = window.location.href;
				}
			}
		})
	}
});