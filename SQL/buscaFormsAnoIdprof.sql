USE [LeadersForFuture]
GO
/****** Object:  StoredProcedure [dbo].[buscaFormsAnoIdprof]    Script Date: 05/07/2022 18:18:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[buscaFormsAnoIdprof] @anoLetivo nchar(50), @idProf int
AS
 SELECT f.* FROM Projecto p, Utilizador_Projecto up, Formulario f WHERE up.numero_utilizador = @idProf and up.id_projecto = p.id and f.id_projecto = p.id and f.ano_letivo = @anoLetivo