function handleClientLoad() {
	gapi.load("client:auth2", initClient)
}

function initClient() {
	gapi.client.init({
		clientId: "90875073625-c3k22oeo15lc8p086cf2307pmoatehp1.apps.googleusercontent.com",
		discoveryDocs: ["https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest"],
		scope: "https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner"
	}).then(function () {
		(GoogleAuth = gapi.auth2.getAuthInstance()).isSignedIn.listen(updateSigninStatus), setSigninStatus(), $("#execute-request-button").click(function () {
			handleAuthClick(event)
		})
	})
}

function handleAuthClick(e) {
	GoogleAuth.signIn()
}

function setSigninStatus() {
	var e = GoogleAuth.currentUser.get();
	isAuthorized = e.hasGrantedScopes("https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner"), isAuthorized && ($("#execute-request-button").removeClass("btn-warning"), $("#execute-request-button").addClass("btn-green"), auth = !0)
}

function updateSigninStatus(e) {
	setSigninStatus()
}

function createResource(e) {
	var t = {},
		i = e;
	for (var s in e) {
		var a = e[s];
		if (s && "[]" == s.substr(-2, 2)) {
			var n = s.replace("[]", "");
			a && (i[n] = a.split(",")), delete i[s]
		}
	}
	for (var s in i)
		if (i.hasOwnProperty(s) && i[s])
			for (var u = s.split("."), o = t, l = 0; l < u.length; l++) {
				var r = u[l];
				l == u.length - 1 ? o[r] = i[s] : o = o[r] = o[r] || {}
			}
		return t
}

function removeEmptyParams(e) {
	for (var t in e) e[t] && "undefined" != e[t] || delete e[t];
	return e
}

function executeRequest(e) {
	e.execute(function (e) {
		searchResults = e.items;
		for (var t = 0; searchResults;) {
			console.log(e.items[t].id), (resultType = e.items[t].id.kind).indexOf("video") > 0 ? videoURL = "https://www.youtube.com/watch?v=" + e.items[t].id.videoId : resultType.indexOf("play") > 0 ? videoURL = "https://www.youtube.com/playlist?list=" + e.items[t].id.playlistId : resultType.indexOf("channel") > 0 && (videoURL = "https://www.youtube.com/channel?" + e.items[t].id.channelID);
			var i = searchResults[t].snippet,
				s = i.channelTitle,
				a = i.title,
				n = i.thumbnails.medium.url;
			$("#results").append('<div class="row"><div class="col-12"><div class="media"><div class="media-left"> <a target="_blank" href="' + videoURL + '"> <img class="media-object" src="' + n + '" alt="..."> </a> </div><div class="media-body"><h3 class="media-heading">Result #' + (t + 1) + '</h3><h4 class="media-heading">Channel: ' + s + '</h4><h5 class="media-heading">Title: ' + a + '</h5><h5 class="media-heading">' + resultType + "</h5></div></div></div><br>"), t++
		}
	})
}

function buildApiRequest(e, t, i, s) {
	i = removeEmptyParams(i);
	var a;
	if (s) {
		var n = createResource(s);
		a = gapi.client.request({
			body: n,
			method: e,
			path: t,
			params: i
		})
	} else a = gapi.client.request({
		method: e,
		path: t,
		params: i
	});
	executeRequest(a)
}

function defineRequest() {
	term = $("#term").val(), buildApiRequest("GET", "/youtube/v3/search", {
		maxResults: "25",
		part: "snippet",
		q: term,
		type: ""
	})
}
var GoogleAuth, auth, searchResults, resultType;
$("#search").click(function () {
	auth && ($("#results").empty(), defineRequest())
}), autosize(document.querySelectorAll("textarea"));
