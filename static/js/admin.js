/**
 * Created with JetBrains PhpStorm.
 * Author: Shaman
 * Date: 12-8-23
 * Time: 下午1:31
 * To change this template use File | Settings | File Templates.
 */

$(function(){
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
});

function loadPage(event){
	var url = $(this).attr("href");
	if(url.indexOf("http://") < 0){
		ajaxPage(url);
		return false;
	}
}

function ajaxPage(url){
	var content = $("#page");
	var parseUrl = 'api/' + url.split("/").pop() + "?t=" + new Date().getTime();
	$.ajax({
		dataType: "html",
		url : parseUrl,
		success: function(html){
			content.html(html);
		}
	})
}