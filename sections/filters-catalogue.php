<div id="catalog-filters" class="fltout megamenu-container_ banner-bottom mega-col-6" style="">
	<ul class="sub-mega-menu">
		<div class="sb-wrapper">
			<div class="filter-tag-group">

				<!-- tags groupd 3 -->
				<div class="col-md-6 col-sm-6 col-xs-24 fadeInUp animated">
					<div class="tag-group" id="coll-filter-3">
						<ul>
							<li><a title="Precio por pieza" href="#!" class="flt_selector" data-flt-cnt="flt_precio_prod"> Precio por pieza</a></li>
							<li><a title="Precio por gramo" href="#!" class="flt_selector" data-flt-cnt="flt_precio_gramo"> Precio por gramo</a></li>
							<li><a title="Precio producto" href="#!" class="flt_selector" data-flt-cnt="flt_peso"> Peso producto</a></li>
							<?php if( !isset( $_GET[P_TEXTO_BUSQUEDA] ) ) { ?>
								<li><a title="Talla" href="#!" class="flt_selector" data-flt-cnt="flt_talla">Talla</a></li>
							<?php } else { ?>
								<!--<li>
									<a title="Categoria" href="#!" class="flt_selector" 
									data-flt-cnt="flt_categoria">Categoría</a>
								</li>-->
							<?php } ?>
							<li><a title="Baño" href="#!" class="flt_selector" data-flt-cnt="flt_bano">Baño</a></li>
							<li><a title="Trabajo" href="#!" class="flt_selector" data-flt-cnt="flt_trabajo">Trabajo</a></li>
							<li><a title="Línea" href="#!" class="flt_selector" data-flt-cnt="flt_linea"> Línea</a></li>
							<li><a title="Color" href="#!" class="flt_selector" data-flt-cnt="flt_color"> Color</a></li>
							<input type="hidden" id="urlcatalogoactual" value="<?php echo $catalogue_url; ?>">
						</ul>						
					</div>
				</div>

				<div class="col-md-8 col-sm-8 col-xs-24 fadeInUp animated">

					<div id="flt_precio_prod" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Precio por pieza  </p>
							De (ej. 12.75; 25 )
							<input type="text" id="flt_pre_pro_min" class="form-control input_flt" placeholder="$"
							name="f_pprod_min" value="" style="width:50%" onkeypress="return isNumberKey(event)">
							Hasta
							<input type="text" id="flt_pre_pro_max" class="form-control input_flt" placeholder="$" 
							name="f_pprod_max" value="" style="width:50%" onkeypress="return isNumberKey(event)">
							<button id="btn_flt_precio_pieza" class="btn btn-2" type="button">Aceptar</button>
						</div>
					</div>

					<div id="flt_precio_gramo" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Precio por gramo </p>
							De (ej. 0.75; 3 )
							<input type="text" id="flt_pre_pes_min" class="form-control input_flt" placeholder="$"
							name="f_ppeso_min" value="" style="width:50%" onkeypress="return isNumberKey(event)">

							Hasta
							<input type="text" id="flt_pre_pes_max" class="form-control input_flt" placeholder="$"
							name="f_ppeso_max" value="" style="width:50%" onkeypress="return isNumberKey(event)">
							<button id="btn_flt_precio_peso" class="btn btn-2" type="button">Aceptar</button>
						</div>
					</div>

					<div id="flt_peso" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Peso de producto (g) </p>
							De (Gramos: ej.: 0.5; 2 )
							<input type="text" id="flt_peso_min" class="form-control input_flt" placeholder="gr"
							name="f_peso_prod_min" value="" style="width:50%" onkeypress="return isNumberKey(event)">

							Hasta
							<input type="text" id="flt_peso_max" class="form-control input_flt" placeholder="gr"
							name="f_peso_prod_max" value="" style="width:50%" onkeypress="return isNumberKey(event)">
							<button id="btn_flt_peso" class="btn btn-2" type="button">Aceptar</button>
						</div>
					</div>

					<?php if( !isset( $_GET[P_TEXTO_BUSQUEDA] ) ) { 
					// Mostrar opción a filtrar por tallas si no hay búsqueda por texto ?>
					
					<div id="flt_talla" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Talla </p>
							<ul>
							<?php 
								//$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_TALLA, 'N/A' ) ;
							?>
								<li style="display: none;"><a title="Talla ajustable" href="<?php echo $url_f; ?>">
									<span class="fe-checkbox"></span>Ajustable/Única</a>
								</li>
								<?php foreach ( $d_filtros["tallas"] as $t ) { 
									$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_TALLA, trim( $t["talla"] ) );
									$n_talla = $t["talla"];  if ( $t["talla"] == "ajust" )  $n_talla  = "Ajustable";
                                          					if ( $t["talla"] == "unica" )  $n_talla  = "Única";
								?>
									<li><a title="Talla <?php echo $n_talla; ?>" href="<?php echo $url_f; ?>">
										<span class="fe-checkbox"></span> <?php echo $n_talla; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<?php } else { // Mostrar opción a filtrar por categoría al buscar por texto ?>

					<div id="flt_categoria" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Categoría </p>
							<ul>

							<?php foreach ( $filtro_categorias as $c ) { 
								$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_CATEGORIA, trim( $c["name"] ) );
								$n_catg = $c["name"];  
							?>
								<li><a title="<?php echo $n_catg; ?>" href="<?php echo $url_f; ?>">
									<span class="fe-checkbox"></span> <?php echo $n_catg; ?></a>
								</li>
							<?php } ?>
								
							</ul>
						</div>
					</div>

					<?php } ?>

					<div id="flt_bano" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Baños </p>
							<ul>
								<?php foreach ( $d_filtros["banos"] as $b ){  
									$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_BANO, trim( $b["ubano"] ) );
								?>
									<li><a title="<?php echo $b["bano"]; ?>" href="<?php echo $url_f; ?>">
									<span class="fe-checkbox"></span> <?php echo $b["bano"]; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div id="flt_trabajo" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Trabajo </p>
							<ul>
								<?php foreach ( $d_filtros["trabajos"] as $t ) { 
									$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_TRABAJO, trim( $t["utrabajo"] ) );
								?>
									<li><a title="<?php echo $t["nombre"]; ?>" href="<?php echo $url_f; ?>">
									<span class="fe-checkbox"></span> <?php echo $t["nombre"]; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div id="flt_linea" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Línea </p>
							<ul>
								<?php foreach ( $d_filtros["lineas"] as $l ) {
									$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_LINEA, trim( $l["ulinea"] ) );
								?>
									<li><a title="<?php echo $l["nombre"];?>" href="<?php echo $url_f; ?>">
									<span class="fe-checkbox"></span> <?php echo $l["nombre"]; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div id="flt_color" class="tab_filtro_contenido">
						<div class="tag-group" id="coll-filter-3">
							<p class="title"> Colores </p>
							<ul>
								<?php foreach ( $d_filtros["colores"] as $c ) { 
									$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_COLOR, trim( $c["ucolor"] ) );
								?>
									<li><a title="<?php echo $c["color"]; ?>" href="<?php echo $url_f; ?>">
									<span class="fe-checkbox"></span> <?php echo $c["color"]; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

				</div>

				<!--<div class="col-md-8 col-sm-8 col-xs-24 fadeInUp animated">
				
				</div>-->

				<!-- tags groupd 3 -->
			</div>
		</div>
	</ul>
</div>