CREATE PROCEDURE [dbo].[buscaFormsAnoIdprof] @anoLetivo nchar(50), @idProf int
AS
 SELECT f.* FROM Projecto p, Utilizador_Projecto up, Formulario f WHERE up.numero_utilizador = @idProf and up.id_projecto = p.id and f.id_projecto = p.id and f.ano_letivo = @anoLetivo