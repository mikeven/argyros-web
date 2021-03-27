<div id="contenido_bloque_filtros" class="seccion_filtros_catalogo">
	<div id=""></div>
	<div class="navbar-collapse">
		<ul class="nav">
			<li class="dropdown mega-menu">
				<hr>
				<div style="float:left;">
					<a id="tfilters" href="#!" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
					<span>Filtros <i class="fa fa-caret-down"></i></span>
					<!-- <i class="fa fa-caret-down"></i> -->
					<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
					<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
					</a>
				</div>
				<div id="flt-breadcrumb" style="float:left;">
					<?php 
						if( isset( $_SESSION["login"] ) ) 
							include( "breadcrumb.php" ); 
					?>
				</div>
				<div id="panel_tag_filters" style="float: right;">
					
				</div>
				<input id="panel_filtro" type="text" value="" readonly="true"/>
				<div style="clear:both;"></div>
				<hr>
				<?php include( "catalogue_filters.php" ); ?>
			</li>
		</ul>
	</div>

</div>