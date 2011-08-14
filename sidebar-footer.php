<?php
/**
 * Footer widget areas.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 0.1
 */

// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
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

<?php if (is_active_sidebar('first-footer-widget-area')) : ?>
<div class="<?php echo $footergrid;?>">
	<?php dynamic_sidebar('first-footer-widget-area'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('second-footer-widget-area')) : $last = ($footerwidgets == '2' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar('second-footer-widget-area'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('third-footer-widget-area')) : $last = ($footerwidgets == '3' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar('third-footer-widget-area'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('fourth-footer-widget-area')) : $last = ($footerwidgets == '4' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
		  <?php dynamic_sidebar('fourth-footer-widget-area'); ?>
</div>
<?php endif;?>
<div class="clear"></div>

<?php endif;?>