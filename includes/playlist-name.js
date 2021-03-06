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
    for (var p in normalizedProps) {    // Leave properties that don't have values out of inserted resource.
           
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
    request.execute(function (response) {   
        console.log(response);  
        playlistName = response;
        $('#playlistName').text('got here-' + playlistName);
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

  
function defineRequest() {   // See full sample for buildApiRequest() code, which is not 
    // specific to a particular youtube or youtube method.
    var playList = getPlaylistID();
    buildApiRequest('GET',         '/youtube/v3/playlists',          {
        'channelId': playList,
                 'maxResults': '25',
                 'part': 'snippet'
    });

     
}

function getPlaylistID() {
    $('#link-container').val('');
    var playlist = $('#playlist').val();
    var playlistId = playlist.replace("https://www.youtube.com/playlist?list=", "");
    console.log(' ' + playlistId);
}
