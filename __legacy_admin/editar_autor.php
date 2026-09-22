<?php include 'verifica_login.php'; include 'conexao.php'; include '_layout.php';
$id=id_get('id');
if($_SERVER['REQUEST_METHOD']==='POST'){
 $nome=esc($conexao,$_POST['nome']??''); $email=esc($conexao,$_POST['email']??''); $instituicao=esc($conexao,$_POST['instituicao']??''); $especialidade=esc($conexao,$_POST['especialidade']??'');
 if($nome==='') erro('Informe o nome do autor.');
 $ok=mysqli_query($conexao,"UPDATE autores SET nome='$nome', email='$email', instituicao='$instituicao', especialidade='$especialidade' WHERE id_autor=$id");
 if(!$ok) erro(mysqli_error($conexao)); redirect('lista_autores.php');
}
$r=mysqli_query($conexao,"SELECT * FROM autores WHERE id_autor=$id"); if(!$r||mysqli_num_rows($r)!==1) erro('Autor não encontrado.'); $row=mysqli_fetch_assoc($r);
?><!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><title>Editar Autor</title><?php include 'includes_painel/head.php'; ?><?php include '_form_style.php'; ?></head><body><?php include 'includes_painel/header.php'; ?><div class="crud"><div class="card"><h1>Editar Autor</h1><form method="post"><div class="grid"><div class="campo"><label>Nome</label><input name="nome" required value="<?=h($row['nome'])?>"></div><div class="campo"><label>E-mail</label><input type="email" name="email" value="<?=h($row['email']??'')?>"></div><div class="campo"><label>Instituição</label><input name="instituicao" value="<?=h($row['instituicao']??'')?>"></div><div class="campo"><label>Especialidade</label><input name="especialidade" value="<?=h($row['especialidade']??'')?>"></div></div><div class="acoes"><button class="btn salvar">Salvar alterações</button><a class="btn voltar" href="lista_autores.php">Cancelar</a></div></form></div></div></body></html>
