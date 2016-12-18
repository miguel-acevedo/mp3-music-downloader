<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.angularjs.org/1.0.1/angular-1.0.1.min.js"></script>
</head>
<button id="up" >UpdateSearch</button>
<input type="text" placeholder="Song name" id="songName">
    
<div ng-app="myApp">
<div ng-controller="PeopleCtrl">
    <a id="clickNow" ng-click=""></a>
      <div ng-repeat="results in people">
        <p>Track: {{results.trackName}}</p>
        <p>Artist: {{results.artistName}}</p>
        <img src="{{results.artworkUrl100}}">
        <br>
      </div>
        <input type="button" id="search" value="update" ng-click="updateName(people);" style="display: none">
      </div>
</div>
</div>
        
<script>

$('#up').click(function(){
    $("#search").click();
        setTimeout(function(){ 
            $("#search").click();
        }, 500);
});
    
$( document ).ready(function() {
       setTimeout(function(){ 
            $("#clickNow").click();
        }, 1000);
});    

</script>


<script>
//https://itunes.apple.com/WebObjects/MZStore.woa/wpa/MRSS/featuredalbums/sf=143441/limit=10/rss.xml
// Make the top 10 songs default shown
var app = angular.module('myApp', []);

function PeopleCtrl($scope, $http) {

    $scope.people = [];
    
    var data;

        $.ajax({
                url:"http://itunes.apple.com/search",
                data:{term:"blue foundation eyes on fire",entity:"song",limit:"5"},
                type:"GET",
                dataType: "jsonp",
                success: function(data, dataType)
                {
                    load(data.results);
                }
 
        })
        
function load(data){
    console.log(data);
    $scope.people = data;
}
    
// Updating Object
    

    
$scope.updateName = function(people)
{   
        $.ajax({
                url:"http://itunes.apple.com/search",
                data:{term:$('#songName').val(),entity:"song",limit:"5"},
                type:"GET",
                dataType: "jsonp",
                success: function(data, dataType)
                {
                     updateLoad(data);
                }
 
        })
        
    function updateLoad(data)
    {
        var count = data.resultCount;
        data = data.results;
        
        for (var i = 0; i < count; i++)
            {
                people[i].trackName = data[i].trackName;
                people[i].artistName = data[i].artistName;
            }
        
    }

}


// End
}    
</script>

</html>