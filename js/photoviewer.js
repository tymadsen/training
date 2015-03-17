
var p_left,p_right;
var photo_set = Array();
var view_pos;
function init(){
	//$('#image_url').hide();
	$('#uploadbtn').hide();
	p_left = true;
	p_center = false;
	p_right = false;

	$('#larrow').click(goLeft).fadeTo(0,.5);
	$('#rarrow').click(goRight).fadeTo(0,.5);
	
}

function goLeft(){
	if(!p_left){
		$('#rarrow').fadeTo(0,1);
		view_pos--;
		showPhotos(photo_set,view_pos);
		/*$('#slider').animate({
			left: '+=710px'
		},1000);*/
	}
}

function goRight(){
	if(!p_right){
		$('#larrow').fadeTo(0,1);	
		view_pos++;
		showPhotos(photo_set,view_pos);
		/*$('#slider').animate({
			left: '-=710px'
		},1000);*/
	}
}
function upload_photo(){
	var url = $('#image_url').val();
	var img_name = url.split("\\").pop();
	var submit = confirm("Are you sure you want to upload "+ img_name+"?");
	if(submit){
		$('#uploadbtn').click();
	}else{
		//$('#image_url').off('change');
		$('#image_url').val("");
		//$('#image_url').change('change');
	}
}
//shows the array of images in the set at index
function showPhotos(images, index){
	view_pos = index;
	var img = null;//document.getElementById('image_url').value;
	var imgs_to_show = images[index];
	var max_images = imgs_to_show.length;//images.length<12 ? images.length : 12;
	for(var i = 0; i < max_images;i++){
		img = imgs_to_show[i];//images[i];
		var container = $('.photo').eq(i);
		container.empty().append('<canvas id="img'+(4*index)+i+'" height="'+container.height()+'" width="'+container.width()+'"></canvas>');
		var canvas = container.children('canvas').eq(0);
		var ctx = canvas.get(0).getContext('2d');
		//var img = new Image();//$('<img src='+url+' alt="image">')[0];
		if(img != ""){
			var img_attr = getImageAttr(img,container);
			ctx.drawImage(img,img_attr[0],img_attr[1],img_attr[2],img_attr[3]);	
		}
		//img.src = url;
		
	}
	p_right = (view_pos == photo_set.length-1);
	p_left = (view_pos == 0);
	if(p_right)
		$('#rarrow').fadeTo(0,.5);
	else
		$('#rarrow').fadeTo(0,1);
	if(p_left)
		$('#larrow').fadeTo(0,.5);
	else
		$('#larrow').fadeTo(0,1);
}

function getImageAttr(image, container){

	
	var w_scale = container.width() > image.width ? 1 : container.width()/image.width;
	var h_scale = container.height() > image.height ? 1 : container.height()/image.height;
	var scale = w_scale > h_scale ? h_scale : w_scale;
	var width = scale*image.width;
	var height = scale*image.height;
	var offset_top = (container.height()-height)/2;
	var offset_left = (container.width()-width)/2;
	return [offset_left, offset_top,width,height];

}

function split_array(array, set_size){
	var image_sets = Array();
	var sets = Math.ceil(array.length/set_size);
	for(var j = 0;j<sets;j++){
		var temp_array = Array();
		for(var i = j*set_size;i < (j+1)*set_size;i++){
			if(array[i] != undefined)
				temp_array.push(array[i]);
			else
				temp_array.push("");
		}
		image_sets.push(temp_array);
	}
	return image_sets;
}

function onPreload(aImages, nImages){

	if ( nImages != aImages.length ){
	  alert("Images did not load properly");
	  return;
	}
	photo_set = split_array(aImages,4);
	
	showPhotos(photo_set,0);

// now create some elaborate tree structure using the preloaded images
}