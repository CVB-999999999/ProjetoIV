CREATE PROCEDURE [dbo].[buscaTodosUtiliz]
AS
SELECT * FROM Utilizador u, TipoUtilizador tu WHERE u.id_tipoUtilizador = tu.id_TipoUtilizador