<?php
class ConexaoBanco {
    private static $conexao;

    public static function getInstance() {
        if (!isset(self::$conexao)) {
            try {
                self::$conexao = new PDO('mysql:host=localhost;dbname=SistemaVideogames', 'root', ''); // Ajuste usuário e senha conforme necessário
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$conexao;
    }
}
?>
