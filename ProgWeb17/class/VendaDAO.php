<?php

require_once 'Banco.php';
require_once 'Venda.php';
require_once 'Usuario.php';

class VendaDAO {

    public function salvar($venda) {
        $situacao = FALSE;
        try {

            if ($venda->getId() == 0) {

                $situacao = $this->incluir($venda);
            } else {
                $situacao = $this->atualizar($venda);
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        }

        return $situacao;
    }

    public function incluir($venda) {
        $situacao = FALSE;
        try {

            $pdo = Banco::conectar();

            $sql = "INSERT INTO tbVenda (cliente, cpf, dataVenda, total) VALUES (:cliente, :cpf, :dataVenda, :total)";
            $run = $pdo->prepare($sql);


            $run->bindParam(':cliente', $venda->getCliente(), PDO::PARAM_STR);
            $run->bindParam(':cpf', $venda->getCpf(), PDO::PARAM_STR);
            $run->bindParam(':dataVenda', $venda->getDataVenda());
            $run->bindParam(':total', $venda->getTotal(), PDO::PARAM_INT);

            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }

            $venda->setId($pdo->lastInsertId());
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $situacao;
    }

    public function atualizar($venda) {
        $situacao = FALSE;
        try {

            /* @var $pdo type */
            $pdo = Banco::conectar();

            $sql = "UPDATE tbVenda SET cliente = :cliente, cpf = :cpf, dataVenda = :dataVenda, total = :total  WHERE id = :id";
            $run = $pdo->prepare($sql);


            $run->bindParam(':cliente', $venda->getCliente(), PDO::PARAM_STR);
            $run->bindParam(':cpf', $venda->getCpf(), PDO::PARAM_STR);
            $run->bindParam(':dataVenda', $venda->getDataVenda(), PDO::PARAM_STR);
            $run->bindParam(':total', $venda->getTotal(), PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $situacao;
    }

    public function excluir($venda) {

        $situacao = FALSE;
        try {

            $pdo = Banco::conectar();

            $sql = "DELETE FROM tbVenda WHERE id = :id";


            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $venda->getId(), PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $situacao;
    }

    public function excluirPorId($codigo) {

        $situacao = FALSE;
        try {

            $pdo = Banco::conectar();

            $sql = "DELETE FROM tbVenda WHERE id = :id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $codigo, PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $situacao;
    }

    public function listar() {

        $objetos = array();

        try {

            $pdo = Banco::conectar();

            $sql = "SELECT * FROM tbVenda";

            $run = $pdo->prepare($sql);
            $run->execute();
            $resultado = $run->fetchAll();

            foreach ($resultado as $objeto) {

                $venda = new Venda();
                $venda->setId($objeto['id']);
                $venda->setCliente($objeto['cliente']);
                $venda->setCpf($objeto['cpf']);
                $venda->setDataVenda($objeto['dataVenda']);
                $venda->setTotal($objeto['total']);
                array_push($objetos, $venda);
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $objetos;
    }

    public function buscarPorId($codigo) {

        $venda = new Venda();

        try {

            $pdo = Banco::conectar();

            $sql = "SELECT * FROM tbVenda WHERE id = :id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $codigo, PDO::PARAM_INT);
            $run->execute();
            $resultado = $run->fetch();

            $venda->setId($$resultado['id']);
            $venda->setCliente($resultado['cliente']);
            $venda->setCpf($resultado['cpf']);
            $venda->setDataVenda($resultado['dataVenda']);
            $venda->setTotal($resultado['total']);
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $venda;
    }

    public function autenticar($login, $senha) {

        $usuario = new Usuario();

        try {

            $pdo = Banco::conectar();

            $sql = "SELECT * FROM tbUsuario WHERE login = :login AND senha = :senha";

            $run = $pdo->prepare($sql);
            $run->bindParam(':login', $login, PDO::PARAM_STR);
            $run->bindParam(':senha', $senha, PDO::PARAM_STR);
            $run->execute();
            $resultado = $run->fetch();

            $usuario = new Usuario();
            $usuario->setIdUsuario($resultado['idUsuario']);
            $usuario->setLogin($resultado['login']);
            $usuario->setSenha($resultado['senha']);
            $usuario->setEmail($resultado['email']);
            $usuario->setUltimoAcesso($resultado['ultimoAcesso']);
            $usuario->setSituacao($resultado['situacao']);
            $usuario->setIdGrupoAcesso($resultado['idGrupoAcesso']);
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $usuario;
    }

    public function verificarLogin($codigo, $login) {

        $situacao = TRUE;
        try {

            $pdo = Banco::conectar();

            $sql = "SELECT * FROM tbUsuario WHERE idUsuario <> :idUsuario AND login = :login";

            $run = $pdo->prepare($sql);
            $run->bindParam(':idUsuario', $codigo, PDO::PARAM_INT);
            $run->bindParam(':login', $login, PDO::PARAM_STR);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = FALSE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $situacao;
    }

    public function registrarAutenticacao($usuario) {
        $situacao = FALSE;
        try {

            $pdo = Banco::conectar();

            $sql = "UPDATE tbUsuario SET ultimoAcesso = NOW() WHERE idUsuario = :idUsuario";

            $run = $pdo->prepare($sql);
            $run->bindParam(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $situacao;
    }

}

?>