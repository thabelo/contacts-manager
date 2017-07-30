var app = new Application();

// wait for dom elements to load 
$(document).ready(function () {
	// load all pages 
	app.init();
});

function Application () {
	this.searchData = Array();
	this.selectedUrl = '';
	
	Application.prototype.init = function() {
		app.bindSearchInput();
	}

	Application.prototype.bindSearchInput = function() {
		$("#searchButton").click(function() {
			location.href = "../../../application/Views/Contacts/search.php?search=" + $("#searchData").val();
		});

		$("#searchData").keyup(function(e) {
			switch(e.which) {
				case 38: // up
				break;

				case 40: // down
				break;

				default:
					if ($(this).val().length >= 2) {
						app.searchContacts($(this).val());
					} else {
						$(".search-results").hide();
					}
				return; // exit this handler for other keys
			}
			e.preventDefault(); // prevent the default action (scroll / move caret)
		});

		var searchIndex = 0;
		$("#searchData").keydown(function(e) {
			if(app.searchData) {
				switch(e.which) {
					case 38: // up
						if ( searchIndex < 1 )
							searchIndex = app.searchData.length;
						app.selectSearchItem(--searchIndex);
					break;

					case 40: // down
						app.selectSearchItem(searchIndex++);
					break;

					case 13: // enter
						location.href = href="../../../application/Views/Contacts/user_contacts.php?user=" + app.selectedUserId;
					break;

					default: return; // exit this handler for other keys
				}
				e.preventDefault(); // prevent the default action (scroll / move caret)
			}
		});
		
	}
	
	Application.prototype.selectSearchItem = function(searchIndex) {
		var indexModified = searchIndex % (app.searchData.length);
		var searchItem = app.searchData[indexModified];
		app.selectedUserId = app.searchData[indexModified];

		$(".search-results-item").css('background-color','white');
		$("#search-item-"+indexModified).css('background-color','rgba(4, 255, 0, 0.1)');
	}
	
	Application.prototype.searchContacts = function(searchWord) {
		
		var postData = {};
		postData.searchWord = searchWord;
		postData.action = "api_search";
		
		var requestData = {};
		requestData.url = "../../../application/Controller/contacts_controller.php";
		requestData.type = "POST";
		requestData.data = postData;
		requestData.async = false;
		requestData.token = '';
		requestData.callback = app.searchContactsCallback;
		app.callAjax(requestData);
	}

	Application.prototype.searchContactsCallback = function(callbackData) {
		if (callbackData) {
			if (callbackData.length > 0)
				$(".search-results").show();
			else
				$(".search-results").hide();
			
			$(".search-results").empty();
			app.searchData = [];
			var index = 0;
			while (index < callbackData.length) {
				var name = callbackData[index].Contacts.firstname + " " + callbackData[index].Contacts.lastname;
				if ( callbackData[index].Contacts.value ) 
					name = name + " - " +  callbackData[index].Contacts.name + " : " +  callbackData[index].Contacts.value;
				else 
					name = name + " - no contacts"

				var htmlElement = '<a id="search-item-' + (index) + '" class="search-results-item" href="../../../application/Views/Contacts/user_contacts.php?user='+callbackData[index].Contacts.id+'"> ' + name + '</a><div class="clear"> </div>';
				$(".search-results").append(htmlElement);
				app.searchData.push(callbackData[index].Contacts.id);
				index++;
			}
		} else {
			$(".search-results").empty();
			$(".search-results").hide();
		}
	}
	
	Application.prototype.callAjax = function(requestData) {
		setTimeout(function(){
			$.ajax({
				type: requestData.type,
				beforeSend: function (xhr) {
					xhr.withCredentials = true,
					xhr.setRequestHeader('AuthToken', requestData.token);
				}, 
				url: requestData.url,
				data: requestData.data,
				async: requestData.async,
				crossDomain: true,
				dataType: 'json',
				cache: false,

				success: function (data) {
					requestData.callback(data);
				},
				error: function (xhr, errorString, exception) {
					console.log("ERROR:  xhr.status=" + xhr.status + " error=" + errorString + " exception=(" + exception + ") Responce Text=" + xhr.responseText);
				}
			});
		}, 50);
	}

}


