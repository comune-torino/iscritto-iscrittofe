<?php
	include_once 'proxy/config.php';

	session_start();

	if (isset($_GET['logout']) || (isset($_SESSION['ISCRIZIONI']['LAST_ACTIVITY']) && (time() - $_SESSION['ISCRIZIONI']['LAST_ACTIVITY'] > 3600))) {
		doLogout($_SESSION['ISCRIZIONI']['user']['authprovider']);
		exit;
	}

	$_SESSION['ISCRIZIONI']['LAST_ACTIVITY'] = time(); // update last activity time stamp
	$_SESSION['ISCRIZIONI']['ENVIRONMENT'] = ENVIRONMENT; // set environment
	
	$idToken = isset($_POST['idToken']) ? $_POST['idToken'] : '';
	$timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : '';
	$mac = isset($_POST['mac']) ? $_POST['mac'] : '';

	if (!isset($_SESSION['ISCRIZIONI']['user']['codice_fiscale']) && ($idToken and $timestamp and $mac)) {
		$datatopost = array(
			'idToken' => $idToken,
			'timestamp' => $timestamp,
			'mac' => $mac,
			'cod_servizio' => COD_SERVIZIO
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URL_TOFA_SERVICE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datatopost);
		$xmlresponse = curl_exec($ch);
		$xmlobj = simplexml_load_string($xmlresponse);
		curl_close($ch);

		$nome =  (string)$xmlobj->nome;
		$cognome = (string)$xmlobj->cognome;
		$codFiscale = (string)$xmlobj->codFiscale;
		$authProvider = (string)$xmlobj->idProvider;
		$rappresentazione = (string)$xmlobj->rappresentazioneInterna;
		$mac = (string)$xmlobj->mac;
			
		if ($codFiscale) {
			$_SESSION['ISCRIZIONI']['user'] = array(
				'nome' => $nome,
				'cognome' => $cognome,
				'codice_fiscale' => $codFiscale,
				'authprovider' => $authProvider,
				'rappresentazione' => $rappresentazione,
				'mac' => $mac
			);
		}
	}
	else if (!isset($_SESSION['ISCRIZIONI']['user']['codice_fiscale']) && (!$idToken and !$timestamp and !$mac)) {
		header('Location: '.LOGIN_URL);
		exit;
	}
		
	if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA') {
		if (NIDI === true) {
			if (new DateTime() > new DateTime(INIZIO_BLOCCO_NIDI) && new DateTime() < new DateTime(FINE_BLOCCO_NIDI)) {
				$_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] = false;
				$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] = MSG_NIDI;
			}
			else {
				$_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] = true;
				$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] = MSG_ACCESSO;
			}
		}
		else {
			$_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] = false;
			$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] = MSG_SOSPENSIONE;
		}
		
		if (MATERNE == true) {
			if (new DateTime() > new DateTime(INIZIO_BLOCCO_MATERNE) && new DateTime() < new DateTime(FINE_BLOCCO_MATERNE)) {
				$_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] = false;
				$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] = MSG_MATERNE;
			}
			else {
				$_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] = true;
				$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] = MSG_ACCESSO;
			}
		}
		else {
			$_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] = false;
			$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] = MSG_SOSPENSIONE;
		}
	}
	
	function doLogout($authprovider) {
		unset($_SESSION['ISCRIZIONI']);
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();

		if (isset($_GET['logout']) && $_GET['logout'] == 'home') {
			header('Location: '.URL_TOFA);
		}
		else if (isset($_GET['logout']) && in_array($_GET['logout'], array('bacheca', 'servizi', 'comunicazioni', 'impostazioni'))) {
			header('Location: '.URL_MIO.$_GET['logout']);
		}
		else if ($authprovider == 'IPA') {
			header('Location: '.LOGOUT_OP);
		}		
		else {
			header('Location: '.LOGOUT_URL);
		}
		exit;
	}
?>
