/**
 * Created by peter on 24/10/2019.
 */
document.addEventListener("DOMContentLoaded", function(event) {


    let map;
    function displayTweets() {
        $.getJSON("includes/getTweets.php", function (tweetData) {
            let lat =0;
            let long = 0;
            let user ='';
            let tweetLoc =[];

            $.each(tweetData.statuses, function (i, tweet) {
                user = tweet.user.name;
                if (tweet.coordinates !== null) {
                    lat = tweet.coordinates.coordinates[1];
                    long = tweet.coordinates.coordinates[0];
                    tweetLoc.push([lat,long,user]);
                    $("#tweets").append("<p>" + user + "tweets" + tweet.text + " at "+
                        (tweet.created_at));
                }
                else {
                    $("#tweets").append("<p>" + user + "tweets" + tweet.text + " at "+
                        (tweet.created_at));
                }
            });
            placeTwitterM(tweetLoc);
        });
    }

    function placeTwitterM(locations) {
        $.each(locations, function (index) {
            let location = locations[index];
            let latLong = new google.maps.latLong(locations[0],locations[1]);
            let user = locations[2];
            let text = "tweeter" + user;

            let marker = new google.maps.Marker({
                position: latLong,
                map: map,
                icon: icon,
                title: text
            });

        })
    }
    function getWeather(lat, lon) {

        let apiURL = ' //api.openweathermap.org/data/2.5/weather?';
        let weather = apiURL + '&lat='+lat+'&lon='+lon+'&appid=a20ee0368ad1ed6110ff461f3e57ded0';
        $.ajax({
            type:'GET',
            dataType: "jsonp",
            url: weather,
            success: function (data) {
                let temp = Math.round(data.main.temp -273.13)+"C";

                $("#weather").text( "<p> weather for "+ data.name + " is "+ data.weather[0].description + "temp is "+ temp +"</p>");

            }
        });

    }


    function initMap() {
        map = new google.maps.Map(document.getElementById('map') ,{
            zoom: 11,
            center: new google.maps.LatLng(54.973937,-1.613176),
            mapTypeId: 'terrain'
        });
        let info = new google.maps.InfoWindow();

        getWeather(54.973937,-1.613176);
        displayTweets();


    }
    google.maps.event.addDomListener(window, 'load', initMap);
});