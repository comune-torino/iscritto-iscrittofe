<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
  header('Access-Control-Allow-Headers: Authorization');
  header('Content-Type: application/json');

  include_once 'config.php';
  include_once 'common.php';
  include_once 'nidi.php';	
  include_once 'materne.php';	
	
  session_start();

  if (!isset($_SESSION['ISCRIZIONI']['user'])) {
		unset($_SESSION['ISCRIZIONI']);
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
		header('Location: ' . LOGIN_URL);
		exit;
	}
	else if (array_key_exists('q', $_GET)) {
		switch ($_GET['q']) {
			// COMMON
			case "auth":
				$response = array('status' => '200', 'user' => array('nome' => $_SESSION['ISCRIZIONI']['user']['nome'], 'cognome' => $_SESSION['ISCRIZIONI']['user']['cognome']));
				if ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA') {
					$response['user']['id'] = $_SESSION['ISCRIZIONI']['user']['codice_fiscale'];
				}
				break;
			case "famiglia":
				$response = loadFamiglia();
				break;
			case "stati_regioni":
				$response = loadStatiRegioni();
				break;
			case "province":
				$response = loadProvince();
				break;
			case "comuni":
				$response = loadComuni();
				break;
			case "periodi":
				$response = checkPeriodi();
				break;
			case "salvaFiles":	
				$response = saveFiles();
				break;
			case "file":
				$response = loadFile();
				break;
			case "notificatore":
				$response = checkNotificatore();
				break;				
			case "ricevuta":
				$response = loadRicevuta();
				break;
			case "domande":
				$response = loadDomande();
				break;
			case "elimina":
				$response = eliminaDomanda();
				break;				
			//NIDI
			case "nidi":
				$response = loadNidi();
				break;
			case "bozzaNido":
				$response = loadBozzaNido();
				break;
			case "domandaNido":
				$response = loadDomandaNido();
				break;
			case "accettaNido":
				$response = accettaNido();
				break;
			case "rinunciaNido":
				$response = rinunciaNido();
				break;
			case "salvaBozzaNido":
				$response = saveBozzaNido();
				break;				
			case "salvaDomandaNido":
				$response = saveDomandaNido();
				break;	
			case "verificaNido":
				$response = checkDomandaNido();
				break;
			//MATERNE
			case "materne":
				$response = loadMaterne();
				break;
			case "bozzaMaterna":
				$response = loadBozzaMaterna();
				break;
			case "domandaMaterna":
				$response = loadDomandaMaterna();
				break;
			case "accettaMaterna":
				$response = accettaMaterna();
				break;
			case "rinunciaMaterna":
				$response = rinunciaMaterna();
				break;
			case "salvaBozzaMaterna":
				$response = saveBozzaMaterna();
				break;				
			case "salvaDomandaMaterna":
				$response = saveDomandaMaterna();
				break;	
			case "verificaMaterna":
				$response = checkDomandaMaterna();
				break;
			default: 
				$response = array('status' => '500', 'error' => 'Parametri non validi');
		}
	}
	else {
		$response = array('status' => '500', 'error' => 'Parametri non validi');
	}
	$jsonresponse = json_encode($response);
	usleep(500000);	
	echo $jsonresponse;
?>