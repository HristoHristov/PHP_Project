<?php
    $title = 'New Book';
    include 'header.php';
?>

<?php
    $query = 'SELECT `authors`.author_id,`authors`.author_name,`books`.book_id,`books`.book_title FROM `authors`, `books`';
    $getData = mysqli_query($connect, $query);
    $author = array();
    $books = array();    
?>


<section>
    <a href="index.php">Books</a>
    <form method="post" enctype="multipart/form-data">
        <label for="book-title">Book Title: </label>
        <input type="text" id="book-title" name="book-title" /><br />
        <label for="book-cover">Book Cover: </label>
        <input type="file" id="book-cover" name="book-cover" /><br />

        <label for="upload-book">Uploaded Book: </label>
        <input type="file" id="upload-book" name="upload-book" />
        <span class="error"><?php echo @$errors['upload-book']; ?></span><br />

        <select multiple name="author[]">
    <?php
        while( $d = mysqli_fetch_assoc($getData) ) {        
            if(!in_array($d['author_name'], $author)) {
                echo '<option value="'.$d['author_id'].'">'.htmlspecialchars($d['author_name']).'</option>';
                $author[$d['author_id']] = $d['author_name'];           
            }
            if( !in_array($d['book_title'], $books) ){
                $books[$d['book_id']] = $d['book_title'];
            }
        }     
    ?>
        </select><br />
        <input type="submit" value="Save"/>
    </form>
</section>

<?php
    if($_POST) {
        mb_internal_encoding('UTF-8');
        $maxKey = (max(array_keys($books)))+1;
        $error=false;
        
        //Get data;
        $bookTitle = mysql_real_escape_string(trim($_POST['book-title']));
        $authorsInput = $_POST['author'];
        $bookCover = mysql_real_escape_string(trim($_FILES['book-cover']['name']));
        $uploadBookName = mysql_real_escape_string(trim($_FILES['upload-book']['name']));

        //Checking input data;
        if( mb_strlen($bookTitle) < 3 ) {
            $error=true;
            echo 'Book title is too short';
        }
        if( count($authorsInput) == 0 ) {
            $error=true;
            echo 'Please select author';
        }

        //Checking files type;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);        
        $mime = finfo_file($finfo, $_FILES['book-cover']['tmp_name']);
        $mimeDocument = finfo_file($finfo, $_FILES['upload-book']['tmp_name']);
        if (!(($mime == 'image/png') || ($mime == 'image/gif') || ($mime == 'image/jpg') || ($mime == 'image/jpeg') || ($mime == 'image/jpe'))) {
            $error=true;
            echo  'The book cover Type is invalid';
        }
        if(!$mimeDocument == 'application/pdf') {
            $error=true;
           echo'Invalid File Type';
        }
        //Moving Files
        if(!$error){
            if(!(move_uploaded_file($_FILES['book-cover']['tmp_name'], 'BookCover'.DIRECTORY_SEPARATOR. $bookCover) && move_uploaded_file($_FILES['upload-book']['tmp_name'], 'pdfDocument'.DIRECTORY_SEPARATOR. $uploadBookName))){
                'Uploaded error';
                exit;
            }       
            $queryInsertInAuthor = "INSERT INTO `books`(`book_title`, `img`, `file_name`) VALUES('$bookTitle', '$bookCover', '$uploadBookName')";
            if(!in_array($bookTitle, $books)){
                if(!mysqli_query($connect, $queryInsertInAuthor)){
                    echo 'Error';
                    exit;
                }
                $querySaveInAuthorsBooks = 'INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES ';
                for($i=0; $i<count($authorsInput); $i++){
                    if($i<count($authorsInput)-1){
                        $querySaveInAuthorsBooks.="('$maxKey','".htmlspecialchars($authorsInput[$i])."'),";
                    }
                    else {
                        $querySaveInAuthorsBooks.="('$maxKey','$authorsInput[$i]')";
                    }
                }
                if(mysqli_query($connect, $querySaveInAuthorsBooks)){
                    echo 'Save';
                }
                else {
                    echo 'err';
                   echo mysqli_error($connect);
                }
            }
        }
    }
?>

<?php
    include 'footer.php';
?>