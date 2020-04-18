function startTime()
{ 	var today=new Date();
	var weekday=new Array(7);
	var weekday=["MINGGU","SENIN","SELASA","RABU","KAMIS","JUMAT","SABTU"];
	var monthname=new Array(12);
	var monthname=["JAN","FEB","MAR","APR","MEI","JUN","JUL","AGU","SEP","OKT","NOV","DES"];
	var dayname=weekday[today.getDay()]; //kenapa gak berubah ya?
	var day=today.getDate();
	var month=monthname[today.getMonth()]; 
	var year=today.getFullYear();
	var h=today.getHours();
	var m=today.getMinutes();	
	var s=today.getSeconds();
	h=checkTime(h);
	m=checkTime(m);
	s=checkTime(s);
	document.getElementById('clocktime').innerHTML=dayname+", "+day+"-"+month+"-"+year+", "+h+":"+m+":"+s;
	//document.getElementById('year').innerHTML=year;
	t=setTimeout(function(){startTime()},500);
}
// function checkTime to add a zero in front of numbers&lt;10 

function checkTime(i)
{	if(i<10){i="0"+i;}
	return i;
}