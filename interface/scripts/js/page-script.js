var max_records_per_page = 5;

// The function that is executed when user clicks on one of the page tabs.
function showSelectedView(element){
	
	/* It is presumed that, at the time of activation of this function, the page
	 * consists of n tabs and n views. One view corresponds to one tab only, and
	 * it can only be displayed when user clicks on appropriate tab. */
	
	// Get the lists of page views and tabs and lengths of those lists
	var views = document.getElementById("views").children;
	var tabs = document.getElementById("tabs").getElementsByTagName('a');
	var numberOfTabs = tabs.length;
	var numberOfViews = views.length;
	
	/* If we have the same number of tabs and lists on our page, we can proceed with
	 * this function */
	
	if(numberOfTabs === numberOfViews){
		
		/* Iterate through views and if one of the views is visible, hide it and 
		 * end this loop. */
		
		for(var i = 0; i < numberOfViews; i++){
			if(views[i].classList.contains('tab-view')){
				views[i].classList.remove('tab-view');
				views[i].classList.add('tab-view-hide');
				break;
			}
		}
		
		/* Iterate through tabs and if one of the tabs is highlighted, 
		 * unhighlight it and end this loop */
		
		for(var i = 0; i < numberOfTabs; i++){
			if(tabs[i].classList.contains('tab-selected')){
				tabs[i].classList.remove('tab-selected');
				break;
			}
		}
		
		/* Iterate through tabs. If the id of clicked tab is the same as the id of
		 * one of the tabs in tabs list, show clicked tab (highlight it really), 
		 * and also show its appropriate view. */
		
		for(var i = 0; i < numberOfTabs; i++){
			if(element.id === tabs[i].id){
				element.classList.add('tab-selected');
				views[i].classList.remove('tab-view-hide');
				views[i].classList.add('tab-view');
				break;
			}
		}
	}
	else{
		
		/* Else we will alert user that some of the tabs or views on his/hers page 
		 * are missing. */
		
		alert("Bad HTML: Tab or tab view missing!");
	}
}
//This function will be called when the user clicks on "Bingo shops list" tab. 
//It will send AJAX request to the server, and then it will update "Bingo shop list" table accordingly.
function refreshTable(){
	$.ajax({
		type: 'POST',
        url: "http://localhost/places/data/data_services/controller_service.php",
        data: "action=refresh_all&max_records_per_page="+max_records_per_page,
		contentType: 'application/x-www-form-urlencoded',
			   
        success: function(response) {
			var new_table = $("<div></div>").append($.parseHTML(response)).find("#places-table");
			var old_table = $("#places-table");
			old_table.replaceWith(new_table);
		}
    });
}
//This function will be called when the user clicks on one of the page numbers on "Bingo shop list" table. 
//It will send AJAX request to the server, and then it will update "Bingo shop list" table accordingly.
function get_page(page){
	$.ajax({
		type: 'GET',
        url: "http://localhost/places/data/data_services/controller_service.php",
        data: "action=get_page&max_records_per_page"+max_records_per_page+"&page="+page,
		contentType: 'application/x-www-form-urlencoded',
			   
        success: function(response) {
			var new_table = $("<div></div>").append($.parseHTML(response)).find("#places-table");
			var old_table = $("#places-table");
			old_table.replaceWith(new_table);
		}
    });
}