CREATE TABLE cliente(
	idCliente SERIAL PRIMARY KEY ,
	nome VARCHAR(50),
	cpf VARCHAR(15)
);

CREATE TABLE produto(
	idProduto  SERIAL PRIMARY KEY ,
	nome VARCHAR(50),
	marca varchar(10),
	valor DECIMAL(7,2),
	quantidade INTEGER

);

CREATE TABLE venda(
	idVenda  SERIAL PRIMARY KEY ,
	idCliente INT,
	valorTotal DECIMAL(7,2),
	FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
);

CREATE TABLE itensVenda(
	idItensVenda  SERIAL PRIMARY KEY,
	idVenda INTEGER,
	idProduto INTEGER,
	quantidade DECIMAL(7,2),
	valorUnitario DECIMAL(7,2),
	FOREIGN KEY (idVenda) REFERENCES venda (idVenda),
	FOREIGN KEY (idProduto) REFERENCES produto (idProduto)
);

CREATE OR REPLACE FUNCTION SETAR_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
	UPDATE venda SET valortotal = valortotal + (NEW.quantidade * NEW.valorunitario) WHERE idVenda = NEW.idvenda;
	UPDATE produto SET quantidade = quantidade - NEW.quantidade WHERE idProduto = NEW.idproduto;
  END;
  $$ language plpgsql;
  
CREATE OR REPLACE FUNCTION ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
	UPDATE venda SET valortotal = valortotal - ((OLD.quantidade * OLD.valorunitario) * (NEW.quantidade * NEW.valorunitario)) WHERE idVenda = NEW.idvenda;
	UPDATE produto SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade) WHERE idProduto = NEW.idproduto;
  END;
  $$ language plpgsql;

CREATE OR REPLACE FUNCTION DELETAR_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
  	UPDATE venda SET valortotal = valortotal - (OLD.quantidade * OLD.valorunitario) WHERE idVenda = OLD.idvenda;
	UPDATE produto SET quantidade = quantidade + OLD.quantidade WHERE idProduto = OLD.idproduto;
  END;
  $$ language plpgsql;

CREATE OR REPLACE FUNCTION DELETAR_VENDA() RETURNS TRIGGER AS $$
  BEGIN
  	DELETE FROM itensvenda WHERE idVenda = OLD.idVenda;
  END;
  $$ language plpgsql;

CREATE TRIGGER setaritemvenda
AFTER INSERT ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE SETAR_ITEM_VENDA();

CREATE TRIGGER itemvenda
AFTER UPDATE ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE ITEM_VENDA();

CREATE TRIGGER deletaritemvenda
AFTER DELETE ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE DELETAR_ITEM_VENDA();

CREATE TRIGGER deletarvenda
AFTER DELETE ON venda
FOR EACH ROW EXECUTE PROCEDURE DELETAR_VENDA();















