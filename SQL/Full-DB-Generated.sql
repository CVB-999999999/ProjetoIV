create table Curso
(
    cd_curso         nvarchar(255) not null,
    nm_curso         nvarchar(255),
    ativo            nvarchar(255),
    ds_grau          nvarchar(255),
    sigla            nvarchar(255),
    unidade_organica nvarchar(255),
    constraint PK_Curso
        primary key (cd_curso)
)
go

create table Disciplina
(
    cd_discip nvarchar(255) not null,
    ds_discip nvarchar(255),
    ativo     nvarchar(255),
    sigla     nvarchar(255),
    constraint PK_Disciplina
        primary key (cd_discip)
)
go

create table Email
(
    id                 int identity,
    email_destinario   nvarchar(50),
    id_formulario      nvarchar(50),
    nome_projecto      nvarchar(50),
    estado             nvarchar(100),
    numero_utilizador  nvarchar(50),
    nome_utilizador    nvarchar(50),
    apelido_utilizador nvarchar(50),
    dataEnvio          datetime,
    constraint PK_Email
        primary key (id)
)
go

create table Pergunta
(
    id       nchar(50) not null,
    Pergunta nvarchar(2000),
    constraint PK_Pergunta
        primary key (id)
)
go

create table Projecto
(
    id            nchar(50)     not null,
    nome          varchar(100),
    id_Disciplina nvarchar(255) not null,
    tema          nvarchar(200),
    ano_letivo    int,
    semestre      bit,
    estado        bit,
    constraint PK_Projeto
        primary key (id),
    constraint [Disciplina->Projecto]
        foreign key (id_Disciplina) references Disciplina
)
go

create table Resposta
(
    id       int identity,
    Resposta nvarchar(4000),
    constraint PK_Resposta
        primary key (id)
)
go

create table TemplatesHTML
(
    id         int identity,
    codigoHTML nchar(3000),
    descricao  nchar(100),
    constraint PK_TemplatesHTML
        primary key (id)
)
go

create table TipoFormulario
(
    id        nchar(50) not null,
    descricao nvarchar(50),
    constraint PK_TipoFormulario
        primary key (id)
)
go

create table Formulario
(
    id              nchar(50) not null,
    estado          nvarchar(10),
    tipo_formulario nchar(50),
    id_projecto     nchar(50) not null,
    ano_letivo      nchar(50),
    ano_curricular  int,
    semestre        bit,
    constraint PK_Formulario
        primary key (id),
    constraint [Projecto->Formulario]
        foreign key (id_projecto) references Projecto,
    constraint [TipoFormulario->Formulario]
        foreign key (tipo_formulario) references TipoFormulario
)
go

create table PerguntasFormulario
(
    id_formulario nchar(50) not null,
    id_pergunta   nchar(50) not null,
    id_resposta   int,
    constraint [Formulario->PerguntasFormulario]
        foreign key (id_formulario) references Formulario,
    constraint [Pergunta->PerguntasFormulario]
        foreign key (id_pergunta) references Pergunta,
    constraint [Resposta->PerguntasFormulario]
        foreign key (id_resposta) references Resposta
)
go

create table TipoUtilizador
(
    id_TipoUtilizador nchar(20) not null,
    descricao         nchar(20),
    constraint PK_TipoUtilizador
        primary key (id_TipoUtilizador)
)
go

create table Utilizador
(
    numero            nchar(50) not null,
    password          nvarchar(100),
    nome              nvarchar(50),
    apelido           nvarchar(50),
    nif               nvarchar(9),
    id_tipoUtilizador nchar(20) not null,
    email             nvarchar(50),
    username          nvarchar(50),
    remember_token    nvarchar(100),
    constraint PK_Utilizador
        primary key (numero),
    constraint [Tipo_Utilizador->Utilizador]
        foreign key (id_tipoUtilizador) references TipoUtilizador
)
go

create table Observacao
(
    idObservacao int identity,
    idProf       nchar(50) not null,
    conteudo     nvarchar(2000),
    aprovado     int,
    dataHora     datetime,
    constraint PK_Observacao
        primary key (idObservacao),
    constraint FK_prof
        foreign key (idProf) references Utilizador
)
go

create table ObservacaoFormulario
(
    idObservacao int       not null,
    idFormulario nchar(50) not null,
    constraint FK_From
        foreign key (idFormulario) references Formulario,
    constraint FK_Obs
        foreign key (idObservacao) references Observacao
)
go

create table Utilizador_Projecto
(
    id_projecto       nchar(50),
    numero_utilizador nchar(50),
    constraint [Projeto->Utilizador_Projeto]
        foreign key (id_projecto) references Projecto,
    constraint [Utilizador->Utilizador_Projecto]
        foreign key (numero_utilizador) references Utilizador
)
go

create table cursos_disciplinas
(
    cd_curso  nvarchar(255) not null,
    cd_discip nvarchar(255) not null,
    constraint [Curso->Cursos_Disciplinas]
        foreign key (cd_curso) references Curso,
    constraint [Disciplina->Cursos_Disciplinas]
        foreign key (cd_discip) references Disciplina
)
go

create table sysdiagrams
(
    name         sysname not null,
    principal_id int     not null,
    diagram_id   int identity,
    version      int,
    definition   varbinary(max),
    primary key (diagram_id),
    constraint UK_principal_name
        unique (principal_id, name)
)
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'TABLE', 'sysdiagrams'
go

create table tempExecBuscaFormularios
(
    nomeProjeto     nchar(30),
    tipo_formulario nchar(10),
    nome            nchar(30),
    apelido         nchar(30),
    numero          nchar(30),
    id              nchar(10),
    estado          nchar(30)
)
go

CREATE PROCEDURE [dbo].[alterarEstadoForm] @estadoNovo nvarchar(10), @idForm nchar(50)
AS
UPDATE Formulario SET estado = @estadoNovo where id = @idForm
go

CREATE PROCEDURE [dbo].[buscaAlunosForms] @idForm nchar(50)
AS
SELECT u.* FROM Utilizador as u, Utilizador_Projecto as up, Projecto as p
WHERE p.id = up.id_projecto AND p.id = @idForm AND up.numero_utilizador = u.numero
go

CREATE PROCEDURE [dbo].[buscaAlunosForms1] @idForm nchar(50)
AS
SELECT u.* FROM Utilizador as u, Utilizador_Projecto as up, Projecto as p, Formulario as f
WHERE p.id = up.id_projecto AND f.id = @idForm AND up.numero_utilizador = u.numero and p.id = f.id_projecto
go

CREATE PROCEDURE [dbo].[buscaAlunosProj] @idProj nchar(50)
AS
SELECT u.* FROM Utilizador u, Utilizador_Projecto up WHERE up.id_projecto = @idProj AND up.numero_utilizador = u.numero
go

CREATE PROCEDURE [dbo].[buscaCursoForm] @idForm nchar(50)
AS
SELECT d.ds_discip, c.nm_curso, c.ds_grau FROM Projecto as p, Formulario as f, Disciplina d, cursos_disciplinas cd, Curso c 
WHERE p.id = f.id_projecto AND p.id = @idForm AND p.id_Disciplina = d.cd_discip AND d.cd_discip = cd.cd_discip AND cd.cd_curso = c.cd_curso
go

CREATE PROCEDURE [dbo].[buscaCursoForm1] @idForm nchar(50)
AS
SELECT d.ds_discip, c.nm_curso, c.ds_grau FROM Projecto as p, Formulario as f, Disciplina d, cursos_disciplinas cd, Curso c 
WHERE p.id = f.id_projecto AND f.id = @idForm AND p.id_Disciplina = d.cd_discip AND d.cd_discip = cd.cd_discip AND cd.cd_curso = c.cd_curso
go

CREATE PROCEDURE [dbo].[buscaDadosFormProj] @idForm nchar(50)
AS
SELECT f.*, p.* FROM Projecto as p, Formulario f
WHERE p.id = f.id_projecto AND p.id = @idForm
go

CREATE PROCEDURE [dbo].[buscaDadosFormProj1] @idForm nchar(50)
AS
SELECT p.*, f.* FROM Projecto as p, Formulario f
WHERE p.id = f.id_projecto AND f.id = @idForm
go

-- ================================================
-- Template generated from Template Explorer using:
-- Create Procedure (New Menu).SQL
--
-- Use the Specify Values for Template Parameters 
-- command (Ctrl-Shift-M) to fill in the parameter 
-- values below.
--
CREATE PROCEDURE [dbo].[buscaEstado] @idForm nchar(50)
AS
SELECT estado  FROm Formulario 
WHERE id = @idForm
go

CREATE PROCEDURE [dbo].[buscaFormsAnoIdprof] @anoLetivo nchar(50), @idProf int
AS
 SELECT f.* FROM Projecto p, Utilizador_Projecto up, Formulario f WHERE up.numero_utilizador = @idProf and up.id_projecto = p.id and f.id_projecto = p.id and f.ano_letivo = @anoLetivo
go

CREATE PROCEDURE [dbo].[buscaFormsAnoLetivo] @anoLetivo nchar(50)
AS
SELECT * FROM Formulario as f WHERE ano_letivo = @anoLetivo
go

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
go

CREATE PROCEDURE [dbo].[buscaFormulariosAsAluno] @numeroAluno nchar(50)
AS

DECLARE @idFormulario nchar(50)

DECLARE cursor_busca_projectoAlunos CURSOR FOR
SELECT p.id FROM Projecto AS p INNER JOIN Formulario f ON f.id_projecto=p.id INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero WHERE u.numero = @numeroAluno

OPEN cursor_busca_projectoAlunos
FETCH NEXT FROM cursor_busca_projectoAlunos INTO @idFormulario

WHILE @@FETCH_STATUS = 0
	BEGIN 
	
	
SELECT p.nome, f.tipo_formulario, u.nome, u.apelido FROM Projecto AS p INNER JOIN Formulario f ON f.id_projecto=p.id INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero WHERE p.id = @idFormulario AND u.id_tipoUtilizador = 2                                                                                              

	FETCH NEXT FROM cursor_busca_projectoAlunos INTO @idFormulario
END

	CLOSE cursor_busca_projectoAlunos
	DEALLOCATE cursor_busca_projectoAlunos

go

CREATE PROCEDURE [dbo].[buscaFormulariosAsAluno2] @username nchar(50), @anoLetivo nchar(50), @semestre bit
AS

DECLARE @idFormulario nchar(50)


DECLARE cursor_busca_projectoAlunos CURSOR FOR
SELECT p.id FROM Projecto AS p 
INNER JOIN Formulario f ON f.id_projecto=p.id 
INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  
INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero 
WHERE u.username = @username 
AND f.ano_letivo = @anoLetivo 
AND f.semestre = @semestre

OPEN cursor_busca_projectoAlunos
FETCH NEXT FROM cursor_busca_projectoAlunos INTO @idFormulario

WHILE @@FETCH_STATUS = 0
    BEGIN
	
	
SELECT p.nome as nomeprojeto, f.tipo_formulario, CONCAT (u.nome,' ', u.apelido) AS nomeUtilizador, u.numero as numeroUtilizador,f.id, f.estado FROM Projecto AS p 
INNER JOIN Formulario f ON f.id_projecto=p.id 
INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  
INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero 
WHERE p.id = @idFormulario 
AND u.id_tipoUtilizador = 1                                                                                              

	FETCH NEXT FROM cursor_busca_projectoAlunos INTO @idFormulario
END

	CLOSE cursor_busca_projectoAlunos
	DEALLOCATE cursor_busca_projectoAlunos

go

CREATE PROCEDURE [dbo].[buscaFormulariosAsProfessor] 
AS

SELECT nomeProjeto, tipo_formulario, CONCAT( nome, ' ', apelido) AS nomeUtilizador, numero AS numeroUtilizador, id FROM tempExecBuscaFormularios

go

CREATE PROCEDURE [dbo].[buscaFormulariosAsProfessor2] @username nchar(50), @anoLetivo nchar(50), @semestre bit
AS

TRUNCATE TABLE tempExecBuscaFormularios

DECLARE @idFormulario nchar(50)
DECLARE @nomeProjeto nchar(30)
DECLARE @tipo_formulario nchar(10)
DECLARE @nome nchar(30)
DECLARE @numero nchar(30)
DECLARE @apelido nchar(30)
DECLARE @estado nchar(30)

DECLARE cursor_busca_projectoProfessor CURSOR FOR
SELECT p.id FROM Projecto AS p 
INNER JOIN Formulario f ON f.id_projecto=p.id 
INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  
INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero 
WHERE u.username = @username 
AND f.ano_letivo = @anoLetivo 
AND f.semestre = @semestre

OPEN cursor_busca_projectoProfessor
FETCH NEXT FROM cursor_busca_projectoProfessor INTO @idFormulario

WHILE @@FETCH_STATUS = 0
	BEGIN 
	
SELECT  @nomeProjeto=p.nome, @tipo_formulario=f.tipo_formulario, @nome=u.nome, @apelido=u.apelido, @numero=u.numero, @idFormulario=p.id, @estado=f.estado FROM Projecto AS p 
INNER JOIN Formulario f ON f.id_projecto=p.id 
INNER JOIN Utilizador_Projecto AS up ON p.id=up.id_projecto  
INNER JOIN Utilizador AS u ON up.numero_utilizador=u.numero 
WHERE p.id = @idFormulario 
AND u.id_tipoUtilizador = 2                                                                                           

INSERT INTO tempExecBuscaFormularios VALUES (@nomeProjeto, @tipo_formulario, @nome, @apelido, @numero, @idFormulario, @estado)

	FETCH NEXT FROM cursor_busca_projectoProfessor INTO @idFormulario

END

	CLOSE cursor_busca_projectoProfessor
	DEALLOCATE cursor_busca_projectoProfessor

SELECT nomeProjeto, tipo_formulario, CONCAT( nome, ' ', apelido) AS nomeUtilizador, numero AS numeroUtilizador  FROM tempExecBuscaFormularios

go

CREATE PROCEDURE [dbo].[buscaFormularios_CondAnoLetivo] @anoLet int
AS
SELECT p.nome, u.numero, u.nome, f.tipo_formulario FROM Projecto AS p INNER JOIN Formulario f ON f.id_projecto=p.id INNER JOIN Utilizador_Projecto up ON p.id=up.id_projecto INNER JOIN Utilizador AS u ON up.numero_utilizador=numero WHERE f.ano_letivo = @anoLet
go

CREATE PROCEDURE [dbo].[buscaObs] @idForm nchar(50)
AS
SELECT o.*, u.nome, u.apelido FROM Observacao as o, ObservacaoFormulario as obsF, Utilizador as u
WHERE obsF.idFormulario = @idForm AND o.idObservacao = obsF.idObservacao AND o.idProf = u.numero
go

CREATE PROCEDURE [dbo].[buscaPerguntasCondForm] @idForm varchar(50)
AS
SELECT p.pergunta, p.id FROM Pergunta p 
INNER JOIN PerguntasFormulario pf ON pf.id_pergunta=p.id 
WHERE pf.id_formulario=@idForm
go

Create PROCEDURE buscaPerguntasRespostasCondForm @idForm varchar(50)
AS
SELECT p.pergunta, p.id, r.Resposta, r.id FROM Pergunta p 
INNER JOIN PerguntasFormulario pf ON pf.id_pergunta=p.id 
INNER JOIN Resposta r ON pf.id_resposta=r.id 
WHERE pf.id_formulario=@idForm
go

CREATE PROCEDURE [dbo].[buscaProjProf] @idProf numeric
AS
SELECT p.* FROM Utilizador_Projecto up, Projecto p WHERE up.numero_utilizador = @idProf and up.id_projecto = p.id;
go

Create PROCEDURE [dbo].[buscaProjetos]
AS
SELECT *  From Projecto
go

Create PROCEDURE buscaRespostasCondForm @idForm varchar(50)
AS
SELECT r.Resposta, r.id FROM Resposta r 
INNER JOIN PerguntasFormulario pf ON pf.id_resposta=r.id 
WHERE pf.id_formulario=@idForm
go

Create PROCEDURE buscaRespostasForm @idForm varchar(50)
AS
SELECT r.Resposta, r.id FROM Resposta r 
RIGHT JOIN PerguntasFormulario pf ON pf.id_resposta=r.id 
WHERE pf.id_formulario=@idForm
go

CREATE PROCEDURE [dbo].[buscaTipoForm]
AS
SELECT *  From TipoFormulario
go

CREATE PROCEDURE [dbo].[buscaTodosAlunos]
AS
SELECT * FROM Utilizador u WHERE u.id_tipoUtilizador = 2
go

CREATE PROCEDURE [dbo].[buscaTodosDadosForms] @idForm nchar(50)
AS

SELECT p.*, f.* FROM Projecto p, Utilizador_Projecto up, Formulario f
WHERE p.id = up.id_projecto AND up.numero_utilizador = @idForm AND p.id = f.id_projecto
ORDER BY id_Disciplina
go

CREATE PROCEDURE [dbo].[buscaTodosUtiliz]
AS
SELECT * FROM Utilizador u, TipoUtilizador tu WHERE u.id_tipoUtilizador = tu.id_TipoUtilizador
go

CREATE PROCEDURE [dbo].[buscaUser_username_pw] @username nchar(50), @pw nchar(50)
AS
SELECT u.nome, u.numero, u.apelido, u.id_tipoUtilizador as tipo  FROM Utilizador AS u 
WHERE u.username = @username AND u.password = @pw;
go

CREATE PROCEDURE [dbo].[buscaUtiliz] @num nchar(50)
AS
SELECT * FROM Utilizador u, TipoUtilizador tu WHERE u.id_tipoUtilizador = tu.id_TipoUtilizador AND u.numero = @num
go


	CREATE FUNCTION dbo.fn_diagramobjects() 
	RETURNS int
	WITH EXECUTE AS N'dbo'
	AS
	BEGIN
		declare @id_upgraddiagrams		int
		declare @id_sysdiagrams			int
		declare @id_helpdiagrams		int
		declare @id_helpdiagramdefinition	int
		declare @id_creatediagram	int
		declare @id_renamediagram	int
		declare @id_alterdiagram 	int 
		declare @id_dropdiagram		int
		declare @InstalledObjects	int

		select @InstalledObjects = 0

		select 	@id_upgraddiagrams = object_id(N'dbo.sp_upgraddiagrams'),
			@id_sysdiagrams = object_id(N'dbo.sysdiagrams'),
			@id_helpdiagrams = object_id(N'dbo.sp_helpdiagrams'),
			@id_helpdiagramdefinition = object_id(N'dbo.sp_helpdiagramdefinition'),
			@id_creatediagram = object_id(N'dbo.sp_creatediagram'),
			@id_renamediagram = object_id(N'dbo.sp_renamediagram'),
			@id_alterdiagram = object_id(N'dbo.sp_alterdiagram'), 
			@id_dropdiagram = object_id(N'dbo.sp_dropdiagram')

		if @id_upgraddiagrams is not null
			select @InstalledObjects = @InstalledObjects + 1
		if @id_sysdiagrams is not null
			select @InstalledObjects = @InstalledObjects + 2
		if @id_helpdiagrams is not null
			select @InstalledObjects = @InstalledObjects + 4
		if @id_helpdiagramdefinition is not null
			select @InstalledObjects = @InstalledObjects + 8
		if @id_creatediagram is not null
			select @InstalledObjects = @InstalledObjects + 16
		if @id_renamediagram is not null
			select @InstalledObjects = @InstalledObjects + 32
		if @id_alterdiagram  is not null
			select @InstalledObjects = @InstalledObjects + 64
		if @id_dropdiagram is not null
			select @InstalledObjects = @InstalledObjects + 128
		
		return @InstalledObjects 
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'FUNCTION', 'fn_diagramobjects'
go

deny execute on fn_diagramobjects to guest
go

grant execute on fn_diagramobjects to [public]
go

CREATE PROCEDURE [dbo].[insertObservacao] @idForm nchar(50), @idProf nchar(50), @conteudo varchar(255), @aprovado INT
AS
DECLARE @idUltimaResposta AS int;

INSERT INTO Observacao (idProf, conteudo, aprovado, dataHora) VALUES (@idProf, @conteudo, @aprovado, CURRENT_TIMESTAMP);

SELECT @idUltimaResposta = SCOPE_IDENTITY();

INSERT INTO ObservacaoFormulario(idFormulario, idObservacao) VALUES (@idForm, @idUltimaResposta)
go

CREATE PROCEDURE [dbo].[insertProjeto] @nome nchar(50), @tema varchar(200),
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



CREATE PROCEDURE [dbo].[insertResposta] @resposta nchar(200)
AS
INSERT INTO Resposta (Resposta) VALUES (@resposta)
go



CREATE PROCEDURE [dbo].[insertResposta2] @resposta nchar(200), @id_pergunta nchar(50), @id_formulario nchar(50)
AS
DECLARE @idUltimaResposta AS int;
INSERT INTO Resposta (Resposta) VALUES (@resposta);
SELECT @idUltimaResposta = MAX(id) FROM Resposta;

UPDATE PerguntasFormulario set id_resposta = @idUltimaResposta WHERE id_formulario = @id_formulario AND id_pergunta = @id_pergunta
go

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
go


	CREATE PROCEDURE dbo.sp_alterdiagram
	(
		@diagramname 	sysname,
		@owner_id	int	= null,
		@version 	int,
		@definition 	varbinary(max)
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
	
		declare @theId 			int
		declare @retval 		int
		declare @IsDbo 			int
		
		declare @UIDFound 		int
		declare @DiagId			int
		declare @ShouldChangeUID	int
	
		if(@diagramname is null)
		begin
			RAISERROR ('Invalid ARG', 16, 1)
			return -1
		end
	
		execute as caller;
		select @theId = DATABASE_PRINCIPAL_ID();	 
		select @IsDbo = IS_MEMBER(N'db_owner'); 
		if(@owner_id is null)
			select @owner_id = @theId;
		revert;
	
		select @ShouldChangeUID = 0
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname 
		
		if(@DiagId IS NULL or (@IsDbo = 0 and @theId <> @UIDFound))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1);
			return -3
		end
	
		if(@IsDbo <> 0)
		begin
			if(@UIDFound is null or USER_NAME(@UIDFound) is null) -- invalid principal_id
			begin
				select @ShouldChangeUID = 1 ;
			end
		end

		-- update dds data			
		update dbo.sysdiagrams set definition = @definition where diagram_id = @DiagId ;

		-- change owner
		if(@ShouldChangeUID = 1)
			update dbo.sysdiagrams set principal_id = @theId where diagram_id = @DiagId ;

		-- update dds version
		if(@version is not null)
			update dbo.sysdiagrams set version = @version where diagram_id = @DiagId ;

		return 0
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE', 'sp_alterdiagram'
go

deny execute on sp_alterdiagram to guest
go

grant execute on sp_alterdiagram to [public]
go


	CREATE PROCEDURE dbo.sp_creatediagram
	(
		@diagramname 	sysname,
		@owner_id		int	= null, 	
		@version 		int,
		@definition 	varbinary(max)
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
	
		declare @theId int
		declare @retval int
		declare @IsDbo	int
		declare @userName sysname
		if(@version is null or @diagramname is null)
		begin
			RAISERROR (N'E_INVALIDARG', 16, 1);
			return -1
		end
	
		execute as caller;
		select @theId = DATABASE_PRINCIPAL_ID(); 
		select @IsDbo = IS_MEMBER(N'db_owner');
		revert; 
		
		if @owner_id is null
		begin
			select @owner_id = @theId;
		end
		else
		begin
			if @theId <> @owner_id
			begin
				if @IsDbo = 0
				begin
					RAISERROR (N'E_INVALIDARG', 16, 1);
					return -1
				end
				select @theId = @owner_id
			end
		end
		-- next 2 line only for test, will be removed after define name unique
		if EXISTS(select diagram_id from dbo.sysdiagrams where principal_id = @theId and name = @diagramname)
		begin
			RAISERROR ('The name is already used.', 16, 1);
			return -2
		end
	
		insert into dbo.sysdiagrams(name, principal_id , version, definition)
				VALUES(@diagramname, @theId, @version, @definition) ;
		
		select @retval = @@IDENTITY 
		return @retval
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE', 'sp_creatediagram'
go

deny execute on sp_creatediagram to guest
go

grant execute on sp_creatediagram to [public]
go


	CREATE PROCEDURE dbo.sp_dropdiagram
	(
		@diagramname 	sysname,
		@owner_id	int	= null
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
		declare @theId 			int
		declare @IsDbo 			int
		
		declare @UIDFound 		int
		declare @DiagId			int
	
		if(@diagramname is null)
		begin
			RAISERROR ('Invalid value', 16, 1);
			return -1
		end
	
		EXECUTE AS CALLER;
		select @theId = DATABASE_PRINCIPAL_ID();
		select @IsDbo = IS_MEMBER(N'db_owner'); 
		if(@owner_id is null)
			select @owner_id = @theId;
		REVERT; 
		
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname 
		if(@DiagId IS NULL or (@IsDbo = 0 and @UIDFound <> @theId))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1)
			return -3
		end
	
		delete from dbo.sysdiagrams where diagram_id = @DiagId;
	
		return 0;
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE', 'sp_dropdiagram'
go

deny execute on sp_dropdiagram to guest
go

grant execute on sp_dropdiagram to [public]
go


	CREATE PROCEDURE dbo.sp_helpdiagramdefinition
	(
		@diagramname 	sysname,
		@owner_id	int	= null 		
	)
	WITH EXECUTE AS N'dbo'
	AS
	BEGIN
		set nocount on

		declare @theId 		int
		declare @IsDbo 		int
		declare @DiagId		int
		declare @UIDFound	int
	
		if(@diagramname is null)
		begin
			RAISERROR (N'E_INVALIDARG', 16, 1);
			return -1
		end
	
		execute as caller;
		select @theId = DATABASE_PRINCIPAL_ID();
		select @IsDbo = IS_MEMBER(N'db_owner');
		if(@owner_id is null)
			select @owner_id = @theId;
		revert; 
	
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname;
		if(@DiagId IS NULL or (@IsDbo = 0 and @UIDFound <> @theId ))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1);
			return -3
		end

		select version, definition FROM dbo.sysdiagrams where diagram_id = @DiagId ; 
		return 0
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE',
     'sp_helpdiagramdefinition'
go

deny execute on sp_helpdiagramdefinition to guest
go

grant execute on sp_helpdiagramdefinition to [public]
go


	CREATE PROCEDURE dbo.sp_helpdiagrams
	(
		@diagramname sysname = NULL,
		@owner_id int = NULL
	)
	WITH EXECUTE AS N'dbo'
	AS
	BEGIN
		DECLARE @user sysname
		DECLARE @dboLogin bit
		EXECUTE AS CALLER;
			SET @user = USER_NAME();
			SET @dboLogin = CONVERT(bit,IS_MEMBER('db_owner'));
		REVERT;
		SELECT
			[Database] = DB_NAME(),
			[Name] = name,
			[ID] = diagram_id,
			[Owner] = USER_NAME(principal_id),
			[OwnerID] = principal_id
		FROM
			sysdiagrams
		WHERE
			(@dboLogin = 1 OR USER_NAME(principal_id) = @user) AND
			(@diagramname IS NULL OR name = @diagramname) AND
			(@owner_id IS NULL OR principal_id = @owner_id)
		ORDER BY
			4, 5, 1
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE', 'sp_helpdiagrams'
go

deny execute on sp_helpdiagrams to guest
go

grant execute on sp_helpdiagrams to [public]
go


	CREATE PROCEDURE dbo.sp_renamediagram
	(
		@diagramname 		sysname,
		@owner_id		int	= null,
		@new_diagramname	sysname
	
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
		declare @theId 			int
		declare @IsDbo 			int
		
		declare @UIDFound 		int
		declare @DiagId			int
		declare @DiagIdTarg		int
		declare @u_name			sysname
		if((@diagramname is null) or (@new_diagramname is null))
		begin
			RAISERROR ('Invalid value', 16, 1);
			return -1
		end
	
		EXECUTE AS CALLER;
		select @theId = DATABASE_PRINCIPAL_ID();
		select @IsDbo = IS_MEMBER(N'db_owner'); 
		if(@owner_id is null)
			select @owner_id = @theId;
		REVERT;
	
		select @u_name = USER_NAME(@owner_id)
	
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname 
		if(@DiagId IS NULL or (@IsDbo = 0 and @UIDFound <> @theId))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1)
			return -3
		end
	
		-- if((@u_name is not null) and (@new_diagramname = @diagramname))	-- nothing will change
		--	return 0;
	
		if(@u_name is null)
			select @DiagIdTarg = diagram_id from dbo.sysdiagrams where principal_id = @theId and name = @new_diagramname
		else
			select @DiagIdTarg = diagram_id from dbo.sysdiagrams where principal_id = @owner_id and name = @new_diagramname
	
		if((@DiagIdTarg is not null) and  @DiagId <> @DiagIdTarg)
		begin
			RAISERROR ('The name is already used.', 16, 1);
			return -2
		end		
	
		if(@u_name is null)
			update dbo.sysdiagrams set [name] = @new_diagramname, principal_id = @theId where diagram_id = @DiagId
		else
			update dbo.sysdiagrams set [name] = @new_diagramname where diagram_id = @DiagId
		return 0
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE', 'sp_renamediagram'
go

deny execute on sp_renamediagram to guest
go

grant execute on sp_renamediagram to [public]
go


	CREATE PROCEDURE dbo.sp_upgraddiagrams
	AS
	BEGIN
		IF OBJECT_ID(N'dbo.sysdiagrams') IS NOT NULL
			return 0;
	
		CREATE TABLE dbo.sysdiagrams
		(
			name sysname NOT NULL,
			principal_id int NOT NULL,	-- we may change it to varbinary(85)
			diagram_id int PRIMARY KEY IDENTITY,
			version int,
	
			definition varbinary(max)
			CONSTRAINT UK_principal_name UNIQUE
			(
				principal_id,
				name
			)
		);


		/* Add this if we need to have some form of extended properties for diagrams */
		/*
		IF OBJECT_ID(N'dbo.sysdiagram_properties') IS NULL
		BEGIN
			CREATE TABLE dbo.sysdiagram_properties
			(
				diagram_id int,
				name sysname,
				value varbinary(max) NOT NULL
			)
		END
		*/

		IF OBJECT_ID(N'dbo.dtproperties') IS NOT NULL
		begin
			insert into dbo.sysdiagrams
			(
				[name],
				[principal_id],
				[version],
				[definition]
			)
			select	 
				convert(sysname, dgnm.[uvalue]),
				DATABASE_PRINCIPAL_ID(N'dbo'),			-- will change to the sid of sa
				0,							-- zero for old format, dgdef.[version],
				dgdef.[lvalue]
			from dbo.[dtproperties] dgnm
				inner join dbo.[dtproperties] dggd on dggd.[property] = 'DtgSchemaGUID' and dggd.[objectid] = dgnm.[objectid]	
				inner join dbo.[dtproperties] dgdef on dgdef.[property] = 'DtgSchemaDATA' and dgdef.[objectid] = dgnm.[objectid]
				
			where dgnm.[property] = 'DtgSchemaNAME' and dggd.[uvalue] like N'_EA3E6268-D998-11CE-9454-00AA00A3F36E_' 
			return 2;
		end
		return 1;
	END
    
go

exec sp_addextendedproperty 'microsoft_database_tools_support', 1, 'SCHEMA', 'dbo', 'PROCEDURE', 'sp_upgraddiagrams'
go


