# 🏍️ Proyecto: Landing Page y Catálogo "Honda Motos"

## 📝 Descripción General
Este proyecto es una aplicación web interactiva que funciona como catálogo y página de captura (Landing Page) para una concesionaria ficticia de **Honda Motos**. Fue desarrollado por **Edwin Alexander Ezquivel Rojas** y está diseñado para mostrar los diferentes modelos de motocicletas, sus detalles técnicos y permitir a los usuarios registrarse para recibir más información, generando reportes en PDF.

El proyecto está optimizado para su despliegue gratuito en la plataforma **Vercel** mediante su runtime de PHP y utiliza una base de datos **SQLite** embebida.

---

## 🛠️ Tecnologías y Herramientas Utilizadas
- **Frontend:** HTML5, CSS3 (con diseño responsivo/Media Queries), JavaScript (Vanilla) y FontAwesome (iconos).
- **Backend:** PHP 8+ (procesamiento de datos, ruteo y lógica de la base de datos).
- **Base de Datos:** SQLite (ligera y autocontenida).
- **Librerías de Terceros:** 
  - `html2pdf.js` (Para la generación de reportes PDF del lado del cliente).
- **Despliegue (Hosting):** Vercel (Configurado mediante `vercel.json`).
- **Control de Versiones:** Git y GitHub.

---

## 🚀 Mejoras y Funcionalidades Implementadas

A lo largo del desarrollo, se realizaron múltiples iteraciones para mejorar la experiencia del usuario, la seguridad y el diseño del sitio:

### 1. 🖼️ Catálogo Dinámico y Gestión de Imágenes
- Se centralizó toda la información de las motocicletas en un archivo de datos (`data.php`).
- Se ajustaron los precios de los modelos a su equivalente real en **Pesos Mexicanos (MXN)**.
- Se implementó un sistema de galería con 3 fotografías por cada modelo.
- Se corrigieron los enlaces rotos extrayendo URLs limpias y directas de Wikimedia Commons, resolviendo problemas de incompatibilidad de imágenes.
- Se añadieron nuevos modelos solicitados como la **Honda CRF250RX (Enduro)** y la **Honda NAVi (Scooter/Urbana)**, incluyendo sus fichas técnicas y garantías reales.

### 2. 📱 Interfaz y Diseño Responsivo
- Se reestructuró el CSS (`styles.css`) para que el sitio sea **100% responsivo** (compatible con teléfonos móviles y tablets).
- En pantallas pequeñas, el menú de navegación (`Navbar`) y las tarjetas del catálogo (`Grid`) se apilan verticalmente para una correcta visualización.
- Se agregó el domicilio físico real en el `Footer` (Manzanillo, Col.) junto con créditos de desarrollo ("Desarrollado por EDWIN ALEXANDER EZQUIVEL ROJAS").
- Se corrigió el logotipo oficial de Honda, reemplazándolo por una versión vectorial (SVG) de alta resolución.

### 3. 🛡️ Formulario, Base de Datos y Reportes (SQLite + PDF)
- **Base de Datos SQLite:** Se creó la clase `Database` (`db.php`) para gestionar automáticamente la creación de la base de datos (`database.sqlite`) y la tabla `inscripciones`.
- **Validaciones Seguras (PHP 8+):** Se actualizó el archivo `procesar.php` para utilizar validaciones modernas (`htmlspecialchars` y `strip_tags`), reemplazando la constante obsoleta `FILTER_SANITIZE_STRING`. Se valida estrictamente longitud de nombres, formato de email y estructura de números telefónicos.
- **Reporte PDF:** Se pulió el diseño de la vista `reporte.php`. Tras un registro exitoso, el usuario puede ver sus datos inyectados en una plantilla simulando una hoja A4 y guardarla localmente como PDF utilizando la función de impresión del navegador y `html2pdf`.

### 4. ☁️ Adaptación y Despliegue en Vercel
- **Reestructuración de Rutas:** Vercel exige que las funciones Serverless en PHP se ubiquen dentro de una carpeta llamada `/api`. Todos los archivos `.php` de vista y proceso fueron movidos a este directorio.
- **Rutas Absolutas:** Se modificaron los `require_once` de los *headers*, *footers* y *datos* para usar `__DIR__` de forma absoluta, evitando errores de rutas al navegar.
- **Archivo de Configuración (`vercel.json`):** Se creó para indicar a Vercel el uso del runtime `vercel-php@0.6.2` y reescribir las rutas (URL Rewrites), permitiendo que el usuario vea `dominio.com/motos.php` mientras Vercel procesa internamente `/api/motos.php`.
- **Almacenamiento Temporal para SQLite:** Dado que el sistema de archivos de Vercel es de *Solo Lectura* (Read-Only), se implementó una condición en la conexión PDO: si detecta el entorno Vercel, la base de datos se guarda en la carpeta temporal `/tmp/` para permitir que el formulario siga siendo funcional a modo de demostración.

---

## 📂 Estructura del Proyecto

```text
SITE_LANDING_HONDA/
├── api/                  # Vistas y lógica PHP (Serverless Functions para Vercel)
│   ├── index.php         # Página principal (Landing Page)
│   ├── motos.php         # Catálogo completo
│   ├── detalle.php       # Ficha técnica individual por motocicleta
│   ├── registro.php      # Formulario de inscripción
│   ├── procesar.php      # Lógica de validación e inserción en base de datos
│   └── reporte.php       # Vista final de confirmación y generación de PDF
├── assets/               # Recursos estáticos
│   ├── css/
│   │   └── styles.css    # Estilos principales y media queries
│   └── js/
│       └── main.js       # Scripts para interacción UI y PDF
├── includes/             # Componentes reutilizables y datos base
│   ├── data.php          # Array con toda la info, precios y fotos del catálogo
│   ├── db.php            # Clase de conexión y creación de la BD SQLite
│   ├── header.php        # Menú de navegación superior
│   └── footer.php        # Pie de página y créditos
├── vercel.json           # Configuración de despliegue para Vercel
└── README.md             # Documentación del proyecto (este archivo)
```

---

## 💻 Instrucciones para Ejecución Local

Si deseas correr este proyecto en tu computadora local (usando XAMPP, WAMP, Laragon, etc.):

1. Clona el repositorio en tu carpeta de servidor local (ej. `htdocs` o `www`):
   ```bash
   git clone https://github.com/AlexisLzL/SITE_LANDING_HONDA.git
   ```
2. Mueve temporalmente los archivos de la carpeta `/api` a la raíz del proyecto (ya que tu servidor local Apache/Nginx no requiere la estructura de Vercel).
3. Asegúrate de tener habilitada la extensión `pdo_sqlite` en tu archivo `php.ini`.
4. Abre tu navegador y dirígete a `http://localhost/SITE_LANDING_HONDA`.
5. ¡Listo! La base de datos SQLite se creará automáticamente en la carpeta `includes/` al realizar el primer registro.