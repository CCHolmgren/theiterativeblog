(function(){
	var prevent = false;
	function preventReload(){
		if(prevent){
			return "Think of the kittens";	
		}
	}
	window.onbeforeunload = preventReload;
	document.querySelectorAll("#new-article input, #new-article textarea").forEach(function(element){
		element.onfocus = function(){
			prevent = true;	
		}
	});
	document.getElementById("new-article").onsubmit = function(){
		prevent = false;
	}
}())