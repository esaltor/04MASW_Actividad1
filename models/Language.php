<?php
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../models/Series.php';

    class Language {
        private $id;
        private $nombre;
        private $isoCode;

        public function __construct($idLanguage = null, $nombreLanguage = null, $isoCode = null) {
            if (!is_null($idLanguage)) {
                $this->id = $idLanguage;
            }

            if (!is_null($nombreLanguage)) {
                $this->nombre = $nombreLanguage;
            }

            if (!is_null($isoCode)) {
                $this->isoCode = $isoCode;
            }
        }

        public function getId() {
            return $this->id;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getIsoCode() {
            return $this->isoCode;
        }

        public function setId($idLanguage) {
            $this->id = $idLanguage;
        }

        public function setIsoCode($isoCode) {
            $this->isoCode = $isoCode;
        }

        public function setNombre($nombreLanguage) {
            $this->nombre = $nombreLanguage;
        }

        public function getAll() {
            $mysqli = Database::getConnection();

            $query = "SELECT id, nombre, isoCode  FROM idiomas";

            $result = $mysqli->query($query);

            $languageList = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $language = new Language($row['id'], $row['nombre'], $row['isoCode']);
                    array_push($languageList, $language);
                }
            }

            $mysqli->close();

            return $languageList;
        }

        public function store() {
            $success = false;
            
            $mysqli = Database::getConnection();

            $nombre = $this->getNombre();
            $isoCode = $this->getIsoCode();

            // Comprobar que no existe una plataforma con el mismo nombre
            $exists = $mysqli->query("SELECT 1 FROM idiomas WHERE nombre = '" . $nombre . "' LIMIT 1");

            // Si no existe, crea la plataforma
            if ($exists && $exists->num_rows === 0) {

                $query = "INSERT INTO idiomas (nombre, isoCode) VALUES (?, ?)";

                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("ss", $nombre, $isoCode);

                $success = $stmt->execute();

                $stmt->close();
            }

            $mysqli->close();

            return $success;
        }

        function update() {
            $languageEdited = false; 
            $mysqli = Database::getConnection();

            $id = (int) $this->id;
            $nombre = $mysqli->real_escape_string($this->nombre);
            $isoCode  = $mysqli->real_escape_string($this->isoCode);
            // Comprobar que existe el idioma
            $exists = $mysqli->query("SELECT 1 FROM idiomas WHERE id = " . $id . " LIMIT 1");

            // Si existe, actualiza el idioma
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("UPDATE idiomas SET nombre = '" . $nombre . "', isoCode = '" . $isoCode . "' WHERE id = " . $id)) {
                    $languageEdited = true; 
                }
            }

            $mysqli->close();
            return $languageEdited;
        }

        public function getItem() {
            $mysqli = Database::getConnection();

            $sql ="SELECT * FROM idiomas WHERE id = " . $this->id;

            $query = $mysqli->query($sql);

            foreach ($query as $item) {
                $itemObject = new Language($item['id'], $item['nombre'], $item['isoCode']);
                break;
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

            // Comprobar que existe el idioma
            $exists = $mysqli->query("SELECT isoCode FROM idiomas WHERE id = " . $id);
            if (!$exists || $exists->num_rows === 0) {
                $mysqli->close();
                return 'not_found';
            }

            // Codigo del idioma
            $languageData = $exists->fetch_assoc();
            $code = $languageData['isoCode'];

            // Borrar idioma
            if ($mysqli->query("DELETE FROM idiomas WHERE id = " . $id)) {
                // Si tiene series asociadas se elimina del listado de idiomasAudio y/o idiomasSubtitulos el seleccionado
                Series::deleteLanguageFromAllSeries($code);

                $mysqli->close();
                return 'deleted';
            }

            $mysqli->close();
            return 'error';
        }

    }


?>
