var EV_MsgBox_ID=""; 


function EV_modeAlert(msgID){
	//ŽŽœšŽóŽóµÄ±³Ÿ°¿ò
	var bgObj=document.createElement("div");
	bgObj.setAttribute('id','EV_bgModeAlertDiv');
	document.body.appendChild(bgObj);
	//±³Ÿ°¿òÂúŽ°¿ÚÏÔÊŸ
	EV_Show_bgDiv();
	//°ÑÒªÏÔÊŸµÄdivŸÓÖÐÏÔÊŸ
	EV_MsgBox_ID=msgID;
	EV_Show_msgDiv();
}

//¹Ø±Õ¶Ô»°Ž°¿Ú
function EV_closeAlert(){
	var msgObj=document.getElementById(EV_MsgBox_ID);
	var bgObj=document.getElementById("EV_bgModeAlertDiv");
	msgObj.style.display="none";
	document.body.removeChild(bgObj);
	EV_MsgBox_ID="";
}


window.onresize=function(){
	if (EV_MsgBox_ID.length>0){
		EV_Show_bgDiv();
		EV_Show_msgDiv();
	}
}


window.onscroll=function(){
	if (EV_MsgBox_ID.length>0){
		EV_Show_bgDiv();
		EV_Show_msgDiv();
	}
}


function EV_Show_msgDiv(){
	var msgObj   = document.getElementById(EV_MsgBox_ID);
	msgObj.style.display  = "block";
	var msgWidth = msgObj.scrollWidth;
	var msgHeight= msgObj.scrollHeight;
	var bgTop=EV_myScrollTop();
	var bgLeft=EV_myScrollLeft();
	var bgWidth=EV_myClientWidth();
	var bgHeight=EV_myClientHeight();
	var msgTop=bgTop+Math.round((bgHeight-msgHeight)/2);
	var msgLeft=bgLeft+Math.round((bgWidth-msgWidth)/2);
	msgObj.style.position = "absolute";
	msgObj.style.top      = msgTop+"px";
	msgObj.style.left     = msgLeft+"px";
	msgObj.style.zIndex   = "10001";
	
}

function EV_Show_bgDiv(){
	var bgObj=document.getElementById("EV_bgModeAlertDiv");
	var bgWidth=EV_myClientWidth();
	var bgHeight=EV_myClientHeight();
	var bgTop=EV_myScrollTop();
	var bgLeft=EV_myScrollLeft();
	bgObj.style.position   = "absolute";
	bgObj.style.top        = bgTop+"px";
	bgObj.style.left       = bgLeft+"px";
	bgObj.style.width      = bgWidth + "px";
	bgObj.style.height     = bgHeight + "px";
	bgObj.style.zIndex     = "10000";
	bgObj.style.background = "#777";
	bgObj.style.filter     = "progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=60,finishOpacity=60);";
	bgObj.style.opacity    = "0.6";
}
function EV_myScrollTop(){
	var n=window.pageYOffset 
	|| document.documentElement.scrollTop 
	|| document.body.scrollTop || 0;
	return n;
}
//ÍøÒ³±»ŸíÈ¥µÄ×ó¿í¶È
function EV_myScrollLeft(){
	var n=window.pageXOffset 
	|| document.documentElement.scrollLeft 
	|| document.body.scrollLeft || 0;
	return n;
}

function EV_myClientWidth(){
	var n=document.documentElement.clientWidth 
	|| document.body.clientWidth || 0;
	return n;
}
//ÍøÒ³¿ÉŒûÇøÓòžß
function EV_myClientHeight(){
	var n=document.documentElement.clientHeight 
	|| document.body.clientHeight || 0;
	return n;
}

