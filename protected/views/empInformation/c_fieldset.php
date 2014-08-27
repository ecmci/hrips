<?php

function c_fieldset($content, $legend = "Click to expand/collapse", $boolStartClosed = false)
{
  // This function will create a collapsible fieldset, similar to those
  // used in Drupal.  It will lack the snazziness, because we will not
  // be using jQuery, so that you can use this function as easily as
  // possible, without extra libraries having to be included.
  //
  // This function just returns the HTML and javascript all in a string.
  // To use:  $x = c_fieldSet("content here", "title of fieldset", true);
  //          print $x;
  
  // Create a random ID for this fieldset, js, and styles.
  $id = md5(rand(9,99999) . time());
  
  $start_js_val = 1;
  $fsstate = "open";
  $content_style = "";
  
  if ($boolStartClosed) {
    $start_js_val = 0;
    $fsstate = "closed";
    $content_style = "display: none;";
  }
  
  $js = "<script type='text/javascript'>
  
  var fieldset_state_$id = $start_js_val;
  
  function toggle_fieldset_$id() {
    
    var content = document.getElementById('content_$id');
    var fs = document.getElementById('fs_$id');
      
    if (fieldset_state_$id == 1) {
      // Already open.  Let's close it.
      fieldset_state_$id = 0;
      content.style.display = 'none';
      fs.className = 'c-fieldset-closed-$id';
    }
    else {
      // Was closed.  let's open it.
      fieldset_state_$id = 1;
      content.style.display = '';
      fs.className = 'c-fieldset-open-$id';      
    }  
  }  
  </script>
  <noscript><b>This page contains collapsible fieldsets which require Javascript
          to function properly.</b></noscript>";
  
  $rtn = "  
    <fieldset class='c-fieldset-$fsstate-$id' id='fs_$id'>
      <legend><a href='javascript: toggle_fieldset_$id();'>$legend</a></legend>
      <div id='content_$id' style='$content_style'>
        $content
      </div>
    </fieldset>
    $js  
    
  <style>
  fieldset.c-fieldset-open-$id {
    border: 1px solid;
  }

  fieldset.c-fieldset-closed-$id {
    border: 1px solid;
    border-bottom-width: 0;
    border-left-width: 0;
    border-right-width: 0;    
  }  
  </style>
    
  ";
  
  
  return $rtn;
}


?>