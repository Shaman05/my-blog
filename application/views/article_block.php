<?php
    foreach($artList as $row){
?>
<div class="article">
    <h3 class="art-title"><a href="/index.php/article/<?php echo $row->id;?>"><?php echo $row->title; ?></a></h3>
    <div class="art-info">
        <?php echo $row->author; ?> 发表于 <?php echo $row->pub_date; ?>&nbsp;&nbsp;
        文章分类：<a href="/index.php/article/<?php echo $row->category; ?>" title="查看 <?php echo $row->category; ?> 下的文章"><?php echo $row->category; ?></a>&nbsp;&nbsp;
        标签：
        <?php foreach(explode(',',$row->tag) as $tag){ ?>
        <a href="/index.php/tag/<?php echo $tag; ?>" title="查看包含 <?php echo $tag; ?> 标签的文章"><?php echo $tag; ?></a>
        <?php } ?>
        &nbsp;&nbsp;有<em><?php echo $row->hits; ?></em>个同学来打过酱油
    </div>
    <div class="art-cont">
        <?php echo $row->short_desc; ?>
    </div>
    <div class="art-footer">
        <a href="#" title="去发表评论"><?php echo $row->comments; ?>个评论</a>&nbsp;&nbsp;
        <a href="/index.php/article/<?php echo $row->id;?>" title="阅读全文">阅读全文</a>
    </div>
</div>
<?php } ?>