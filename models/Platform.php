<?php
    class Platform {
        private $id;
        private $name;

        public function __construct($idPlatform = null, $namePlatform = null) {
            $this->id = $idPlatform;
            $this->name = $namePlatform;
        }

        /**
         * @return mixed
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @return mixed $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return mixed $name
         */
        public function setName($name) {
            $this->name = $name;
        }

        /**
         * @return mysqli
         */
        function initConnectionDb() {
            $db_host = "localhost";
            $db_user = "root";
            $db_password = "";
            $db_db = "04masw";

            $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

            if ($mysqli->connect_error) {
                die("Error: ".$mysqli->connect_error);
            }

            return $mysqli;
        }

        /**
         * @return array
         */
        function getAll() {
            $mysqli = $this->initConnectionDb();
            $query = $mysqli->query("SELECT * FROM plataformas");
            $listData = [];
            
            foreach ($query as $item) {
                $itemObject = new Platform($item['id'], $item['nombre']);
                array_push($listData, $itemObject);
            }

            $mysqli->close();

            return $listData;
        }

        function store() {
            $platformCreated = false;
            $mysqli = $this->initConnectionDb();
            
            $name = $mysqli->real_escape_string($this->name);
            // Comprobar que no existe una plataforma con el mismo nombre
            $exists = $mysqli->query("SELECT 1 FROM plataformas WHERE nombre = '" . $name . "' LIMIT 1");

            // Si no existe, crea la plataforma
            if ($exists && $exists->num_rows === 0) {
                if ($resultInsert = $mysqli->query("INSERT INTO plataformas (nombre) VALUES ('" . $name . "')")) {
                    $platformCreated = true;
                }
            }
            $mysqli->close();

            return $platformCreated;
        }

        function update() {
            $platformEdited = false; 
            $mysqli = $this->initConnectionDb();

            $id = (int) $this->id;
            $name = $mysqli->real_escape_string($this->name);
            // Comprobar que existe la plataforma
            $exists = $mysqli->query("SELECT 1 FROM plataformas WHERE id = " . $id . " LIMIT 1");

            // Si existe, actualiza la plataforma
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("UPDATE plataformas SET nombre = '" . $name . "' WHERE id = " . $id)) {
                    $platformEdited = true;
                }
            }

            $mysqli->close();
            return $platformEdited;
        }

        public function getItem() {
            $mysqli = $this->initConnectionDb();
            $query = $mysqli->query("SELECT * FROM plataformas WHERE id = " . $this->id);

            foreach ($query as $item) {
                $itemObject = new Platform($item['id'], $item['nombre']);
                break;
            }
            $mysqli->close();
            return $itemObject;
        }

        function delete() {
            $platformDeleted = false;
            $mysqli = $this->initConnectionDb();

            $id = (int) $this->id;
            // Comprobar que existe la plataforma
            $exists = $mysqli->query("SELECT 1 FROM plataformas WHERE id = " . $id . " LIMIT 1");

            // Si existe, borra la plataforma
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("DELETE FROM plataformas WHERE id = " . $id)) {
                    $platformDeleted = true;
                }
            }
            $mysqli->close();

            return $platformDeleted;
        }
    }
?>
