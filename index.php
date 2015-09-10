<?php

if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
}

if (!isset($_GET['page']) || $_GET['page'] == 'home')  
	$page = 'home';
else
	$page = $_GET['page'];
									
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>ELC Preschool - <?php echo $page;?></title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="styles.css"  type="text/css" media="all" timestamp="<?php echo microtime();?>"/>
<link rel="stylesheet" href="kstyles.css" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<?php if ($page == 'home') : ?>
<script type="text/javascript" src="bgPhotoGallery.js"></script>
<?php endif;?>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script>

pageInitialized = false
selectedTopic = 'none'
selectedPage = '<?php echo $page;?>';

bGreen = '#696'
bRed = '#E00'
bBlue = '#09C'

photoFilenames = [
	'girlsAndTeacherPlayground.jpg',
	'boysAndBlocks.jpg',
	'painting.jpg',
	'pastorMarkReading.jpg',
	'girlsInCostume.jpg',
	'boyWateringPlant.jpg',
	'girlCarvingPumpkin.jpg',
	'boysCostume.jpg',
	'snackTime.jpg',
	'peace.jpg',
	'hands.jpg',
	'monkeyBars.jpg',
	'salute.jpg',
	'kitten.jpg'
]	   




$(document).ready(function() {


<?php 

switch ($page) {
	
	case 'home' : ?>
	

		if ( !pageInitialized )
		{
			$('#pageContainer').hide()
			
			setTimeout('isGalleryReady()',500)
			
			bgGallery.init({
						divElement: 'photoGalleryFrame',
						photoDirPath: 'slideshowPhotos',
						width: 576,
						height: 384,
						photoFilenames: photoFilenames,
						})
		}
		
		
		<?php
		break;
		
	case 'about' : ?>
		$('.temp').attr('class','extras')
		$('#moreDetails').hide()
		$('#pageContainer').show()
		<?php
		break;
		
	default : ?>

		$('#pageContainer').show()
		<?php
		break;	
} 

?>

pageInitialized = true

$('#menuBar li').css('cursor','pointer')

$('#menuBar li a[page='+selectedPage+']').parent().css('background-color',bGreen)

$('#menuBar li').add('#topics li').hover(
	function ()
	{
		$(this).css('background-color',bRed)
		$(this).css('color','white')
	},
	function ()
	{
		if ($(this).find('a[page='+selectedPage+']').attr('page') == selectedPage)
			$(this).css('background-color',bGreen)
		else
			$(this).css('background-color','transparent')
		if ($(this).parent().attr('id') == "topics")
		{
			//$(this).css('color','black')
			if ($(this).attr('topic') == selectedTopic)
				$(this).css('background-color',bGreen)
			else
				$(this).css('background-color',bBlue)
		}
		else
			$(this).css('color','black')
	}
)




$('#topics li').click(function ()
	{
		$('.extras').hide()
		theTopic = $(this).attr('topic')
		selectedTopic = $(this).attr('topic')
		$('.extras[topic='+theTopic+']').show()
		
		$('#topics li').css('background-color','#09c')
		$(this).css('background-color','#696')
		
		$('#aboutImg').attr('src','images/'+theTopic+'.jpg')
		$('#moreDetails').show()
		window.location.href = '#topics'
	})






})  // document ready





// waits for the slideshow to be ready before displaying the page
function isGalleryReady()
{
	if (bgGallery.initialized)
		$('#pageContainer').show()
	else
		setTimeout('isGalleryReady()',500)
}

</script>


</head>









<body>


<!-- <div id="pageContainer"> -->

	



	<div class="container">
		<div class="visible-sm visible-md visible-lg" id="header">
		    <h1 id="title" class="blue">Emmanuel Lutheran<br/> Preschool</h1>
		    <h3 id="bibleVerse">&#8220;Let the children come to me.&#8221;  Luke 18:16</h3>
		    <br/>
		</div>
		
		<div class="row" >
			<div class="col-sm-3">
		    	<div class="sidebar-nav customWidthNav" >
		      		<div class="navbar navbar-default" role="navigation">
		        		<div class="navbar-header">
		          			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
		            			<span class="sr-only">Toggle navigation</span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
		          			</button>
		          			<span class="visible-xs navbar-brand">Menu</span>
		        		</div>
		        		<div class="navbar-collapse collapse sidebar-navbar-collapse" id="menuBar">
				          <ul class="nav navbar-nav">
				           	<li ><a href="?page=home" page="home" title="Home" style="color:white;">Home</a></li>
				        	<li><a href="?page=about" page="about" title="About" style="color:white;">About</a></li>
				        	<li><a href="?page=staff" page="staff" title="Staff" style="color:white;">Staff</a></li>
				        	<li><a href="?page=calendar" page="calendar" title="Calendar" style="color:white;">Calendar</a></li>
				        	<li><a href="?page=directions" page="directions" title="Directions" style="color:white;">Directions</a></li>
				        	<li><a href="?page=testimonials" page="testimonials" title="Parent Comments" style="color:white;">Parent Comments</a></li>
				        	<li><a href="?page=downloads" page="downloads" title="Downloads" style="color:white;">Downloads</a></li>
				          </ul>
		        		</div><!--/.nav-collapse -->
		      		</div>
		    	</div>
		  	</div>
		 <div class="col-sm-9">
		    <!--Main content goes here-->

			  <div id="contentContainer" >

			



		    
			    <div><?php include 'pages/'.$page.'.php';?></div>
			    
			    <div class="clear"></div>
			                
				<!-- <div id="crossIcon"><img src="images/stainedGlassCross.jpg" /></div> -->

			</div> <!-- contentContainer -->




		</div>


	 </div>

<!-- footer here-->
	
	<!-- <div class ="col-md-8 footer1">FOOTER</div> -->

	



</div>

<footer>
		<div class="visible-sm visible-md visible-lg container footer1">
		   	<!-- <div class="row">     
		    	hello
		   	</div>

		    <div class="col-sm-4">
		        <div class="text-center">
		        	<p><a href="#">Host Company, Inc.</a><br>
		          	<a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a></p>
		           	<p>social media icons</p>
		        </div>
		     </div> -->

			<div id="address2">    
				<!-- <ul>
		        	<li>2589 Chain Bridge Rd</li>
		        	<li>Vienna, Va  22180</li>
		        	<li>703.938.6187</li>
		        	<li>Email: <a class="small" href="mailto:emmanuelpreschool@verizon.net">emmanuelpreschool@verizon.net</a></li>
		            <li>Contact us, we'd be happy to give you a tour.</li>
				</ul> -->
				
				<p id="addressInfo">
					2589 Chain Bridge Rd
					<br/>
					Vienna, VA 22180
					<br/>
					703.938.6187
					<br/>
					Email:
					<br/>
					Contact us. We'd be happy to give you a tour.
					<br/>

				</p>

				<p id="churchWebsite"><span id="wrapAroundBlock"></span><a href="http://elcvienna.org" title="Emmanuel Lutheran Church website">
					Our preschool is an outreach of Emmanuel Lutheran Church.  
					All are welcome to worship, pray, and serve with us.  Click here to visit the church website.
					</a></p>
			</div>
		 </div>


		 <div class="visible-xs" id="mobileFooter"></div>
</footer>

<!-- </div> --> <!-- pageContainer end-->



	 




	

<!-- <div id="footer" class="col.md-8">

	<div id="address">
		<ul>
        	<li>2589 Chain Bridge Rd</li>
        	<li>Vienna, Va  22180</li>
        	<li>703.938.6187</li>
        	<li>Email: <a class="small" href="mailto:emmanuelpreschool@verizon.net">emmanuelpreschool@verizon.net</a></li>
            <li>Contact us, we'd be happy to give you a tour.</li>
		</ul>
	</div>
    
    <p><span id="wrapAroundBlock"></span><a href="http://elcvienna.org" title="Emmanuel Lutheran Church website">Our preschool is an outreach of Emmanuel Lutheran Church.  All are welcome to worship, pray, and serve with us.  Click here to visit the church website.</a></p>

</div> -->  <!-- footer -->






</div>  <!-- mainContainer -->
</body>
</html>