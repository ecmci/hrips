<!-- Require the header -->
<?php require_once('tpl_header.php')?>

<!-- Require the navigation -->
<?php require_once('tpl_navigation.php')?>

<div class="container-fluid">
<noscript>
<div class="alert alert-block">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h3>Ooops!</h3> This site relies heavily on Javascript. Please enable it for full functionality of this system.
</div>
</noscript>					
    <!-- Include content pages -->
	<?php echo $content; ?>

</div><!--/.fluid-container-->

<!-- Require the footer -->
<?php require_once('tpl_footer.php')?>
