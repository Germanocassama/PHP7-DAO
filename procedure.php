

CREATE PROCEDURE `sp_usuario_insert` (
pemail varchar(100),
psenha varchar(256)
)
BEGIN
	INSERT INTO usuarios(email, senha)values(pemail, psenha);
    
    SELECT * FROM usuarios WHERE id = LAST_INSERT_ID();
END
