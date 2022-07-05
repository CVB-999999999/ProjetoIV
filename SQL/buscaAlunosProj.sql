CREATE PROCEDURE [dbo].[buscaAlunosProj] @idProj nchar(50)
AS
SELECT u.* FROM Utilizador u, Utilizador_Projecto up WHERE up.id_projecto = @idProj AND up.numero_utilizador = u.numero