<!DOCTYPE html>
<html>
	<head>
		<title>Moving boxes Example</title>
		<style type="text/css">
            @import url('css/reset.css');
        </style>
		<style type="text/css">
            html{
            	background: black;
            	height: 100%;
            	position: relative;
            }
            body{
            	font-family : Arial;
            	min-height: 100%;
            	position: relative;
            }
            .box {
            	overflow: hidden;
            	height: 500px;
            	width : 30px;
             	float : left;
            	background-color: blue;
            	color: White;
            	padding: 3px;
            	font-size: 0;
            	position: relative;
            	padding: 30px;
            }
            
            .box span{
            	font-weight: bold;
            	font-size: 30px;
            	position: absolute;
            	border: 1px solid red;
            }
            
            #test{
            	width: 50px;
            	height: 50px;
            	background: yellow;
            }
        </style>
        <script type="text/javascript">

			window.onload = function(){
	        	var boxes = document.getElementsByClassName('box');


	        	for (var i=0; i <= boxes.length -1; i++){
					var box = boxes[i];
					box.addEventListener('click', openBox, true);
					box.firstChild.style.transform = "rotate(-90deg)";
					box.firstChild.style.transformOrigin = "left top 0";
					box.firstChild.style.bottom = "0";					
				}

		        function openBox(box){
			        console.log('open');

			        if(box.stopPropagation){
				        console.log('open stop propagation');
			        	box.stopPropagation();
					};

			        var box = this;
					console.log(box);
	        		        
			        for (var i=0; i <= boxes.length -1; i++){
						var currentbox = boxes[i];
						if(currentbox.isopen == true){
							console.log('IS OPEN');
							closeBox(currentbox);
						}
					}
					var width = 30;
			        var openInterval = window.setInterval(function(){
						box.style.width = width + 1 + "px";
						width++;
						if(width == 300){
							window.clearInterval(openInterval);
							box.isopen = true;
							console.log('opening is done');
						}
			        }, 2);

					box.style.fontSize="10px";
					box.firstChild.style.transform = "rotate(0deg)";
					box.firstChild.style.top = "0";
	        

			        box.removeEventListener('click', openBox, true);
			        box.addEventListener('click', closeBox, true);	
		        }

		        function closeBox(box){
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

					var width = 300;
					box.firstChild.style.transform = "rotate(-90deg)";
					box.firstChild.style.bottom = "0";
					box.firstChild.style.top = "";
					box.style.fontSize = 0;
			       	
			        var closeInterval = window.setInterval(function(){
			        	box.style.width = width - 1 + "px";
				        width--;
				        if(width < 30){
					        console.log('closing is done');
					        window.clearInterval(closeInterval);
					        box.isopen = false;
					        box.removeEventListener('click', closeBox, true);
					        box.addEventListener('click', openBox, true);
					        box.style.fontSize="0px";
				        }
			        }, 2);
		        }
			}
        </script>
	</head>
	<body>
		<div class="box box1"><span>TITLE</span><div id="test"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus dolor eget ligula tristique rhoncus. Donec non mi a dolor porta euismod. Proin vel quam dui. Duis quis interdum justo. Vestibulum nisi ante, venenatis non viverra vel, pellentesque congue metus. Sed vitae pellentesque neque, vitae facilisis est. Nulla eleifend justo et lacus ullamcorper, sed fermentum massa condimentum.</div>
		<div class="box box2"><span>TITLE</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus dolor eget ligula tristique rhoncus. Donec non mi a dolor porta euismod. Proin vel quam dui. Duis quis interdum justo. Vestibulum nisi ante, venenatis non viverra vel, pellentesque congue metus. Sed vitae pellentesque neque, vitae facilisis est. Nulla eleifend justo et lacus ullamcorper, sed fermentum massa condimentum.</div>
		<div class="box box3"><span>TITLE</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus dolor eget ligula tristique rhoncus. Donec non mi a dolor porta euismod. Proin vel quam dui. Duis quis interdum justo. Vestibulum nisi ante, venenatis non viverra vel, pellentesque congue metus. Sed vitae pellentesque neque, vitae facilisis est. Nulla eleifend justo et lacus ullamcorper, sed fermentum massa condimentum.</div>
		<div class="box box4"><span>TITLE</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus dolor eget ligula tristique rhoncus. Donec non mi a dolor porta euismod. Proin vel quam dui. Duis quis interdum justo. Vestibulum nisi ante, venenatis non viverra vel, pellentesque congue metus. Sed vitae pellentesque neque, vitae facilisis est. Nulla eleifend justo et lacus ullamcorper, sed fermentum massa condimentum.</div>
	</body>
</html>