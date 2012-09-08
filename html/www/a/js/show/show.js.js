var sw_timeout;

var show={
	message:function(mensaje,redirect)
		{
		if(String(mensaje).search(/^\[OK\]\s{1}.{1,}/)!='-1')
			{
			show.exito(this.get_mensaje(mensaje),3000);
			if(typeof redirect != 'undefined')
				{
				sw_timeout=setTimeout(function() { window.location=redirect; },2000);
				}
			return true;
		}
		else
			{
			if(String(mensaje).search(/^\[ERROR\]\s{1}.{1,}/)!='-1')
				{
				show.error(this.get_mensaje(mensaje),4000);
				return false;
				}
				else
					{
					show.notificacion(this.get_mensaje(mensaje),4000);
					return false;
					}
			}
	},
	
	error:function(mensaje,tiempo)
		{	
		$("#auxiliar").html(this.get_mensaje(mensaje)).slideDown("fast").removeClass('notice').removeClass('success').addClass("error").animate({opacity:'0.5'},'fast',function(){$(this).animate({opacity:'1'},'fast')});
		
		if(arguments.length==2)
			{
			show.clear();
			sw_timeout=setTimeout(function(){ $("#auxiliar").slideUp("fast",function(){$(this).html('').removeClass("error");});},arguments[1]);
			return sw_timeout;
			}
		},
		
	notificacion:function(mensaje,tiempo)
		{
		$("#auxiliar").html(this.get_mensaje(mensaje)).slideDown("fast").removeClass('error').removeClass('success').addClass("notice").animate({opacity:'0.5'},'fast',function(){$(this).animate({opacity:'1'},'fast');});
		
		if(arguments.length==2)
			{
			show.clear();
			sw_timeout=setTimeout(function(){$("#auxiliar").slideUp("fast",function(){$(this).html('').removeClass("notice");});},arguments[1]);
			return sw_timeout;
			}
		},
		
	exito:function(mensaje,tiempo)
		{
		$("#auxiliar").html(this.get_mensaje(mensaje)).slideDown("fast").removeClass('error').removeClass('notice').addClass("success").animate({opacity:'0.5'},'fast',function(){$(this).animate({opacity:'1'},'fast');});
		if(arguments.length==2)
			{
			show.clear();
			sw_timeout=setTimeout(function(){$("#auxiliar").slideUp("fast",function(){$(this).html('').removeClass("success");});},arguments[1]);
			return sw_timeout;
			}
		},
	get_mensaje:function(mensaje)
		{
		show.clear();
		sw_timeout=String(mensaje).replace(/\[\D{1,}\]\s{1}(.)/,'$1');
		return sw_timeout;
		},
	/* Modify by Paulo A. McNally 05 Oct 2009 06:04:31*/
	clear:function()
		{
		clearTimeout(sw_timeout);
		}
}