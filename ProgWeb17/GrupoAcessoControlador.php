<?php

require_once 'class/GrupoAcessoDAO.php';
$grupoAcessoDAO = new GrupoAcessoDAO();
$grupoAcesso = new GrupoAcesso();

/* @var $_GET type */
$operacao = $_GET["operacao"];

switch ($operacao) {
    case 'salvar':

        $grupoAcesso->setIdGrupoAcesso($_POST["idGrupoAcesso"]);
        $grupoAcesso->setDescricao($_POST["descricao"]);
        $resultado = $grupoAcessoDAO->salvar($grupoAcesso);

        if ($resultado == 1) {
            echo "<script>alert('Registro salvo com sucesso !!!'); location.href='GrupoAcessoTabela.php';</script>";
        } else {
            echo "<script>alert('Erro ao salvar o registro'); location.href='GrupoAcessoTabela.php';</script>";
        }

        break;

    case 'excluir':

        $resultado = $grupoAcessoDAO->excluirPorId($_GET["idGrupoAcesso"]);

        if ($resultado == 1) {
            echo "<script>alert('Registro excluido com sucesso !!!'); location.href='GrupoAcessoTabela.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir o registro'); location.href='GrupoAcessoTabela.php';</script>";
        }
        break;
}
?>