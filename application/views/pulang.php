<!DOCTYPE html>
<html>
<head>
<script>

$( document ).ready(function() {
 $("#nik").keyup(function(event){
    	if(event.keyCode == 13){
        	 cekMasuk();
    	}
	});
});
function cekMasuk(){
			var nik=$("#nik").val();
		$.ajax({
			url:'<?php echo base_url(); ?>home/cekPulang/',		 
			type:'POST',
			data:"nik="+nik,
			success:function(data){ 
			  	if(data==''){
					 $( "#infodlg" ).html('Nik Tidak tersedia Harap Periksa Kembali ...');
					 $( "#infodlg" ).dialog({ title:"Info...", draggable: false});					 
				} else {
				   $("#notification").html(data);
				   $("#nik").val("");
				}
			 }
		});		
}
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
t=setTimeout(function(){startTime()},500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
</script>
</head>

<body onLoad="startTime()">
<label style="font-size:60px;font-family:calibri">PULANG </label>
<div id="txt" style="font-family:calibri;font-size:100px;text-align:left;margin-bottom:30px;float:right;width:400px"></div><hr>
 <table>
	<tr>
    	<td></td>
        <td></td>
        <td><input type="text"  name="nik" id="nik" style="height:50px;width:400px;font-size:30px" placeholder="NIK PEGAWAI"></td>
    </tr>
</table>
<div id="notification">
</div>
</body>
</html>
