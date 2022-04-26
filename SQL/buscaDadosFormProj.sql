CREATE PROCEDURE [dbo].[buscaDadosFormProj] @idForm nchar(50)
AS
SELECT f.*, p.* FROM Projecto as p, Formulario f
WHERE p.id = f.id_projecto AND p.id = @idForm