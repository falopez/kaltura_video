<?php
/**
 * View river item about an updated video.
 */

$object = $vars['item']->getObjectEntity();
$excerpt = strip_tags($object->excerpt);
$excerpt = elgg_get_excerpt($excerpt);

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt,
));