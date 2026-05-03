<?php

class GestorPDO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    //  USUARIOS 
    public function registrarUsuario(Usuario $usuario)
    {
        try {
            $sql = "INSERT INTO USUARIOS (nombre, email, contraseña, rol) VALUES (:nombre, :email, :pass, :rol)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':nombre', $usuario->getNombre());
            $stmt->bindValue(':email',  $usuario->getEmail());
            $stmt->bindValue(':pass',   $usuario->getPassword());
            $stmt->bindValue(':rol',    $usuario->getRol());
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function buscarUsuarioPorEmail($email)
    {
        $sql = "SELECT * FROM USUARIOS WHERE email = :email";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new Usuario(
                $fila['Id_usuario'],
                $fila['nombre'],
                $fila['email'],
                $fila['contraseña'],
                $fila['rol']
            );
        }
        return null;
    }

    //  DESTINOS 
    public function listarDestinos()
    {
        $sql  = "SELECT * FROM DESTINOS";
        $rtdo = $this->getConn()->query($sql);
        $arrayDestinos = [];

        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $arrayDestinos[] = new Destino(
                $fila['Id_Destinos'],
                $fila['nombre'],
                $fila['país'],
                $fila['continente'],
                $fila['descripción'],
            );
        }
        return $arrayDestinos;
    }
    public function insertarDestinoDirecto($nombre, $pais, $continente, $descripcion)
    {
        try {
            $sql = "INSERT INTO DESTINOS (nombre, país, continente, descripción) 
                VALUES (:nombre, :pais, :continente, :descripcion)";

            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':nombre',      $nombre);
            $stmt->bindValue(':pais',        $pais);
            $stmt->bindValue(':continente',  $continente);
            $stmt->bindValue(':descripcion', $descripcion);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // --- GUIAS 
    public function crearGuia(Guia $guia)
    {
        try {
            $this->getConn()->beginTransaction();
            $sql = "INSERT INTO GUIAS (destinos_id, usuario_id, Titulo, Comentario) 
                    VALUES (:destinos_id, :usuario_id, :titulo, :comentario)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':destinos_id', $guia->getDestinoId());
            $stmt->bindValue(':usuario_id',  $guia->getUsuarioId());
            $stmt->bindValue(':titulo',      $guia->getTitulo());
            $stmt->bindValue(':comentario',  $guia->getComentarioGuia());
            $stmt->execute();

            $idGuia = $this->getConn()->lastInsertId();

            if ($guia instanceof GuiaGastronomica) {
                $sql2 = "INSERT INTO GUIA_GASTRONOMICA (Id_guias, precio_medio, tipo_cocina) VALUES (:id, :precio, :tipo)";
                $stmt2 = $this->getConn()->prepare($sql2);
                $stmt2->bindValue(':id',     $idGuia);
                $stmt2->bindValue(':precio', $guia->getPrecioMedio());
                $stmt2->bindValue(':tipo',   $guia->getTipoComida());
                $stmt2->execute();
            } else if ($guia instanceof GuiaRuta) {
                $sql2 = "INSERT INTO GUIA_RUTA (Id_guias, distancia_km, Dificultad) VALUES (:id, :distancia, :dificultad)";
                $stmt2 = $this->getConn()->prepare($sql2);
                $stmt2->bindValue(':id',         $idGuia);
                $stmt2->bindValue(':distancia',  $guia->getDistanciaKm());
                $stmt2->bindValue(':dificultad', $guia->getDificultad());
                $stmt2->execute();
            }
            $this->getConn()->commit();
            return true;
        } catch (PDOException $e) {
            $this->getConn()->rollBack();
            die("Error en crearGuia: " . $e->getMessage());
        }
    }

    public function listarGuias()
    {
        try {
            $sql = "SELECT GUIAS.*, DESTINOS.nombre AS nombre_destino 
                FROM GUIAS 
                INNER JOIN DESTINOS ON GUIAS.destinos_id = DESTINOS.Id_Destinos";

            $rtdo = $this->getConn()->query($sql);
            $guias = [];

            while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
                $guias[] = $fila;
            }
            return $guias;
        } catch (PDOException $e) {
            error_log("Error en listarGuias: " . $e->getMessage());
            return [];
        }
    }

    public function listarGuiasGastronomicas()
    {
        $sql = "SELECT GUIAS.*, DESTINOS.nombre AS nombre_destino 
                FROM GUIAS 
                INNER JOIN DESTINOS ON GUIAS.destinos_id = DESTINOS.Id_Destinos
                INNER JOIN GUIA_GASTRONOMICA ON GUIAS.Id_guias = GUIA_GASTRONOMICA.Id_guias";

        $rtdo = $this->getConn()->query($sql);
        $guias = [];
        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $guias[] = $fila;
        }
        return $guias;
    }

    public function listarGuiasRutas()
    {
        $sql = "SELECT GUIAS.*, DESTINOS.nombre AS nombre_destino 
                FROM GUIAS 
                INNER JOIN DESTINOS ON GUIAS.destinos_id = DESTINOS.Id_Destinos
                INNER JOIN GUIA_RUTA ON GUIAS.Id_guias = GUIA_RUTA.Id_guias";

        $rtdo = $this->getConn()->query($sql);
        $guias = [];
        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $guias[] = $fila;
        }
        return $guias;
    }

    // RESEÑAS
    public function listarReseñas()
    {
        try {
            $sql = "SELECT RESEÑAS.*, 
                           USUARIOS.nombre AS autor_nombre,
                           DESTINOS.nombre AS nombre_destino
                    FROM RESEÑAS 
                    INNER JOIN USUARIOS ON RESEÑAS.usuario_id = USUARIOS.Id_usuario
                    INNER JOIN DESTINOS ON RESEÑAS.destinos_id = DESTINOS.Id_Destinos";

            $rtdo = $this->getConn()->query($sql);
            $reseñas = [];

            while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
                $reseñas[] = $fila;
            }
            return $reseñas;
        } catch (PDOException $e) {
            error_log("Error en listarReseñas: " . $e->getMessage());
            return [];
        }
    }
    public function insertarReseña($destino_id, $usuario_id, $comentario, $valoracion)
    {
        try {
            $sql = "INSERT INTO RESEÑAS (destinos_id, usuario_id, Comentarios, Valoración) 
                VALUES (:dest_id, :user_id, :comen, :val)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':dest_id', $destino_id);
            $stmt->bindValue(':user_id', $usuario_id);
            $stmt->bindValue(':comen',   $comentario);
            $stmt->bindValue(':val',      $valoracion);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    //  FUNCIONES PARA ADMIN: DESTINOS 
    public function eliminarDestino($id)
    {
        $sql = "DELETE FROM DESTINOS WHERE Id_Destinos = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function obtenerDestinoPorId($id)
    {
        $sql = "SELECT * FROM DESTINOS WHERE Id_Destinos = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modificarDestino($id, $nombre, $pais, $continente, $descripcion)
    {
        $sql = "UPDATE DESTINOS SET nombre = :nom, país = :pais, continente = :cont, descripción = :desc WHERE Id_Destinos = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':nom', $nombre);
        $stmt->bindValue(':pais', $pais);
        $stmt->bindValue(':cont', $continente);
        $stmt->bindValue(':desc', $descripcion);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    //  FUNCIONES PARA ADMIN: GUÍAS 
    public function eliminarGuia($id)
    {
        $sql = "DELETE FROM GUIAS WHERE Id_guias = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function obtenerGuiaPorId($id)
    {
        $sql = "SELECT * FROM GUIAS WHERE Id_guias = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modificarGuia($id, $titulo, $comentario)
    {
        $sql = "UPDATE GUIAS SET Titulo = :tit, Comentario = :com WHERE Id_guias = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':tit', $titulo);
        $stmt->bindValue(':com', $comentario);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    //  FUNCIONES PARA ADMIN: RESEÑAS
    public function obtenerReseñaPorId($id)
    {
        $sql = "SELECT * FROM RESEÑAS WHERE Id_reseñas = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modificarReseña($id, $comentario, $valoracion)
    {
        $sql = "UPDATE RESEÑAS SET Comentarios = :com, Valoración = :val WHERE Id_reseñas = :id";
        $stmt = $this->getConn()->prepare($sql);

        // Forzamos el tipo de dato para evitar problemas
        $stmt->bindValue(':com', $comentario);
        $stmt->bindValue(':val', $valoracion, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $exito = $stmt->execute();
    }

    public function eliminarReseña($id)
    {
        $sql = "DELETE FROM RESEÑAS WHERE Id_reseñas = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
