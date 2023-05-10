<?php
require "Database.php";
class File extends Database
{

	public static $errorFormat = "The Extension does not follow file format";
	public static $errorLarge = "The file is too large";
	public $fileSize;
	public $validImageExtension;
	public $newImageExtension;
	/*
	___________________________________________
	The property above shows different errrs you can access
	___________________________________________
	*/
	public function upload($imageName, $query, string $directory, $dbname)
	{
		$connect = new Database();
		$fileName = $_FILES[$imageName]['name'];
		$tmpName = $_FILES[$imageName]['tmp_name'];
		$this->fileSize = $_FILES[$imageName]['size'];
		$this->validImageExtension = ['jpeg', 'jpg', 'png'];
		$imageExtension = explode('.', $fileName);
		$imageExtension1 = strtolower(end($imageExtension));
		/*
		___________________________________________
		Using some conditional construct here 
		___________________________________________
		*/
		if (!in_array($imageExtension1, $this->validImageExtension)) {
			echo self::$errorFormat;
		} else if ($this->fileSize > 1000000) {
			echo self::$errorLarge;
		} else {
			$this->newImageExtension = uniqid() . '.' . $imageExtension1;
			move_uploaded_file($tmpName, $directory . $this->newImageExtension);
			$stmt = $connect->connect($dbname);
			$stmt1 = $stmt->prepare($query);
			return $stmt1;
		}
	}
}
?>