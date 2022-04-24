CREATE PROCEDURE [dbo].[buscaFormsDados] @userAluno nchar(50)
AS

DECLARE @idFormulario nchar(50)

DECLARE cursor_busca_buscaFormsDados CURSOR FOR
SELECT p.id FROM Projecto AS p INNER JOIN Formulario f ON f.id_projecto=p.id INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero WHERE u.username = @userAluno

OPEN cursor_busca_buscaFormsDados
FETCH NEXT FROM cursor_busca_buscaFormsDados INTO @idFormulario

WHILE @@FETCH_STATUS = 0
	BEGIN 
	
	
SELECT p.nome as Pnome, f.tipo_formulario as tForm, p.ano_letivo as anoInicio, p.estado, f.ano_curricular, f.semestre, f.estado, f.id FROM Projecto AS p INNER JOIN Formulario f ON f.id_projecto=p.id INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero WHERE p.id = @idFormulario AND u.id_tipoUtilizador = 2                                                                                              

	FETCH NEXT FROM cursor_busca_buscaFormsDados INTO @idFormulario
END

	CLOSE cursor_busca_buscaFormsDados
	DEALLOCATE cursor_busca_buscaFormsDados