/* Asignar etiqueta 5 a todas las preguntas de los tests 32 y 33 */
INSERT INTO pregunta_etiqueta (etiqueta_id, pregunta_id)
SELECT 5, id
FROM preguntas
WHERE test_id IN (32,33);
