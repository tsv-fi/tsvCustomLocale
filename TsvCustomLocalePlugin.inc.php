<?php

/**
 * @file TsvCustomLocalePlugin.inc.php
 *
 * Copyright (c) 2013-2024 Simon Fraser University
 * Copyright (c) 2003-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @package plugins.generic.tsvCustomLocale
 * @class TsvCustomLocalePlugin
 *
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class TsvCustomLocalePlugin extends GenericPlugin {

	/**
	 * @copydoc PKPPlugin::getDisplayName()
	 */
	function getDisplayName() {
		return "TSV Custom Locale Plugin";
	}

	/**
	 * @copydoc PKPPlugin::getDescription()
	 */
	function getDescription() {
		return "TSV Custom Locale Plugin";
	}

	/**
	 * @copydoc Plugin::register
	 */
	function register($category, $path, $mainContextId = null) {

		if (!parent::register($category, $path, $mainContextId)) return false;

		if ($this->getEnabled()) {

			$locale = AppLocale::getLocale();
			$request = Application::get()->getRequest();
			$context = $request->getContext();

			$customLocalePath = $this->getPluginPath() ."/customLocale/" . $context->getId() . "/" . $locale . "/customLocale.po";

			if (file_exists($customLocalePath)) {
				AppLocale::registerLocaleFile($locale, $customLocalePath, false);
			}
		}
		return true;
	}

}
