<?php
require_once __DIR__ . '/../verifica_login.php'; require_once __DIR__ . '/../conexao.php'; require_once __DIR__ . '/../_layout.php';
$modulos=require __DIR__.'/../config_crud/modulos.php'; verify_csrf();
$modulo=$_POST['modulo']??''; $id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
if(!isset($modulos[$modulo])||!$id) exit('Solicitação inválida.'); $c=$modulos[$modulo];
try{$st=$conexao->prepare("DELETE FROM `{$c['tabela']}` WHERE `{$c['chave']}`=?");$st->bind_param('i',$id);$st->execute();$st->close();flash('ok',$c['singular'].' excluído com sucesso.');}catch(Throwable $e){flash('erro','Não foi possível excluir. O registro pode possuir dados relacionados.');}redirect('index.php?modulo='.$modulo);
