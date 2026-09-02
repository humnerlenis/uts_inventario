<?php

class InventarioModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(string $ubicacion = ''): array
    {
        $sql = 'SELECT * FROM public.inventario order by id_inventario';
        $params = [];

        if ($ubicacion !== '') {
            $sql .= ' WHERE ubicacion = :ubicacion';
            $params[':ubicacion'] = $ubicacion;
        }

        $sql .= ' ORDER BY id_inventario DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getUbicaciones(): array
    {
        $stmt = $this->db->query('SELECT DISTINCT ubicacion FROM public.inventario ORDER BY ubicacion ASC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM public.inventario WHERE id_inventario = :id');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function create(array $data): bool
    {
        $payload = $this->sanitize($data);

        $sql = 'INSERT INTO public.inventario (
                tipo,
                marca_y_modelo,
                serial,
                ubicacion,
                color,
                observacion,
                estado,
                caracteristicas,
                cantidad
            ) VALUES (
                :tipo,
                :marca_y_modelo,
                :serial,
                :ubicacion,
                :color,
                :observacion,
                :estado,
                :caracteristicas,
                :cantidad
            )';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':tipo' => $payload['tipo'],
            ':marca_y_modelo' => $payload['marca_y_modelo'],
            ':serial' => $payload['serial'],
            ':ubicacion' => $payload['ubicacion'],
            ':color' => $payload['color'],
            ':observacion' => $payload['observacion'],
            ':estado' => $payload['estado'],
            ':caracteristicas' => $payload['caracteristicas'],
            ':cantidad' => $payload['cantidad'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $payload = $this->sanitize($data);

        $sql = 'UPDATE public.inventario SET
                tipo = :tipo,
                marca_y_modelo = :marca_y_modelo,
                serial = :serial,
                ubicacion = :ubicacion,
                color = :color,
                observacion = :observacion,
                estado = :estado,
                caracteristicas = :caracteristicas,
                cantidad = :cantidad
                WHERE id_inventario = :id';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':tipo' => $payload['tipo'],
            ':marca_y_modelo' => $payload['marca_y_modelo'],
            ':serial' => $payload['serial'],
            ':ubicacion' => $payload['ubicacion'],
            ':color' => $payload['color'],
            ':observacion' => $payload['observacion'],
            ':estado' => $payload['estado'],
            ':caracteristicas' => $payload['caracteristicas'],
            ':cantidad' => $payload['cantidad'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM public.inventario WHERE id_inventario = :id');
        return $stmt->execute([':id' => $id]);
    }

    private function sanitize(array $data): array
    {
        return [
            'tipo' => trim((string) ($data['tipo'] ?? '')),
            'marca_y_modelo' => trim((string) ($data['marca_y_modelo'] ?? '')),
            'serial' => trim((string) ($data['serial'] ?? '')),
            'ubicacion' => trim((string) ($data['ubicacion'] ?? '')),
            'color' => trim((string) ($data['color'] ?? '')),
            'observacion' => trim((string) ($data['observacion'] ?? '')),
            'estado' => trim((string) ($data['estado'] ?? '')),
            'caracteristicas' => trim((string) ($data['caracteristicas'] ?? '')),
            'cantidad' => (int) ($data['cantidad'] ?? 0),
        ];
    }
}
