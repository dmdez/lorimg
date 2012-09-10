<?php
if(isset($_GET)){
	$bgcolor = "cccccc";
	$fgcolor = "ffffff";
	$_width = "300";
	$_height = "200";

    if ( isset($_GET['data']) ) {

        $imagedata = explode('/', $_GET['data']);

        if ( $imagedata ) {

		    if (isset($imagedata[0]) && $imagedata[0] ) {
			    $dimensions = explode('x', $imagedata[0]);

                if ( isset($dimensions[0]) && $dimensions[0] )
				    $_width = $dimensions[0];

			    if ( isset($dimensions[1]) && $dimensions[1] )
				    $_height = $dimensions[1];
		    }

            if ( isset($imagedata[1]) && $imagedata[1] )
			    $bgcolor = $imagedata[1];

		    if ( isset($imagedata[2]) && $imagedata[2] )
			    $fgcolor = $imagedata[2];
	    }
    }

    echo $_width;
    
	  //create_image($_width, $_height, $bgcolor, $fgcolor);
    exit;
}

?>