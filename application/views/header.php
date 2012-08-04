<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Keyword" content="">
    <meta name="Description" content="">
    <link type="text/css" rel="stylesheet" href="/static/css/blog.css">
</head>

<body>
<div class="header clearfix">
    <h1><a href="/"><?php echo $blogInfo->name; ?></a> <span><?php echo $blogInfo->discripte; ?></span></h1>
    <div class="nav">
        <ul class="clearfix">
            <li><a class="home" href="/">主页</a></li>
            <li>
                <a href="javascript:void(0);">前端技术</a>
                <div class="sub-nav">
                    <a href="/index.php/article/html5">Html5</a>
                    <a href="/index.php/article/css3">Css3</a>
                    <a href="/index.php/article/javascript">Javascript</a>
                </div>
            </li>
            <li><a href="/index.php/article/nodejs">Nodejs</a></li>
            <!--<li><a class="current" href="/index.php/friend">网上邻居</a></li>-->
            <li><a class="current" href="/index.php/aboutme">关于我</a></li>
            <li class="search">
                <a href="javascript:doSearch();"><span>Search</span></a>
                <div class="sub-nav">
                    <input type="text" id="searchIpt" placeholder="Input search keyword">
                </div>
            </li>
        </ul>
    </div>
</div>