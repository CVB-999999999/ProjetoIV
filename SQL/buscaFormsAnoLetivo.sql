CREATE PROCEDURE [dbo].[buscaFormsAnoLetivo] @anoLetivo nchar(50)
AS
SELECT * FROM Formulario as f WHERE ano_letivo = @anoLetivo
