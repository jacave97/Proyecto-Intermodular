<?php

class GestorPDO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    // --- USUARIOS ---
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

    // --- DESTINOS ---
    public function listarDestinos()
    {
        $sql  = "SELECT * FROM DESTINOS";
        $rtdo = $this->getConn()->query($sql);
        $arrayDestinos = [];

        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            // Verifica que dentro de Destino.php la clase sea "class Destino"[cite: 12, 19]
            $arrayDestinos[] = new Destino(
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

    public function insertarDestinoDirecto($nombre, $pais, $continente, $descripcion, $imagen)
    {
        try {
            $sql = "INSERT INTO DESTINOS (nombre, país, continente, descripción, imagen, numero_visitas) 
                VALUES (:nombre, :pais, :continente, :descripcion, :imagen, 0)";

            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':nombre',      $nombre);
            $stmt->bindValue(':pais',        $pais);
            $stmt->bindValue(':continente',  $continente);
            $stmt->bindValue(':descripcion', $descripcion);
            $stmt->bindValue(':imagen',      $imagen);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // --- GUIAS (Mantener igual que en source 19) ---
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
}
