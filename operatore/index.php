<?php
	include_once '../proxy/config.php';

  session_start();

	if (isset($_SESSION['ISCRIZIONI']['user'])) {
    header('Location: '.ISCRIZIONI_URL);
    exit;
	}
	else if (isset($_POST['username']) || isset($_POST['password'])) {
		$username = '';
		$response = '';
		$errore = false;
		$client = new SoapClient(SOAP, array('trace' => true));
		try {
			if ($_POST['username'] != '') {
				$username = stripos($_POST['username'], '@ipa') !== false ? $_POST['username'] : $_POST['username'].'@ipa';
			}
			$response = $client->identificaUserPassword($username, $_POST['password']);
			$errore = checkProfile($response);
		}
		catch (Exception $e) {
			try {
				if ($_POST['username'] != '') {
					$username = stripos($_POST['username'], '@torinofacile') !== false ? $_POST['username'] : $_POST['username'].'@torinofacile';
				}
				$response = $client->identificaUserPassword($username, $_POST['password']);
				$errore = checkProfile($response);
			}
			catch (Exception $e) {
				$errore = "Login errato";
			}
		}
	}
	
	function checkProfile($response) {
		$user = (array)$response;
		$path = PATH."/profilazione/privilegi/inserimento/".$user['codFiscale'];
		$rest = @file_get_contents($path);
		if ($rest === false) {
			return "Il servizio non &egrave; al momento disponibile a causa di un problema tecnico!<br /> In attesa che venga risolto, invitiamo a riprovare pi&ugrave; tardi";
		}
		else {
			$rest = json_decode($rest, true);
			if ($rest['status']['status'] != '200') {
				return "Operatore non abilitato";
			}
			else {
				$_SESSION['ISCRIZIONI']['user'] = array(
					'nome' => $user['nome'],
					'cognome' => $user['cognome'],
					'authprovider' => 'IPA',
					'codice_fiscale' => $user['codFiscale'],
					'rappresentazione' => $user['rappresentazioneInterna'],
					'mac' => $user['mac']
				);
				if ($rest['result']['nidi'] === true) {
					$_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] = true;
					$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] = MSG_ACCESSO;
				}
				else {
					$_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] = false;
					$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] = MSG_NO_ACCESSO;
				}
				
				if ($rest['result']['materne'] === true) {
					$_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] = true;
					$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] = MSG_ACCESSO;
				}
				else {
					$_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] = false;
					$_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] = MSG_NO_ACCESSO;
				}
				header('Location: '.ISCRIZIONI_URL);
				exit;
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="it-it" dir="ltr">
  <head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />		
		<!-- META FOR IOS & HANDHELD -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style type="text/stylesheet"> @-webkit-viewport { width: device-width; } @-moz-viewport { width: device-width; } @-ms-viewport { width: device-width; } @-o-viewport { width: device-width; } @viewport { width: device-width; } </style>
		<script type="text/javascript">
		//<![CDATA[
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			var msViewportStyle = document.createElement("style");
			msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
			document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
		}
		//]]>
		</script>
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-mobile-web-app-capable" content="YES" />
		<!-- //META FOR IOS & HANDHELD -->
		<link rel="shortcut icon" href="../im/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700,400italic:latin" media="all" />
		<link rel="stylesheet" href="../css/iscrizioni.css?<?php echo time(); ?>" media="screen" />
		<title>Torino Facile - Iscrizione Servizi 0-6</title>
  </head>
	<body>
		<nav class="navbar-pc">
			<div class="container">
				<div class="row align-items-center">
					<div class="brand-area col">
						<span class="navbar-brand">
							<img src="../im/logotorinofacile.png" class="d-inline-block align-top" alt="Logo Torinofacile" />
						</span>
					</div>
				</div>
			</div>
		</nav>
		<div class="content-page">
			<div class="header header-shadow" data-toggle="affix">
				<div class="container">
					<div class="row">
						<h1 class="col">Iscrizione Servizi 0-6</h1>
					</div>
				</div>
			</div>
			<!--/div va al fondo-->
			<div class="user-info-all-detail mt-5">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<?php if (isset($errore) && $errore !== false): ?>
								<div class="alert alert-danger fade show" role="alert">
									<p><?php print $errore; ?></p>
								</div>
							<?php endif; ?>
							<h2 class="no-bottom">Accesso con username e password</h2>
							<form class="form-step" method="post">
								<div class="form-row">
									<div class="form-group col-12">
										<label for="username" class="col-form-label">Username</label>
										<input type="text" class="form-control col-lg-5" id="username" name="username" aria-describedby="usernameHelp" autocomplete="username" />
										<?php if (ENVIRONMENT != 'PRD'): ?><small id="usernameHelp" class="form-text text-muted">csi.demo 30</small><?php endif; ?>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-12">
										<label for="password" class="col-form-label">Password</label>
										<input type="password" class="form-control col-lg-5" id="password" name="password" aria-describedby="passwordHelp" autocomplete="current-password" />
										<?php if (ENVIRONMENT != 'PRD'): ?><small id="passwordHelp" class="form-text text-muted">PIEMONTE</small><?php endif; ?>
									</div>
								</div>
								<div class="form-row">
									<div class="mt-5 col-sm-12 col-md-12 col-lg-12">
										<input class="btn btn-primary" type="submit" name="accedi" value="Accedi">
									</div>
								</div>
							</form>
						</div><!--/col-->
					</div><!--/container-->
				</div><!--/row-->
			</div><!--/user-info-all-detail-->
		</div>
	</body>
</html>