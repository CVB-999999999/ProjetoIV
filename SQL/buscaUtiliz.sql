CREATE PROCEDURE [dbo].[buscaUtiliz] @num nchar(50)
AS
SELECT * FROM Utilizador u, TipoUtilizador tu WHERE u.id_tipoUtilizador = tu.id_TipoUtilizador AND u.numero = @num