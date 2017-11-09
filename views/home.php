<h1> ini halaman home </h1>
<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus ut tempore, illo rem reiciendis ducimus ipsum asperiores possimus optio doloremque nihil nostrum sint recusandae assumenda id veritatis, ab modi adipisci? </p>

<?php

if (isset($nama)) {
	echo $nama;
}

if (isset($data_artikel)){
 	foreach ($data_artikel as $row) {
	 	?>
		<h3><?php echo $row['judul']; ?></h3>
		<p><?php echo $row['isi']; ?></p>
		<?php
	}
}

?>