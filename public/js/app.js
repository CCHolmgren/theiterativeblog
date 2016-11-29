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
	var element = document.getElementById("new-article");
		if(element){
			element.onsubmit = function(){
			prevent = false;
		}
	} 
}())