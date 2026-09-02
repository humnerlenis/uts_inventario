<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new RuntimeException('La vista no existe: ' . $view);
        }

        require $viewFile;
    }

    protected function redirect(string $path): void
    {
        redirect($path);
    }

    protected function notFound(): void
    {
        http_response_code(404);
        $this->view('error/404');
        exit;
    }
}
