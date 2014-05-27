<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="" />
	  <meta name="description" content="" />
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/bootstrap-editable.css" rel="stylesheet">
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/select2.css" rel="stylesheet">
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/css/zocial/zocial.css" rel="stylesheet">
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
     <link href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/bootstrap-fileupload.css" rel="stylesheet">
    
    
    
  <!--  <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />-->
     
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/validation.css" type="text/css" />
  	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/livevalidation_standalone.compressed.js"></script>
    
  
     
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
   <!-- <script type="text/javascript" src="//use.typekit.net/cmc3uvu.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->
		
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<!--<script src='http://api.tiles.mapbox.com/mapbox.js/v0.6.7/mapbox.js'></script>
	<link href='http://api.tiles.mapbox.com/mapbox.js/v0.6.7/mapbox.css' rel='stylesheet' />-->

    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/ico/favicon.png">

	<script language="javascript">
	var web_path = '<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/index.php/';
	</script> 

</head>

<body>

  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <?php //echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl;exit; ?>
        <?php //echo Yii::app()->createUrl('posting/index');?>
        <a  class = 'brand' href="<?php echo Yii::app()->createUrl('posting/index')?>"   ><img src="<?php echo Yii::app()->request->baseUrl;?>/images/internify-logo.png"/></a>
        <?php 
			$session = Yii::app()->session;
		?>
        
        <div class="nav-collapse collapse">
          <ul class="nav pull-right">
          
            <li><a <?php if(Yii::app()->request->getRequestUri()==Yii::app()->createUrl('posting/index') || Yii::app()->request->getRequestUri()==Yii::app()->request->baseUrl.'/index.php/'){?> class='btn active' <?php } ?>  href="<?php echo Yii::app()->createUrl('posting/index')?>" >Home</a></li>
           
            <li><a <?php if(Yii::app()->request->getRequestUri()==Yii::app()->createUrl('/site/page?view=about')){?> class='btn active' <?php } ?> href="<?php echo Yii::app()->createUrl('/site/page?view=about')?>" >About</a></li>
            
			<li><a <?php if(Yii::app()->request->getRequestUri()==Yii::app()->createUrl('/contact')){?> class='btn active' <?php } ?> href="<?php echo Yii::app()->createUrl('/contact')?>" >Contact</a></li>
            
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
              <ul class="dropdown-menu">
				<?php 
				$session = Yii::app()->session;
				
				if($session['emp_array']['username'] && $session['emp_array']['password']){ ?>
					<li><a href="<?php echo Yii::app()->createUrl('employer/index')?>">Employer Admin</a></li>
				<?php } ?>
				
				<?php if ($session['linkedin_info']){?>
				<li>
					<a <?php if(Yii::app()->request->getRequestUri()==Yii::app()->createUrl('/student/index')){?> class='active' <?php } ?> href="<?php echo Yii::app()->createUrl('/student/index')?>">Student Admin</a>
				</li>
				<?php } ?>
				
				<li><a <?php if(Yii::app()->request->getRequestUri()==Yii::app()->createUrl('/posting/internship')){?> class='active' <?php } ?> href="<?php echo Yii::app()->createUrl('/posting/internship')?>">Internships</a></li>
                <li><a <?php if(Yii::app()->request->getRequestUri()==Yii::app()->createUrl('/posting/singleinternship')){?> class='active' <?php } ?> href="<?php echo Yii::app()->createUrl('/posting/singleinternship')?>">Single Internship</a></li>
              </ul>
            </li>
				<li class="dropdown">
				<?php 
				 if( !$session['emp_array']['username'] && !$session['linkedin_info'] )
				{ ?>
				
					<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
					<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
					<label id="error_message" class="error"></label>
						<form method="post" id="loginForm" action="login" accept-charset="UTF-8">
							<input style="margin-bottom: 15px;" type="text" placeholder="Username" id="username" name="username">
							<script type="text/javascript">
								var username = new LiveValidation('username', {onlyOnSubmit: true });
								username.add(Validate.Presence,{ failureMessage: 'Required' });
							</script>
							<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password">
							<script type="text/javascript">
								var password = new LiveValidation('password', {onlyOnSubmit: true });
								password.add(Validate.Presence,{ failureMessage: 'Required' });
							</script>                                    
							
							<input style="float: left; margin-right: 10px;" type="checkbox" name="remember-me" id="remember-me" value="1">
							<label class="string optional" for="user_remember_me"> Remember me</label>
							<input class="btn btn-primary btn-block" type="submit" onClick="check_login()" id="sign-in" value="Sign In">
							
							<?php if (!isset($session['linkedin_info']['email'])) {?>
							<label style="text-align:center;margin-top:5px">or</label>
							<input class="btn btn-primary btn-block" type="button" onClick="window.location = '<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/index.php/posting/linkedin' ;" id="sign-in-linkedin" value="Sign In with Linkedin">
							<?php }?>
						</form>
					</div>
					<?php }
					
						
					else { ?>
					<a href="<?php echo Yii::app()->createUrl('employer/logout')?>" >Sign Out </a>
					
					<?php } ?>
				</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
 
  
<div id="wrap">
<div class="body-push"></div>
<div class="subtle_fade_fixed"></div>

	<?php echo $content; ?>

       <div id="push"></div>
       </div>

    <div id="footer">
      <div class="container">
      	<hr>
        <p class="muted credit">&copy; Internify <?php echo date('Y');?> </p>
      </div>
    </div>
   
    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <?php require_once('include_js.php'); ?>
 
  
  
  
  
  </body>
</html>