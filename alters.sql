-- Quitar UNIQUE del password
ALTER TABLE usuario
DROP INDEX password_UNIQUE;

-- AUTO_INCREMENT en proyecto_id
ALTER TABLE proyecto
MODIFY proyecto_id INT NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT en estado_id
ALTER TABLE estado
MODIFY estado_id INT NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT en tarea_id
ALTER TABLE tarea
MODIFY tarea_id INT NOT NULL AUTO_INCREMENT;

-- Opcional: timestamps automáticos
ALTER TABLE proyecto
MODIFY created_at DATETIME NULL DEFAULT NOW();

ALTER TABLE tarea
MODIFY created_at DATETIME NULL DEFAULT NOW();
-- Insertar estados iniciales
INSERT INTO estado (estado_id, nombre) VALUES
(1, 'Pendiente'),
(2, 'En progreso'),
(3, 'Completada');
