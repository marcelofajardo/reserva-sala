<?php

	require('../conexion.php');
    session_start();
	$cat=$_SESSION['categoria'];
	$nomape=$_POST['busqueda'];
	$dni=$_POST['bdni'];

	$query="SELECT p_dp_id, p.nombre as nusuario, apellido, dni, telefono1, dp.email as pemail FROM p_dp pd, personas p, datos_personales dp, usuario u WHERE pd.usuario_id_usuario= u.id_usuario and pd.personas_dni=p.dni and pd.datos_personales_id_dp=dp.id_dp and u.category_codigo= $cat and (p.nombre like '%$nomape%' or apellido like '%$nomape%') and (dni like '%$dni%' or telefono1 like '%$dni%')" ;


	$resultado=$mysqli->query($query);
	//echo $query;

	?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Personas</title>
	<link rel="stylesheet" type="text/css" href="../tablas.css" media="screen">
</head>

<body>

		<center><h1>Personas</h1></center>

<div style="float: left;">
			<input type="button" onclick=" location.href='nuevo_per.php'" value="Nueva Persona" name="boton" />

		</div>
<div id="filtros" style="float: right;">
			<form action="personas.php" method="post">
			<p> Busqueda :
			<input type="text" name="busqueda" placeholder="nombre o apellido">  <input type="text" name="bdni" placeholder="DNI o Telefono">
			<button type="submit">Filtrar</button></p>
			</form>
		</div>
		<p></p>


<div class="group">
		<table class="table1" border=1 width="100%" cellspacing=0>
			<thead>
				<tr>
					<th><b>APELLIDO</b></th>
					<th><b>NOMBRE</b></th>
					<th><b>DNI</b></th>
					<th><b>Telefono</b></th>
					<th><b>Email</b></th>
					<th><b>Modificar</b></th>
					<th><b>Eliminar</b></th>


				</tr>
			</thead>
				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ ?>

						<tr>
							<td><a href="../abm_citas/nueva_cita.php?id=<?php echo $row['p_dp_id'];?>"><?php echo $row['apellido'];$_SESSION['dedonde']='personas'; ?></a>
							</td>
							<td>
								<?php echo $row['nusuario'];?>
							</td>
							<td>
								<?php echo $row['dni'];?>
							</td>
							<td>
								<?php echo $row['telefono1'];?>
							</td>
							<td>
								<?php echo $row['pemail'];?>
							</td>
							<td>

								<input type="button" onclick=" location.href='nuevo_per.php?dni=<?php echo $row['dni'];?>' " value="Modificar" name="botonM" />
							</td>
							<td>
								<input type="button" onclick=" location.href='eliminar_joda.php' " value="Eliminar" name="botonE" />
							</td>
						</tr>
					<?php } ?>
				</tbody>
</table>
</div>
</body>
</html>
