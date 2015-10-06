<?php

/**
 * Do not edit this file. Edit the config files found in the config/ dir instead.
 * This file is required in the root directory so WordPress can find it.
 * WP is hardcoded to look in its own directory or one directory up for wp-config.php.
 */
require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(dirname(__DIR__) . '/config/application.php');
require_once(ABSPATH . 'wp-settings.php');

use Gwa\Wordpress\MultisiteResolverManager;
use Gwa\Wordpress\MultisiteDirectoryResolver;
use Gwa\Wordpress\DisableAutoUpdate\DisableAutoUpdateHandler;

if ((bool) getenv('WP_MULTISITE') && defined('WP_INSTALL_PATH') && class_exists('Gwa\Wordpress\MultisiteResolverManager')) {
    if (getenv('WP_MULTISITE_SUBDOMAIN_INSTALL') === 'true') {
        $type = MultisiteResolverManager::TYPE_SUBDOMAIN;
    } else {
        $type = MultisiteResolverManager::TYPE_FOLDER;
    }

    (new MultisiteResolverManager(WP_INSTALL_PATH, $type))->init();
}

if ((bool) getenv('GA_DISABLE_WP_AUTO_UPDATE')) {
    (new DisableAutoUpdateHandler())->init();
}
