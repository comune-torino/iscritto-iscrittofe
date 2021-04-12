<?php

function loadMaterne() {
	if (preg_match("/^\d{4}\-\d{4}$/", $_GET['annoScolastico'])) {
		if (preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $_GET['dataNascita'])) {
			list($giorno, $mese, $anno) = explode("/", $_GET['dataNascita']);
			if (checkdate($mese, $giorno, $anno)) {
				$path = PATH."/scuole/materne/";
				$path .= "?anno=".$_GET['annoScolastico'];
				$path .= "&dataNascita=$anno-$mese-$giorno";				
				if (isset($_GET['operatore']) && !empty($_GET['operatore'])) {
					$path .= "&cfOperatore=".$_GET['operatore'];
				}
				$rest = @file_get_contents($path);
				if ($rest === false) {
					return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
				}
				else {
					$materne = json_decode($rest, true);					
					if ($materne['status']['status'] != '200') {						
						return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
					}
					else {
						array_walk_recursive($materne, function (&$item, $key) {
							$item = null === $item ? "" : $item;
						});							
						return array('status' => '200', 'materne' => $materne['result']);
					}
				}
			}
			else {
				return array('status' => '500', 'error' => 'Data non valida');
			}
		}
		else {
			return array('status' => '500', 'error' => 'Data non valida');
		}
	}
	else {
		return array('status' => '500', 'error' => 'Anno scolastico non valido');
	}
}

function loadBozzaMaterna() {
	if (is_numeric($_GET['idDomanda'])) {
		$cf = getCf();
		$path = PATH."/materne/domande/".$_GET['idDomanda']."/".$cf;
		$rest = @file_get_contents($path);
		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
		else {
			$bozza = json_decode($rest, true);
			if ($bozza['status']['status'] != '200') {
				return array('status' => '500', 'error' => $bozza['status']['errors'][0]['code']);
			}
			else {
				array_walk_recursive($bozza, function (&$item, $key) {
					$item = null === $item ? "" : $item;
				});
				return array('status' => '200', 'bozza' => $bozza['result']);
			}
		}
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');
	}
}

function loadDomandaMaterna() {
	if (is_numeric($_GET['idDomanda'])) {
		$cf = getCf();
		$path = PATH."/materne/domande/domanda/".$_GET['idDomanda']."/".$cf."/preferenze";
		$rest = @file_get_contents($path);
		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
		else {
			$domanda = json_decode($rest, true);
			if ($domanda['status']['status'] != '200') {
				return array('status' => '500', 'error' => $domanda['status']['errors'][0]['code']);
			}
			else {
				array_walk_recursive($domanda, function (&$item, $key) {
					$item = null === $item ? "" : $item;
				});
				return array('status' => '200', 'domanda' => $domanda['result']);
			}
		}
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');
	}
}

function accettaMaterna() {
	$dati = file_get_contents("php://input");
	$tmp = json_decode($dati, true);
	$tmp = $tmp['dati'];
	if (is_numeric($tmp['idDomanda'])) {
		if (preg_match('/^[a-zA-Z0-9]+$/', $tmp['codScuola'])) {
			if (in_array($tmp['codTipoFrequenza'], array('ND'))) {
				$path = PATH."/materne/domande/domanda/".$tmp['idDomanda']."/preferenze/preferenza/".$tmp['codScuola']."/". $tmp['codTipoFrequenza'] ."/accetta";

				unset($tmp['idDomanda']);
				unset($tmp['codScuola']);
				unset($tmp['codTipoFrequenza']);
				if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA') {
					$tmp['codiceFiscaleRichiedente'] = strtoupper($_SESSION['ISCRIZIONI']['user']['codice_fiscale']);
				}
				$content = json_encode($tmp);
				$header = 'Content-Type: application/json';
				$context = stream_context_create(array(
						'http' => array(
									'method' => 'POST',
									'header' => $header,
									'content' => $content,
						)
				));
				$rest = @file_get_contents($path, false, $context);
				if ($rest === false) {
					return array('status' => "500", 'error' => 'Errore nella chiamata al servizio');
				}
				else {
					$domanda = json_decode($rest, true);
					if ($domanda['status']['status'] == '500') {
						return array('status' => '500', 'error' => $domanda['status']['errors'][0]['code']);
					}
					else if ($domanda['status']['status'] == '400') {
						return array('status' => '400', 'error' => $domanda['status']['errors'][0]['code']);
					}					
					else {
						return array('status' => '200', 'domanda' => $domanda['result']);
					}
				}
			}
			else {
				return array('status' => '500', 'error' => 'Codice tipo frequenza non corretto');
			}
		}
		else {
			return array('status' => '500', 'error' => 'Codice scuola non corretto');
		}
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');
	}	
}

function rinunciaMaterna() {
	$dati = file_get_contents("php://input");
	$tmp = json_decode($dati, true);
	$tmp = $tmp['dati'];
	
	if (is_numeric($tmp['idDomanda'])) {
		if (preg_match('/^[a-zA-Z0-9]+$/', $tmp['codScuola'])) {
			if (in_array($tmp['codTipoFrequenza'], array('ND'))) {
				$path = PATH."/materne/domande/domanda/".$tmp['idDomanda']."/preferenze/preferenza/".$tmp['codScuola']."/". $tmp['codTipoFrequenza'] ."/rinuncia";

				unset($tmp['idDomanda']);
				unset($tmp['codScuola']);
				unset($tmp['codTipoFrequenza']);
				if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA') {
					$tmp['codiceFiscaleRichiedente'] = strtoupper($_SESSION['ISCRIZIONI']['user']['codice_fiscale']);
				}
				$content = json_encode($tmp);
				$header = 'Content-Type: application/json';
				$context = stream_context_create(array(
						'http' => array(
									'method' => 'POST',
									'header' => $header,
									'content' => $content,
						)
				));
				$rest = @file_get_contents($path, false, $context);
				if ($rest === false) {
					return array('status' => "500", 'error' => 'Errore nella chiamata al servizio');
				}
				else {
					$domanda = json_decode($rest, true);
					if ($domanda['status']['status'] == '500') {
						return array('status' => '500', 'error' => $domanda['status']['errors'][0]['code']);
					}
					else if ($domanda['status']['status'] == '400') {
						return array('status' => '400', 'error' => $domanda['status']['errors'][0]['code']);
					}
					else {
						return array('status' => '200', 'domanda' => $domanda['result']);
					}
				}
			}
			else {
				return array('status' => '500', 'error' => 'Codice tipo frequenza non corretto');
			}
		}
		else {
			return array('status' => '500', 'error' => 'Codice scuola non corretto');
		}
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');	
	}	
}

function saveBozzaMaterna() {
	$domanda = file_get_contents("php://input");
	$tmp = json_decode($domanda, true);
	$tmp = $tmp['domanda'];

	if ($tmp['idDomandaIscrizione'] === "") {
		$tmp['idDomandaIscrizione'] = null;
	}
	if ($tmp['minore']['presenzaNucleo'] === "") {
		$tmp['minore']['presenzaNucleo'] = false;
	}
	if ($tmp['richiedente']['condizioneCoabitazione'] != "E" && $tmp['richiedente']['condizioneCoabitazione'] != "F") {
		$tmp['soggetto1']['anagrafica'] = $tmp['richiedente']['anagrafica'];
		$tmp['soggetto1']['luogoNascita'] = $tmp['richiedente']['luogoNascita'];
		$tmp['soggetto1']['residenza'] = $tmp['richiedente']['residenza'];
	}
	else {
		$tmp['soggetto1']['residenza'] = $tmp['minore']['residenza'];
	}
	if ($tmp['soggetto1']['genitoreSolo']['stato'] === "") {
		$tmp['soggetto1']['genitoreSolo'] = null;
	}
	if ($tmp['soggetto2']['anagrafica']['codiceFiscale'] === "") {
		$tmp['soggetto2'] = null;
	}
	else {
		if ($tmp['soggetto2']['gravidanza']['stato'] === "") {
			$tmp['soggetto2']['gravidanza']['stato'] = null;
		}
		if ($tmp['soggetto2']['presenzaNucleo'] === "") {
			$tmp['soggetto2']['presenzaNucleo'] = false;
		}
	}	
	if ($tmp['minore']['cinqueAnniNonFrequentante'] === "") {
		$tmp['minore']['cinqueAnniNonFrequentante'] = null;
	}		
	if ($tmp['minore']['listaAttesa']['stato'] === "") {
		$tmp['minore']['listaAttesa']['stato'] = null;
	}	
	if ($tmp['minore']['fratelloFrequentante']['stato'] === "") {
		$tmp['minore']['fratelloFrequentante']['stato'] = null;
	}
	if ($tmp['minore']['fratelloNidoContiguo']['stato'] === "") {
		$tmp['minore']['fratelloNidoContiguo']['stato'] = null;
	}

	foreach ($tmp['elencoMaterne'] as $materna) {
		unset($materna['contiguo']);
	}

	$cf = ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA') ? strtoupper($tmp['richiedente']['anagrafica']['codiceFiscale']) : strtoupper($_SESSION['ISCRIZIONI']['user']['codice_fiscale']);
	$path = PATH."/materne/domande/".$cf;
	
	$content = json_encode($tmp);
	$header = 'Content-Type: application/json';
	$context = stream_context_create(array(
			'http' => array(
						'method' => 'POST',
						'header' => $header,
						'content' => $content,
			)
	));

	$rest = @file_get_contents($path, false, $context);
	if ($rest === false) {
		return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
	}
	else {
		$result = json_decode($rest, true);
		if ($result['status']['status'] == '400') {
			switch ($result['status']['errors'][0]["code"]) {
				case 'VAL-DOM-008':
					return array('status' => '400', 'body' => 'Stato domanda non valido', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
					break;
				case 'VAL-DOM-012':
					return array('status' => '400', 'body' => 'Operatore non autorizzato', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
					break;
				case 'VAL-DOM-013':
					return array('status' => '400', 'body' => 'Sono presenti pi&ugrave; soggetti con lo stesso codice fiscale', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
					break;
				case 'VAL-DOM-019':
					return array('status' => '400', 'body' => 'Non &egrave; possibile dichiarare contemporaneamente una disabilit&agrave; e un grave problema di salute', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 3);
					break;
				case 'VAL-CF-002':
				case 'VAL-CF-003':
				case 'VAL-CF-004':
				case 'VAL-CF-005':
					$target = $result['status']['errors'][0]['detail']['path'];
					if (strpos($target, 'richiedente') !== false) {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 3);
					}
					else if (strpos($target, 'minore') !== false) {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
					}
					else if (strpos($target, 'soggetto1') !== false) {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 6);
					}
					else if (strpos($target, 'soggetto2') !== false || strpos($target, 'soggetto3') !== false) {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 7);
					}
					else if (strpos($target, 'componenteNucleo') !== false || strpos($target, 'altriComponenti') !== false) {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 8);
					}
					else if (strpos($target, 'affido') !== false) {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 9);
					}
					else {
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
					}
					break;
				default:
					return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
			}
		}
		else if ($result['status']['status'] == '500') {
		return array('status' => '500', 'error' => $content);
		
			//return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
		else {
			return array('status' => '200', 'bozza' => $result['result']);
		}
	}
}

function saveDomandaMaterna() {
	if (is_numeric($_GET['idDomanda'])) {
		$cf = getCf();
		$path = PATH."/materne/domande/inviata/".$_GET['idDomanda']."/".$cf;

		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json",
				'method'  => 'POST',
				'content' => ''
			)
		);
		$context = stream_context_create($options);
		$rest = @file_get_contents($path, false, $context);

		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}	
		else {
			$result = json_decode($rest, true);
			if ($result['status']['status'] == '400') {
				switch ($result['status']['errors'][0]["code"]) {
					case 'VAL-CF-001':
					case 'VAL-CF-002':
					case 'VAL-CF-003':
					case 'VAL-CF-004':
					case 'VAL-CF-005':
						$target = $result['status']['errors'][0]['detail']['path'];
						if (strpos($target, 'richiedente') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 3);
						}
						else if (strpos($target, 'minore') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						}
						else if (strpos($target, 'soggetto1') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 6);
						}
						else if (strpos($target, 'soggetto2') !== false || strpos($target, 'soggetto3') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 7);
						}
						else if (strpos($target, 'componenteNucleo') !== false || strpos($target, 'altriComponenti') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 8);
						}
						else if (strpos($target, 'affido') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 9);
						}
						else {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						}
						break;
					case 'VAL-PER-001':
					case 'VAL-PER-003':
						$target = $result['status']['errors'][0]['detail']['path'];
						if (strpos($target, 'soggetto1') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 6);
						}
						else if (strpos($target, 'soggetto2') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 7);
						}
						else {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						}						
						break;					
					case 'VAL-PER-002':
						$target = $result['status']['errors'][0]['detail']['path'];
						if (strpos($target, 'soggetto1') !== false) {
							return array('status' => '400', 'body' => 'Elenco periodi non corretto', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 6);
						}
						else if (strpos($target, 'soggetto2') !== false) {
							return array('status' => '400', 'body' => 'Elenco periodi non corretto', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 7);
						}
						else {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						}						
						break;
					case 'VAL-PER-004':
						$target = $result['status']['errors'][0]['detail']['path'];
						if (strpos($target, 'soggetto1') !== false) {
							return array('status' => '400', 'body' => 'Il periodo lavorativo &egrave; inferiore a 6 mesi', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 6);
						}
						else if (strpos($target, 'soggetto2') !== false) {
							return array('status' => '400', 'body' => 'Il periodo lavorativo &egrave; inferiore a 6 mesi', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 7);
						}
						else {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						}						
						break;
					case "VAL-MAT-001":
						return array('status' => '400', 'body' => 'Scula materna non presente tra quelle disponibili', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 2, 'subStep'=> 2);
						break;
					case "VAL-MAT-002":
						return array('status' => '400', 'body' => 'Domanda senza scuole materne associate', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 2, 'subStep'=> 2);
						break;
					case 'VAL-DOM-003':
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 3);
						break;
					case 'VAL-DOM-004':
					case 'VAL-DOM-009':
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						break;
					case 'VAL-DOM-005':
							return array('status' => '400', 'body' => 'Esiste gi&agrave; una domanda inviata per lo stesso bambino o bambina ma compilata da altro richiedente.', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						break;
					case 'VAL-DOM-008':
						return array('status' => '400', 'body' => 'Stato domanda non valido', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						break;
					case 'VAL-DOM-010':
						return array('status' => '400', 'body' => 'Figlio/a frequentante o iscrivendo/a non dichiarato/a in precedenza', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 2, 'subStep'=> 3);
						break;
					case 'VAL-DOM-011':
						$target = $result['status']['errors'][0]['detail']['path'];
						if (strpos($target, 'minore') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						}
						else if (strpos($target, 'fratello') !== false) {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 2, 'subStep'=> 3);
						}
						else {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						}						
						break;					
					case 'VAL-DOM-012':
						return array('status' => '400', 'body' => 'Operatore non autorizzato', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						break;
					case 'VAL-DOM-013':
						return array('status' => '400', 'body' => 'Sono presenti pi&ugrave; soggetti con lo stesso codice fiscale', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						break;
					case "VAL-DOM-014":
					case "VAL-DOM-015":
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 2, 'subStep'=> 2);
						break;
					case "VAL-DOM-017":
						return array('status' => '400', 'body' => 'Esiste gi&agrave; una domanda in graduatoria per lo stesso bambino o bambina.', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						break;
					case 'VAL-DOM-019':
						return array('status' => '400', 'body' => 'Non &egrave; possibile dichiarare contemporaneamente una disabilit&agrave; e un grave problema di salute', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						break;
					case "VAL-DOM-020":
						return array('status' => '400', 'body' => 'Esiste gi&agrave; una domanda ammessa per lo stesso bambino o bambina.', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						break;						
					case 'VAL-NT-001':
					case 'VAL-NT-002':
						return array('status' => '400', 'body' => 'Notificatore', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);						
						break;
					case 'VAL-NAO-002':
						$target = $result['status']['errors'][0]['detail']['path'];
						if (strpos($target, 'richiedente') !== false) {
							return array('status' => '400', 'body' => 'Codice Fiscale non presente in anagrafe', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 3);
						}
						else if (strpos($target, 'minore') !== false) {
							return array('status' => '400', 'body' => 'Codice Fiscale non presente in anagrafe', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 4);
						}
						else if (strpos($target, 'componenteNucleo') !== false || strpos($target, 'altriComponenti') !== false) {
							return array('status' => '400', 'body' => 'Codice Fiscale non presente in anagrafe', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title'], 'step' => 1, 'subStep'=> 8);
						}
						else {
							return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);
						}
						break;						
					default:
						return array('status' => '400', 'body' => 'Errore durante il salvataggio della domanda', 'error' => $result['status']['errors'][0]['code'].': '.$result['status']['errors'][0]['title']);					
				}
			}
			else if ($result['status']['status'] == '500') {
				return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
			}
			else {
				return array('status' => '200', 'protocollo' => $result['result']['protocollo'], 'annoScolastico' => $result['result']['annoScolastico']);
			}
		}
	}
	else {
		return array('status' => '500', 'error' => 'ID domanda non corretto');
	}	
}

function checkDomandaMaterna() {
//	if (preg_match("/^\d{4}\-\d{4}$/", $_GET['annoScolastico'])) {
		$richiedente = strtoupper($_GET['richiedente']);
		$minore = strtoupper($_GET['minore']);
		$path = PATH."/materne/domande/verifica/richiedente/".$richiedente."/minore/".$minore;
		$rest = @file_get_contents($path);
		if ($rest === false) {
			return array('status' => '500', 'error' => 'Errore nella chiamata al servizio');
		}
		else {
			$check = json_decode($rest, true);
			if ($check['status']['status'] != '200') {
				return array('status' => $check['status']['status'], 'error' => $check['status']['errors'][0]['code']);
			}
			else {
				return array('status' => '200' , 'check' => $check['result']);
			}
		}
//	}
//	else {
//		return array('status' => '500', 'error' => 'Anno scolastico non valido');
//	}
}

?>
