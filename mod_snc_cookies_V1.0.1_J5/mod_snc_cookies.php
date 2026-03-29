<?php
/**
 * @package     Joomla.Module
 * @subpackage  mod_snc_cookies
 * @copyright   Copyright (C) 2026 Steven Naschold
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

// ------------------------------------------------------------
// SPRACHDATEI LADEN (WICHTIG!)
// ------------------------------------------------------------
$language = Factory::getLanguage();
$language->load('mod_snc_cookies', JPATH_SITE);

// ------------------------------------------------------------
// CSS EINBINDEN
// ------------------------------------------------------------
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle(
    'mod_snc_cookies',
    'modules/mod_snc_cookies/assets/css/style.css'
);

// ------------------------------------------------------------
// Helper laden
// ------------------------------------------------------------
require_once __DIR__ . '/helper.php';

// ------------------------------------------------------------
// Accept-Handler ausführen (setzt Cookie & redirect)
// Wenn Redirect → Modul abbrechen
// ------------------------------------------------------------
if (ModSncCookiesHelper::handleAccept()) {
    return;
}

// ------------------------------------------------------------
// Cookie-Status abfragen (1 = akzeptiert, 0 = nicht akzeptiert)
// ------------------------------------------------------------
$cookieAccepted = ModSncCookiesHelper::isAccepted();

// ------------------------------------------------------------
// Einstellungen + Consent laden
// ------------------------------------------------------------
list($settings, $eu_cookie_consent) = ModSncCookiesHelper::getSettings($params);

// ------------------------------------------------------------
// Template laden
// ------------------------------------------------------------
require ModuleHelper::getLayoutPath('mod_snc_cookies', $params->get('layout', 'default'));
