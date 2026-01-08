<?php
    class Series {
        private $id;
        private $titulo;
        private $plataformaId;
        private $directorId;
        private $actores;
        private $idiomasAudio;
        private $idiomasSubtitulos;
        private $plataformaNombre;
        private $directorNombre;

        public function __construct($idSeries = null, $tituloSeries = null, $plataformaId = null, $directorId = null, $actoresSeries = null, $idiomasAudioSeries = null, $idiomasSubtitulosSeries = null) {
                $this->id = $idSeries;
                $this->titulo = $tituloSeries;
                $this->plataformaId = $plataformaId;
                $this->directorId = $directorId;
                $this->actores = $actoresSeries;
                $this->idiomasAudio = $idiomasAudioSeries;
                $this->idiomasSubtitulos = $idiomasSubtitulosSeries;
            
           
        }

        public function getId() {
            return $this->id;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function getPlataformaId() {
            return $this->plataformaId;
        }

        public function getDirectorId() {
            return $this->directorId;
        }

        public function getActores() {
            return $this->actores;
        }

        public function getIdiomasAudio() {
            return $this->idiomasAudio;
        }

        public function getIdiomasSubtitulos() {
            return $this->idiomasSubtitulos;
        }
        public function getPlataformaNombre() {
            return $this->plataformaNombre;
        }
        public function getDirectorNombre() {
            return $this->directorNombre;
        }

        public function setId($idSeries) {
            $this->id = $idSeries;
        }

        public function setPlataformaId($plataformaIdSeries) {
            $this->plataformaId = $plataformaIdSeries;
        }

        public function setTitulo($tituloSeries) {
            $this->titulo = $tituloSeries;
        }
        public function setDirectorId($directorIdSeries) {
            $this->directorId = $directorIdSeries;
        }
        public function setActores($actoresSeries) {
            $this->actores = $actoresSeries;
        }
        public function setIdiomasAudio($idiomasAudioSeries) {
            $this->idiomasAudio = $idiomasAudioSeries;
        }
        public function setIdiomasSubtitulos($idiomasSubtitulosSeries) {
            $this->idiomasSubtitulos = $idiomasSubtitulosSeries;
        }
        public function setPlataformaNombre($plataformaNombreSeries) {
            $this->plataformaNombre = $plataformaNombreSeries;
        }
        public function setDirectorNombre($directorNombreSeries) {
            $this->directorNombre = $directorNombreSeries;
        }

        function initConnectionDb() {
            $db_host = "localhost";
            $db_user = "root";
            $db_password = "+-+-";
            $db_db = "04masw";

            $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

            if ($mysqli->connect_error) {
                die("Error: ".$mysqli->connect_error);
            }

            return $mysqli;
        }

        public function getAll() {
            $mysqli = $this->initConnectionDb();

            $query = "SELECT id, titulo, plataformaId, directorId, actores, idiomasAudio, idiomasSubtitulos FROM series";

            $result = $mysqli->query($query);

            $seriesList = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $series = new Series($row['id'], $row['titulo'], $row['plataformaId'], $row['directorId'], $row['actores'], $row['idiomasAudio'], $row['idiomasSubtitulos']);
                    array_push($seriesList, $series);
                }
            }

            $mysqli->close();

            return $seriesList;
        }

        public function getAllDirectorPlatform() {
            $mysqli = $this->initConnectionDb();

            $query = "SELECT series.id,
                             series.titulo, 
                             series.plataformaId, 
                             series.directorId, 
                             series.actores, 
                             series.idiomasAudio, 
                             series.idiomasSubtitulos,
                             plataformas.nombre AS plataformaNombre,
                             directores.nombre AS directorNombre
                      FROM series 
                      JOIN plataformas ON series.plataformaId = plataformas.id
                      JOIN directores ON series.directorId = directores.id";

            $result = $mysqli->query($query);

            $seriesList = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $series = new Series($row['id'], $row['titulo'], $row['plataformaId'], $row['directorId'], $row['actores'], $row['idiomasAudio'], $row['idiomasSubtitulos']);
                    $series->setPlataformaNombre($row['plataformaNombre']);
                    $series->setDirectorNombre($row['directorNombre']);
                    array_push($seriesList, $series);
                }
            }

            $mysqli->close();

            return $seriesList;
        }

        public function store() {
            $success = false;
            
            $mysqli = $this->initConnectionDb();

            $titulo = $this->getTitulo();
            $plataformaId = $this->getPlataformaId();
            $directorId = $this->getDirectorId();
            $actores = $this->getActores();
            $idiomasAudio = $this->getIdiomasAudio();
            $idiomasSubtitulos = $this->getIdiomasSubtitulos();

            // Comprobar que no existe una serie con el mismo titulo
            $exists = $mysqli->query("SELECT 1 FROM series WHERE titulo = '" . $titulo . "' LIMIT 1");

            // Si no existe, crea la serie
            if ($exists && $exists->num_rows === 0) {

                $query = "INSERT INTO series (titulo, plataformaId, directorId, actores, idiomasAudio, idiomasSubtitulos) VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("ssssss", $titulo, $plataformaId, $directorId, $actores, $idiomasAudio, $idiomasSubtitulos);

                $success = $stmt->execute();

                $stmt->close();
             
            }

            $mysqli->close();

            return $success;
        }

        function update() {
            $seriesEdited = false; 
            $mysqli = $this->initConnectionDb();

            $id = (int) $this->id;
            $titulo = $this->getTitulo();
            $plataformaId = $this->getPlataformaId();
            $directorId = $this->getDirectorId();
            $actores = $this->getActores();
            $idiomasAudio = $this->getIdiomasAudio();
            $idiomasSubtitulos = $this->getIdiomasSubtitulos();

            echo $directorId;
            echo "#".$plataformaId."#";

            $sql = "SELECT 1 FROM series WHERE id = " . $id . " LIMIT 1";
            echo $sql;
            // Comprobar que existe la serie
            $exists = $mysqli->query($sql);

            // Si existe, actualiza la serie
            if ($exists && $exists->num_rows === 1) {
                $query = "UPDATE series SET titulo = ?, plataformaId = ?, directorId = ?, actores = ?, idiomasAudio = ?, idiomasSubtitulos = ? WHERE id = " . $id;

                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("ssssss", $titulo, $plataformaId, $directorId, $actores, $idiomasAudio, $idiomasSubtitulos);

                $seriesEdited = $stmt->execute();

                $stmt->close();
                
            }

            $mysqli->close();
            return $seriesEdited;
        }

        public function getItem() {
            $mysqli = $this->initConnectionDb();

            $sql ="SELECT * FROM series WHERE id = " . $this->id;
            
            $query = $mysqli->query($sql);

            foreach ($query as $item) {
                $itemObject = new Series($item['id'], $item['titulo'], $item['plataformaId'], $item['directorId'], $item['actores'], $item['idiomasAudio'], $item['IdiomasSubtitulos']);
                break;
            }
            $mysqli->close();
            return $itemObject;
        }

        function delete() {
            $seriesDeleted = false;
            $mysqli = $this->initConnectionDb();

            $id = (int) $this->id;
            // Comprobar que existe la serie
            $exists = $mysqli->query("SELECT 1 FROM series WHERE id = " . $id . " LIMIT 1");

            // Si existe, borra la serie
            if ($exists && $exists->num_rows === 1) {
                if ($query = $mysqli->query("DELETE FROM series WHERE id = " . $id)) {
                    $seriesDeleted = true;
                }
            }
            $mysqli->close();

            return $seriesDeleted;
        }

    }


?>
