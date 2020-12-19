<h1><?php echo $title;?></h1>
<?php $form= \app\core\form\Form::begin(' ','post'); ?>

	

	<?php echo $form->field($model,'email');?>
	<?php echo $form->field($model,'password');?>
	
	<input type="submit" name="login" class="btn btn-success" value="Login">
<?php  \app\core\form\Form::end(); ?>