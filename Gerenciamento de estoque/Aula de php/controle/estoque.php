<?php
require_once '../modelo/produtoDAO.php';

class ControleEstoqueVideogame {
    private $gerenciadorVideogame;

    public function __construct() {
        $this->gerenciadorVideogame = new GerenciadorVideogame();
    }

    public function listarVideogames() {
        return $this->gerenciadorVideogame->listarTodosVideogames();
    }

    public function adicionarVenda($idVideogame, $quantidade) {
        $this->gerenciadorVideogame->registrarVenda($idVideogame, $quantidade);
    }

    public function adicionarAoEstoque($idVideogame, $quantidade) {
        $this->gerenciadorVideogame->atualizarEstoque($idVideogame, $quantidade);
    }
}
?>
