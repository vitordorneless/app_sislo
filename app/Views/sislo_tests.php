<?php

echo 'oi<br>';
$date1 = '09:00';
$date2 = '11:30';
$date3 = '12:30';
$date4 = '18:21';

$entradas = new \DateTime($date1);
$ida_almocos = new \DateTime($date2);
$volta_almocos = new \DateTime($date3);
$saidas = new \DateTime($date4);

$dateDiff = $entradas->diff($ida_almocos);
$dateDiffs = $volta_almocos->diff($saidas);

$result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';
$results = $dateDiffs->h . ' horas e ' . $dateDiffs->i . ' minutos';

$saida = new DateInterval('PT'.$dateDiffs->h.'H'.$dateDiffs->i.'M');
$saldo = new \Datetime($dateDiff->h . ':' . $dateDiff->i);
$calculosaldo = new \Datetime($dateDiff->h . ':' . $dateDiff->i);
$oitohoras = new DateInterval(('PT08H'));

$saldis = $saldo->add($saida);
$calculosaldo->add($saida);
$horas_extras = $calculosaldo->sub($oitohoras);

$resultss = $saldis->format('H') . ' horas e ' . $saldis->format('i') . ' minutos';
$resultsss = $horas_extras->format('H') . ' horas e ' . $horas_extras->format('i') . ' minutos';
echo $result.'<br>'.$results.'<br>'.$resultss.'<br>'.$resultsss;
