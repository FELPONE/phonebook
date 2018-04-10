<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="login-reg-form">
		    <?= form_open(base_url()."login") ?>
		        <h2 class="text-center">Log in</h2>       
		        <div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Your username">
							<div class="validation_error">
								<?php echo form_error('username'); ?>
							</div>
				</div>
		        <div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Your password">
							<div class="validation_error">
								<?php echo form_error('password'); ?>
							</div>
				</div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary btn-block">Log in</button>
		        </div>
		        <div class="clearfix">
		            <a href="<?php echo base_url('register') ?>" class="pull-right">Register</a>
		        </div>  
		        <?php if($this->session->flashdata('msg')): ?>
            		<div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
        		<?php endif; ?>      
		    </form>
		</div><!-- .login-reg-form -->
	</div><!-- .row -->
</div><!-- .container -->