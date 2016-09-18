<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
$this->need('sidebar.php'); ?>
<header id="header">
<h3 class="post-title" itemprop="name headline"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></a>
</h3>
</header>
    <div id="main" role="main">
        <?php if ($this->have()): ?>
    	<?php while($this->next()): ?>
            <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
    			<h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                <div class="post-content" itemprop="articleBody">
        			<?php $this->content('- 阅读剩余部分 -'); ?>
                </div>
    		</article>
    	<?php endwhile; ?>
        <?php else: ?>
            <article class="post">
                <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
            </article>
        <?php endif; ?>

        <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    </div><!-- end #main -->