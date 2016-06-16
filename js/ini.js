function redirect()
{
document.getElementById('my_form').target = 'my_iframe'; //'my_iframe' is the name of the iframe
document.getElementById('my_form').submit();

var iFrame = document.getElementById("my_iframe");
var loading = document.getElementById("loading");
iFrame.style.display = "none";
iFrame.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
loading.style.display = "block";
checkComplete();
}

var checkComplete = function()
{
	var iFrame = document.getElementById("my_iframe").contentDocument.getElementsByTagName("body")[0];	
	var loading = document.getElementById("loading");

	if(iFrame.innerHTML == "")
	{	
		document.getElementById('check_submit').value=0;
		setTimeout ( checkComplete, 2000 );
	}
	else
	{		
		if(iFrame.innerHTML == "success")
		{		
			loading.style.display = "none";
			document.getElementById('result_show').innerHTML= "";
			document.getElementById('result_show').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//document.getElementById("my_iframe").style.display = "block";
			//successful do something here!
		}
		else
		{
			loading.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame.innerHTML);
		}
	}
}



function redirect1()
{
document.getElementById('my_form_1').target = 'my_iframe_1'; //'my_iframe' is the name of the iframe
document.getElementById('my_form_1').submit();

var iFrame = document.getElementById("my_iframe_1");
var loading = document.getElementById("loading_1");
iFrame.style.display = "none";
iFrame.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
loading.style.display = "block";
checkComplete1();
}

var checkComplete1 = function()
{
	var iFrame = document.getElementById("my_iframe_1").contentDocument.getElementsByTagName("body")[0];	
	var loading = document.getElementById("loading_1");

	if(iFrame.innerHTML == "")
	{	
		document.getElementById('check_submit').value=0;
		setTimeout ( checkComplete1, 2000 );
	}
	else
	{		
		if(iFrame.innerHTML == "success")
		{		
			loading.style.display = "none";
			document.getElementById('result_show_1').innerHTML= "";
			document.getElementById('result_show_1').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//document.getElementById("my_iframe_1").style.display = "block";
			//successful do something here!
		}
		else
		{
			loading.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame.innerHTML);
		}
	}
}

function redirect2()
{
document.getElementById('my_form_2').target = 'my_iframe_2'; //'my_iframe' is the name of the iframe
document.getElementById('my_form_2').submit();

var iFrame = document.getElementById("my_iframe_2");
var loading = document.getElementById("loading_2");
iFrame.style.display = "none";
iFrame.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
loading.style.display = "block";
checkComplete2();
}

var checkComplete2 = function()
{
	var iFrame = document.getElementById("my_iframe_2").contentDocument.getElementsByTagName("body")[0];
	var loading = document.getElementById("loading_2");

	if(iFrame.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkComplete2, 2000 );
	}
	else
	{
		if(iFrame.innerHTML == "success")
		{		
			loading.style.display = "none";
			document.getElementById('result_show_2').innerHTML= "";
			document.getElementById('result_show_2').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//document.getElementById("my_iframe_2").style.display = "block";
			//successful do something here!
		}
		else
		{
			loading.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame.innerHTML);
		}
	}
}
function redirect3()
{
document.getElementById('my_form_3').target = 'my_iframe_3'; //'my_iframe' is the name of the iframe
document.getElementById('my_form_3').submit();

var iFrame = document.getElementById("my_iframe_3");
var loading = document.getElementById("loading_3");
iFrame.style.display = "none";
iFrame.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
loading.style.display = "block";
checkComplete3();
}

var checkComplete3 = function()
{
	var iFrame = document.getElementById("my_iframe_3").contentDocument.getElementsByTagName("body")[0];
	var loading = document.getElementById("loading_3");

	if(iFrame.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkComplete3, 2000 );
	}
	else
	{
		if(iFrame.innerHTML == "success")
		{		
			loading.style.display = "none";
			document.getElementById('result_show_3').innerHTML= "";
			document.getElementById('result_show_3').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//document.getElementById("my_iframe_3").style.display = "block";
			//successful do something here!
		}
		else
		{
			loading.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame.innerHTML);
		}
	}
}
function upload_design1()
{
document.getElementById('my_form_1').target = "my_iframe_1"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_1').submit();

var iFrame1 = document.getElementById("my_iframe_1");
var loading1 = document.getElementById("loading_1");
iFrame1.style.display = "none";
iFrame1.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
loading1.style.display = "block";
checkuploadcomplete1();
}

var checkuploadcomplete1 = function()
{		
	var iFrame1 = document.getElementById("my_iframe_1").contentDocument.getElementsByTagName("body")[0];
	var loading1 = document.getElementById("loading_1");

	if(iFrame1.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete1, 2000 );
	}
	else
	{
		if(iFrame1.innerHTML == "success")
		{		
			loading1.style.display = "none";
			document.getElementById('result_show_1').innerHTML= "";
			document.getElementById('result_show_1').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading1.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame1.innerHTML);
		}
	}
}


function upload_design2()
{
document.getElementById('my_form_2').target = "my_iframe_2"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_2').submit();

var iFrame2 = document.getElementById("my_iframe_2");
var loading2 = document.getElementById("loading_2");
iFrame2.style.display = "none";
iFrame2.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading2.style.display = "block";
checkuploadcomplete2();
}

var checkuploadcomplete2 = function()
{		
	var iFrame2 = document.getElementById("my_iframe_2").contentDocument.getElementsByTagName("body")[0];
	var loading2 = document.getElementById("loading_2");

	if(iFrame2.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete2, 2000 );
	}
	else
	{
		if(iFrame2.innerHTML == "success")
		{		
			loading2.style.display = "none";
			document.getElementById('result_show_2').innerHTML= "";
			document.getElementById('result_show_2').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading2.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame2.innerHTML);
		}
	}
}

function upload_design3()
{
document.getElementById('my_form_3').target = "my_iframe_3"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_3').submit();

var iFrame3 = document.getElementById("my_iframe_3");
var loading3 = document.getElementById("loading_3");
iFrame3.style.display = "none";
iFrame3.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading3.style.display = "block";
checkuploadcomplete3();
}

var checkuploadcomplete3 = function()
{		
	var iFrame3 = document.getElementById("my_iframe_3").contentDocument.getElementsByTagName("body")[0];
	var loading3 = document.getElementById("loading_3");

	if(iFrame3.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete3, 2000 );
	}
	else
	{
		if(iFrame3.innerHTML == "success")
		{		
			loading3.style.display = "none";
			document.getElementById('result_show_3').innerHTML= "";
			document.getElementById('result_show_3').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading3.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame3.innerHTML);
		}
	}
}

function upload_design4()
{
document.getElementById('my_form_4').target = "my_iframe_4"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_4').submit();

var iFrame4 = document.getElementById("my_iframe_4");
var loading4 = document.getElementById("loading_4");
iFrame4.style.display = "none";
iFrame4.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading4.style.display = "block";
checkuploadcomplete4();
}

var checkuploadcomplete4 = function()
{		
	var iFrame4 = document.getElementById("my_iframe_4").contentDocument.getElementsByTagName("body")[0];
	var loading4 = document.getElementById("loading_4");

	if(iFrame4.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete4, 2000 );
	}
	else
	{
		if(iFrame4.innerHTML == "success")
		{		
			loading4.style.display = "none";
			document.getElementById('result_show_4').innerHTML= "";
			document.getElementById('result_show_4').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';			
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading4.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame4.innerHTML);
		}
	}
}

function upload_design5()
{
document.getElementById('my_form_5').target = "my_iframe_5"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_5').submit();

var iFrame5 = document.getElementById("my_iframe_5");
var loading5 = document.getElementById("loading_5");
iFrame5.style.display = "none";
iFrame5.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading5.style.display = "block";
checkuploadcomplete5();
}

var checkuploadcomplete5 = function()
{		
	var iFrame5 = document.getElementById("my_iframe_5").contentDocument.getElementsByTagName("body")[0];
	var loading5 = document.getElementById("loading_5");

	if(iFrame5.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;	
		setTimeout ( checkuploadcomplete5, 2000 );
	}
	else
	{
		if(iFrame5.innerHTML == "success")
		{		
			loading5.style.display = "none";
			document.getElementById('result_show_5').innerHTML= "";
			document.getElementById('result_show_5').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading5.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame5.innerHTML);
		}
	}
}
function upload_design6()
{
document.getElementById('my_form_6').target = "my_iframe_6"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_6').submit();

var iFrame6 = document.getElementById("my_iframe_6");
var loading6 = document.getElementById("loading_6");
iFrame6.style.display = "none";
iFrame6.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading6.style.display = "block";
checkuploadcomplete6();
}

var checkuploadcomplete6 = function()
{		
	var iFrame6 = document.getElementById("my_iframe_6").contentDocument.getElementsByTagName("body")[0];
	var loading6 = document.getElementById("loading_6");

	if(iFrame6.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete6, 2000 );
	}
	else
	{
		if(iFrame6.innerHTML == "success")
		{		
			loading6.style.display = "none";
			document.getElementById('result_show_6').innerHTML= "";
			document.getElementById('result_show_6').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading6.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame6.innerHTML);
		}
	}
}

function upload_design7()
{
document.getElementById('my_form_7').target = "my_iframe_7"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_7').submit();

var iFrame7 = document.getElementById("my_iframe_7");
var loading7 = document.getElementById("loading_7");
iFrame7.style.display = "none";
iFrame7.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading7.style.display = "block";
checkuploadcomplete7();
}

var checkuploadcomplete7 = function()
{		
	var iFrame7 = document.getElementById("my_iframe_7").contentDocument.getElementsByTagName("body")[0];
	var loading7 = document.getElementById("loading_7");

	if(iFrame7.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete7, 2000 );
	}
	else
	{
		if(iFrame7.innerHTML == "success")
		{		
			loading7.style.display = "none";
			document.getElementById('result_show_7').innerHTML= "";
			document.getElementById('result_show_7').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading7.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame7.innerHTML);
		}
	}
}

function upload_design8()
{
document.getElementById('my_form_8').target = "my_iframe_8"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_8').submit();

var iFrame8 = document.getElementById("my_iframe_8");
var loading8 = document.getElementById("loading_8");
iFrame8.style.display = "none";
iFrame8.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading8.style.display = "block";
checkuploadcomplete8();
}

var checkuploadcomplete8 = function()
{		
	var iFrame8 = document.getElementById("my_iframe_8").contentDocument.getElementsByTagName("body")[0];
	var loading8 = document.getElementById("loading_8");

	if(iFrame8.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete8, 2000 );
	}
	else
	{
		if(iFrame8.innerHTML == "success")
		{		
			loading8.style.display = "none";
			document.getElementById('result_show_8').innerHTML= "";
			document.getElementById('result_show_8').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading8.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame8.innerHTML);
		}
	}
}

function upload_design9()
{
document.getElementById('my_form_9').target = "my_iframe_9"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_9').submit();

var iFrame9 = document.getElementById("my_iframe_9");
var loading9 = document.getElementById("loading_9");
iFrame9.style.display = "none";
iFrame9.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading9.style.display = "block";
checkuploadcomplete9();
}

var checkuploadcomplete9 = function()
{		
	var iFrame9 = document.getElementById("my_iframe_9").contentDocument.getElementsByTagName("body")[0];
	var loading9 = document.getElementById("loading_9");

	if(iFrame9.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete9, 2000 );
	}
	else
	{
		if(iFrame9.innerHTML == "success")
		{		
			loading9.style.display = "none";
			document.getElementById('result_show_9').innerHTML= "";
			document.getElementById('result_show_9').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading9.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame9.innerHTML);
		}
	}
}
function upload_design10()
{
document.getElementById('my_form_10').target = "my_iframe_10"; //'my_iframe' is the name of the iframe
document.getElementById('my_form_10').submit();

var iFrame10 = document.getElementById("my_iframe_10");
var loading10 = document.getElementById("loading_10");
iFrame10.style.display = "none";
iFrame10.contentDocument.getElementsByTagName("body")[0].innerHTML = "";
document.getElementById('check_submit').value=0;
loading10.style.display = "block";
checkuploadcomplete10();
}

var checkuploadcomplete10 = function()
{		
	var iFrame10 = document.getElementById("my_iframe_10").contentDocument.getElementsByTagName("body")[0];
	var loading10 = document.getElementById("loading_10");

	if(iFrame10.innerHTML == "")
	{
		document.getElementById('check_submit').value=0;
		setTimeout ( checkuploadcomplete10, 2000 );
	}
	else
	{
		if(iFrame10.innerHTML == "success")
		{		
			loading10.style.display = "none";
			document.getElementById('result_show_10').innerHTML= "";
			document.getElementById('result_show_10').innerHTML = '<img width="16" height="16" src="./images/msg_success_icon.gif">';
			document.getElementById('check_submit').value=1;
			//successful do something here!
		}
		else
		{
			loading10.style.display = "none";
			document.getElementById('check_submit').value=0;
			alert("Error: "+ iFrame10.innerHTML);
		}
	}
}