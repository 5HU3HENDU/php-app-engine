<?php
require_once __DIR__ . '/../private/redirect.php';

$title = "Place List - Chal Party Ko!";
$description = "See list of of places hosting events, fests or parties";
require_once __DIR__ . '/../private/header.php';

require_once __DIR__ . '/../private/connection.php';

if(isset($_GET['place']) AND (int)($_GET['place'])>0)
{
	$place_id = (int)$_GET['place'];
	$sql = "SELECT name,
		concat(address,'<br>',city,',',pin_code,'<br>',state) AS 
		address,how_to_reach,phone,website,acronym,description,link
		FROM place,twitter WHERE place.place_id={$place_id} AND twitter.place_id={$place_id}";	

 if(!$result = $mysqli->query($sql))
{
    echo "<p>Sorry, unable to show details of this place due to error in connecting to database :(</p>";
}

 if($result->num_rows === 0)
{ 
    echo "<p>Extremely sorry, looks like we don't have any place numbered {$place_id} :(</p>";
}

 if($result->num_rows >= 1)
{
    $place = $result->fetch_assoc();
echo<<<END
<h2>{$place['name']} - {$place['acronym']}</h2>
<p>
Address:<br>
{$place['address']}<br>
How To Reach Here:<br>
{$place['how_to_reach']}<br>
Phone:{$place['phone']}<br>
Website:{$place['website']}<br>
About:<br>
{$place['description']}
</p>
<center>
{$place['link']}
</center>
<h3>Tag your friends,Comment & express your thoughts...<br>
tick ☑️ Also Post on Facebook(Please😊)
</h3>
<center>
<div class="fb-comments" data-href="https://www.chalparty.co/place.php?place={$place_id}" data-numposts="3"></div>
</center>
END;
}
$result->free();

    $sql = "SELECT party_id,name,
            Date_Format(from_time,\"%W %D %M %Y,%h:%i %p\") AS from_time,description
            FROM party
            WHERE to_time>=NOW() AND place_id={$place_id}
            ORDER BY from_time ASC";

 if(!$result = $mysqli->query($sql))
{
    echo "<p>Sorry, unable to show list of events happening at this place due to error in connecting to database :(
          </p>";
}

 if($result->num_rows === 0)
{
    echo "<p>Sorry, we don't have any information of events happening at this place :(</p>";
}

 if($result->num_rows >= 1)
{
while ($party = $result->fetch_assoc()) 
{
echo<<<END
<h3>{$party['name']}</h3>
<p>
Shortcut web address: chalparty.co/{$party['name']}<br>
From {$party['from_time']} onwards<br>
{$party['description']}<br>

<a href="party.php?party={$party['party_id']}" class="button">Know more</a>
</p>
END;
}
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
echo "<h2>List Of Places</h2>";

$sql = "SELECT place_id,name,acronym,city,description
	FROM place
        WHERE acronym IS NOT NULL
        ORDER BY name ASC";

 if(!$result = $mysqli->query($sql))
{
    echo "<p>Sorry, unable to show list of places due to error in connecting to database :(</p>";
}

 if($result->num_rows === 0)
{ 
    echo "<p>Extremely sorry, currently we don't have any place record in our database :(</p>";
}
 if($result->num_rows >=1)
{
while ($place = $result->fetch_assoc()) 
{
echo<<<END
<p>
{$place['name']}-({$place['acronym']})<br>
Shortcut - chalparty.co/{$place['acronym']}<br>
City: {$place['city']}<br>
{$place['description']}<br>

<a href="place.php?place={$place['place_id']}" class="button">Know more</a>
</p>
END;
}
}

echo<<<END
<p>
Didn't find your college name here?<br>
Fill this form and we will add it, for sure
</p>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdemqwUHrvrLoA6LrsDOVtzFwO7JV7yk8_fGPJHG5yC2mG8fg/viewform?embedded=true" height="250" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
END;

$result->free();
$mysqli->close();

}
include_once __DIR__ . '/../private/share.php';
require_once __DIR__ . '/../private/footer.php';
?>

