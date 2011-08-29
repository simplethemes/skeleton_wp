<?php do_action('before_checkout_form'); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo jigoshop_cart::get_checkout_url(); ?>">
	
	<div class="col2-set" id="customer_details">
		<div class="one_half">

			<?php do_action('jigoshop_checkout_billing'); ?>
						
		</div>
		<div class="one_half last">
		
			<?php do_action('jigoshop_checkout_shipping'); ?>
					
		</div>
	</div>
	
	<div class="clear"></div>
	<h3 id="order_review_heading"><?php _e('Your order', 'jigoshop'); ?></h3>
	
	<?php jigoshop_get_template('checkout/review_order.php'); ?>
	
</form>

<?php do_action('after_checkout_form'); ?>