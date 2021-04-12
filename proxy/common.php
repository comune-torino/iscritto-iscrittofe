<?php

function getCf() {
	$cf = isset($_GET['cf']) ? $_GET['cf'] : '';
	return $cf = ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA') ? strtoupper($cf) : strtoupper($_SESSION['ISCRIZIONI']['user']['codice_fiscale']);
}

function dataFromCf($cf) {
	$data = '';
	if (preg_match("/^[a-zA-Z]{6}\d{2}[a-zA-Z]\d{2}[a-zA-Z]\d{3}[a-zA-Z]$/", $cf)) {
		$anno = (substr($cf, 6, 2) >= date('y')) ? '19' : '20'; // anno
		$anno .= substr($cf, 6, 2);
		$mesi = array('01'=>'A', '02'=>'B', '03'=>'C', '04'=>'D', '05'=>'E', '06'=>'H', '07'=>'L', '08'=>'M', '09'=>'P', '10'=>'R', '11'=>'S', '12'=>'T'); // mese
		$mese = array_search(substr($cf, 8, 1), $mesi);
		$giorno = (substr($cf, 9, 2) > 40) ? substr($cf, 9, 2) - 40 : substr($cf, 9, 2); // giorno
		if (checkdate($mese, $giorno, $anno)) {
			$data = "$giorno/$mese/$anno";
		}
	}
	return $data;
}

function sessoFromCf($cf) {
	$sesso = '';
	$giorno = substr($cf, 9, 2);
	if (($giorno > 0 && $giorno <= 31) || ($giorno > 40 && $giorno <= 71)) {
		$sesso = ($giorno > 40) ? "F" : "M"; // sesso
	}
	return $sesso;
}

function loadFamiglia() {
	$famiglia =	array(
								'richiedente' => [],
								'maggiorenni' => [],
								'minorenni' => [],
								'minorenniNido' => [],
								'minorenniMaterna' => [],
								'residenza' => '',
								'annoLimiteNido' => '',
								'anniScolasticiMaterna' => ''
							);
	$cf = getCf();
	if ($cf != '') {
		$path = PATH."/anagrafica/dettaglio-famiglia/".$cf;
		$nao = @file_get_contents($path);
		if ($nao !== false) {
			//$nao = '{"status":{"status":"200","errors":null},"result":{"dettaglioFamiglia":{"richiedente":{"anagrafica":{"nome":"FRANCESCA","cognome":"PASINATO","codiceFiscale":"PSNFNC88E57E379J","dataNascita":"17/05/1988","oraMinutiNascita":"00:00","sesso":"F"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001125","descComune":"IVREA"},"iscrizioneNido":false,"iscrizioneMaterna":null,"numeroIndividuale":"R66863306","anni":31,"richiedente":true,"coniugeRichiedente":false,"numeroIndividualeConiuge":"R49699645"},"coniuge":{"anagrafica":{"nome":"DAVIDE","cognome":"FERRARA","codiceFiscale":"FRRDVD88L21L219V","dataNascita":"21/07/1988","oraMinutiNascita":"20:20","sesso":"M"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO"},"iscrizioneNido":false,"iscrizioneMaterna":null,"numeroIndividuale":"R49699645","anni":31,"richiedente":false,"coniugeRichiedente":true,"numeroIndividualeConiuge":"R66863306"},"maggiorenni":[{"anagrafica":{"nome":"DAVIDE","cognome":"FERRARA","codiceFiscale":"FRRDVD88L21L219V","dataNascita":"21/07/1988","oraMinutiNascita":"20:20","sesso":"M"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO"},"iscrizioneNido":false,"iscrizioneMaterna":null,"numeroIndividuale":"R49699645","anni":31,"richiedente":false,"coniugeRichiedente":true,"numeroIndividualeConiuge":"R66863306"}],"minorenni":[{"anagrafica":{"nome":"MIRIAM","cognome":"FERRARA","codiceFiscale":"FRRMRM13H66L219T","dataNascita":"26/06/2013","oraMinutiNascita":"02:01","sesso":"F"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO"},"iscrizioneNido":false,"iscrizioneMaterna":null,"numeroIndividuale":"R67107166","anni":6,"richiedente":false,"coniugeRichiedente":null,"numeroIndividualeConiuge":null},{"anagrafica":{"nome":"ANGELO","cognome":"FERRARA","codiceFiscale":"FRRNGL15M23L219R","dataNascita":"23/08/2015","oraMinutiNascita":"12:42","sesso":"M"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO"},"iscrizioneNido":true,"iscrizioneMaterna":["2019-2020"],"numeroIndividuale":"R67709188","anni":4,"richiedente":false,"coniugeRichiedente":null,"numeroIndividualeConiuge":null},{"anagrafica":{"nome":"BEATRICE","cognome":"FERRARA","codiceFiscale":"FRRBRC16P70L219A","dataNascita":"30/09/2016","oraMinutiNascita":"17:10","sesso":"F"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO"},"iscrizioneNido":false,"iscrizioneMaterna":["2019-2020","2020-2021"],"numeroIndividuale":"R68011349","anni":3,"richiedente":false,"coniugeRichiedente":null,"numeroIndividualeConiuge":null},{"anagrafica":{"nome":"ELISABETTA","cognome":"FERRARA","codiceFiscale":"FRRLBT18M42L219L","dataNascita":"02/08/2018","oraMinutiNascita":"03:15","sesso":"F"},"luogoNascita":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO"},"iscrizioneNido":true,"iscrizioneMaterna":null,"numeroIndividuale":"R68505835","anni":1,"richiedente":false,"coniugeRichiedente":null,"numeroIndividualeConiuge":null}],"residenzaFamiglia":{"codNazione":"000","descNazione":"ITALIA","codRegione":"01","descRegione":"PIEMONTE","codProvincia":"001","descProvincia":"TORINO","codComune":"001272","descComune":"TORINO","cap":10124,"indirizzo":"VIA MONTEBELLO, 29","idCircoscrizione":7,"descCircoscrizione":"Aurora, Vanchiglia - Sassi - Madonna del Pilone"}},"annoLimiteNido":2019,"annoLimiteMaterna":{"2019-2020":2019,"2020-2021":2020},"erroreNao":false}}';
			$componenti = json_decode($nao, true);
			array_walk_recursive($componenti, function (&$item, $key) {
				$item = null === $item ? "" : $item;
			});

			if ($componenti['status']['status'] != '200') {
				return array('status' => $componenti['status']['status'], 'error' => 'Errore nella chiamata al servizio: '. $componenti['status']['errors'][0]['code']);
			}			
			else {
				if ($componenti['result']['erroreNao']) {
					return array('status' => '500', 'error' => 'Errore servizio NAO');
				}
				else {
					if ($componenti['result']['dettaglioFamiglia'] && $componenti['result']['dettaglioFamiglia']['richiedente'] != '') {
						$famiglia['richiedente'] = array (
																				'anagrafica' => $componenti['result']['dettaglioFamiglia']['richiedente']['anagrafica'],
																				'luogoNascita' => $componenti['result']['dettaglioFamiglia']['richiedente']['luogoNascita']
																			);
						if (count($componenti['result']['dettaglioFamiglia']['maggiorenni'])) {
							foreach ($componenti['result']['dettaglioFamiglia']['maggiorenni'] as $maggiorenne) {
								$famiglia['maggiorenni'][] =	array(
																								'anagrafica' =>	$maggiorenne['anagrafica'],
																								'luogoNascita' =>	$maggiorenne['luogoNascita']
																							);
							}
						}
						if (count($componenti['result']['dettaglioFamiglia']['minorenni'])) {
							foreach ($componenti['result']['dettaglioFamiglia']['minorenni'] as $minorenne) {
								$famiglia['minorenni'][] = $arrayMinorenne = array(
																						'anagrafica' =>	$minorenne['anagrafica'],
																						'luogoNascita' =>	$minorenne['luogoNascita'],
																						);
								if ($minorenne['iscrizioneNido']) {
									$famiglia['minorenniNido'][] = $arrayMinorenne;
								}
								if (count($minorenne['iscrizioneMaterna'])) {
									foreach($minorenne['iscrizioneMaterna'] as $anno) {
										if (isset($componenti['result']['anniScolasticiMaterna'][$anno])) {
											$famiglia['minorenniMaterna'][$anno][] = $arrayMinorenne;
										}
									}
								}
							}
						}
						unset($componenti['result']['dettaglioFamiglia']['residenzaFamiglia']['idCircoscrizione']);
						unset($componenti['result']['dettaglioFamiglia']['residenzaFamiglia']['descCircoscrizione']);
						$famiglia['residenza'] = $componenti['result']['dettaglioFamiglia']['residenzaFamiglia'];
					}
					else if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA') {
						$famiglia['richiedente']['anagrafica'] =	array(
																												'nome' => $_SESSION['ISCRIZIONI']['user']['nome'],
																												'cognome' => $_SESSION['ISCRIZIONI']['user']['cognome'],
																												'codiceFiscale' => $_SESSION['ISCRIZIONI']['user']['codice_fiscale'],
																												'dataNascita' => dataFromCf($_SESSION['ISCRIZIONI']['user']['codice_fiscale']),
																												'sesso' => sessoFromCf($_SESSION['ISCRIZIONI']['user']['codice_fiscale']),
																												'codiceCittadinanza' => '',
																												'descrizioneCittadinanza' => ''
																											);
					}
					else {
						$famiglia['richiedente']['anagrafica'] =	array(
																												'nome' => '',
																												'cognome' => '',
																												'codiceFiscale' => $cf,
																												'dataNascita' => dataFromCf($cf),
																												'sesso' => sessoFromCf($cf),
																												'codiceCittadinanza' => '',
																												'descrizioneCittadinanza' => ''
																											);
					}
					$famiglia['annoLimiteNido'] = $componenti['result']['annoLimiteNido'];
					uasort($componenti['result']['anniScolasticiMaterna'], function($a, $b) {
							return $a['annoLimite'] - $b['annoLimite'];
					});					
					$famiglia['anniScolasticiMaterna'] = $componenti['result']['anniScolasticiMaterna'];
				}
			}
		}
		else {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
	}
	return array('status' => '200', 'famiglia' => $famiglia);
}

function loadStatiRegioni() {
	$pathStati = PATH."/stati/attivi";
	$rest = @file_get_contents($pathStati);
	if ($rest === false) {
		return array('status' => '500', 'error' => 'Errore nella chiamata al servizio STATI');
	}
	else {
		$statiTemp = json_decode($rest, true);
		if ($statiTemp['status']['status'] != '200') {
			return array('status' => $statiTemp['status']['status'], 'error' => 'Errore nella chiamata al servizio STATI: '. $statiTemp['status']['errors'][0]['code']);
		}
		else {
			$cittadinanza[] = array( 'codice' => '000', 'descrizione' => 'ITALIA' );
			for ($i = 0; $i <= count($statiTemp['result']); $i++) {
				if ($statiTemp['result'][$i]['codice'] == '000') {
					unset($statiTemp['result'][$i]);
				}
				else {
					$cittadinanza[] =	array(
															'codice' => $statiTemp['result'][$i]['codice'],
															'descrizione' => $statiTemp['result'][$i]['cittadinanza']
														);
					unset($statiTemp['result'][$i]['cittadinanza']);
				}
			}
			array_unshift($statiTemp['result'], array( 'codice' => '000', 'descrizione' => 'ITALIA' ));
			$pathRegioni = PATH."/regioni/attive";
			$rest = @file_get_contents($pathRegioni);
			if ($rest === false) {
				return array('status' => '500', 'error' => 'Errore nella chiamata al servizio REGIONI');
			}
			else {
				$regioniTemp = json_decode($rest, true);
				if ($regioniTemp['status']['status'] != '200') {
					return array('status' => $regioniTemp['status']['status'], 'error' => 'Errore nella chiamata al servizio REGIONI: '. $regioniTemp['status']['errors'][0]['code']);
				}
				else {
					$stati = $statiTemp['result'];
					$regioni = $regioniTemp['result'];
					return array('status' => '200', 'stati' => $stati, 'regioni' => $regioni, 'cittadinanza' => $cittadinanza);
				}
			}
		}
	}
}

function loadProvince() {
	if (is_numeric($_GET['regione'])) {
		$path = PATH."/province/attive/istat-regione/".$_GET['regione'];
		$rest = @file_get_contents($path);
		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
		else {
			$provinceTemp = json_decode($rest, true);
			if ($provinceTemp['status']['status'] != '200') {
				return array('status' => $provinceTemp['status']['status'], 'error' => 'Errore nella chiamata al servizio: '. $provinceTemp['status']['errors'][0]['code']);			
			}
			else {
				return array('status' => '200' , 'province' => $provinceTemp['result']);
			}
		}
	}
	else {
		return array('status' => '500', 'error' => 'Codice Regione non corretto');
	}
}

function loadComuni() {
	if (is_numeric($_GET['provincia'])) {
		$path = PATH."/comuni/attivi/istat-provincia/".$_GET['provincia'];
		$rest = @file_get_contents($path);
		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
		else {
			$comuniTemp = json_decode($rest, true);
			if ($comuniTemp['status']['status'] != '200') {
				return array('status' => $comuniTemp['status']['status'], 'error' => 'Errore nella chiamata al servizio: '. $comuniTemp['status']['errors'][0]['code']);						
			}
			else {
				return array('status' => '200' , 'comuni' => $comuniTemp['result']);
			}
		}
	}
	else {
		return array('status' => '500', 'error' => 'Codice Provincia non corretto');
	}
}

function checkPeriodi() {
	$path = PATH."/controlli/giorni-lavorati";
	$data = file_get_contents("php://input");
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/json",
			'method'  => 'POST',
			'content' => $data
		)
	);
	$context = stream_context_create($options);
	$rest = @file_get_contents($path, false, $context);
	if ($rest === false) {
		return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
	}	
	else {
		$giorni = json_decode($rest, true);
		if ($giorni['status']['status'] != '200') {
			return array('status' => $giorni['status']['status'], 'error' => 'Errore nella chiamata al servizio: '. $giorni['status']['errors'][0]['code']);						
		}
		else {
			return array('status' => '200', 'giorni' => $giorni['result']);
		}
	}
}

function saveFiles() {
	if (is_numeric($_GET['idDomanda'])) {
		define('MULTIPART_BOUNDARY', '--------------------------'.microtime(true));
		$content = '';
		foreach (array_keys($_FILES) as $key) {
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$file_contents = file_get_contents($_FILES[$key]['tmp_name']);
				$file_name = preg_replace('/[^a-z0-9\.]+/', '_', strtolower($_FILES[$key]['name']));
				$content .=	"--".MULTIPART_BOUNDARY."\r\n".
										"Content-Disposition:form-data;name=\"".$key."\";filename=\"".basename($file_name)."\"\r\n".
										"Content-Type: ".$_FILES[$key]['type']."\r\n\r\n".
										$file_contents."\r\n";
			}
		}
		if ($content != '') {
			$cf = getCf();
			$content .= "--".MULTIPART_BOUNDARY."--\r\n";
			$header = 'Content-Type:multipart/form-data;boundary='.MULTIPART_BOUNDARY;
			$context = stream_context_create(array(
				'http' => array(
					'method' => 'POST',
					'header' => $header,
					'content' => $content,
				)
			));
			$path = PATH."/allegati/multipart/".$_GET['idDomanda']."/".$cf;
			$rest = @file_get_contents($path, false, $context);

			if ($rest === false) {
				return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
			}	
			else {
				$result = json_decode($rest, true);
				if ($result['status']['status'] != '200') {
					return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
				}
				else {
					return array('status' => '200', 'descrizione' => 'Salvataggio corretto dei file');
				}
			}
		}
		else {
			return array('status' => '200', 'descrizione' => 'Nessun file da salvare');
		}
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');
	}
}

function loadFile() {
	if (is_numeric($_GET['idDomanda'])) {
		if (is_numeric($_GET['idDocumento'])) {
			$cf = getCf();
			$path = PATH."/allegati/".$_GET['idDomanda']."/".$_GET['idDocumento']."/".$cf;
			$rest = @file_get_contents($path);
			if ($rest === false) {
				header('HTTP/1.1 500 Internal Server Error');
			}
			else {
				echo $rest;
			}
		}
		else {
			header('HTTP/1.1 500 Internal Server Error');
		}
	}
	else {
		header('HTTP/1.1 500 Internal Server Error');
	}
	exit();
}

function checkNotificatore() {
	if ($_SESSION['ISCRIZIONI']['user']['profilazione'][$_GET['check']] === true ||
		 ($_SESSION['ISCRIZIONI']['user']['profilazione'][$_GET['check']] === false &&
			$_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' && 
			$_GET['idDomanda'] != '' && $_GET['bozza'] == '')) {
		if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' && !preg_match("/AAAAAA00A11V000D/", $_SESSION['ISCRIZIONI']['user']['rappresentazione'])) {
			$identita = urlencode($_SESSION['ISCRIZIONI']['user']['rappresentazione'].'/'.$_SESSION['ISCRIZIONI']['user']['mac']);
			$path = PATH."/utente/info?identita=".$identita;
			$rest = @file_get_contents($path);
			if ($rest === false) {
				return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
			}
			else {
				$check = json_decode($rest, true);
				if ($check['status']['status'] != '200') {
					return array('status' => $check['status']['status'], 'error' => 'Errore nella chiamata al servizio: '. $check['status']['errors'][0]['code']);
				}
				else {
					return array('status' => '200' , 'check' => $check['result']);
				}
			}
		}
		else {
			return array('status' => '200' , 'check' => array('sms' => ''));
		}
	}
	else {
		return array('status' => '403', 'body' => $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_'.$_GET['check']], 'error' => MSG_NO_ACCESSO);
	}
}

function loadRicevuta() {
	if (is_numeric($_GET['idDomanda'])) {
		$cf = getCf();
		$path = PATH."/domande/".$_GET['idDomanda']."/richiedente/".$cf."/ricevuta-accettazione";
		$rest = @file_get_contents($path);
		if ($rest === false) {
			header('HTTP/1.1 500 Internal Server Error');
		}
		else {
			echo $rest;
		}
	}
	else {
		header('HTTP/1.1 500 Internal Server Error');
	}
	exit();
}

function loadDomande() {
	$cf = getCf();
	$prefix = '';
	if ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA') {
		if ($_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === false && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === false) {
			return array('status' => '403', 'error' => MSG_NO_ACCESSO);
		}
		else if ($_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === true && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === false) {
			$prefix = '/nidi';
		}
		else if ($_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === false && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === true) {
			$prefix = '/materne';
		}
	}
	$path = PATH.$prefix."/domande/richiedente/".$cf;
	$rest = @file_get_contents($path);
	if ($rest === false) {
		return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
	}	
	else {
		$domande = json_decode($rest, true);
		if ($domande['status']['status'] != '200') {
			return array('status' => '500', 'error' => $domande['status']['errors'][0]['code']);
		}
		else {
			$anniDisponibili = array();
			foreach ($domande['result'] as $domanda) {
				if (!in_array($domanda['annoScolastico'], $anniDisponibili)) {
					$anniDisponibili[] = $domanda['annoScolastico'];
				}
			}
			rsort($anniDisponibili);		
			return array('status' => '200', 'anni' => $anniDisponibili, 'domande' => $domande['result']);
		}
	}	
}

function eliminaDomanda() {
	if (is_numeric($_GET['idDomanda'])) {
		$cf = getCf();
		$path = PATH."/domande/".$_GET['idDomanda']."/".$cf;
		if ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA') {
			$path = $path."?cfOperatore=".$_SESSION['ISCRIZIONI']['user']['codice_fiscale'];
		}
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json",
				'method'  => 'DELETE',
			)
		);
		$context = stream_context_create($options);
		$rest = @file_get_contents($path, false, $context);
	
		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}	
		else {
			$domande = json_decode($rest, true);
			if ($domande['status']['status'] != '200') {
				return array('status' => '500', 'error' => $domande['status']['errors'][0]['code']);
			}
			else {
				return array('status' => '200' , 'domande' => $domande['result']);
			}
		}	
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');
	}	
}
?>
