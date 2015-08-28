<?php
    class Brand
    {
        private $name;
        private $logo_path;
        private $id;

        function __construct($name, $logo_path="mdi-device-now-wallpaper", $id=null)
        {
            $this->name = $name;
            $this->logo_path = $logo_path;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setLogoPath($new_logo_path)
        {
            $this->logo_path = $new_logo_path;
        }

        function getName()
        {
            return $this->name;
        }

        function getLogoPath()
        {
            return $this->logo_path;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name, logo_path) VALUES ('{$this->getName()}', '{$this->getLogoPath()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands ORDER BY name;");
            $brands = array();
            foreach($returned_brands as $brand){
                $name = $brand['name'];
                $logo_path = $brand['logo_path'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $logo_path, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand){
                $id = $brand->getId();
                if($id == $search_id){
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM
                brands JOIN stores_brands ON (brands.id = stores_brands.brand_id)
                       JOIN stores ON (stores_brands.store_id = stores.id)
                       WHERE brands.id = {$this->getId()};");
            $returned_stores = $query->fetchAll(PDO::FETCH_ASSOC);
            $stores = array();
            foreach($returned_stores as $store){
                $name = $store['name'];
                $location = $store['location'];
                $hours = $store['hours'];
                $phone = $store['phone'];
                $website = $store['website'];
                $id = $store['id'];
                $new_store = new Store($name, $location, $hours, $phone, $website, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
    }
?>
