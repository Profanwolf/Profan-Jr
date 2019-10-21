<html>
<head>
<link rel="stylesheet" href="style.css"> 
</head>

<?php
$name =  $comment =  "";// записывает коммент

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	
	function format($data) {
		$data = trim($data); 
		$data = stripslashes($data); 
		$data = htmlspecialchars($data); 
		return $data; 
	}

	$email = format($_POST["email"]);
	$name = format($_POST["name"]);
	$comment = format($_POST["comment"]);	

	if($comment != "") {
		$date = date("d.m.Y H:m:s");
		$file = file_get_contents("chat.txt"); 
		$datarray = unserialize($file); 
		$full = array 
		($date, $email, $name, $comment);
		$datarray[] = $full; 
		$newfile = serialize($datarray); 
		file_put_contents("chat.txt", $newfile); 
		//rabotai sobaka
		//header("Location: ".$_SERVER['REQUEST_URI']);
	}
}
?>

<body>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="container" >
	<div class="row">					
		<div class="form-group col-sm-6">
			<label for="name" class="h4">Ваше имя</label>
			<input name="name" class="form-control" id="name" placeholder="Введите имя" required>
		</div>
		<div class="form-group col-sm-6">
			<label for="email" class="h4"> Ваш email</label>
			<input type="email" name="email" class="form-control" id="email" placeholder="Введите email" required>
		</div>
	</div>
	<div class="form-group">
		<label for="comment" class="h4 ">Отзыв</label>
		<textarea name="comment"id="comment" class="form-control" rows="5" placeholder="Введите сообщение" required></textarea>
	</div>
	<div>
		<button type="submit" id="form-submit" class="btn btn-primary  pull-right ">Отправка</button>
	</div>
	</div>

<?php
		
//выводит новый созданный комментарий
		
$file = file_get_contents("chat.txt"); 
$datarray = unserialize($file); 
$max = count($datarray); 
for ($row = $max-1; $row > -1; $row--) {
	 echo "<div class='Container' ><p class='MailAndDate'>" .$datarray[$row][0]. " | " .$datarray[$row][1]. "<div class='name'></p><strong>" .$datarray[$row][2]. "</strong><br> сказал: <em>" . $datarray[$row][3] . "</em></div><p class='Comment'></div></span>"; 
}
		
?>
		
</body>
</html>