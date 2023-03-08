<?php
$country="";
$searchbox="";
if (isset($_POST['country'])){
$country=$_POST['country'];}
//echo " the country u r in".$country;
if(isset($_POST['search'])){
	$searchbox=$_POST['search'];
}

//echo "The text box contains :".$searchbox;
$dropbox=$_POST['entertainment'];
// echo $dropbox;

switch($_POST['entertainment']) 
{
	// case "music": 	<body style="background-image:url('songs.jfif');width:100%;"></body><?php
	// 				echo "music";
	// 				getSongs($country,$searchbox);
					
	// 				break;
	case "videos":	?><!-- <body style="background-image:url('video.jpg');width:100%;"> --></body>
					
						<?php
					getVideos($country,$searchbox,$dropbox);
					break;			
	case "news":	
					getNews($country,$searchbox);
					break;
	case "books":	?><h1 align="center">Read ! Learn ! Enjoy</h1><body style="background-image:url('book.jpg');width:100%;height:100%;background-repeat: no-repeat;background-size: cover;"></body>
					<?php
					getBooks($country,$searchbox);
					break;
	

}
// function getSongs($country,$searchbox)
// {
// 	echo "music";
// }
function getVideos($country,$searchbox,$dropbox)
{
	if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setDeveloperKey('AIzaSyCcwuZTOSpcjciXWnjqP8lbv8fe0FiQ5qI');

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);
$final=$searchbox;
$final.=$dropbox;
$final.=" from ";
$final.=$country;
// echo "HERE : ".$final;
$queryParams = [
    'maxResults' => 25,
    'q' => $final
];
$response = $service->search->listSearch('snippet', $queryParams);
//echo($response->items[0]->title);
//echo(json_encode($response, JSON_PRETTY_PRINT));
?><!-- <h1 align="center">Watch! Enjoy! Learn!</h1> -->  <?php
for($i=0;$i<25;$i++)
{
	
	echo "<br>";?>
	<div>
	<?php
	$name=$response->items[$i]->snippet->title;
	$name.=$response->items[$i]->id->videoId;
	echo $name;?>
	<a href="<?php echo $name; ?>" style="font-size: 20px; color:white;" >video</a>
	<?php
	echo "<br>";
	//echo($i->id->videoId);
}
}
function getNews($country,$searchbox)
{
	?><h1 style="text-align:center;"><?php echo "Let's Find Out! What Is Going On Around The World.";?></h1><?php
	require("news.php");
	output_rss_feed('https://news.google.com/news/rss',20,true,true,200);

}
function getBooks($country,$searchbox)
{
	
	if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setDeveloperKey('AIzaSyCcwuZTOSpcjciXWnjqP8lbv8fe0FiQ5qI');
$service = new Google_Service_Books($client);
$optParams = array('q'=>$searchbox );//'filter' => 'free-ebooks');
$results = $service->volumes->listVolumes('intitle', $optParams);
//echo(json_encode($results));
 foreach ($results as $item) {
  ?><p style="font-size: 20pt; color:black;"><?php echo $item['volumeInfo']['title']."<br /> \n"; ?></p><?php
}
}


?>