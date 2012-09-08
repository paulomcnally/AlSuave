<?php
if(isset($_GET['a']) and !empty($_GET['a']))
	{
	include("../../php/class.ip.php");
	include("../../php/class.login.php");
	include("../../php/class.ezSQL.php");
	if(isset($_POST['u']) and !empty($_POST['u'])) { $u=$_POST['u']; } else { $u=""; }
	if(isset($_POST['p']) and !empty($_POST['p'])) { $p=$_POST['p']; } else { $p=""; }
	if(isset($_POST['e']) and !empty($_POST['e'])) { $e=$_POST['e']; } else { $e=""; }
	switch($_GET['a'])
		{
		case "login";
			session_start();
			die($login->logear($u,$p));
		break;
		case "logout":
			die("Salimos");
		break;
		case "add":
			die($login->add($u,$p,$e));
		break;
		}
	}
function wg_login()
	{
?>
<div class="wg_login_container">
  <div class="wg_login_input wg_login_height">
  	<div>Usuario</div>
    <input class="wg_login_input_text" id="name" name="name" type="text" />
  </div>
  <div class="wg_login_input">
  	<div>Contrase&ntilde;a</div>
    <input class="wg_login_input_text" id="pass" name="pass" type="password" />
  </div>
  <div class="wg_login_input wg_login_input_right">
    <input class="p_button" id="send" name="send" type="button" value="Acceder" />
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#name").focus();
	$("#name").bind('keydown', 'return',function (evt){ if($("#pass").val()=="") { $("#pass").focus(); } else { $("#send").click(); } });
	$("#pass").bind('keydown', 'return',function (evt){ if($("#name").val()=="") { $("#name").focus(); } else $("#send").click(); });

	$("#send").click(function() {
		var name = $("#name").val();
		var pass = $("#pass").val();
		if(name=="") { show.error('Escriba su nombre',6000); $("#name").focus(); return false; }
		if(pass=="") { show.error('Escriba su contrase&ntilde;a',6000); $("#pass").focus(); return false; }
		$(this).val("Cargando...").attr("disabled","disabled");
		$.ajax({
			type: "POST",
			url: "widget/wg_login/wg_login.php?a=login",
			data: "u="+name+"&p="+pass+"&e=null",
			success: function(r) {
				if(r.valueOf()=="Bienvenido")
					{
					
					window.location="./";
					}
					else
						{
						$("#send").val("Acceder").attr("disabled","");
						show.error(r,6000);
						}
			}
		});
	});			   
});
</script>	
<?php
	}
function wp_login_add()
	{
?>
<div class="wg_login_container">
  <div class="wg_login_input wg_login_height">
  	<div>Usuario</div>
    <input class="wg_login_input_text" id="name" name="name" type="text" />
  </div>
  <div class="wg_login_input">
  	<div>Contrase&ntilde;a</div>
    <input class="wg_login_input_text" id="pass" name="pass" type="password" />
  </div>
  <div class="wg_login_input">
  	<div>Correo electr&oacute;nico</div>
    <input class="wg_login_input_text" id="email" name="email" type="text" />
  </div>
  <div class="wg_login_input wg_login_input_right">
    <input class="p_button" id="send" name="send" type="button" value="Registrarme" />
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#name").focus();
	$("#name").bind('keydown', 'return',function (evt){ if($("#pass").val()=="" || $("#email").val()=="") { $("#pass").focus(); } else { $("#send").click(); } });
	$("#pass").bind('keydown', 'return',function (evt){ if($("#name").val()=="" || $("#email").val()=="") { $("#email").focus(); } else $("#send").click(); });					   
	$("#email").bind('keydown', 'return',function (evt){ if($("#name").val()=="" || $("#pass").val()=="") { $("#name").focus(); } else $("#send").click(); });					   
	
	$("#send").click(function() {
		var name = $("#name").val();
		var pass = $("#pass").val();
		var email = $("#email").val();
		if(name=="") { show.error('Escriba su nombre',6000); $("#name").focus(); return false; }
		if(pass=="") { show.error('Escriba su contrase&ntilde;a',6000); $("#pass").focus(); return false; }
		if(email=="") { show.error('Escriba su direccion de correo electr&oacute;nico',6000); $("#email").focus();return false; }
		if(!polin.isEmail(email)) { show.error('Escriba una direcci&oacute;n de correo electr&oacute;nico valida',6000); $("#email").focus();return false; }
		$(this).val("Cargando...").attr("disabled","disabled"); 
		$.ajax({
			type: "POST",
			url: "widget/wg_login/wg_login.php?a=add",
			data: "u="+name+"&p="+pass+"&e="+email,
			success: function(r) {
				if(r.valueOf()=="Agregado")
					{
					window.location="./acceder.php";
					}
					else
						{
						$("#send").val("Registrarme").attr("disabled","");
						show.error(r,6000);
						}
			}
		});
	});			   
});
</script>	
<?php	
	}
?>