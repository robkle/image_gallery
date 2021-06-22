<?php
include_once "dbs.class.php";

class Images extends Dbs
{
	protected function insert_img($file_dest, $img_desc)
	{
		$pdo = $this->connect();
		$sql = $pdo->prepare("INSERT INTO images (img_file, img_desc, img_date) VALUES(:img_file, :img_desc, :img_date)");
		$sql->execute(array(
			"img_file" => $file_dest,
			"img_desc" => $img_desc,
			"img_date" => date("Y-m-d H:i:s")));
	}
}
