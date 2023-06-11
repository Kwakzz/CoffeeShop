var loadFile = function(event) {
	var image = document.getElementById('my_profile_pic');
	image.src = URL.createObjectURL(event.target.files[0]);
};