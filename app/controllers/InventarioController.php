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
        ]);
    }

    public function crear(): void
    {
        $this->view('inventario/form', [
            'title' => 'Registrar equipo',
            'item' => null,
            'modo' => 'crear',
            'ubicaciones' => $this->model->getUbicaciones(),
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
            $this->model->update($id, $data);
        } else {
            $this->model->create($data);
        }

        redirect('inventario');
    }

    public function eliminar(int $id): void
    {
        $this->model->delete($id);
        redirect('inventario');
    }
}
