<h1><?php echo $title;?></h1>


<?php $form= \app\core\form\Form::begin(' ','post'); ?>
		<div class="row">
			<div class="col">
				<?php echo $form->field($model,'fname');?>
			</div>
			<div class="col">
					<?php echo $form->field($model,'lname');?>
			</div>
		</div>
	

	<?php echo $form->field($model,'email');?>
	<?php echo $form->field($model,'password');?>
	<?php echo $form->field($model,'pass2');?>
	<input type="submit" name="reg1" class="btn btn-success" value="Register">
<?php  \app\core\form\Form::end(); ?>





<!---<form name='form1' action="" method="post">
<div class="row">
		<div class="col">
			<div class="form-group">
		<label>FirstName</label>
		<input type="text"  name="fname" value="" placeholder="FirstName.." 
		class="form-control<?php //echo $model->hasError('fname')? ' is-invalid':'' ;?>">
			<span class='invalid-feedback'>
				<?php //echo $model->getFirstErrorMsg('fname');?>
			</span>
		</div>
	</div>
	<div class="col">
	<div class="form-group">
		<label>LastName</label>
		<input type="text" class="form-control" name="lname" placeholder="LastName..">
	</div>
</div>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" name="email" placeholder="Email..">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" class="form-control" name="password" placeholder="Password..">
	</div>
	<div class="form-group">
		<label>Password-Repeat</label>
		<input type="text" class="form-control" name="pass2" placeholder="ReType-Password..">
	</div>
	
	<input type="submit" name="reg1" class="btn btn-success" value="Register">

</form> --->



	



