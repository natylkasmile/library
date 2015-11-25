<?php 
	include "mysql.connect.php";
	mysql_query("SET NAMES cp1251");

	$valueSearch = $_POST['valueSearch'];
	
	if(isset($_GET['addAppeals'])) {
		
		if($_GET['addAppeals'] != null) {
			$result = mysql_query("SELECT * FROM books WHERE ID=".$_GET['addAppeals']."");
			$data = mysql_fetch_array($result);
			
			$updateAppeals = $data['Appeals'] + 1;
			$updateLastAppeals = date("d.m.Y");
			
			MySQL_Query("UPDATE `{$database}`.`books` SET `Appeals` = '$updateAppeals' WHERE ID=".$_GET['addAppeals']."");
			MySQL_Query("UPDATE `{$database}`.`books` SET `LastAppeals` = '$updateLastAppeals' WHERE ID=".$_GET['addAppeals']."");
			
			header("Location: ".$data['Link']."");
		} else {
			echo "Не возможно перейти на страницу.";
		}
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<title><?php if($valueSearch != null) echo "".$valueSearch." | "; ?>Library Cube - Special for You</title>
	</head>
	<body>
		<table style="width: 700px;" border="0" align="center" cellpadding="20">
			<tbody>
				<tr bgcolor="#FFFFFF">
					<td>
						<p align="center" style="font-size: 26px"><a href="/" ><img src="images/logo.png" width="70" height="60" /></a>Library Cube - Special for You</p>
						<form method="post">
							<input type="text" name="valueSearch" style="font-size: 26px" onmouseover="focus()"  value="<?php if($valueSearch != null) echo $valueSearch; ?>" size="35">
							<input type="submit" name="buttonSearch" style="font-size: 26px" value="Поиск" />
						</form>
						<div id="cse-search-results">
							<?php								
								if(isset($_POST['buttonSearch'])) {
									if($valueSearch != null) {
										$result = mysql_query("SELECT * FROM books WHERE Name like \"%{$valueSearch}%\" OR Author like \"%{$valueSearch}%\" OR Annotation like \"%{$valueSearch}%\" OR Department like \"%{$valueSearch}%\" OR Subject like \"%{$valueSearch}%\" OR Tags like \"%{$valueSearch}%\"") or die("Запрос ошибочный");

										if(mysql_num_rows($result) == 0) {
											echo "<p style=\"font-size: 18px;\">Запрос <b>".$valueSearch."</b> не дал результатов</p>";
										} else {
											echo "<p style=\"font-size: 18px;\">Показаны результаты по запросу: <b>".$valueSearch."</b></p>";
											
											while($data = mysql_fetch_array($result)) { 
												echo "<form method=\"post\">";
													echo "<p>";
														echo "<a name=\"bookLink\" href=\"?addAppeals=".$data['ID']."\" value=\"123\" >".$data['Name']."/".$data['Author']." - ".$data['Department']."/".$data['Subject']." - ".$data['Pages']." c.</a><br>";
														echo "".$data['Annotation']."<br>";
														echo "Теги: ".$data['Tags']."<br>";
														echo "Дата размещения: ".$data['Date']." | Переходов: ".$data['Appeals']." | Последний переход: ".$data['LastAppeals']."<br>";
													echo "</p>";
												echo "</form>";
											}
										}
									} else {
										echo "<p style='font-size: 18px;'>Запрос не может быть пустым.</p>";
									}
								}
							?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>