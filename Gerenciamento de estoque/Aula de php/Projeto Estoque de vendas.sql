CREATE DATABASE SistemaVideogames;
USE SistemaVideogames;

CREATE TABLE videogame (
    idvideogame INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nomeVideogame VARCHAR(50) NOT NULL,
    estoqueVideogame INT NOT NULL
);

CREATE TABLE itensvendas (
    iditensVendas INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    VideogameidVideogame INT NOT NULL,
    quantidadeVendas INT NOT NULL,
    FOREIGN KEY (VideogameidVideogame) REFERENCES videogame(idvideogame)
);

INSERT INTO videogame (nomeVideogame, estoqueVideogame) VALUES ('The Legend of Zelda: Breath of the Wild', 10);
INSERT INTO videogame (nomeVideogame, estoqueVideogame) VALUES ('Super Mario Odyssey', 5);
INSERT INTO videogame (nomeVideogame, estoqueVideogame) VALUES ('Red Dead Redemption 2', 15);

DELIMITER $$
CREATE TRIGGER Tgr_ItensVenda_Insert 
AFTER INSERT ON itensvendas
FOR EACH ROW
BEGIN
    UPDATE videogame 
    SET estoqueVideogame = estoqueVideogame - NEW.quantidadeVendas
    WHERE idvideogame = NEW.VideogameidVideogame;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER Tgr_ItensVenda_Delete 
AFTER DELETE ON itensvendas
FOR EACH ROW
BEGIN
    UPDATE videogame 
    SET estoqueVideogame = estoqueVideogame + OLD.quantidadeVendas
    WHERE idvideogame = OLD.VideogameidVideogame;
END$$
DELIMITER ;

INSERT INTO itensvendas (VideogameidVideogame, quantidadeVendas) VALUES (1, 3);
INSERT INTO itensvendas (VideogameidVideogame, quantidadeVendas) VALUES (2, 1);
INSERT INTO itensvendas (VideogameidVideogame, quantidadeVendas) VALUES (3, 5);
