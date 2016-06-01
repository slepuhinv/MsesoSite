<div class="endline"></div><!-- footer start -->	<div id="footer" class="clearfix">		<div class="credit">				Все права защищены. <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>.				<br/>				<div class="footer_c"><p style="text-align: center;"><?php if ($user_ID) : ?><?php else : ?>
<?php if (is_home()) { ?><a href="http://best-wordpress-templates.ru/">Темы WordPress</a>
<?php } elseif (is_single()) {?><a href="http://best-wordpress-templates.ru/">WordPress</a>
<?php } elseif (is_category()) {?><a href="http://best-wordpress-templates.ru/">WordPress</a>
<?php } elseif (is_archive()) {?><a href="http://styleswp.com/">WordPress Themes</a>
<?php } elseif (is_page()) {?><a href="http://skinwp.ru/">WordPress</a>
<?php } else {?><?php } ?><?php endif; ?></p></div>                		</div>	</div><!-- footer end --></div></div></div></div><!-- wrapper end --><?php wp_footer(); ?></body></html>