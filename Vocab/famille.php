<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>ExoTut.html</title>
</head>
	<body>
	<section>
		<p><h1>Les familles - Keluarga</h1></p>
		
		<table id=cours>
<tr>
			<th>Fran�ais</th>
			<th>Malais</th>
		</tr>
		
			<?php	
				include("./tab.php");
				foreach($famille as $n => $val)
				{
					echo "<tr><td> $n </td>";
					echo "<td> $val </td></tr>";
				}
			?>
		</table>

	
	</section>
	</body>
</html>
