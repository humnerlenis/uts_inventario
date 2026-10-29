<?php

require_once __DIR__ . '/../models/DispositivosModel.php';

class DispositivosController extends Controller
{
    private DispositivosModel $model;

    public function __construct()
    {
        $this->model = new DispositivosModel();
    }

    public function index(): void
    {
        $mensaje = $_SESSION['dispositivos_mensaje'] ?? '';
        unset($_SESSION['dispositivos_mensaje']);

        $this->view('dispositivos/index', [
            'title' => 'Dispositivos de red',
            'module' => 'dispositivos',
            'items' => $this->model->getAll(),
            'mensaje' => $mensaje,
        ]);
    }

    public function crear(): void
    {
        $this->mostrarFormulario();
    }

    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('red.php?url=dispositivos/index');
        }

        $data = [
            'ip' => trim((string) ($_POST['ip'] ?? '')),
            'mac' => trim((string) ($_POST['mac'] ?? '')),
            'interfaz' => trim((string) ($_POST['interfaz'] ?? '')),
            'host' => trim((string) ($_POST['host'] ?? '')),
            'responsable' => trim((string) ($_POST['responsable'] ?? '')),
        ];
        $errors = [];

        foreach ([
            'ip' => ['IP', 20],
            'mac' => ['MAC', 20],
            'interfaz' => ['interfaz', 20],
            'host' => ['host', 20],
            'responsable' => ['responsable', 100],
        ] as $field => [$label, $maximumLength]) {
            if ($data[$field] === '') {
                $errors[$field] = 'El campo ' . $label . ' es obligatorio.';
            } elseif ($this->characterLength($data[$field]) > $maximumLength) {
                $errors[$field] = 'El campo ' . $label . ' supera el máximo de ' . $maximumLength . ' caracteres.';
            }
        }

        if ($data['ip'] !== '' && filter_var($data['ip'], FILTER_VALIDATE_IP) === false) {
            $errors['ip'] = 'Ingrese una dirección IP válida.';
        }

        if ($data['interfaz'] !== '' && !in_array($data['interfaz'], ['Wireless', 'Ethernet'], true)) {
            $errors['interfaz'] = 'Seleccione Wireless o Ethernet.';
        }

        if ($errors !== []) {
            $this->mostrarFormulario($data, $errors);
            return;
        }

        if ($this->model->existsIp($data['ip'])) {
            $this->mostrarFormulario($data, ['ip' => 'La dirección IP ya está registrada.']);
            return;
        }

        try {
            $this->model->create($data);
        } catch (DuplicateIpException) {
            $this->mostrarFormulario($data, ['ip' => 'La dirección IP ya está registrada.']);
            return;
        }

        $_SESSION['dispositivos_mensaje'] = 'Dispositivo registrado correctamente.';
        redirect('red.php?url=dispositivos/index');
    }

    private function mostrarFormulario(array $data = [], array $errors = []): void
    {
        $this->view('dispositivos/form', [
            'title' => 'Registrar dispositivo',
            'module' => 'dispositivos',
            'data' => $data,
            'errors' => $errors,
        ]);
    }

    private function characterLength(string $value): int
    {
        $length = preg_match_all('/./us', $value);

        return $length === false ? strlen($value) : $length;
    }
}
