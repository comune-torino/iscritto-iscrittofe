Vue.filter('siNo', function (value) {
	var risposta = {
		S: 'SI',
		N: 'NO'
	};
	if (value) {
		if (typeof value === 'string') {
			return risposta[value];
		}
		return risposta['S'];
	}
	return risposta['N'];
});

Vue.filter('decodeSesso', function (value) {
	if (value) {
		var genere = {
			M: 'maschio',
			F: 'femmina'
		};
		return genere[value];
	}
});

Vue.filter('noValue', function (value) {
	if (value == '') {
		value = '---';
	}
	return value;
});

Vue.filter('tipoFrequenza', function (value) {
	if (value) {
		var tipo = {
			BRV: 'breve',
			LNG: 'lungo',
			INT: 'intermedio'
		};
		return tipo[value];
	}
});

Vue.filter('orarioFrequenza', function (value) {
	if (value) {
		var tipo = {
			BRV: '7:30-13:30',
			LNG: '7:30-17:30',
			INT: '7:30-15:30'
		};
		return tipo[value];
	}
});

Vue.filter('categoriaScuola', function (value, tipo = 'nido') {
	if (value) {
		var categoria = {
			M: 'COMUNALE',
			C: tipo == 'nido' ? 'CONVENZIONATO' : 'CONVENZIONATA',
			S: 'STATALE',
			A: tipo == 'nido' ? 'APPALTATO' : 'APPALTATA',
			P: 'SEZIONE PRIMAVERA CONVENZIONATA'
		};
		return categoria[value];
	}
});

Vue.filter('tipoCorso', function (value) {
	if (value) {
		var corsi = {
			UNI: 'Universit&agrave;',
			MUNI: 'Master post universitari',
			SEC1: 'Secondaria I grado',
			SEC2: 'Secondaria II grado',
			FP: 'Formazione professionale',
			CPIA: 'CPIA',
			TFE: 'Tirocini formativi extracurriculari',
			ALFA: 'Corso Alfabetizzazione',
		};
		return corsi[value];
	}
});

Vue.filter('relazioneConMinore', function (value) {
	if (value) {
		var relazione = {
			FGL: 'figlio/figlia',
			MIN_AFF: 'minore in affidamento L.184/83',
			ALT_COM: 'altro componente del nucleo'
		};
		return relazione[value];
	}
});

Vue.filter('relazioneConBambino', function (value) {
	if (value) {
		var relazione = {
			GEN: 'genitore',
			AFF: 'persona affidataria',
			TUT: 'persona tutrice'
		};
		return relazione[value];
	}
});

Vue.filter('tipoSoggetto2', function (value) {
	if (value) {
		var tipo = {
			A: 'Altro genitore coabitante',
			B: 'Altro genitore non coabitante',
			C: 'Persona coniugata o unita civilmente o convivente di fatto con richiedente',
			E: 'Persona coniugata o unita civilmente o convivente di fatto con il genitore che coabita con il bambino o la bambina',
			G: 'Genitore che coabita con il bambino o la bambina'
		};
		return tipo[value];
	}
});

Vue.filter('euro', function (value) {
	if (value) {
		var valore = value.toString();
		return '\u20AC'+valore;
	}
});

Vue.filter('condizioneCoabitazione', function (value) {
	if (value) {
		var condizione = {
			A: 'coabita con altro genitore',
			B: 'coniugato o unito civilmente con l\'altro genitore ma non coabita con lui/lei',
			C: 'coniugato o unito civilmente o ha sottoscritto convivenza di fatto con persona che non &egrave; l\'altro genitore',
			D: 'nessuna delle condizioni elencate',
			E: 'il genitore che coabita con il bambino o la bambina &egrave; coniugato o unito civilmente o ha sottoscritto convivenza di fatto con persona che non &egrave; l\'altro genitore',
			F: 'il genitore coabitante non &egrave; coniugato o unito civilmente n&eacute; ha sottoscritto convivenza di fatto (genitore solo)',
			G: 'il genitore che coabita con il bambino o la bambina &egrave; coniugato o unito civilmente con il genitore richiedente'
		};
		return condizione[value];
	}
});

Vue.filter('statoDomanda', function (value) {
	if (value) {
		var stato = {
			BOZ: 'Bozza',
			ANN: 'Annullata per rettifica',
			INV: 'Inviata',
			GRA: 'In graduatoria',
			AMM: 'Ammessa',
			RIN: 'Rinunciata',
			ACC: 'Accettata',
			RIT: 'Ritirata',
			CAN: 'Annullata dal richiedente'
		};
		return stato[value];		
	}
});

Vue.filter('statoPreferenzaNido', function (value) {
	if (value) {
		var stato = {
			PEN: 'In graduatoria',
			AMM: 'Ammesso', 
			RIN: 'Rinunciato',
			RIN_AUTO: 'Rinuncia automatica',
			CAN_RIN: 'Cancellato per rinuncia',
			CAN_R_1SC: 'Cancellato per rinuncia 1° scelta',
			ACC: 'Accettato',
			CAN_1SC: 'Cancellato per attribuzione 1° scelta',
			CAN: 'Cancellato per accettazione',
			RIT: 'Ritirato',
			NON_AMM: 'Non ammissibile',
			ANN: 'Annullata dal richiedente'
		};
		return stato[value];		
	}
});

Vue.filter('statoPreferenzaMaterna', function (value) {
	if (value) {
		var stato = {
			PEN: 'In graduatoria',
			AMM: 'Ammesso', 
			RIN: 'Rinunciato',
			RIN_AUTO: 'Rinuncia automatica',
			CAN_RIN: 'Cancellato per rinuncia',
			CAN_R_1SC: 'Cancellato per rinuncia 1° scelta',
			ACC: 'Accettato',
			CAN_1SC: 'Cancellato per attribuzione 1° scelta',
			CAN: 'Cancellato per accettazione',
			RIT: 'Ritirato',
			NON_AMM: 'Non ammissibile',
			ANN: 'Annullata dal richiedente'
		};
		return stato[value];		
	}
});

Vue.filter('dichiarazioneGenitoreSolo', function (value) {
	if (value) {
		var dichiarazione = {
			GEN_DEC: 'L\'altro genitore &egrave; deceduto',
			NUB_CEL_NO_RIC: 'Celibe/nubile con figlio/a non riconosciuto/a dall\'altro genitore',
			NO_RES_GEN: 'All\'altro genitore &egrave; stata tolta la responsabilit&agrave; genitoriale',
			NUB_CEL_RIC: 'Celibe/nubile con figlio/a riconosciuto/a dall\'altro genitore e non coabitante con lui/lei',
			DIV: 'Divorziato/a',
			IST_SEP: 'Presentata istanza di separazione',
			SEP: 'Persona legalmente separata',
		};
		return dichiarazione[value];		
	}
});

Vue.filter('dataOra', function (value) {
	if (value) {
		return value.replace('-', 'alle ore');
	}
});

Vue.filter('dataOraRicevuta', function (value) {
	if (value) {
		var res = value.split(" - ");
		return '<strong>'+res[0]+'</strong> alle ore <strong>'+res[1]+'</strong>';
	}
});

Vue.filter('tipoPasto', function (value) {
	if (value) {
		var tipo = {
			TP1: 'normale',
			TP2: 'senza carne',
			TP3: 'senza carne di maiale',
			TP4: 'senza carne e pesce',
			TP8: 'senza proteine animali'
		};
		return tipo[value];
	}
});

Vue.filter('annoPrec', function (value) {
	if (value) {
		var res = value.split("-");
		res[0]--;
		res[1]--;
		return res[0]+'-'+res[1];
	}
});

Vue.filter('annoPrecPrec', function (value) {
	if (value) {
		var res = value.split("-");
		res[0] = res[0]-2;
		res[1] = res[1]-2;
		return res[0]+'-'+res[1];
	}
});

Vue.filter('ordineScuola', function (value) {
	if (value) {
		var ordine = {
			NID: 'Nido',
			MAT: 'Scuola',
		};
		return ordine[value]+" d'infanzia";
	}
});

Vue.filter('annoScolasticoNido', function (value, anno) {
	if (value) {
		return value;
	}
	if (anno) {
		var anno1 = anno;
		var anno2 = anno+1;
		return anno1+'-'+anno2;
	}
});
