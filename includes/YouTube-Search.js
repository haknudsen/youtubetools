// JavaScript Document/***** START BOILERPLATE CODE: Load client library, authorize user. *****/

	 // Global variables for GoogleAuth object, auth status.
	 var GoogleAuth,auth,searchResults,resultType;

	 /**
	  * Load the API's client and auth2 modules.
	  * Call the initClient function after the modules load.
	  */
	 function handleClientLoad() {
	   gapi.load('client:auth2', initClient);
	 }

	 function initClient() {
	   // Initialize the gapi.client object, which app uses to make API requests.
	   // Get API key and client ID from API Console.
	   // 'scope' field specifies space-delimited list of access scopes

	   gapi.client.init({
	       'clientId': '90875073625-c3k22oeo15lc8p086cf2307pmoatehp1.apps.googleusercontent.com',
	       'discoveryDocs': ['https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest'],
	       'scope': 'https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner'
	   }).then(function () {
	     GoogleAuth = gapi.auth2.getAuthInstance();

	     // Listen for sign-in state changes.
	     GoogleAuth.isSignedIn.listen(updateSigninStatus);

	     // Handle initial sign-in state. (Determine if user is already signed in.)
	     setSigninStatus();

	     // Call handleAuthClick function when user clicks on "Authorize" button.
	     $('#execute-request-button').click(function() {
	       handleAuthClick(event);
	     }); 
	   });
	 }

	 function handleAuthClick(event) {
	   // Sign user in after click on auth button.
	   GoogleAuth.signIn();
	 }
	$('#search').click(function(){
	   if(auth){
		   $('#results').empty();
	       defineRequest();
	   }
	})
	 function setSigninStatus() {
	   var user = GoogleAuth.currentUser.get();
	   isAuthorized = user.hasGrantedScopes('https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner');
	   // Toggle button text and displayed statement based on current auth status.
	   if (isAuthorized) {
		   $('#execute-request-button').removeClass("btn-warning");
		   $('#execute-request-button').addClass("btn-green");
	     auth = true;
	   }
	 }

	 function updateSigninStatus(isSignedIn) {
	   setSigninStatus();
	 }

	 function createResource(properties) {
	   var resource = {};
	   var normalizedProps = properties;
	   for (var p in properties) {
	     var value = properties[p];
	     if (p && p.substr(-2, 2) == '[]') {
	       var adjustedName = p.replace('[]', '');
	       if (value) {
	         normalizedProps[adjustedName] = value.split(',');
	       }
	       delete normalizedProps[p];
	     }
	   }
	   for (var p in normalizedProps) {
	     // Leave properties that don't have values out of inserted resource.
	     if (normalizedProps.hasOwnProperty(p) && normalizedProps[p]) {
	       var propArray = p.split('.');
	       var ref = resource;
	       for (var pa = 0; pa < propArray.length; pa++) {
	         var key = propArray[pa];
	         if (pa == propArray.length - 1) {
	           ref[key] = normalizedProps[p];
	         } else {
	           ref = ref[key] = ref[key] || {};
	         }
	       }
	     };
	   }
	   return resource;
	 }

	 function removeEmptyParams(params) {
	   for (var p in params) {
	     if (!params[p] || params[p] == 'undefined') {
	       delete params[p];
	     }
	   }
	   return params;
	 }

	 function executeRequest(request) {
	   request.execute(function(response) {
	       searchResults = response.items;
	       var i=0;
	       while(searchResults){
			   console.log( response.items[i].id );
               resultType = response.items[i].id.kind;
              if(resultType.indexOf("video") >0){
                  videoURL = 'https://www.youtube.com/watch?v=' + response.items[i].id.videoId;
              }
               else if(resultType.indexOf("play") >0){
                       videoURL = 'https://www.youtube.com/playlist?list=' + response.items[i].id.playlistId;
                       }
               else if(resultType.indexOf("channel") >0){
                   videoURL = 'https://www.youtube.com/channel?' + response.items[i].id.channelID;
               }
var search =  searchResults[i].snippet;
	    var channel = search.channelTitle;
	   var title = search.title;
	   var thumbnail = search.thumbnails.medium.url;
	   $('#results').append( '<div class="row"><div class="col-md-8 col-offset-md-2"<div class="media"><div class="media-left"> <a target="_blank" href="' + videoURL + '"> <img class="media-object" src="' + thumbnail + '" alt="..."> </a> </div><div class="media-body"><h3 class="media-heading">Result #' + (i+1) + '</h3><h4 class="media-heading">Channel: ' + channel + '</h4><h5 class="media-heading">Title: ' + title + '</h5><h5 class="media-heading">' + resultType +'</h5></div></div></div><br>');
	   i++;
	       }
	       });
	 }
	 function buildApiRequest(requestMethod, path, params, properties) {
	   params = removeEmptyParams(params);
	   var request;
	   if (properties) {
	     var resource = createResource(properties);
	     request = gapi.client.request({
	         'body': resource,
	         'method': requestMethod,
	         'path': path,
	         'params': params
	     });
	   } else {
	     request = gapi.client.request({
	         'method': requestMethod,
	         'path': path,
	         'params': params
	     });
	   }
	   executeRequest(request);
	 }

	 /***** END BOILERPLATE CODE *****/

	 
	 function defineRequest() {
	   // See full sample for buildApiRequest() code, which is not 
	// specific to a particular API or API method.
	term = $('#term').val();
	buildApiRequest('GET',
	               '/youtube/v3/search',
	               {'maxResults': '25',
	                'part': 'snippet',
	                'q': term,
	                'type': ''});

	 }
	       autosize( document.querySelectorAll( 'textarea' ) );