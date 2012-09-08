<?php
class login {
	public function connect()
		{
		$this->db = new db(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
		}
	public function debug()
		{
		$this->show = new show;
		}
	public function mails()
		{
		$this->pmail = new pmail;
		}
	/*
	 * Description: Agrega a un usuario en la base de datos.
	 * Return: String
	 */
	public function add($userName,$userPass,$userEmail)
		{
		$this->connect();
		if($this->exist("name",$userName))
			{
			$this->result="Ya existe un usuario registrado con el nick ".$userName. ".<br />Intente con otro nick.";
			return $this->result;
			}
		if($this->exist("mail",$userEmail))
			{
			$this->result="Ya existe un usuario registrado con el correo ".$userEmail. ".<br />Intente con otra direccion de correo electronico.";
			return $this->result;
			}
		$this->db->query("INSERT INTO user (userId,userName,userPass,userEmail,userDate,userClick,userRange) VALUES(NULL,'".$this->db->escape($userName)."','".$this->encript($this->db->escape($userPass))."','".$this->db->escape($userEmail)."','".date("Y-m-d h:i:s")."','1','2')");
		$this->result="Agregado";
		return $this->result;
		$this->mails();
		$this->msgadd = "Bienvenido a www.alsuave.info<br /><br />Esperamos que seas fiel a como nosotros lo seremos contido.<br /><br />Si tienes dudas sobre el servicio contactanos: polin@clan2b.com";
		$this->pmail->sendTo($userEmail,"Bienvenido a www.alsuave.info",$this->msgadd,"robot@alsuave.info","alsuave");
		}
	/*
	 * Description: Comprueba si el nick o mail del usuario existe.
	 * Return: Bol
	 */
	public function exist($type,$custom)
		{
		$this->connect();
		$this->result = 0;
		switch($type)
			{
			case "name":
			if($r=$this->db->query("SELECT userId FROM user WHERE userName='".$this->db->escape($custom)."'"))
				{
				$this->result=1;
				}
			break;
			case "mail":
			if($r=$this->db->query("SELECT userId FROM user WHERE userEmail='".$this->db->escape($custom)."'"))
				{
				$this->result=1;
				}
			break;
			}
		return $this->result;
		}
	/*
	 * Description: Encripte string to MD5.
	 * Return: String
	 */
	public function encript($str)
		{
		$this->result = md5(md5($str));
		return $this->result;
		}
	public function makePassword($length=10)
		{
		$this->source = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890|@#~$%()=^*+[]{}-_';
		if($length>0)
			{
			$this->rstr = "";
			$this->source = str_split($this->source,1);
			for($i=1; $i<=$length; $i++)
				{
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,count($this->source));
				$this->rstr .= $this->source[$num-1];
				}
			}
		return $this->rstr;
		}
	public function logged()
		{
		if(isset($_SESSION['userSession']))
			{
			return 1;
			}
			else
				{
				return 0;
				}
		}
	public function logear($userName,$userPass)
		{
		
		$this->connect();
		$userName = $this->db->escape($userName);
		$userPass = $this->db->escape($userPass);
		$userPass = $this->encript($userPass);
		$q=$this->db->get_var("SELECT userId FROM user WHERE userName='".$userName."' AND userPass='".$userPass."'");
		if($this->db->num_rows>0)
			{
			$this->createlog($q);
			$_SESSION['userSession'] = $q;
			$this->msg = "Bienvenido";
			
			}
			else
				{
				$this->msg = "Usuario o Contrase&ntilde;a incorrecta";
				}
		return $this->msg;
		}
	public function createlog($userId)
		{
		$this->connect();
		$this->ip = new p_ip;
		$this->db->query("INSERT INTO log (logId,userId,logIp,lodDate) VALUES(NULL,'".$userId."','".$this->ip->myIp()."','".date("Y-m-d H:i:s")."')");
		}
	public function mylog()
		{
		$this->connect();
		$this->logId = $this->db->get_var("SELECT logId FROM log WHERE userId='".$_SESSION['userSession']."' ORDER BY logId DESC LIMIT 1");
		return $this->logId;
		}
	public function requirelogin()
		{
		$this->debug();
		if(!$this->logged())
			{
			$this->show->notify(0,"Sesion inactiva","Seleccione el menu acceder para iniciar session",0);
			}
		}
	public function myinfo($custom)
		{
		$this->connect();
		$q=$this->db->get_var("SELECT ".$custom." FROM user WHERE userId='".$_SESSION['userSession']."'");
		if(!empty($q))
			{
			$r = $q;
			}
			else
				{
				$r="0";
				}
		
		return $r;
		}
	public function userinfo($custom,$userId)
		{
		$this->connect();
		$q=$this->db->get_var("SELECT ".$custom." FROM user WHERE userId='".$userId."'");
		if(!empty($q))
			{
			$r = $q;
			}
			else
				{
				$r="0";
				}
		
		return $r;
		}
}
$login = new login;
?>