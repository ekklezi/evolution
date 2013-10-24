<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}
//[[phpthumb? &input=`[+image+]` &options=`w=150,h=76,far=C,bg=FFFFFF`]]
//Author: Bumkaka

$base="assets/cache/images";   // тут можно менять путь

if($input === '' || !file_exists(MODX_BASE_PATH . $input)){
  $input = 'assets/snippets/phpthumb/noimage.png';
}

  $options = 'f=jpg&q=96&'.strtr($options, Array("," => "&", "_" => "=", '{' => '[', '}' => ']'));
  $path_parts=pathinfo($input);
  require_once MODX_BASE_PATH.'assets/snippets/phpthumb/phpthumb.class.php';
  $phpThumb = new phpthumb();
  $phpThumb->setSourceFilename(MODX_BASE_PATH . $input);

  parse_str($options, $params);
  foreach ($params as $key => $value) {
    $phpThumb->setParameter($key, $value);
  }

  $tmp=str_replace(MODX_BASE_PATH . "assets/images","",$path_parts['dirname']);
  $tmp=str_replace("assets/images","",$tmp);
  $tmp=explode("/",$tmp);
  $folder=$base;  
  
  for($i=0;$i<count($tmp);$i++){
    if ($tmp[$i]=='') continue;
    $folder.="/".$tmp[$i];
    if(!is_dir(MODX_BASE_PATH.$folder)) mkdir(MODX_BASE_PATH.$folder);
  }
  
  $fname=$folder."/".$params['w']."x".$params['h'].'-'.$path_parts['filename'].".".substr(md5(serialize($params)),0,3).".".$params['f'];
  $outputFilename =MODX_BASE_PATH.$fname;
  if (!file_exists($outputFilename)) {
	  if ($phpThumb->GenerateThumbnail()) {
		  $phpThumb->RenderToFile($outputFilename);
	  } else {
		  $modx->logEvent(0, 3, implode('<br/>', $phpThumb->debugmessages), 'phpthumb');
	  }
  }
  return $fname;
?>
