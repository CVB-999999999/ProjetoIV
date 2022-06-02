CREATE PROCEDURE [dbo].[buscaTodosDadosForms] @idForm nchar(50)
AS

SELECT p.*, f.* FROM Projecto p, Utilizador_Projecto up, Formulario f
WHERE p.id = up.id_projecto AND up.numero_utilizador = @idForm AND p.id = f.id_projecto
ORDER BY id_Disciplina