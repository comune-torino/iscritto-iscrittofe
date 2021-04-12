<?php
	# SET ENVIRONMENT EQ DEV/TF/TU/PRD
	define('ENVIRONMENT', 'DEV');
	
	# ENVIRONMENT SWITCH
	switch (ENVIRONMENT) {
		case 'DEV':
			define('COD_SERVIZIO', 'ISCM');
			define('PATH', 'https://<TO_DEFINE>');
			define('SOAP', 'http://<TO_DEFINE>');
			define('ISCRIZIONI_URL', '/iscrizioniDEV');
			define('NIDI', true);
			define('MATERNE', true);
			define('INIZIO_BLOCCO_NIDI', '2020-01-01 00:00:01');
			define('FINE_BLOCCO_NIDI', '2020-01-01 00:00:02');
			define('INIZIO_BLOCCO_MATERNE', '2020-01-01 00:00:01');
			define('FINE_BLOCCO_MATERNE', '2020-01-01 00:00:02');
			define('MSG_NIDI', '');
			define('MSG_MATERNE', '');
			break;

	}
	
	# COMMON VARS
	define('MSG_ACCESSO', 'Accedi all\'area dedicata.');
	define('MSG_NO_ACCESSO', 'Accesso non autorizzato.');
	define('MSG_SOSPENSIONE', 'Pesentazione domande sospesa.');
	define('DATE_STOP', '');
	define('LOGOUT_OP', ISCRIZIONI_URL.'/operatore');
	define('LOGIN_URL', 'https://<TO_DEFINE>='.COD_SERVIZIO);
	define('LOGOUT_URL', 'https://<TO_DEFINE>');
	define('URL_TOFA', 'https://<TO_DEFINE>');
	define('URL_TOFA_SERVICE', 'https://<TO_DEFINE>');
	define('URL_MIO', 'https://<TO_DEFINE>');
	error_reporting(E_ALL);
	ini_set("display_errors", 0);
	if (!ini_get('date.timezone')) { date_default_timezone_set('GMT'); }
?>