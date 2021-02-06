<?php
    /*
     * Argyros - header
     * 
     */
    $lh_cat_ppal = obtenerListaCategorias( $dbh );
    /* ----------------------------------------------------------------------------------- */
	function reempEspacio( $texto ){
		return str_replace( " ", "&nbsp;", $texto );
	}
	/* ----------------------------------------------------------------------------------- */
?>
<style>
	.subcategs_navcatalog{ display: none; }
	.tooltip_templates { display: none; }
	.tooltip{ opacity: 1 !important; }

	.hnc_selcp{ font-size: 14px !important; }
	#blackout-dropdown{
	    display: none;
	    position: fixed;
	    height: 100vh;
	    width: 100vw;
	    z-index:2;
	    background: rgba(0, 0, 0, 0.5);
	}
	.hnc_selcp:hover{ border-bottom: 1px solid #a7b239; }
	

	.cont-lnk-hnc-regresar{
		padding: 12px 0 20px 0;
	}
	.lnk-hnc-regresar:hover{ cursor: pointer; }

	/*@media (max-width: 1024px){ 
		#navegacion-catalogo-dsk{ visibility: hidden; }
		#navegacion-catalogo-mob{ visibility:visible; }
	}
	@media (min-width: 1025px){ 
		#navegacion-catalogo-dsk{ visibility: visible; }
		#navegacion-catalogo-dsk{ visibility: visible; }
	}*/
</style>
<header id="top" class="clearfix">
	
	<!-- Navigation -->
	<?php include("navigation.php"); ?>
	<!-- /.Navigation -->
	
	<div class="line"></div>

	<!-- Top -->
	<?php include("main-top.php"); ?>
	<!--/.Top -->
	
	<!-- Facebook Conversion Code for Themes -->
	<script>
	/*(function() {
	  var _fbq = window._fbq || (window._fbq = []);
	  if (!_fbq.loaded) {
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = '../../connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		_fbq.loaded = true;
	  }
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6016096938024', {'value':'0.00','currency':'USD'}]);*/
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6016096938024&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
</header>
<div id="blackout-dropdown"></div>