<?php

elgg_make_sticky_form('kaltura_video');

// Video entry id is always set when accessing the action
$kaltura_video_id = get_input('kaltura_video_id');
if (!$kaltura_video_id) {
	register_error(elgg_echo('kaltura_video:error:video_entry_not_found'));
	forward(REFERER);
}

$guid = get_input('guid');

if ($guid) {
	$entity = get_entity($guid);
	if (elgg_instanceof($entity, 'object', 'kaltura_video') && $video->canEdit()) {
		$video = $entity;
	} else {
		register_error(elgg_echo('kaltura_video:error:video_not_found'));
		forward(REFERER);
	}
	$new_post = true;
} else {
	$video = new KalturaVideo();
	$video->subtype = 'kaltura_video';
	$video->kaltura_video_id = $kaltura_video_id;
}

// Set default values
$values = array(
	'title' => '',
	'description' => '',
	'access_id' => ACCESS_DEFAULT,
	'collaborate_on' => '',
	'rating_on' => '',
	'comments_on' => 'On',
	'tags' => '',
	'container_guid' => (int)get_input('container_guid'),
);

// fail if a required entity isn't set
$required = array('title', 'description');

// load from POST and do sanity and access checking
foreach ($values as $name => $default) {
	$value = get_input($name, $default);

	if (in_array($name, $required) && empty($value)) {
		$error = elgg_echo("kaltura_video:error:missing:$name");
	}

	if ($error) {
		break;
	}

	switch ($name) {
		case 'tags':
			if ($value) {
				$values[$name] = string_to_tag_array($value);
			} else {
				unset ($values[$name]);
			}
			break;

		case 'container_guid':
			// this can't be empty or saving the base entity fails
			if (!empty($value)) {
				if (can_write_to_container($user->getGUID(), $value)) {
					$values[$name] = $value;
				} else {
					$error = elgg_echo("kaltura_video:error:cannot_write_to_container");
				}
			} else {
				unset($values[$name]);
			}
			break;

		// don't try to set the guid
		case 'guid':
			unset($values['guid']);
			break;

		default:
			$values[$name] = $value;
			break;
	}
}

// assign values to the entity, stopping on error.
if (!$error) {
	foreach ($values as $name => $value) {
		if (FALSE === ($video->$name = $value)) {
			$error = elgg_echo('kaltura_video:error:cannot_save' . "$name=$value");
			break;
		}
	}
}

if ($error) {
	register_error($error);
	forward(REFERER);
}

// update video details on kaltura server
try {
	elgg_load_library('kaltura_video');
	
	$kmodel = KalturaModel::getInstance();
	$entry = $kmodel->getEntry($kaltura_video_id);
	$entry->name = $video->name;
	$entry->description = $video->description;
	$entry->tags = $video->tags;
	//$entry->adminTags = KALTURA_ADMIN_TAGS; // @todo What is this used for?

	//$entry = $kmodel->updateMediaEntry($kaltura_video_id, $entry);
} catch(Exception $e) {
	$error = $e->getMessage();
}	

// only try to save base entity if no errors
if (!$error) {
	if ($video->save()) {
		// remove sticky form entries
		elgg_clear_sticky_form('kaltura_video');

		system_message(elgg_echo('kaltura_video:message:saved'));

		// add to river if new post
		if ($new_post) {
			add_to_river('river/object/kaltura_video/create', 'create', elgg_get_logged_in_user_guid(), $video->getGUID());

			if ($guid) {
				$video->time_created = time();
				$video->save();
			}
		}
		
		forward($video->getURL());
	} else {
		register_error(elgg_echo('kaltura_video:error:cannot_save'));
		forward(REFERER);
	}
} else {
	register_error($error);
	forward(REFERER);
}