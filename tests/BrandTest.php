<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            //Store::deleteAll();
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
    }
?>
