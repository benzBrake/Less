		<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
 		<nav id="nav" class="sb" role="navigation" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
			<ul id="site-menu" class="nav-menu">
				<li><a <?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
				<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
				<?php while($pages->next()): ?>
				<?php if(isset($pages->fields->navbar)): ?>
				<?php 
						$result = strpos($pages->fields->navbar,'navbar');
						if ($result!==false): ?>
				<li id="menu-item-<?php $pages->cid() ?>" class="menu-item">
					<a <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>">
							<? $pages->title(); ?>
					</a>
				</li>
				<?php endif; ?>
				<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		 </nav>