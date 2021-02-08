<?php
/**
 * Class file for the GoogleAdSense extension
 *
 * @file
 * @ingroup Extensions
 * @author Siebrand Mazeland
 * @license MIT
 */

class GoogleAdSense {
	/**
	 * @param Skin $skin
	 * @param array &$bar
	 */
	public static function onSkinBuildSidebar( $skin, &$bar ) {
		$config = $skin->getConfig();
		$adWidth = $config->get( 'GoogleAdSenseWidth' );
		$id = $config->get( 'GoogleAdSenseID' );
		$adHeight = $config->get( 'GoogleAdSenseHeight' );
		$adClient = $config->get( 'GoogleAdSenseClient' );
		$language = $config->get( 'GoogleAdSenseLang' );
		$encoding = $config->get( 'GoogleAdSenseEncoding' );
		$adSlot = $config->get( 'GoogleAdSenseSlot' );
		$src = $config->get( 'GoogleAdSenseSrc' );
		$anonOnly = $config->get( 'GoogleAdSenseAnonOnly' );

		// Return $bar unchanged if not all values have been set.
		// @todo Signal incorrect configuration nicely?
		if ( $adClient == 'none' || $adSlot == 'none' || $id == 'none' ) {
			return;
		}

		if ( !$skin->getUser()->isRegistered() && $anonOnly ) {
			return;
		}

		if ( !$src ) {
			return;
		}

		// Add CSS
		$skin->getOutput()->addModules( 'ext.googleadsense' );

		$bar['googleadsense-portletlabel'] = "<script type=\"text/javascript\"><!--
google_ad_client = \"$adClient\";
/* $id */
google_ad_slot = \"$adSlot\";
google_ad_width = " . intval( $adWidth ) . ";
google_ad_height = " . intval( $adHeight ) . ";
google_language = \"$language\";
google_encoding = \"$encoding\";
// -->
</script>
<script type=\"text/javascript\"
src=\"$src\">
</script>";
	}
}
