/*
 * CopyRight www.alsuave.info
 * alsuave.js
 * paulomcnally[]gmail.com
 */
var alsuave = {
	// Ajax
	pajax:function()
		{
		var xmlhttp=false;
		try
			{
			mlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e)
				{
				try
					{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch(E)
						{
						xmlhttp = false;
						}
				}
			if(!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			return xmlhttp;
		},
	pload:function(key,show)
		{
		var ajax=alsuave.pajax();
		var url = "a/widget/wg_friend/clicker.php";
		var params = "key="+key+"&show="+show;
		document.getElementById('alsuave').innerHTML="<div align='center'><img src='http://www.alsuave.info/a/img/loading_ajax.gif' alt='Cargando...' /></div>";
		ajax.open("POST", url, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.setRequestHeader("Content-length", params.length);
		ajax.onreadystatechange = function()
			{
			if(ajax.readyState == 4 && ajax.status == 200)
				{
				document.getElementById('alsuave').innerHTML=ajax.responseText;
				}
			}
		ajax.send(params);	
		},
	pgo:function(a,w,u)
		{
		alsuave.pgolog(w,u);
		window.open(a);
		},
	pgolog:function(w,u)
		{
		var ajax=alsuave.pajax();
		var url = "a/widget/wg_friend/notify.php";
		var params = "w="+w+"&u="+u;
		ajax.open("POST", url, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.setRequestHeader("Content-length", params.length);
		ajax.onreadystatechange = function()
			{
			if(ajax.readyState == 4 && ajax.status == 200)
				{
				//alert(ajax.responseText);
				}
			}
		ajax.send(params);
		},
	/**
	 * c = div Container
	 * k = key User Id
	 * s = number of link tod show
	 * w = Ifreame Width
	 * h = Iframe Height
	 */
	_iframe:function(c,k,s,w,h,b,bS,bC,fz,ff,cf,cr)
		{
		var iframe = '<iframe id="alsuave_iframe" src="http://alsuave.info/webamigas.php?k='+k+'&s='+s+'&fz='+fz+'&ff='+ff+'&cf='+cf+'&cr='+cr+'" scrolling="no" frameborder="1" width="'+w+'" height="'+h+'"></iframe>';
		document.getElementById(c).innerHTML = iframe;
		document.getElementById('alsuave_iframe').style.border = b+"px";
		document.getElementById('alsuave_iframe').style.borderStyle = bS;
		document.getElementById('alsuave_iframe').style.borderColor = "#"+bC;
		}
}