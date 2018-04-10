<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="login-reg-form">
			<?= form_open(base_url()."register") ?>
				<h2 class="text-center">Register</h2>  
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Enter a username">
						<div class="validation_error">
							<?php echo form_error('username'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter your email">
						<div class="validation_error">
							<?php echo form_error('email'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter a password">
						<div class="validation_error">
							<?php echo form_error('password'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="password_confirm">Confirm password</label>
						<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm your password">
						<div class="validation_error">
							<?php echo form_error('password_confirm'); ?>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Register</button>
					</div>
					<div class="clearfix">
		            	<a href="<?php echo base_url('login') ?>" class="pull-right">Login</a>
		       		</div> 
					<?php if($this->session->flashdata('msg')): ?>
            			<div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
        			<?php endif; ?>   
			</form>
		</div><!-- .login-reg-form -->
	</div><!-- .row -->
</div><!-- .container -->