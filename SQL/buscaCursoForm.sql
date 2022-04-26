CREATE PROCEDURE [dbo].[buscaCursoForm] @idForm nchar(50)
AS
SELECT d.ds_discip, c.nm_curso, c.ds_grau FROM Projecto as p, Formulario as f, Disciplina d, cursos_disciplinas cd, Curso c 
WHERE p.id = f.id_projecto AND p.id = @idForm AND p.id_Disciplina = d.cd_discip AND d.cd_discip = cd.cd_discip AND cd.cd_curso = c.cd_curso