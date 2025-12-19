<?php


namespace Dao;


use PDO;
use PDOException;


abstract class Table
{
    private static ?PDO $conn = null;


 
    protected static function getConnection(): PDO
    {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=db;dbname=productosdb;charset=utf8mb4",
                    "user",
                    "user",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Error de conexión a la DB: " . $e->getMessage());
            }
        }
        return self::$conn;
    }


    protected static function obtenerRegistros(string $sql, array $params = []): array
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }


    /**
     * Obtener un solo registro
     */
    protected static function obtenerUnRegistro(string $sql, array $params = []): array|false
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }


    protected static function executeNonQuery(string $sql, array $params = []): int
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
}
