<!DOCTYPE html> 
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<% base_tag %>
	$MetaTags
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="$ThemeDir/images/Dynamic.png" />
	<link rel="apple-touch-icon" href="/crm/images/Dynamic.png" /> 
	
	<% require themedCSS(base) %>
	<% require themedCSS(skeleton) %>
	<% require css(dynamic-core/css/login.css) %>
	
	<script type="text/javascript" src="//use.typekit.net/mns0ycd.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
</head>
<body>
	<div class="container">
		<div class="layout loginForm">	
			<div class="logo">
				<img src="$ThemeDir/images/DynamicLogo.png">
			</div>
			<div class="login">
				$Content
				$Form
			</div>
		</div>
	</div>
</body>
</html>