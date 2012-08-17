<div class="content">
    <div class="side">
        <?php include 'side.php'; ?>
    </div>
    <div class="main">
        <?php include 'article_block.php'; ?>
        <?php if(isset($displayMore) && $displayMore === TRUE){ ?>
        <div class="read-more-bar">
           <a href="javascript:get_more_article('<?php echo $c; ?>');" title="read more">点击查看更多文章</a>
        </div>
        <?php } ?>
    </div>
    <div class="top-down">
        <a id="go-top" href="#top" title="move top">top</a><a id="go-down" href="#down" title="move down">down</a>
    </div>
</div>