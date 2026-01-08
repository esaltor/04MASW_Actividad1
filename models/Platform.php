<?php
    require_once __DIR__ . '/../config/database.php';

    class Platform {
        private $id;
        private $name;

        public function __construct($idPlatform = null, $namePlatform = null) {
            if (!is_null(value: $idPlatform)) {
                $this->id = $idPlatform;
            }
            if (!is_null(value: $namePlatform)) {
                $this->name = $namePlatform;
            }
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
         * @return array
         */
        function getAll() {
            $mysqli = Database::getConnection();
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
            $mysqli = Database::getConnection();
            
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
            $mysqli = Database::getConnection();

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
            $mysqli = Database::getConnection();
            $query = $mysqli->query("SELECT * FROM plataformas WHERE id = " . $this->id);

            foreach ($query as $item) {
                $itemObject = new Platform($item['id'], $item['nombre']);
                break;
            }
            $mysqli->close();
            return $itemObject;
        }

        function delete() {
            $mysqli = Database::getConnection();
            $id = (int) $this->id;

            // Comprobar si existe
            $exists = $mysqli->query("SELECT 1 FROM plataformas WHERE id = " . $id);
            if (!$exists || $exists->num_rows === 0) {
                $mysqli->close();
                return 'not_found';
            }

            // Comprobar si tiene series asociadas
            $hasSeries = $mysqli->query(
                "SELECT 1 FROM series WHERE plataformaId = " . $id . " LIMIT 1"
            );

            if ($hasSeries && $hasSeries->num_rows > 0) {
                $mysqli->close();
                return 'has_series';
            }

            // Borrar plataforma
            if ($mysqli->query("DELETE FROM plataformas WHERE id = " . $id)) {
                $mysqli->close();
                return 'deleted';
            }

            $mysqli->close();
            return 'error';
        }
    }
?>
