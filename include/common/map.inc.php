<?php 

// Team
$result = $db->ud_whereQuery('ud_map_marker',NULL,array('visible'=>1));
$marker = $db->ud_mysql_fetch_assoc_all($result);

$marker_js = '';


for($i=0;$i<sizeof($marker);$i++)
{
	$marker_js .= '[\''.$marker[$i]['markerTitle'].'\','.$marker[$i]['markerLat'].','.$marker[$i]['markerLong'].']';
	if($i!=sizeof($marker)-1)
	{
		$marker_js .= ',';
	}
}
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA8JosqxSiYAjCJTKnicfyYo6Ubkgjms&sensor=true">
</script>
<script type="text/javascript">
    var vellore = new google.maps.LatLng(12.9202, 79.1333);
    var image = '../../resources/images/common/logo-map.png';
    var marker;
    var markers = [<?php echo $marker_js;?>];
    var map;

    function initialize() {
        var mapOptions = {
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(22.00, 77)
        };

        map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);

        for (i = 0; i < markers.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(markers[i][1], markers[i][2]),
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                title: markers[i][0]    
            });
            //google.maps.event.addListener(marker, 'click', toggleBounce);
        }

        function toggleBounce() {

            if (marker.getAnimation() != null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
	}
</script>
<?php ?>