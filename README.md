# Sistema institucional de dispositivos e inventario

Aplicación web en PHP con patrón MVC para registrar dispositivos de red y consultar equipos del inventario institucional.

## Características
- Registro de dispositivos en `public.dispositivos`
- Validación de IP única y selección de interfaz `Wireless` o `Ethernet`
- Listado de dispositivos con responsable, host, MAC e IP
- CRUD completo para la tabla `public.inventario`
- Diseño responsive para móvil, tablet y escritorio
- Paleta institucional: azul, blanco y naranja
- Separación en capas MVC
- Archivos independientes para estilos y JavaScript
- Compatibilidad con PostgreSQL

## Estructura principal
- `index.php` - entrada principal
- `red.php` - entrada independiente para el registro de dispositivos de red
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
El archivo `database/schema.sql` contiene los esquemas de `public.inventario` y `public.dispositivos`. Si la tabla `dispositivos` ya existe, ejecuta el bloque correspondiente del archivo para crear el índice único de IP.

Si la tabla ya contiene direcciones IP repetidas, PostgreSQL no podrá crear ese índice hasta que se corrijan esos registros.

El registro de dispositivos de red está disponible en `/red.php`. El inventario anterior sigue disponible en `/inventario`.
