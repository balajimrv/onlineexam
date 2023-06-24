// Validate Required
function validateRequired(field, msg, min, max){
	var test = "pass";
	if(field.value.length == 0) {
		test = "fail";
	}else if(min && field.value.length < min) {
		msg = msg + "\nMin Length should be " + min;
		test = "fail";
	}else if(max && field.value.length > max) {
		msg = msg + "\nMax Length should be " + max;
		test = "fail";
	}
	
	if(test == "fail"){
		if (msg) alert(msg);
		field.focus();
		field.select();
		return false;
	}
	return true;
}

// Validate Extension
function CheckExtension(field, msg){
	
	var ext = field.value.split(".")
	if(ext[1] == 'doc'){
		return true;
	}
	else {
		if (msg != ''){
			alert(msg);
		}
		field.focus();
		return false;
	}

}

//Validate Extension
function CheckImgExtension(field, msg){
	
	var ext = field.value.split(".")
	if((ext[1] == 'jpg') || (ext[1] == 'jpeg') || (ext[1] == 'gif')){
		return true;
	}
	else {
		if (msg != ''){
			alert(msg);
		}
		field.focus();
		return false;
	}

}


// Validate word count
function count_words(field, msg, min, max)
{
    var test = "pass";
	var no_words = field.value.split(" ");
	
	if(field.value.length == 0) {
		test = "fail";
	}else if(min && no_words.length < min) {
		msg = msg + "\nMin Word should be " + min;
		test = "fail";
	}else if(max && no_words.length > max) {
		msg = msg + "\nMax Word should be " + max;
		test = "fail";
	}
	
	if(test == "fail"){
		if (msg) alert(msg);
		field.focus();
		field.select();
		return false;
	}
	return true;
}

// Validate Number
function validateNumber(field, msg, min, max){
	if (!min) { min = 0 }
	if (!max) { max = 255 }

	if ( (parseInt(field.value) != field.value) ||
             field.value.length < min ||
             field.value.length > max) {
		alert(msg);
		field.focus();
		field.select();
		return false;
	}

	return true;
}
//Validate mobileNumber
function validateMobileNumber(field, msg, min, max){
	if (!min) { min = 0 }
	if (!max) { max = 12 }

	if ( (parseInt(field.value) != field.value) ||
             field.value.length < min ||
             field.value.length > max) {
		alert(msg);
		field.focus();
		field.select();
		return false;
	}

	return true;
}

// Validate Mail IDs
function validateEmail(field, msg){
	if (!field.value) {
		return true;
	}

	var re_mail = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (!re_mail.test(field.value)) {
		if (msg != '') { alert(msg); }
		field.focus();
		field.select();
		return false;
	}

	return true;
}

// Validate Url
function validateUrl(field, msg){
	if (!field.value) {
		return true;
	}

	var re_url = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/;
	if (!re_url.test(field.value)) {
		if (msg != '') { alert(msg); }
		field.focus();
		field.select();
		return false;
	}

	return true;
}

// Validate Alpha-Numeric
function validateAlphaNumeric(field, msg){
	var numaric = field.value;
	for(var j=0; j<numaric.length; j++) {
		var alphaa = numaric.charAt(j);
		var hh = alphaa.charCodeAt(0);
		
		if(!(hh > 47 && hh<59) || (hh > 64 && hh<91) || (hh > 96 && hh<123)){
			if (msg != ''){
				alert(msg);
			}
			field.focus();
			field.select();
			return false;
		}
	}
	return true;
}

// Validate Combo
function validateCombo(field, msg){
	
	if(field.selectedIndex == 0){
		if (msg != ''){
			alert(msg);
		}
		field.focus();
		return false;
	}

	return true;
}

// Validate Checkbox
function validateCheckbox(field, msg){
	
	if(field.checked == false){
		if (msg != ''){
			alert(msg);
		}
		field.focus();
		return false;
	}

	return true;
}

// Validate at least one textbox
function validateAtleastOne(field1, field2, msg){
	
	if((field1.value == "") && (field2.value == "")) {
		if (msg != ''){
			alert(msg);
		}
		field1.focus();
		return false;
	}

	return true;
}

// Validate at least one Combo
function validateAtleastOneCombo(field1, field2, msg){
	
	if((field1.selectedIndex == 0) && (field2.selectedIndex == 0)) {
		if (msg != ''){
			alert(msg);
		}
		field1.focus();
		return false;
	}

	return true;
}


function ValidateAnyOne(field1, field2, msg, msg1) {
	if(field1.value || field2.value) {
		if (field1.value != ''){
			if(parseInt(field1.value) != field1.value) {
				alert(msg);
				return false;
			}
			
		}
		return true	;
	}
	alert(msg1);
	return false;
}

function compareFields(field1, field2, msg) {
	if(field1.value != field2.value) {
		if (msg != ''){
			alert(msg);
		}
		return false;
	}

	return true;
}
function compareFields2(field1, field2, msg) {
	if(field1.value == field2.value) {
		if (msg != ''){
			alert(msg);
		}
		return false;
	}

	return true;
}

// to Radio button
function ValidateRadio(field, msg) {
	for(i=0; i<field.length; i++)
	{
		if(field[i].checked) {
			return true;
		}
	}
	if (msg != ''){
			alert(msg);	
		}
		return false;	
}


	function validatePhoneno(field,msg) {  
		var phoneno = /^\d{10}$/;  
		if(field.value.match(phoneno)){  
			return true;  
		} else {  
			alert(msg);  
			return false;  
		}  
	}  

function confirmAlert(msg) {
	return confirm(msg);
}

/* Functions for Image Roll over*/
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


/*//function to use show tab and show new window*/
function showWindow(strURL, strWidth, strHeight, resize, scroll, toolbar)
{
	var strToolbar		= 0;
	var	strScrollbars	= 0;
	var strResizeable	= 0;

	if(toolbar)
	{
		strToolbar = 1;
	}
	if(resize)
	{
		strResizeable	= 1;
	}
	if(scroll)
	{
		strScrollbars	= 1;
	}

	window.open(strURL,"","toolbar="+strToolbar+",scrollbars="+strScrollbars+",resizable="+strResizeable+",width="+strWidth+",height="+strHeight);
}


function showTab(vID, vTabCount, vSelIntex) {
	lStyle = 'tab'; // TODO: Find style name
	for(i = 0; i < vTabCount; i++) {
		tt	=	document.getElementById('tt'+i+"_"+vID);
		dd	=	document.getElementById('dd'+i+"_"+vID);
		if(i==vSelIntex) {
			tt.className	=	lStyle+'HeadActive';
			dd.className	=	lStyle+'BodyActive';
		} else {
			tt.className	=	lStyle+'HeadInActive';
			dd.className	=	lStyle+'BodyInActive';
		}
	}
}
function showCommentsForm(vType,vId) {
	
	var frm = document.frmPostcomments;
	

	frm.hdnCommantType.value 	= vType;
	frm.hdnReCommantId.value 	= vId;
	if(vId) {
		document.getElementById('postyourcomments').innerHTML  = 'Post Your Reply';
	}
	
	var div = document.getElementById('postComments');

	if(self.innerWidth != undefined){
		vpWidth  = self.innerWidth;
		vpHeight = self.innerHeight;
	}
	else{
		var Doc= document.documentElement;
		if(Doc) {
			vpWidth	 = Doc.clientWidth;
			vpHeight = Doc.clientHeight;
		}
	}

	BoxTop 	= 60;
	BoxLeft = (vpWidth-450)/2;

	//Position the Dialog
	div.style.top 		= BoxTop+"px";
	div.style.left 		= BoxLeft+"px";
	div.className		= 'postComments';
	
	div.style.display 	= "block";
}

function showDiv(vDivId) {
	document.getElementById(vDivId).style.display = 'block';
}

function hideDiv(vDivId) {
	document.getElementById(vDivId).style.display = 'none';
}


function checkAll() {
   var items = document.frmResult.elements.length;
   for (i = 0; i < items; i++)
	if(document.frmResult.elements[i].type == 'checkbox'){
		document.frmResult.elements[i].checked = true;
	}
}

function uncheckAll() {
   var items = document.frmResult.elements.length;
	   for (i = 0; i < items; i++)
		if(document.frmResult.elements[i].type == 'checkbox'){
		document.frmResult.elements[i].checked = false;
	}
   }

//Validate for apply jobs Checkbox
function apply(field, msg) {
	var flag = false;	
	for (i = 0; i < field.length; i++) {		
		if(field[i].type == 'checkbox' && field[i].checked) {
			flag = true; 
		}
	}
	if(flag) {
		return true;
	}		
	else {
		alert(msg);
		return false;
	}
 }

function trueCheck(field, msg){
	if(field.value == 'true'){
		return true;
	}else{
		alert(msg);
		field.focus();
		return false;
	}	
}

 function deleteMessage() {

	   var items = document.frmResult.elements.length;
	   var flag = false;
	   for (i = 0; i < items; i++){
		if(document.frmResult.elements[i].type == "checkbox" && document.frmResult.elements[i].checked){
			flag = true;
		}
      }
	  if(flag == false){
		  alert("Select message to delete");
		  return;
	  }
	  if(confirm("Are you sure to delete the selected message?")){
		document.frmResult.action ="messages.php?action=delete";
		document.frmResult.target ="_self";
		document.frmResult.submit();
	  }else{
		 
	  }
  }
 function deleteAppliedJobs() {

	   var items = document.frmResult.elements.length;
	   var flag = false;
	   for (i = 0; i < items; i++){
		if(document.frmResult.elements[i].type == "checkbox" && document.frmResult.elements[i].checked){
			flag = true;
		}
    }
	  if(flag == false){
		  alert("Select message to delete");
		  return;
	  }
	  if(confirm("Are you sure to delete the selected Jobs?")){
		document.frmResult.action ="myappliedjobs.php?action=delete";
		document.frmResult.target ="_self";
		document.frmResult.submit();
	  }else{
		 
	  }
}
 
 function MarkAsUnread() {

	   var items = document.frmResult.elements.length;
	   var flag = false;
	   for (i = 0; i < items; i++){
		if(document.frmResult.elements[i].type == "checkbox" && document.frmResult.elements[i].checked){
			flag = true;
		}
    }
	  if(flag == false){
		  alert("Select message to mark as unread");
		  return;
	  }else{
		document.frmResult.action ="messages.php?action=unread";
		document.frmResult.target ="_self";
		document.frmResult.submit();
	  }
}

function numbersonly(myfield, e, dec) {
  var key;
  var keychar;

  if (window.event)
    key = window.event.keyCode;
  else if (e)
    key = e.which;
  else
    return true;
  keychar = String.fromCharCode(key);

  // control keys
  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
    return true;

  // numbers
  else if ((("+0123456789").indexOf(keychar) > -1))
    return true;

  // decimal point jump
  else if (dec && (keychar == ".")) {
    myfield.form.elements[dec].focus();
    return false;
  } else
    return false;
}

function getPageType(redirect) {	
	location.href=redirect;
}

function CancelProcess(strUrl) {
	strPage = strUrl;
	document.writeln("<a href='#' onclick='getPageType(strPage);'><img src='../adminpanel/images/cancel.jpg' width='79' height='37' border='0' title='Cancel to Go'></a>");
	
}

function frmTemplateStyle(Form) {
	if(Form.selTemplate[0].selected) {
		alert("Please select the valid template.");
		Form.selTemplate.focus();
		return false;
	}
}

function ConfirmMsg(strMsg) {
	if(strMsg==1) {
		strString = "modify"; }
		else if(strMsg==2) {
		strString = "delete"; }
	
	con = confirm("Do you want to "+ strString +" this record?");
	if(con==true) {
		return true;
	}
	else {
		return false;
	}
}

function CheckAll(Form) {
	for(intI=0;intI<=Form.elements.length-1;intI++) {		
		if(Form.elements[intI].type=="checkbox")
		 {	
			if(Form.txtCheck.value=="unCheck") {
				Form.elements[intI].checked=true;
				strCheck = "Check"; strString = "UnCheck All"; }			
				else {
				Form.elements[intI].checked=false;
				strCheck = "unCheck"; strString = "Check All";}
		}
	}
	Form.txtCheck.value = strCheck;
	document.getElementById("divCheck").innerHTML = strString;
}

function ViewPollsResult(Form) {
	Form.submit();
}
function ViewBankDetails(Form) {
	Form.submit();
}
function ViewSector(Form) {
	Form.submit();
}


function checkField(Form)
{
	if((Form.selCountry) && (Form.selCountry[0]))
	{
		if(Form.selCountry[0].selected)
		{
				alert("Please select the valid country.")
				Form.selCountry.focus();
				return true;
		}
		else
		return false;
	}
	else
		return false;
}

function checkFieldvStateName(Form)
{
	if((Form.selvStateName) && (Form.selvStateName[0]))
	{
		if(Form.selvStateName[0].selected)
		{
				alert("Please select the valid state name.")
				Form.selvStateName.focus();
				return true;
		}
		else
		return false;
	}
	else
		return false;
}
function checkFieldCity(Form)
{
	if((Form.selCity) && (Form.selCity[0]))
	{
		if(Form.selCity[0].selected)
		{
				alert("Please select the valid city.")
				Form.selCity.focus();
				return true;
		}
		else
		return false;
	}
	else
		return false;
}

function checkRadio (frmName, rbGroupName) {
 var radios = document[frmName].elements[rbGroupName];
 for (var i=0; i < radios.length; i++) {
  if (radios[i].checked) {
   return true;
  }
 }
 return false;
} 


function trim(str){
return str.replace(/^\s+|\s+$/g,''); }

function frmSubmitProcess(Form) 
{
	for(intI=0;intI<=Form.elements.length-1;intI++) {		
		if(Form.elements[intI].type=="checkbox")
		 {	
		 	if(Form.elements[intI].checked==true) {
			strFlag = "Y";break; }
		 	else if(Form.elements[intI].checked==false) {
			strFlag = "N"; }
	}
}
	Form.txtOpt.value = strFlag;
	if(Form.txtOpt.value=="N") {
		alert("Please select the records to process.");
		Form.selOptions.focus();
		return false;
	}
}

function hide_msg() {
	$("#divMsg").html("");
}
