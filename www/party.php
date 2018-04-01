<?php
require_once __DIR__ . '/../private/redirect.php';

$title = "Upcoming events - Chal Party Ko!";
$description = "See list of upcoming events, college fests and parties here";
require_once __DIR__ . '/../private/header.php';

require_once __DIR__ . '/../private/connection.php';

if(isset($_GET['party']) AND (int)($_GET['party'])>0)
{

    $party_id = (int)$_GET['party'];

### CHANGE FROM HERE TO INCLUDE FB POST, TWITTER, SHARE BUTTON, FB COMMENTS PLUS NEARBY PLACES
    $sql = "SELECT 
		party.name AS party,
		Date_Format(from_time,\"%W %D %M %Y,%h:%i %p\") AS from_time,
            	Date_Format(to_time,\"%W %D %M %Y,%h:%i %p\") AS to_time,
		party.website AS pweb,party.description AS pdesc,

		facebook.link,

		place.place_id,place.name AS place,
		concat(place.address,'<br>',place.city,',',place.pin_code,'<br>',place.state) AS 
		address,
		place.how_to_reach,
		place.phone,place.website,place.acronym,place.description
            	FROM party,facebook,place
		WHERE party.party_id={$party_id} AND facebook.party_id={$party_id} AND party.place_id=place.place_id";
    
if(!$result = $mysqli->query($sql))
{
echo "<p>Sorry, unable to show details of this event due to error in connecting to database :(</p>"; 
}
if($result->num_rows === 0)
{
echo "<p>Extremely sorry, but looks like we don't have any event numbered {$party_id} :(</p>";
}

if($result->num_rows >=1)
{
    $info = $result->fetch_assoc();
    $place_id = $info['place_id'];

echo<<<END
<h2>{$info['party']}</h2>
<p>
Starts:<br>
{$info['from_time']}<br>
Ends:<br>
{$info['to_time']}<br>
<a href="{$info['pweb']}" target="_BLANK">{$info['pweb']}</a><br>
Details:<br>
{$info['pdesc']}
</p>
{$info['link']}
<h3>Tag your friends,Comment & express your thoughts...<br>
tick ☑️ Also post on Facebook(Please😊)
</h3>
<center>
<div class="fb-comments" data-href="https://www.chalparty.co/party.php?party={$party_id}" data-numposts="3"></div>
</center>
<h2>At {$info['place']} - {$info['acronym']}</h2>
<p>
Address:<br>
{$info['address']}<br>
How To Reach Here:<br>
{$info['how_to_reach']}<br>
Phone:{$info['phone']}<br>
<a href="{$info['website']}" target="_BLANK">{$info['website']}</a><br>
About:<br>
{$info['description']}<br>

<a href="place.php?place={$place_id}" class="button">More about this place</a>
</p>
END;
}

$result->free();

$sql = "SELECT place_2 AS place,name,description FROM nearby,place WHERE place_1={$place_id} AND place.place_id=place_2
	UNION
	SELECT place_1 AS place,name,description FROM nearby,place WHERE place_2={$place_id} AND place.place_id=place_1";

if(!$result = $mysqli->query($sql))
{
echo "<p>Sorry, unable to show nearby places to hangout due to error in connecting to database</p>"; 
}
if($result->num_rows === 0)
{
echo "<p>No nearby places to hangout are in our record,we are working on it...</p>";
}
if($result->num_rows >=1)
{
echo "<h2>Nearby Places</h2>";
while ($nearby = $result->fetch_assoc())
{
echo<<<END
<h3>{$nearby['name']}</h3>
<p>
{$nearby['description']}<br>
<a href="place.php?place={$nearby['place']}" class="button">Know more</a>
</p>
END;
}
}
$result->free();
$mysqli->close();
}

else
{
echo "<h2>Upcoming Events</h2>";


    $sql = "SELECT party_id,party.name AS party,place.name AS place,place.city,
            Date_Format(from_time,\"%W %D %M %Y,%h:%i %p\") AS fromT,
	    party.description
            FROM party,place
            WHERE to_time>=NOW() AND party.place_id=place.place_id
            ORDER BY from_time ASC";

 if(!$result = $mysqli->query($sql))
{
    echo "<p>Sorry, unable to show list of events due to error in connecting to database :(</p>";
}

 if($result->num_rows === 0)
{
    echo "<p>Sorry, we don't have any events currently in our database, what can be worse than this? :(</p>";
}

if($result->num_rows >= 1)
{
  while ($party = $result->fetch_assoc()) 
  {
  echo<<<END
  <h3>{$party['party']}</h3>
  <p>
  At {$party['place']},{$party['city']}<br>
  From <br>
  {$party['fromT']} onwards<br>
  Shortcut web address:- chalparty.co/{$party['party']}<br>
  {$party['description']}<br>
  
  <a href="party.php?party={$party['party_id']}" class="button">Know more</a>
  </p>
END;
  }
}

echo<<<END
<p>Do you know any event?<br>
Didn't find your college event?<br>
Fill this form and we will add it here
</p>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdemqwUHrvrLoA6LrsDOVtzFwO7JV7yk8_fGPJHG5yC2mG8fg/viewform?embedded=true" height="250" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
END;
$result->free();
$mysqli->close();
}

include_once __DIR__ . '/../private/share.php';
require_once __DIR__ . '/../private/footer.php';
?>

