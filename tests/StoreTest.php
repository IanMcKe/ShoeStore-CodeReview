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

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
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

        function test_getLocation()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);

            $result = $test_store->getLocation();

            $this->assertEquals($location, $result);
        }

        function test_getHours()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);

            $result = $test_store->getHours();

            $this->assertEquals($hours, $result);
        }

        function test_getPhone()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);

            $result = $test_store->getPhone();

            $this->assertEquals($phone, $result);
        }

        function test_getWebsite()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);

            $result = $test_store->getWebsite();

            $this->assertEquals($website, $result);
        }

        function test_getId()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $id = 1;
            $test_store = new Store($name, $location, $hours, $phone, $website, $id);

            $result = $test_store->getId();

            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            $name = "Keen Garage";
            $location = "505 NW 13th Ave, Portland, OR 97209";
            $hours = "MTWHF 10:00am - 7:00pm, Sat 10:00am - 6:00pm, Sun 11:00am - 5:00pm";
            $phone = "(971) 200-4040";
            $website = "http://www.keenfootwear.com/";
            $test_store = new Store($name, $location, $hours, $phone, $website);
            $test_store->save();

            $result = Store::getAll();

            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
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

            $result = Store::getAll();

            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteAll()
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

            Store::deleteAll();
            $result = Store::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
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

            $result = Store::find($test_store->getId());

            $this->assertEquals($test_store, $result);
        }

        function test_update()
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
            $id = $test_store->getId();

            $test_store->update($name2, $location2, $hours2, $phone2, $website2);
            $result = new Store($name2, $location2, $hours2, $phone2, $website2, $id);

            $this->assertEquals($test_store, $result);
        }

        function test_delete()
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

            $test_store->delete();
            $result = Store::getAll();

            $this->assertEquals([$test_store2], $result);
        }
    }
?>
