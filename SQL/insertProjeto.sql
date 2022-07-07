Alter PROCEDURE [dbo].[insertProjeto] @nome nchar(50), @tema varchar(200),
                                       @disciplina nvarchar(255), @ano int, @prof nchar(50), @aluno nchar(50)
AS
DECLARE @maxId AS nchar(50);

SELECT @maxId = max(cast(id as integer)) FROM Projecto;

INSERT INTO Projecto (id, nome, tema, id_Disciplina, estado, ano_letivo)
VALUES (@maxId + 1, @nome, @tema, @disciplina, 0, @ano);

INSERT INTO Utilizador_Projecto(id_projecto, numero_utilizador)
VALUES (@maxId, @prof);

INSERT INTO Utilizador_Projecto(id_projecto, numero_utilizador)
VALUES (@maxId, @aluno);
go
