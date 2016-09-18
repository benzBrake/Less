<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer id="footer" class="sb" role="contentinfo">
    <ul>
       <li>&copy; <?php echo date('Y'); ?><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></li>
       <li><?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?></li>
    </ul>
</footer><!-- end #footer -->
<script src="<?php $this->options->themeUrl('instantclick.min.js'); ?>" data-no-instant></script>
<script data-no-instant>
function hasClass(obj, cls) {  
    return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));  
}  
  
function addClass(obj, cls) {  
    if (!this.hasClass(obj, cls)) obj.className += " " + cls;  
}  
  
function removeClass(obj, cls) {  
    if (hasClass(obj, cls)) {  
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');  
        obj.className = obj.className.replace(reg, ' ');  
    }  
}  
  
function toggleClass(obj,cls){  
    if(hasClass(obj,cls)){  
        removeClass(obj, cls);  
    }else{  
        addClass(obj, cls);  
    }  
}
function mobnav(){
	var sidebar = document.getElementById('secondary');
	var mobilemenu = document.getElementById('mobile-menu');
	var topline = document.getElementById('mobnav');
	var main = document.getElementById('main');
	mobilemenu.onclick = function () {
		toggleClass(sidebar,"show")
		toggleClass(main,"show")
		toggleClass(topline,"show")
	}
}
InstantClick.on('change', function(isInitialLoad) {
	if (isInitialLoad === false) {
		if (typeof Prism !== 'undefined') Prism.highlightAll(true,null);
		mobnav();
	}
});
InstantClick.init();
window.onload = mobnav;
</script>
<?php $this->footer(); ?>
