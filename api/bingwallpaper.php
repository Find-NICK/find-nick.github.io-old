<?php
//????????
if ($_GET['rand']==='true') {
  $gettime = rand(-1,7);
}else{
//????????????????
  $gettimebase = $_GET['day'];
  if (empty($gettimebase)) {
    $gettime = 0;
  }else{
    $gettime = $gettimebase;
  }
}
//??Bing Json??
$json_string = file_get_contents('https://www.bing.com/HPImageArchive.aspx?format=js&idx='.$gettime.'&n=1');
//???PHP??
$data = json_decode($json_string);
//????url
$imgurlbase = "https://www.bing.com".$data->{"images"}[0]->{"urlbase"};
//??????????
$imgsizebase = $_GET['size'];
if (empty($imgsizebase)){
  $imgsize = "1920x1080";
}else{
  $imgsize = $imgsizebase;
}
//????url
$imgurl = $imgurlbase."_".$imgsize.".jpg";
//??????
$imgtime = $data->{"images"}[0]->{"startdate"};
$imgtitle = $data->{"images"}[0]->{"copyright"};
$imglink = $data->{"images"}[0]->{"copyrightlink"};
//???????????
if ($_GET['info']==='true') {
  echo "{title:".$imgtitle.",url:".$imgurl.",link:".$imglink.",time:".$imgtime."}";
}else{
  //??????url
  header("Location: $imgurl");
}