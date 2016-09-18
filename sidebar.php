<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="mobnav">
<a id="mobile-menu">☰</a>
<a href="<?php $this->options->siteUrl(); ?>"><span style="display: inline; text-align: center; color: rgb(255, 255, 255);"><?php $this->options->title(); ?></span></a>
</div>
<div id="secondary">
<?php $this->need('navbar.php'); ?>
<?php $this->need('footer.php'); ?>
</div><!-- end #secondary -->
