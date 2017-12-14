function onlo()
    {
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};
			if(isMobile.any()) {
				document.getElementById('ismobile').value = "ismobile";
			}else{
				document.getElementById('ismobile').value = "notmobile";
				if(document.getElementById('filesize').value >= 140000 && document.getElementById('filesize').value < 919358){
					document.getElementById('picture').className = "img-circle rotate90";
				}else if(document.getElementById('filesize').value >= 919358 && document.getElementById('filesize').value < 1240228){
					document.getElementById('picture').className = "img-circle rotate180";
				}
			}
	}

function changeYear(){
	var year = document.getElementById("year").value;
	var val = document.getElementById("born").value;
	var res = val.split(".");
	document.getElementById("born").value = year + "." + res[1] + "."  + res[2] + "." ;
}
function changeMonth(){
	var month = document.getElementById("month").value;
	var val = document.getElementById("born").value;
	var res = val.split(".");
	document.getElementById("born").value = res[0] + "." + month + "."  + res[2] + "." ;
}
function changeDay(){
	var day = document.getElementById("day").value;
	var val = document.getElementById("born").value;
	var res = val.split(".");
	document.getElementById("born").value = res[0] + "." + res[1] + "."  + day + "." ;
}













/*-------------------------------------------------------------------------------*/
function changethefirstdate(){
	var val = document.getElementById("event_time").value;
	var val2 = document.getElementById("event_time2").value;
	if (val2 < val && document.getElementById("nomatter").checked == false) {
		document.getElementById("bu").hidden = true;
		document.getElementById("changefirst").hidden = false;
	}
	else{
		document.getElementById("bu").hidden = false;
		document.getElementById("changefirst").hidden = true;
	}
}
function changetheseconddate(){
	var val2 = document.getElementById("event_time").value;
	var val = document.getElementById("event_time2").value;
	if (val2 > val && document.getElementById("nomatter").checked == false) {
    	document.getElementById("bu").hidden = true;
		document.getElementById("changefirst").hidden = false;
	}
	else{
		document.getElementById("bu").hidden = false;
		document.getElementById("changefirst").hidden = true;
	}
}
function checktime(){
	var h = document.getElementById("hour").value;
		var m = document.getElementById("minute").value;
		var th = document.getElementById("to_hour").value;
		var tm = document.getElementById("to_minute").value;
		var val = document.getElementById("event_time").value;
		var val2 = document.getElementById("event_time2").value;
			if ((val == val2 && (th < h || (h == th && tm < m))) && document.getElementById("nomatter").checked == false) {
				document.getElementById("changetime").hidden = false;
				document.getElementById("bu").hidden = true;
			}else{
		    	document.getElementById("bu").hidden = false;
				document.getElementById("changetime").hidden = true;
			}
}
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
function checkthedatetoday(){
	var d = new Date();
	var inthemonth = d.getDate();
	var intheyear = d.getFullYear();
	var intheday = d.getMonth();
	var h2 = d.getHours();
    var m2 = addZero(d.getMinutes());
	intheday = intheday + 1;
	var dateee = intheyear + '.' + addZero(intheday) + '.'  + addZero(inthemonth) + '.' + h2 + ':' + m2;
	var h = document.getElementById("hour").value;
	var m = document.getElementById("minute").value;
	var th = document.getElementById("to_hour").value;
	var tm = document.getElementById("to_minute").value;
	var val = document.getElementById("event_time").value;
	var val2 = document.getElementById("event_time2").value;
	var elso = val + h + ':' + m;
	var masodik = val2 + th + ':' + tm;
	if (dateee > elso || (dateee > masodik && document.getElementById("nomatter").checked == false)) {
		document.getElementById("bu").hidden = true;
		document.getElementById("future").hidden = false;
	}
	if(dateee <= elso && (dateee <= masodik || document.getElementById("nomatter").checked == true)){
		document.getElementById("bu").hidden = false;
		document.getElementById("future").hidden = true;
	}
}


function eventchangeYear2(){
	var year = document.getElementById("year2").value;
	var val = document.getElementById("event_time2").value;
	var res = val.split(".");
	document.getElementById("event_time2").value = year + "." + res[1] + "."  + res[2] + "." ;
	changetheseconddate();	
	changethefirstdate();
	checktime();
	checkthedatetoday();
}
function eventchangeMonth2(){
	var month = document.getElementById("month2").value;
	var val = document.getElementById("event_time2").value;
	var res = val.split(".");
	document.getElementById("event_time2").value = res[0] + "." + month + "."  + res[2] + "." ;
	changetheseconddate();
	changethefirstdate();
	checktime();
	checkthedatetoday();
}
function eventchangeDay2(){
	var day = document.getElementById("day2").value;
	var val = document.getElementById("event_time2").value;
	var res = val.split(".");
	document.getElementById("event_time2").value = res[0] + "." + res[1] + "."  + day + "." ;
	changetheseconddate();
	changethefirstdate();
	checktime();
	checkthedatetoday();
}
function eventchangeYear(){
	var year = document.getElementById("year").value;
	var val = document.getElementById("event_time").value;
	var res = val.split(".");
	document.getElementById("event_time").value = year + "." + res[1] + "."  + res[2] + "." ;
	changethefirstdate();
	changetheseconddate();
	checktime();
	checkthedatetoday();
}

function eventchangeMonth(){
	var month = document.getElementById("month").value;
	var val = document.getElementById("event_time").value;
	var res = val.split(".");
	document.getElementById("event_time").value = res[0] + "." + month + "."  + res[2] + "." ;
	changethefirstdate();
	changetheseconddate();
	checktime();
	checkthedatetoday();
}
function eventchangeDay(){
	var day = document.getElementById("day").value;
	var val = document.getElementById("event_time").value;
	var res = val.split(".");
	document.getElementById("event_time").value = res[0] + "." + res[1] + "."  + day + "." ;
	changethefirstdate();
	changetheseconddate();
	checktime();
	checkthedatetoday();
}
function changetime(){
	checktime();
	checkthedatetoday();
}
function nomatter1(){
	if(document.getElementById("nomatter").checked == true){
		document.getElementById("nomatter").value = "nomatter";
		document.getElementById("month2").required = false;
		document.getElementById("day2").required = false;
		document.getElementById("year2").required = false;
		document.getElementById("to_hour").required = false;
		document.getElementById("to_minute").required = false;
		document.getElementById("month2").hidden = true;
		document.getElementById("day2").hidden = true;
		document.getElementById("year2").hidden = true;
		document.getElementById("to_hour").hidden = true;
		document.getElementById("kettospont").hidden = true;
		document.getElementById("to_minute").hidden = true;
    	document.getElementById("bu").hidden = false;
		document.getElementById("changetime").hidden = true;
		document.getElementById("changefirst").hidden = true;
		checkthedatetoday();
	}else{
		document.getElementById("nomatter").value = "matter";
		document.getElementById("month2").required = true;
		document.getElementById("day2").required = true;
		document.getElementById("year2").required = true;
		document.getElementById("to_hour").required = true;
		document.getElementById("to_minute").required = true;
		document.getElementById("month2").hidden = false;
		document.getElementById("day2").hidden = false;
		document.getElementById("year2").hidden = false;
		document.getElementById("kettospont").hidden = false;
		document.getElementById("to_hour").hidden = false;
		document.getElementById("to_minute").hidden = false;
		checktime();
		changethefirstdate();
		changetheseconddate();
		checkthedatetoday();
	}
}

function changetoonline(){
	if(document.getElementById("changeonline").checked == true){
		document.getElementById("map2").hidden = true;
		document.getElementById("map2label").hidden = true;
		document.getElementById("wheretext").hidden = true;
		document.getElementById("wherelabel").hidden = true;
		document.getElementById("map").hidden = true;
		document.getElementById("maplabel").hidden = true;
		document.getElementById("address").hidden = true;
		document.getElementById("event_place").hidden = true;
		document.getElementById("eventtwonlabel").hidden = true;
		document.getElementById("eventplacelabel").hidden = true;
		document.getElementById("address").required = false;
		document.getElementById("event_place").required = false;
		document.getElementById("wheretext").required = false;
		document.getElementById("changeonline").value = "yesonline";
	}else{
		document.getElementById("map2").hidden = false;
		document.getElementById("map2label").hidden = false;
		document.getElementById("wheretext").hidden = false;
		document.getElementById("wherelabel").hidden = false;
		document.getElementById("map").hidden = false;
		document.getElementById("maplabel").hidden = false;
		document.getElementById("address").hidden = false;
		document.getElementById("event_place").hidden = false;
		document.getElementById("eventtwonlabel").hidden = false;
		document.getElementById("eventplacelabel").hidden = false;
		document.getElementById("address").required = true;
		document.getElementById("event_place").required = true;
		document.getElementById("wheretext").required = true;
		document.getElementById("changeonline").value = "noonline";
	}
}
/*-------------------------------------------------------------------------------*/








function changePw(){
	var pwvalue = document.getElementById("pw").value;
	var pwagainvalue = document.getElementById("pwagain").value;
	var pwlength = pwvalue.length;
	var pwagainlength = pwagainvalue.length;
	if((pwlength < 6 || pwlength > 16) ||(pwagainlength < 6 || pwagainlength > 16)){
		document.getElementById("notgoodlength").hidden = false;
	}else{
		document.getElementById("notgoodlength").hidden = true;
	}
	if(pwvalue != pwagainvalue){
		document.getElementById("notthesamepw").hidden = false;
	}else{
		document.getElementById("notthesamepw").hidden = true;
	}
}
function checkSubmit(){
	var isnumber = document.getElementById("howmanyperson_textbox").value;
	if(isNaN(isnumber) && document.getElementById("howmanyperson").checked == false)
	{
		alert("How many person would you invite must be a number!");
		document.getElementById("howmanyperson_textbox").value = "";
		return false;
	}
	else
	{
		return true;
	}
	
}
function hiddenTextbox(){
	if(document.getElementById("howmanyperson").checked == true){
		document.getElementById("howmanyperson_textbox").hidden = true;
		document.getElementById("howmanyperson").value = "yeah";
		document.getElementById("howmanyperson_textbox").required = false;
	}else{
		document.getElementById("howmanyperson_textbox").hidden = false;
		document.getElementById("howmanyperson_textbox").required = true;
		document.getElementById("howmanyperson").value = "";
	}
}