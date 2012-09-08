<?php
class p_ip {
	public function myIp()
		{
		$_SERVER["HTTP_CLIENT_IP"]!=""?$ip=$_SERVER["HTTP_CLIENT_IP"]:$ip=$_SERVER["REMOTE_ADDR"];
		return $ip;
		}
	
	public function getCountry()
		{
		//Función de obtención de IP (basado en la web de webhosting.info)
     	//By Marc Palau (http://www.nbsp.es)
      	$url = "http://ip-to-country.webhosting.info/node/view/36";
      
      	$inici = "src=/flag/?type=2&cc2=";
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST,"POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "ip_address=$ip_address"); 
      
        ob_start();
      
        curl_exec($ch);
        curl_close($ch);
        $cache = ob_get_contents();
        ob_end_clean();
      
        $resto = strstr($cache,$inici);
        $pais = substr($resto,strlen($inici),2);
      
        return $pais;
   }
}
$p_ip = new p_ip;
?>