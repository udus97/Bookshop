<?php
// Create HTMLTable namespace that contains the HTMLTable class that will be used in this file
use alesinicio\HTMLTable;
// Require the file that contains functions that will be used in this page
require_once "./includes/functions.inc.php";
// Get the unique number of authors in the authorName table
$count = DB::query('SELECT COUNT(distinct authorName) as counts from author');?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>My Bookshop</title>
    <link href="./css/bookshop.css" rel="stylesheet">
  </head>

  <body>
    <div class="wrapper">

      <div id="fixed">
        <h1>My Bookshop</h1>


        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <input placeholder="Enter the name of an author or the title of the book" type="text" list="someList" name="search" />
          <button name="submit" type="submit">&#10140;</button>
          <datalist id="someList">
          <!--Generate the HTML that will dynamically fill the autocomplete input field with the names of the author-->
            <?= generate_datalist_html();?>
          </datalist>
        </form>

      </div>
      <?php
    //   If the user entered an empty search string; prompt them to enter a search string
if(isset($_POST['submit'])){
if(empty($_POST['search'])){
echo '<table><span class = "empty"> Please enter a search string</span></table>';
}//endif

else{
    // Otherwise, if the user did not enter a non-empty search string, query the database for books that match the name entered into the search field.
$results = DB::queryRaw("SELECT title,authorName,bookType as type,bookShelf as shelf,units from temp where authorName like %ss0 or title like %ss1 order by title",$_POST['search'],$_POST['search']);


$table = $results->fetch_all();
// If no result was found.
if(empty($table)){
echo "<table><span class = \"not_found\">A book with that title or author was not found in the database</span></table>";}
else{
//If book(s) were found, pass the response of the database query to the HTMLTable object that prints the results out.

$arrHeaders = ["TITLE","AUTHOR","TYPE","SHELF","UNITS"];
$arrData = $table;
$table = new HTMLTable();
$table->createTableTag(true);
$table->setData($arrData);
$table->setHeaders($arrHeaders);
echo $table->getHTML();
}
}
unset($_POST['submit']);}
?>
    </div>
  </body>
  </html>