<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
$this->need('header.php');
$this->need('sidebar.php'); ?>
<header id="header" role="post">
<h1 class="post-title" itemprop="name headline"><?php $this->options->title(); ?>：<?php $this->title() ?></a>
</header>
<div id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        
        <ul class="post-meta">
            <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
            <li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
            <li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
            <li><?php _e('阅读: '); ?><?php get_post_view($this) ?></li>
        </ul>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <p itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, 'none'); ?></p>
    </article>

    <?php $this->need('comments.php'); ?>

    <ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
        <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
    </ul>
</div><!-- end #main-->

