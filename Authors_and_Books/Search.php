<?php
    $title = 'Search books';
    include 'header.php';
?>

<?php
    if($_GET){
        $search = mysql_real_escape_string(trim($_GET['search']));        
       $querySelect = "SELECT `books`.book_id,`books`.book_title,`books`.img,`books`.file_name,`authors`.author_name, `authors`.author_id FROM `books` LEFT JOIN `books_authors` ON  `books`.book_id = `books_authors`.book_id LEFT JOIN authors ON `authors`.author_id = `books_authors`.author_id	WHERE `books`.book_title = '{$search}'";
        $select = mysqli_query($connect, $querySelect);		
		$result = array();
		if($select->num_rows == 0){
			echo 'The book title is incorrect';
			exit;
		}
		while ($d = mysqli_fetch_assoc($select)) {
			$result[$search]['title'] = $d['book_title'];
			$result[$search]['img'] = $d['img'];
			$result[$search]['file'] = $d['file_name'];
			$result[$search]['authors'][$d['author_id']]=$d['author_name'];
			echo '<br />';	
		}		
    }
?>
	<section>
		<article>
			<img src="BookCover/<?php echo $result[$search]['img']; ?>" />
			<div>
				<h3><?php echo htmlspecialchars($result[$search]['title']); ?></h3>
				<span>By: 
			<?php
				foreach($result[$search]['authors'] as $key=>$author) {
					echo '<a href="Author\'sBooks.php?author-id='.$key.'">'.htmlspecialchars($author).'</a> ';
				}
			?>
			</span>
			<div>Download pdf: <a href="pdfDocument/<?php echo htmlspecialchars($result[$search]['file']); ?>">Download</a></div>
			</div>
		</article>
	</section>
<?php
    include 'footer.php';
?>