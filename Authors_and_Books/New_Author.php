<?php
    $title = 'New Author';
    include 'header.php';
?>

 <?php       
        $query = 'SELECT * FROM authors';
        $select = mysqli_query($connect, $query);
        $data = array();
 ?>
<section>
    <a href = "New_Book.php">Books</a>

    <form method="get">
        <label for="author">Author:</label>
        <input type = "text" id="author" name= "author_name" />
        <span id="error"><?php echo @$error['author']; ?></span><br />
        <input type = "submit" value="Add" />       
    </form>
    <table border="1">
        <thead>
            <tr>
                <td>Authors</td>
            </tr>
        </thead>

            <?php
            while( $option = mysqli_fetch_assoc($select) ) {
                $data[] = $option['author_name'];
            ?>
        <tr><td><a href="Author'sBooks.php?author-id=<?php echo $option['author_id'];?>"><?php echo htmlspecialchars($option['author_name']); ?></a></td></tr>

            <?php }?>
    </table>
</section>
<?php
    if($_GET){
        mb_internal_encoding('UTF-8');
        $author = mysql_real_escape_string(trim($_GET['author_name']));
        $error = array();
        if(mb_strlen($author) < 3) {
            $error['author'] = 'Author name is too short. Please try again!';
        }
        if( count($error) == 0) {
            if(in_array($author, $data)){
                echo 'Is Exists';
                exit;
            }
            $query_insert = "INSERT INTO `authors` ( `author_name` ) VALUES( '{$author}' )";
            if( $insert = mysqli_query( $connect, $query_insert ) ){
                header('location: New_Author.php');
            }
        }
    }
?>
<?php
    include 'footer.php';
?>