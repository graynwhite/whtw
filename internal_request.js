/* The following function creates an XMLHttpRequest object...*/
function createRequestObject(){
	var request_o; // declare the variable to hold the object.
	var browser = navigator.appName; //find the browser name
	// alert("browser is " + browser);
	if(browser=="Microsoft internet Explorer"){
		/* Create the object using MSIE's methof */
		request_o = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		/* Create the object using other browsers method */
		request_o = new XMLHttpRequest();
	}
	return request_o; // return the object
}
/* You can get more specific with version information by using
	parseInt(navigator.appVersion)
	which will extract an integer value containing the version 
	of the browserbeing used.
*/

/* The variable http will hold our new XMLHttpRequest object. */
var http = createRequestObject();
// alert("object created");
/* Function called to get the product categories list */
function getProducts(){
 //alert("getproduct " + document.form_category_select.select_category_select.selectedIndex);
	/* Create the request. The first argument to open function is the method (POST/GET),
		and the second argument is the url...
		document contains references to all items on the page
		we can reference document.form_category_select
		be referencing the dropdown list. The selectedIndex p
		Index of the selected item.
	*/
	// alert("about to get");
	http.open('get', 'internal_request.php?action=get_products&id='
	 + document.form_category_select.select_category_select.selectedIndex);
	/* Define a function to call once a response has been received . This will be our
			handleProductCategories function that we define below */
			
	http.onreadystatechange=handleProducts;
	/* send the data. We use something other than null when we are sending using the POST
			method */
	http.send(null);
			
}
/* Function called to handle the list that was returned from the internal_request.php file.. */ 
function handleProducts(){ 
// alert("ready state is " + http.readyState);
	/* Make sure that the transaction has finished. 
		The XMLHttpRequest object has a property called readyState with several states:
		 0: Uninitialized 
		 1: Loading
 		 2: Loaded 
 		3: Interactive 
 		4: Finished */
  if(http.readyState == 4){ //Finished loading the response 
  
  /* We have got the response from the server-side script,
   let's see just what it was. using the responseText property of the
    			XMLHttpRequest object. */
   var response = http.responseText; 
  // alert(response);
   /* And now we want to change the product_categories <div> content. we do this using an ability to get/change the content of a page element that we can find: innerHTML. */ 
   document.getElementById('Product_cage').innerHTML = response; 
    }
}			