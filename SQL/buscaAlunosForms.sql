CREATE PROCEDURE [dbo].[buscaAlunosForms] @idForm nchar(50)
AS
SELECT u.* FROM Utilizador as u, Utilizador_Projecto as up, Projecto as p
WHERE p.id = up.id_projecto AND p.id = @idForm AND up.numero_utilizador = u.numero