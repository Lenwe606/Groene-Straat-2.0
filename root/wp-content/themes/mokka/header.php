<?php
/**
 * The Header for our theme
 * @subpackage Mokka
 * @since Mokka 1.0
 */
global $fave_option; // Fetch options stored in $nt_option;
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <?php 
	// Get the favicon
	if ( $fave_option['site_favicon'] != '' ) { 
		$site_favicon = $fave_option['site_favicon'];
	} else { 
		$site_favicon = get_template_directory_uri() . '/images/favicon.ico';
	}
	?>
	<link rel="shortcut icon" href="<?php echo $site_favicon; ?>" />
	<?php 
	// Get the retina favicon
	if ( $fave_option['site_retina_favicon'] != '' ) { 
		$retina_favicon = $fave_option['site_retina_favicon'];
	} else { 
		$retina_favicon = get_template_directory_uri() . '/images/retina-favicon.png';
	}
	?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo $retina_favicon; ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="outer-wrap">
	<div id="inner-wrap1">
        <div id="pageslide">
            <a class="close-btn" id="nav-close-btn" href="#top"><i class="fa fa-times-circle-o"></i></a>
        </div>
        		<?php 
        		// Get the sticky logo
        		if ( $fave_option['sticky_nav_logo'] != '' ) { 
        		    $sticky_logo = $fave_option['sticky_nav_logo'];
        		} else { 
        		    $sticky_logo = get_template_directory_uri() . '/images/logo.png';
        		}
        		?>


            <header class="header container">
                <div class="navbar secondary-nav <?php if ( $fave_option['site_top_strip'] == 0 ) { echo ' hide-strip'; } ?>" role="navigation">
                    
                    <div class="mokka-secondary-menu">
                    <?php fave_navigation('secondary_menu'); ?><!-- .page-nav -->
                    </div>
                    
                    <?php 
                        // Social Profiles
                        if( $fave_option['top_social_profiles'] == 1 ) {
                            get_template_part ( 'includes/social', 'media' ); 
                        }
                    ?>
                    
                    <div class="nav-open-wrap navbar-header">
                        <button type="button" id="nav-open-btn" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div><!-- .navbar-header -->
                </div><!-- .navbar -->
                
                <div class="logo-wrap mokka-fadin animated text-center">
                    <h1 class="logo">
                    <?php 
                    // Get the logo
                    if ( $fave_option['site_logo'] != '' ) { 
                        $site_logo = $fave_option['site_logo'];
                    } else { 
                        $site_logo = get_template_directory_uri() . '/images/logo.png';
                    }
                    ?>
                    <a href="<?php echo home_url( '/' ); ?>">
                        <img width="" height="" src="<?php echo $site_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
                    </a>
                    </h1>
                    <em class="tag-line"><?php bloginfo( 'description' ); ?></em>
                </div><!-- .logo-wrap -->
                
                <?php if($fave_option['mokka_sticky_nav'] == 1 ){ ?>
                <div class="banner hidden-sm hidden-xs">
                    <div class="banner-wrapper">
                        <div class="navbar-header">
                          <a class="navbar-brand" href="<?php echo site_url(); ?>">
                            <img src="<?php echo $sticky_logo; ?>">
                          </a>
                        </div>
                        <!-- main nav -->
                        <div class="navbar yamm hidden-sm hidden-xs">
                            <nav id="primary-nav-wrapper" class="primary-nav mokka-fadin animated clearfix">
                                <?php fave_navigation('main_menu', 'mega-menu'); ?>
                            </nav>
                        </div>
                        <!-- .primary-nav -->
                    </div>
                </div>
                <?php } ?>
                	<!-- main nav -->
                	<div class="navbar <?php if($fave_option['mokka_sticky_nav'] == 1 ){ echo "main-hidden"; } ?> yamm hidden-sm hidden-xs">
                	    <nav id="primary-nav-wrapper" class="primary-nav animated mokka-main-menu clearfix">
                	        <?php fave_navigation('main_menu', 'mega-menu'); ?>
                	    </nav>
                	</div>
                	<!-- .primary-nav -->
              
               
            </header><!-- .header -->
            
           <div id="showHere"></div>
