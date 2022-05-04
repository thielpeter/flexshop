<?php

/**
 * @var rex_addon $this
 */
 
$addon = rex_addon::get('flexshop');

if (rex::isFrontend()) {
    rex_extension::register('OUTPUT_FILTER', static function (rex_extension_point $ep) use ($addon) {
        
		$ep->setSubject(str_ireplace(
				['</body>'],
				['<script src="'. $addon->getAssetsUrl('flexshop.js') .'"></script></body>'],
				$ep->getSubject())
		);
    });
}
 
rex_yform_manager_dataset::setModelClass('rex_flexshop_object', rex_flexshop_object::class);
rex_yform_manager_dataset::setModelClass('rex_flexshop_categorie', rex_flexshop_categorie::class);

if (!rex::isBackend()) {
	rex_extension::register('OUTPUT_FILTER', function(rex_extension_point $ep) {
		
		$content = $ep->getSubject();
		
		if (!is_null(rex_article::getCurrent())) {
			preg_match_all("/REX_FLEXSHOP\[object=(.*?)]/", $content, $matches, PREG_SET_ORDER);
			
			foreach($matches as $match){
				$content = str_replace($match[0], rex_flexshop::get($match[1]), $content);
			}
			
			preg_match_all("/REX_FLEXSHOP\[cart=light]/", $content, $matches, PREG_SET_ORDER);
			
			foreach($matches as $match){
				$content = str_replace($match[0], rex_flexshop::getCartLight(), $content);
			}
			
			preg_match_all("/REX_FLEXSHOP\[cart]/", $content, $matches, PREG_SET_ORDER);
			
			foreach($matches as $match){
				$content = str_replace($match[0], rex_flexshop::getCartOutput(), $content);
			}
		}
		
		$ep->setSubject($content);
	});
}