# Gestor de Proyectos y Tareas (PHP)

Sistema funcional para la administración de flujos de trabajo, centrado en el seguimiento de tareas por usuario y la gestión de estados de proyectos.

## 🚀 Funcionalidades
- **Panel de Control:** Dashboard con vista segregada de tareas pendientes y proyectos activos.
- **Estados Dinámicos:** Seguimiento de progreso (Pendiente, En curso, Finalizado) mediante badges visuales.
- **Control de Acceso:** Lógica de permisos para que solo el propietario pueda editar sus proyectos.
- **Interfaz:** Inclusión de "Ver más" mediante JS para comentarios extensos y diseño basado en Bootstrap 5.

## 🛠️ Stack
- **Backend:** PHP 8.x
- **Frontend:** HTML5, Bootstrap 5, JavaScript (Vanilla)
- **Estructura:** Sistema de plantillas modular (`partials`)

## ⚙️ Detalles de Implementación
- Uso de `htmlspecialchars` y `nl2br` para el renderizado seguro de strings.
- Lógica condicional en el frontend para mostrar/ocultar acciones según el rol del usuario en el proyecto.
- Separación de componentes reutilizables (header/footer) para facilitar el mantenimiento.
