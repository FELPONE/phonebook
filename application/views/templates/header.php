<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PhoneBook</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<!-- css -->
	<link href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<header id="site-header">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			  <a class="navbar-brand" href="<?php echo base_url('contact') ?>">PhoneBook</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle right" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <?php if (isset($_SESSION['username'])) : ?>
			          	 <?php echo ucfirst ( $_SESSION['username']); ?>
			          <?php endif; ?>	
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
							<a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
						<?php else : ?>
							<a class="dropdown-item" href="<?= base_url('register') ?>">Register</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= base_url('login') ?>">Login</a>
					  <?php endif; ?>
			        </div>
			      </li>
			    </ul>
			    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
				    <?php echo form_open(base_url( 'contact' ), array('class' => 'form-inline my-2 my-lg-0' ));?>
				      <input class="form-control mr-sm-2 search_box" type="search" name="search"   placeholder="Search" aria-label="Search">
				      <button class="btn btn-outline-success my-2 my-sm-0 search_btn " type="submit"><em class="fa fa-search"></em></button>
				    </form>
				    <a class="btn btn-outline-danger my-2 my-sm-0 " href="<?php echo base_url('reset_search') ?>"><em class="fa fa-undo"></em></a>
			    <?php endif; ?>
			  </div>
		</nav>
	</header><!-- #site-header -->



	
		
		