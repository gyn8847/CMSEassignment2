<!DOCTYPE html>
<html>
<head>
	<title>Plant A Tree</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	.slidecontainer 
	{
   		width: 25%;
	}

	.slider 
	{
    		-webkit-appearance: none;
    		width: 100%;
    		height: 15px;
		margin-top: 15px;
    		border-radius: 5px;
    		background: #d3d3d3;
    		outline: none;
    		opacity: 0.7;
    		-webkit-transition: .2s;
    		transition: opacity .2s;
	}

	.slider:hover
	{
   		opacity: 1;
	}

	.slider::-moz-range-thumb
	{
    		width: 23px;
    		height: 24px;
    		border: 0;
    		cursor: pointer;
	}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.8/interact.min.js"></script>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/cart.css" />
	<link rel="stylesheet" href="css/custom_select.css" />

</head>
<body>
	
	<div class="container">
	
	<!-- Side Nav Menu -->
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<form class="example" action="searchresults.php" method="post">
			<input type="text" placeholder="Search.." name="search">
			<button type="submit" style="margin-top:5px;"><i class="fa fa-search"></i></button>
		</form>	  
		<a href="index.php">Browse</a>
		<button class="dropdown-btn">Account 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="image_drag.php">Image Dragger</a>
			<a href="orders.php">Orders</a>
			<a href="logut.php">Logout</a>
		</div>
		<a href="cart.php">Cart</a>
	</div>
	
	<!-- Menu slideout button -->
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
	<hr />
	
	<p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
	<p><label for="file" style="cursor: pointer;">Upload Garden Image</label></p>
	
	<form action="image_drag.php" method="post">
	<div class="custom-select" style="width:200px;">
	<select name="image_name">
	<option>Select Tree</option>
	<?php
	
	require 'db_connect.php';
	
	$query = "SELECT * FROM product WHERE type='tree'";
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		do
		{
			echo "<option value='".$product["image"]."'>".$product["name"]."</option>";
		}
		while($product = $result->fetch_assoc());
	}
		
	?>
	</select>
	</div>
	<br/>
	<input type="submit" name="submitBtn" value="Insert Tree" style="
	background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;"/>
	</form>

	<div class="slidecontainer">
  		<input type="range" min="5" max="50" value="25" class="slider"  id="myRange">
  	<p>Tree Distance: <span id="demo"></span>m</p>
	</div>
	
	<?php
	
	if(isset($_POST["image_name"]))
	{
		$imgName = $_POST["image_name"];
		//echo $imgName;
	}
	else
	{
		echo "";
	}
	
	?>
	
	<div id="container">
        <div id="drag-1" class="draggable">
            <img id="output" class="img-responsive" width="300px" height="300px" />
        </div>
        <div id="drag-2" class="draggable">
			<img src="images/<?php echo $imgName ?>" class="img-responsive" width="600px" height="600px" />
        </div>
	</div>
	
	
	<script>
	/*Loads the uploaded image and displays it*/
	var loadFile = function(event) 
	{
		var image = document.getElementById('output');
		image.src = URL.createObjectURL(event.target.files[0]);
	};
	</script>
	
	
	<script>
	function openNav() 
	{
		document.getElementById("mySidenav").style.width = "250px";
	}

	function closeNav() 
	{
		document.getElementById("mySidenav").style.width = "0";
	}
	</script>
	
	<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
	  dropdown[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		if (dropdownContent.style.display === "block") {
		  dropdownContent.style.display = "none";
		} else {
		  dropdownContent.style.display = "block";
		}
	  });
	}
	</script>
	
	<script>
    // target elements with the "draggable" class
    interact('.draggable')
        .draggable({
            // enable inertial throwing
            inertia: true,
            
            // enable autoScroll
            autoScroll: true,
            onstart: function (event) {
                console.log('onstart');
            },
            // call this function on every dragmove event
            onmove: dragMoveListener,
            // call this function on every dragend event
            onend: function (event) {
                console.log('onend');
                var textEl = event.target.querySelector('p');
                textEl && (textEl.textContent =
                    'moved a distance of '
                    + (Math.sqrt(event.dx * event.dx +
                        event.dy * event.dy)|0) + 'px');
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
	
	<script>
	var x, i, j, selElmnt, a, b, c;
	/*look for any elements with the class "custom-select":*/
	x = document.getElementsByClassName("custom-select");
	for (i = 0; i < x.length; i++) {
	  selElmnt = x[i].getElementsByTagName("select")[0];
	  /*for each element, create a new DIV that will act as the selected item:*/
	  a = document.createElement("DIV");
	  a.setAttribute("class", "select-selected");
	  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
	  x[i].appendChild(a);
	  /*for each element, create a new DIV that will contain the option list:*/
	  b = document.createElement("DIV");
	  b.setAttribute("class", "select-items select-hide");
	  for (j = 1; j < selElmnt.length; j++) {
		/*for each option in the original select element,
		create a new DIV that will act as an option item:*/
		c = document.createElement("DIV");
		c.innerHTML = selElmnt.options[j].innerHTML;
		c.addEventListener("click", function(e) {
			/*when an item is clicked, update the original select box,
			and the selected item:*/
			var y, i, k, s, h;
			s = this.parentNode.parentNode.getElementsByTagName("select")[0];
			h = this.parentNode.previousSibling;
			for (i = 0; i < s.length; i++) {
			  if (s.options[i].innerHTML == this.innerHTML) {
				s.selectedIndex = i;
				h.innerHTML = this.innerHTML;
				y = this.parentNode.getElementsByClassName("same-as-selected");
				for (k = 0; k < y.length; k++) {
				  y[k].removeAttribute("class");
				}
				this.setAttribute("class", "same-as-selected");
				break;
			  }
			}
			h.click();
		});
		b.appendChild(c);
	  }
	  x[i].appendChild(b);
	  a.addEventListener("click", function(e) {
		  /*when the select box is clicked, close any other select boxes,
		  and open/close the current select box:*/
		  e.stopPropagation();
		  closeAllSelect(this);
		  this.nextSibling.classList.toggle("select-hide");
		  this.classList.toggle("select-arrow-active");
	  });
	}
	function closeAllSelect(elmnt) {
	  /*a function that will close all select boxes in the document,
	  except the current select box:*/
	  var x, y, i, arrNo = [];
	  x = document.getElementsByClassName("select-items");
	  y = document.getElementsByClassName("select-selected");
	  for (i = 0; i < y.length; i++) {
		if (elmnt == y[i]) {
		  arrNo.push(i)
		} else {
		  y[i].classList.remove("select-arrow-active");
		}
	  }
	  for (i = 0; i < x.length; i++) {
		if (arrNo.indexOf(i)) {
		  x[i].classList.add("select-hide");
		}
	  }
	}
	/*if the user clicks anywhere outside the select box,
	then close all select boxes:*/
	document.addEventListener("click", closeAllSelect);
	
	</script>
	
	</div>

	<script>
		var slider = document.getElementById("myRange");
		var output = document.getElementById("demo");
		output.innerHTML = slider.value;
		
		slider.oninput = function() 
		{
  			output.innerHTML = this.value;
			document.getElementById('drag-2').style.width=( 3000 /  Math.pow(this.value,1.02))+"px";
    			document.getElementById('drag-2').style.height="this.value";
		}
	</script>
</body>
</html>