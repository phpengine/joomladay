<?php

$bootStrap = new bootStrapForTests();
$bootStrap->launch();

function bsAutoLoad($className) {
    $classNameForLoad = str_replace('\\' , '/', $className);
    $filename = dirname(__FILE__) .  '/' . $classNameForLoad.'.php';
    $filename = str_replace("build/tests/phpunit/", "src/", $filename);
    if (is_readable($filename)) require_once $filename;
}

class bootStrapForTests {

    public function launch() {
        spl_autoload_register('bsAutoLoad');
    }

    public static function getMysqlI() {

        $dbHost = "127.0.0.1" ;
        $dbUser = "pmpctestuser" ;
        $dbPass = "pmpctestpass" ;
        $dbName = "pmpctestdb" ;

        try {
            $mysqli = new \mysqli($dbHost, $dbUser, $dbPass, $dbName);
            if ($mysqli instanceof \mysqli) {
                return $mysqli; }
            throw new Exception("You need to configure the database for all tests to execute."); }
        catch (\Exception $e) {
            echo 'DB Exception During Testing: Wrong Test Config Details'."\n";
            echo 'Message: ' .$e->getMessage(); }
    }

}