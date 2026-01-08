<?php
    require_once __DIR__ . '/../config/database.php';

    class Actor {
        private $id;
        private $name;
        private $surnames;
        private $birthDate;
        private $nationality;

        public function __construct($idActor = null, $nameActor = null, $surnamesActor = null, $birthDateActor = null, $nationalityActor = null) {
            if (!is_null(value: $idActor)) {
                $this->id = $idActor;
            }
            if (!is_null(value: $nameActor)) {
                $this->name = $nameActor;
            }
            if (!is_null(value: $surnamesActor)) {
                $this->surnames = $surnamesActor;
            }
            if (!is_null(value: $birthDateActor)) {
                $this->birthDate = $birthDateActor;
            }
            if (!is_null(value: $nationalityActor)) {
                $this->nationality = $nationalityActor;
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
         * @return mixed
         */
        public function getSurnames() {
            return $this->surnames;
        }

        /**
         * @return mixed $surnames
         */
        public function setSurnames($surnames) {
            $this->surnames = $surnames;
        }

        /**
         * @return mixed
         */
        public function getBirthDate() {
            return $this->birthDate;
        }

        /**
         * @return mixed $birthDate
         */
        public function setBirthDate($birthDate) {
            $this->birthDate = $birthDate;
        }

        /**
         * @return mixed
         */
        public function getNationality() {
            return $this->nationality;
        }

        /**
         * @return mixed $nationality
         */
        public function setNationality($nationality) {
            $this->nationality = $nationality;
        }

        /**
         * @return array
         */
        function getAll() {
            $mysqli = Database::getConnection();
            $query = $mysqli->query("SELECT * FROM actores");
            $listData = [];

            foreach ($query as $item) {
                $itemObject = new Actor($item['id'], $item['nombre'], $item['apellidos'], $item['fechaNacimiento'], $item['nacionalidad']);
                array_push($listData, $itemObject);
            }

            $mysqli->close();

            return $listData;
        }

        /**
         * @return bool
         */
        function store() {
            $actorCreated = false;
            $mysqli = Database::getConnection();

            $name = $mysqli->real_escape_string($this->name);
            $surnames = $mysqli->real_escape_string($this->surnames);
            $birthDate = $mysqli->real_escape_string($this->birthDate);
            $nationality = $mysqli->real_escape_string($this->nationality);

            // Comprobar que no existe un actor con los mismos datos
            $exists = $mysqli->query("SELECT 1 FROM actores WHERE nombre = '" . $name . "' AND apellidos = '" . $surnames . "' AND fechaNacimiento = '" . $birthDate . "' AND nacionalidad = '" . $nationality . "' LIMIT 1");

            // Si no existe, crea el actor
            if ($exists && $exists->num_rows === 0) {
                if ($resultInsert = $mysqli->query("INSERT INTO actores (nombre, apellidos, fechaNacimiento, nacionalidad) VALUES ('" . $name . "', '" . $surnames . "', '" . $birthDate . "', '" . $nationality . "')")) {
                    $actorCreated = true;
                }
            }

            $mysqli->close();

            return $actorCreated;
        }

        /**
         * @return bool
         */
        function update() {
            $actorEdited = false;
            $mysqli = Database::getConnection();

            $id = (int) $this->id;
            $name = $mysqli->real_escape_string($this->name);
            $surnames = $mysqli->real_escape_string($this->surnames);
            $birthDate = $mysqli->real_escape_string($this->birthDate);
            $nationality = $mysqli->real_escape_string($this->nationality);

            // Comprobar que existe el actor
            $exists = $mysqli->query("SELECT 1 FROM actores WHERE id = " . $id . " LIMIT 1");

            // Si existe, actualiza el actor
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("UPDATE actores SET nombre = '" . $name . "', apellidos = '" . $surnames . "', fechaNacimiento = '" . $birthDate . "', nacionalidad = '" . $nationality . "' WHERE id = " . $id)) {
                    $actorEdited = true;
                }
            }

            $mysqli->close();

            return $actorEdited;
        }

        public function getItem() {
            $mysqli = Database::getConnection();
            $query = $mysqli->query("SELECT * FROM actores WHERE id = " . $this->id);

            foreach ($query as $item) {
                $itemObject = new Actor($item['id'], $item['nombre'], $item['apellidos'], $item['fechaNacimiento'], $item['nacionalidad']);
                break;
            }

            $mysqli->close();
            return $itemObject;
        }

        /**
         * @return bool
         */
        function delete() {
            $actorDeleted = false;
            $mysqli = Database::getConnection();

            $id = (int) $this->id;
            // Comprobar que existe el actor
            $exists = $mysqli->query("SELECT 1 FROM actores WHERE id = " . $id . " LIMIT 1");

            // Si existe, borra el actor
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("DELETE FROM actores WHERE id = " . $id)) {
                    $actorDeleted = true;
                }
            }

            $mysqli->close();

            return $actorDeleted;
        }
    }
?>