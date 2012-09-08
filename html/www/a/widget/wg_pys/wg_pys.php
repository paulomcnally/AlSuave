<?php
function wg_pys($id)
	{
	$login = new login;
	$login->requirelogin();
	$rango = array();
	array_push($rango,$login->myinfo("userRange"));
	$db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
	if($id<="0")
		{
		$q=$db->get_results("SELECT * FROM pys ORDER BY pysDateTime DESC");
		if($db->num_rows>0)
			{
			?>
			<div class="wg_my_sites_container">
			<?php
			foreach($q as $pys)
				{
				$comments=$db->get_var("SELECT count(1) AS total FROM  `pysr` WHERE pysId='".$pys->pysId."'");
				$lastComments=$db->get_var("SELECT U.userName FROM pysr P, user U WHERE P.pysId = '".$pys->pysId."'
										  AND P.userId=U.userId ORDER BY P.pysrId DESC LIMIT 1");
				?>
				<div class="p_tr">
    				<div class="wg_pys_div"><a href="preguntas_y_sugerencias.php?i=<?php echo $pys->pysId; ?>" alt="Ver <?php echo $pys->pysTitle; ?>"><?php echo $pys->pysTitle; ?></a> | <span class="wg_pys_user_text"><?php echo $login->userinfo("userName",$pys->userId); ?></span> | <?php echo $pys->pysDateTime; ?> | &Uacute;ltimpo comentario por <?php echo $lastComments; ?> <div class="wg_pys_total_comments"><strong><span class="wg_pys_user_text"><?php echo $comments; ?></span></strong></div></div>
   				</div>
				<?php
				}
				?>
			</div>
			<?php
			}
			else
				{
				?>
                <div align="center" style="margin-top:20px;">
                	<input name="addTopic" id="addTopic" type="button" value="Agregar nuevo tema" />
                </div>
                <script type="text/javascript">
				$(document).ready(function() { 
    						$('#addTopic').click(function() {
								$.ajax({
									type: "GET",
									url: "widget/wg_pys/ajax.form.add.php",
									success:function(r)
										{
										$.blockUI({ message: r }); 
										}
								});
        						return false;
    						}); 
						});
				</script>
                <?php
				}
		}
		else
			{
			?>
           	<div class="wg_pys_navigator"><a href="preguntas_y_sugerencias.php">Volver a Preguntas y Sugerencias</a></div>
            <?php
			$tema=$db->get_row("SELECT * FROM pys WHERE pysId='".$id."'");
			if($db->num_rows>0)
				{
				$visita = $tema->pysVisit + 1;
				$db->query("UPDATE pys SET pysVisit='$visita' WHERE pysId='".$id."'");
				?>
                <div class="wg_my_sites_container">
                	<div class="wg_pys_title">
						<div><?php echo $tema->pysTitle; ?></div>
                        <div class="wg_pys_separator_top"></div>
                        <div class="wg_pys_info">
                        	<div class="wg_pys_calendar"></div>
							<div class="wg_pys_info_div"><?php echo $tema->pysDateTime; ?></div>
                            <div class="wg_pys_user"></div>
							<div class="wg_pys_info_div">
								<?php echo $login->userinfo("userName",$tema->userId); ?>
                            </div>
                            <div class="wg_pys_visits"></div>
                            <div class="wg_pys_info_div"><?php echo $tema->pysVisit; ?> Visitas</div>
                            <div class="wg_pys_add"></div>
                            <div class="wg_pys_info_div">
                            	<span class="wg_pys_add_span">
                                	<a href="#" id="addTopic">Agregar nuevo tema</a>
                                </span>
                            </div>
                        </div>
                        <div class="wg_pys_separator_top"></div>
                    </div>
                    <div class="wg_pys_text"><div><?php echo nl2br($tema->pysText); ?></div></div>
                    <!-- Comments -->
                    <?php
					$comments=$db->get_results("SELECT * FROM pysr WHERE pysId='".$id."'");
					if($db->num_rows>0)
						{
						foreach($comments as $comment)
							{
							?>
                           	<div class="wg_pys_comments_container" id="c_<?php echo $comment->pysrId; ?>">
                   				<div class="wg_pys_comments_avantar">
                                	<img src="http://www.gravatar.com/avatar/<?php echo md5($login->userinfo("userEmail",$comment->userId)); ?>?s=65&&r=G" alt="Avantar de <?php ?>" />
                                </div>
                                <div class="wg_pys_comments_content">
                                	<div class="wg_pys_info">
                                    	<div class="wg_pys_calendar"></div>
                                        <div class="wg_pys_info_div"><?php echo $comment->pysrDateTime; ?></div>
                                        <div class="wg_pys_user"></div>
                                        <div class="wg_pys_info_div">
                                        	<?php echo $login->userinfo("userName",$comment->userId); ?>
                                        </div>
                                        <div class="wg_pys_report"></div>
                                        <div class="wg_pys_info_div"><a href="#" onclick="reportar('<?php echo $comment->pysId; ?>','<?php echo $comment->pysrId; ?>',this); return false;">Reportar abuso</a></div>
                                        <?php
										if(in_array(1,$rango))
											{
											?>
                                            <div class="wg_pys_delete"></div>
                                            <div class="wg_pys_info_div"><a href="#">Eliminar</a></div>
                                            <?php
											}
										?>
                                     </div>
                                    <div class="wg_pys_separator_top"></div>    
                                	<div class="wg_pys_comments_content_text">
										<?php echo nl2br($comment->pysrText); ?>
                                    </div>
                                </div>
                   			</div>
                            <?php
							}
						}
					?>
                    <div class="wg_pys_comments_container" align="center">
                    	<textarea id="textarea_comments" name="textarea_comments"></textarea>
                        <input type="button" id="add_comments" name="add_comments" onclick="add_comment();" value="Agregar" />
                    </div>
                    <script type="text/javascript">
						function add_comment()
							{
							var t=$("#textarea_comments").val();
							if(t=="")
								{
								show.error('Escriba un comentario',8000);
								return false;
								}
							$("#add_comments").val("Guardando...").attr("disabled","disabled");
							$.ajax({
								type: "POST",
								url: "widget/wg_pys/wg_pys_function.php?a=add",
								data: "textarea_comments="+t+"&id=<?php echo $id; ?>",
								success:function(r)
									{
									if(r.valueOf()=="Agregado")
										{
										window.location.reload();
										}
										else
											{
											show.error(r);
											$("#add_comments").val("Agregar").attr("disabled","");
											}
									}
							});
							}
						function reportar(id,idr,obj)
							{
							if(id=="") { show.error('No esta enviando identificador de tema',8000);return false; }
							if(idr=="") { show.error('No esta enviando identificador de comentario',8000);return false; }
							$.ajax({
								type: "POST",
								url: "widget/wg_pys/wg_pys_function.php?a=abuso",
								data: "id="+id+"&idr="+idr,
								success:function(r)
									{
									if(r.valueOf()=="Reportado")
										{
										$.growlUI('Notificado!', 'Se envio la notificaci&oacute;n!'); 
										show.exito('El comentario ha sido reportado!',8000);
										obj.click(function(){
											alert('Ya reporto este comentario!');
										});
										}
										else
											{
											show.error(r,8000);
											}
									}
							});
							}
						$(document).ready(function() { 
    						$('#addTopic').click(function() {
								$.ajax({
									type: "GET",
									url: "widget/wg_pys/ajax.form.add.php",
									success:function(r)
										{
										$.blockUI({ message: r }); 
										}
								});
        						return false;
    						}); 
						});
					</script>
            	</div>
                <?php
				}
				else
					{
					$show->notify(0,"Tema no encontrado","Al parecer el tema al que deseas acceder no existe.");
					}
			}
	}
?>