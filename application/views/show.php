<div class="content">
    <div class="side">
        <?php include 'side.php'; ?>
    </div>
    <div class="main">
        <div class="article art-show">
            <h3 class="art-title"><?php echo $article->title; ?></h3>
            <div class="art-info">
                <?php echo $article->author; ?> 发表于 <?php echo $article->pub_date; ?>&nbsp;&nbsp;
                文章分类：<a href="#" title="查看 <?php echo $article->category; ?> 下的文章"><?php echo $article->category; ?></a>&nbsp;&nbsp;
                标签：<a href="#" title="查看包含 <?php echo $article->tag; ?> 标签的文章"><?php echo $article->tag; ?></a>&nbsp;&nbsp;
                有<em><?php echo $article->hits; ?></em>个同学来打过酱油
            </div>
            <div class="art-cont">
                <?php echo $article->content; ?>
            </div>
            <div class="comments art-cont">
                <h4>评论</h4>
                <div class="com-list">
                </div>
                <div class="com-form">
                    <h5>Name:</h5>
                    <div>
                        <input type="text" id="com-name"><span>*</span>
                    </div>
                    <h5>Email:</h5>
                    <div>
                        <input type="text" id="com-email">
                    </div>
                    <h5>Website:</h5>
                    <div>
                        <input type="text" id="com-website">
                    </div>
                    <h5>Comment</h5>
                    <div>
                        <textarea id="com-content"></textarea>
                    </div>
                </div>
            </div>
            <div class="prev-art">
                <?php if($prev_article !== 0){ ?>
                上一篇：<a href="/index.php/article/<?php echo $prev_article->id; ?>"><?php echo $prev_article->title; ?></a>
                <?php }else{ ?>
                上一篇：木有了
                <?php } ?>
            </div>
            <div class="next-art">
                <?php if($next_article !== 0){ ?>
                下一篇：<a href="/index.php/article/<?php echo $next_article->id; ?>"><?php echo $next_article->title; ?></a>
                <?php }else{ ?>
                下一篇：木有了
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="top-down">
        <a id="go-top" href="#top" title="move top">top</a><a id="go-down" href="#down" title="move down">down</a>
    </div>
</div>