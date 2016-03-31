<?
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
?>
<!DOCTYPE html>
<html>
<head>
<style>
form{
    margin-left: 20px;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>

var notRealID = "15519744-E87434BFD194B7702D673D0285756ACD";
var requestUrl = "https://c15519744.web.cddbp.net/webapi/json/1.0/";
var userIDUrl = "https://c15519744.web.cddbp.net/webapi/json/1.0/register?client=15519744-E87434BFD194B7702D673D0285756ACD";
var playlistType = prompt("I want to base my playlist off of an (artist/genre)");
if(playlistType == "artist"){
    var artistname = prompt("What artist?")
    artistname = encodeURIComponent(artistname);
}

function init(){
         $("#contents").load("fetch.php?reg=1",function(){parseThatShit();});
}


function parseThatShit(){
 var userInfo = document.getElementById("contents").innerHTML;
        var userInformation = JSON.parse(userInfo);
        console.log(userInformation);
        var userID = userInformation["RESPONSE"][0]["USER"][0]["VALUE"];
        console.log(userID);
$("#playlists").load("fetch.php?reg=0&artist_name="+artistname+"&user="+userID, function(){playlistParse();});

}


function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}




function playlistParse(){
var playlistInfo = document.getElementById("playlists").innerHTML;
var playlistInformation = JSON.parse(playlistInfo);
var songs = [];
var artists = [];
for (var i = 0; i <5; i++){
    if(i == 0){
        songs.push(playlistInformation["RESPONSE"][i]["ALBUM"][i]["TRACK"][i]["TITLE"][i]["VALUE"])
        artists.push(playlistInformation["RESPONSE"][i]["ALBUM"][i]["ARTIST"][i]["VALUE"])
    }
    else{
        songs.push(playlistInformation["RESPONSE"][0]["ALBUM"][i]["TRACK"][0]["TITLE"][0]["VALUE"])
        artists.push(playlistInformation["RESPONSE"][0]["ALBUM"][i]["ARTIST"][0]["VALUE"])
    }
}
console.log(songs);
console.log(artists);


var myJsonString1 = JSON.stringify(songs);
var myJsonString2 = JSON.stringify(artists);



    post_to_url('play.php', {"s1": myJsonString2, "s2": myJsonString1 });


 }





</script>
</head>
<body onload="init();">
<body>

<div id = "contents">
</div>
 <div id = "genres">
    </div>
<div id = "playlists">
</div>
<div id = "songs">
</div>
<div id = "covers">

    </div>


</body>
</html>