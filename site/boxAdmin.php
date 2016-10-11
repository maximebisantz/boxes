<!DOCTYPE html>
<html>
	<head>
		<title>Boxes Administration</title>
		<style type="text/css">
            @import url('css/reset.css');
            @import url('css/style.css');
            
            #boxadmin{
            	background: White;
            	margin: 0 auto;
            	width: 500px;
            }
            form{
            	border-bottom: 1px solid green;
            	margin: 0;
            	display: block;
            }
            form * {
            	display: block;
            	margin-bottom: 5px;
            }
            form textarea{
            	width: 100%;
            	height : 100px;
            }
            ul li{
            	display: block;
            	font-size: 10px;
                padding: 10px;
            }
            h1{
            	font-size: 30px;
            	padding: 5px;
            }
            input[type="button"], button{
            	background: green;
            	color: White;
            	border: none;
            	padding: 3px 10px 4px 10px;
            	margin: 3px 3px 3px 0;
            	display: inline-block;
            }
            .message{
            	background: #d4ffcd;
            	font-size: 14px;
            	padding: 3px 10px;
            }
            
            .newForm{
            	background-color: #c5d5c6;
            }
            a#backlink{
            	color: orange;
            	text-decoration: none;
            	position: absolute;
            	right: 50%;
            	border: 1px solid orange;
            	margin-right: -240px;
            	top: 5px;
            	padding: 10px;
            }
            a#backlink:hover{
            	border-color: black;
            	color: black;
            }
        </style>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script type="text/javascript">

			// Retriving all the boxes
    		window.addEventListener('load', function(){
    			getAllBoxes("boxadmin");

				// add new box function
    			document.getElementById('addNew').addEventListener('click', function(){
					createNewBox("new");
        		});

    		})
				
        </script>
	</head>
	<body>
		<div id="boxadmin">
			<div class="header">
				<h1>LIST OF BOXES</h1>
				<a id="backlink" href="/">Back to Page</a>
				<ul id="listOfBoxes">
					<li id="new"><button id="addNew" class="addNew">Add New</button></li>
				</ul>
			</div>
		</div>
	</body>
</html>