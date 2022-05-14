CREATE PROCEDURE [dbo].[saveResposta] @idForm nchar(50), @conteudo varchar(200), @idPerg varchar(50)
AS
DECLARE @idUltimaResposta AS int;
DECLARE @idResp AS varchar(50);

begin tran

	SELECT @idResp = id_resposta FROM PerguntasFormulario WHERE id_formulario = @idForm AND id_pergunta = @idPerg

	UPDATE Resposta SET Resposta = @conteudo WHERE id = @idResp

	if @@rowcount = 0

	begin
		INSERT INTO Resposta (Resposta) VALUES (@conteudo)

		SELECT @idUltimaResposta = SCOPE_IDENTITY();

		UPDATE PerguntasFormulario SET id_resposta = @idUltimaResposta WHERE id_formulario = @idForm AND id_pergunta = @idPerg
	end
commit tran
