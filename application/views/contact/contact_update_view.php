<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
        <div class="login-reg-form">
            <?= form_open() ?>
                <h2 class="text-center">Update Contact</h2>  
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter a name">
                        <div class="validation_error">
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" placeholder="Enter a last name">
                        <div class="validation_error">
                            <?php echo form_error('last_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>" placeholder="Enter a phone number">
                        <div class="validation_error">
                            <?php echo form_error('phone_number'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" name="note"  value="<?php echo $note; ?>" placeholder="Enter a note">
                        <div class="validation_error">
                            <?php echo form_error('note'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                    <?php if (isset($error)) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        </div>
                    <?php endif; ?>
                     <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('msg'); ?></div>
                    <?php endif; ?> 
            </form>
        </div><!-- .login-reg-form -->
    </div><!-- .row -->
</div><!-- .container -->