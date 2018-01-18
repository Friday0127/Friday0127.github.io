<?php

date_default_timezone_set("PRC");

$stockcode = 'sz002908,sz000856,sz300612,sz002907,sz002743,sh600506';
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
if (date("H") > 8 and date("H") < 15) {
/* echo ("setTimeout('fresh_page()',3000);"); */
}
echo ("</script>");
/* echo ("<body style=\"margin:auto;\"><div style=\"text-align:center;width:100%;height:70%;padding-top:70px;\"><center>"); */
echo ("<body style=\"width: 100%; height:auto;\"><div style=\"width: 100%; height:auto; margin: 0 auto;padding-top:70px;font-size:45px; \"><center>");
echo date("Y-m-d H:i:s");
echo ("<br><br>");
echo ("<table style=\"font-size:45px; \">");
$codeArray = explode(',',$stockcode); 
for($index=0;$index<count($codeArray);$index++) 
{ 
	query_data($codeArray[$index]); 
}
echo ("</table></center></div></body>");

function query_data($parameter){
$url = 'http://hq.sinajs.cn/list='.$parameter; 
$content = file_get_contents($url);
$data = explode(',',$content); 
echo ("<tr><td>");
echo substr($parameter,2,6)."&nbsp;&nbsp;&nbsp;";
echo ("</td><td>"); 
$name = iconv("GB2312","UTF-8",$data[0]);
$name = substr($name,21,40);

echo $name."&nbsp;&nbsp;&nbsp;";
echo ("</td><td>"); 
echo (number_format(round($data[3],2),2)."&nbsp;&nbsp;&nbsp;");
echo ("</td><td>"); 
$percent = round(($data[3] - $data[2])/$data[2]*100,2);
if ($percent > 0.00){
	echo ("<font color=\"#f81016\">");echo (number_format($percent,2)."%&nbsp;&nbsp;&nbsp;"); 
	if ($percent > 7.00){
		echo "<td>超大肉</td>";
	}elseif ($percent > 5.00){
		echo "<td>大肉</td>";
	}elseif ($percent > 3.00){
		 echo "<td>小肉</td>";
	}else{
		 echo "<td>喝汤</td>";
	}
}
if ($percent == 0.00){
	echo ("<font color=\"#2F4F4F\">");echo (number_format($percent,2)."%&nbsp;&nbsp;&nbsp;"); echo ("有点意思");
}
if ($percent < 0.00){
	echo ("<font color=\"#1B9614\">");echo (number_format($percent,2)."%&nbsp;&nbsp;&nbsp;"); 
	if ($percent < -7.00){
		echo ("<td>关灯吃面，趁早割肉</td>");
	}elseif ($percent < -5.00){
		echo ("<td>亏惨了</td>");
	}elseif ($percent < -3.00){
		echo ("<td>亏了不少</td>");
	}else{
		echo ("<td>已经亏了</td>");
	}
}
echo ("</font>");
echo ("</td></tr>");
}	
?>
