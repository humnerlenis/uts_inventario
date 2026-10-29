<?php

class DuplicateIpException extends RuntimeException
{
}

class DispositivosModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT id, ip, mac, interfaz, host, responsable FROM public.dispositivos ORDER BY id DESC');

        return $stmt->fetchAll();
    }

    public function existsIp(string $ip): bool
    {
        $stmt = $this->db->prepare('SELECT 1 FROM public.dispositivos WHERE ip = :ip LIMIT 1');
        $stmt->execute([':ip' => $ip]);

        return $stmt->fetchColumn() !== false;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO public.dispositivos (ip, mac, interfaz, host, responsable)
             VALUES (:ip, :mac, :interfaz, :host, :responsable)'
        );

        try {
            $stmt->execute([
                ':ip' => $data['ip'],
                ':mac' => $data['mac'],
                ':interfaz' => $data['interfaz'],
                ':host' => $data['host'],
                ':responsable' => $data['responsable'],
            ]);
        } catch (PDOException $exception) {
            $constraint = (string) ($exception->errorInfo[2] ?? '');
            if ($exception->getCode() === '23505' && str_contains($constraint, 'dispositivos_ip_unique')) {
                throw new DuplicateIpException('La dirección IP ya está registrada.', 0, $exception);
            }

            throw $exception;
        }
    }
}
