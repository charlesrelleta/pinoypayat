
<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Pinoypapayat</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>js/skel.min.js"></script>
		<script src="<?php echo base_url();?>js/skel-layers.min.js"></script>
		<script src="<?php echo base_url();?>js/init.js"></script>
		<script src="<?php echo base_url();?>js/pinterest.js"></script>

		<link type="text/css" rel="stylesheet"  href="<?php echo base_url();?>css/style.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/style-xlarge.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/style-pinterest.css" rel="stylesheet">


	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><strong><a href="<?php echo base_url();?>Site">Pinoypapayat</a></strong> by FitnessFirst</h1>
				<nav id="nav">
					<ul>
						<li><a href="<?php echo base_url('Site'); ?>">Home</a></li>
						<li><a href="<?php echo base_url('Site/about'); ?>">About us</a></li>
						<li><a href="<?php echo base_url('Site/bmi_calculator'); ?>">BMI Calculator</a></li>
						<li><a href="<?php echo base_url('Site/tips_and_suggestions'); ?>">Tips and Suggestions</a></li>
						<li><a href="<?php echo base_url('Site/contact'); ?>">Contact us</a></li>
					</ul>
				</nav>
			</header>
			<?php if(isset($content)){
              foreach($content as $cont): ?>
<section class="wrapper" style="background: white;"><h3 align="center"><?php echo $cont->title;?></h3>
<h5 align="center" style="color: gray;"><?php echo $cont->description; ?></h5>
<h6 align="center" style="color: gray;">Tips &#38; Suggestions</h6>
</section>
		<!-- Main -->
			<section id="main" class="wrapper">
			<div class="container">
			<div class="row">

<br>

    
    <section id="">
    	
      <article class="">
        
        <p style="color: gray; font-family: times new roman; font-variant-caps: initial;"><?php
				$mycontent = $cont->content;
        echo $mycontent;
				 ?></p>
      </article>
      <?php endforeach;}
                 else { ?>
                 <script> alert("Empty!");</script>
                  <?php }?>


    </section>


    <hr>


  </div>

</div>
			</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">

					<ul class="copyright">
						<li>&copy; Pinoypapayat</li>
					</ul>
				</div>
			</footer>

	</body>
</html>
