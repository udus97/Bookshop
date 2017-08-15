MY BOOKSHOP

This is an application that helps visitors to a bookshop with easily finding a book they are interested in buying. It shows them where the book(s) are in the bookshop (shelf), the type available (paperback or hardback) and whether there are any units left. It reduces the stress customers face going around bookshelf after bookshelf looking for a particular book they are interested in buying.

It helps them to save time and energy by instantly knowing whether a book is available or not.

![application screenshot](https://raw.githubusercontent.com/udus97/Bookshop/master/image1.png)
![application screenshot](https://raw.githubusercontent.com/udus97/Bookshop/master/image2.png)
![application screenshot](https://raw.githubusercontent.com/udus97/Bookshop/master/image3.png)

This application is in its early stages, and I intend to add more features to it, such as a way for the bookshop administrator to query the database to know how many books are in the bookshop, how many books need replacement etc.


It is required that the user restores the sql dump in their localhost and set the necessary parameters in the db.inc.php file before trying to use the applicatiion. Soon I'd add a SQLite file database file as a fallback in the event that there is no access to a database server.

I am  aware that this is spaghetti code, and I hope that as I increase in my knowledge about web development, I'd adopt a PHP framework in building this application. Using a framework, a microframework, especially will help with structure and organisation of the code.

Credit goes to
1. MeekroDB -- The Simple PHP MySQL Library(https://github.com/SergeyTsalkov/meekrodb)
2. Alesinicio -- PHP Array into HTML Table (http://www.github.com/alesinicio/)
