<?php
    require_once __DIR__ . '/../config/database.php';

    class Director {
        private $id;
        private $name;
        private $surnames;
        private $birthdate;
        private $nationality;

        public function __construct($idDirector = null, $nameDirector = null, $surnamesDirector = null, $birthdateDirector = null, $nationalityDirector = null) {
            if (!is_null(value: $idDirector)) {
                $this->id = $idDirector;
            }

            if (!is_null(value: $nameDirector)) {
                $this->name = $nameDirector;
            }

            if (!is_null(value: $surnamesDirector)) {
                $this->surnames = $surnamesDirector;
            }

            if (!is_null(value: $birthdateDirector)) {
                $this->birthdate = $birthdateDirector; 
            }

            if (!is_null(value: $nationalityDirector)) {
                $this->nationality = $nationalityDirector;
            } 
        }

        /**
         * @return mixed
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @param mixed $id
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
         * @param mixed $name
         */
        public function setName($name) {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getSurnames() {
            return $this->surnames;
        }

        /**
         * @param mixed $surnames
         */
        public function setSurnames($surnames) {
            $this->surnames = $surnames;
        }

        /**
         * @return mixed
         */
        public function getBirthdate() {
            return $this->birthdate;
        }

        /**
         * @param mixed $birthdate
         */
        public function setBirthdate($birthdate) {
            $this->birthdate = $birthdate;
        }

        /**
         * @return mixed
         */
        public function getNationality() {
            return $this->nationality;
        }

        /**
         * @param mixed $nationality
         */
        public function setNationality($nationality) {
            $this->nationality = $nationality;
        }

        /**
         * @return array
         */
        function getAll() {
            $mysqli = Database::getConnection();
            $query = $mysqli->query("SELECT * FROM directores");
            $listData = [];
            if (!$query) {
                die("Error SQL: " . $mysqli->error);
            }
            
            foreach ($query as $item) {
                $itemObject = new Director($item['id'], $item['nombre'], $item['apellidos'], $item['fechaNacimiento'], $item['nacionalidad']);
                array_push($listData, $itemObject);
            }

            $mysqli->close();

            return $listData;
        }

        function store() {
            $directorCreated = false;
            $mysqli = Database::getConnection();
            
            $name = $mysqli->real_escape_string($this->name);
            $surnames = $mysqli->real_escape_string($this->surnames);
            $birthdate = $mysqli->real_escape_string($this->birthdate);
            $nationality = $mysqli->real_escape_string($this->nationality);

            // Comprobar que no existe un director con el mismo nombre y apellidos
            $exists = $mysqli->query("SELECT 1 FROM directores WHERE nombre = '" . $name . "' AND apellidos = '" . $surnames . "' LIMIT 1");

            // Si no existe, crea el director
            if ($exists && $exists->num_rows === 0) {
                if ($resultInsert = $mysqli->query("INSERT INTO directores (nombre, apellidos, fechaNacimiento, nacionalidad) VALUES ('" . $name . "', '" . $surnames . "', '" . $birthdate . "', '" . $nationality  . "')")) {
                    $directorCreated = true;
                }
            }
            $mysqli->close();

            return $directorCreated;
        }

        function update() {
            $directorEdited = false; 
            $mysqli = Database::getConnection();

            $id = (int) $this->id;
            $name = $mysqli->real_escape_string($this->name);
            $surnames = $mysqli->real_escape_string($this->surnames);
            $birthdate = $mysqli->real_escape_string($this->birthdate);
            $nationality = $mysqli->real_escape_string($this->nationality);

            // Comprobar que existe el director
            $exists = $mysqli->query("SELECT * FROM directores WHERE id = " . $id . " LIMIT 1");

            // Si existe, actualiza el director
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("UPDATE directores SET nombre = '" . $name . "', apellidos = '" . $surnames . "', fechaNacimiento = '" . $birthdate  . "', nacionalidad = '" . $nationality . "' WHERE id = " . $id)) {
                    $directorEdited = true;
                }
            }

            $mysqli->close();
            return $directorEdited;
        }

        public function getItem() {
            $mysqli = Database::getConnection();
            $query = $mysqli->query(
                "SELECT * FROM directores WHERE id = " . (int)$this->id
            );

            $itemObject = null;

            if ($query && $query->num_rows === 1) {
                $item = $query->fetch_assoc();
                $itemObject = new Director(
                    $item['id'],
                    $item['nombre'],
                    $item['apellidos'],
                    $item['fechaNacimiento'],
                    $item['nacionalidad']
                );
            }

            $mysqli->close();
            return $itemObject;
        }

        /**
         * @return string
         */
        function delete() {
            $mysqli = Database::getConnection();
            $id = (int) $this->id;

            // Comprobar si existe
            $exists = $mysqli->query("SELECT 1 FROM directores WHERE id = " . $id);
            if (!$exists || $exists->num_rows === 0) {
                $mysqli->close();
                return 'not_found';
            }

            // Comprobar si tiene series asociadas
            $hasSeries = $mysqli->query(
                "SELECT 1 FROM series WHERE directorId = " . $id . " LIMIT 1"
            );

            if ($hasSeries && $hasSeries->num_rows > 0) {
                $mysqli->close();
                return 'has_series';
            }

            // Borrar director
            if ($mysqli->query("DELETE FROM directores WHERE id = " . $id)) {
                $mysqli->close();
                return 'deleted';
            }

            $mysqli->close();
            return 'error';
        }
    }
?>
