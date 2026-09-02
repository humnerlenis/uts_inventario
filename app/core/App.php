<?php

class App
{
    public function run(): void
    {
        $url = $this->resolveUrl();
        $segments = array_values(array_filter(explode('/', $url), static fn ($segment) => $segment !== ''));

        $controllerName = $segments[0] ?? 'Inventario';
        $method = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controllerFile = __DIR__ . '/../controllers/' . ucfirst($controllerName) . 'Controller.php';

        if (!file_exists($controllerFile)) {
            $this->renderNotFound();
        }

        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            $this->renderNotFound();
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            $this->renderNotFound();
        }

        call_user_func_array([$controller, $method], $params);
    }

    private function resolveUrl(): string
    {
        $url = $_GET['url'] ?? '';

        if ($url === '' && isset($_SERVER['REQUEST_URI'])) {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
            $scriptFolder = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
            $base = rtrim($scriptFolder, '/');

            if ($base !== '' && $base !== '/' && strpos($uri, $base) === 0) {
                $uri = substr($uri, strlen($base));
            }

            $uri = trim($uri, '/');

            if ($uri === '' || $uri === 'index.php') {
                return 'inventario/index';
            }

            if (!preg_match('#^inventario(?:/|$)#', $uri)) {
                return 'inventario/' . $uri;
            }

            return $uri;
        }

        return $url !== '' ? $url : 'inventario/index';
    }

    private function renderNotFound(): void
    {
        http_response_code(404);
        echo 'Página no encontrada';
        exit;
    }
}
