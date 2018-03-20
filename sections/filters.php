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
				<div class="col-md-8 col-sm-8 col-xs-24 fadeInUp animated">
					<div class="tag-group" id="coll-filter-3">
						<p class="title">
							Precio producto
						</p>
						De
						<input type="text" id="flt_pre_pro_min" class="form-control_" name="f_pprod_min" value="" style="width:25%">
						Hasta
						<input type="text" id="flt_pre_pro_max" class="form-control_" name="f_pprod_max" value="" style="width:25%">
					</div>
					<div class="tag-group" id="coll-filter-3">
						<p class="title">
							Precio por gramo
						</p>
						De
						<input type="text" id="flt_pre_pes_min" class="form-control_" name="f_ppeso_min" value="" style="width:25%">
						Hasta
						<input type="text" id="flt_pre_pes_max" class="form-control_" name="f_ppeso_max" value="" style="width:25%">
					</div>
				</div>


				<div class="col-md-8 col-sm-8 col-xs-24 fadeInUp animated">
				<div class="tag-group" id="coll-filter-3">
					<p class="title">
						Talla
					</p>
					<ul>
						<?php foreach ( $filtro_tallas as $t ) { ?>
							<li><a title="Talla 1" href="#"><span class="fe-checkbox"></span> <?php echo $t["name"]?></a></li>
						<?php } ?>
					</ul>
				</div>
				</div>


				<div class="col-md-8 col-sm-8 col-xs-24 fadeInUp animated">
					<div class="tag-group" id="coll-filter-3">
						<ul>
							<li><a title="Baño" href="#"><span class="fe-checkbox"></span> Baño</a></li>
							<li><a title="Trabajo" href="#"><span class="fe-checkbox"></span> Trabajo</a></li>
							<li><a title="Línea" href="#"><span class="fe-checkbox"></span> Línea</a></li>
							<li><a title="Color" href="#"><span class="fe-checkbox"></span> Color</a></li>
						</ul>						
					</div>
				</div>

				<!-- tags groupd 3 -->
			</div>
		</div>
	</ul>
</div>