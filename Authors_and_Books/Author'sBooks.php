<?php
    $title = 'Search Author';
    include 'header.php';
?>
<?php
    $authorID = mysql_real_escape_string(trim($_GET['author-id']));
    $querySelect = "SELECT `authors`.author_name, `books`.book_title, `books`.img, `books`.file_name FROM `authors` LEFT JOIN `books_authors` ON `authors`.author_id = `books_authors`.author_id LEFT JOIN books ON `books`.book_id = `books_authors`.book_id	WHERE `authors`.author_id = {$authorID}";
    $select = mysqli_query($connect, $querySelect);
    $result = array();
    while ($res = mysqli_fetch_assoc($select)){
        $result['search']['author'] = $res['author_name'];
        $result['search']['books'][] = $res['book_title'];
		$result['search']['img'][] = $res['img'];
		$result['search']['file'][] = $res['file_name'];
    }    
?>
<section>
	<h2>Author:
<?php
     echo htmlspecialchars($result['search']['author']);
?>

</h2>
<?php
    for($i=0; $i<count($result['search']['books']); $i++){
        echo '<article>';
		echo '<img src="BookCover/'.htmlspecialchars($result['search']['img'][$i]).'"/>';
		echo '<div>';
        echo '<h3>'.htmlspecialchars($result['search']['books'][$i]).'</h3>';
		echo '<a href="pdfDocument/'.htmlspecialchars($result['search']['file'][$i]).'">Download</a>';	
        echo '</div></article>';
    }
?>
        </tr>
    </tbody>
</table>

<?php
    include 'footer.php';
?>