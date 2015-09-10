
/*
The bgGallery object provides a slideshow that shifts images left or right.

Within the slideshow div there are two filmstrip divs each containing three image blocks.

The middle image in the filmstrip is the image appearing on the screen.  The image blocks on the left and right of middle
are hidden but they will appear when a slide right/left button is pressed.

When the move Right/Left button is pressed the visible filmstrip slides.  Next the invisible filmstrip
is rebuilt and made visible.  Then the filmstrip that was previously visible is made invisible and is ready for the next
action.

Only images that are needed are loaded.

*/

function imgObject ()
{
	this.image = new Image()
	this.loaded = false
}


var bgGallery = 
{
	pictureWidth: 576,
	photosDirPath: null,
	photoFilenames: null,
	slideRate: 2000,
	
	busy: true,  // used to ignore user input when animation is active
	initialized: false,  // returns true when the gallery is ready for display after initialization
	container: null,
	photos: new Array(),
	numPhotos : null,
	selectedPhoto: 0,
	visibleFilmstrip: 0,
	invisibleFilmstrip: 1,
	activeFilmstrip: 0,
	filmstrip: [{'domElement':null, 'photosIndex':[0,1,2]},
				{'domElement':null, 'photosIndex':[0,1,2]}
				],
	
	init: function (args)
	{
		var i

		
		this.container = $('#'+args.divElement)
		this.photosDirPath = args.photoDirPath
		this.photoFilenames = args.photoFilenames
		
		
		// load the frame with HTML elements
		bgHTML = '<div id="slideContainer">'
		bgHTML += '<div id="filmstripA" class="filmstrip"><img position="left" class="slideshowPhoto"/><img position="middle" class="slideshowPhoto"/><img position="right" class="slideshowPhoto"/></div>'
		bgHTML += '<div id="filmstripB" class="filmstrip"><img position="left" class="slideshowPhoto"/><img position="middle" class="slideshowPhoto"/><img position="right" class="slideshowPhoto"/></div>'
		bgHTML += '<img id="firstPhoto" />'  // this photo is displayed while the gallery loads
		bgHTML += '</div>'  // slideContainer

		// if more than 1 photo then add a slideshow control bar
		if (this.photoFilenames.length > 1)
			bgHTML += '<div id="bgControlButtonsContainer"><a id="bgGalleryMoveRightButton" onclick="bgGallery.moveLeft()" title="Next Slide">Next Picture</a><a id="bgGalleryMoveLeftButton" onclick="bgGallery.moveRight()" title="Previous Slide">Previous Picture</a></div>'
		$(this.container).html(bgHTML)
		
		

		// initialize the filmstrip object with the A and B filmstrip divs
		this.filmstrip[0].domElement = $(this.container).find('#filmstripA')
		this.filmstrip[1].domElement = $(this.container).find('#filmstripB')

		// create an array of empty image objects
		for (i=0; i<this.photoFilenames.length; i++)
		{
		this.photos[i] = new imgObject()
		}

		this.numPhotos = this.photos.length
		
		// load the temporary first photo placeholder
		$(this.container).find('#firstPhoto').attr('src',this.photosDirPath+'/'+this.photoFilenames[0]);
		this.initialized = true;
		
		
		// load the first filmstrip
		this.resetFilmstrip()
	},
	
	loadImages: function ()
	{
		
		for (i=0; i<3; i++)
		{
			index = this.filmstrip[this.invisibleFilmstrip].photosIndex[i]
			if (!this.photos[index].loaded)
				{
					this.photos[index].image.src = this.photosDirPath+'/'+this.photoFilenames[index]
					this.photos[index].loaded = true
				}
		}
		
	},
	
	checkIfImagesLoaded : function ()
	{
		var imagesLoaded
		
		imagesLoaded = true;
		for (i=0; i<3; i++)
		{
			index = this.filmstrip[this.invisibleFilmstrip].photosIndex[i]
		
			if (!this.photos[index].image.complete)
				imagesLoaded = false;
		}
		
		if (imagesLoaded)
		{
			bgGallery.displayFilmstrip()
		}
		else
			setTimeout("bgGallery.checkIfImagesLoaded()",500);
	
	},
		
	resetFilmstrip: function ()
	{		

		this.filmstrip[this.invisibleFilmstrip].photosIndex[0] = (this.selectedPhoto+this.numPhotos-1) % this.numPhotos
		this.filmstrip[this.invisibleFilmstrip].photosIndex[1] = this.selectedPhoto
		this.filmstrip[this.invisibleFilmstrip].photosIndex[2] = (this.selectedPhoto+1) % this.numPhotos
		
		
		this.loadImages()
		
		this.checkIfImagesLoaded()
		
	},
	
	displayFilmstrip: function ()
	{
		domObj = $(this.filmstrip[this.invisibleFilmstrip].domElement)
		$(domObj).css('left','-'+this.pictureWidth+'px');
		$(domObj).find('img[position=left]').attr('src',this.photos[this.filmstrip[this.invisibleFilmstrip].photosIndex[0]].image.src);
		$(domObj).find('img[position=middle]').attr('src',this.photos[this.filmstrip[this.invisibleFilmstrip].photosIndex[1]].image.src);
		$(domObj).find('img[position=right]').attr('src',this.photos[this.filmstrip[this.invisibleFilmstrip].photosIndex[2]].image.src);
		$(domObj).show()
		this.busy = false
		
		// show the buttons control bar
		$('#bgControlButtonsContainer').show()
		// hide the temp startup photo div
		$('#firstPhoto').hide()
		
		
		bgGallery.swapFilmstrip()
	},
		
	moveRight: function () 
	{
		if (!this.busy)
		{
			this.busy = true
			obj = this
			$(this.filmstrip[this.visibleFilmstrip].domElement).animate(
				{left: '0px'},
				this.slideRate, 
				'linear',
				function() {
					obj.selectedPhoto = (obj.selectedPhoto + obj.numPhotos - 1) % obj.numPhotos
					bgGallery.resetFilmstrip()
					}
				)
		}
	},

		
	moveLeft: function () 
	{
		if (!this.busy)
		{
			this.busy = true
			obj = this
			$(this.filmstrip[this.visibleFilmstrip].domElement).animate(
				{left: (-2*obj.pictureWidth) + 'px'},
				this.slideRate, 
				function() {
					obj.selectedPhoto = (obj.selectedPhoto + 1) % obj.numPhotos
					bgGallery.resetFilmstrip()
					}
				)
		}
	},

	swapFilmstrip: function ()
	{		
		$(this.filmstrip[this.visibleFilmstrip].domElement).hide()
		
		this.visibleFilmstrip = (this.visibleFilmstrip + 1) % 2
		this.invisibleFilmstrip = (this.invisibleFilmstrip + 1) % 2
						
	},
	
	
}  // bgGallery

