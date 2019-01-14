<!--slider-->
<div class="container-fluid">
	<div class="row">
	<header id="myCarousel" class="carousel slide">
		  <!-- Indicators -->
			<ol class="carousel-indicators">
				<?php 
				$i=0;						
				foreach ($banner as $row) {
					if($i==0){$add="active";}else{$add=null;}
				?>
				<li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $add;?>"></li>
				<?php $i++;}?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
			
				<?php 
				$i=1;						
				foreach ($banner as $row) { 
				if($i==1){$add="active";$id = ' id="hm-bg"';}else{$add=null;$id = '';}
				?>
				<div class="item <?php echo $add;?>">
					<img src="<?php echo site_url();?><?php echo $customer_banner_folder.$row->banner_image;?>" alt=""<?php echo $id;?> />
					<div class="container">
                    <div class="carousel-caption head_caption">
                         <?php echo $row->description;?>
                    </div>
                    </div>
				</div>
				<?php $i++;}?>

			</div>
			<!-- Left and right controls -->
    		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
	</header>
</div>
</div>