<?php
    class Store
    {
        private $name;
        private $location;
        private $hours;
        private $phone;
        private $website;
        private $id;

        function __construct($name, $location, $hours, $phone, $website, $id=null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->hours = $hours;
            $this->phone = $phone;
            $this->website = $website;
            $this->id = $id;
        }

        //setters
        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function setHours($new_hours)
        {
            $this->hours = $new_hours;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function setWebsite($new_website)
        {
            $this->website = $new_website;
        }

        //getters
        function getName()
        {
            return $this->name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getHours()
        {
            return $this->hours;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getWebsite()
        {
            return $this->website;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, location, hours, phone, website)
                VALUES ('{$this->getName()}', '{$this->getLocation()}', '{$this->getHours()}', '{$this->getPhone()}', '{$this->getWebsite()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_name, $new_location, $new_hours, $new_phone, $new_website)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE stores SET location = '{$new_location}' WHERE id={$this->getId()};");
            $this->setLocation($new_location);
            $GLOBALS['DB']->exec("UPDATE stores SET hours = '{$new_hours}' WHERE id={$this->getId()};");
            $this->setHours($new_hours);
            $GLOBALS['DB']->exec("UPDATE stores SET phone = '{$new_phone}' WHERE id={$this->getId()};");
            $this->setPhone($new_phone);
            $GLOBALS['DB']->exec("UPDATE stores SET website = '{$new_website}' WHERE id={$this->getId()};");
            $this->setWebsite($new_website);
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store){
                $id = $store->getId();
                if($id == $search_id){
                    $found_store = $store;
                }
            }
            return $found_store;
        }
    }
?>
