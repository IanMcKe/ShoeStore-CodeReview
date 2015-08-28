<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    // require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            // Brand::deleteAll();
        }

        function test_getName()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);

            $result = $test_store->getName();

            $this->assertEquals($name, $result);
        }
    }
?>