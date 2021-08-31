<?php 

//Translation for YITH wishlist / any Plugin
add_filter('gettext', 'yithTranslation', 20, 3);
if(!function_exists('yithTranslation')){
	function yithTranslation($translated, $untranslated, $domain){
		switch ( $translated ){
			case 'Nom du produit': //untranslated
				$translated = __( 'Product test', 'yith-woocommerce-wishlist' ); //translated
				break;
			case 'Unit price' :
				$translated = __( 'Prix unitaire', 'yith-woocommerce-wishlist' );
				break;
			case 'Stock status' :
				$translated = __( 'Statut', 'yith-woocommerce-wishlist' );
				break;
			case 'Free!' :
				$translated = __( 'Gratuit', 'yith-woocommerce-wishlist' );
				break;
			case 'Out of stock' :
				$translated = __( 'Indisponible', 'yith-woocommerce-wishlist' );
				break;
			case 'In stock' :
				$translated = __( 'En stock', 'yith-woocommerce-wishlist' );
				break;
			case 'Remove this product' :
				$translated = __( 'Enlever ce produit', 'yith-woocommerce-wishlist' );
				break;
		}
		return $translated;
	}
}