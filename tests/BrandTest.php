<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);

            $result = $test_brand->getName();

            $this->assertEquals($name, $result);
        }

        function test_getLogoPath()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);

            $result = $test_brand->getLogoPath();

            $this->assertEquals($logo_path, $result);
        }

        function test_getId()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $id = 1;
            $test_brand = new Brand($name, $logo_path, $id);

            $result = $test_brand->getId();

            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);
            $test_brand->save();

            $result = Brand::getAll();

            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);
            $test_brand->save();

            $name2 = "Adodas";
            $logo_path2 = "img/adodas.jpg";
            $test_brand2 = new Brand($name2, $logo_path2);
            $test_brand2->save();

            $result = Brand::getAll();

            $this->assertEquals([$test_brand2, $test_brand], $result);
        }

        function test_deleteAll()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);
            $test_brand->save();

            $name2 = "Adodas";
            $logo_path2 = "img/adodas.jpg";
            $test_brand2 = new Brand($name2, $logo_path2);
            $test_brand2->save();

            Brand::deleteAll();
            $result = Brand::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);
            $test_brand->save();

            $name2 = "Adodas";
            $logo_path2 = "img/adodas.jpg";
            $test_brand2 = new Brand($name2, $logo_path2);
            $test_brand2->save();

            $result = Brand::find($test_brand->getId());

            $this->assertEquals($test_brand, $result);
        }

        function test_addStore()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);
            $test_store->save();

            $name2 = "Foot Traffic";
            $location2 = "333 SW Taylor St, Portland, OR 97204";
            $hours2 = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone2 = "(503) 525-1243";
            $website2 = "http://foottraffic.us/";
            $test_store2 = new Store($name2, $location2, $hours2, $phone2, $website2);
            $test_store2->save();

            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);
            $test_brand->save();

            $name2 = "Adodas";
            $logo_path2 = "img/adodas.jpg";
            $test_brand2 = new Brand($name2, $logo_path2);
            $test_brand2->save();

            $test_brand->addStore($test_store);
            $result = $test_brand->getStores();

            $this->assertEquals([$test_store], $result);
        }

        function test_getStores()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);
            $test_store->save();

            $name2 = "Foot Traffic";
            $location2 = "333 SW Taylor St, Portland, OR 97204";
            $hours2 = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone2 = "(503) 525-1243";
            $website2 = "http://foottraffic.us/";
            $test_store2 = new Store($name2, $location2, $hours2, $phone2, $website2);
            $test_store2->save();

            $name = "Nikeh";
            $logo_path = "img/nikeh.jpg";
            $test_brand = new Brand($name, $logo_path);
            $test_brand->save();

            $name2 = "Adodas";
            $logo_path2 = "img/adodas.jpg";
            $test_brand2 = new Brand($name2, $logo_path2);
            $test_brand2->save();

            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            $result = $test_brand->getStores();

            $this->assertEquals([$test_store, $test_store2], $result);
        }
    }
?>
