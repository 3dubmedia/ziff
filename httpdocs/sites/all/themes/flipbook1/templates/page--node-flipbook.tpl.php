<?php
$logoPath = "/sites/default/files/logos/";
$iconPath = "/sites/default/files/icons/";
$faviconPath = "/sites/default/files/favicons/";
$heroPath = "/sites/default/files/heros/";
$screenshotsPath = "/sites/default/files/screenshots/";
?>

<?php if ($tabs): ?><div id="tabs-wrapper" class="clearfix"><?php endif; ?>
<?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
<?php print render($tabs2); ?>

<div id="container" class="container">
	<!-- TOC button -->
	<span id="tblcontents" class="menu-button"> Table of Contents</span>

	<!-- TOC and Client Branding -->		
	<div id="masthead" >
		<nav class="arrow_nav">
			<span id="bb-nav-prev"> &larr; </span> 
			<span id="bb-nav-next"> &rarr; </span>
		</nav>
		
		<?php
		$field_logo_masthead = $node->field_logo_masthead_['und'][0]['node']->field_image['und'][0]['filename'];
		if ($field_logo_masthead){
			if (isset($node->field_logo_link["und"][0]["value"])){
				print '<a href="'.$node->field_logo_link["und"][0]["value"].'"><img src="'.$logoPath.$field_logo_masthead.'" alt="logo" border="0" class="logo"></a>';
			} else {
				print '<img src="'.$logoPath.$field_logo_masthead.'" alt="logo" border="0" class="logo">';
			}
		}
		?>
		
	</div>
	<div class="bg-header" > </div> <!--// end of bg-gradient -->

	<!-- Hidden Menu System -->		
	<div class="menu-panel"  >
		
		<?php
		$field_logo_menu = $node->field_menu_logo['und'][0]['node']->field_image['und'][0]['filename'];
		if ($field_logo_menu){
			if (isset($node->field_logo_link["und"][0]["value"])){
				print '<a href="'.$node->field_logo_link["und"][0]["value"].'"><img src="'.$logoPath.$field_logo_menu.'" alt="logo" border="0" class="logo-menu"></a>';
			} else {
				print '<img src="'.$logoPath.$field_logo_menu.'" alt="logo" border="0" class="logo">';
			}
		}
		?>
	
		<h3> <?php print $node->field_menu_title["und"][0]["value"]; ?> </h3>
		<ul id="menu-toc" class="menu-toc">
			<?php
			$i=1;
			foreach ($node->field_pages['und'] as $item){
				$entID = $item['value'];
				$thisEnt = entity_load('field_collection_item',array($entID));
				if (isset($thisEnt[$entID]->field_menu_nav_title['und'][0]['value'])){
					$thisTitle = $thisEnt[$entID]->field_menu_nav_title['und'][0]['value'];
					print '<li><a href="#item'.$i.'"><span>'.$thisTitle.'</span></a></li>';
				}
				$i++;
			}
			?>
		</ul>
		<div>
			<form name="linkForm" method="POST" action="" id="form">
				<select style="display: block; margin-left: 20px;" name="SelectMenu-1" onchange="location = this.options[this.selectedIndex].value;">
					<option value=""> Select Your Language -- </option>
					<option value=""> --------- </option>
					<?php
					$langs = language_list();
					//print_r($langs);
					$tnodes = translation_node_get_translations($node->tnid);
					//print_r($node);print_r($tnodes);
					if (is_array($tnodes)){
						foreach ($tnodes as $k){
							//print_r($k);
							$tnLanguage = $k->language;
							$tnNid = $k->nid;
							$tnPath = drupal_get_path_alias('node/'.$tnNid);
							$tnLanguageName = $langs[$tnLanguage]->name;
							print "<option value='/{$tnPath}'> {$tnLanguageName} </option>";
						}
					}
					?>
				</select>
			</form>
		</div>
		<br />
		<br />
		<br />
	</div>
	<!-- this wrapper contains the body content only -->
	<div class="bb-custom-wrapper">
		<div id="bb-bookblock" class="bb-bookblock">
			<?php
			
			// LOOP OVER PAGES ENTITY
			$i=1;
			$items = array();
		
			foreach ($node->field_pages['und'] as $item){
				$entID = $item['value'];
				$thisEnt = entity_load('field_collection_item',array($entID));
				//print_r($thisEnt);
				if (isset($thisEnt[$entID]->field_hero_image['und'])){ $items[$i]['field_image'] = $thisEnt[$entID]->field_hero_image['und'][0]['node']->field_image['und'][0]['filename']; }
				if (isset($thisEnt[$entID]->field_headline['und'])){ $items[$i]['field_headline'] = $thisEnt[$entID]->field_headline['und'][0]['value']; }
				if (isset($thisEnt[$entID]->field_headline_caption['und'])){ $items[$i]['field_headline_caption'] = $thisEnt[$entID]->field_headline_caption['und'][0]['value']; }
				if (isset($thisEnt[$entID]->field_title['und'])){ $items[$i]['field_title'] = $thisEnt[$entID]->field_title['und'][0]['value']; }
				if (isset($thisEnt[$entID]->field_body['und'])){ $items[$i]['field_body'] = $thisEnt[$entID]->field_body['und'][0]['value']; }
				
				$j=0;
				foreach ($thisEnt[$entID]->field_assets['und'] as $asset){
					$thisAssetID = $asset['value'];
					//print ">>>".$thisAssetID;
					$thisAssetEnt = entity_load('field_collection_item',array($thisAssetID));
					//print_r($thisAssetEnt);
					if (isset($thisAssetEnt[$thisAssetID]->field_type['und'])){ $items[$i]['field_assets'][$j]['field_type'] = $thisAssetEnt[$thisAssetID]->field_type['und'][0]['value']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_set['und'])){$items[$i]['field_assets'][$j]['field_set'] = $thisAssetEnt[$thisAssetID]->field_set['und'][0]['value']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_icon_title['und'])){$items[$i]['field_assets'][$j]['field_icon_title'] = $thisAssetEnt[$thisAssetID]->field_icon_title['und'][0]['value']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_text['und'])){$items[$i]['field_assets'][$j]['field_text'] = $thisAssetEnt[$thisAssetID]->field_text['und'][0]['value']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_url['und'])){$items[$i]['field_assets'][$j]['field_url'] = $thisAssetEnt[$thisAssetID]->field_url['und'][0]['value']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_icon_override['und'])){$items[$i]['field_assets'][$j]['field_icon_override'] = $thisAssetEnt[$thisAssetID]->field_icon_override['und'][0]['filename']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_screenshot['und'])){$items[$i]['field_assets'][$j]['field_image_asset'] = $thisAssetEnt[$thisAssetID]->field_screenshot['und'][0]['node']->field_image['und'][0]['filename']; }
					if (isset($thisAssetEnt[$thisAssetID]->field_youtube['und'])){$items[$i]['field_assets'][$j]['field_youtube'] = $thisAssetEnt[$thisAssetID]->field_youtube['und'][0]['value']; }
					$j++;
				}
				
				$i++;
				
			} // END LOOP OVER PAGES ENTITY
			
			// LOOP OVER SOCIAL ICONS ENTITY
			$k=1;
			$socialItems = array();
			foreach ($node->field_social_media['und'] as $itemSocial){
				$entID = $itemSocial['value'];
				$thisEnt = entity_load('field_collection_item',array($entID));
				if (isset($thisEnt[$entID]->field_url['und'])){ $socialItems[$k]['field_url'] = $thisEnt[$entID]->field_url['und'][0]['value']; }
				if (isset($thisEnt[$entID]->field_class['und'])){ $socialItems[$k]['field_class'] = $thisEnt[$entID]->field_class['und'][0]['value']; }
				$k++;
			} // END LOOP OVER SOCIAL ICONS ENTITY				
			
			?>
			
			<?php
			$i=1;
			foreach ($items as $thing){
				//print_r($thing);
				print '<div class="bb-item" id="item'.$i.'">
					<div class="content">
						<div class="scroller">';
						
							if (isset($thing["field_headline"])){
								print'<!-- Featured Header HERO -->
								<div class="featured_header_hero" >';
									if (isset($thing["field_image"])){
										print'<div class="fh_wrap fh_hero" style="background-image: url(\''.$heroPath.$thing["field_image"].'\');">';
									} else {
										print'<div class="fh_wrap fh_hero">';
									}
										print '<span><h3>'.$thing["field_headline"].'</h3>';
										if ($thing["field_headline_caption"]){
											print $thing["field_headline_caption"];
										}
									print'</span></div> 
								</div> <!--// END of Featured Header (HERO) -->';
							} else {
							
								print'<!-- Featured Header (MINI) -->
								<div class="featured_header_mini" >';
								
									if (isset($thing["field_headline_caption"])){
										print'<div class="fh_wrap fh_mini">';
										print'<span>sdfdfd</span>';
									} else {
										print'<div class="fh_wrap fh_mini" style="display:none;">';
										print'<span><p></p></span>';
									}
										
									print'</div> 
								</div> <!--// END of Featured Header (MINI) -->';
							}
							
							print'<div class="body_content_wrap">
								<div class="left-column">	
						
									<h2>';
									
									if (isset($thing["field_title"])){
										print $thing["field_title"];
									}
									print'</h2>
									<span>';
									if (isset($thing["field_body"])){
										print $thing["field_body"];
									}										
		
									
									print'</span>

								
								</div> <!--// End left-column -->
							
								<div class="right-column module-height_intro">';
									
								$path = path_to_theme();
								foreach ($thing["field_assets"] as $assetThing){
									
									$thisFile="";
									
									//print_r($assetThing);
									if (isset($assetThing['field_youtube'])){
										
										print'<div class="video shadow"><iframe src="'.$assetThing['field_youtube'].'" width="430" height="242" frameborder="0" allowfullscreen></iframe></div>';
									} else if (isset($assetThing['field_image_asset']) ){
										
										$thisMediaFile = $screenshotsPath.$assetThing['field_image_asset'];
									
										print'<a href="'.$thisMediaFile.'" target="_blank"><img src="'.$thisMediaFile.'" alt="Image" border="0" class="scrnsht shadow" /></a>';
									
										
										
										
									} else {
									
										if (isset($assetThing['field_icon_override'])){
											$thisFile = '/sites/default/files/icons/'.$assetThing['field_icon_override'];
										} else {
											if (!$assetThing['field_set']){
												$assetThing['field_set']=1;
											}
											if (isset($assetThing['field_type'])){
												$thisFile = '/'.$path.'/img/icon_sets/'.$assetThing['field_type'].'_'.$assetThing['field_set'].'.png';
											}
										}
										
										if ($thisFile){
											print'<div class="module_wrap">
												<a href="'.$assetThing['field_url'].'" target="_blank"><img src="'.$thisFile.'" alt="Icon" border="0" class="module_icon" /></a>
												<span class="module_text_wrapper">
													<h4> '.$assetThing['field_icon_title'].' </h4>';
													
													if (isset($assetThing['field_url'])){
														print'<p> <a href="'.$assetThing['field_url'].'" target="_blank">'.$assetThing['field_text'].'</a> </p>';
													} else {
														print'<p>'.$assetThing['field_text'].'</p>';
													}
													
												print'</span>
											</div>';
										} else {
											print'<div class="module_wrap" style="display:none;">
											
												<span class="module_text_wrapper">
													<h4> title </h4>
													<p> <a href="#" target="_blank">title</a> </p>
												</span>
											</div>';
										}
									}
								} // foreach ($thing["field_assets"] as $assetThing)
								//print_r($socialItems);
								if (isset($socialItems)){
									print '<!-- Social Icon Links -->
									<header class="social_module">';
										foreach ($socialItems as $socialThing){
											print '<a href="http://'.$socialThing["field_url"].'" target="_blank"><span class="fa '.$socialThing["field_class"].'" aria-hidden="true"> &nbsp; </span></a>';
										}
									print '</header><!--// END Social Icon Links -->';
								}
							
								print'</div> <!--// End right-column -->
							</div> <!--// End Body Wrapper -->	
						
						</div> <!--// End scroller -->
					</div> <!--// End content --> 
				</div> <!--// End of bb-item #1 -->';
				$i++;
			}
			?>		
		</div>
	</div>
</div><!-- /container -->

<!-- installs JQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<!-- funtionality files to facilitate the page-turning effect -->
<script src="/<?php print path_to_theme(); ?>/js/jquery.mousewheel.js"></script>
<script src="/<?php print path_to_theme(); ?>/js/jquery.jscrollpane.min.js"></script>
<script src="/<?php print path_to_theme(); ?>/js/jquerypp.custom.js"></script>
<script src="/<?php print path_to_theme(); ?>/js/jquery.bookblock.js"></script>
<script src="/<?php print path_to_theme(); ?>/js/page.js"></script>

<!-- trigger for  page-turning effect -->
<script> 
	$(function() 
		{ Page.init(); 
	}); 
</script>
