<?php
/*
2014 - Public domain;

Simple attachment scanner for hMailServer (and others if they support custom virus scanners)

1. PHP-CLI is in your paths
2. In hMailServer, goto Settings > Anti-Virus > External virus Scanner
3. called the php script in a directory of your choice, e.g. `php zipexescanner.php`
4. set Return Value to 128
5. Done!

Notes:

* This could probably be ZIP bombed.
* So far, this has 100% positive detection.
* Doesn't work for password protected files.

*/

if(!isset($_SERVER['argv'][1])) {
  exit(0);
  return;
}
$zip = zip_open(  $_SERVER['argv'][1]);
//Is opened?
if(is_resource($zip)) {

   //Scan file entry list
   while(($zip_entry = zip_read($zip)) !== false){
     //Find last directory character in entry
     $last = strrpos(zip_entry_name($zip_entry), DIRECTORY_SEPARATOR);

     //Directory (Don't need it)
     $dir = substr(zip_entry_name($zip_entry), 0, $last);

     //I know this cuts off the first character, but we are only interested extension at the end of the entry
     $file = substr(zip_entry_name($zip_entry), strrpos(zip_entry_name($zip_entry), DIRECTORY_SEPARATOR)+1);

     //Reset found flag (not that I'm returning after I find something, just a formallity to undefined vars
     $found = FALSE;

     //Add more dangerous file extensions here
     $ext = array('.exe','.scr','.com','.pif');

     //string compare (case insensitive) to each extension. if found, flag!
     foreach($ext as $e) {
          if(stristr($file,$e)!==false && $found===false) { $found = $e; }
     }

     //Break out early if found
     if($found) {
        //Add some logging here?
        exit(128);
        return;
     }
   }
}
//Its clean...
exit(0);
return;