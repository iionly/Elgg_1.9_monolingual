<?php
/**
 * Provide a way of setting your language prefs
 *
 * @package Elgg
 * @subpackage Core
 *
 * Removing language selection in user settings for non-admins by overwriting core view
 *
 * (c) iionly 2012
 *
 */

$user = elgg_get_page_owner_entity();

if (!($user instanceof ElggUser)) {
	return;
}

$options = get_installed_translations(true);

if (!($user->isAdmin()) || (count($options) < 2)) {
	echo elgg_view_field([
		'#type' => 'hidden',
		'name' => 'language',
		'value' => $user->language,
	]);

	return;
}

$content = elgg_view_field([
	'#type' => 'select',
	'name' => 'language',
	'value' => $user->language,
	'options_values' => $options,
	'#label' => elgg_echo('user:language:label'),
]);

echo elgg_view_module('info', elgg_echo('user:set:language'), $content);