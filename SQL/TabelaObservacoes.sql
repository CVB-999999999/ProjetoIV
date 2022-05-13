CREATE TABLE Observacao (
    idObservacao INT IDENTITY (1,1),
    idProf nchar(50) NOT NULL,
    conteudo VARCHAR(255),
    aprovado INT,
    dataHora DATETIME,
    CONSTRAINT PK_Observacao PRIMARY KEY (idObservacao),
    CONSTRAINT FK_prof FOREIGN KEY (idProf) REFERENCES Utilizador(numero)
)

CREATE TABLE ObservacaoFormulario (
    idObservacao INT NOT NULL,
    idFormulario nchar(50) NOT NULL,
    CONSTRAINT FK_Obs FOREIGN KEY (idObservacao) REFERENCES Observacao(idObservacao),
    CONSTRAINT FK_From FOREIGN KEY (idFormulario) REFERENCES Formulario(id)
)