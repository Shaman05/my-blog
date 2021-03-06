/**
 * Created with JetBrains PhpStorm.
 * Author: Shaman
 * Date: 12-8-2
 * Time: 下午10:45
 * To change this template use File | Settings | File Templates.
 */

$(function(){
    var delay = null;
    var side = $(".side"),
        main = $(".main");
    var sh = side.outerHeight(),
        mh = main.outerHeight();
    if(sh > mh){
        main.css("height",sh-40);
    }

    $(".nav li").has(".sub-nav").hover(
       function(){
           var _this = this;
           delay = setInterval(function(){
               $(_this).find(".sub-nav").fadeIn(280);
           },300);
       },
       function(){
           $(this).find(".sub-nav").fadeOut(280);
           clearInterval(delay);
       }
    );

    $("#searchIpt").on("keyup", function(e){
        if(e.keyCode == 13)
            doSearch();
    });

    var keyword = $("#kw").text();
    $(".search-cont .art-title a").each(function(){
        var re = new RegExp(keyword,"ig");
        var str = $(this).html().replace(re,'<strong style="color:#F00">' + keyword + '</strong>');
        $(this).html(str);
    });

    var ch = $(".content").offset().top;
    var scrollObj = $.nv().indexOf("Chrome") == -1 && $.nv().indexOf("Safari") == -1 ? $("html") : $("body");
    $(window).on("scroll", function(){
        displayIt();
    });

    $("#go-top").on("click", function(){
        scrollObj.stop().animate({scrollTop : 0}, 500);
        return false;
    });
    $("#go-down").on("click", function(){
        var sh =  $.nv().indexOf("IE") == -1 ? scrollObj.outerHeight() : 99999;
        scrollObj.stop().animate({scrollTop : sh} , 500);
        return false;
    });

    tagCloud($(".tags a") , 12, 24);

    jQuery.syntax();

    function displayIt(){
        var o = $(".top-down");
        var sh = scrollObj.scrollTop();
        if(sh > ch){
            o.fadeIn(300);
        }else{
            o.fadeOut(300);
        }
    }

    displayIt();
});

function doSearch(){
    var kw = $.trim($("#searchIpt").val());
    kw && (window.location.href = '/index.php/search/' + kw);
    return;
}

function get_more_article(category){
    var offset = $(".main>.article").size() || 0;
    var btn = $(".read-more-bar");
    btn.find("a").text("正在获取数据...");
    $.post('/index.php/api/get_more_article', {'category':category, 'offset':offset}, function(d){
        if(d == 0){
            btn.find("a").text("没有了").attr("href","javascript:void(0);");
            return;
        }
        $(d).insertBefore(btn);
        btn.find("a").text("点击查看更多文章");
    })
}

function submitComment(aid){
    var error = $("#com-error");
    var name = $.trim($("#com-name").val()),
        email = $.trim($("#com-email").val()),
        website = $.trim($("#com-website").val()),
        content = $.trim($("#com-content").val());
    if(!name || !content){
        error.text("姓名或者内容不能为空！").show();
        return;
    }
    error.hide();

    $.ajax({
        url : '/index.php/api/submit_comment',
        type : 'POST',
        data : {'aid':aid, 'name':name, 'email':email, 'website':website, 'content':content},
        dataType : 'JSON',
        success : function(data){
            error.text(data.text).show();
            if(data.status){
                $("#com-name,#com-email,#com-website,#com-content").val('');
                getLastComment(aid);
                setTimeout(function(){
                    error.hide();
                },1000);
            }    
        }
    });
}

function getLastComment(aid){
    var list = $(".com-list");
    $.ajax({
        url : '/index.php/api/get_last_comment/' + aid,
        dataType : 'HTML',
        success : function(html){
            if(list.find("ul").size() == 0){
                list.html("<ul></ul>");
            }
            $(html).appendTo(list.find("ul"));
        }
    });
}

function displayLog(){
    $(".blog-log").toggle(0);
}

function tagCloud(elems, minFs, maxFs){
    var total = 0;
    if(!elems)return;
    elems.each(function(){
        total += parseInt($(this).attr("rel"));
    })
    elems.each(function(){
        var fs, cur = parseInt($(this).attr("rel"));
        if(cur === 1){
            fs = minFs;
        }else{
            fs = minFs + Math.ceil((cur/total)*minFs);
            fs = fs > maxFs ? maxFs : fs;
        }
        $(this).css("font-size", fs + "px");
    })
}

jQuery.nv = function(){
    var isIE = !-[1, ];
    if(!isIE){
        var str = navigator.userAgent;
        if(str.indexOf("Firefox") > 0){
            return str.substr(str.indexOf("Firefox") , str.length);
        }else if(str.indexOf("Chrome") > 0 && str.indexOf("Safari") > 0){
            return str.substr(str.indexOf("Chrome") , str.length - str.indexOf("Safari"));
        }else if(str.indexOf("Safari") > 0){
            return str.substr(str.indexOf("Safari") , str.length);
        }else{
            return "其他浏览器";
        }
    }else{
        var str = navigator.appVersion;
        return "IE" + str.charAt(22);
    }
}