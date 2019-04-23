<?php
/**
 * PHP Whois v1.0
 * Author: Peter Le
 * E-mail: lehoangson@gmail.com
 * Website: www.vncoder.org
 **/
 
require_once './whois.php';
$domain = strtolower($_REQUEST['domain']);
if (!$domain) {
	echo 'N/A'; exit;
}
$domain = str_replace('https://', '', $domain);
$domain = str_replace('http://', '', $domain);
$domain = str_replace('www.', '', $domain);
if (!is_domain($domain)) {
	echo 'Domain name not valid'; exit;
}
$data = @explode('.', $domain);
$domain = $data[0];
$c = count($data);
if ($c == 2) {
	$ext = ".{$data[1]}";
} elseif ($c == 3) {
	$ext = ".{$data[1]}.{$data[2]}";
} else {
	echo 'Domain name not valid'; exit;
}

$result = lookupDomain($domain, $ext);
$whois_server = strtolower($result['whois']);
$whois_server = str_replace('<br />', '<br>', $whois_server);
$whois_server = str_replace('<br/>', '<br>', $whois_server);
$whois_server = @explode('whois server: ', $whois_server);
$whois_server = @explode('<br>', $whois_server[1]);
$whois_server = $whois_server[0];
$whois_server = str_replace('https://', '', $whois_server);
$whois_server = str_replace('http://', '', $whois_server);
$whois_server  = str_replace('ver.', '', $whois_server);

if (strlen($whois_server) > 10) {
	$result_b = lookupDomain($domain, $ext, $whois_server);
	if (strlen($result_b['whois']) > 500) {
		$output =  $result_b['whois'];
	} else {
		$output =  $result['whois'];
	}
} else {
	$output =  $result['whois'];
}

echo $output; exit;

function is_domain($domain_name) {
	$domain_len = strlen($domain_name);
	if ($domain_len < 3 OR $domain_len > 253) {
		return FALSE;
	}
	if(stripos($domain_name, 'http://') === 0) {
		$domain_name = substr($domain_name, 7); 
	} elseif(stripos($domain_name, 'https://') === 0) {
		$domain_name = substr($domain_name, 8);
	}
	if(stripos($domain_name, 'www.') === 0) {
		$domain_name = substr($domain_name, 4);
	}
	if(strpos($domain_name, '.') === FALSE OR $domain_name[strlen($domain_name)-1]=='.' OR $domain_name[0]=='.') {
		return FALSE;
	}
	return (filter_var ('http://' . $domain_name, FILTER_VALIDATE_URL)===FALSE)? FALSE:TRUE;
}
?>