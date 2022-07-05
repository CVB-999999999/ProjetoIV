USE [LeadersForFuture]
GO
/****** Object:  StoredProcedure [dbo].[buscaAlunosProj]    Script Date: 05/07/2022 18:17:28 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[buscaAlunosProj] @idProj nchar(50)
AS
SELECT u.* FROM Utilizador u, Utilizador_Projecto up WHERE up.id_projecto = @idProj AND up.numero_utilizador = u.numero