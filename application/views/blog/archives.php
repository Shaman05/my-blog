<div class="content">
    <div class="archives-count">共 <strong><?php echo sizeof($artList); ?></strong> 篇文章。</div>
    <div class="archives-cont">
        <ul>
            <?php foreach($artList as $row){ ?>
            <li><a href="/index.php/article/<?php echo $row['id'];?>" title="查看<?php echo $row['title']; ?>详细内容"><?php echo $row['title']; ?></a><span><?php echo substr($row['pub_date'], 0, 10);?></span></li>
            <?php } ?>
        </ul>
    </div>
    <br>
</div>