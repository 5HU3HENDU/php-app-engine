# php-app-engine
Google App Engine Project built with php. A sample app which you can modify according to your project.

This is a simple project named "chalpartyco" which I was working on in my spare time.
I uploaded it to google app engine to get hands on with cloud computing.

Here is the detail of each file :-

app.yaml :- A file needed for every google app engine project. It describes how each url will work and where to find corresponding file in the project.

www/
  handler.php :- It handles dynamic urls like mysite.com/xyz or mysite.com/abc and redirect user accordinly
  index.php :- Basic Index page
  party.php :- A php page which shows list of parties. (this was my project)
  place.php :- Page which shows list of all places hosting parties.
  
private/
  connection.php :- database connection file
  footer.php :- Footer page
  header.php :- Header page
  redirect.php :- A 301 redirect page to ot from www to non-www site (you can easily modify that)
  share.php :- php template to build links to share on socail media
  
  
  Now to host it on google app engine :-
  Create an application on google app engine.
  Download Google Cloud SDK
  Now go to directory containing app.yaml, www/ , private/
  and type "gcloud app deploy"
  This will deploy this app with url which will be shown in your command line.
  
  
For any question fell free to connect with me on fb.me/5HU3HENDU or twitter.com/5HU3HENDU
