<?php
    $title = 'Authors and Books';
    include 'header.php';
?>

<?php
    //Get data from DB;
    $query = 'SELECT `books`.book_id,`books`.book_title,`books`.img,`books`.file_name,`authors`.author_name, `authors`.author_id FROM `books` LEFT JOIN `books_authors` ON  `books`.book_id = `books_authors`.book_id LEFT JOIN authors ON `authors`.author_id = `books_authors`.author_id';
    $booksAndAuthors = mysqli_query($connect, $query);
    $result = array();
    while ($printData = mysqli_fetch_assoc($booksAndAuthors)){
        $result[$printData['book_id']]['title']=$printData['book_title'];
        $result[$printData['book_id']]['authors'][]=array($printData['author_name'], $printData['author_id']);
        $result[$printData['book_id']]['img'] = $printData['img'];
		$result[$printData['book_id']]['file_name'] = $printData['file_name'];
    }
?>

<?php
        //Sorting data;
        if(($_GET)){
            $search = (int)$_GET['search'];
            $err = array();
            if($search > 4 || $search < 0 ) {
                $err['index'] = 'Invalid index';
            }
            if(count($err)==0 && $search>0){
                usort($result, function($a, $b) use($search){
                if($search == 1 || $search== 2){
                    if($search == 1){
                        if(strnatcmp (strtolower($a['title']), strtolower($b['title'])) == 0){
                            return 0;
                        }
                        return (strnatcmp (strtolower($a['title']), strtolower($b['title']))<0 ? -1 : 1);
                    } else {
                        return (strnatcmp (strtolower($a['title']), strtolower($b['title']))>0 ? -1 : 1);
                    }
                } else {
                      if($search == 3){
                        if(strnatcmp (strtolower($a['authors'][0][0]), strtolower($b['authors'][0][0])) == 0){
                          return 0;
                        }
                        return (strnatcmp (strtolower($a['authors'][0][0]), strtolower($b['authors'][0][0]))<0 ? -1 : 1);
                    } else {
                        return (strnatcmp (strtolower($a['authors'][0][0]), strtolower($b['authors'][0][0]))>0 ? -1 : 1);
                    }
                }
            });
            }
        }
        ?>
<section>
    <label for="sort">Sort:</label>
    <select id="sort" onchange="sorting()" name="search">
        <option value="0" >Normal</option>
        <optgroup label="Sorting Books">
        <option <?php echo @$search==1 ? 'selected': ''; ?> value="1">Ascending</option>
        <option <?php echo @$search==2 ? 'selected': ''; ?> value="2">Descending</option>
      </optgroup>
      <optgroup  label="Sorting Authors">
        <option <?php echo @$search==3 ? 'selected': ''; ?>  value="3">Ascending</option>
        <option <?php echo @$search==4 ? 'selected': ''; ?> value="4">Descending</option>
      </optgroup>
    </select><br />

        <?php
            foreach ($result as $book){
            	echo "<article>";
                echo '<img src="BookCover/'.$book['img'].'"/>';
                echo '<div><h3>'.htmlspecialchars($book['title']).'</h3>';
				echo '<span>By ';
                foreach ($book['authors'] as $author) {
                    echo '<a href="Author\'sBooks.php?author-id='.$author[1].'">'.htmlspecialchars($author[0]).'</a> ';
               }				
                echo "</span>";
                echo '<div>Download pdf: <a href="pdfDocument/'.htmlspecialchars($book['file_name']).'">Download</a></div></div></article>';
                    
                     
            }
?>
    
</section>
<?php
    include 'footer.php';
?>