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

	create_image($_width, $_height, $bgcolor, $fgcolor);
    exit;
}


function create_image($width, $height, $bg_color, $txt_color )

{

    $text = "$width X $height";

    //Create the image resource 
    $image = ImageCreate($width, $height);
    
	//Making of colors, we are changing HEX to RGB
    $bg_color = ImageColorAllocate($image, 
                base_convert(substr($bg_color, 0, 2), 16, 10), 
                base_convert(substr($bg_color, 2, 2), 16, 10), 
                base_convert(substr($bg_color, 4, 2), 16, 10));


    $txt_color = ImageColorAllocate($image, 
                base_convert(substr($txt_color, 0, 2), 16, 10), 
                base_convert(substr($txt_color, 2, 2), 16, 10), 
                base_convert(substr($txt_color, 4, 2), 16, 10));

    //Fill the background color 
    ImageFill($image, 0, 0, $bg_color); 
    
	//Calculating font size   
    $fontsize = ($width>$height)? ($height / 10) : ($width / 10) ;
    
    //Inserting Text    
    imagettftext($image,$fontsize, 0, 
                    ($width/2) - ($fontsize * 2.75), 
                    ($height/2) + ($fontsize* 0.2),  
                    $txt_color, 'Amble-Regular.ttf', $text);


    //Tell the browser what kind of file is come in 
    header("Content-Type: image/png"); 
    
	//Output the newly created image in png format 
    imagepng($image);   
    
	//Free up resources
    ImageDestroy($image);
}

?>