# Sistema de inventario institucional

Aplicación web en PHP con patrón MVC para gestionar equipos del inventario por ubicación/departamento.

## Características
- CRUD completo para la tabla `public.inventario`
- Diseño responsive para móvil, tablet y escritorio
- Paleta institucional: azul, blanco y naranja
- Separación en capas MVC
- Archivos independientes para estilos y JavaScript
- Compatibilidad con PostgreSQL

## Estructura principal
- `index.php` - entrada principal
- `app/config/config.php` - configuración global
- `app/core/*` - base del MVC
- `app/controllers/*` - controladores
- `app/models/*` - modelos
- `app/views/*` - vistas HTML/PHP
- `assets/css/styles.css` - estilos del sitio
- `assets/js/main.js` - lógica de interfaz

## Requisitos
- PHP 8+
- PostgreSQL con el driver `pdo_pgsql`
- Apache o Nginx con soporte de URLs amigables (opcional)

## Configuración de conexión
Editar en `app/config/config.php`:
- `DB_HOST`
- `DB_PORT`
- `DB_NAME`
- `DB_USER`
- `DB_PASS`

## Ejecutar
Desde la carpeta del proyecto:

```bash
php -S localhost:8080
```

Luego abrir:

```text
http://localhost:8080/
```

## Base de datos
Se espera una tabla llamada `public.inventario` con la estructura indicada en el enunciado.
