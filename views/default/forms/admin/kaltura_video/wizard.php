<h3 class="settings"><?php echo elgg_echo('kalturavideo:admin:wizardpart'); ?></h3>
<?php

	$configured = $vars['configured'];
	if($configured) {
		echo '<p><a href="?type=server">'. elgg_echo('kalturavideo:wizard:cannot'). '</a></p>';
		return;
	}
?>


<p><a href="?type=server"><?php echo elgg_echo('kalturavideo:clickifpartner'); ?></a></p>

<p>
	<h4><?php echo elgg_echo('kalturavideo:label:sitename'); ?>: </h4>
	<?php
		echo elgg_view('input/text', array('name' => 'elgg_name', 'value' => elgg_get_config('sitename') ));
	?>
</p>
<p>
	<h4><?php echo elgg_echo('kalturavideo:label:name'); ?>: </h4>
	<?php
		echo elgg_view('input/text', array('name' => 'name', 'value' => elgg_get_logged_in_user_entity()->username ));
	?>
</p>
<p>
	<h4><?php echo elgg_echo('kalturavideo:label:email'); ?>: </h4>
	<?php
		echo elgg_view('input/text', array('name' => 'email', 'value' => elgg_get_logged_in_user_entity()->email ));
	?>
</p>
<p>
	<h4><?php echo elgg_echo('kalturavideo:label:websiteurl'); ?>: </h4>
	<?php
		echo elgg_view('input/text', array('name' => 'web_site_url', 'value' => get_config('url') ));
	?>
</p>
<p>
	<h4><?php echo elgg_echo('kalturavideo:label:description'); ?>: </h4>
	<?php
		echo elgg_view('input/plaintext', array('name' => 'description', 'value' => elgg_echo('kalturavideo:wizard:description'),'class' => 'input-text" onfocus="(!jQuery(this).hasClass(\'touched\')) ? jQuery(this).val(\'\') : null; jQuery(this).addClass(\'touched\');' ));
	?>
</p>
<p>
	<?php echo elgg_echo('kalturavideo:label:phonenumber'); ?>: <br />
	<?php
		echo elgg_view('input/text', array('name' => 'phone_number', 'value' => elgg_echo('kalturavideo:wizard:phonenumber'),'class' => 'input-text" onfocus="(!jQuery(this).hasClass(\'touched\')) ? jQuery(this).val(\'\') : null; jQuery(this).addClass(\'touched\');' ));
	?>
</p>
<p>
	<?php echo elgg_echo('kalturavideo:label:contenttype'); ?>:
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'content_category',
			'options_values' => array(
				"unknown" => 'What is the topic of your Elgg installation?',
				"Arts & Literature" => 'Arts & Literature',
				"Automotive" => 'Automotive',
				"Business" => 'Business',
				"Comedy" => 'Comedy',
				"Education" => 'Education',
				"Entertainment" => 'Entertainment',
				"Film & Animation" => 'Film & Animation',
				"Gaming" => 'Gaming',
				"Howto & Style" => 'Howto & Style',
				"Lifestyle" => 'Lifestyle',
				"Men" => 'Men',
				"Music" => 'Music',
				"News & Politics" => 'News & Politics',
				"Nonprofits & Activism" => 'Nonprofits & Activism',
				"People & Blogs" => 'People & Blogs',
				"Pets & Animals" => 'Pets & Animals',
				"Science & Technology" => 'Science & Technology',
				"Sports" => 'Sports',
				"Travel & Events" => 'Travel & Events',
				"Women" =>'Women',
				"N/A" => 'N/A')
			)
		);
	?>
</p>
<p>
	<?php echo elgg_echo('kalturavideo:label:adultcontent'); ?>:
		<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'adult_content',
			'options_values' => array(
				'no' => elgg_echo('option:no'),
				'yes' => elgg_echo('option:yes')
			),
			'value' => 'no'
		));
	?>
</p>
<p>
	<h4>
		<?php
		
		$link = '<a href="http://corp.kaltura.com/terms-of-use" target="_blank">' . elgg_echo('kalturavideo:label:termsofuse') . '</a>';
		$option = elgg_echo('kalturavideo:label:iagree', array($link));
		
		echo elgg_view('input/checkboxes', array(
			'name' => 'agree_to_terms',
			'options' => array(
				$option => 'yes',
			)
		));
	?>
	</h4>
</p>

<?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
