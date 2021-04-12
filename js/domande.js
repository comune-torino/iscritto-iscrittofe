Vue.component('domande', {
	props: {
		richiedente: {
			type: String,
			required: true
		},
	},
	data: function () {
		return {
			idDomanda: '',
			gestioneDomanda: '',
			preferenza: {
				domanda: '',
				tipo: '',
				posto: '',
				azione: ''
			},
			erroreDomande: {
				stato: false,
				tipo: '',
				messaggio: ''
			}
		}
	},
	created: function () {
		eventBus.$on('setErroreDomande', (errore) => {
			this.setErroreDomande(errore);
		});
    eventBus.$on('reloadDomande', () => {
				this.idDomanda = '';
				this.gestioneDomanda = '';
				this.preferenza = {
					domanda: '',
					tipo: '',
					posto: '',
					azione: ''
				};
				this.setErroreDomande({stato:false});
		});
    eventBus.$on('gestioneDomandaNido', (id) => {
			$('.nav-pills a.active').removeClass("active");
			this.idDomanda = id;
			this.gestioneDomanda = 'nido';
			this.preferenza = {
				domanda: '',
				tipo: '',
				posto: '',
				azione: ''
			};
		});
    eventBus.$on('gestioneDomandaMaterna', (id) => {
			$('.nav-pills a.active').removeClass("active");
			this.idDomanda = id;
			this.gestioneDomanda = 'materna';
			this.preferenza = {
				domanda: '',
				tipo: '',
				posto: '',
				azione: ''
			};
		});		
    eventBus.$on('accetta', (domanda, posto, tipo) => {
			eventBus.$emit('setLoading', true);
			this.sleep(500).then(() => {
  			this.preferenza = {
					domanda: domanda,
					tipo: tipo,
					posto: posto,
					azione: 'accetta'
				};
				this.gestioneDomanda = '';
				eventBus.$emit('setLoading', false);
			});
		});
		eventBus.$on('rinuncia', (domanda, posto, tipo) => {
			eventBus.$emit('setLoading', true);
			this.sleep(500).then(() => {
				this.preferenza = {
					domanda: domanda,
					tipo: tipo,
					posto: posto,
					azione: 'rinuncia'
				};		
				this.gestioneDomanda = '';
				eventBus.$emit('setLoading', false);				
			});
		});
	},
	beforeDestroy: function () {
		eventBus.$off('reloadDomande');
	},
	methods: {
		setErroreDomande: function (errore) {
			eventBus.$emit('setStatoDomanda');
			$('.nav-pills a.active').removeClass("active");
			$(window).scrollTop(0);			
			this.erroreDomande.stato = errore.stato;
			if (errore.stato) {
				this.erroreDomande.tipo = errore.tipo;
				this.erroreDomande.messaggio = errore.messaggio;
			}
			else {
				this.erroreDomande.tipo = '';
				this.erroreDomande.messaggio = '';
			}
		},
		sleep: function (millisecondi) {
			return new Promise(resolve => setTimeout(resolve, millisecondi));
		}
	}
});

Vue.component('elenco-domande', {
	props: {
		richiedente: {
			type: String,
			required: true
		},
	},
	data: function () {
		return {
			anni: [],
			domande: [],
			ricerca: '',
			scuolaNido: true,
			scuolaMaterna: true
		}
	},
	created: function () {
		eventBus.$on('downloadRicevuta', (id) => {
			this.downloadRicevuta(id);
		});
		$('.nav-pills a[href="#elenco"]').addClass("active");
		eventBus.$emit('setLoading', true);
		this.getDomande();
	},
	methods: {
		getDomande: function () {
			axios.get(urlapi + 'service.php?q=domande&cf=' + this.richiedente, { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					this.anni = response.data.anni;
					this.domande = response.data.domande;
				}
				else if (response.data.status == 403) {
					eventBus.$emit('setErroreDomande', {stato:true, tipo:'danger', messaggio:response.data.error});
					eventBus.$emit('setLog', "[getAccessoDomande] " + response.data.error);
				}
				else {
					eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getDomande] " + response.data.error);
				}
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getDomande] " + error);
				eventBus.$emit('setLoading', false);
			});
		},
		getDomandaNido: function (id, bozza) {
			eventBus.$emit('showDomandaNido', id, bozza);
		},
		gestioneDomandaNido: function (id) {
			eventBus.$emit('gestioneDomandaNido', id);
		},
		getDomandaMaterna: function (id, bozza) {
			eventBus.$emit('showDomandaMaterna', id, bozza);
		},
		gestioneDomandaMaterna: function (id) {
			eventBus.$emit('gestioneDomandaMaterna', id);
		},		
		downloadRicevuta: function(id) {
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=ricevuta&cf=' + this.richiedente + '&idDomanda=' + id, { responseType: 'blob', timeout: timeout })
			.then((response) => {
				if (navigator.msSaveBlob) {
					let blob = new Blob([response.data], {
						type: 'application/pdf'
					});
					navigator.msSaveBlob(blob, 'ricevuta_accettazione.pdf');
				}
				else {
					let link = document.createElement('a');
					link.href = window.URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
					link.download = 'ricevuta_accettazione.pdf';
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
				}
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				eventBus.$emit('setLog', "[ricevuta] " + error);
				this.$dialog.alert({title: 'Attenzione', body: "Non &egrave; stato possibile recuperare il file della ricevuta"});
				eventBus.$emit('setLoading', false);
			});
		},
		eliminaDomanda: function(id, stato, protocollo) {
			let messaggio = "Stai procedendo alla cancellazione definitiva di una domanda in bozza.<br />Sei sicuro di voler procedere?";
			let risposta = "La domanda &egrave; stata definitivamente cancellata.";
			let errore = "Non &egrave; stato possibile annullare la domanda n. <strong>" + protocollo + "</strong>.";
			switch(stato) {
				case 'BOZ':
					errore = "Non &egrave; stato possibile cancellare la domanda.";
					break;
				case 'INV':
					messaggio = "Stai procedendo all'annullamento della domanda n. <strong>" + protocollo + "</strong> che pertanto non sar&agrave; inserita in graduatoria.<br />Sei sicuro di voler procedere?";
					risposta = "La domanda n. <strong>" + protocollo + "</strong> &egrave; stata annullata e non sar&agrave; quindi inserita in graduatoria.";
					break;
				case 'GRA':
					messaggio = "Stai procedendo all'annullamento della domanda n. <strong>" + protocollo + "</strong> presente in graduatoria che pertanto non sar&agrave; pi&ugrave; presa in considerazione per le attribuzioni dei posti disponibili.<br />Sei sicuro di voler procedere?";
					risposta = "La domanda n. <strong>" + protocollo + "</strong> &egrave; stata annullata e non sar&agrave; quindi presa in considerazione per le attribuzioni dei posti disponibili.";
					break;
			}
			this.$dialog.confirm({title: 'Attenzione', body: messaggio}, {okText: 'conferma'})
			.then( (response) => {
				eventBus.$emit('setLoading', true);
				axios.get(urlapi + 'service.php?q=elimina&cf=' + this.richiedente + '&idDomanda=' + id, { timeout: timeout })
				.then( (response) => {
					if (response.data.status == 200) {
						this.getDomande();
						$(window).scrollTop(0);
						this.$dialog.alert({title: 'Stato Domanda', body: risposta});
					}
					else {
						eventBus.$emit('setLog', "[elimina] " + response.data.error);
						this.$dialog.alert({title: 'Attenzione', body: errore});
					}
					eventBus.$emit('setLoading', false);
				})
				.catch( (error) => {
					eventBus.$emit('setLog', "[elimina] " + error);
					this.$dialog.alert({title: 'Attenzione', body: errore});
					eventBus.$emit('setLoading', false);
				});
			})
			.catch( () => {
			});			
		},
		resetRicerca: function () {
			this.scuolaMaterna = true;
			this.scuolaNido = true;
			this.ricerca = '';
		}
	},
	computed:{
		filtroDomande: function () {
			let risultato = [];
			for (let i=0; i < this.domande.length; i++) {
				if (this.domande[i].annoScolastico.match(this.ricerca)) {
					if (this.scuolaNido === true) {
						if (this.scuolaMaterna == '' || this.scuolaMaterna === false) {
							if (this.domande[i].ordineScuola.match('NID')) {
								risultato.push(this.domande[i]);
							}
						}
						else if (this.scuolaMaterna === true) {
							if (this.domande[i].ordineScuola.match('MAT') || this.domande[i].ordineScuola.match('NID')) {
								risultato.push(this.domande[i]);
							}
						}
					}
					else if (this.scuolaMaterna === true) {
						if (this.scuolaNido == ''|| scuolaNido === false) {
							if (this.domande[i].ordineScuola.match('MAT')) {
								risultato.push(this.domande[i]);
							}
						}
						else if (this.scuolaNido === true) {
							if (this.domande[i].ordineScuola.match('MAT') || this.domande[i].ordineScuola.match('NID')) {
								risultato.push(this.domande[i]);
							}
						}
					}
					else {
						risultato.push(this.domande[i]);
					}
				}
			}
			return risultato;
		}
	},
	watch: {
		'scuolaNido': function (newVal, oldVal) {
			if (this.scuolaMaterna === false && newVal === false) {
				this.scuolaNido = true;
			}		
		},
		'scuolaMaterna': function (newVal, oldVal) {
			if (this.scuolaNido === false && newVal === false) {
				this.scuolaMaterna = true;
			}
		}
	},	
});

Vue.component('domanda-nido', {
	props: {
		richiedente: {
			type: String,
			required: true
		},
		id: {
			type: [String, Number],
			required: true
		},
	},
	data: function () {
		return {
			domanda: '',
		}
	},
	created: function () {
		this.getDomanda();
	},	
	methods: {
		reloadDomande: function () {
			eventBus.$emit('reloadDomande');
		},
		getDomanda: function () {
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=domandaNido&idDomanda=' + this.id + '&cf=' + this.richiedente, { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					this.domanda = response.data.domanda;
					this.$nextTick(() => {
						if( $('#ammesso').length ) {
							this.$scrollTo('#ammesso', 500, {	offset: -130 });
						}
					});
				}
				else {
					eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getDomandaNido] " + response.data.error);
				}
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getDomandaNido] " + error);
				eventBus.$emit('setLoading', false);
			});
		},
		accetta: function (domanda, posto, tipo) {
			eventBus.$emit('accetta', domanda, posto, tipo);
		},
		rinuncia: function (domanda, posto, tipo) {
			eventBus.$emit('rinuncia', domanda, posto, tipo);
		},
		downloadRicevuta: function () {
			eventBus.$emit('downloadRicevuta', this.domanda.idDomandaIscrizione);
		},		
	}
});

Vue.component('domanda-materna', {
	props: {
		richiedente: {
			type: String,
			required: true
		},
		id: {
			type: [String, Number],
			required: true
		},
	},
	data: function () {
		return {
			domanda: '',
		}
	},
	created: function () {
		this.getDomanda();
	},	
	methods: {
		reloadDomande: function () {
			eventBus.$emit('reloadDomande');
		},
		getDomanda: function () {
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=domandaMaterna&idDomanda=' + this.id + '&cf=' + this.richiedente, { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					this.domanda = response.data.domanda;
					this.$nextTick(() => {
						if( $('#ammesso').length ) {
							this.$scrollTo('#ammesso', 500, {	offset: -130 });
						}
					});
				}
				else {
					eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getDomandaMaterna] " + response.data.error);
				}
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getDomandaMaterna] " + error);
				eventBus.$emit('setLoading', false);
			});
		},
		accetta: function (domanda, posto, tipo) {
			eventBus.$emit('accetta', domanda, posto, tipo);
		},
		rinuncia: function (domanda, posto, tipo) {
			eventBus.$emit('rinuncia', domanda, posto, tipo);
		},
		downloadRicevuta: function () {
			eventBus.$emit('downloadRicevuta', this.domanda.idDomandaIscrizione);
		},		
	}
});

Vue.component('accetta-rinuncia-nido', {
	props: {
		richiedente: {
			type: String,
			required: true
		},
		preferenza: {
			type: Object,
			required: true
		},
	},
	data: function () {
		return {
			conferma: false
		}
	},
  computed: {
		rinunce: function () {
			var rinunciati = this.preferenza.domanda.elencoPreferenze.filter( function (posto) {
				if (posto.codStatoScuola == 'RIN' || posto.codStatoScuola == 'RIN_AUTO') {
					return true;
				}
				return false;
			});
			return rinunciati.length;
		}
	},
	methods: {
		gestioneDomandaNido: function (id) {
			eventBus.$emit('gestioneDomandaNido', id);
		},
		accetta: function () {
			this.$validator.validateAll()
			.then(() => {
				if (!this.errors.any()) {
					this.$dialog.confirm({title: 'Attenzione', body: "Si ricorda che dopo l'accettazione, la domanda non sar&agrave; presa in considerazione per l'assegnazione di altri posti.<br />Sei sicuro di voler accettare il posto?"}, {okText: 'conferma'})
					.then( (response) => {
						eventBus.$emit('setLoading', true);
						var datiPost = {
							'idDomanda': this.preferenza.domanda.idDomandaIscrizione,
							'codScuola': this.preferenza.domanda.elencoPreferenze[this.preferenza.posto].codScuola,
							'codTipoFrequenza': this.preferenza.domanda.elencoPreferenze[this.preferenza.posto].codTipoFrequenza,
							'codiceFiscaleRichiedente': this.richiedente,
							'codiceFiscaleOperatore': this.$root.user.id ? this.$root.user.id : '',
							'numeroTelefonoRichiedente': this.preferenza.domanda.telefonoRichiedente,
							'codiceTipoPasto': this.preferenza.domanda.codiceTipoPasto
						};
						axios.post(urlapi + 'service.php?q=accettaNido', {'dati': datiPost}, { timeout: timeout })
						.then((response) => {
							if (response.data.status == 200) {
								//var elencoPreferenze = this.preferenza.domanda.elencoPreferenze;
								this.preferenza.domanda = response.data.domanda;
								//this.preferenza.domanda.elencoPreferenze = elencoPreferenze;
								this.conferma = true;
							}
							else if (response.data.status == 400) {
								this.$dialog.alert({title: 'Attenzione', body: "Si &egrave; verificato un errore durante l'accettazione."});
								eventBus.$emit('setLog', "[accettaNido] " + response.data.error);
							}
							else {
								eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
								eventBus.$emit('setLog', "[accettaNido] " + response.data.error);
							}
							eventBus.$emit('setLoading', false);
						})
						.catch( (error) => {
							eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
							eventBus.$emit('setLog', "[accettaNido] " + error);
							eventBus.$emit('setLoading', false);			
						});
					})
					.catch( () => {
					});
				}
				else if (this.$validator.errors.items.length > 0) {
					let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
					this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
				}
			});
		},
		rinuncia: function () {
			var messaggio = 'Si ricorda che &egrave; possibile rinunciare e restare in lista d\'attesa per due volte. La terza rinuncia comporter&agrave; la cancellazione dalla graduatoria cittadina.';
			if (this.preferenza.posto == 0) {
				messaggio = 'Si ricorda che la rinuncia al posto di 1&deg; scelta comporta la cancellazione dalla graduatoria cittadina.';
			}
			else if (this.rinunce == 2) {
				messaggio = 'Si ricorda che la terza rinuncia comporta la cancellazione dalla graduatoria cittadina.';			
			}
			this.$dialog.confirm({title: 'Attenzione', body: messaggio+"<br />Sei sicuro di voler rinunciare al posto?"}, {okText: 'conferma'})
			.then( (response) => {
				eventBus.$emit('setLoading', true);
				var datiPost = {
					'idDomanda': this.preferenza.domanda.idDomandaIscrizione,
					'codScuola': this.preferenza.domanda.elencoPreferenze[this.preferenza.posto].codScuola,
					'codTipoFrequenza': this.preferenza.domanda.elencoPreferenze[this.preferenza.posto].codTipoFrequenza,					
					'codiceFiscaleRichiedente': this.richiedente,
					'codiceFiscaleOperatore': this.$root.user.id ? this.$root.user.id : ''
				};
				axios.post(urlapi + 'service.php?q=rinunciaNido', {'dati': datiPost}, { timeout: timeout })
				.then((response) => {
					if (response.data.status == 200) {
						//var elencoPreferenze = this.preferenza.domanda.elencoPreferenze;
						this.preferenza.domanda = response.data.domanda;
						//this.preferenza.domanda.elencoPreferenze = elencoPreferenze;
						this.conferma = true;
					}
					else if (response.data.status == 400) {
						this.$dialog.alert({title: 'Attenzione', body: "Si &egrave; verificato un errore durante la rinuncia."});
						eventBus.$emit('setLog', "[rinunciaNido] " + response.data.error);
					}
					else {
						eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[rinunciaNido] " + response.data.error);
					}					
					eventBus.$emit('setLoading', false);
				})
				.catch( (error) => {
					eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[rinunciaNido] " + error);
					eventBus.$emit('setLoading', false);			
				});
			})
			.catch( () => {
			});
		},
		stampaRicevuta: function () {
			window.print();
		},
		downloadRicevuta: function () {
			eventBus.$emit('downloadRicevuta', this.preferenza.domanda.idDomandaIscrizione);
		},	
	}
});

Vue.component('accetta-rinuncia-materna', {
	props: {
		richiedente: {
			type: String,
			required: true
		},
		preferenza: {
			type: Object,
			required: true
		},
	},
	data: function () {
		return {
			conferma: false
		}
	},
  computed: {
		rinunce: function () {
			var rinunciati = this.preferenza.domanda.elencoPreferenzeMaterna.filter( function (posto) {
				if (posto.codStatoScuola == 'RIN' || posto.codStatoScuola == 'RIN_AUTO') {
					return true;
				}
				return false;
			});
			return rinunciati.length;
		}
	},
	methods: {
		gestioneDomandaMaterna: function (id) {
			eventBus.$emit('gestioneDomandaMaterna', id);
		},
		accetta: function () {
			this.$validator.validateAll()
			.then(() => {
				if (!this.errors.any()) {
					this.$dialog.confirm({title: 'Attenzione', body: "Si ricorda che dopo l'accettazione, la domanda non sar&agrave; presa in considerazione per l'assegnazione di altri posti.<br />Sei sicuro di voler accettare il posto?"}, {okText: 'conferma'})
					.then( (response) => {
						eventBus.$emit('setLoading', true);
						var datiPost = {
							'idDomanda': this.preferenza.domanda.idDomandaIscrizione,
							'codScuola': this.preferenza.domanda.elencoPreferenzeMaterna[this.preferenza.posto].codScuola,
							'codTipoFrequenza': this.preferenza.domanda.elencoPreferenzeMaterna[this.preferenza.posto].codTipoFrequenza,
							'codiceFiscaleRichiedente': this.richiedente,
							'codiceFiscaleOperatore': this.$root.user.id ? this.$root.user.id : '',
							'numeroTelefonoRichiedente': this.preferenza.domanda.telefonoRichiedente,
							'codiceTipoPasto': this.preferenza.domanda.codiceTipoPasto
						};
						axios.post(urlapi + 'service.php?q=accettaMaterna', {'dati': datiPost}, { timeout: timeout })
						.then((response) => {
							if (response.data.status == 200) {
								//var elencoPreferenze = this.preferenza.domanda.elencoPreferenze;
								this.preferenza.domanda = response.data.domanda;
								//this.preferenza.domanda.elencoPreferenze = elencoPreferenze;
								this.conferma = true;
							}
							else if (response.data.status == 400) {
								this.$dialog.alert({title: 'Attenzione', body: "Si &egrave; verificato un errore durante l'accettazione."});
								eventBus.$emit('setLog', "[accettaMaterna] " + response.data.error);
							}
							else {
								eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
								eventBus.$emit('setLog', "[accettaMaterna] " + response.data.error);
							}
							eventBus.$emit('setLoading', false);
						})
						.catch( (error) => {
							eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
							eventBus.$emit('setLog', "[accettaMaterna] " + error);
							eventBus.$emit('setLoading', false);			
						});
					})
					.catch( () => {
					});
				}
				else if (this.$validator.errors.items.length > 0) {
					let offSet = $('#'+this.$validator.errors.items[0].field).prop("tagName") == 'DIV' ? -130 : -170;
					this.$scrollTo('#'+this.$validator.errors.items[0].field, 500, {	offset: offSet });
				}
			});
		},
		rinuncia: function () {
			var messaggio = 'Si ricorda che &egrave; possibile rinunciare e restare in lista d\'attesa per due volte. La terza rinuncia comporter&agrave; la cancellazione dalla graduatoria cittadina.';
			if (this.preferenza.posto == 0) {
				messaggio = 'Si ricorda che la rinuncia al posto di 1&deg; scelta comporta la cancellazione dalla graduatoria cittadina.';
			}
			else if (this.rinunce == 2) {
				messaggio = 'Si ricorda che la terza rinuncia comporta la cancellazione dalla graduatoria cittadina.';			
			}
			this.$dialog.confirm({title: 'Attenzione', body: messaggio+"<br />Sei sicuro di voler rinunciare al posto?"}, {okText: 'conferma'})
			.then( (response) => {
				eventBus.$emit('setLoading', true);
				var datiPost = {
					'idDomanda': this.preferenza.domanda.idDomandaIscrizione,
					'codScuola': this.preferenza.domanda.elencoPreferenzeMaterna[this.preferenza.posto].codScuola,
					'codTipoFrequenza': this.preferenza.domanda.elencoPreferenzeMaterna[this.preferenza.posto].codTipoFrequenza,
					'codiceFiscaleRichiedente': this.richiedente,
					'codiceFiscaleOperatore': this.$root.user.id ? this.$root.user.id : ''
				};
				axios.post(urlapi + 'service.php?q=rinunciaMaterna', {'dati': datiPost}, { timeout: timeout })
				.then((response) => {
					if (response.data.status == 200) {
						//var elencoPreferenze = this.preferenza.domanda.elencoPreferenze;
						this.preferenza.domanda = response.data.domanda;
						//this.preferenza.domanda.elencoPreferenze = elencoPreferenze;
						this.conferma = true;
					}
					else if (response.data.status == 400) {
						this.$dialog.alert({title: 'Attenzione', body: "Si &egrave; verificato un errore durante la rinuncia."});
						eventBus.$emit('setLog', "[rinunciaMaterna] " + response.data.error);
					}
					else {
						eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[rinunciaMaterna] " + response.data.error);
					}					
					eventBus.$emit('setLoading', false);
				})
				.catch( (error) => {
					eventBus.$emit('setErroreDomande', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[rinunciaMaterna] " + error);
					eventBus.$emit('setLoading', false);			
				});
			})
			.catch( () => {
			});
		},
		stampaRicevuta: function () {
			window.print();
		},
		downloadRicevuta: function () {
			eventBus.$emit('downloadRicevuta', this.preferenza.domanda.idDomandaIscrizione);
		},	
	}
});