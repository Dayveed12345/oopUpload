<?php
spl_autoload_register(function ($className) {
	$class = $className . '.php';
	require($class);
});
if (isset($_POST['submit'])) {
	$uploads = new File();
	$query = "INSERT INTO laratb(name)VALUES(?)";
	$move = $uploads->upload('image', $query, 'assets', 'laravel');
	$execute = $move->execute([$uploads->newImageExtension]);
	if (!$execute) {
		echo "EAn erro occured check your internet connection";
	} else {
		echo "Uploaded Successfully";
	}
}

?>