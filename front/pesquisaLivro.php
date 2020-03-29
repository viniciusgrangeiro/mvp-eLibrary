<!DOCTYPE html>
<html lang="pt/br" dir="ltr">
  <head>
    <link rel="stylesheet" href="style/estilo.css">
    <meta charset="utf-8">
    <title>pesquisaLivro</title>
  </head>
  <body>
    <section>
      	<?php
			include '../back/classes/CrudLivro.php';
			$l = new CrudLivro;
			$livro = $l->listarLivros();
		?>
		  
        <table border="1">
			<tr>
				<td>Livro</td>
				<td>Autor</td>
				<td>Editora</td>
				<td>Exemplares</td>
				<td align="center" colspan="2">AÇÃO</td>
			</tr>
        
			<?php 
				foreach($livro as $value){
					echo "<tr>";
					foreach($value as $value2){
						echo "<td>$value2</td>";
					}
					echo "<td><a href='#'>[Excluir]</a></td>
						  <td><a href='#'>[Editar]</a></td>
						  </tr>";
					
				}
			?>
        </table>
    </section>
  </body>
</html>
