    // resize marker list to fit window var infoWindow = [];//var infoWindow = new google.maps.InfoWindow();
//    var infowindow = [];
    function resizeList() {
        newHeight = $('html').height() - $('#topbar').height();
        $('#list').css('height', newHeight + "px");
        $('#menu').css('margin-top', $('#topbar').height());
    }
    function initAdvArea(Type = ''){
        $('#show_image').removeClass('active');
        $('#image_view').hide();
        $('#map_canvas').show();
        $('#show_map').addClass('active');
        initialize(Type);
    }
    function initInTheArea(Type = ''){
        $('#nearby_category_area li').removeClass('active');
        if(Type!='' && typeof(Type)=='string'){
            $('#nearby_category_area li#'+Type).addClass('active');
        }
        $('#showcase').hide();
        $('#cam').removeClass();
        $('#showcase1').css({
            height: 'auto',
            width: 'auto'
        });
        $('#ar').addClass('active');
        $('#showcase2').hide();
        $('#video').removeClass();
        $('#showcase3').css({
            height: 0,
            width: 0
        });
        $('#st').removeClass();
        $('#nearby_category_area').show();
        initialize(Type);
    }
    function initStreetView(){
        $('#showcase').hide();
        $('#cam').removeClass();
        $('#showcase1').css({height: 0,width: 0});
        $('#ar').removeClass();
        $('#showcase2').hide();
        $('#video').removeClass();
        $('#showcase3').css({height: 'auto',width: 'auto'});
        $('#st').addClass('active');
        $('#nearby_category_area').hide();
        var panorama = new google.maps.StreetViewPanorama(
            document.getElementById('map_canvas_street_view'),{
                position: {
                    lat: centerLatitude,
                    lng: centerLongitude
                },
                addressControlOptions: {
                    position: google.maps.ControlPosition.BOTTOM_CENTER
                },
                linksControl: false,
                panControl: false,
                enableCloseButton: false
            });
    }
    function geocodePosition(pos){
        geocoder.geocode({
            latLng: pos
        },function(responses){
            if(responses && responses.length > 0){
                $('#dragged-address-location').html(responses[0].formatted_address).addClass('active');
            }else{
    //updateMarkerAddress('Cannot determine address at this location.');
            }
        });
    }
    // initialize map
    function initialize(Type = '') {
        geocoder = new google.maps.Geocoder();
    // set map styles
        var mapStyles =[{
            featureType: "road",
            elementType: "geometry",
            stylers: [
                {hue: "#8800ff"},
                {lightness: 100}
            ]},{
            featureType: "road",
            stylers: [
                {visibility: "on"},
                {hue: "#91ff00"},
                {saturation: -62},
                {gamma: 1.98},
                {lightness: 45}
            ]},{
            featureType: "water",
            stylers: [
                {hue: "#005eff"},
                {gamma: 0.72},
                {lightness: 42}
            ]},{
            featureType: "transit.line",
            stylers: [
                {visibility: "off"}
            ]},{
            featureType: "administrative.locality",
            stylers: [
                {visibility: "on"}
            ]},{
            featureType: "administrative.neighborhood",
            elementType: "geometry",
            stylers: [
                {visibility: "simplified"}
            ]},{
            featureType: "landscape",
            stylers: [
                {visibility: "on"},
                {gamma: 0.41},
                {lightness: 46}
            ]},{
            featureType: "administrative.neighborhood",
            elementType: "labels.text",
            stylers: [
                {visibility: "on"},
                {saturation: 33},
                {lightness: 20}
            ]}];
    // set map options
        var myOptions = {
            zoom: centerZoom,
    //minZoom: 10,
            center: new google.maps.LatLng(centerLatitude, centerLongitude),
            disableDefaultUI: true
            /*mapTypeId: google.maps.MapTypeId.ROADMAP,
             streetViewControl: false,
             mapTypeControl: false,
             panControl: false,
             zoomControl: zoomControl,
             styles: mapStyles,
             zoomControlOptions:{
             style: google.maps.ZoomControlStyle.SMALL,
             position: google.maps.ControlPosition.RIGHT_TOP
             }*/
        };

        if(typeof(map) == 'object');
        {
            for(i=0; i<gmarkers.length; i++)
            {
                gmarkers[i].setMap(null);
            }
            gmarkers = [];
        }

        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
    // var mcOptions = {gridSize: 50, maxZoom: 15, imagePath: 'images/markers/m'};

        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);

        zoomControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(zoomControlDiv);

        zoomLevel = map.getZoom();
    // prepare infowindow
        infowindow = new google.maps.InfoWindow({
            content: "holding..."
        });
    // only show marker labels if zoomed in
        google.maps.event.addListener(map, 'zoom_changed', function() {
            zoomLevel = map.getZoom();
            if (zoomLevel <= 18) {
               // alert('hiiii');
                $(".marker_label").css("display", "none");
            } else {
                $(".marker_label").css("display", "inline");
            }
        });
    // add markers

        jQuery.each(GoogleMapMarkers, function(i, val) {
            if(Type!='' && typeof(Type)=='string'){
                if(Type!=val[1]){
                    return true;
                }
            }
            infowindow = new google.maps.InfoWindow({
                content: ""
            });

            var MarkerText = val[0];
            var MarkerType = val[1];
            var mLatitude = val[2];
            var mLongitude = val[3];
            var markerAddress = val[4];
            var markerURI = val[5];
            var markerPrice = val[6];
            var markerPropertyImage = val[7];

    // offset latlong ever so slightly to prevent marker overlap
            rand_x = Math.random();
            rand_y = Math.random();
            mLatitude = parseFloat(mLatitude) + parseFloat(parseFloat(rand_x) / 6000);
            mLongitude = parseFloat(mLongitude) + parseFloat(parseFloat(rand_y) / 6000);
    // show smaller marker icons on mobile
            if (agent == "iphone") {
                var iconSize = new google.maps.Size(16, 19);
            } else {
                iconSize = null;
            }
    // build this marker
            var markerImage = new google.maps.MarkerImage(WebRoot+"assets/images/markers/"+MarkerType+".png", null, null, null, iconSize);
            if(val[8] == 'proDetails')
            {
                //alert(MarkerType);
                markerImage = new google.maps.MarkerImage(WebRoot+"assets/images/markers/orenge_mark.png", null, null, null, iconSize);
            }
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(mLatitude, mLongitude),
                draggable: MarkerDraggable,
                map: map,
                title: '',
                clickable: true,
                infoWindowHtml: '',
                zIndex: 10 + i,
                icon: markerImage
            });
            marker.type = MarkerType;
            gmarkers.push(marker);

            if (val[8] == 'proDetails') {
    //alert('aaaaaaaaaaaa');
                var markerLabelHTML = '<div class="property-window">\
        <div class="property-image">\
            <img src="' + markerPropertyImage + '">\
        </div>\
        <div class="property-info">\
            <div class="marker_title">\
                <a>' + MarkerText + '</a>\
            </div>\
            <div class="marker_address">' + markerAddress + '</div>\
        </div>\
    </div>';
            }
            else {
    //alert('aaaaaaaaaaaa');
                var markerLabelHTML = '<div class="property-window">\
        <div class="property-image">\
            <a href="' + markerURI + '">\
                <img src="' + markerPropertyImage + '">\
            </a>\
        </div>\
        <div class="property-info">\
            <div class="marker_title">\
                <a href="' + markerURI + '">' + MarkerText + '</a>\
            </div>\
            <div class="marker_address">' + markerAddress + '</div>\
            <div class="marker_price">' + markerPrice + '</div>\
        </div>\
    </div>';
            }
            var infowindow = new google.maps.InfoWindow({
            //infowindow = new google.maps.InfoWindow({

    //alert('hiiiii');
                content: markerLabelHTML
            });
            marker.addListener('click', function () {
                infowindow.close();
                infowindow.open(map, marker);
            });
            if(val[8] != "noMarker")
            {
    //alert('aaaaaaaaaaaa');
    // add marker hover events (if not viewing on mobile)
                if (agent == "default") {
                    google.maps.event.addListener(marker, "mouseover", function() {		
                       // alert('hiiiii');
                       //infowindow.close();
                        this.old_ZIndex = this.getZIndex();
                        this.setZIndex(9999);
                        $("#marker" + i).css("display", "inline");
                        $("#marker" + i).css("z-index", "99999");
                    });
                    google.maps.event.addListener(marker, "mouseout", function() {
                        if (this.old_ZIndex && zoomLevel <= 18) {
                            this.setZIndex(this.old_ZIndex);
                            $("#marker" + i).css("display", "none");
                        }
                    });
                }
    // format marker URI for display and linking
                if (markerURI.substr(0, 7) != "http://") {
                    markerURI = "http://" + markerURI;
                }
                var markerURI_short = markerURI.replace("http://", "");
                var markerURI_short = markerURI_short.replace("www.", "");
    // add marker click effects (open infowindow)
                /*google.maps.event.addListener(marker,'click',function(){

                 alert("asdadas");
                 infowindow.setContent(markerLabelHTML);
                 infowindow.open(map, this);
                 });*/
            }


    // Add circle overlay and bind to marker
            var circle = new google.maps.Circle({
                map: map,
                radius: CircleMapRadius,    // 10 miles in metres
                fillColor: '#77FFDA',
                strokeColor: '#50B296',
                strokeWeight: 1,
                draggable: true,
                editable: true
            });
            if(DrawCircleAroundMarker){
                circle.bindTo('center', marker, 'position');
            }
            google.maps.event.addListener(circle,'dragend',function(){
    // Get the Current position, where the pointer was dropped
                var point = circle.getCenter();
    // Center the map at given point
                map.panTo(point);
    // Update the textbox
                geocodePosition(circle.getCenter())
                $('#promaplatitude').val(point.lat());
                $('#promaplongitude').val(point.lng());
            });
    // Register Custom "dragend" Event
            google.maps.event.addListener(marker,'dragend',function(){
    // Get the Current position, where the pointer was dropped
                var point = marker.getPosition();
    // Center the map at given point
                map.panTo(point);
    // Update the textbox
                geocodePosition(marker.getPosition())
                $('#promaplatitude').val(point.lat());
                $('#promaplongitude').val(point.lng());
            });

    // add marker label
            var latLng = new google.maps.LatLng(mLatitude, mLongitude);
            var label = new Label({
                map: map,
                id: i
            });
            label.bindTo('position', marker);
            label.set("text", MarkerText);
            label.bindTo('visible', marker);
            label.bindTo('clickable', marker);
            label.bindTo('zIndex', marker);
        });
        var mcOptions = {gridSize: 30, maxZoom: 15, imagePath: 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m'};
        var mc = new MarkerClusterer(map, gmarkers, mcOptions);
    }
    // zoom to specific marker

    function goToMarker(marker_id){

        if (marker_id!='') {
            if(typeof infowindow != 'undefined'){
            infowindow.close();
                google.maps.event.trigger(infowindow, 'closeclick');

            }
            infowindow.close();
            google.maps.event.trigger(infowindow, 'closeclick');
            initialize();//return false;
            map.panTo(gmarkers[marker_id].getPosition());
            //map.setZoom(centerZoom);
            map.setZoom(18);
            google.maps.event.trigger(gmarkers[marker_id], 'click');
            setTimeout(function(){
               // console.log("===> marker id => "+marker_id);


            }, 3000);

            //infowindow.close();
        }
    }

function closeIW(infowindow){
    //console.log("==> CIW");
    google.maps.event.addListener(infowindow, "closeclick", function()
    {
       // console.log("==> CIW on");
        infowindow.close();
    });
}
    // toggle (hide/show) markers of a given type (on the map)
    function toggle(type) {
        if ($('#filter_' + type).is('.inactive')) {
            show(type);
        } else {
            hide(type);
        }
    }
    // hide all markers of a given type
    function hide(type) {
        for (var i = 0; i < gmarkers.length; i++) {
            if (gmarkers[i].type == type) {
                gmarkers[i].setVisible(false);
            }
        }
        $("#filter_" + type).addClass("inactive");
    }
    // show all markers of a given type
    function show(type) {
        for (var i = 0; i < gmarkers.length; i++) {
            if (gmarkers[i].type == type) {
                gmarkers[i].setVisible(true);
            }
        }
        $("#filter_" + type).removeClass("inactive");
    }
    // toggle (hide/show) marker list of a given type
    function toggleList(type) {
        $("#list .list-" + type).toggle();
    }
    // hover on list item
    function markerListMouseOver(marker_id) {


        infowindow.close();
        $("#marker" + marker_id).css("display", "inline");
    //map.setZoom(map.getZoom() - 3);
    }

    function markerListMouseOut(marker_id){
    //if (marker_id) {
    //map.panTo(gmarkers[marker_id].getPosition());
        // map.setZoom(centerZoom);
    //infowindow.close();
    //$("#marker"+marker_id).css("display","none");
        $("#marker" + marker_id).css("display", "none");if(typeof infowindow != 'undefined'){
            //infowindow.close();
            google.maps.event.addListener(infowindow, "closeclick", function()
            {
                infowindow.close();
            });}
    //google.maps.event.trigger(infoWindow, 'closeclick');
        /*google.maps.event.trigger(gmarkers[marker_id], 'closeclick');
         google.maps.event.addListener(markerInfoWindow, "closeclick", function()
         {
         mapRef.panTo(mapSettings.center);
         mapRef.setZoom(2);
         });*/
    //}

    }
    // detect browser agent
    $(document).ready(function() {
        if (navigator.userAgent.toLowerCase().indexOf("iphone") > -1 || navigator.userAgent.toLowerCase().indexOf("ipod") > -1) {
            agent = "iphone";
            zoomControl = false;
        }
        if (navigator.userAgent.toLowerCase().indexOf("ipad") > -1) {
            agent = "ipad";
            zoomControl = false;
        }
    // resize marker list onload/resize
        resizeList();
    });
    $(window).resize(function() {
        resizeList();
    });

    function ZoomControl(controlDiv, map) {

    // Creating divs & styles for custom zoom control
        controlDiv.style.padding = '5px';

    // Set CSS for the control wrapper
        var controlWrapper = document.createElement('div');
        controlWrapper.style.backgroundColor = 'black';
        controlWrapper.style.borderStyle = 'solid';
        controlWrapper.style.borderColor = 'white';
        controlWrapper.style.borderWidth = '1px';
        controlWrapper.style.cursor = 'pointer';
        controlWrapper.style.textAlign = 'center';
        controlWrapper.style.width = '24px';
        controlWrapper.style.height = '48px';
        controlDiv.appendChild(controlWrapper);

    // Set CSS for the zoomIn
        var zoomInButton = document.createElement('div');
        zoomInButton.style.width = '24px';
        zoomInButton.style.height = '24px';
        /* Change this to be the .png image you want to use */
        zoomInButton.style.backgroundImage = 'url("http://www.zapcasa.it/zap-test3/assets/images/plus.png")';
        zoomInButton.style.backgroundSize = 'cover';
        controlWrapper.appendChild(zoomInButton);

    // Set CSS for the zoomOut
        var zoomOutButton = document.createElement('div');
        zoomOutButton.style.width = '24px';
        zoomOutButton.style.height = '24px';

        /* Change this to be the .png image you want to use */
        zoomOutButton.style.backgroundImage = 'url("http://www.zapcasa.it/zap-test3/assets/images/minus.png")';
        zoomOutButton.style.backgroundSize = 'cover';
        controlWrapper.appendChild(zoomOutButton);

    //set CSS for the extended view
        var extendedView = document.createElement('div');
        extendedView.style.width = '24px';
        extendedView.style.height = '24px';
        extendedView.id = 'extView';

        /*Change this to be the .png image you want to use */
        extendedView.style.backgroundImage = 'url("http://www.zapcasa.it/zap-test3/assets/images/zoom.png")';
        extendedView.style.backgroundSize = 'cover';
        controlWrapper.appendChild(extendedView);

    // Setup the click event listener - zoomIn
        google.maps.event.addDomListener(zoomInButton, 'click', function() {
            map.setZoom(map.getZoom() + 1);
        });

    // Setup the click event listener - zoomOut
        google.maps.event.addDomListener(zoomOutButton, 'click', function() {
            map.setZoom(map.getZoom() - 1);
        });

    // Setup the click event listener - extendedView
        google.maps.event.addDomListener(extendedView, 'click', function() {
            if(typeof page === "string")
                fullView(page);
            else
                fullView();
    // map.setZoom(map.getZoom() - 3);
        });

    }

    function fullView(tmp='')
    {
        if(tmp == 'proDetails')
        {
            $('.left_panel').toggleClass("fullScreen");
            $('.right_panel').toggle("slide");
            $('#map_canvas').toggleClass("fullScreen");
        }
        else if(tmp == "advDetails")
        {
            $('.property_view').toggleClass("fullScreen");
            $('#map_canvas').toggleClass("fullScreen");
            $('.property_info').toggleClass("tmp");
        }
        else
        {
            $('#map_canvas').toggleClass("fullScreen");
            setTimeout(function(){
                google.maps.event.trigger(map, "resize");

            }, 2000);
        }
    }

    google.maps.event.addDomListener(window,'load', initialize);
    google.maps.event.addDomListener(window,'onclick', initialize);