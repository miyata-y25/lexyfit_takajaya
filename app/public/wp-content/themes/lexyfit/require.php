<?php
mb_language('ja');
mb_internal_encoding('UTF-8');

function e_send_mail($to_name, $to_addr, $subject, $body, $from_name, $from_addr){

  $body = trim($body);


	if($to_name){
		$to = sprintf('%s<%s>',mb_encode_mimeheader($to_name,'UTF-8'),$to_addr);
	}else{
		$to = $to_addr;
	}
	if($from_name){
		$from = sprintf('From: %s<%s>'."\r\n",mb_encode_mimeheader($from_name,'UTF-8'),$from_addr);
	}else{
		$from = $from_addr;
	}
	$from .= 'Content-Type: text/plain; charset= iso-2022-jp';
//	$from .= 'Content-Type: text/plain; charset=ISO-10646';
	return mb_send_mail($to, $subject, $body, $from);
}

?>
