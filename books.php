<?php
echo "books";
	if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setDeveloperKey('AIzaSyCcwuZTOSpcjciXWnjqP8lbv8fe0FiQ5qI');
$service = new Google_Service_Books($client);
$optParams = array('filter' => 'free-ebooks');
$results = $service->volumes->listVolumes('swami vivekanand', $optParams);?>
echo $results;
echo json_encode($results, JSON_PRETTY_PRINT);
foreach ($results as $item) {
  //echo $item['volumeInfo']['title'], "<br/> \n"; 
 <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Books Embedded Viewer API Example</title>
    <script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
    <script type="text/javascript">
      google.books.load();

      function initialize() {
        var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
        viewer.load('ISBN:0738531367');
         //viewer.load('ISBN:_10');
      }

      google.books.setOnLoadCallback(initialize);
    </script>
  </head>
  <body>
    <div id="viewerCanvas" style="width: 600px; height: 500px"></div>
  </body>
</html>


?>