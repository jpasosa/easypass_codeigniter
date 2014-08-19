




-- 19 de agosto del 2014
-- agrego campo activo para que se pueda realizar soft delete

ALTER TABLE  `claves` ADD  `activo` TINYINT( 2 ) NOT NULL DEFAULT  '1' COMMENT  '0 significa q está eliminado.'



-- 14 de Agosto del 2014

ALTER TABLE  `emails` ADD  `descripcion_email` VARCHAR( 300 ) NOT NULL
