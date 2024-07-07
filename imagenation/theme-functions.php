<?php

/* <?php include ('theme-functions.php'); ?> */

function getAlbumDescAlt() { 
	  if(!in_context(ZP_ALBUM)) return false;
	  global $_zp_current_album;
	  return str_replace("\n", " ", $_zp_current_album->getDesc());
	}

function printAlbumDescAlt($editable=false) { 
	  global $_zp_current_album;
	  if ($editable && zp_loggedin()) {
	    echo "<div id=\"albumDescEditable\" style=\"display: block;\">" . truncate_string(getAlbumDescAlt(),120) . "</div>\n";
	    echo "<script>initEditableDesc('albumDescEditable');</script>";
	  } else {
	    echo  truncate_string(getAlbumDescAlt(),110);  
	  }
	}

?>