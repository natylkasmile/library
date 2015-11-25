<?php
	include "mysql.connect.php";
	mysql_query('SET NAMES cp1251');
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<title>Добавление материала</title>
	</head>
	<body align="center">
		<h2>Добавление материала</h2><br>
		<?php
			if(isset($_POST['addBook'])) {
				if($_POST['Name'] != null && $_POST['Author'] != null && $_POST['Annotation'] != null && $_POST['Pages'] != null && $_POST['Department'] != null && $_POST['Subject'] != null && $_POST['Tags'] != null && $_POST['Link'] != null) {
					$CountTable = mysql_query("SELECT COUNT(1) FROM books");
					$Count = mysql_fetch_array($CountTable);
					$ID = $Count[0]+1;
					
					$Name = $_POST['Name'];
					$Author = $_POST['Author'];
					$Annotation = $_POST['Annotation'];
					$Pages = $_POST['Pages'];
					$Department = $_POST['Department'];
					$Subject = $_POST['Subject'];
					$Tags = $_POST['Tags'];
					$Link = $_POST['Link'];
					$Date = date("d.m.Y");
					
					MySQL_Query("INSERT INTO `{$database}`.`books` (`ID`, `Name`, `Author`, `Annotation`, `Pages`, `Department`, `Subject`, `Tags`, `Date`, `Appeals`, `LastAppeals`, `Link`) VALUES ('{$ID}', '$Name', '{$Author}', '{$Annotation}', '{$Pages}', '{$Department}', '{$Subject}', '{$Tags}', '{$Date}', '0', '{$Date}', '{$Link}')");
					
					echo "Книга успешно добавлена.<br>";
				} else {
					echo "Заполните все поля.<br>";
				}
			}
		?>
		<form method="post">
			<table align="center" border="0">
				<tr>
					<td>Название:</td>
					<td><input type="text" name="Name" value="<?php if($_POST['Name'] != null) echo $_POST['Name']; ?>"></td>
				</tr>
				<tr>
					<td>Автор:</td>
					<td><input type="text" name="Author" value="<?php if($_POST['Author'] != null) echo $_POST['Author']; ?>"></td>
				</tr>
				<tr>
					<td>Описание:</td>
					<td><input type="text" name="Annotation" value="<?php if($_POST['Annotation'] != null) echo $_POST['Annotation']; ?>"></td>
				</tr>
				<tr>
					<td>Страниц:</td>
					<td><input type="text" name="Pages" value="<?php if($_POST['Pages'] != null) echo $_POST['Pages']; ?>"></td>
				</tr>
				<tr>
					<td>Кафедра:</td>
					<td><input type="text" name="Department" value="<?php if($_POST['Department'] != null) echo $_POST['Department']; ?>"></td>
				</tr>
				<tr>
					<td>Предмет:</td>
					<td><input type="text" name="Subject" value="<?php if($_POST['Subject'] != null) echo $_POST['Subject']; ?>"></td>
				</tr>
				<tr>
					<td>Теги:</td>
					<td><input type="text" name="Tags" value="<?php if($_POST['Tags'] != null) echo $_POST['Tags']; ?>"></td>
				</tr>
				<tr>
					<td>Ссылка:</td>
					<td><input type="text" name="Link" value="<?php if($_POST['Link'] != null) echo $_POST['Link']; ?>"></td>
				</tr>
			</table>
			<br>
			<input type="submit" name="addBook" value="Добавить">
		</form>
	</body>
</html>