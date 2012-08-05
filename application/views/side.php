<dl>
    <dt>热门文章</dt>
    <?php foreach($topx_rows as $row){ ?>
    <dd><a href="/index.php/article/<?php echo $row->id; ?>" title="<?php echo $row->title; ?>"><?php echo $blogInfo->clip_text($row->title, 30); ?></a></dd>
    <?php } ?>
</dl>
<dl class="category">
    <dt>分类目录</dt>
    <?php foreach($categorys as $row){ ?>
    <dd><a href="/index.php/article/<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a> (<?php echo $row['count']; ?>)</dd>
    <?php } ?>
</dl>
<dl>
    <dt>标签云</dt>
    <dd class="tags">
        <?php foreach($tags as $row){ ?>
        <a href="/index.php/tag/<?php echo $row; ?>"><?php echo $row; ?></a>
        <?php } ?>
    </dd>
</dl>
<dl>
    <dt>文章归档</dt>
    <?php foreach($archives as $row){ ?>
    <dd><a href="#"><?php echo $row; ?></a></dd>
    <?php } ?>
</dl>