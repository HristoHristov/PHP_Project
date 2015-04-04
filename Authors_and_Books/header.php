<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title><?php echo $title; ?></title>
        <script src="sort.js"></script>
        <style>
        body,h3,section, article {
      		margin: 0;	  	
        }
body {	
	background: rgb(225, 225, 196);
}
#wrapper {
	margin: 0px auto;
	width: 80%;
	background: white;
	min-height: 663px;
}
 header{ 	
	width: 100%;
	margin: 0 auto;
        margin-bottom: 10px;
	height: 29px;
	background: #D7A668;
}
header ul li {	
	width: 100px;
	height: 30px;	
	display: inline-block;
	text-align: center;
	list-style: none;
        padding: 4px;
}
header ul li a {
	text-decoration: none;
	margin: 0 auto;
	color: white;
}
input[type="search"] {
	vertical-align: middle;
}
section{
    margin: 0 70px;
}
section article {
    margin-top: 20px;
	display: inline-block;
	width: 310px;
} 
section article div {
	margin-top: 2px;
	display: inline-block;
	vertical-align: top;
}
section article img {
	width: 130px;
	height: 165px;
}
section article div {
	width: 175px;
}
table {
    border: 1px solid black;
    padding: 5px;
    width: 250px;
    text-align: center;
    border-collapse: collapse;
}
</style>
    </head>
    <body>
   		<div id="wrapper">
			<header>
				<form method="get" action="Search.php">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="New_Book.php">New Book</a></li>
					<li><a href="New_Author.php">New Author</a></li>
					<li><input type="search" name="search" placeholder="Searching books" /></li>
				</ul>
			</header>
			</form>
        <?php
            $host = 'localhost';
            $username = 'hristo9153';
            $pass = '1111111';            
            $db = 'books_authors';
             $connect = mysqli_connect($host, $username, $pass, $db);
            if(!$connect){
                echo 'error';
                exit;
        }
        mysqli_set_charset($connect, 'utf8');   
        ?>