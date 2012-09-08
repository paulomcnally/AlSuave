<?php
/*
 * ERROR STYLE
 */
define("ERROR_IMAGE","data:image/png;base64,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");
define("ERROR_TEXT_COLOR","a50000");
define("ERROR_BACKGROUND_COLOR","ffcfce");
define("ERROR_BORDER_COLOR","de7573");
/*
 * EXITO STYLE
 */
define("EXITO_IMAGE","data:image/png;base64,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");
define("EXITO_TEXT_COLOR","264409");
define("EXITO_BACKGROUND_COLOR","E6EFC2");
define("EXITO_BORDER_COLOR","C6D880");

/*
 * GENERAL STYLE
 */
define("BORDER_SIZE",2);
define("BORDER_TYPE","solid");
define("BORDER_COLOR","ddd");
define("FONT_SIZE",12);
define("FONT_FAMILY","Verdana,Arial,Helvetica,sans-serif");
define("CELLSPACING",2);
define("CELLSPADDING",2);
define("IMAGE_SIZE_WIDTH",32);
define("IMAGE_SIZE_HEIGHT",32);

class show {
	public function utf8($s,$c=0)
		{
		if($c)
			{
			$s = preg_replace("/(<br\s|<br)(\/>|>)/","\n",$s); 
			$s = nl2br(htmlentities($s,ENT_QUOTES,"UTF-8"));
			}
		return $s;	
		}
	
	public function notify($type=1,$title,$message,$return=1)
		{
		if($type)
			{
			$this->image = EXITO_IMAGE;
			$this->background = EXITO_BACKGROUND_COLOR;
			$this->color = EXITO_TEXT_COLOR;
			$this->border = EXITO_BORDER_COLOR;
			}
			else
				{
				$this->image = ERROR_IMAGE;
				$this->background = ERROR_BACKGROUND_COLOR;
				$this->color = ERROR_TEXT_COLOR;
				$this->border = ERROR_BORDER_COLOR;
				}
		$this->html = '<table width="100%" style="background:#'.$this->background.'; color:#'.$this->color.'; font-family:'.FONT_FAMILY.'; border: '.BORDER_SIZE.'px '.BORDER_TYPE.' #'.$this->border.'; font-size:'.FONT_SIZE.'px;"  cellspacing="'.CELLSPACING.'" cellpadding="'.CELLSPADDING.'"><tr><td rowspan="2" width="42px" align="right" valign="top"><img src="'.$this->image.'" align="absmiddle" width="'.IMAGE_SIZE_WIDTH.'px" height="'.IMAGE_SIZE_HEIGHT.'px" /></td><td valign="top" style="font-weight:bold;">'.$this->utf8($title,1).'</td></tr><tr><td>'.$this->utf8($message,1).'</td></tr></table>';
		if($return)
			{
			echo $this->html;
			}
			else
				{
				die($this->html);
				}
		}

}
$show = new show;
?>