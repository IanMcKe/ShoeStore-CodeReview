<?php
    class Store
    {
        private $name;
        private $location;
        private $hours;
        private $phone;
        private $website;
        private $id;

        function __construct($name=null, $location=null, $hours=null, $phone=null, $website=null, $id=null)
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
    }
?>