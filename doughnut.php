<!doctype html>
<html>
	<head>
		<title>Olympic Medals By Country Since 1900</title>
		<link href="http://johnfoxstudios.com/projects/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="http://johnfoxstudios.com/projects/dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
        
		<script src="http://johnfoxstudios.com/projects/dist/assets/js/jquery.js"></script>
		<script src="http://johnfoxstudios.com/projects/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="js/jqplot.pieRenderer.min.js"></script>
        <script type="text/javascript" src="js/jqplot.donutRenderer.min.js"></script>
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
		<style>

</style>
	</head>
<body>
		<div class="container theme-showcase"> 
		<div>
		<div class="row">

<div id="chart1" style="height:300px; width:500px;"></div>
		</div>
	<div class="row">
        Select a country from the dropdown box to see the combined medal totals from the Winter and Summer games.
		<br />
<?php
$con = mysqli_connect('localhost','johnfoxs_oly','N1zz!wald');
$con->set_charset('utf8');

if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"johnfoxs_olympics");
//Check the amount of rows to randomize

$sql="SELECT DISTINCT(Country) FROM main_olympic_data ORDER BY Country";
$result = mysqli_query($con,$sql);
echo("<select name='country_selector' id='country_selector'>");
while($row = mysqli_fetch_array($result))
  {
	echo("<option name='".$row['Country']."'>".$row['Country']."</option>");
  }
echo("</select>");

mysqli_close($con);
?>
		</div>
		</div>
		</div>
<script>
var plot2 = "";
$(document).ready(function(){
updateGraph("USA");
});
    
$("#country_selector").change(function(event) {    
    var getCountry = $("#country_selector").val();
    updateGraph(getCountry);
    plot2.replot(); 
});   
                              
function updateGraph(selectedCountry) {
  var ajaxDataRenderer = function(url, plot, options) {
    var ret = null;
    $.ajax({
      // have to use synchronous here, else the function 
      // will return before the data is fetched
      async: false,
      url: url,
      dataType:"json",
      success: function(data) {
        ret = data;
      }
    });
    return ret;
  };

  var jsonurl = "getMedals.php?country="+selectedCountry;
  plot2 = $.jqplot('chart1', jsonurl,{
    title: "Olympic Medals By Country Since 1900: "+selectedCountry,
    dataRenderer: ajaxDataRenderer,
    seriesDefaults: {
            renderer: $.jqplot.DonutRenderer,
            rendererOptions: {
                showDataLabels: true,
                dataLabels: 'value',
                sliceMargin: 2,
             innerDiameter: 50,
             startAngle: -90,
                seriesColors: ["#ffe400", "#c7c7c7", "#ffa800"]
            }
        },
    legend: { show: true, location: 'e' }
   
  });
}
</script>
	</body>
</html>
