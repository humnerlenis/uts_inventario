<?php

class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $drivers = PDO::getAvailableDrivers();

            if (!in_array('pgsql', $drivers, true)) {
                throw new RuntimeException('El driver PDO PostgreSQL no está habilitado. Activa pdo_pgsql en PHP.');
            }

            $dsn = sprintf(
                'pgsql:host=%s;port=%s;dbname=%s',
                DB_HOST,
                DB_PORT,
                DB_NAME
            );

            try {
                self::$instance = new PDO(
                    $dsn,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                die('No se pudo conectar a PostgreSQL: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
