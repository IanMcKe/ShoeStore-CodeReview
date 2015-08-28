<?php
    class Brand
    {
        private $name;
        private $logo_path;
        private $id;

        function __construct($name, $logo_path, $id)
        {
            $this->name = $name;
            $this->logo_path = $logo_path;
            $this->id = $id;
        }
    }
?>
