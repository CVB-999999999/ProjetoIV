CREATE PROCEDURE [dbo].[insertObservacao] @idForm nchar(50), @idProf nchar(50), @conteudo varchar(255), @aprovado INT
AS
DECLARE @idUltimaResposta AS int;
INSERT INTO Observacao (idProf, conteudo, aprovado) VALUES (@idProf, @conteudo, @aprovado);
SELECT @idUltimaResposta = MAX(idObservacao) FROM Observacao;
INSERT INTO ObservacaoFormulario(idFormulario, idObservacao) VALUES (@idForm, @idProf)