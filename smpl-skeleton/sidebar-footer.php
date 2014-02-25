<?php
/**
 * Footer widget areas.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar('footer-widget-area-1') + is_active_sidebar('footer-widget-area-2') + is_active_sidebar('footer-widget-area-3') + is_active_sidebar('footer-widget-area-4');
// default
$footergrid = "one_fourth";
// if only one
if ($footerwidgets == "1") {
$footergrid = "full-width";
// if two, split in half
} elseif ($footerwidgets == "2") {
$footergrid = "one_half";
// if three, divide in thirds
} elseif ($footerwidgets == "3") {
$footergrid = "one_third";
// if four, split in fourths
} elseif ($footerwidgets == "4") {
$footergrid = "one_fourth";
}

?>

<?php if ($footerwidgets) : ?>

<?php if (is_active_sidebar('footer-widget-area-1')) : ?>
<div class="<?php echo $footergrid;?>">
	<?php dynamic_sidebar('footer-widget-area-1'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer-widget-area-2')) : $last = ($footerwidgets == '2' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar('footer-widget-area-2'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer-widget-area-3')) : $last = ($footerwidgets == '3' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar('footer-widget-area-3'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer-widget-area-4')) : $last = ($footerwidgets == '4' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
		  <?php dynamic_sidebar('footer-widget-area-4'); ?>
</div>
<?php endif;?>
<div class="clear"></div>

<?php endif;?>