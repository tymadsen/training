
function ImagePreloader(images, call_back){

	// store the call-back
	this.call_back = call_back;

	// initialize internal state.
	this.nLoaded = 0;
	this.nProcessed = 0;
	this.aImages = new Array;

	// record the number of images.
	this.nImages = images.length;

	// for each image, call preload()
	for ( var i = 0; i < images.length; i++ ){
	  this.preload(images[i]);
	}
}
//The call-back function is stored for later use, then each image URL is passed into the preload() method.

ImagePreloader.prototype.preload = function(image){

	// create new Image object and add to array
	var oImage = new Image;
	this.aImages.push(oImage);

	// set up event handlers for the Image object
	oImage.onload = ImagePreloader.prototype.onload;
	oImage.onerror = ImagePreloader.prototype.onerror;
	oImage.onabort = ImagePreloader.prototype.onabort;

	// assign pointer back to this.
	oImage.oImagePreloader = this;
	oImage.bLoaded = false;

	// assign the .src property of the Image object
	oImage.src = "../../uploads/"+image;
}

/**The preload function creates an Image object and assigns functions for the three Image events; 
onload, onerror and onabort. The onload event is raised when the image has been loaded into memory, 
the onerror event is raised when an error occurs while loading the image and the onabort event is 
raised if the user cancels the load by clicking the Stop button on the browser.

A pointer to the ImagePreloader object is stored in each Image object to facilitate the call-back mechanism. 
An optional boolean flag can be added here to indicate whether the image loads properly or not.

Finally, the “src” attribute is assigned to start the loading of the image.*/

ImagePreloader.prototype.onComplete = function(){
	this.nProcessed++;
	if ( this.nProcessed == this.nImages ){
		this.call_back(this.aImages, this.nLoaded);
	}
}

ImagePreloader.prototype.onload = function(){
	this.bLoaded = true;
	this.oImagePreloader.nLoaded++;
	this.oImagePreloader.onComplete();
}

ImagePreloader.prototype.onerror = function(){

	this.bError = true;
	this.oImagePreloader.onComplete();
}

ImagePreloader.prototype.onabort = function(){
	this.bAbort = true;
	this.oImagePreloader.onComplete();
}
