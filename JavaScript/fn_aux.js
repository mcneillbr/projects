/*
//////////////////////////////////////////////////////////////////////////////
*/
function getHtml(strUrl )
{
	jQuery.ajax(
    {
        url: 'inc/get_list_dia_gc.php',
        data: { "TableId": TableId},
        contentType: "application/x-www-form-urlencoded",
        dataType: "html",
        type: 'POST',
        complete: function(XMLHttpRequest, textStatus)
        {
            if (textStatus == "success")
            {   
				//$('#PanelLoading').hide();
			}
        },
        success: function (data, textStatus, XMLHttpRequest)
        {
            if (textStatus == "success")
            {
                $('#div').empty();
                $('#div').html(data);
               
            }
			/* 
			
			$.each(data, function(i,item)
			{console.info("i = [" + i + "] item = [" + item + "]"); });
			
			*/
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
			console.info(textStatus);
        }
    });
}
////////////////////////////////////////////////////////////////////////////////
/// mascara data ##/##/####
/// mascara cep #####-###
/// mascara tel #####-###
/// mascara cpf ###.###.###-##
function formatarTextBox(e, mascara, frmImput, maxlength) {
    var evtobj = e || (window.event ? event : e);
    var unicode = evtobj.keyCode || evtobj.charCode ;
    var maxlength = maxlength || 9;
    var i = frmImput.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i);
    if (unicode == 9 && frmImput.value.length < maxlength) return false;
    var isnumber = (unicode < 48 || unicode > 57) && (unicode < 96 || unicode > 105);
    if (!(unicode == 8 || unicode == 9 || unicode == 37 || unicode == 39 || unicode == 46)) {
        if (isnumber || frmImput.value.length > maxlength) {
            return false;
        }
        if (texto.substring(0, 1) != saida) {
            frmImput.value += texto.substring(0, 1);
        }
    }
    return true;
}
////////////////////////////////////////////////////////////////////////////////
function numbersonly(e)
{
    var evtobj = window.event ? event : e; //distinguish between IE's explicit event object (window.event) and Firefox's implicit.
    var unicode = evtobj.charCode ? evtobj.charCode : evtobj.keyCode;
    //alert(unicode);
    if (!(unicode == 8 || unicode == 9 || unicode == 37 || unicode == 39 || unicode == 46)){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57) //if not a number
            return false //disable key press
    }
    return true;
}
////////////////////////////////////////////////////////////////////////////////
function IsEmail(strEmail) {
    var stPattern = "^([\\w-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([\\w-]+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$";
    var stSwitch = "igm";
    var re = new RegExp(stPattern, stSwitch);
    return re.test(strEmail);
}
////////////////////////////////////////////////////////////////////////////////
function IsNumber(s, length)
{
    var stPattern = "^[0-9]{" + length + "}$";
    var stSwitch = "igm";
    var re = new RegExp(stPattern, stSwitch);
    return re.test(s);
}
////////////////////////////////////////////////////////////////////////////////
function IsStringEmptyORNull(objString) {
    var blnRst = true;
    try {
        if (objString != undefined || objString != null || typeof objString == "string") {
            //(objString.replace) != undefined
            objString = objString.replace(/\s/g, "");
            blnRst = (objString == "");
        }
    }
    catch (ex) {
        blnRst = true;
    }
    return blnRst;
}
////////////////////////////////////////////////////////////////////////////////
function IsDateTime(s)
{
    var regular = /^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/;
      
    return regular.test(s);
        
}
////////////////////////////////////////////////////////////////////////////////
