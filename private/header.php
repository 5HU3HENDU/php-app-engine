<!DOCTYPE html>
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108120056-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108120056-1');
</script>

<meta charset="utf-8" />
<title>
<?php
echo "$title"; 
?>
</title>

<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="favicon.ico">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="application-name" content="chalparty.co" />
<meta name="description" content="<?php echo "$description"; ?>" />

</head>

<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2033621343539775',
      xfbml      : true,
      version    : 'v2.11'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<header>
<a href="index.php" title="home page">
<h1>ChalPartyCo</h1>
<p>CHAL PARTY KO!!!</p>
</a>
</header>
<hr>

