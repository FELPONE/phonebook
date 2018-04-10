<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <div class="panel panel-default panel-table">
              	<div class="panel-heading">
                	<div class="row">
                  		<div class="col col-xs-6 text-right">
                    		<a class="btn btn-success create_btn" href="<?php echo base_url('create') ?>"> Create New Contact</a>
                  		</div>
                	</div>
              	</div>
              	<div class="panel-body">
                	<table class="table table-borderless table-condensed table-hover">
                  		<thead>
		                    <tr>
		                        <th>Name</th>
		                        <th>Last Name</th>
		                        <th>Phone Number</th>
		                        <th>Note</th>
		                        <th>Created At</th>
		                        <th><em class="fa fa-cog"></em></th>
		                    </tr> 
                  		</thead>
                  		<tbody>

                        <?php if (isset($data)){ ?>    
                    			<?php foreach ($data as $item) { ?>      
                            	<tr>                           
  	                            <td><?php echo $item['name']; ?></td>
  	                            <td><?php echo $item['last_name']; ?></td>
  	                            <td><?php echo $item['phone_number']; ?></td>
  	                            <td><?php echo $item['note']; ?></td>
  	                            <td><?php echo $item['created_at']; ?></td>
  	                            <td align="center">
  	                            	<a class="btn btn-success" href="<?php echo base_url('edit/'.$item['id']) ?>"><em class="fa fa-pencil"></em></a>
  	                            	<a class="btn btn-danger" href="<?php echo base_url('delete/'.$item['id']) ?>"><em class="fa fa-trash"></em></a>
  	                            </td>
                            	</tr>
                      		<?php } ?>
                        <?php } else { ?>
                              <tr> 
                                <td>No contacts found</td>
                              </tr>
                        <?php } ?>
                    </tbody>
                	</table>
              	</div>
              	<div class="panel-footer">
                	<div class="row">
                  		<div class="col col-xs-12">
                     		<?php if (isset($links)) { ?>
		                		  <?php echo $links ?>
		    				        <?php } ?>
                  		</div>
                      <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success search_box" role="alert"><?php echo $this->session->flashdata('msg'); ?></div>
                      <?php endif; ?>
              	</div>
            </div>
		</div>
	</div><!-- .row -->
</div><!-- .container -->