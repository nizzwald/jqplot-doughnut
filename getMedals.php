<?php
header("Content-Type: text/html");
$country = $_GET["country"];

class countryMedals {
    public $Bronze = "0";
    public $Silver = "0";
    public $Gold = "0";
}

//$country = "USA";
$con = mysqli_connect('localhost','johnfoxs_oly','N1zz!wald');
$con->set_charset('utf8');

if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"johnfoxs_olympics");
//count the medals via count
$sql="SELECT Medal, COUNT( * ) FROM main_olympic_data WHERE Country ='".$country."' GROUP BY Medal";
$result = mysqli_query($con,$sql);
$data = array();
$medals = new countryMedals();
while($row = mysqli_fetch_array($result))
  {
    if($row['Medal'] == "Gold") {
        $medals->Gold = $row['1'];
    }
    else if($row['Medal'] == "Silver") {
        $medals->Silver = $row['1'];
    }
    else if($row['Medal'] == "Bronze") {
        $medals->Bronze = $row['1'];
    }
    else {
    // do nothing
    }
}
print('[[["Gold", '.$medals->Gold.'],["Silver", '.$medals->Silver.'],["Bronze", '.$medals->Bronze.']]]');
mysqli_close($con);
?>