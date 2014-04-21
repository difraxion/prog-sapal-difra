<div id="dom" class="dom wrapper">

		<div>
			<span class="cerrar-pop"><a href="">CERRAR</a></span>
		</div>
			<ul id="sidebarTabs" class="tabs">
				<li id="tab1" class="selected"  onclick="tabs(this);"><a href="#">INICIAR SESIÓN</a></li>
				<li id="tab2" onclick="tabs(this);"><a href="#">¿USUARIO NUEVO...? REGISTRATE AQUÍ</a></li>
			</ul>
			<div id="tabContent" class="cont_sesion">
				<section  class="iniciar">
					<p>
						<label for="usuario">Usuario:</label>
						<input type="text" id="usuario" name="usuario">
						<input type="submit" value="INICIAR SESIÓN">
					</p>
					<p>
						<label for="psw">Contraseña:</label>
						<input type="password" id="psw" name="psw">
						<span>Recuperar tu contraseña <a href="#">AQUÍ</a></span>
					</p>
					<p>
					</p>
				</section>
			</div>
			<div id="tab1Content" style="display:none;" class="cont_sesion">
				<section  class="iniciar">
					<p>
						<label for="usuario">Usuario:</label>
						<input type="text" id="usuario" name="usuario">
						<input type="submit" value="INICIAR SESIÓN">
					</p>
					<p>
						<label for="psw">Contraseña:</label>
						<input type="password" id="psw" name="psw">
						<span>Recuperar tu contraseña <a href="#">AQUÍ</a></span>
					</p>
					<p>
					</p>
				</section>
			</div>
			<div id="tab2Content" style="display:none;">
				<section id="tab2" class="nuevo_u">
					<p>
						<label for="nusuario">NOMBRE DE USUARIO:</label>
						<input type="text" id="nusuario" name="nusuario">
					</p>
					<p>
						<label for="correo">CORREO:</label>
						<input type="text" id="correo" name="correo">
					</p>
					<p>
						<label for="contrasena">CONTRASEÑA:</label>
						<input type="password" id="contrasena" name="contrasena">
					</p>
					<p>
						<label for="cocontrasena">CONFIRMAR CONTRASEÑA:</label>
						<input type="password" id="cocontrasena" name="cocontrasena">
					</p>
					<p>
						<label for="nombre">NOMBRE:</label>
						<input type="text" id="nombre" name="nombre">
					</p>
					<p>
						<label for="apellidos">APELLIDOS:</label>
						<input type="text" id="apellidos" name="apellidos">
					</p>
					<p>
						<label for="ncuenta">NÚMERO DE CUENTA:</label>
						<input type="text" id="ncuenta" name="ncuenta"><span>* Ejemplo</span>
					</p>
					<p>
						<label for="clave">CLAVE PERSONAL:</label>
						<input type="text" id="clave" name="clave"><span>* Ejemplo</span>
					</p>
					<p>
						<label for="pregunta">PREGUNTA:</label>
						<select>
							<option>Pregunta 1</option>
							<option>Pregunta 2</option>
							<option>Pregunta 3</option>
						</select>
					</p>
					<p>
						<label for="respuesta">RESPUESTA SECRETA:</label>
						<input type="text" id="respuesta" name="respuesta">				
					</p>
					<p>
						<input type="submit" value="Registrarse">
					</p>
				</section>
			</div>

</div>
