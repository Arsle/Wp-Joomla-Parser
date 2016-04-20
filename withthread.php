

<?php
error_reporting(0);

class th extends Thread {
   
    public function __construct($i) {
        $this->i = $i;
    }
  
    public function run() {
       
       
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_URL,$this->i);
        curl_setopt($curl,CURLOPT_TIMEOUT,8);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
        $ac  = curl_exec($curl);
        curl_close($curl);
		
		$ayrac='@<meta name="generator" content="(.*?)" />@si';
	    
		preg_match($ayrac,$ac,$tur);
		
		if(strstr($tur[1],"WordPress"))
		{
			echo "$this->i-->Wordpress\n";
		}
		else if (strstr($tur[1],"Joomla"))
		{
			echo "$this->i-->Joomla\n";
		}
        
    }
}
print "|-----------WordPress Joomla Parser 2.0----------------|\n";
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

if(isset($argv[1]))
{
	if(strstr($argv[1],".txt")){
$pool            = new Pool($argv[2]);
$gorevler = array(); 
$siteliste=file_get_contents($argv[1]);
$urls=explode(PHP_EOL,$siteliste);

              $sure1 = time();
foreach($urls as $url)
{
    $gorevler[] = new th($url);
}
 

 
foreach($gorevler as $gorev)
{
    $pool->submit($gorev);
 
} 

 
$pool->shutdown();
 
echo "Harcanan Sure: ".(time()-$sure1);
}
else
{
	print "Kullanim:php $argv[0] sitelistesi.txt Thread";
}
}
else
{
	print "Kullanim:php $argv[0] sitelistesi.txt Thread";
}
?>


