window.onload = function(){
	var boxes = document.getElementsByClassName('box');
	 
	for (var i=0; i <= boxes.length -1; i++){
		var box = boxes[i];
	
		//space out the boxes
		box.style.left = i * 0 + "px";
	
		//set a position int to the box
		box.initPosition = i * 0;
	
		box.addEventListener('click', openBox, true);
		box.firstChild.style.transform = "rotate(-90deg)";
		box.firstChild.style.transformOrigin = "left top 0";
		box.firstChild.style.bottom = "0";
		
		//set up the height according the browser
		var browserHeight = window.innerHeight;
		box.style.height = browserHeight + "px";
	
	}
	
	function openBox(box){
	    console.log('open');
	
	    if(box.stopPropagation){
	        console.log('open stop propagation');
	    	box.stopPropagation();
		};
	
	    var box = this;
		console.log(box);
		        
		// Close other boxes
	    for (var i=0; i <= boxes.length -1; i++){
			var currentbox = boxes[i];
			if(currentbox.isopen == true){
				console.log('IS OPEN');
				closeBox(currentbox, true);
			}
		}
	
	    for (var i = boxes.length -1; i >= 0; i--){
			console.log("	the box is: " + boxes[i]);
			if(boxes[i] == box){
				break;
			}
			//moveBox(boxes[i]);
		} 
	
		
	
		// open the box
		var width = 30;
		box.style.zIndex = "1000";
	    var openInterval = window.setInterval(function(){
			box.style.width = width + 1 + "px";
			width++;
			if(width == 300){
				box.style.zIndex = "0";
				window.clearInterval(openInterval);
				box.isopen = true;
				box.getElementsByTagName('span')[0].className = "open";
				box.style.overflow = 'auto';
				console.log('opening is done');
			}
	    }, 2);
	
		box.style.fontSize="10px";
		box.firstChild.style.transform = "rotate(0deg)";
		box.firstChild.style.top = "0";
	
	
	    box.removeEventListener('click', openBox, true);
	    box.addEventListener('click', closeBox, true);	
	}
	
	function closeBox(box, closefast){
		if(box.stopPropagation){
			console.log('close stop propagation');
	    	box.stopPropagation();
		}
		
	    console.log('close');
		if (!box.target){
			var box = box;
		}else{
			box = this;
		}
	
		console.log(box);
	
		for (var i = boxes.length -1; i >= 0; i--){
			console.log("	the box is: " + boxes[i]);
			if(boxes[i] == box){
				break;
			}
			//moveBackBox(boxes[i]);
		} 
	
		box.firstChild.style.transform = "rotate(-90deg)";
		box.firstChild.style.bottom = "0";
		box.firstChild.style.top = "";
		box.style.fontSize = 0;
		box.style.overflow = 'hidden';
	
		var width = 300;
		if(closefast == true){
			box.style.width = "30px";
	        box.isopen = false;
			box.getElementsByTagName('span')[0].className = "closed";
	        box.removeEventListener('click', closeBox, true);
	        box.addEventListener('click', openBox, true);
	        box.style.fontSize="0px";
		}else{
		    var closeInterval = window.setInterval(function(){
		    	box.style.width = width - 1 + "px";
		        width--;
		        if(width < 30){
			        console.log('closing is done');
			        window.clearInterval(closeInterval);
			        box.isopen = false;
					box.getElementsByTagName('span')[0].className = "closed";
			        box.removeEventListener('click', closeBox, true);
			        box.addEventListener('click', openBox, true);
			        box.style.fontSize="0px";
		        }
		    }, 3);
		}
	}
	
	function moveBox(box){			        
	    var i = 0;
	   	var moving = window.setInterval(function(){
	       	box.style.left = box.initPosition + i + "px";
	       	i++;
	       	if(i == 272){
		       	window.clearInterval(moving);
	       	}
	   	}, 2);
	}
	
	function moveBackBox(box){
	    var i = 272;
	   	var moving = window.setInterval(function(){
	       	box.style.left =  i + "px";
		       	i--;
		       	if(i == box.initPosition){
			       	window.clearInterval(moving);
		       	}
	       	}, 2);
	
		}

    
}