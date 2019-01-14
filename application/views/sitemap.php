<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc> 
        <priority>1.0</priority>
    </url>
	<url>
        <loc><?php echo base_url().'users/login' ?></loc>
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?php echo base_url().'users/register' ?></loc>
        <priority>0.5</priority>
    </url>
    <?php foreach($menus as $url) { ?>
    <url>
        <loc><?php echo base_url().$url ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	<?php foreach($categories as $url) { ?>
    <url>
        <loc><?php echo base_url().$url ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	<?php foreach($sub_categories as $url) { ?>
    <url>
        <loc><?php echo base_url().$url ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	<?php foreach($brands as $url) { ?>
    <url>
        <loc><?php echo base_url().$url ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	<?php foreach($products as $url) { ?>
    <url>
        <loc><?php echo base_url().$url ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>

</urlset>