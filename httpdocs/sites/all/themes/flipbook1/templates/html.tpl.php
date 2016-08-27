<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta name="author" content="Ziff Davis & CO-BRAND" />
	<meta name="description" content="CLIENT CAMPAIGN SUMMARY" />
	<meta name="keywords" content="campaign keywords, here, here, and here" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php if (isset($favicon)): ?>
	<link rel="shortcut icon" type="/sites/default/files/<?php print $favicon; ?>" />
	<?php endif; ?>
	
	<link rel="stylesheet" type="text/css" href="/<?php print path_to_theme(); ?>/css/jquery.jscrollpane.custom.css" />
	<link rel="stylesheet" type="text/css" href="/<?php print path_to_theme(); ?>/css/bookblock.css" />
	<link rel="stylesheet" type="text/css" href="/<?php print path_to_theme(); ?>/css/custom_fblite_BRAND_PROJECT.css" />
	<link rel="stylesheet" type="text/css" href="/<?php print path_to_theme(); ?>/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="/<?php print path_to_theme(); ?>/css/font-awesome.min.css" />
	
	<?php if (isset($css_override)): ?>
	<link rel="stylesheet" type="text/css" href="/sites/default/files/css/<?php print $css_override; ?>" />
	<?php endif; ?>
	
	
	<script src="/<?php print path_to_theme(); ?>/js/modernizr.custom.79639.js"></script>
	
	<?php if (isset($title_tag)): ?>
	<title><?php print $title_tag; ?></title>
	<?php endif; ?>
	
	<?php print $styles; ?>
	<?php print $scripts; ?>
</head>
<body>
	<?php print $page_top; ?>
	<?php print $page; ?>
	<?php print $page_bottom; ?>
</body>
</html>
