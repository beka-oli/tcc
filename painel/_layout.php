<?php
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function id_get($key){ $id=filter_input(INPUT_GET,$key,FILTER_VALIDATE_INT); if(!$id||$id<1){ die('ID inválido.'); } return $id; }
function redirect($url){ header('Location: '.$url); exit; }
function erro($msg){ die('<div style="font-family:Arial;padding:30px;color:#9b1735;background:#fff0f3;border:1px solid #f5b5c2;border-radius:12px;margin:30px"><h3>Erro</h3><p>'.h($msg).'</p><a href="javascript:history.back()">Voltar</a></div>'); }
function esc($db,$v){ return mysqli_real_escape_string($db, trim((string)$v)); }
?>
