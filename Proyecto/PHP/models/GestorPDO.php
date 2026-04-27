<?php
 
class GestorPDO extends Connection {
 
    public function __construct() {
        parent::__construct();
    }
 
    // =====================
    // USUARIOS
    // =====================
 
    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO USUARIOS (nombre, email, contraseña, rol) 
                    VALUES (:nombre, :email, :contrasena, :rol)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':nombre',     $usuario->getNombre());
            $stmt->bindValue(':email',      $usuario->getEmail());
            $stmt->bindValue(':contrasena', $usuario->getPassword());
            $stmt->bindValue(':rol',        $usuario->getRol());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
 
    public function buscarUsuarioPorEmail($email) {
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
 
    // =====================
    // DESTINOS
    // =====================
 
    public function listarDestinos() {
        $sql  = "SELECT * FROM DESTINOS";
        $rtdo = $this->getConn()->query($sql);
        $arrayDestinos = [];
 
        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $arrayDestinos[] = new Destinos(
                $fila['Id_Destinos'],
                $fila['nombre'],
                $fila['país'],
                $fila['continente'],
                $fila['descripción'],
                $fila['imagen'],
                $fila['numero_visitas']
            );
        }
        return $arrayDestinos;
    }
 
    // =====================
    // GUIAS
    // =====================
 
    public function crearGuia(Guia $guia) {
        try {
            $this->getConn()->beginTransaction();
 
            // 1. Insertar en GUIAS
            $sql = "INSERT INTO GUIAS (destinos_id, usuario_id, Titulo, Comentario) 
                    VALUES (:destinos_id, :usuario_id, :titulo, :comentario)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':destinos_id', $guia->getDestinoId());
            $stmt->bindValue(':usuario_id',  $guia->getUsuarioId());
            $stmt->bindValue(':titulo',      $guia->getTitulo());
            $stmt->bindValue(':comentario',  $guia->getComentarioGuia());
            $stmt->execute();
 
            $idGuia = $this->getConn()->lastInsertId();
 
            // 2. Insertar en la tabla específica según el tipo
            if ($guia instanceof GuiaGastronomica) {
                $sql2 = "INSERT INTO GUIAS_GASTRONOMICAS (Id_guias, precio_medio, tipo_comida) 
                         VALUES (:id, :precio, :tipo)";
                $stmt2 = $this->getConn()->prepare($sql2);
                $stmt2->bindValue(':id',     $idGuia);
                $stmt2->bindValue(':precio', $guia->getPrecioMedio());
                $stmt2->bindValue(':tipo',   $guia->getTipoComida());
                $stmt2->execute();
 
            } elseif ($guia instanceof GuiaRuta) {
                $sql2 = "INSERT INTO GUIAS_RUTA (Id_guias, distancia_km, Dificultad) 
                         VALUES (:id, :distancia, :dificultad)";
                $stmt2 = $this->getConn()->prepare($sql2);
                $stmt2->bindValue(':id',          $idGuia);
                $stmt2->bindValue(':distancia',   $guia->getDistanciaKm());
                $stmt2->bindValue(':dificultad',  $guia->getDificultad());
                $stmt2->execute();
            }
 
            $this->getConn()->commit();
            return true;
 
        } catch (PDOException $e) {
            $this->getConn()->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
 
    public function eliminarGuia($id) {
        try {
            $this->getConn()->beginTransaction();
 
            // Primero eliminamos la tabla específica (por la FK)
            $sql1 = "DELETE FROM GUIAS_GASTRONOMICAS WHERE Id_guias = :id";
            $stmt1 = $this->getConn()->prepare($sql1);
            $stmt1->bindValue(':id', $id);
            $stmt1->execute();
 
            $sql2 = "DELETE FROM GUIAS_RUTA WHERE Id_guias = :id";
            $stmt2 = $this->getConn()->prepare($sql2);
            $stmt2->bindValue(':id', $id);
            $stmt2->execute();
 
            // Luego eliminamos de GUIAS
            $sql3 = "DELETE FROM GUIAS WHERE Id_guias = :id";
            $stmt3 = $this->getConn()->prepare($sql3);
            $stmt3->bindValue(':id', $id);
            $stmt3->execute();
 
            $this->getConn()->commit();
            return true;
 
        } catch (PDOException $e) {
            $this->getConn()->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
 
    // =====================
    // RESEÑAS
    // =====================
 
    public function crearReseña(Resena $reseña) {
        try {
            $sql = "INSERT INTO RESEÑAS (destinos_id, usuario_id, Comentarios, Valoración) 
                    VALUES (:destinos_id, :usuario_id, :comentario, :valoracion)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':destinos_id', $reseña->getDestinoId());
            $stmt->bindValue(':usuario_id',  $reseña->getUsuarioId());
            $stmt->bindValue(':comentario',  $reseña->getComentarioResena());
            $stmt->bindValue(':valoracion',  $reseña->getValoracion());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
 
    // =====================
    // FOTOS
    // =====================
 
    public function subirFoto(Foto $foto) {
        try {
            $sql = "INSERT INTO FOTOS (reseña_id, usuario_id, Url, descripcion) 
                    VALUES (:resena_id, :usuario_id, :url, :descripcion)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':resena_id',   $foto->getResenaId());
            $stmt->bindValue(':usuario_id',  $foto->getUsuarioId());
            $stmt->bindValue(':url',         $foto->getUrl());
            $stmt->bindValue(':descripcion', $foto->getDescripcionFoto());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}