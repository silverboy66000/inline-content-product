<style>
    .attachment-woocommerce_thumbnail.size-woocommerce_thumbnail {
        max-height: 150px;
    }
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        grid-gap: 10px;
        background-color: #827f82;
        padding: 10px;
    }

    .grid-container > div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 20px 0;
        font-size: auto;
    }
</style>
<div class="row grid-container" style="padding: 1%">
	<?php
	//print_r($atts);

	if ($atts['content'])
	{
		$postList=explode(',',$atts['content']);
		foreach ($postList as $postListDetails)
		{
			$post=get_post($postListDetails);
			if (isset($post))
			{
				?>
                <div class=col-md-12" style="margin:0.5em;padding:1%;border:1px solid grey ; border-radius: 10px;">
                    <div class="col-md-2" style=""><a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a> </div>
                    <div class="col-md-2"><a href="<?php echo $post->guid; ?>"><?php echo $post->post_excerpt; ?></a></div>
                    <div class="col-md-2"><a href="<?php echo $post->guid; ?>"><button>اطلاعات بیشتر</button></a></div>
                </div>
				<?php
			}
		}

	}
	if ($atts['product'])
	{
		$productList=explode(',',$atts['product']);
		foreach ($productList as $productListDetails)
		{
			$product = wc_get_product( $productListDetails );
			?>
            <div class=col-md-3" style="margin:0.5em;border:1px solid grey ; border-radius: 10px;min-height:320px">
                <div class="col-md-2" style=""><a href="<?php echo $product->get_permalink(); ?>"><?php echo $product->get_image(); ?></a> </div>
                <div class="col-md-2"><a href="<?php echo $product->get_permalink(); ?>"><?php echo $product->get_name(); ?></a></div>
                <div class="col-md-2"><?php echo $product->get_price_html(); ?></div>
                <span class="button-wrap" style="display: block; text-align: center;"><a class="button-sc button red-bt big-bt " style="-webkit-border-radius: 20px; border-radius: 20px; margin-right: 0;" href="<?php echo $product->get_permalink(); ?>" target="_blank" rel="follow noopener" data-bg="" data-hoverbg="" data-text="" data-texthover=""> اطلاعات بیشتر</a></span>

            </div>
			<?php
		}
	}

	?>
</div>
