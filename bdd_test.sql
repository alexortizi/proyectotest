# SQL Manager 2007 for MySQL 4.1.2.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : bdd_test


SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `bdd_test`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `bdd_test`;

#
# Structure for the `t_categoria` table : 
#

CREATE TABLE `t_categoria` (
  `CAT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAT_CATEGORIA` varchar(100) DEFAULT NULL,
  `CAT_ESTADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`CAT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `t_tema` table : 
#

CREATE TABLE `t_tema` (
  `TEM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TEM_TEMA` varchar(100) DEFAULT NULL,
  `TEM_ESTADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`TEM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Structure for the `t_categoriatema` table : 
#

CREATE TABLE `t_categoriatema` (
  `CATTEM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAT_ID` int(11) DEFAULT NULL,
  `TEM_ID` int(11) DEFAULT NULL,
  `CATTEM_ESTADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`CATTEM_ID`),
  KEY `CAT_ID` (`CAT_ID`),
  KEY `TEM_ID` (`TEM_ID`),
  CONSTRAINT `t_categoriatema_fk` FOREIGN KEY (`CAT_ID`) REFERENCES `t_categoria` (`CAT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_categoriatema_fk1` FOREIGN KEY (`TEM_ID`) REFERENCES `t_tema` (`TEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Structure for the `t_convocatoria` table : 
#

CREATE TABLE `t_convocatoria` (
  `CON_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CON_FECHA` date DEFAULT NULL,
  `CON_ESTADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`CON_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=16384;

#
# Structure for the `t_estudiante` table : 
#

CREATE TABLE `t_estudiante` (
  `EST_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EST_ESTUDIANTE` varchar(100) DEFAULT NULL,
  `EST_PASSWORD` varchar(100) DEFAULT NULL,
  `EST_CEDULA` varchar(20) DEFAULT NULL,
  `CAT_ID` int(11) DEFAULT NULL,
  `CON_ID` int(11) DEFAULT NULL,
  `EST_ESTADO` int(11) DEFAULT NULL,
  `EST_TIEMPO` time DEFAULT NULL,
  PRIMARY KEY (`EST_ID`),
  KEY `t_estudiante_fk` (`CON_ID`),
  KEY `t_estudiante_fk1` (`CAT_ID`),
  CONSTRAINT `t_estudiante_fk` FOREIGN KEY (`CON_ID`) REFERENCES `t_convocatoria` (`CON_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_estudiante_fk1` FOREIGN KEY (`CAT_ID`) REFERENCES `t_categoria` (`CAT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=8192;

#
# Structure for the `t_preguntas` table : 
#

CREATE TABLE `t_preguntas` (
  `PRE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRE_PREGUNTA` varchar(255) DEFAULT NULL,
  `PRE_OPCION1` varchar(255) DEFAULT NULL,
  `PRE_OPCION2` varchar(255) DEFAULT NULL,
  `PRE_OPCION3` varchar(255) DEFAULT NULL,
  `PRE_OPCION4` varchar(255) DEFAULT NULL,
  `PRE_RESPUESTA` int(11) DEFAULT NULL,
  `PRE_ESTADO` int(11) DEFAULT NULL,
  `TEM_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PRE_ID`),
  KEY `t_preguntas_fk` (`TEM_ID`),
  CONSTRAINT `t_preguntas_fk` FOREIGN KEY (`TEM_ID`) REFERENCES `t_tema` (`TEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Structure for the `t_prueba` table : 
#

CREATE TABLE `t_prueba` (
  `PRU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CON_ID` int(11) DEFAULT NULL,
  `CAT_ID` int(11) DEFAULT NULL,
  `PRU_TIEMPO` time DEFAULT NULL,
  `PRU_ESTADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`PRU_ID`),
  KEY `t_prueba_fk` (`CON_ID`),
  KEY `t_prueba_fk1` (`CAT_ID`),
  CONSTRAINT `t_prueba_fk` FOREIGN KEY (`CON_ID`) REFERENCES `t_convocatoria` (`CON_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_prueba_fk1` FOREIGN KEY (`CAT_ID`) REFERENCES `t_categoria` (`CAT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Structure for the `t_temaasignado` table : 
#

CREATE TABLE `t_temaasignado` (
  `TA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRU_ID` int(11) DEFAULT NULL,
  `TEM_ID` int(11) DEFAULT NULL,
  `TA_NUMPREG` int(11) DEFAULT NULL,
  `TA_ESTADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`TA_ID`),
  KEY `t_temaasignado_fk` (`TEM_ID`),
  KEY `t_temaasignado_fk2` (`PRU_ID`),
  CONSTRAINT `t_temaasignado_fk` FOREIGN KEY (`TEM_ID`) REFERENCES `t_tema` (`TEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_temaasignado_fk2` FOREIGN KEY (`PRU_ID`) REFERENCES `t_prueba` (`PRU_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

#
# Structure for the `t_preguntaasignada` table : 
#

CREATE TABLE `t_preguntaasignada` (
  `PREA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TA_ID` int(11) DEFAULT NULL,
  `PRE_ID` int(11) DEFAULT NULL,
  `EST_ID` int(11) DEFAULT NULL,
  `PREA_RESPUESTA` int(11) DEFAULT NULL,
  `PREA_ESTADO` int(11) DEFAULT NULL,
  `PREA_PENDIENTE` int(11) DEFAULT NULL,
  PRIMARY KEY (`PREA_ID`),
  KEY `t_preguntaasignada_fk` (`PRE_ID`),
  KEY `t_preguntaasignada_fk1` (`TA_ID`),
  KEY `EST_ID` (`EST_ID`),
  CONSTRAINT `t_preguntaasignada_fk` FOREIGN KEY (`PRE_ID`) REFERENCES `t_preguntas` (`PRE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_preguntaasignada_fk1` FOREIGN KEY (`TA_ID`) REFERENCES `t_temaasignado` (`TA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_preguntaasignada_fk2` FOREIGN KEY (`EST_ID`) REFERENCES `t_estudiante` (`EST_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=5461;

#
# Structure for the `t_usuario` table : 
#

CREATE TABLE `t_usuario` (
  `USU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USU_USUARIO` varchar(100) DEFAULT NULL,
  `USU_PASSWORD` varchar(100) DEFAULT NULL,
  `CAT_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`USU_ID`),
  KEY `t_usuario_fk` (`CAT_ID`),
  CONSTRAINT `t_usuario_fk` FOREIGN KEY (`CAT_ID`) REFERENCES `t_categoria` (`CAT_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Definition for the `SP_ASIGNARPREGUNTA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_ASIGNARPREGUNTA`(IN TA INTEGER(11), IN PRE INTEGER(11), IN EST INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @TA=TA;
SET @PRE=PRE;
SET @EST=EST;
INSERT INTO 
  t_preguntaasignada
(
  t_preguntaasignada.TA_ID,
  t_preguntaasignada.PRE_ID,
  t_preguntaasignada.EST_ID
) 
VALUE (
  @TA,
  @PRE,
  @EST
);
END;

#
# Definition for the `SP_AUXILIAR` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_AUXILIAR`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SELECT 
  t_categoria.CAT_CATEGORIA,
  t_convocatoria.CON_FECHA,
  t_estudiante.EST_ESTUDIANTE,
  t_prueba.PRU_NUM,
  COUNT(t_preguntaasignada.PREA_RESPUESTA = t_preguntas.PRE_RESPUESTA) AS PUNTAJE
FROM
  t_estudiante
  INNER JOIN t_categoria ON (t_estudiante.CAT_ID = t_categoria.CAT_ID)
  INNER JOIN t_convocatoria ON (t_estudiante.CON_ID = t_convocatoria.CON_ID)
  INNER JOIN t_prueba ON (t_estudiante.CON_ID = t_prueba.CON_ID)
  AND (t_estudiante.CAT_ID = t_prueba.CAT_ID)
  INNER JOIN t_preguntaasignada ON (t_preguntaasignada.EST_ID = t_estudiante.EST_ID)
  INNER JOIN t_preguntas ON (t_preguntas.PRE_ID = t_preguntaasignada.PRE_ID)
WHERE
  t_categoria.CAT_ID = '1'
GROUP BY
  t_categoria.CAT_CATEGORIA,
  t_convocatoria.CON_FECHA,
  t_estudiante.EST_ESTUDIANTE,
  t_prueba.PRU_NUM;
END;

#
# Definition for the `SP_INSERTARPREGUNTA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTARPREGUNTA`(IN PRE_PREGUNTA VARCHAR(255), IN PRE_OPCION1 VARCHAR(255), IN PRE_OPCION2 VARCHAR(255), IN PRE_OPCION3 VARCHAR(255), IN PRE_OPCION4 VARCHAR(255), IN PRE_RESPUESTA INTEGER(11), IN TEM_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @PRE_PREGUNTA=PRE_PREGUNTA;
SET @PRE_OPCION1=PRE_OPCION1;
SET @PRE_OPCION2=PRE_OPCION2;
SET @PRE_OPCION3=PRE_OPCION3;
SET @PRE_OPCION4=PRE_OPCION4;
SET @PRE_RESPUESTA=PRE_RESPUESTA;
SET @TEM_ID=TEM_ID;
INSERT INTO 
  t_preguntas
(
  PRE_PREGUNTA,
  PRE_OPCION1,
  PRE_OPCION2,
  PRE_OPCION3,
  PRE_OPCION4,
  PRE_RESPUESTA,
  PRE_ESTADO,
  TEM_ID
) 
VALUE (
  @PRE_PREGUNTA,
  @PRE_OPCION1,
  @PRE_OPCION2,
  @PRE_OPCION3,
  @PRE_OPCION4,
  @PRE_RESPUESTA,
  '1',
  @TEM_ID
);
COMMIT;
END;

#
# Definition for the `SP_INSERTCATEGORIA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTCATEGORIA`(IN CATEGORIA VARCHAR(100))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @CATEGORIA=CATEGORIA;
INSERT INTO 
  t_categoria
(
  CAT_CATEGORIA,
  CAT_ESTADO
) 
VALUE (
  @CATEGORIA,
  '1'
);
END;

#
# Definition for the `SP_INSERTCONTESTADA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTCONTESTADA`(IN PREA_ID INTEGER(11), IN PREC_CONTESTADA INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @PREA_ID=PREA_ID;
SET @PREC_CONTESTADA=PREC_CONTESTADA;
INSERT INTO 
  t_preguntascontestadas
(
  PREA_ID,
  PREC_CONTESTADA
) 
VALUE (
  @PREA_ID,
  @PREC_CONTESTADA
);
END;

#
# Definition for the `SP_INSERTCONVOCATORIA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTCONVOCATORIA`(IN FECHA VARCHAR(20))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @FECHA=FECHA;
INSERT INTO 
  t_convocatoria
(

  CON_FECHA,
  CON_ESTADO
) 
VALUE (

  @FECHA,
  '1'
);
END;

#
# Definition for the `SP_INSERTESTUDIANTE` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTESTUDIANTE`(IN EST_ESTUDIANTE VARCHAR(50), IN EST_PASSWORD VARCHAR(20), IN CAT_ID INTEGER(11), IN CON_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @EST_ESTUDIANTE=EST_ESTUDIANTE; 
SET @EST_PASSWORD=EST_PASSWORD;
SET @CAT_ID=CAT_ID;
SET @CON_ID=CON_ID;
INSERT INTO 
  t_estudiante
(
  EST_ESTUDIANTE,
  EST_PASSWORD,
  CAT_ID,
  CON_ID,
  EST_ESTADO
) 
VALUE (
  @EST_ESTUDIANTE,
  @EST_PASSWORD,
  @CAT_ID,
  @CON_ID,
  '0'
);
COMMIT;
END;

#
# Definition for the `SP_INSERTHORA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTHORA`(IN EST_TIEMPO VARCHAR(20), IN EST_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @EST_TIEMPO=EST_TIEMPO;
SET @EST_ID=EST_ID;
UPDATE 
  t_estudiante  
SET 
  t_estudiante.EST_TIEMPO = @EST_TIEMPO
 
WHERE 
  t_estudiante.EST_ID = @EST_ID
;
COMMIT;
END;

#
# Definition for the `SP_INSERTPREGUNTAASIGNADA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTPREGUNTAASIGNADA`(IN TA_ID INTEGER(11), IN PRE_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @TA_ID=TA_ID;
SET @PRE_ID=PRE_ID;
INSERT INTO 
  t_preguntaasignada
(
  TA_ID,
  PRE_ID
) 
VALUE (
  @TA_ID,
  @PRE_ID
);
COMMIT;
END;

#
# Definition for the `SP_INSERTPRUEBA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTPRUEBA`(IN CON_ID VARCHAR(50), IN CAT_ID VARCHAR(50), IN PRU_TIEMPO VARCHAR(15))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @CON_FECHA=CON_ID;
SET @CAT_CATEGORIA=CAT_ID;
SET @PRU_TIEMPO=PRU_TIEMPO;

INSERT INTO t_convocatoria(t_convocatoria.CON_FECHA,t_convocatoria.CON_ESTADO)
SELECT @CON_FECHA,'1'
FROM dual
WHERE NOT EXISTS (SELECT * FROM t_convocatoria WHERE t_convocatoria.CON_FECHA=@CON_FECHA);
COMMIT;

INSERT INTO 
  t_prueba
(
  CON_ID,
  CAT_ID,
  PRU_TIEMPO,
  PRU_ESTADO
) 
VALUE (
  (SELECT t_convocatoria.CON_ID FROM t_convocatoria WHERE t_convocatoria.CON_FECHA=@CON_FECHA),
  (SELECT t_categoria.CAT_ID FROM t_categoria WHERE t_categoria.CAT_CATEGORIA=@CAT_CATEGORIA),
  @PRU_TIEMPO,
  '1'
);
COMMIT;
END;

#
# Definition for the `SP_INSERTRESULTADO` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTRESULTADO`(IN EST_ID INTEGER(11), IN PRU_ID INTEGER(11), IN RES_PUNTAJE INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @EST_ID=EST_ID;
SET @PRU_ID=PRU_ID;
SET @RES_PUNTAJE=RES_PUNTAJE;
INSERT INTO 
  t_resultado
(
  
  EST_ID,
  PRU_ID,
  RES_PUNTAJE
) 
VALUE (
  @EST_ID,
  @PRU_ID,
  @RES_PUNTAJE
);
END;

#
# Definition for the `SP_INSERTTEMA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTTEMA`(IN TEMA VARCHAR(100), IN CAT INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @TEMA=TEMA;
SET @CAT=CAT;
INSERT INTO 
  t_tema
(
  TEM_TEMA,
  CAT_ID,
  TEM_ESTADO
) 
VALUE (
  @TEMA,
  @CAT,
  '1'
);
COMMIT;
END;

#
# Definition for the `SP_INSERTTEMAASIGNADO` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTTEMAASIGNADO`(IN TEM_ID VARCHAR(50), IN TEM_NUMPREG INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @TEM_ID=TEM_ID;
SET @TEM_NUMPREG=TEM_NUMPREG;

INSERT INTO 
  t_temaasignado
(
  T_TEMAASIGNADO.PRU_ID,
  T_TEMAASIGNADO.TEM_ID,
  t_temaasignado.TA_NUMPREG,
  t_temaasignado.TA_ESTADO
) 
VALUE (
  (SELECT MAX(t_prueba.PRU_ID) FROM t_prueba),
  (SELECT t_tema.TEM_ID FROM t_tema WHERE t_tema.TEM_TEMA=@TEM_ID),
  @TEM_NUMPREG,'1'
);
COMMIT;
END;

#
# Definition for the `SP_INSERTTEMAPRUEBA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTTEMAPRUEBA`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @TEMA=TEMA;
SET @CAT=CAT;
INSERT INTO 
  t_tema
(
  TEM_TEMA,
  CAT_ID,
  TEM_ESTADO
) 
VALUE (
  @TEMA,
  @CAT,
  '1'
);
COMMIT;
END;

#
# Definition for the `SP_INSERTUSUARIO` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_INSERTUSUARIO`(IN USUARIO VARCHAR(100), IN PASSWORD VARCHAR(50), IN CAT INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @USUARIO=USUARIO;
SET @PASSWORD=PASSWORD;
SET @CAT=CAT;
INSERT INTO 
  t_usuario
(
  USU_USUARIO,
  USU_PASSWORD,
  CAT_ID
) 
VALUE (
  @USUARIO,
  @PASSWORD,
  @CAT
);
END;

#
# Definition for the `SP_SELECTESTUDIANTEPUNTAJE` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTESTUDIANTEPUNTAJE`(IN EST INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @EST=EST;
SET @S=(SELECT 
  COUNT(*) AS FIELD_1
FROM
  t_preguntas
  INNER JOIN t_preguntaasignada ON (t_preguntas.PRE_ID = t_preguntaasignada.PRE_ID)
  INNER JOIN t_estudiante ON (t_preguntaasignada.EST_ID = t_estudiante.EST_ID)
WHERE
  t_preguntaasignada.PREA_RESPUESTA = t_preguntas.PRE_RESPUESTA AND 
  t_estudiante.EST_ID = @EST
GROUP BY
  t_estudiante.EST_ID);    
  
  SET @A=(SELECT 
  COUNT(*) AS FIELD_1
FROM
  t_preguntas
  INNER JOIN t_preguntaasignada ON (t_preguntas.PRE_ID = t_preguntaasignada.PRE_ID)
  INNER JOIN t_estudiante ON (t_preguntaasignada.EST_ID = t_estudiante.EST_ID)
WHERE
  t_estudiante.EST_ID = @EST
GROUP BY
  t_estudiante.EST_ID);
SELECT 
  t_estudiante.EST_ID,
  t_categoria.CAT_CATEGORIA,
  t_convocatoria.CON_FECHA,
  t_estudiante.EST_ESTUDIANTE, 
  t_estudiante.EST_CEDULA,
 @A AS PRU_NUM,
  @S AS PUNTAJE
FROM
  t_categoria
  INNER JOIN t_estudiante ON (t_categoria.CAT_ID = t_estudiante.CAT_ID)
  INNER JOIN t_convocatoria ON (t_estudiante.CON_ID = t_convocatoria.CON_ID)
  INNER JOIN t_prueba ON (t_estudiante.CON_ID = t_prueba.CON_ID)
  AND (t_estudiante.CAT_ID = t_prueba.CAT_ID)
WHERE
  t_estudiante.EST_ID = @EST;


END;

#
# Definition for the `SP_SELECTPREGUNTAASIGNADA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTPREGUNTAASIGNADA`(IN ESTUDIANTE INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @ESTUDIANTE=ESTUDIANTE; 
SELECT 
  t_estudiante.EST_ID,
  t_preguntas.PRE_ID,
  t_preguntas.PRE_PREGUNTA,
  t_preguntas.PRE_OPCION1,
  t_preguntas.PRE_OPCION2,
  t_preguntas.PRE_OPCION3,
  t_preguntas.PRE_OPCION4,
  t_preguntas.PRE_RESPUESTA,  
  t_preguntaasignada.PREA_ID,
   t_tema.TEM_TEMA,  
  t_preguntaasignada.PREA_RESPUESTA,
  t_preguntaasignada.PREA_ESTADO,
  t_preguntaasignada.PREA_PENDIENTE
FROM
  t_preguntaasignada
  INNER JOIN t_estudiante ON (t_preguntaasignada.EST_ID = t_estudiante.EST_ID)
  INNER JOIN t_preguntas ON (t_preguntaasignada.PRE_ID = t_preguntas.PRE_ID) 
  INNER JOIN t_tema ON (t_preguntas.TEM_ID = t_tema.TEM_ID)
WHERE
  t_estudiante.EST_ID = @ESTUDIANTE;

END;

#
# Definition for the `SP_SELECTPREGUNTASASIGNADAS` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTPREGUNTASASIGNADAS`(IN EST INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @EST=EST; 
SELECT 
  t_preguntas.PRE_ID,
  t_preguntas.PRE_PREGUNTA,
  t_preguntas.PRE_OPCION1,
  t_preguntas.PRE_OPCION2,
  t_preguntas.PRE_OPCION3,
  t_preguntas.PRE_OPCION4,
  t_tema.TEM_TEMA,
  t_preguntaasignada.PREA_ESTADO
FROM
  t_preguntas
  INNER JOIN t_preguntaasignada ON (t_preguntas.PRE_ID = t_preguntaasignada.PRE_ID)  INNER JOIN t_tema ON (t_preguntas.TEM_ID = t_tema.TEM_ID)   
  WHERE t_preguntaasignada.EST_ID=EST ;

END;

#
# Definition for the `SP_SELECTPREGUNTASTEMA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTPREGUNTASTEMA`(IN EST INTEGER(11), IN TA_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @EST=EST;
SET @TA_ID=TA_ID;
SELECT 
  t_preguntas.PRE_ID,
  t_preguntas.PRE_PREGUNTA,
  t_preguntas.PRE_OPCION1,
  t_preguntas.PRE_OPCION2,
  t_preguntas.PRE_OPCION3,
  t_preguntas.PRE_OPCION4,
  t_preguntas.PRE_RESPUESTA,
  t_temaasignado.TEM_ID,
  t_temaasignado.TA_ID
FROM
  t_temaasignado
  INNER JOIN t_preguntas ON (t_temaasignado.TEM_ID = t_preguntas.TEM_ID)
  INNER JOIN t_prueba ON (t_temaasignado.PRU_ID = t_prueba.PRU_ID)
  INNER JOIN t_estudiante ON (t_prueba.CAT_ID = t_estudiante.CAT_ID)
  AND (t_prueba.CON_ID = t_estudiante.CON_ID)
WHERE
  t_estudiante.EST_ID = @EST AND t_temaasignado.TEM_ID = @TA_ID;
END;

#
# Definition for the `SP_SELECTPRUEBAS` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTPRUEBAS`(IN CAT_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @CAT_ID=CAT_ID;
SELECT 
  t_convocatoria.CON_FECHA,
  t_categoria.CAT_CATEGORIA,
  t_prueba.PRU_TIEMPO
  

FROM
  t_prueba
  INNER JOIN t_convocatoria ON (t_prueba.CON_ID = t_convocatoria.CON_ID)
  INNER JOIN t_categoria ON (t_prueba.CAT_ID = t_categoria.CAT_ID)
WHERE
  t_categoria.CAT_ID = @CAT_ID;
END;

#
# Definition for the `SP_SELECTPUNTAJE` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTPUNTAJE`(IN EST INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

SELECT
t_categoria.CAT_CATEGORIA,
  t_convocatoria.CON_FECHA,
  t_estudiante.EST_ESTUDIANTE,
  t_prueba.PRU_NUM, 
  COUNT(*) AS PUNTAJE
FROM
  t_estudiante
  INNER JOIN t_categoria ON (t_estudiante.CAT_ID = t_categoria.CAT_ID)
  INNER JOIN t_convocatoria ON (t_estudiante.CON_ID = t_convocatoria.CON_ID)
  INNER JOIN t_prueba ON (t_estudiante.CON_ID = t_prueba.CON_ID)
  AND (t_estudiante.CAT_ID = t_prueba.CAT_ID)
  INNER JOIN t_preguntaasignada ON (t_preguntaasignada.EST_ID = t_estudiante.EST_ID)
  INNER JOIN t_preguntas ON (t_preguntas.PRE_ID = t_preguntaasignada.PRE_ID)
WHERE
  t_preguntaasignada.PREA_RESPUESTA = t_preguntas.PRE_RESPUESTA;
END;

#
# Definition for the `SP_SELECTRESULTADO` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_SELECTRESULTADO`(IN CAT_ID INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @CAT_ID=CAT_ID;
SELECT 
  t_convocatoria.CON_FECHA,
  t_categoria.CAT_CATEGORIA,
  t_estudiante.EST_ESTUDIANTE,
  t_resultado.RES_PUNTAJE,
  t_prueba.PRU_NUM
FROM
  t_resultado
  INNER JOIN t_estudiante ON (t_resultado.EST_ID = t_estudiante.EST_ID)
  INNER JOIN t_prueba ON (t_resultado.PRU_ID = t_prueba.PRU_ID)
  INNER JOIN t_categoria ON (t_prueba.CAT_ID = t_categoria.CAT_ID)
  INNER JOIN t_convocatoria ON (t_prueba.CON_ID = t_convocatoria.CON_ID)
WHERE
  t_prueba.CAT_ID =@CAT_ID;
END;

#
# Definition for the `SP_UPDATERESPUESTA` procedure : 
#

CREATE DEFINER = 'root'@'localhost' PROCEDURE `SP_UPDATERESPUESTA`(IN PREA_ID INTEGER(11), IN PREA_RESPUESTA INTEGER(11))
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SET @PREA_ID=PREA_ID;
SET @PREA_RESPUESTA=PREA_RESPUESTA;

UPDATE 
  t_preguntaasignada  
SET 
  t_preguntaasignada.PREA_RESPUESTA = @PREA_RESPUESTA,   
  t_preguntaasignada.PREA_ESTADO='0'
 
WHERE 
  t_preguntaasignada.PREA_ID = @PREA_ID;
END;

#
# Data for the `t_categoria` table  (LIMIT 0,500)
#

INSERT INTO `t_categoria` (`CAT_ID`, `CAT_CATEGORIA`, `CAT_ESTADO`) VALUES 
  (1,'POSGRADO',1),
  (2,'MAESTRIA',1);

COMMIT;

#
# Data for the `t_tema` table  (LIMIT 0,500)
#

INSERT INTO `t_tema` (`TEM_ID`, `TEM_TEMA`, `TEM_ESTADO`) VALUES 
  (1,'QUIMICA',1),
  (2,'FISICA',1),
  (3,'MATEMATICA',1);

COMMIT;

#
# Data for the `t_categoriatema` table  (LIMIT 0,500)
#

INSERT INTO `t_categoriatema` (`CATTEM_ID`, `CAT_ID`, `TEM_ID`, `CATTEM_ESTADO`) VALUES 
  (1,1,1,1),
  (2,1,2,1),
  (4,1,3,1),
  (5,2,2,1),
  (6,2,1,1),
  (7,2,3,1);

COMMIT;

#
# Data for the `t_convocatoria` table  (LIMIT 0,500)
#

INSERT INTO `t_convocatoria` (`CON_ID`, `CON_FECHA`, `CON_ESTADO`) VALUES 
  (24,'2019-01-05',1),
  (25,'2019-01-05',1);

COMMIT;

#
# Data for the `t_estudiante` table  (LIMIT 0,500)
#

INSERT INTO `t_estudiante` (`EST_ID`, `EST_ESTUDIANTE`, `EST_PASSWORD`, `EST_CEDULA`, `CAT_ID`, `CON_ID`, `EST_ESTADO`, `EST_TIEMPO`) VALUES 
  (68,'ALEX','ALEX','100200300',2,25,1,'17:25:36'),
  (69,'marco','marco','10001234',2,25,1,'17:28:13'),
  (70,'andres','andres','123',2,25,1,'17:47:41'),
  (71,'luis','luis','041020',1,24,0,'17:51:57');

COMMIT;

#
# Data for the `t_preguntas` table  (LIMIT 0,500)
#

INSERT INTO `t_preguntas` (`PRE_ID`, `PRE_PREGUNTA`, `PRE_OPCION1`, `PRE_OPCION2`, `PRE_OPCION3`, `PRE_OPCION4`, `PRE_RESPUESTA`, `PRE_ESTADO`, `TEM_ID`) VALUES 
  (2,'Que significa H2O?','AGUA','OXIGENO','CAFE','COLA',1,1,1),
  (3,'Que significa O?','AGUA','OXIGENO','NITROGENO','COLA',2,1,1),
  (4,'CUANTO ES 2+2?','3','5','4','10',3,1,3),
  (5,'Cuanto es 10 en Decimal?','2','5','60','100',1,1,3),
  (6,'Que es un vector?','Un vector es un agente que transporta algo de un lugar a otro','Un vector es un agente que no transporta algo de un lugar a otro','Una magnitud','Un peso',1,1,2),
  (7,'Que es la fisica?','Una medida cartesiana','es una de las ciencias que estudia  la energía, la materia y el espacio-tiempo','es una ciencia que estudia la tabla periodica','Es un metodo matematico',2,1,2),
  (8,'Que significa Al?','OXIGENO','NITROGENO','ALUMINIO','DIOXIDO DE CARBONO',3,1,1);

COMMIT;

#
# Data for the `t_prueba` table  (LIMIT 0,500)
#

INSERT INTO `t_prueba` (`PRU_ID`, `CON_ID`, `CAT_ID`, `PRU_TIEMPO`, `PRU_ESTADO`) VALUES 
  (10,24,1,'00:03:30',1),
  (11,25,2,'00:01:00',1);

COMMIT;

#
# Data for the `t_temaasignado` table  (LIMIT 0,500)
#

INSERT INTO `t_temaasignado` (`TA_ID`, `PRU_ID`, `TEM_ID`, `TA_NUMPREG`, `TA_ESTADO`) VALUES 
  (18,10,2,1,1),
  (19,10,3,2,1),
  (20,10,1,2,1),
  (21,11,2,2,1),
  (22,11,1,1,1),
  (23,11,3,2,1);

COMMIT;

#
# Data for the `t_preguntaasignada` table  (LIMIT 0,500)
#

INSERT INTO `t_preguntaasignada` (`PREA_ID`, `TA_ID`, `PRE_ID`, `EST_ID`, `PREA_RESPUESTA`, `PREA_ESTADO`, `PREA_PENDIENTE`) VALUES 
  (31,22,3,68,2,1,NULL),
  (32,21,7,68,2,1,NULL),
  (33,21,6,68,3,1,NULL),
  (34,23,4,68,3,1,NULL),
  (35,23,5,68,NULL,0,NULL),
  (36,22,3,69,2,1,NULL),
  (37,21,7,69,2,1,NULL),
  (38,21,6,69,NULL,0,1),
  (39,23,5,69,NULL,0,NULL),
  (40,23,4,69,NULL,0,NULL),
  (41,22,8,70,3,1,NULL),
  (42,21,7,70,2,1,NULL),
  (43,21,6,70,1,1,NULL),
  (44,23,5,70,1,1,NULL),
  (45,23,4,70,3,1,NULL),
  (46,20,3,71,2,1,NULL),
  (47,20,2,71,NULL,0,NULL),
  (48,18,7,71,NULL,0,NULL),
  (49,19,4,71,4,1,NULL),
  (50,19,5,71,1,1,NULL);

COMMIT;

#
# Data for the `t_usuario` table  (LIMIT 0,500)
#

INSERT INTO `t_usuario` (`USU_ID`, `USU_USUARIO`, `USU_PASSWORD`, `CAT_ID`) VALUES 
  (3,'root','root',1),
  (4,'maestria','maestria',2);

COMMIT;

