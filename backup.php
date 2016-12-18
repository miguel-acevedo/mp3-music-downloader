<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.angularjs.org/1.0.1/angular-1.0.1.min.js"></script>
</head>
    
<input type="text" placeholder="Song name" id="songName" value="gangnam style">
    
<div ng-app="myApp">
<div ng-controller="PeopleCtrl">
    <p>    Click <a ng-click="loadPeople()">here</a> to load data.</p>
      <div ng-repeat="results in people">
        <p>Track: {{results.trackName}}</p>
        <p>Artist: {{results.artistName}}</p>
        <br>
      </div>
    <pre>{{people | json}}</pre>
</div>
</div>
        


<script>

var app = angular.module('myApp', []);

function PeopleCtrl($scope, $http) {

    $scope.people = [];
    
    var data;

        $.ajax({
                url:"http://itunes.apple.com/search",
                data:{term:$('#songName').val(),entity:"song",limit:"5"},
                type:"GET",
                dataType: "jsonp",
                success: function(data, dataType){
                        //console.log(data);
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
                        load(data.results);
                }
 
        })
        
function load(data){
    console.log(data);
    $scope.people = data;
}
    


}    
</script>

</html>