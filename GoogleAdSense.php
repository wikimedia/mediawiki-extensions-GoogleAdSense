<?php
/**
 * MediaWiki extension to add Google AdSense in a portlet in the sidebar.
 * Installation instructions can be found on
 * http://www.mediawiki.org/wiki/Extension:Google_AdSense_2
 *
 * This extension will not add the Google Adsense portlet to *any* skin
 * that is used with MediaWiki. Because of inconsistencies in the skin
 * implementation, it will not be add to the following skins:
 * cologneblue, standard, nostalgia
 *
 * @file
 * @ingroup Extensions
 * @author Siebrand Mazeland
 * @license MIT
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die( 1 );
}

/**
 * The following settings must be made in your LocalSettings.php.
 */
$wgGoogleAdSenseClient = 'none'; // Client ID for your AdSense script (example: pub-1234546403419693)
$wgGoogleAdSenseSlot   = 'none'; // Slot ID for your AdSense script (example: 1234580893)
$wgGoogleAdSenseID     = 'none'; // ID for your AdSense script (example: translatewiki)

/**
 * SETTINGS
 * - The description of the portlet can be changed in [[MediaWiki:Googleadsense]].
 * - The following settings can be overridden in your LocalSettings.php.
 *   Compare them to the script output in the Google AdSense interface.
 */
$wgGoogleAdSenseWidth  = 120; // Width of the AdSense box, specified in your AdSense account
$wgGoogleAdSenseHeight = 240; // Width of the AdSense box, specified in your AdSense account
$wgGoogleAdSenseSrc    = "//pagead2.googlesyndication.com/pagead/show_ads.js"; // Protocol relative source URL of the AdSense script
$wgGoogleAdSenseAnonOnly = false; // Show the AdSense box only for anonymous users

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'Google AdSense',
	'namemsg'       => 'googleadsense-name',
	'version'        => '2.2.0',
	'author'         => 'Siebrand Mazeland',
	'descriptionmsg' => 'googleadsense-desc',
	'url'            => 'https://www.mediawiki.org/wiki/Extension:Google_AdSense',
	'license-name'   => 'MIT',
);

// Register class and localisations
$wgAutoloadClasses['GoogleAdSense'] = __DIR__ . '/GoogleAdSense.class.php';
$wgMessagesDirs['GoogleAdSense'] = __DIR__ . '/i18n';

// Hook to modify the sidebar
$wgHooks['SkinBuildSidebar'][] = 'GoogleAdSense::GoogleAdSenseInSidebar';

// Client-side resource modules
$wgResourceModules['ext.googleadsense'] = array(
	'styles' => 'resources/ext.googleadsense.css',
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'GoogleAdSense'
);
