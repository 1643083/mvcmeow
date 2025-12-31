<?php

require_once 'Conexion.php';

class Animal extends Conexion {
  private $pdo;

  public function __construct()
  {
    $this->pdo = parent::getConexion();
  }

  public function listar(): array
  {
    try {
      $sql = "
        SELECT 
          id, nombre, especie, edad, descripcion, foto, estado, created, updated
        FROM animal
        ORDER BY id DESC
      ";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }

  public function registrar($registro = []): int
  {
    try {
      $sql = "
        INSERT INTO animal
          (nombre, especie, edad, descripcion, foto, estado)
        VALUES
          (?,?,?,?,?,?)
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([
        $registro['nombre'],
        $registro['especie'],
        $registro['edad'],
        $registro['descripcion'],
        $registro['foto'],
        $registro['estado']
      ]);

      return $this->pdo->lastInsertId();
    } catch (Exception $e) {
      return -1;
    }
  }

  public function eliminar(int $id): int
  {
    try {
      $sql = "DELETE FROM animal WHERE id = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$id]);

      return $consulta->rowCount();
    } catch (Exception $e) {
      return -1;
    }
  }

  public function actualizar($registro = []): int
  {
    try {
      $sql = "
        UPDATE animal SET
          nombre = ?,
          especie = ?,
          edad = ?,
          descripcion = ?,
          foto = ?,
          estado = ?
        WHERE id = ?
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([
        $registro['nombre'],
        $registro['especie'],
        $registro['edad'],
        $registro['descripcion'],
        $registro['foto'],
        $registro['estado'],
        $registro['id']
      ]);

      return $consulta->rowCount();
    } catch (Exception $e) {
      return -1;
    }
  }

  public function buscarPorId(int $id): array
  {
    try {
      $sql = "SELECT * FROM animal WHERE id = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$id]);

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }

  public function buscarPorEspecie(string $especie): array
  {
    try {
      $sql = "SELECT * FROM animal WHERE especie = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$especie]);

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }

  public function buscarPorEstado(string $estado): array
  {
    try {
      $sql = "SELECT * FROM animal WHERE estado = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute([$estado]);

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }

    public function listarDisponibles(): array
    {
    try {
        $sql = "
        SELECT 
            id, nombre, especie, edad, descripcion, foto, estado
        FROM animal
        WHERE estado = 'disponible'
        ORDER BY created DESC
        ";

        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
    }


}