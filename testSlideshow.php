<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>ELC Preschool</title>
<link href="styles.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="bgPhotoGallery.js"></script>

<script>

photoFilenames = [
	'twoKidsClassroom.jpg',
	'pastorMarkReading.jpg',
	'girlsInCostume.jpg'
]


$(document).ready(function () {
							
	bgGallery.init({
			divElement: 'slideshowFrame',
			photoDirPath: 'slideshowPhotos',
			width: 576,
			height: 384,
			photoFilenames: photoFilenames,
			})
	
})
</script>

</head>

<body>


        
<div id="slideshowPage">

	<div id="slideshowFrame">
    <!--
        <div id="filmstripA" class="filmstrip">
            <img position="left" class="slideshowPhoto"/>
            <img position="middle" class="slideshowPhoto"/>
            <img position="right" class="slideshowPhoto"/>
        </div>
        <div id="filmstripB" class="filmstrip">
            <img position="left" class="slideshowPhoto"/>
            <img position="middle" class="slideshowPhoto"/>
            <img position="right" class="slideshowPhoto"/>
        </div>
        <div id="bgControlButtonsContainer">
        	<a id="bgGalleryMoveRightButton" onclick="bgGallery.moveRight()"/>
        	<a id="bgGalleryMoveLeftButton" onclick="bgGallery.moveLeft()"/>
        </div>
        
        -->
	</div>      
        
</div>
        
	


</body>
</html>