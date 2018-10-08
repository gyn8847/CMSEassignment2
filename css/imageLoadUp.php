<html>
<head>
<title>PHP File Upload example</title>
</head>
	<meta charset="UTF-8">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.8/interact.min.js"></script>
    	<style>
        #drag-1
	{
        	width: 25%;
        	height: 100%;
        	min-height: 6.5em;
        	margin: 10%;
        	background-color: #29e;
        	color: white;
        	border-radius: 0.75em;
        	padding: 4%;
        	-webkit-transform: translate(0px, 0px);
        	transform: translate(0px, 0px);
        }
   	</style>
	<body>
		<form enctype="multipart/form-data" method="post">
		<p>Select image:</p>
		<input type="file" name="file"><br/>
		<input type="submit" value="upload" name="submitImage"> <br/>
		</form>
			<form action="imageDragTree.html">
			<button type="submit" formaction = "imageDragTree.html" style="margin-bottom: 100px 0px">Drag a tree ►</button>
		</form>
 		<div id="demo">
        		<div id="drag-1" class="draggable">
            			<p> You can drag one element </p>
        		</div>
    		</div>
	</body>
</html>

<?php
	if(isset($_POST['submitImage']))
	{ 
		$filepath = "images/" . $_FILES["file"]["name"];
 
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) 
		{
			echo "<img src=".$filepath." min-height=300 min-width=450 />";
		} 
		else 
		{
			echo "Error!";
		}
	} 
?>

    <script>
	    
    // target elements with the "draggable" class
    interact('.draggable')
        .draggable({
            // enable inertial throwing
            inertia: true,
            // keep the element within the area of it's parent
            restrict: {
                restriction: "parent",
                endOnly: true,
                elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
            },
            // enable autoScroll
            autoScroll: true,
            onstart: function (event) {
                console.log('onstart');
            },
            // call this function on every dragmove event
            onmove: dragMoveListener,
            // call this function on every dragend event
            //onend: function (event) {
            //    console.log('onend');
            //    var textEl = event.target.querySelector('p');
            //    textEl && (textEl.textContent =
            //        'moved a distance of '
            //        + (Math.sqrt(event.dx * event.dx +
            //            event.dy * event.dy)|0) + 'px');
            }
        });
    function dragMoveListener (event) {
        console.log('dragMoveListener');
        var target = event.target,
            // keep the dragged position in the data-x/data-y attributes
            x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
            y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
        // translate the element
        target.style.webkitTransform =
            target.style.transform =
                'translate(' + x + 'px, ' + y + 'px)';
        // update the position attributes
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    }
	    
    </script>
