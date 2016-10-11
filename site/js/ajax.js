function loadData(url, callback){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			callback(this);
		}
	}
	xhttp.open("GET", url, true);
	xhttp.send();
}

function sendData(url, post, callback){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			callback(this);
		}
	}
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(post);
}

/*
 * SPLASH PAGE 
 */
function retriveContent(box){
	
	loadData("../php/ajax.php?id="+box.target.id, function(obj){
		
		var box = JSON.parse(obj.responseText)
		
		box.target.getElementsByTagName('div')[0].innerHTML = box['text'];
	})
}

window.addEventListener('load', function(){
	
	var boxes = document.getElementsByClassName('box');

	for(var i =0; i <= boxes.length -1; i++){
		var box = boxes[i];
		box.addEventListener('click', retriveContent, true);
	}
})


/*
 * BOX ADMIN
 */
function getAllBoxes(containerId){
	loadData("../php/ajax.php?getallboxes", function(obj){
		
		var allboxes = JSON.parse(obj.responseText);
		var container = document.getElementById(containerId);
		var list = document.createElement('UL');
		list.id = "boxlist";
		
		for(var key in allboxes){
			var item = document.createElement('LI');
			// pass the ID into the json object.
			allboxes[key][2] = key
			// create the form.
			var form = createBoxForm(allboxes[key]);
			item.appendChild(form);
			list.appendChild(item);
		}
		container.appendChild(list);
	})
}

function getBox(id, callback){
	loadData("../php/ajax.php?getboxid=" + id, function(obj){
		
		var box = JSON.parse(obj.responseText);

		var form = createBoxForm(box);
		var item = document.createElement('LI');
		item.appendChild(form);
		var list = document.getElementById('listOfBoxes'); 
		list.insertBefore(item, list.childNodes[2]);
		
		if(typeof callback === 'function'){
			callback();
		}
		
	});
}

function createNewBox(containerId){
	var container = document.getElementById(containerId);
	var obj = {
		'boxid' : 0,
		'title' : "",
		'text'	: ""
	};
	var form = createBoxForm(obj, function(responseText){
		var response = JSON.parse(responseText);
		for(var key in response){
			if(key == 0){
				var form = document.getElementById('form' + key);
				
				var messageContainer = document.createElement('span');
				messageContainer.className = "message";
				var message = document.createTextNode(response[key]);
				messageContainer.appendChild(message);
				form.appendChild(messageContainer);
				
				window.setTimeout(function(){
					form.removeChild(messageContainer);
				}, 3000);
			}else{
				container.removeChild(document.getElementById('form0'));
				getBox(key, function(){
					var form = document.getElementById('form' + key);
					
					var messageContainer = document.createElement('span');
					messageContainer.className = "message";
					var message = document.createTextNode(response[key]);
					messageContainer.appendChild(message);
					form.appendChild(messageContainer);
					
					window.setTimeout(function(){
						form.removeChild(messageContainer);
					}, 3000);
				});
			}
		}
		
	});
	form.className = "newForm";
	container.appendChild(form);
}

function createBoxForm(box, callback){
	
	for(key in box){
		var form = document.createElement('FORM');
		form.method = "POST";
		form.action = "";
		form.id = 'form' + box['boxid'];
		
		var inputId = document.createElement('input');
		inputId.type = "hidden";
		inputId.name = "id";
		inputId.value = box['boxid'];
	
		var inputIdShow = document.createElement('span');
		inputIdShow.innerHTML = box['boxid'];
		
		var inputTitle = document.createElement('input');
		inputTitle.type = "text";
		inputTitle.name = "title";
		inputTitle.value = box['title'];
		
		var boxText = document.createElement('textarea');
		boxText.name="text";
		boxText.value = box['text'];
		
		var saveButton = document.createElement('input');
		saveButton.type = "button";
		saveButton.value = "save";
		saveButton.id = "button" + box['boxid'];
		saveButton.addEventListener('click', function(){
			var id = this.form.id.value;
			var title = this.form.title.value;
			var text = this.form.text.value;
			var post = "boxid=" + id + "&title=" + title + "&text=" + text;
	
			
			// Submit the form
			sendData("../php/ajax.php?save", post, function(obj){
				// fetching the response in JSON
				console.log(obj.responseText);
				var response = JSON.parse(obj.responseText);
				

				if(typeof callback === "function"){
					callback(obj.responseText);
				}else{
					for(var key in response){
						
						// get the source form and display message;
						message(key, response[key]);
					}
				}				
			})
	});
	
	var deleteButton = document.createElement('input');
	deleteButton.type = "button";
	deleteButton.value = "delete";
	deleteButton.id = "delete" + box['boxid'];
	deleteButton.addEventListener('click', function(){
		deleteBox(box['boxid']);
		
	});
	
	form.appendChild(inputId);
	form.appendChild(inputTitle);
	form.appendChild(boxText);
	form.appendChild(saveButton);
	form.appendChild(deleteButton);
	}
	return form;
}

function deleteBox(boxId){
	var post = "boxid=" + boxId;
	sendData("../php/ajax.php?delete", post, function(obj){
		
		var response = obj.responseText;
		
		var form = document.getElementById('form' + boxId);
		
		var messageContainer = document.createElement('div');
		messageContainer.className = "message";
		var mess = document.createTextNode(response);
		messageContainer.appendChild(mess);
		form.parentNode.appendChild(messageContainer);
		form.style.opacity = "0.3";
		
		window.setTimeout(function(){
			form.parentNode.removeChild(messageContainer);
			// remove the deleted box's form
			var parent = form.parentNode.parentNode;
			parent.removeChild(form.parentNode);
		}, 2000);

		
	});
}

function message(boxId, message){
	var form = document.getElementById('form' + boxId);
	
	var messageContainer = document.createElement('span');
	messageContainer.className = "message";
	var mess = document.createTextNode(message);
	messageContainer.appendChild(mess);
	form.appendChild(messageContainer);
	
	window.setTimeout(function(){
		form.removeChild(messageContainer);
	}, 2000);
	
}

