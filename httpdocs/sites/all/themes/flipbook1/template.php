<?php

function flipbook1_preprocess_page(&$vars) {
  if (isset($vars['node']->type)) {
    $vars['theme_hook_suggestions'][] = 'page__node_' . $vars['node']->type;
  }  
}

function flipbook1_preprocess_node(&$variables) {
}

function flipbook1_preprocess_html(&$variables) {
  if ($node = menu_get_object()) {
    if (isset($node->field_favicons['und'][0]['node'])){
      $variables['favicon'] = $node->field_favicons['und'][0]['node']->field_favicon['und'][0]['filename'];
    }
    
    if (isset($node->field_css_override['und'][0]['filename'])){
      $variables['css_override'] = $node->field_css_override['und'][0]['filename'];
    }
    
    if (isset($node->field_title_tag['und'][0]['value'])){
      $variables['title_tag'] = $node->field_title_tag['und'][0]['value'];
    }
  }
}


