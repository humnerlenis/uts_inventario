<?php

require_once __DIR__ . '/../models/InventarioModel.php';

class InventarioController extends Controller
{
    private InventarioModel $model;

    public function __construct()
    {
        $this->model = new InventarioModel();
    }

    public function index(): void
    {
        $ubicacion = trim((string) ($_GET['ubicacion'] ?? ''));

        $this->view('inventario/index', [
            'items' => $this->model->getAll($ubicacion),
            'ubicaciones' => $this->model->getUbicaciones(),
            'ubicacionSeleccionada' => $ubicacion,
            'title' => 'Inventario institucional',
            'module' => 'inventario',
        ]);
    }

    public function crear(): void
    {
        $this->view('inventario/form', [
            'title' => 'Registrar equipo',
            'item' => null,
            'modo' => 'crear',
            'ubicaciones' => $this->model->getUbicaciones(),
            'module' => 'inventario',
        ]);
    }

    public function editar(int $id): void
    {
        $item = $this->model->getById($id);

        if (!$item) {
            $this->notFound();
        }

        $this->view('inventario/form', [
            'title' => 'Actualizar equipo',
            'item' => $item,
            'modo' => 'editar',
            'ubicaciones' => $this->model->getUbicaciones(),
            'module' => 'inventario',
        ]);
    }

    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('inventario');
        }

        $id = (int) ($_POST['id_inventario'] ?? 0);
        $data = [
            'tipo' => $_POST['tipo'] ?? '',
            'marca_y_modelo' => $_POST['marca_y_modelo'] ?? '',
            'serial' => $_POST['serial'] ?? '',
            'ubicacion' => $_POST['ubicacion'] ?? '',
            'color' => $_POST['color'] ?? '',
            'observacion' => $_POST['observacion'] ?? '',
            'estado' => $_POST['estado'] ?? '',
            'caracteristicas' => $_POST['caracteristicas'] ?? '',
            'cantidad' => $_POST['cantidad'] ?? 0,
        ];

        if ($id > 0) {
            $guardado = $this->model->update($id, $data);
            $palabra = 'actualizado';
        } else {
            $guardado = $this->model->create($data);
            $palabra = 'creado';
        }

        if ($guardado) {
            $this->enviarAlWebhook(INVENTARIO_WEBHOOK_URL, $palabra);
        }

        redirect('inventario');
    }

    public function eliminar(int $id): void
    {
        $this->model->delete($id);
        redirect('inventario');
    }

    private function enviarAlWebhook(string $url, string $palabra): void
    {
        if ($url === '' || !function_exists('curl_init')) {
            return;
        }

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(['palabra' => $palabra]),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT_MS => 500,
            CURLOPT_TIMEOUT_MS => 1000,
        ]);

        curl_exec($ch);
        
    }
}
