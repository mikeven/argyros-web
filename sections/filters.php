<div id="catalog-filters" class="fltout megamenu-container_ banner-bottom mega-col-6" style="">
	<ul class="sub-mega-menu">
		<div class="sb-wrapper">
			<div class="filter-tag-group">
				<!-- tags groupd 1 -->
				<!--<div class="tag-group" id="coll-filter-1">
					<p class="title">
						Talla
					</p>
					<ul>
						<li><a title="Narrow selection to products matching tag S" href="#"><span class="fe-checkbox"></span> 2</a></li>
						<li><a title="Narrow selection to products matching tag M" href="#"><span class="fe-checkbox"></span> 4</a></li>
						<li><a title="Narrow selection to products matching tag L" href="#"><span class="fe-checkbox"></span> 6</a></li>
						<li><a title="Narrow selection to products matching tag XL" href="#"><span class="fe-checkbox"></span> 7</a></li>
					</ul>
				</div>-->
				<!-- tags groupd 1 -->

				<!-- tags groupd 2 -->
				<!--<div class="tag-group" id="coll-filter-2">
					<p class="title">
						Color
					</p>
					<ul>
						<li class="swatch-tag"><span style="background-color: red; background-image: url(assets/images/red.png);" class="btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Red"><a title="Narrow selection to products matching tag Red" href="#"></a></span></li>
						<li class="swatch-tag"><span style="background-color: green; background-image: url(assets/images/green.png);" class="btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Green"><a title="Narrow selection to products matching tag Green" href="#"></a></span></li>
						<li class="swatch-tag"><span style="background-color: black; background-image: url(assets/images/black.png);" class="btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Black"><a title="Narrow selection to products matching tag Black" href="#"></a></span></li>
						<li class="swatch-tag"><span style="background-color: gray; background-image: url(assets/images/gray.png);" class="btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Gray"><a title="Narrow selection to products matching tag Gray" href="#"></a></span></li>
						<li class="swatch-tag"><span style="background-color: white; background-image: url(assets/images/white.png);" class="btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="White"><a title="Narrow selection to products matching tag White" href="#"></a></span></li>
					</ul>
				</div>-->
				<!-- tags groupd 2 -->

				<!-- tags groupd 3 -->
				
				<div class="col-md-6 col-sm-6 col-xs-24 fadeInUp animated">
					<div class="tag-group" id="coll-filter-3">
						<ul>
							<li><a title="Precio por pieza" href="#!" class="flt_selector" data-flt-cnt="flt_precio_prod"> Precio por pieza</a></li>
							<li><a title="Precio por gramo" href="#!" class="flt_selector" data-flt-cnt="flt_precio_gramo"> Precio por gramo</a></li>
							<li><a title="Precio producto" href="#!" class="flt_selector" data-flt-cnt="flt_peso"> Peso producto</a></li>
							<li><a title="Talla" href="#!" class="flt_selector" data-flt-cnt="flt_talla">Talla</a></li>
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
								<?php foreach ( $filtro_tallas as $t ) { 
									$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_TALLA, trim( $t["name"] ) );
									$n_talla = $t["name"];  if ( $t["name"] == "ajust" )  $n_talla  = "Ajustable";
                                          					if ( $t["name"] == "unica" )  $n_talla  = "Única";
								?>
									<li><a title="Talla <?php echo $n_talla; ?>" href="<?php echo $url_f; ?>">
										<span class="fe-checkbox"></span> <?php echo $n_talla; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

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