CREATE PROCEDURE [dbo].[buscaObs] @idForm nchar(50)
AS
SELECT o.*, u.nome, u.apelido FROM Observacao as o, ObservacaoFormulario as obsF, Utilizador as u
WHERE obsF.idFormulario = @idForm AND o.idObservacao = obsF.idObservacao AND o.idProf = u.numero