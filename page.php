<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
$this->need('sidebar.php'); ?>
<header id="header" role="post">
<h1 class="post-title" itemprop="name headline"><?php $this->options->title(); ?>：<?php $this->title() ?></a>
</header>
<div id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->
<?php $this->need('footer.php'); ?>
