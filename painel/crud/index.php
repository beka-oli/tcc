<?php
require_once __DIR__ . '/../verifica_login.php';
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../_layout.php';
$modulos = require __DIR__ . '/../config_crud/modulos.php';
$modulo = $_GET['modulo'] ?? 'autores';
if (!isset($modulos[$modulo])) { http_response_code(404); exit('Módulo não encontrado.'); }
$c = $modulos[$modulo];
$tabela = $c['tabela']; $chave = $c['chave'];
$busca = trim((string)($_GET['busca'] ?? ''));
$edicao = null;

if (isset($_GET['editar'])) {
    $id = filter_var($_GET['editar'], FILTER_VALIDATE_INT);
    if (!$id) exit('ID inválido.');
    $st = $conexao->prepare("SELECT * FROM `$tabela` WHERE `$chave` = ? LIMIT 1");
    $st->bind_param('i', $id); $st->execute(); $edicao = $st->get_result()->fetch_assoc(); $st->close();
    if (!$edicao) exit('Registro não encontrado.');
}

$where = ''; $params = []; $types = '';
if ($busca !== '' && $c['pesquisa']) {
    $parts=[]; foreach ($c['pesquisa'] as $campo) { $parts[] = "`$campo` LIKE ?"; $params[]='%'.$busca.'%'; $types.='s'; }
    $where=' WHERE '.implode(' OR ',$parts);
}
$sql="SELECT * FROM `$tabela`$where ORDER BY `$chave` DESC";
$st=$conexao->prepare($sql); if($params) $st->bind_param($types,...$params); $st->execute(); $rows=$st->get_result()->fetch_all(MYSQLI_ASSOC); $st->close();
$msg=flash('ok'); $erro=flash('erro');
?><!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=h($c['titulo'])?> | Painel ADM</title><?php include __DIR__.'/../includes_painel/head.php'; ?></head><body><?php include __DIR__.'/../includes_painel/header.php'; ?>
<div class="container py-4"><div class="d-flex justify-content-between align-items-center mb-3"><div><h2 class="mb-1"><?=h($c['titulo'])?></h2><p class="text-muted mb-0">Cadastro e gerenciamento em uma única tela.</p></div><a class="btn btn-primary" href="?modulo=<?=h($modulo)?>&novo=1">+ Novo <?=h($c['singular'])?></a></div>
<?php if($msg): ?><div class="alert alert-success"><?=h($msg)?></div><?php endif; ?><?php if($erro): ?><div class="alert alert-danger"><?=h($erro)?></div><?php endif; ?>
<?php if(isset($_GET['novo']) || $edicao): ?><div class="card mb-4"><div class="card-header"><strong><?= $edicao ? 'Editar' : 'Novo' ?> <?=h($c['singular'])?></strong></div><div class="card-body"><form method="post" action="salvar.php"><input type="hidden" name="modulo" value="<?=h($modulo)?>"><?php if($edicao): ?><input type="hidden" name="id" value="<?=h($edicao[$chave])?>"><?php endif; ?><?=csrf_field()?><div class="row">
<?php foreach($c['campos'] as $campo=>$cfg): $valor=$edicao[$campo]??''; $cls=$cfg['tipo']==='textarea'?'col-12':'col-md-6'; ?><div class="<?=$cls?> mb-3"><label class="form-label"><?=h($cfg['label'])?></label><?php if($cfg['tipo']==='textarea'): ?><textarea class="form-control" name="<?=h($campo)?>" rows="4" <?=!empty($cfg['obrigatorio'])?'required':''?>><?=h($valor)?></textarea><?php elseif($cfg['tipo']==='select'): ?><select class="form-select" name="<?=h($campo)?>" <?=!empty($cfg['obrigatorio'])?'required':''?>><?php foreach($cfg['opcoes'] as $op): ?><option value="<?=h($op)?>" <?=$valor!=='' && (string)$valor===(string)$op?'selected':''?>><?=h($op==='0'?'Não':($op==='1'?'Sim':$op))?></option><?php endforeach; ?></select><?php else: ?><input class="form-control" type="<?=h($cfg['tipo'])?>" name="<?=h($campo)?>" value="<?=h($valor)?>" <?=!empty($cfg['obrigatorio'])?'required':''?>><?php endif; ?></div><?php endforeach; ?></div><button class="btn btn-primary">Salvar</button> <a class="btn btn-secondary" href="?modulo=<?=h($modulo)?>">Cancelar</a></form></div></div><?php endif; ?>
<form class="card card-body mb-3" method="get"><input type="hidden" name="modulo" value="<?=h($modulo)?>"><div class="row g-2"><div class="col-md-10"><input class="form-control" name="busca" value="<?=h($busca)?>" placeholder="Pesquisar..."></div><div class="col-md-2 d-flex gap-2"><button class="btn btn-outline-primary w-100">Buscar</button><a class="btn btn-outline-secondary" href="?modulo=<?=h($modulo)?>">Limpar</a></div></div></form>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>ID</th><?php foreach($c['campos'] as $campo=>$cfg): ?><th><?=h($cfg['label'])?></th><?php endforeach; ?><th>Ações</th></tr></thead><tbody><?php foreach($rows as $row): ?><tr><td><?=h($row[$chave])?></td><?php foreach($c['campos'] as $campo=>$cfg): ?><td><?=h(mb_strimwidth((string)($row[$campo]??''),0,80,'...','UTF-8'))?></td><?php endforeach; ?><td class="text-nowrap"><a class="btn btn-sm btn-outline-primary" href="?modulo=<?=h($modulo)?>&editar=<?=h($row[$chave])?>">Editar</a><form method="post" action="excluir.php" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este registro?');"><input type="hidden" name="modulo" value="<?=h($modulo)?>"><input type="hidden" name="id" value="<?=h($row[$chave])?>"><?=csrf_field()?><button class="btn btn-sm btn-outline-danger">Excluir</button></form></td></tr><?php endforeach; ?><?php if(!$rows): ?><tr><td colspan="99" class="text-center py-4">Nenhum registro encontrado.</td></tr><?php endif; ?></tbody></table></div></div></div><?php include __DIR__.'/../includes_painel/footer.php'; ?></body></html>
