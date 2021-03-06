<?php
	elgg_load_library('kaltura_video');
	
	global $KALTURA_GLOBAL_UICONF;
?>
<h3 class="settings"><?php echo elgg_echo('kalturavideo:admin:player'); ?></h3>

<p><?php echo elgg_echo('kalturavideo:changeplayer'); ?></p>
<p>
	<?php echo elgg_echo('kalturavideo:label:defaultplayer'); ?>:
	<?php
		$t = elgg_get_plugin_setting('kaltura_server_type', 'kaltura_video');
		if (empty($t)) {
			$t = 'corp';
		}
		$widgets = $KALTURA_GLOBAL_UICONF['kdp'][$t];

		$default = elgg_get_plugin_setting('defaultplayer', 'kaltura_video');
		$vals = array();
		foreach ($widgets as $k => $v) {
			$vals[$k] = $v['name'] . ' ('.elgg_echo("kalturavideo:generic") . ' - ' . $v['width'] . 'x' . $v['height'] . 'px)';
		}

		$vals['custom'] = elgg_echo("kalturavideo:customplayer");

		reset($widgets);
		if (empty($default)) {
			$default = key($widgets);
		}

		echo elgg_view('input/dropdown', array(
			'name' => 'defaultplayer',
			'id' => 'defaultplayer',
			'options_values' => $vals,
			'value' => $default
		));
	?>
</p>

<div id="kaltura_video_layer_defaultplayer"<?php echo (elgg_get_plugin_setting('defaultplayer', 'kaltura_video')!='custom' ? 'style="display:none;"' : ''); ?> rel="1">
<p>
	<?php echo elgg_echo('kalturavideo:uiconf1'); ?>:
	<?php
		echo elgg_view('input/url', array('name' => 'custom_kdp','id' => 'custom_kdp', 'value' => elgg_get_plugin_setting('custom_kdp', 'kaltura_video'), 'class' => 'input-short' ));
		echo '<a href="#" id="kaltura_video_getlist_custom_kdp">&larr;'.elgg_echo("kalturavideo:uiconf:getlist").'</a>'
	?>
</p>
<p><?php echo sprintf(elgg_echo('kalturavideo:text:uiconf1'),'<a href="'.KalturaHelpers::getServerUrl().'/index.php/kmc" onclick="window.open(this.href);return false;">'.elgg_echo('kalturavideo:login').'</a>'); ?></p>

</div>


<h3 class="settings"><?php echo elgg_echo('kalturavideo:admin:editor'); ?></h3>

<p>
	<?php echo elgg_echo('kalturavideo:label:defaultkcw'); ?>:
	<?php
		$t = elgg_get_plugin_setting('kaltura_server_type', 'kaltura_video');
		if (empty($t)) {
			$t = 'corp';
		}
		$widgets = $KALTURA_GLOBAL_UICONF['kcw'][$t];

		$default = elgg_get_plugin_setting('defaultkcw', 'kaltura_video');
		$vals = array();
		foreach ($widgets as $k => $v) {
			$vals[$k] = $v['name'].' ('.elgg_echo("kalturavideo:generic").')';
		}

		$vals['custom'] = elgg_echo("kalturavideo:customkcw");

		reset($widgets);
		if (empty($default)) $default = key($widgets);

		echo elgg_view('input/dropdown', array(
			'name' => 'defaultkcw',
			'id' => 'defaultkcw',
			'options_values' => $vals,
			'value' => $default
		));
	?>
</p>

<div id="kaltura_video_layer_defaultkcw"<?php echo (elgg_get_plugin_setting('defaultkcw', 'kaltura_video') != 'custom' ? 'style="display:none;"' : ''); ?> rel="2">
<p>
	<?php echo elgg_echo('kalturavideo:uiconf2'); ?>:
	<?php
		echo elgg_view('input/url', array('name' => 'custom_kcw','id' => 'custom_kcw', 'value' => elgg_get_plugin_setting('custom_kcw', 'kaltura_video'), 'class' => 'input-short' ));
		echo '<a href="#" id="kaltura_video_getlist_custom_kcw">&larr;' . elgg_echo("kalturavideo:uiconf:getlist") . '</a>'
	?>
</p>
</div>

<p>
	<?php echo elgg_echo('kalturavideo:label:defaulteditor'); ?>:
	<?php
		$t = elgg_get_plugin_setting('kaltura_server_type', 'kaltura_video');
		if (empty($t)) $t = 'corp';
		$widgets = $KALTURA_GLOBAL_UICONF['kse'][$t];

		$default = elgg_get_plugin_setting('defaulteditor', 'kaltura_video');
		$vals = array();
		foreach($widgets as $k => $v) {
			$vals[$k] = $v['name'] . ' ('.elgg_echo("kalturavideo:generic") . ')';
		}

		$vals['custom'] = elgg_echo("kalturavideo:customeditor");

		reset($widgets);
		if (empty($default)) {
			$default = key($widgets);
		}

		echo elgg_view('input/dropdown', array(
			'name' => 'defaulteditor',
			'id' => 'defaulteditor',
			'options_values' => $vals,
			'value' => $default
		));
	?>
</p>

<div id="kaltura_video_layer_defaulteditor"<?php echo (elgg_get_plugin_setting('defaulteditor', 'kaltura_video') != 'custom' ? 'style="display:none;"' : ''); ?> rel="3">
<p>
	<?php echo elgg_echo('kalturavideo:uiconf3'); ?>:
	<?php
		echo elgg_view('input/url', array('name' => 'custom_kse','id' => 'custom_kse', 'value' => elgg_get_plugin_setting('custom_kse', 'kaltura_video'), 'class' => 'input-short' ));
		echo '<a href="#" id="kaltura_video_getlist_custom_kse">&larr;'.elgg_echo("kalturavideo:uiconf:getlist").'</a>';
	?>
</p>
</div>

<?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
