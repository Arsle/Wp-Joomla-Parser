<?php 

print "|-----------WordPress Joomla Parser 1.0----------------|\n";
print "|      _             _                    _            |\n";
print "|     | |           (_)                  (_)           |\n";
print "|     | | __ _ _ __  _ ___ ___  __ _ _ __ _  ___  ___  |\n";
print "| _   | |/ _` | '_ \| / __/ __|/ _` | '__| |/ _ \/ __| |\n";
print "|| |__| | (_| | | | | \\__ \\__ \\ (_| | |  | |  __/\\__ \\ |\n";
print "| \\____/ \\____|_| |_|_|___/___/\\____|_|  |_|\\___||___/ |\n";
print "|------------------------------------------------------|\n";
print "|             /\\            | |                        |\n";
print "|            /  \\   _ __ ___| | ___                    |\n";
print "|           / /\ \\ | '__/ __| |/ _ \\                   |\n";
print "|          / ____ \\| |  \\__ \\ |  __/                   |\n";
print "|         /_/    \\_\\_|  |___/_|\\___|                   |\n";
print "|------------------------------------------------------|\n";
print "\n";

if(isset($argv[1])){
	if(strstr($argv[1],".txt")){
$cek=file_get_contents($argv[1]);


	


Function JoomlaMi($kaynak,$site)
{
	$ayrac='@<meta name="generator" content="(.*?)" />@si';
	preg_match($ayrac,$kaynak,$joom);
	
	if(@(strstr($joom[1],"Joomla!")))
	{
		
		yazdir(1,$site);
		print $site."-->Joomla\n";
	}
	else
	{
		yazdir(3,$site);
		print $site."-->Diger\n";
		
	}
	
}

Function WpMi($kaynak,$site)
{
	$ayrac='@<meta name="generator" content="(.*?)" />@si';
	preg_match($ayrac,$kaynak,$wp);
	
	if(@(strstr($wp[1],"WordPress")))
	{
		yazdir(2,$site);
		print $site."-->Wordpress\n";
	}
	else
	{
		JoomlaMi($kaynak,$site);
	}
	
	
}

Function CurlCek($siteliste)
{
	$siteler=explode("\n",$siteliste);
	
	
	$ch1=curl_multi_init();
    $hc = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13";
	foreach($siteler as $id=>$site){
	$curl[$id]=curl_init();
    curl_setopt($curl[$id], CURLOPT_REFERER, 'http://www.google.com');
    curl_setopt($curl[$id], CURLOPT_URL,$site);
    curl_setopt($curl[$id], CURLOPT_USERAGENT, $hc);
    curl_setopt($curl[$id], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl[$id], CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($curl[$id], CURLOPT_SSL_VERIFYPEER,false);
 
    curl_multi_add_handle($ch1,$curl[$id]);
	}
	do
	{
		curl_multi_exec($ch1,$durum);
	}
	while($durum>0);
	
	foreach($curl as $cid=>$cson)
	{
		$sonuc[$cid]=curl_multi_getcontent($cson);
		
		
		WpMi($sonuc[$cid],$siteler[$cid]);
	}
	
	
}

Function yazdir($tur,$site)
{
	$yazwp=fopen("wp.txt","a+");
	$yazjoom=fopen("joom.txt","a+");
	$yazdiger=fopen("diger.txt","a+");
	
	$sayacjoom=0;
	$sayacwp=0;
	$sayacdiger=0;
	
	switch($tur)
	{
		case 1:
			fwrite($yazjoom,$site."\n");
			
			break;
		case 2:
			fwrite($yazwp,$site."\n");
			
			break;
		case 3:
			fwrite($yazdiger,$site."\n");
			
			break;
	}                      
	
	fclose ($yazwp);
	fclose ($yazjoom);
	fclose ($yazdiger);
}



	
	CurlCek($cek);
}
else 
{
	print "Kullanim:php $argv[0] sitelistesi.txt";
}
}
else 
{
	print "Kullanim:php $argv[0] sitelistesi.txt";
}


?>
