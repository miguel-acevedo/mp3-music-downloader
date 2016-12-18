<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.angularjs.org/1.0.1/angular-1.0.1.min.js"></script>
</head>
    
<h1>iTunes search</h1>
 
<input type="text" value="Gangnam style" id="keyword">
<input type="button" value="load" onclick="load()">
<input type="button" value="Preview" onclick="play()">
<input type="button" value="stop" onclick="stop()">
<br>
<audio id="audio"></audio>
<img id="artwork" width="100" height="100">
<p id="songName"></p>
<p id="songInfo"></p>

<script>
var app = angular.module('myApp', []);
    function load(){
        $.ajax({
                url:"http://itunes.apple.com/search",
                data:{term:$('#keyword').val(),entity:"song",limit:"20"},
                type:"GET",
                dataType: "jsonp",
                success: function(data, dataType){
                        console.log(data);
                        var results = data.results;
                        var imgurl = results[0]['artworkUrl100'];
                        var mediaurl = results[0]['previewUrl'];
                        var artistName = results[0]['artistName'];
                        var artistId = results[0]['artistId'];
                        var trackName = results[0]['trackName'];
                        var albumName = results[0]['collectionName'];
                        var trackTime = results[0]['trackTimeMillis'];
                        $('#artwork').attr('src', imgurl);
                        $('#audio').attr('src', mediaurl);
                        $('#songName').text(artistName + " - " + trackName);
                        $('#songInfo').text("Album: " + albumName + " | Time: " + trackTime);
                        window.yourGlobalVariable = data;
                        loadMe(data);
                }
 
        })
}
 
function play(){
        $('#audio')[0].play();
}
function stop(){
        $('#audio')[0].pause();
}
    
// AngularJs Below
        var obj = [{
        "item" : "Apples",
        "cost" : 12
    },
    {
        "item" : "Oranges",
        "cost" : 16
    }];
    
    console.log(obj);
    
function loadMe(songData)
{
    angular.module("forEachMod", [])
        .controller("forEachCtrl", function($scope){
            $scope.result = obj;
        });
}


</script>
    

<div ng-app="forEachMod">
    <div ng-controller="">
      <div ng-repeat="a in result">
      <p>{{a.item}}</p>
      </div>
    </div>
</div>
        
    

</html>