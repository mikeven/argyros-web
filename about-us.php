<?php
    /*
     * Argyros - Página Nosotros
     * 
     */
    include( "database/init.php" );
    include( "database/bd.php" );
	include( "database/data-user.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php" );
    include( "fn/fn-catalog.php" );
    include( "fn/fn-cart.php" );
    
    //checkSession( '' );
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:52 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	<link rel="canonical" href="http://demo.designshopify.com/" />
	<meta name="description" content="" />
	<title>Nosotros::Argyros</title>

	<link href="assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">

	<script src="assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.mobile.customized.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/cookies.js" type="text/javascript"></script>
	<script src="assets/javascripts/modernizr.js" type="text/javascript"></script>  
	<script src="assets/javascripts/application.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.owl.carousel.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.bxslider.js" type="text/javascript"></script>
	<script src="assets/javascripts/skrollr.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.fancybox-buttons.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.zoom.js" type="text/javascript"></script>	
	<script src="assets/javascripts/cs.script.js" type="text/javascript"></script>

	<script src="assets/javascripts/cs.script.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-aboutus.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<style>
		#videoargyros{
			background: #e7e7e7;
			padding:15px 5px;
		}


		.about-us div {
		    margin-bottom: 0px;
		}
		p{ margin: 0; font-size: 16px; }
		
		#nuestros-clientes, #nuestros-productos{ padding-top: 60px; }

		.img_parag{
			height: auto;
			margin: 30px 0;
		}

		.col_pgh{ padding: 0 4%; }
		.wspacer{ height: 100px; }
		.wspacer-2{ height: 150px; }

		.txt_pgh{ text-align: justify; padding:35px; background-color: rgba(255,255,255,0.6); }
		.txt_pgh_w{ padding:35px; background-color: rgba(255,255,255,0.85); }

		#pgh1{
			background: url('assets/images/IMG_1037.jpg');
			background-size: cover;
		}

		#pgh2{
			background: url('assets/images/IMG_1416.jpg');
			background-size: cover;
		}

		#pgh3{
			
			background: url('assets/images/IMG_1434.jpg');
			background-size: cover;
		}

		#pgh4{
			background: url('assets/images/IMG_0643.png');
			background-size: cover;
			background-position-y: 45%;
		}

		#pgh-1{
			background: url('assets/images/IMG_2042.png');
			background-size: cover;
		}

		#pgh0{
			background: url('assets/images/IMG_PRO.jpg');
			background-size: cover;
		}

	</style>
	
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templatePage notouch">
  
	<!-- Header -->
	<?php include( "sections/header.php" ); ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">       
			<!-- Content -->
			<div id="content" class="clearfix">                
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="index.php" class="homepage-link" title="Back to the frontpage">Inicio</a>
								<span>/</span>
								<span class="page-title">Nosotros</span>
							</div>
						</div>
					</div>
				</div>                
				<section class="content">        
					<div class="container">
						<div class="row">
							<div id="page-header">
								<h1 id="page-title">Nosotros</h1>
							</div>
							<div id="col-main" class="col-md-24 normal-page clearfix">
								<div class="page about-us">

									<div class="row img_parag" id="pgh-1">
										<div id="col_pgh-1" class="col-md-12 col-xs-24 col_pgh">
											<div class="wspacer"></div>
											<p class="txt_pgh">
												Argyros Inc abrió al público, en Zona Libre de Colón en Panamá, en enero de 2010 gracias a la visión de un grupo Italo-Venezolano con más de 35 años de experiencia en la industria del comercio y la fabricación de accesorios de plata 925, quienes buscaron innovar las expectativas de este mercado en el continente americano, con un servicio novedoso y un equipo de personas amigables dispuestas a mejorar las actividades de los clientes.
											</p>
											<div class="wspacer"></div>
										</div>
									</div>
									
									<div class="row img_parag" id="pgh0">
										<div id="col_pgh0" class="col-md-12 col-md-offset-12 col-xs-24 col_pgh">
											
											<div class="wspacer"></div>
											<div class="txt_pgh">
												<p>
													Desde nuestra apertura hemos sido diferentes e innovadores y nos hemos caracterizado por trabajar alegremente. Con nuestra filosofía de trabajo hemos roto paradigmas dentro del mercado de la joyería, inyectando nueva energía y modernidad a todos nuestros procesos.
												</p>
												<br>
												<p>	
													En nuestro ADN no está adaptarnos a los cambios, sino hacerlos. Queremos ser siempre pioneros en nuestro ramo, es por tal razón que contamos con el sistema de ventas más cómodo y moderno de la región, tanto de forma presencial como de manera remota.
												</p>
											</div>
											<div class="wspacer"></div>

										</div>
									</div>

									<div id="nuestros-clientes">

										<h4 class="titaboutus">Nuestros clientes</h4>

										<div class="row img_parag" id="pgh1">
											<div id="col_pgh1" class="col-md-12 col-xs-24 col_pgh">
												<div class="wspacer"></div>
												<div class="txt_pgh">
													<p>
														Nuestros clientes son nuestros verdaderos protagonistas, los que nos dictan el guion a seguir, las tendencias de sus mercados, sus necesidades, los que nos exigen a seguir mejorando cada día, en fin, han sido la base de nuestro éxito durante todos estos años.
													</p>
													<br>
													<p>
														Estamos dirigidos y estructurados para atender de forma eficiente a distribuidores, mayoristas, cadena de tiendas, fábricas, artesanos, orfebres, emprendedores, comerciantes, minoristas y revendedores, ya que distribuimos una amplia variedad de productos en plata 925, tanto de prendas terminadas como accesorios semi elaborados.
													</p>
												</div>
												<div class="wspacer"></div>
											</div>
										</div>

										<div class="row img_parag" id="pgh2">
											<div id="col_pgh2" class="col-md-12 col-md-offset-12 col-xs-24 col_pgh">
												
												<div class="wspacer"></div>
												<div class="txt_pgh">
													<p>
														Nuestro sistema de venta es bien dinámico, se amolda a las actividades de nuestros clientes y de sus requerimientos. Es por tal razón que al comenzar la relación comercial, siempre procuramos una conversación directa para entender la forma de negocio que poseen y lo que buscan, así podemos ofrecer las herramientas y productos que mejor se adapten a sus necesidades.
													</p>
													<br>
													<p>	
														Nuestro gran objetivo es superar las expectativas de nuestros clientes. Buscamos ser sus aliados comerciales, quienes puedan facilitarles y hacerles más eficientes su estilo de negocio.
													</p>
												</div>
												<div class="wspacer"></div>

											</div>
										</div>

									</div>
									
									<div id="nuestros-productos">
									
										<h4 class="titaboutus">Nuestros productos</h4>
											
										<div class="row img_parag" id="pgh3">
											<div id="col_pgh3" class="col-md-12 col-xs-24 col_pgh ">
												<div class="wspacer"></div>
												<div class="txt_pgh">
													<p>
														En Argyros a las prendas de plata le brindamos la importancia que se merece, la consentimos y la hacemos sentir a gusto en el mercado de la joyería. No es casualidad que deseemos darle esta importancia, ya que nuestros productos están fabricados con diseños novedosos bajo estrictos estándares de calidad.
													</p>
													<br>
													<p>
														Ofrecemos más de 50.000 modelos diferentes de accesorios en plata 925, y además recibimos diseños nuevos todas las semanas. Dentro de nuestra amplia variedad encontrarás productos fabricados en Italia, China, Tailandia, Turquía, Colombia, Venezuela, México, Perú, entre otros.
													</p>
												</div>
												<div class="wspacer"></div>
											</div>
										</div>
											
										<div class="row img_parag" id="pgh4">
											<div id="col_pgh4" class="col-md-12 col-xs-24 col-md-offset-6 col_pgh">
												<div style="height: 160px"></div>
												<div class="txt_pgh_w">
													<p style="text-align: center;">
														Desde nuestra apertura, nos hemos logrado posicionar como una de las empresas más importantes del sector de distribución de platería 925 en toda la región.
													</p>
													<br>
													<p style="text-align: center;">¡Vive la experiencia Argyros, te esperamos!</p>
												</div>
												<div class="wspacer"></div>
												
											</div>
										</div>	
									
									</div>
									<br><br>
									<div id="videoargyros_" align="center">
										<iframe width="100%" height="560" src="https://www.youtube.com/embed/TForV-OMPGU?rel=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>

								</div>
							</div>
						</div>
					</div>
				</section> 
				<section class="content hidden">        
					<div class="container">
						<div class="row">
							<div id="col-main" class="col-md-24 normal-page clearfix">
								<div class="page about-us">
									<img src="assets/images/IMG_0643.png" width="100%">
								</div>
							</div>
						</div>
					</div>
				</section>       
			</div>
		</div>
	</div>
	
    <?php include("sections/footer.php"); ?>

</body>