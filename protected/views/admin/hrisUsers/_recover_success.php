<div class="page-header">
	<h1>Account Recovery</h1>
</div>
<div class="row-fluid">
	<div class="span9 well">
		<p>A temporary password has been sent to your email <strong><?php echo $model->emp->Email_Add; ?></strong>.</p>
		<p>Depending on your network conditions, please allow 2-5 minutes for the recovery password to arrive in your inbox. Thank you for your patience.</p>
		<p><?php //echo $p; ?></p>
		<p><a href="<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>">Go back to the login page</a></p>
	</div>
</div>