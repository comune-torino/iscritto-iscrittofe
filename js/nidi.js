function domandaNido(tree) {
	var domanda = {
		annoScolastico: '',	
		idDomandaIscrizione: '',
		protocollo: '',
		dataInserimento: '',
		dataUltimaModifica: '',
		statoDomanda: 'BOZ',
		ordineScuola: 'NID',
		responsabilitaGenitoriale: '',
		infoAutocertificazione: '',
		infoGdpr: '',
		consensoConvenzionata: '',
		nao: '',
		codiceFiscaleOperatore: '',
		richiedente: {
			id: '',
			anagrafica: {
				nome: '',
				cognome: '',
				codiceFiscale: '',
				dataNascita: '',
				oraMinutiNascita: '',
				sesso: '',
				codiceCittadinanza: '',
				descrizioneCittadinanza: ''
			},
			luogoNascita: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: ''
			},
			residenza: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: '',
				cap: '',
				indirizzo: '',
				
			},
			telefono: '',
			recapitoNoResidenza: '',
			relazioneConMinore: '',
			condizioneCoabitazione: ''
		},
		minore: {
			id: '',
			presenzaNucleo: '',
			residenzaConRichiedente: '',
			anagrafica: {
				nome: '',
				cognome: '',
				codiceFiscale: '',
				dataNascita: '',
				oraMinutiNascita: '',
				sesso: '',
				codiceCittadinanza: '',
				descrizioneCittadinanza: ''
			},
			luogoNascita: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: ''
			},
			residenza: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: '',
				cap: '',
				indirizzo: '',
			},
			disabilita: {
				stato: '',
				documenti: []
			},
			serviziSociali: {
				stato: '',
				dati: {
					assistente: '',
					nome: '',
					indirizzo: '',
					telefono: ''
				},
				documenti: []
			},
			problemiSalute: {
				stato: '',
				documenti: []
			},
			fratelloFrequentante: {
				stato: '',
				tipo: '',
				anagrafica: {
					nome: '',
					cognome: '',
					codiceFiscale: '',
					dataNascita: '',
					oraMinutiNascita: '',
					sesso: '',
					codiceCittadinanza: '',
					descrizioneCittadinanza: ''
				}
			},
			trasferimento: {
				stato: '',
				dati: {
					data: '',
					indirizzoVecchio: '',
					indirizzoNuovo: '',
					indirizzo: '',
					dataDal: ''
				}
			},
			spostamento: {
				stato: '',
				dati: {
					stato: '',
					dataVariazione: '',
					dataAppuntamento: '',
					residenzaFutura: ''
				}
			},
		},
		soggetto1: {
			id: '',
			anagrafica: {
				nome: '',
				cognome: '',
				codiceFiscale: '',
				dataNascita: '',
				oraMinutiNascita: '',
				sesso: '',
				codiceCittadinanza: '',
				descrizioneCittadinanza: ''
			},
			luogoNascita: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: ''
			},
			gravidanza: {
				stato: '',
				documenti: []
			},
			problemiSalute: {
				stato: '',
				documenti: []
			},
			condizioneOccupazionale: {
				stato: '',
				dati: {
					dipendente: {
						azienda: '',
						comune: '',
						provincia: '',
						indirizzo: ''
					},
					autonomo: {
						piva: '',
						comune: '',
						provincia: '',
						indirizzo: ''
					},
					disoccupato: {
						dataDichiarazione: '',
						soggettoDichiarazione: '',
						datiCi: {
							comune: '',
							provincia: ''
						}
					},
					nonOccupato: [{
						id: '',
						azienda: '',
						comune: '',
						indirizzo: '',
						dataInizio: '',
						dataFine: ''
					}],
					studente: {
						istituto: '',
						corso: ''
					}
				}
			},
			genitoreSolo: {
				stato: '',
				sentenza: {
					numero: '',
					data: '',
					tribunale: ''
				}
			},
			residenza: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: '',
				cap: '',
				indirizzo: '',
			
			}
		},
		soggetto2: {
			id: '',
			presenzaNucleo: '',
			anagrafica: {
				nome: '',
				cognome: '',
				codiceFiscale: '',
				dataNascita: '',
				oraMinutiNascita: '',
				sesso: '',
				codiceCittadinanza: '',
				descrizioneCittadinanza: ''
			},
			luogoNascita: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: ''
			},
			residenza: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: '',
				cap: '',
				indirizzo: ''
			},			
			gravidanza: {
				stato: '',
				documenti: []
			},
			problemiSalute: {
				stato: '',
				documenti: []
			},
			condizioneOccupazionale: {
				stato: '',
				dati: {
					dipendente: {
						azienda: '',
						comune: '',
						provincia: '',
						indirizzo: ''
					},
					autonomo: {
						piva: '',
						comune: '',
						provincia: '',
						indirizzo: ''
					},
					disoccupato: {
						dataDichiarazione: '',
						soggettoDichiarazione: '',
						datiCi: {
							comune: '',
							provincia: ''
						}
					},
					nonOccupato: [{
						id: '',
						azienda: '',
						comune: '',
						indirizzo: '',
						dataInizio: '',
						dataFine: ''
					}],
					studente: {
						istituto: '',
						corso: ''
					}
				}
			}
		},
		soggetto3: {
			anagrafica: {
				nome: '',
				cognome: '',
				codiceFiscale: '',
				dataNascita: '',
				oraMinutiNascita: '',
				sesso: '',
				codiceCittadinanza: '',
				descrizioneCittadinanza: ''
			},
			luogoNascita: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: ''
			},
			residenza: {
				codNazione: '',
				descNazione: '',
				codRegione: '',
				descRegione: '',
				codProvincia: '',
				descProvincia: '',
				codComune: '',
				descComune: '',
				cap: '',
				indirizzo: '',				
			}
		},
		componentiNucleo: {
			soggetti: [],
		},
		altriComponenti: {
			stato: '',
			soggetti: [{
				id: '',
				anagrafica: {
					nome: '',
					cognome: '',
					codiceFiscale: '',
					dataNascita: '',
					oraMinutiNascita: '',
					sesso: '',
					codiceCittadinanza: '',
					descrizioneCittadinanza: ''
				},
				luogoNascita: {
					codNazione: '',
					descNazione: '',
					codRegione: '',
					descRegione: '',
					codProvincia: '',
					descProvincia: '',
					codComune: '',
					descComune: ''
				},
				residenza: {
					codNazione: '',
					descNazione: '',
					codRegione: '',
					descRegione: '',
					codProvincia: '',
					descProvincia: '',
					codComune: '',
					descComune: '',
					cap: '',
					indirizzo: ''
				},
				relazioneConMinore: '',
				problemiSalute: {
					stato: '',
					documenti: []
				}
			}]
		},
		affido: {
			stato: '',
			soggetti: [{
				id: '',
				anagrafica: {
					nome: '',
					cognome: '',
					codiceFiscale: '',
					dataNascita: '',
					oraMinutiNascita: '',
					sesso: '',
					codiceCittadinanza: '',
					descrizioneCittadinanza: ''
				},
				luogoNascita: {
					codNazione: '',
					descNazione: '',
					codRegione: '',
					descRegione: '',
					codProvincia: '',
					descProvincia: '',
					codComune: '',
					descComune: ''
				},
				residenza: {
					codNazione: '',
					descNazione: '',
					codRegione: '',
					descRegione: '',
					codProvincia: '',
					descProvincia: '',
					codComune: '',
					descComune: '',
					cap: '',
					indirizzo: ''
				},
				relazioneConMinore: 'MIN_AFF',
				sentenza: {
					numero: '',
					data: '',
					tribunale: ''
				},
				problemiSalute: {
					stato: '',
					documenti: []
				}
			}]
		},	
		isee: {
			stato: '',
			dati: {
				valore: '',
				dataAttestazione: ''
			}
		},
		elencoNidi: []
	};

	let retVal = 'domanda';
	if (tree) {
		retVal = 'domanda.' + tree;
	}

	return eval(retVal);
}

Vue.component('nido', {
	inject: ['$validator'],
	props: {
		famiglia: {
			type: Object,
			required: true
		},
		id: {
			type: [String, Number],
			required: false
		},
		bozza: {
			type: String,
			required: false
		},
	},
	data: function () {
		return {
			checkNotificatore: true,
			protocolloRicevuto: '',
			annoScolasticoRicevuto: '',			
			domanda: '',
			erroreNido: {
				stato: false,
				tipo: '',
				messaggio: ''
			},
			valoriIniziali: {
				minore: {
					dataNascita: '',
					residenzaConRichiedente: ''
				},
				richiedente: {
					condizioneCoabitazione: ''
				}
			},
			idDomanda: this.id,
			statoBozza: this.bozza,
			steps: {
				totali: 4,
				corrente: 1,
				1: { totali: 10, corrente: 1 },
				2: { totali: 3, corrente: 1 },
				3: { totali: 1, corrente: 1 },
				4: { totali: 1, corrente: 1 },
			},			
			stati: [],
			regioni: [],
			cittadinanza: [],
			nidi: [],
			testoRicerca: '',
			tempoBreve: true,
			tempoLungo: true,
			elencoFigliFrequentanti: []
		}
	},
  computed: {
		showFormMinore: function () {
			return (	this.famiglia.minorenniNido.length == 0 ||
								this.famiglia.minorenniNido.length > 0 &&
								(	this.domanda.minore.presenzaNucleo === false ||
									(	this.domanda.minore.presenzaNucleo === true &&
										this.domanda.minore.anagrafica.codiceFiscale != '')
								)
							);
		},
		showFormAnagraficaMinore: function () {
			return (	this.famiglia.minorenniNido.length == 0 ||
								this.famiglia.minorenniNido.length > 0 &&	this.domanda.minore.presenzaNucleo === false );
		},		
		gravidanzaSoggetto1: function () {
			if (this.domanda.richiedente.condizioneCoabitazione == 'E' || this.domanda.richiedente.condizioneCoabitazione == 'F')	{	
				return this.domanda.soggetto1.anagrafica.sesso == 'F';
			}
			else {
				return this.domanda.richiedente.anagrafica.sesso == 'F';
			}
		},
		showFormSoggetto2: function () {
				return (	this.famiglia.maggiorenni.length == 0 ||
									this.famiglia.maggiorenni.length > 0 &&
										( this.domanda.richiedente.condizioneCoabitazione != 'A' ||
										this.domanda.soggetto2.presenzaNucleo === false ||
											this.domanda.soggetto2.presenzaNucleo === true &&
											this.domanda.soggetto2.anagrafica.codiceFiscale != '')
								);
		},
		showFormAnagraficaSoggetto2: function () {
			return (	this.famiglia.maggiorenni.length == 0 ||
								this.famiglia.maggiorenni.length > 0 &&
									( this.domanda.richiedente.condizioneCoabitazione != 'A' ||
									this.domanda.soggetto2.presenzaNucleo === false)
						);
		},
		risultatoRicerca: function () {
			let risultato = {};
			for (let i = 0; i < this.nidi.length; i++) {
				if ((this.tempoBreve === true && this.tempoLungo === false && this.nidi[i].tempoBreve === true) ||
						(this.tempoBreve === false && this.tempoLungo === true && this.nidi[i].tempoLungo === true) ||
						(this.tempoBreve === true && this.tempoLungo === true)) {
					if (!Array.isArray(risultato[this.nidi[i].codCircoscrizione])) {
						risultato[this.nidi[i].codCircoscrizione] = new Array();
					}
					let len = risultato[this.nidi[i].codCircoscrizione].push(this.nidi[i]);
					risultato[this.nidi[i].codCircoscrizione][len-1].selTempoBreve = false;
					risultato[this.nidi[i].codCircoscrizione][len-1].selTempoLungo = false;					
					if (this.domanda.elencoNidi.length == 10) {
						risultato[this.nidi[i].codCircoscrizione][len-1].selTempoBreve = true;
						risultato[this.nidi[i].codCircoscrizione][len-1].selTempoLungo = true;
					}
				}
			}
			if (this.testoRicerca.length > 2) {
				for (let key in risultato) {
					risultato[key] = risultato[key].filter( nido => {
						let re = new RegExp(this.testoRicerca, "i");
						return nido.descrizione.search(re) !== -1 || nido.indirizzo.search(re) !== -1;
					});
					if (!risultato[key].length) {
						delete risultato[key];
					}
				}
			}
			for (let key in risultato) {
				for (let i = 0; i < risultato[key].length; i++) {
					for (let j = 0; j < this.domanda.elencoNidi.length; j++) {
						if (risultato[key][i].codScuola == this.domanda.elencoNidi[j].codScuola) {
							if (this.domanda.elencoNidi[j].codTipoFrequenza == 'BRV') {
								risultato[key][i].selTempoBreve = true;
							}
							if (this.domanda.elencoNidi[j].codTipoFrequenza == 'LNG') {
								risultato[key][i].selTempoLungo = true;
							}
						}
					}
				}
			}
			return risultato;
		},
		disabilitaMinore: function () {
			return (this.domanda.minore.disabilita.stato ||
							this.domanda.minore.serviziSociali.stato ||
							this.domanda.minore.problemiSalute.stato);
		}
	},
	watch: {
		'tempoBreve': function (newVal, oldVal) {
			if (this.tempoLungo === false && newVal === false) {
				this.tempoBreve = true;
			}		
		},
		'tempoLungo': function (newVal, oldVal) {
			if (this.tempoBreve === false && newVal === false) {
				this.tempoLungo = true;
			}
		}
	},
	created: function () {
		eventBus.$emit('setLoading', true);
		axios.get(urlapi + 'service.php?q=notificatore&check=nidi&idDomanda=' + this.idDomanda + '&bozza=' + this.statoBozza, { timeout: timeout })
		.then((response) => {
			if (response.data.status == 200) {
				this.famiglia.richiedente.telefono = response.data.check.sms;
				eventBus.$on('showErroreDomanda', (errore) => {
					this.setErroreNido(errore);
				});
				if (this.idDomanda != '') {
					this.getDomandaAndSet(this.idDomanda);
				}
				else {
					this.initDomanda();
				}
			}
			else if (response.data.status == 403) {
				this.setErroreNido({stato:true, tipo:'warning', messaggio:response.data.body});
				eventBus.$emit('setLog', "[getAccessoNidi] " + response.data.error);
				eventBus.$emit('setLoading', false);
			}
			else if (response.data.status == 400) {
				this.setErroreNido(ERRORI['NO_NOTIFICATORE']);
				eventBus.$emit('setLog', "[getStatoNotificatore] " + response.data.error);
				eventBus.$emit('setLoading', false);
			}
			else {
				eventBus.$emit('showErrore', ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getStatoNotificatore] " + response.data.error);
				eventBus.$emit('setLoading', false);
			}
		})
		.catch( (error) => {
			eventBus.$emit('showErrore', ERRORI['NO_SERVIZIO']);
			eventBus.$emit('setLog', "[getStatoNotificatore] " + error);
			eventBus.$emit('setLoading', false);
		})
		.then( () => {
			this.checkNotificatore = false;
		});
	},
	methods: {
		setErroreNido: function (errore) {
			eventBus.$emit('setStatoDomanda');
			$('.nav-pills a[href="#domanda"]').tab('show');
			$('.nav-pills a.active').removeClass("active");
			$(window).scrollTop(0);
			this.erroreNido.stato = errore.stato;
			if (errore.stato) {
				this.erroreNido.tipo = errore.tipo;
				this.erroreNido.messaggio = errore.messaggio;
			}
			else {
				this.erroreNido.tipo = '';
				this.erroreNido.messaggio = '';
			}
		},
		getDomandaAndSet: function (id) {
			$(window).scrollTop(0);
			axios.get(urlapi + 'service.php?q=bozzaNido&idDomanda='+id+'&cf='+this.famiglia.richiedente.anagrafica.codiceFiscale, { timeout: timeout })
			.then((response) => {
				if (response.data.status == 200) {
					var domandaRicevuta = response.data.bozza;
					if (domandaRicevuta.statoDomanda != "BOZ") {
						eventBus.$emit('setStatoDomanda');
						this.steps.corrente = 3;
					}
					else {
						domandaRicevuta.nao = this.famiglia.residenza != '' ? true : false;
						this.getStatiERegioni();
					}
					this.setDomanda(domandaRicevuta);
					this.figliFrequentanti(false);
					$('.nav-pills a[href="#domanda"]').tab('show');
					if (domandaRicevuta.statoDomanda != "BOZ") {
						$('.nav-pills a[href="#domanda"]').removeClass("active");
					}
				}
				else {
					this.setErroreNido(ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getDomandaAndSet] " + response.data.error);
				}
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				this.setErroreNido(ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getDomandaAndSet] " + error);
				eventBus.$emit('setLoading', false);			
			});		
		},
		getStatiERegioni: function () {
			if (!this.stati.length || !this.regioni.length || !this.cittadinanza.length) {
				axios.get(urlapi + 'service.php?q=stati_regioni', { timeout: timeout })
				.then( (response) => {
					if (response.data.status == 200) {
						this.stati = response.data.stati;
						this.regioni = response.data.regioni;
						this.cittadinanza = response.data.cittadinanza;
					}
					else {
						eventBus.$emit('showErrore', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[getStatiERegioni] " + response.data.error);
					}
					eventBus.$emit('setLoading', false);
				})
				.catch( (error) => {
					eventBus.$emit('showErrore', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getStatiERegioni] " + error);
					eventBus.$emit('setLoading', false);
				});
			}
		},	
		initDomanda: function () {
			this.domanda = domandaNido();
			this.domanda.nao = this.famiglia.residenza != '' ? true : false;
			this.domanda.codiceFiscaleOperatore = this.$root.user.id ? this.$root.user.id : '';
			if (this.famiglia.richiedente != '') {
				this.domanda.richiedente.anagrafica = JSON.parse(JSON.stringify(this.famiglia.richiedente.anagrafica));
				if (this.famiglia.residenza != '') {
					this.domanda.richiedente.luogoNascita = JSON.parse(JSON.stringify(this.famiglia.richiedente.luogoNascita));
					this.domanda.richiedente.residenza = JSON.parse(JSON.stringify(this.famiglia.residenza));
					if (this.famiglia.minorenniNido.length > 0) {
						this.domanda.minore.presenzaNucleo = true;
					}
				}
				this.domanda.richiedente.telefono = JSON.parse(JSON.stringify(this.famiglia.richiedente.telefono));
			}
			this.getStatiERegioni();
		},
		coabitazioneMinore: function (event) {
			this.domanda.minore = domandaNido('minore');
      if (event.target.value == 'true') {
				this.domanda.minore.presenzaNucleo = true;
				this.domanda.minore.residenzaConRichiedente = true;
			}
      else {
				this.domanda.minore.presenzaNucleo = false;
			}
			this.domanda.richiedente.relazioneConMinore = '';
			this.domanda.componentiNucleo.soggetti = [];
			this.$validator.reset();
		},		
		setMinore: function (event) {
			for (let i = 0; i < this.famiglia.minorenniNido.length; i++) {
				if (this.famiglia.minorenniNido[i].anagrafica.codiceFiscale == event.target.value) {
					this.domanda.minore = domandaNido('minore');
					this.domanda.minore.presenzaNucleo = true;
					this.domanda.minore.residenzaConRichiedente = true;
					this.domanda.minore.anagrafica = JSON.parse(JSON.stringify(this.famiglia.minorenniNido[i].anagrafica));
					this.domanda.minore.luogoNascita = JSON.parse(JSON.stringify(this.famiglia.minorenniNido[i].luogoNascita));
					this.domanda.minore.residenza = JSON.parse(JSON.stringify(this.famiglia.residenza));
					this.domanda.richiedente.relazioneConMinore = '';
					break;
				}
			}
		},
		coabitazioneSoggetto2: function (event) {
			this.domanda.soggetto2 = domandaNido('soggetto2');
      if (event.target.value == 'true') {
				this.domanda.soggetto2.presenzaNucleo = true;
			}
			else {
				this.domanda.soggetto2.presenzaNucleo = false;
			}			
			this.$validator.reset();
		},		
		setSoggetto2: function (event) {
			for (let i = 0; i < this.famiglia.maggiorenni.length; i++) {
				if (this.famiglia.maggiorenni[i].anagrafica.codiceFiscale == event.target.value) {
					this.domanda.soggetto2 = domandaNido('soggetto2');
					this.domanda.soggetto2.presenzaNucleo = true;
					this.domanda.soggetto2.anagrafica = JSON.parse(JSON.stringify(this.famiglia.maggiorenni[i].anagrafica));
					this.domanda.soggetto2.luogoNascita = JSON.parse(JSON.stringify(this.famiglia.maggiorenni[i].luogoNascita));
					this.domanda.soggetto2.residenza = JSON.parse(JSON.stringify(this.famiglia.residenza));
					break;
				}
			}
		},
		componentiNucleo: function () {
			if (this.domanda.minore.presenzaNucleo === '' || this.domanda.minore.presenzaNucleo === false) {
				this.domanda.componentiNucleo.soggetti = [];
			}
			else if (this.domanda.minore.presenzaNucleo === true) {
				var nucleo = this.famiglia.maggiorenni.concat(this.famiglia.minorenni);
				if (nucleo.length) {
					var dichiarati = [this.domanda.richiedente.anagrafica.codiceFiscale,
														this.domanda.minore.anagrafica.codiceFiscale,
														this.domanda.soggetto1.anagrafica.codiceFiscale,
														this.domanda.soggetto2.anagrafica.codiceFiscale,
														this.domanda.soggetto3.anagrafica.codiceFiscale];
					for (let i = 0; i < nucleo.length; i++) {
						var idComponente = '';
						for (let j = 0; j < this.domanda.componentiNucleo.soggetti.length; j++) {
							if (this.domanda.componentiNucleo.soggetti[j].anagrafica.codiceFiscale == nucleo[i].anagrafica.codiceFiscale) {
								idComponente = j;
								break;
							}
						}
						if (idComponente !== '' && dichiarati.indexOf(this.domanda.componentiNucleo.soggetti[idComponente].anagrafica.codiceFiscale) != -1) {
							this.domanda.componentiNucleo.soggetti.splice(idComponente, 1);
						}
						else if (idComponente === '' && dichiarati.indexOf(nucleo[i].anagrafica.codiceFiscale) < 0) {
							var componente = {
								anagrafica: nucleo[i].anagrafica,
								luogoNascita: nucleo[i].luogoNascita,
								id: '',
								relazioneConMinore: '',
								problemiSalute:	domandaNido('minore.problemiSalute')
							}
							this.domanda.componentiNucleo.soggetti.push(componente);
						}
					}
					this.domanda.componentiNucleo.soggetti = this.domanda.componentiNucleo.soggetti.slice().sort(function(a, b) {
						var [a_gg, a_mm, a_aa] = a.anagrafica.dataNascita.split("/");
						var [b_gg, b_mm, b_aa] = b.anagrafica.dataNascita.split("/");
						var a_data = a_aa+a_mm+a_gg;
						var b_data = b_aa+b_mm+b_gg;
						return a_data - b_data;
					});
				}
			}
		},
		getNidi: function (data) {
			if (!this.nidi.length) {
				eventBus.$emit('setLoading', true);
				axios.get(urlapi + 'service.php?q=nidi&dataNascita='+data, { timeout: timeout })
				.then( (response) => {
					if (response.data.status == 200) {
						this.nidi = response.data.nidi;
						this.steps[this.steps.corrente].corrente++;
						this.$validator.reset();
						eventBus.$emit('setLoading', false);
					}
					else {
						eventBus.$emit('showErrore', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[getNidi] " + response.data.error);
						eventBus.$emit('setLoading', false);
					}
				})
				.catch( (error) => {
					eventBus.$emit('showErrore', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getNidi] " + error);
					eventBus.$emit('setLoading', false);				
				});
			}		
			else {
				this.steps[this.steps.corrente].corrente++;
				this.$validator.reset();
			}
		},
    addAltroComponente: function (id) {
			this.domanda.altriComponenti.soggetti.splice(id+1, 0,	domandaNido('altriComponenti.soggetti[0]'));
			this.$validator.reset();
		},
    removeAltroComponente: function (id) {
			this.$dialog.confirm({title: 'Attenzione', body: "Sei sicuro di voler eliminare il componente?"}, {okText: 'conferma'})
			.then( (response) => {
				this.domanda.altriComponenti.soggetti.splice(id, 1);
				this.$validator.reset();
			})
			.catch( () => {
			});			
		},
    addAffido: function (id) {
			this.domanda.affido.soggetti.splice(id+1, 0,	domandaNido('affido.soggetti[0]'));
			this.$validator.reset();
		},
    removeAffido: function (id) {
			this.$dialog.confirm({title: 'Attenzione', body: "Sei sicuro di voler eliminare figlio/a in affido?"}, {okText: 'conferma'})
			.then( (response) => {
				this.domanda.affido.soggetti.splice(id, 1);
				this.$validator.reset();
			})
			.catch( () => {
			});
		},
		addNido: function (nido, frequenza) {
			let selezione = {
				codCircoscrizione: nido.codCircoscrizione,
				codScuola: nido.codScuola,
				descrizione: nido.descrizione,
				indirizzo: nido.indirizzo,
				codTipoFrequenza: frequenza,
				codCategoriaScuola: nido.codCategoriaScuola,				
			};
			this.domanda.elencoNidi.push(selezione);
			this.$validator.reset();
		},
    removeNido: function (id) {
			this.$dialog.confirm({title: 'Attenzione', body: "Sei sicuro di voler eliminare il nido selezionato?"}, {okText: 'conferma'})
			.then( (response) => {
				this.domanda.elencoNidi.splice(id, 1);
			})
			.catch( () => {
			});
		},
		checkDataNascita: function (dataNascita) {
			let res = dataNascita.split("/");
			let data = new Date(Math.abs(res[1])+'/'+Math.abs(res[0])+'/'+Math.abs(res[2]));
			data.setHours(0, 0, 0, 0);
			data.setFullYear(data.getFullYear()+3);
			let limite = new Date('12/31/'+this.famiglia.annoLimiteNido);
			if (limite.getTime() < data.getTime()) {
				return true;
			}
			return false;
		},
		figliFrequentanti: function (setStato = true) {
			let prevElencoLength = this.elencoFigliFrequentanti.length;
			this.elencoFigliFrequentanti = [];
			if (this.domanda.componentiNucleo.soggetti.length > 0 || this.domanda.altriComponenti.stato === true || this.domanda.affido.stato === true) {
				for (let i = 0; i < this.domanda.componentiNucleo.soggetti.length; i++) {
					if (this.checkDataNascita(this.domanda.componentiNucleo.soggetti[i].anagrafica.dataNascita) &&
						['FGL','MIN_AFF'].indexOf(this.domanda.componentiNucleo.soggetti[i].relazioneConMinore) !== -1 &&
						this.domanda.componentiNucleo.soggetti[i].anagrafica.codiceFiscale !== this.domanda.minore.anagrafica.codiceFiscale) {
							this.elencoFigliFrequentanti.push(JSON.parse(JSON.stringify(this.domanda.componentiNucleo.soggetti[i].anagrafica)));
					}
				}
				if (this.domanda.altriComponenti.stato === true) {
					for (let i = 0; i < this.domanda.altriComponenti.soggetti.length; i++) {				
						if (this.checkDataNascita(this.domanda.altriComponenti.soggetti[i].anagrafica.dataNascita) &&
							['FGL','MIN_AFF'].indexOf(this.domanda.altriComponenti.soggetti[i].relazioneConMinore) !== -1 &&
							this.domanda.altriComponenti.soggetti[i].anagrafica.codiceFiscale !== this.domanda.minore.anagrafica.codiceFiscale) {
								this.elencoFigliFrequentanti.push(JSON.parse(JSON.stringify(this.domanda.altriComponenti.soggetti[i].anagrafica)));
						}
					}
				}
				if (this.domanda.affido.stato === true) {
					for (let i = 0; i < this.domanda.affido.soggetti.length; i++) {
						if (this.checkDataNascita(this.domanda.affido.soggetti[i].anagrafica.dataNascita) &&
							['FGL','MIN_AFF'].indexOf(this.domanda.affido.soggetti[i].relazioneConMinore) !== -1 &&
							this.domanda.affido.soggetti[i].anagrafica.codiceFiscale !== this.domanda.minore.anagrafica.codiceFiscale) {
							this.elencoFigliFrequentanti.push(JSON.parse(JSON.stringify(this.domanda.affido.soggetti[i].anagrafica)));
						}
					}
				}
			}
			if (setStato) {
				if (this.elencoFigliFrequentanti.length < 1) {
					this.domanda.minore.fratelloFrequentante = domandaNido('minore.fratelloFrequentante');
					this.domanda.minore.fratelloFrequentante.stato = false;
				}
				else {
					this.elencoFigliFrequentanti = this.elencoFigliFrequentanti.slice().sort(function(a, b) {
						let [a_gg, a_mm, a_aa] = a.dataNascita.split("/");
						let [b_gg, b_mm, b_aa] = b.dataNascita.split("/");
						let a_data = a_aa+a_mm+a_gg;
						let b_data = b_aa+b_mm+b_gg;
						return a_data - b_data;
					});
					if (this.domanda.minore.fratelloFrequentante.stato === false || this.domanda.minore.fratelloFrequentante.stato === '') {
						this.domanda.minore.fratelloFrequentante.anagrafica = domandaNido('minore.fratelloFrequentante.anagrafica');
						this.domanda.minore.fratelloFrequentante.tipo = '';
						if (prevElencoLength < 1) {
							this.domanda.minore.fratelloFrequentante.stato = '';
						}
					}
					else {
						var found = this.elencoFigliFrequentanti.filter( figlio => {
							return JSON.stringify(figlio) === JSON.stringify(this.domanda.minore.fratelloFrequentante.anagrafica);
						});
						if (found.length < 1 || this.domanda.minore.fratelloFrequentante.tipo == '') {
							this.domanda.minore.fratelloFrequentante = domandaNido('minore.fratelloFrequentante');
						}
					}
				}
			}
		},
		setFigliFrequentanti: function (event) {
			for (let i = 0; i < this.elencoFigliFrequentanti.length; i++) {
				if (this.elencoFigliFrequentanti[i].codiceFiscale == event.target.value) {
					this.domanda.minore.fratelloFrequentante.anagrafica = domandaNido('minore.fratelloFrequentante.anagrafica');
					this.domanda.minore.fratelloFrequentante.tipo = '';
					this.domanda.minore.fratelloFrequentante.anagrafica = JSON.parse(JSON.stringify(this.elencoFigliFrequentanti[i]));
					break;
				}
			}
		},
		resetGravidanza: function (soggetto, step) {
			if (typeof soggetto.gravidanza.stato === 'undefined') {
				return;
			}
			if (step != 5 || (step == 5 && (this.domanda.richiedente.condizioneCoabitazione == 'E' || this.domanda.richiedente.condizioneCoabitazione == 'F'))) {
				if (soggetto.anagrafica.sesso != 'F') {
					soggetto.gravidanza.stato = '';
				}
			}
			else {
				if (this.domanda.richiedente.anagrafica.sesso != 'F') {
					soggetto.gravidanza.stato = '';
				}
			}
			if (soggetto.gravidanza.stato === false || soggetto.gravidanza.stato === '') {
				for (let i = 0; i < soggetto.gravidanza.documenti.length; i++) {
					soggetto.gravidanza.documenti[i].eliminato = true;
				}			
			}			
		},
		resetCondizioneCoabitazione: function () {
			if (this.valoriIniziali.minore.residenzaConRichiedente != this.domanda.minore.residenzaConRichiedente) {
				this.valoriIniziali.minore.residenzaConRichiedente = JSON.parse(JSON.stringify(this.domanda.minore.residenzaConRichiedente));
				this.domanda.richiedente.condizioneCoabitazione = '';
			}
		},
		resetDisabilita: function (disabilita) {
			if (typeof disabilita.stato === 'undefined')
				return;
			if (disabilita.stato === false || disabilita.stato === '') {
				for (let i = 0; i < disabilita.documenti.length; i++) {
					disabilita.documenti[i].eliminato = true;
				}
			}
		},
		resetServiziSociali: function (serviziSociali) {
			if (typeof serviziSociali.stato === 'undefined')
				return;
			if (serviziSociali.stato === false || serviziSociali.stato === '') {
				serviziSociali.dati = domandaNido('minore.serviziSociali.dati');
				for (let i = 0; i < serviziSociali.documenti.length; i++) {
					serviziSociali.documenti[i].eliminato = true;
				}
			}
		},
		resetProblemiSalute: function (problemiSalute) {
			if (typeof problemiSalute.stato === 'undefined')
				return;
			if (problemiSalute.stato === false || problemiSalute.stato === '') {
				for (let i = 0; i < problemiSalute.documenti.length; i++) {
					problemiSalute.documenti[i].eliminato = true;
				}
			}
		},
		resetSoggetti: function () {
			var newVal = this.domanda.richiedente.condizioneCoabitazione;
			var oldVal = this.valoriIniziali.richiedente.condizioneCoabitazione;
			if (newVal != oldVal) {
				var coabitante = ['A','B','C','D','G'];
				var nonCoabitante = ['E','F'];
				if ((coabitante.indexOf(newVal) != -1 && (nonCoabitante.indexOf(oldVal) != -1 || oldVal == '')) ||
						(nonCoabitante.indexOf(newVal) != -1 && (coabitante.indexOf(oldVal) != -1 || oldVal == ''))) {
					this.domanda.soggetto1 = domandaNido('soggetto1');
					this.domanda.soggetto2 = domandaNido('soggetto2');
				}
				else {
					this.domanda.soggetto1.genitoreSolo = domandaNido('soggetto1.genitoreSolo');
					this.domanda.soggetto2 = domandaNido('soggetto2');						
				}
				this.domanda.soggetto3 = domandaNido('soggetto3');
				this.valoriIniziali.richiedente.condizioneCoabitazione = JSON.parse(JSON.stringify(this.domanda.richiedente.condizioneCoabitazione));
			}
		},
		resetSentenzaSoggetto3: function () {
			this.domanda.soggetto1.genitoreSolo.sentenza = domandaNido('soggetto1.genitoreSolo.sentenza');
			this.domanda.soggetto3 = domandaNido('soggetto3');	
		},
		resetSoggetto3: function (soggetto) {
			if (typeof soggetto.anagrafica.codiceFiscale === 'undefined')
				return;
			if (this.domanda.richiedente.condizioneCoabitazione != 'C' &&
						this.domanda.richiedente.condizioneCoabitazione == 'D' &&
							['NUB_CEL_RIC','DIV','IST_SEP','SEP'].indexOf(this.domanda.soggetto1.genitoreSolo.stato) === -1) {
				soggetto = domandaNido('soggetto3');
			}
		},
		resetSentenza: function () {
			this.domanda.soggetto1.genitoreSolo.sentenza = domandaNido('soggetto1.genitoreSolo.sentenza');
		},		
		validateCondizioneOccupazionale: function (condizioneOccupazionale) {
			if (typeof condizioneOccupazionale.stato === 'undefined') {
				return;
			}
			if (condizioneOccupazionale.stato == 'DIS_LAV') {
				let postPeriodi = {
					'periodi': []
				};
				for (let i = 0; i < condizioneOccupazionale.dati.nonOccupato.length; i++) {
					postPeriodi.periodi.push( { dataInizio: condizioneOccupazionale.dati.nonOccupato[i].dataInizio, dataFine: condizioneOccupazionale.dati.nonOccupato[i].dataFine } );
				}
				eventBus.$emit('setLoading', true);
				axios.post(urlapi + 'service.php?q=periodi', JSON.stringify(postPeriodi))
				.then( (response) => {
					if (response.data.status == 200) {
						if (response.data.giorni < 180) {
							this.$validator.errors.add({	field: 'periodi-occupazione',
																						msg: 'Il periodo lavorativo è inferiore a 6 mesi. Se la persona è disoccupata da almeno 3 mesi, selezionare il relativo campo.'});
							this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: -170 });
						}
						else {
							this.steps[this.steps.corrente].corrente++;
							this.$validator.reset();
						}
						eventBus.$emit('setLoading', false);
					}
					else {
						this.$dialog.alert({title: 'Attenzione', body: "[checkPeriodo] "+response.data.error})
						.then( (response) => {
							eventBus.$emit('setLoading', false);
						});					
					}
				})
				.catch( (error) => {
					this.$dialog.alert({title: 'Attenzione', body: "[checkPeriodo] "+error})
					.then( (response) => {
						eventBus.$emit('setLoading', false);
					});
				});
			}
			else {
				this.steps[this.steps.corrente].corrente++;
				this.$validator.reset();
			}
		},
		resetComponentiNucleo: function () {
			for (let i = 0; i < this.domanda.componentiNucleo.soggetti.length; i++) {
				if (this.domanda.componentiNucleo.soggetti[i].problemiSalute.stato === false || this.domanda.componentiNucleo.soggetti[i].problemiSalute.stato === '') {
					for (let j = 0; j < this.domanda.componentiNucleo.soggetti[i].problemiSalute.documenti.length; j++) {
						this.domanda.componentiNucleo.soggetti[i].problemiSalute.documenti[j].eliminato = true;
					}
				}
			}
		},
		resetAltriComponenti: function () {
			if (this.domanda.altriComponenti.stato === false || this.domanda.altriComponenti.stato === '') {
				this.domanda.altriComponenti.soggetti = domandaNido('altriComponenti.soggetti');
			}
			else {
				for (let i = 0; i < this.domanda.altriComponenti.soggetti.length; i++) {
					if (this.domanda.altriComponenti.soggetti[i].problemiSalute.stato === false || this.domanda.altriComponenti.soggetti[i].problemiSalute.stato === '') {
						for (let j = 0; j < this.domanda.altriComponenti.soggetti[i].problemiSalute.documenti.length; j++) {
							this.domanda.altriComponenti.soggetti[i].problemiSalute.documenti[j].eliminato = true;
						}
					}
				}
			}
		},
		resetAffido: function () {
			if (this.domanda.affido.stato === false || this.domanda.affido.stato === '') {
				this.domanda.affido.soggetti = domandaNido('affido.soggetti');
			}
			else {
				for (let i = 0; i < this.domanda.affido.soggetti.length; i++) {
					if (this.domanda.affido.soggetti[i].problemiSalute.stato === false || this.domanda.affido.soggetti[i].problemiSalute.stato === '') {
						for (let j = 0; j < this.domanda.affido.soggetti[i].problemiSalute.documenti.length; j++) {
							this.domanda.affido.soggetti[i].problemiSalute.documenti[j].eliminato = true;
						}
					}
				}
			}
		},		
		resetIsee: function () {
			if (this.domanda.isee.stato === false || this.domanda.isee.stato === '') {
				this.domanda.isee.dati = domandaNido('isee.dati');
			}
		},
		resetTrasferimento: function () {
			if (this.domanda.minore.trasferimento.stato === false || this.domanda.minore.trasferimento.stato === '') {
				this.domanda.minore.trasferimento.dati = domandaNido('minore.trasferimento.dati');
			}
		},
		resetSpostamento: function () {
			if (this.domanda.minore.spostamento.stato === false || this.domanda.minore.spostamento.stato === '') {
				this.domanda.minore.spostamento.dati = domandaNido('minore.spostamento.dati');
			}
			else {
				if (this.domanda.minore.spostamento.dati.stato != 'VAR_RES') {
					this.domanda.minore.spostamento.dati.dataVariazione = '';
				}
				if (this.domanda.minore.spostamento.dati.stato != 'APP_VAR_RES') {
					this.domanda.minore.spostamento.dati.dataAppuntamento = '';
				}
				if (this.domanda.minore.spostamento.dati.stato != 'RES_FUT') {
					this.domanda.minore.spostamento.dati.residenzaFutura = '';
				}
			}
		},
		resetNidi: function () {
			if (this.valoriIniziali.minore.dataNascita != this.domanda.minore.anagrafica.dataNascita) {
				this.valoriIniziali.minore.dataNascita = JSON.parse(JSON.stringify(this.domanda.minore.anagrafica.dataNascita));			
				this.nidi = [];
				this.domanda.elencoNidi = [];
			}
		},
		sostitusciDocumenti: function (arrayOfDocumenti) {
			var documentiDaEliminare = [];
			documentiDaEliminare = arrayOfDocumenti.filter( function (documento) {
				if (documento.eliminato === true) {
					var objFile = {
						name: documento.file.name,
						type: documento.file.type
					};
					documento.file = objFile;
					return true;
				}
				return false;
			});
			return documentiDaEliminare;
		},
		invioBozza: function (invia) {
			this.$validator.validateAll().then(() => {
				if (!this.errors.any()) {
					eventBus.$emit('setLoading', true);
					this.resetTrasferimento();
					this.resetSpostamento();
					this.figliFrequentanti();
					var domandaDaInviare = JSON.parse(JSON.stringify(this.domanda));
					if (domandaDaInviare.minore.disabilita.stato === true) {
						domandaDaInviare.minore.disabilita.documenti = this.sostitusciDocumenti(domandaDaInviare.minore.disabilita.documenti);
					}
					if (domandaDaInviare.minore.problemiSalute.stato === true) {
						domandaDaInviare.minore.problemiSalute.documenti = this.sostitusciDocumenti(domandaDaInviare.minore.problemiSalute.documenti);
					}
					if (domandaDaInviare.minore.serviziSociali.stato === true) {
						domandaDaInviare.minore.serviziSociali.documenti = this.sostitusciDocumenti(domandaDaInviare.minore.serviziSociali.documenti);
					}					
					if (domandaDaInviare.soggetto1.problemiSalute.stato === true) {
						domandaDaInviare.soggetto1.problemiSalute.documenti = this.sostitusciDocumenti(domandaDaInviare.soggetto1.problemiSalute.documenti);
					}
					if (domandaDaInviare.soggetto1.gravidanza.stato === true) {
						domandaDaInviare.soggetto1.gravidanza.documenti = this.sostitusciDocumenti(domandaDaInviare.soggetto1.gravidanza.documenti);
					}
					if (domandaDaInviare.soggetto2.anagrafica.codiceFiscale != '') {
						if (domandaDaInviare.soggetto2.problemiSalute.stato === true) {
							domandaDaInviare.soggetto2.problemiSalute.documenti = this.sostitusciDocumenti(domandaDaInviare.soggetto2.problemiSalute.documenti);
						}
						if (domandaDaInviare.soggetto2.gravidanza.stato === true) {
							domandaDaInviare.soggetto2.gravidanza.documenti = this.sostitusciDocumenti(domandaDaInviare.soggetto2.gravidanza.documenti);
						}
					}
					if (domandaDaInviare.altriComponenti.stato === true) {
						for (var i = 0; i < domandaDaInviare.altriComponenti.soggetti.length; i++) {
							if (domandaDaInviare.altriComponenti.soggetti[i].problemiSalute.stato === true) {
								domandaDaInviare.altriComponenti.soggetti[i].problemiSalute.documenti = this.sostitusciDocumenti(domandaDaInviare.altriComponenti.soggetti[i].problemiSalute.documenti);						
							}
						}
					}
					if (domandaDaInviare.componentiNucleo.soggetti.length > 0) {
						for (var i = 0; i < domandaDaInviare.componentiNucleo.soggetti.length; i++) {
							if (domandaDaInviare.componentiNucleo.soggetti[i].problemiSalute.stato === true) {
								domandaDaInviare.componentiNucleo.soggetti[i].problemiSalute.documenti = this.sostitusciDocumenti(domandaDaInviare.componentiNucleo.soggetti[i].problemiSalute.documenti);
							}
						}
					}
					if (domandaDaInviare.affido.stato === true) {
						for (var i = 0; i < domandaDaInviare.affido.soggetti.length; i++) {
							if(domandaDaInviare.affido.soggetti[i].problemiSalute.stato === true) {
								domandaDaInviare.affido.soggetti[i].problemiSalute.documenti = this.sostitusciDocumenti(domandaDaInviare.affido.soggetti[i].problemiSalute.documenti);
							}
						}
					}
					axios.post(urlapi + 'service.php?q=salvaBozzaNido', {'domanda': domandaDaInviare}, { timeout: timeout })
					.then((salvaBozza) => {
						if (salvaBozza.data.status == 200) {
							var bozzaInviata = salvaBozza.data.bozza;
							var formData = new FormData();
							this.domanda.minore.disabilita.documenti
							.forEach( (item, index) => {
								if (item.eliminato === false && item.id == '') {
									formData.append('file_' +  index + '_' + bozzaInviata.minore.id + '_DIS.min', item.file);
								}
							});
							this.domanda.minore.problemiSalute.documenti
							.forEach( (item, index) => {
								if (item.eliminato === false && item.id == '') {
									formData.append('file_' +  index + '_' + bozzaInviata.minore.id + '_SAL.min', item.file);
								}
							});
							this.domanda.minore.serviziSociali.documenti
							.forEach( (item, index) => {
								if (item.eliminato === false && item.id == '') {
									formData.append('file_' +  index + '_' + bozzaInviata.minore.id + '_SER.min', item.file);
								}
							});							
							this.domanda.soggetto1.gravidanza.documenti
							.forEach( (item, index) => {
								if (item.eliminato === false && item.id == '') {
									formData.append('file_' +  index + '_' + bozzaInviata.soggetto1.id + '_GRA.sg1', item.file);
								}
							});
							this.domanda.soggetto1.problemiSalute.documenti
							.forEach( (item, index) => {
								if (item.eliminato === false && item.id == '') {
									formData.append('file_' +  index + '_' + bozzaInviata.soggetto1.id + '_SAL.sg1', item.file);
								}
							});
							if (this.domanda.soggetto2.anagrafica.codiceFiscale != "") {
								this.domanda.soggetto2.gravidanza.documenti
								.forEach( (item, index) => {
									if (item.eliminato === false && item.id == '') {
										formData.append('file_' +  index + '_' + bozzaInviata.soggetto2.id + '_GRA.sg2', item.file);
									}
								});
								this.domanda.soggetto2.problemiSalute.documenti
								.forEach( (item, index) => {
									if (item.eliminato === false && item.id == '') {
										formData.append('file_' +  index + '_' + bozzaInviata.soggetto2.id + '_SAL.sg2', item.file);
									}
								});
							}
							if (this.domanda.componentiNucleo.soggetti.length > 0) {
								for (var i = 0; i < this.domanda.componentiNucleo.soggetti.length; i++) {
									this.domanda.componentiNucleo.soggetti[i].problemiSalute.documenti
									.forEach( (item, index) => {
										if (item.eliminato === false && item.id == '') {
											formData.append('file_' +  index + '_' + bozzaInviata.componentiNucleo.soggetti[i].id + '_SAL.cnu', item.file);
										}
									});
								}
							}
							if (this.domanda.altriComponenti.stato === true) {
								for (var i = 0; i < this.domanda.altriComponenti.soggetti.length; i++) {
									this.domanda.altriComponenti.soggetti[i].problemiSalute.documenti
									.forEach( (item, index) => {
										if (item.eliminato === false && item.id == '') {
											formData.append('file_' +  index + '_' + bozzaInviata.altriComponenti.soggetti[i].id + '_SAL.aco', item.file);
										}
									});
								}
							}
							if (this.domanda.affido.stato === true) {
								for (var i = 0; i < this.domanda.affido.soggetti.length; i++) {
									this.domanda.affido.soggetti[i].problemiSalute.documenti
									.forEach( (item, index) => {
										if (item.eliminato === false && item.id == '') {
											formData.append('file_' +  index + '_' + bozzaInviata.affido.soggetti[i].id + '_SAL.aff', item.file);
										}
									});
								}
							}
							axios.post(urlapi + 'service.php?q=salvaFiles&cf='+this.famiglia.richiedente.anagrafica.codiceFiscale+'&idDomanda='+bozzaInviata.idDomandaIscrizione, formData, {headers: {'Content-Type': 'multipart/form-data'} })
							.then( (salvaFiles) => {
								if (salvaFiles.data.status == 200) {
									if (invia != 1) {
										axios.get(urlapi + 'service.php?q=bozzaNido&idDomanda='+bozzaInviata.idDomandaIscrizione+'&cf='+this.famiglia.richiedente.anagrafica.codiceFiscale, { timeout: timeout })
										.then( (getBozza) => {
											if (getBozza.data.status == 200) {
												this.setDomanda(getBozza.data.bozza);
												this.$dialog.alert({title: 'Stato Domanda', body: 'La domanda &egrave; stata salvata correttamente'});
											}
											else {
												this.setErroreNido(ERRORI['NO_SERVIZIO']);
												eventBus.$emit('setLog', "[getBozza] " + getBozza.data.error);
											}
											eventBus.$emit('setLoading', false);
										})
										.catch ( (error) => {
											this.setErroreNido(ERRORI['NO_SERVIZIO']);
											eventBus.$emit('setLog', "[getBozza] " + error);
											eventBus.$emit('setLoading', false);
										});
									}
									else {
										axios.get(urlapi + 'service.php?q=salvaDomandaNido&idDomanda='+bozzaInviata.idDomandaIscrizione+'&cf='+this.famiglia.richiedente.anagrafica.codiceFiscale, { timeout: timeout })
										.then((salvaDomanda) => {
											if (salvaDomanda.data.status == 200) {
												eventBus.$emit('setStatoDomanda');
												this.protocolloRicevuto = salvaDomanda.data.protocollo;
												this.annoScolasticoRicevuto = salvaDomanda.data.annoScolastico;
												this.steps.corrente = 4;
												this.steps[this.steps.corrente].corrente = 1;
												this.$dialog.alert({title: 'Stato Domanda', body: 'La domanda &egrave; stata inviata'});
												eventBus.$emit('setLoading', false);
											}
											else if (salvaDomanda.data.status == 400) {
												axios.get(urlapi + 'service.php?q=bozzaNido&idDomanda='+bozzaInviata.idDomandaIscrizione+'&cf='+this.famiglia.richiedente.anagrafica.codiceFiscale, { timeout: timeout })
												.then( (bozza) => {
													if (bozza.data.status == 200) {
														this.setDomanda(bozza.data.bozza);
														eventBus.$emit('setLoading', false);
														if (salvaDomanda.data.body == 'Notificatore') {
															this.setErroreNido(ERRORI['NO_NOTIFICATORE']);
															eventBus.$emit('setLog', "[salvaDomanda] " + salvaDomanda.data.error);
														}
														else if (salvaDomanda.data.step && salvaDomanda.data.subStep) {
															this.steps[salvaDomanda.data.step].corrente = salvaDomanda.data.subStep;
															this.steps.corrente = salvaDomanda.data.step;
															this.$nextTick(() => {
																this.$validator.validateAll().then(() => {
																	if (this.$validator.errors.items.length > 0) {
																		let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
																		this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
																	}
																	this.$dialog.alert({title: 'Attenzione', body: salvaDomanda.data.body});
																});
															});
														}
														else {
															this.$dialog.alert({title: 'Attenzione', body: salvaDomanda.data.body});
														}
														eventBus.$emit('setLog', "[salvaDomanda] " + salvaDomanda.data.error);
													}
													else {
														this.setErroreNido(ERRORI['NO_SERVIZIO']);
														eventBus.$emit('setLog', "[salvaDomanda] " + bozza.data.error);
														eventBus.$emit('setLoading', false);													
													}
												})
												.catch( (error) => {
													this.setErroreNido(ERRORI['NO_SERVIZIO']);
													eventBus.$emit('setLog', "[salvaDomanda] " + error);
													eventBus.$emit('setLoading', false);
												});
											}
											else {
												this.setErroreNido(ERRORI['NO_SERVIZIO']);
												eventBus.$emit('setLog', "[salvaDomanda] " + salvaDomanda.data.error);
												eventBus.$emit('setLoading', false);
											}
										})
										.catch( (error) => {
											this.setErroreNido(ERRORI['NO_SERVIZIO']);
											eventBus.$emit('setLog', "[salvaDomanda] " + error);
											eventBus.$emit('setLoading', false);
										});
									}
								}
								else {
									this.setDomanda(bozzaInviata);
									this.$dialog.alert({title: 'Attenzione', body: 'Errore durante il salvataggio della domanda'});
									eventBus.$emit('setLog', "[salvaAllegati] " + salvaFiles.data.error);
									eventBus.$emit('setLoading', false);
								}
							})
							.catch( (error) => {
								this.setDomanda(bozzaInviata);
								this.$dialog.alert({title: 'Attenzione', body: 'Errore durante il salvataggio della domanda'});
								eventBus.$emit('setLog', "[salvaAllegati] " + error);
								eventBus.$emit('setLoading', false);
							});
						}
						else if (salvaBozza.data.status == 400) {
							eventBus.$emit('setLoading', false);
							eventBus.$emit('setLog', "[salvaBozza] " + salvaBozza.data.error);
							if (salvaBozza.data.step && salvaBozza.data.subStep) {
								this.steps[salvaBozza.data.step].corrente = salvaBozza.data.subStep;
								this.steps.corrente = salvaBozza.data.step;
								this.$nextTick(function () {
									this.$validator.validateAll().then(() => {
										if (this.$validator.errors.items.length > 0) {
											let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
											this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
										}
										this.$dialog.alert({title: 'Attenzione', body: salvaBozza.data.body});
									});
								});
							}
							else {
								this.$dialog.alert({title: 'Attenzione', body: salvaBozza.data.body});
							}
						}
						else {
							eventBus.$emit('setLog', "[salvaBozza] " + salvaBozza.data.error);
							this.$dialog.alert({title: 'Attenzione', body: 'Errore durante il salvataggio della domanda'});
							eventBus.$emit('setLoading', false);
						}
					})
					.catch( (error) => {
						eventBus.$emit('setLog', "[salvaBozza] " + error);
						this.$dialog.alert({title: 'Attenzione', body: 'Errore durante il salvataggio della domanda'});
						eventBus.$emit('setLoading', false);
					});
				}
				else if (this.$validator.errors.items.length > 0) {
					let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
					this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
				}
			});	
		},
		setDomanda: function (domandaRicevuta) {
			if (this.domanda != '') {
				this.domanda = domandaNido();
			}
			if (domandaRicevuta.minore.fratelloFrequentante.stato === '' || domandaRicevuta.minore.fratelloFrequentante.stato === false) {
				domandaRicevuta.minore.fratelloFrequentante.tipo = '';	
				domandaRicevuta.minore.fratelloFrequentante.anagrafica = domandaNido('minore.fratelloFrequentante.anagrafica');
			}	
			if (domandaRicevuta.soggetto1.condizioneOccupazionale.stato != "DIS_LAV") {
				domandaRicevuta.soggetto1.condizioneOccupazionale.dati.nonOccupato[0] = domandaNido('soggetto1.condizioneOccupazionale.dati.nonOccupato[0]');
			}
			if (domandaRicevuta.soggetto1.genitoreSolo.stato === '') {
				domandaRicevuta.soggetto1.genitoreSolo = domandaNido('soggetto1.genitoreSolo');
			}
			if (domandaRicevuta.soggetto2 == '') {
				domandaRicevuta.soggetto2 = domandaNido('soggetto2');
			}
			else if (domandaRicevuta.soggetto2.condizioneOccupazionale.stato != "DIS_LAV") {
				domandaRicevuta.soggetto2.condizioneOccupazionale.dati.nonOccupato = domandaNido('soggetto2.condizioneOccupazionale.dati.nonOccupato');
			}
			if (domandaRicevuta.richiedente.condizioneCoabitazione != 'C' &&
						domandaRicevuta.richiedente.condizioneCoabitazione == 'D' &&
							['NUB_CEL_RIC','DIV','IST_SEP','SEP'].indexOf(domandaRicevuta.soggetto1.genitoreSolo.stato) === -1) {
				domandaRicevuta.soggetto3 = domandaNido('soggetto3');
			}			
			if (domandaRicevuta.altriComponenti.stato === false) {
				domandaRicevuta.altriComponenti.soggetti = domandaNido('altriComponenti.soggetti');
			}
			if (domandaRicevuta.affido.stato === false) {
				domandaRicevuta.affido.soggetti = domandaNido('affido.soggetti');
			}
			if (domandaRicevuta.isee.stato === true) {
				let isee = Number(domandaRicevuta.isee.dati.valore).toFixed(2).toLocaleString();
				domandaRicevuta.isee.dati.valore = isee.toString().replace(".",",");
			}
			this.domanda = JSON.parse(JSON.stringify(domandaRicevuta));
			this.domanda.codiceFiscaleOperatore = this.$root.user.id ? this.$root.user.id : '';
			if (this.famiglia.richiedente.telefono != '') {
				this.domanda.richiedente.telefono = JSON.parse(JSON.stringify(this.famiglia.richiedente.telefono));
			}
			this.valoriIniziali.minore.dataNascita = JSON.parse(JSON.stringify(this.domanda.minore.anagrafica.dataNascita));
			this.valoriIniziali.minore.residenzaConRichiedente = JSON.parse(JSON.stringify(this.domanda.minore.residenzaConRichiedente));
			this.valoriIniziali.richiedente.condizioneCoabitazione = JSON.parse(JSON.stringify(this.domanda.richiedente.condizioneCoabitazione));			
		},
		stampaDomanda: function () {
			window.print();
		},
		indice: function () {
			eventBus.$emit('indice');
		},
		showElencoDomande: function () {
			eventBus.$emit('showElencoDomande');
		},
		checkDomandaPresente: function () {
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=verificaNido&richiedente='+this.domanda.richiedente.anagrafica.codiceFiscale+'&minore='+this.domanda.minore.anagrafica.codiceFiscale, { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					this.resetNidi();
					this.resetCondizioneCoabitazione();
					this.steps[this.steps.corrente].corrente++;
				}
				else if (response.data.status == 400) {
					if (response.data.error == 'VAL-DOM-005') {
						this.$dialog.alert({title: 'Attenzione', body: "Esiste gi&agrave; una domanda inviata per lo stesso bambino o bambina ma compilata da altro richiedente.<br />Non è possibile proseguire!"});
					}
					else if (response.data.error == 'VAL-DOM-006') {
						this.$dialog.confirm({title: 'Attenzione', body: "Esiste gi&agrave; una domanda inviata per lo stesso bambino o bambina che sar&agrave; annullata con l'invio della presente.<br />Sei sicuro di voler procedere?"}, {okText: 'conferma'})
						.then( (response) => {
							this.resetNidi();
							this.resetCondizioneCoabitazione();
							this.steps[this.steps.corrente].corrente++;
						})
						.catch( () => {
						});
					}
					else if (response.data.error == 'VAL-DOM-017') {
						this.$dialog.alert({title: 'Attenzione', body: "Esiste gi&agrave; una domanda in graduatoria per lo stesso bambino o bambina.<br />Non è possibile proseguire!<br />Se vuoi inserire una nuova domanda, devi annullare la precedente."});
					}
					else if (response.data.error == 'VAL-DOM-020') {
						this.$dialog.alert({title: 'Attenzione', body: "Esiste gi&agrave; una domanda ammessa per lo stesso bambino o bambina.<br />Non è possibile proseguire!<br />Se vuoi inserire una nuova domanda, devi annullare la precedente."});
					}
				}
				else {
					this.setErroreNido(ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[checkDomandaPresente] " + response.data.error);
					eventBus.$emit('setLoading', false);
				}
				this.resetDisabilita(this.domanda.minore.disabilita);
				this.resetServiziSociali(this.domanda.minore.serviziSociali);
				this.resetProblemiSalute(this.domanda.minore.problemiSalute);
				this.$validator.reset();
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				this.setErroreNido(ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[checkDomandaPresente] " + error);
				eventBus.$emit('setLoading', false);
			})
		},
		setStep: function (step) {
			if (this.steps.corrente < this.steps.totali && this.steps.corrente > step) {
				for (let i = step+1; i <= this.steps.totali; i++) {
					this.steps[i].corrente = 1;
				}
				this.steps.corrente = step;
				this.$validator.reset();
			}
		},
		prevStep: function () {
			if (this.steps.corrente < this.steps.totali && this.steps.corrente > 1) {
				this.steps.corrente--;
				this.$validator.reset();
			}
		},	
		nextStep: function () {
			this.$validator.validateAll().then(() => {
				if (!this.errors.any() && this.steps.corrente < this.steps.totali) {
					switch(this.steps.corrente) {
						case 1:
							this.resetTrasferimento();
							this.resetSpostamento();
							this.steps.corrente++;
							this.$validator.reset();
							break;
						case 2:
							this.figliFrequentanti();
							this.steps.corrente++;
							this.$validator.reset();
							break;
						case 3:
							this.$dialog.confirm({title: 'Attenzione', body: "Si stanno per confermare ed inviare i dati.<br />Inviando la domanda, accetti il regolamento comunale dei Nidi d'Infanzia della Città di Torino.<br /><br />Sei sicuro di voler procedere?"}, {okText: 'conferma'})
							.then( (response) => {
								this.$validator.reset();
								this.invioBozza(1);
							})
							.catch( () => {
							});
							break;
						default:
							this.steps.corrente++;
							this.$validator.reset();
					}
				}
				else if (this.$validator.errors.items.length > 0) {
					let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
					this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
				}
			});
		},
		setSubStep: function (substep) {
			if (this.steps[this.steps.corrente].corrente > substep) {
				this.steps[this.steps.corrente].corrente = substep;
				this.$validator.reset();
			}
		},
		prevSubStep: function () {
			if (this.steps[this.steps.corrente].corrente > 1) {
				this.steps[this.steps.corrente].corrente--;
				this.$validator.reset();
			}
		},
		nextSubStep: function () {
			this.$validator.errors.remove('periodi-occupazione');
			this.$validator.validateAll().then(() => {
				if (!this.errors.any() && this.steps[this.steps.corrente].corrente < this.steps[this.steps.corrente].totali) {
					switch(this.steps.corrente) {
						case 1:
							switch(this.steps[this.steps.corrente].corrente) {
								case 3:
									this.checkDomandaPresente();
									break;
								case 4:
									this.resetSoggetti();
									this.steps[this.steps.corrente].corrente++;
									this.$validator.reset();
									break;									
								case 5:
									this.resetGravidanza(this.domanda.soggetto1, this.steps[this.steps.corrente].corrente);
									this.resetProblemiSalute(this.domanda.soggetto1.problemiSalute);
									this.validateCondizioneOccupazionale(this.domanda.soggetto1.condizioneOccupazionale);
									break;
								case 6:
									this.resetGravidanza(this.domanda.soggetto2, this.steps[this.steps.corrente].corrente);
									this.resetProblemiSalute(this.domanda.soggetto2.problemiSalute);
									this.resetSoggetto3(this.domanda.soggetto3);
									if (this.famiglia.residenza != '') {
										this.componentiNucleo();
									}
									this.validateCondizioneOccupazionale(this.domanda.soggetto2.condizioneOccupazionale);
									break;
								case 7:
									this.resetComponentiNucleo();
									this.resetAltriComponenti();
									this.steps[this.steps.corrente].corrente++;
									this.$validator.reset();										
									break;
								case 8:
									this.resetAffido();
									this.figliFrequentanti();
									this.steps[this.steps.corrente].corrente++;
									this.$validator.reset();										
									break;							
								case 9:
									this.resetIsee();
									this.steps[this.steps.corrente].corrente++;
									this.$validator.reset();										
									break;
								default:
									this.steps[this.steps.corrente].corrente++;
									this.$validator.reset();
							}
							break;
						case 2:
							switch(this.steps[this.steps.corrente].corrente) {
								case 1:
									this.getNidi(this.domanda.minore.anagrafica.dataNascita);
									break;
								default:
									this.steps[this.steps.corrente].corrente++;
									this.$validator.reset();
							}
							break;
					}
				}
				else if (this.$validator.errors.items.length > 0) {
					let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
					this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
				}
			});
		},
	},
});