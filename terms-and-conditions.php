<?php
    /*
     * Argyros - Página Términos y condiciones
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
	<title>Términos y condiciones::Argyros</title>

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
		.txaboutus{ display: none; }
		#bloque_clientes{
			padding: 250px 0px 0px 20px;
    		height: 320px;
			background: 
		    /* top, transparent red, faked with gradient */ 
		    linear-gradient(
		      rgba(255, 255, 255, 0.45), 
		      rgba(255, 255, 255, 0.8)
		    ),
		    /* bottom, image */
		    url('assets/images/IMG_0643.png');
		}

		#bloque_productos{
			padding: 250px 0px 0px 20px;
    		height: 320px;
			background: url('assets/images/IMG_2042.png');
		    background-position: 0 -295px;
		}

		.titaboutus{ font-size: 32px; }

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
								<span class="page-title">Términos y condiciones</span>
							</div>
						</div>
					</div>
				</div>                
				<section class="content">        
					<div class="container">
						<div class="row">
							<div id="page-header">
								<h1 id="page-title">Términos y condiciones</h1>
							</div>

							<div id="col-main" class="col-md-24 normal-page clearfix">
								<div class="page about-us ">
									
									<p>
										La oferta y venta de los productos en nuestro sitio web www.argyros.com.pa son realizados directamente por Argyros Inc. y están regídas por las siguientes Condiciones Generales de Venta.
									</p>

									<p>
										Argyros Inc. está inscrito en el Ministerio de Comercio e Industrias de Panamá bajo el Aviso de Operaciones número 1589570-1-664135-2009-189852 DV 41. Con domicilio en la Provincia de Colón, Distrito de Colón, Corregimiento de Cristobal, Urbanización Zona Libre de Colón, Manzana 17, Calle 15 final, edificio Silver Crown, Local 2.
									</p>
									
									<p>
										Argyros Inc. ofrece sus productos y desarrolla su actividad de comercio dirigido a distribuidores, mayoristas, cadena de tiendas, fábricas, artesanos, orfebres, emprendedores, comerciantes, minoristas y revendedores.
									</p>

									<p>
										Estas Condiciones Generales de Venta rigen exclusivamente la oferta, envío y recepción de pedidos de compra de productos entre los usuarios y Argyros Inc. 
									</p>

									<h2>Registro</h2>

									<p>
										Para tener acceso al catálogo en línea, el Cliente debe registrarse en nuestro sitio web rellenando los datos solicitados en el formulario con su información y validar el correo electrónico ingresado. Los precios serán visibles cuando la información sea verificada por el encargado. 
									</p>

									<p>
										Estos datos podrán ser utilizados para ponernos en contacto directo o enviarle boletines informativos. Después de registrarse, el Cliente posee una cuenta personal a la que puede acceder mediante su nombre de usuario y contraseña estrictamente confidencial. 
									</p>

									<p>
										Argyros tiene la libertad de eliminar, bloquear o cancelar cualquier usuario que permanezca inactivo durante un periodo de tiempo, no respete las condiciones y los términos vigentes en este sitio o se considere que tenga un comportamiento irregular.
									</p>

									<p>
										El Cliente será responsable de cualquier acción cometida por cualquier persona que use la cuenta personal en su lugar. El Cliente debe notificar puntualmente a Argyros Inc. todo posible robo o pérdida de la contraseña, así como cualquier uso indebido de su cuenta o contraseña por parte de terceros y de la cual tenga conocimiento.
									</p>

									<p>
										Adicional al registro en la página web, si el cliente decide concretar la compra, debe cumplir con las políticas de “Conoce a tú cliente” de Argyros Inc. Para ello se le enviará un archivo que debe llenar con datos personales o de la empresa y proporcionar los documentos solicitados en el mismo.
									</p>

									<h2>Experiencia de compra</h2>

									<p>
										La página web de Argyros Inc. es una herramienta en línea que le permite al usuario hacerse una idea de los productos y precios que ofrecemos. Cuando el pedido es realizado por el Cliente a través de nuestra pagina web, un ejecutivo de ventas debe confirmar el inventario de los productos solicitados. 
									</p>
									<p>
										Los productos ofrecidos en línea se basan en una constante recopilación y actualización de datos, donde se agregan productos nuevos y ocultan los agotados. Es por ello que podemos tener en nuestra sala de ventas productos que no se estén ofreciendo, o por el contrario, productos agotados que todavía aparezcan disponibles en nuestra web. Si quiere ampliar la información ofrecida en nuestra página web, le recomendamos ponerse en contacto con nuestros ejecutivos de ventas.
									</p>
									<p>
										Las características esenciales de cada Item se presentan en cada ficha de producto en nuestro sitio web. Las imágenes y los colores de los productos en venta podrían no corresponder a los reales debido al efecto del navegador de internet y de la pantalla que se utilizan. Los precios de los productos podrían sufrir actualizaciones debidas a variaciones en el precio de la plata. Una vez realizada la compra, el precio final confirmado por Argyros Inc. no cambiará. Los precios de venta de los productos presentes e indicados en el área reservada del sitio web www.argyros.com.pa no incluyen los gastos de entrega, los cuales quedan totalmente a cargo del Cliente, como todos los eventuales gastos adicionales correspondientes a impuestos o tasas previstas por la normativa vigente en el paìs de destino.
									</p>
									<p>
										Enviando el pedido a Argyros Inc. el Cliente reconoce y declara que ha leído todas las instrucciones recibidas durante el proceso de compra y acepta las Condiciones Generales en su integridad.
									</p>

									<h2>Facturación</h2>

									<p>
										Una vez concluida la selección y confirmación de los productos por parte del Cliente y el ejecutivo de ventas, se procede a facturar. En la página web se presenta un estimado del valor total de la orden basado en las fichas tecnicas de cada Item, pero pueden haber variaciones.
									</p>
									<p>
										Las diferencias que se podrían presentar entre el proceso de facturación y la página web pueden deberse a algún error tipográfico al ingresar los datos de cada Item, los redondeos o promedios en los pesos.
									</p>
									<p>
										El encargado de facturación confirmará los valores con los procedimientos de control establecidos y dará el valor final. 
									</p>
									<p>
										El Cliente podrá sacar del pedido cualquier Item que haya presentado alguna diferencia entre lo indicado en la página web y lo facturado.
									</p>

									<h2>Gastos de envío</h2>
									<p>
										Todos los gastos de envío dependeran de la empresa de transporte escogida por el Cliente. Trabajamos con DHL, Fedex, COPA, UPS, Schenker o cualquier empresa de transporte internacional o local que le genere confianza prestando este servicio.
									</p>
									<p>
										Con el valor de la factura, las indicaciones precisas donde debe ser entregada la encomienda, las dimensiones y pesos de los productos embalados, se realiza un cotización de los gastos de envío en la empresa de transporte seleccionada.
									</p> 
 									<p>
 										El Cliente debe indicar si desea utilizar el seguro de la empresa de transporte o si ya cuenta con alguna empresa aseguradora.
 									</p>
 									<p>
 										Si requiere de alguna asesoría en esta área, nuestros ejecutivos le asistirán basados en nuestra experiencia para indicarle el medio de transporte más utilizado para su país.
 									</p>
 									<p>
 										Es de responsabilidad exclusiva de la empresa de transporte, cualquier retraso o imprevisto que pueda presentar la encomineda. 
 									</p>

 									<h2>Forma de pago</h2>

									<p>
										El Cliente podrá efectuar el pago del precio de los productos y de los relativos gastos de entrega por medio de tarjeta de crédito, transferencia o efectivo. Para cada uno de las formas de pago, se darán las indicaciones de manera individual de los procedimientos a seguir. Tenga presente que pueden aplicar cargos bancarios.
									</p>
									
									<h2>Instrucciones de despacho y facturación</h2>

									<p>
										Argyros Inc. cuenta con procediminetos estandarizados en cada etapa de su compra. Es por ello, que si el cliente requiere de algún trabajo adicional, debe notificarlo.
									</p>

									<p>
										Nuestro sistema de facturación está configurado para trabajar en su mayoría con la unidad de medida en gramos, sí el Cliente requiere que se detalle también la cantidad de piezas, entonces debe notificarlo con anticipación.
									</p>

									<p>
										Nuestros productos vienen en diferentes formatos, la mayoría en bolsas individuales, si el cliente desea que a los productos se le quiten las bolsas debe indicarlo. No cambiamos las bolsas, sólo podemos quitar bolsas según las instrucciones.
									</p>

									<p>
										Argyros Inc. no se hace responsable por los daños de transporte vinculados a indicaciones específicas por parte del cliente acerca de la forma de empaque.
									</p>

									<p>
										Los pedidos se despachan al día siguiente de que el dinero esté disponible en las cuentas de Argyros Inc. De lunes a viernes, excepto festivos y fiestas nacionales, en el horario indicado por la empresa de transporte.
									</p>
									
									<h2>Recepción</h2>

									<p>Al recibir la mercancía, el cliente debe notificar cualquier error u omisión.</p>
									
									<p>
										Cualquier daño en el embalaje y/o al producto, o la falta de coincidencia en el número de paquetes o en las indicaciones deberá ser inmediatamente notificado mediante una anotación sobre la prueba de entrega del transportista o rechazando la entrega de los productos.
									</p>
									<p>
										Si el paquete se encuentra en las mismas condiciones de cómo salió de Argyros Inc. (revisar las fotos enviadas en el proceso de embalaje) entonces, los productos o diferencia que exista, debe ser reportado en un lapso de 48 horas a su ejecutivo de ventas o al servicio de atención al cliente.
									</p>
									
									<h2>Servicio de atención al Cliente </h2>

									<p>
										El Cliente podrá solicitar cualquier información a Argyros Inc. mediante nuestro servicio de atención enviando un mensaje de corréo electrónico a la direcciòn: soporte@argyros.com.pa o llamando al número +507 4473175.
									</p>
									
									<h2>Garantías</h2>

									<p>
										Argyros Inc. no vende productos usados, irregulares o de calidad inferior a los estándares correspondientes ofrecidos en el mercado. Las garantías aplican únicamente a los artículos de plata. Todos los demás artículos como exhibidores de joyas, balanzas, artículos de limpieza, herramientas, medidores de anillos, implementos para joyería, entre otros, no tienen garantía.
									</p>
									<p>
										Se recibirán unicamente las prendas de plata que presenten desperfectos de fabrica siempre y cuando el cliente lo notifique a Argyros Inc. mediante correo electrónico a soporte@argyros.com.pa o por WhatsApp al número empresarial de la ejecutiva de venta que le haya atendido dentro de las primeras 48 horas de recibir la mercancía. La notificación debe incluir fotos detalladas de los productos con sus pesos y de cómo estaba embalado el producto (de la pieza y la caja).
									</p>

									<p>
										No se aceptarán reclamos por aquellas prendas que se hayan dañado por el uso y/o desgaste de las mismas, incluyendo la oxidación natural de la plata y/o la pérdida de cualquier baño o esmalte.
									</p>
									
									<h2>Derecho de rescisión</h2>

									<p>
										El derecho de rescisión aplica únicamente a productos que hayan sido despachados por error o con desperfecto de fábrica, y deben ser reportados a las 48 horas de recibida la encomienda. El derecho de rescisión se aplica solamente a los bienes que estén integros en el momento de la devolución y no se puede ejercer si los productos se utilizaron o fueron dañados. 
									</p>
									<p>
										De cumplir con estos criterios, para activar el procedimiento de devolución, el Cliente debe contactarse previamente con nuestra empresa que le dará todas las instrucciones sobre cómo y dónde enviar la mercancía. Se recibirán las prendas de plata que sean entregadas en Argyros Inc. bien sea personalmente o despachadas a cargo del cliente. Se procederá a cambiarlas con prendas idénticas o se le hará un crédito por el valor de las prendas según factura correspondiente, que debe ser utilizado en un lapso menor a 90 días.
									</p>
									
									<p>
										En caso de que el Cliente quiera ejercer su derecho de rescisión según los metodos y plazos dispuestos, se procederá a comprobar que se respetaron los términos y condiciones antes dichos. Argyros Inc. tendrá la facultad de no aceptar la devolución de los productos que no incluyan el estuche original o que hayan sufrido alteraciones de sus características esenciales y de calidad.
									</p>

									<h2>Plazos y método de resolución</h2>

									<p>
										Después de devolver los productos, Argyros Inc. realizará las verificaciones oportunas relativas a la conformidad de los mismos con las condiciones y términos indicados. Se dará una respuesta en un período inferior a los 30 (treinta) días de haber recibido el reclamo o el producto. El resultado de las verificaciones se enviarán al Cliente por correo electrónico, con la confirmación final de la aceptación o rechazo del reclamo de los productos devueltos. 
									</p>
									<p>
										Una vez comprobado que se respetaron los términos y las condiciones antes mencionados, Argyros Inc. comenzará el procedimiento de generar una nota de crédito (que tendrá que usar en un lapso menor a 90 días). En caso de que no se respeten los métodos y condiciones para el ejercicio del derecho de rescisión, el Cliente no tendrá ningún derecho al reembolso, sin embargo, el Cliente podrá reobtener a su cargo los productos en el estado en que se devolvieron a Argyros Inc.
									</p>
									
									<h2>Fuerza mayor</h2>

									<p>
										En caso de fuerza mayor, la parte incumplidora informarà de inmediato a la otra parte. En caso de que el evento de fuerza mayor se prolongue durante un perìodo superior a un mes, cada una de las partes tendrà el derecho de rescindir el Contrato.
									</p>
									
									<h2>Errores e imprecisiones </h2>

									<p>
										Argyros Inc. tiene por objetivo ofrecer una información costantemente actualizada en su sitio web. Sin embargo, no es posible asegurar que la web esté completamente libre de errores. El sitio podría contener errores tipográficos, inexactitudes u omisiones, algunas de las cuales podrían referirse a los precios, a la disponibilidad de los productos y a la ficha técnica informativa del artículo. Argyros Inc. se reserva el derecho de corregir cualquier error, inexactitud u omisión incluso después de que el pedido haya sido enviado y también se reserva el derecho de modificar o actualizar la información en cualquier momento sin previo aviso. 
									</p>
									
									<h2>Modificaciones de las Condiciones Generales</h2>

									<p>
										Argyros Inc. se reserva el derecho de cambiar estos términos y condiciones de venta en cualquier momento. Todos los eventuales cambios, modificaciones, cancelaciones o adiciones entrarán en vigor inmediatamente después de la notificación de las mismas. Una vez enviado el comunicado, cualquier acceso y uso de los servicios ofrecidos por Argyros Inc. por parte del Cliente se interpretará como una aceptación completa de los cambios efectuados.
									</p>

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