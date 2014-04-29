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
