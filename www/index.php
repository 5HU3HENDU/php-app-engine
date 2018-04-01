<?php
require_once __DIR__ . '/../private/redirect.php';

$title = "ChalPartyCo - Chal party Ko!";
$description = "See upcoming events, college fests and parties happening around and places nearby them to visit for spending quality time with your friends and family";
require_once __DIR__ . '/../private/header.php';
?>
<p>
Lots of events are happening aroud you<br>
College fests, parties, social events and lot more...<br>

<a href="party.php" class="button">See Upcoming events...</a>
</p>
<p>
Many colleges & social groups are hosting events<br>

<a href="place.php" class="button">See list of places...</a>
</p>
<p>
You can also list your college events or any other event<br>
here for FREE, always.<br>
Or if you know any event which we should list here<br>
Please let us know by filling this simple form below :)<br><br><br>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdemqwUHrvrLoA6LrsDOVtzFwO7JV7yk8_fGPJHG5yC2mG8fg/viewform?embedded=true" height="250" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
</p>

<?php
include_once __DIR__ . '/../private/share.php';

require_once __DIR__ . '/../private/footer.php';
?>

