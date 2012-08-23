<? php

	if (extension_loaded('zlib')) { //检查服务器是否开启了zlib拓展
		ob_start('ob_gzhandler');
	}
	header("content-type: text/css; charset: utf-8"); //注意修改到你的编码
	header("cache-control: must-revalidate");
	$offset = 60 * 60 * 24; //css文件的距离现在的过期时间，这里设置为一天
	$expire = "expires: ".gmdate("D, d M Y H:i:s", time() + $offset)." GMT";
	header($expire);
	ob_start("compress");

	function compress($buffer) { //去除文件中的注释
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		return $buffer;
	}

	//包含你的全部css文档
	include('blog.css');

	if (extension_loaded('zlib')) {
		ob_end_flush(); //输出buffer中的内容，即压缩后的css文件
	}