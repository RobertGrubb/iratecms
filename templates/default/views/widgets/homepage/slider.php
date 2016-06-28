<?php if($this->uri->segment(1) == "" || $this->uri->segment(1) == "home"): ?>
		<div class=" slider-container">
			<div class="container">
	            <div class="row-fluid">
	            	<div class="col-lg-12 well">
						<div id="carousel-example-generic" class="carousel slide">
				            <ol class="carousel-indicators">
				                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				            </ol>
				            <div class="carousel-inner">
				                <?php $count = 1; ?>
				                <?php foreach($slides as $slide): ?>
				                <div class="item <?php if($count == 1): ?>active<?php endif; ?>">
				                    <img src="<?php url(); ?>uploads/slides/<?php echo $slide["image"]; ?>" alt="<?php echo $slide["title"]; ?>" />
				                </div>
				                <?php $count++; ?>
				                <?php endforeach; ?>
				            </div>
				            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				                <span class="glyphicon glyphicon-chevron-left"></span>
				            </a>
				            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				                <span class="glyphicon glyphicon-chevron-right"></span>
				            </a>
				        </div>
			        </div>
	        	</div>
	        </div>
	    </div>
<?php endif; ?>