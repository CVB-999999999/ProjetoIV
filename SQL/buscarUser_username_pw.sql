USE [projeto7]
GO
/****** Object:  StoredProcedure [dbo].[buscaUser_username_pw]    Script Date: 27/04/2022 17:49:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[buscaUser_username_pw] @username nchar(50), @pw nchar(50)
AS
SELECT u.nome, u.numero, u.apelido, u.id_tipoUtilizador as tipo  FROM Utilizador AS u 
WHERE u.username = @username AND u.password = @pw;