<html>
<body  >
<table border="1" width="300">
<tr>
<td width="100">文件大小</td>
<td width="200"><div id="filesize">未知长度</div></td>
</tr>
<tr>
<td>已经下载</td><td><div id="downloaded">0</div></td>
</tr>
<tr>
<td>完成进度</td><td><div id="progressbar" style="float:left;width:1px; text-align:center; color:#FFFFFF; background-color:#0066CC"></div><div id="progressText" style=" float:left">0%</div></td>
</tr>
</table>
<script type="text/javascript">
   //文件长度
    var filesize=0;
    function $(obj){
        return document.getElementById(obj);
    }
 //设置文件长度
   function setFileSize(fsize)
   {
     filesize=fsize;
     $("filesize").innerHTML=fsize;
   }
 //设置已经下载的,并计算百分比
   function setDownloaded(fsize)
   {
   $("downloaded").innerHTML=fsize;
  if(filesize>0)
  {
    var percent=Math.round(fsize*100/filesize);
     $("progressbar").style.width=(percent+"%");
     if(percent>0)
     {
       $("progressbar").innerHTML=percent+"%";
        $("progressText").innerHTML="";
     }
     else
     {
        $("progressText").innerHTML=percent+"%";
     }
    
  }
   }
</script>
<?php
$url="http://dl_dir.qq.com/qqfile/qq/QQ2010/QQ2010Beta3.exe";
$newfname="./QQ2010Beta3.exe";
$file = fopen ($url, "rb");
if ($file) 
{
  //获取文件大小
  $filesize=-1;
  $headers = get_headers($url, 1);
  if ((!array_key_exists("Content-Length", $headers))) {$filesize=0; }
        $filesize= $headers["Content-Length"];
   //不是所有的文件都会先返回大小的，
  //有些动态页面不先返回总大小，这样就无法计算进度了
  if($filesize != -1)
  //在前台显示文件大小
  echo "<script>setFileSize($filesize);</script>";
    $newf = fopen ($newfname, "wb");
    $downlen=0;
    if ($newf)
      while(!feof($file)) {
      
        //默认获取8K
        $data=fread($file, 1024 * 8 );
        
        //累计已经下载的字节数
        $downlen+=strlen($data);
        
        fwrite($newf, $data, 1024 * 8 );
        
        ////在前台显示已经下载文件大小
        echo "<script>setDownloaded($downlen);</script>";
        //
        ob_flush();
        flush();
        
    }
}
    
if ($file) {
fclose($file);
}
if ($newf) {
    fclose($newf);
}
?>
</body>
</html>