
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>B-Fam | SMM Panel</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="O2 SMM panel is the world. Largest and cheapest Social Media smm panel for resellers. Provide you all kind of social media at cheap price and instant Delivery.">
        <meta name="keywords" content="SMM Panel, Panel all sosmed, Social Media Panel, Social Media Server, SMM Reseller Panel, cheap social panel, cheap smm panel, followers, admin panel instagram">
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url() ?>assets/css/wkwk.css" rel="stylesheet" type="text/css" />
				</head>
      <body class="skin-blue">
        <header class="header">
            <a href="<?php echo base_url() ?>landing" class="logo">
                <img src="<?php echo base_url() ?>assets/img/logo/logokus.png" alt="" width="250px" height="40px">
                
                           </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                    </nav>
                    
                </header>	<div class="wrapper row-offcanvas row-offcanvas-left">
	                    <aside class="left-side sidebar-offcanvas">
                        <section class="sidebar">
                            <ul class="sidebar-menu">
                                <li>
                                    <a href="<?php echo base_url() ?>login">
                                        <i class="fa fa-sign-in"></i> <span>Masuk</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>registration">
                                        <i class="fa fa-user"></i> <span>Daftar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>price">
                                        <i class="fa fa-cart-arrow-down"></i> <span>Harga</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>contact">
                                        <i class="fa fa-phone-square"></i> <span>Contact</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>faq">
                                        <i class="fa fa-question-circle"></i> <span>FAQ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>tos">
                                        <i class="fa fa-question-circle"></i> <span>Term of Services</span>
                                    </a>
                                </li>
							 </ul>
                        </section>
                    </aside>
                    <aside class="right-side">					
                    <section class="content">
                        
                    <?php $this->load->view($main_view); ?>
                    
                
                </div>
					</section></div>
	        <script src="<?php echo base_url() ?>assets/js/jquery.min.js" type="text/javascript"></script>
		        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/Director/app.js" type="text/javascript"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>