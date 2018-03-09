<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title(); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900|Titillium+Web:400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="lb-page">

		<div id="lb-page-wrap">

			<header id="lb-header">
				<div class="wrap">
					<a class="lb-logo" href="/">
						<img src="https://storage.googleapis.com/stateless-dev-realmassive-v2-p/2018/02/7ae517d8-logo@2x.png">
					</a>
					<div class="lb-right-nav">
						<a class="button join" href="#!">Join</a>
						<a class="button sign-in" href="#!">Sign In</a>
						<div class="button add-listing">
							<i class="md-icon">&#xE148;</i>
							<a href="#!">Add Listing</a>
						</div>
					</div>
					<?php if ( has_nav_menu('lb-desktop') ) : ?>
					<nav class="lb-left-nav" role="navigation">
						<?php echo wp_nav_menu('lb-desktop'); ?>
					</nav>
					<?php endif; ?>
					<a class="lb-mobile-open">
						<i class="material-icons open">&#xE5D2;</i>
						<i class="material-icons close">&#xE5CD;</i>
					</a>
				</div>
			</header>

			<header id="lb-mobile" class="animate">
				<?php if ( has_nav_menu('lb-mobile') ) : ?>
				<nav class="lb-mobile-nav" role="navigation">
					<?php echo wp_nav_menu('lb-mobile'); ?>
					<div class="nav-item"><a class="button join" href="#!">Join</a></div>
					<div class="nav-item"><a class="button sign-in" href="#!">Sign In</a></div>
					<div class="nav-item"><a class="button add-listing" href="#!">Add Listing</a></div>
				</nav>
				<?php endif; ?>
			</header>
