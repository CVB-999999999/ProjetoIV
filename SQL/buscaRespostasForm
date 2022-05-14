Create PROCEDURE buscaRespostasForm @idForm varchar(50)
AS
SELECT r.Resposta, pf.id_pergunta FROM Resposta r 
RIGHT JOIN PerguntasFormulario pf ON pf.id_resposta=r.id 
WHERE pf.id_formulario=1