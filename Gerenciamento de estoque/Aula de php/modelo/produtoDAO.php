<?php
require_once 'conexao.php';

class GerenciadorVideogame {
    private $conexao;

    public function __construct() {
        $this->conexao = ConexaoBanco::getInstance();
    }

    public function listarTodosVideogames() {
        $sql = "SELECT idvideogame, nomeVideogame, estoqueVideogame FROM videogame";
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarVenda($idVideogame, $quantidade) {
        $sql = "INSERT INTO itensvendas (VideogameidVideogame, quantidadeVendas) VALUES (:idVideogame, :quantidade)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':idVideogame', $idVideogame);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
    }

    public function atualizarEstoque($idVideogame, $quantidade) {
        $sql = "UPDATE videogame SET estoqueVideogame = estoqueVideogame + :quantidade WHERE idvideogame = :idVideogame";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':idVideogame', $idVideogame);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->execute();
    }
}
?>
