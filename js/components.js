Vue.component('luoghi', {
	inject: ['$validator'],
	data: function () {
	  return {
			province: [],
			comuni: [],
			disabledStato: true,
			disabledRegione: true,
			disabledProvincia: true,
			disabledComune: true
	  }
	},
	props: {
		stati: {
			type: Array,
			required: true
		},
		regioni: {
			type: Array,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
		value: {
			type: Object,
			required: true
		},
		casistica: {
			type: String,
			required: true,
			validator: function (value) {
				return ['nascita', 'residenza'].indexOf(value) !== -1
			}
		},
		soggetto: {
			type: [String, Object],
			required: false
		},
		required: {
			type: Boolean,
			required: false,
			default: true,
		},
	},
  computed: {
    luogo: function () {
			return this.value
		},
		datiSoggetto: function () {
			if (this.soggetto == undefined || this.soggetto == '') {
				var dati = {
					codNazione: '',
					descNazione: '',
					codRegione: '',
					descRegione: '',
					codProvincia: '',
					descProvincia: '',
					codComune: '',
					descComune: ''
				};
				if (this.casistica == 'residenza') {
					dati.cap = '';
					dati.indirizzo = '';
				}
				return dati;
			}
			else {
				return this.soggetto;
			}
		},
	},
	created: function () {
		if (this.datiSoggetto.codNazione == '') {
			this.disabledStato = false;
			if (this.luogo.codNazione == '000') {
				this.disabledRegione = false;
				if (this.luogo.codRegione != '') {
					eventBus.$emit('setLoading', true);
					axios.get(urlapi + 'service.php?q=province&regione=' + this.luogo.codRegione, { timeout: timeout })
					.then( (response) => {
						if (response.data.status == 200) {
							if (response.data.province) {
								this.province = response.data.province;
								this.disabledProvincia = false;
								if (this.luogo.codProvincia != '') {
									axios.get(urlapi + 'service.php?q=comuni&provincia=' + this.luogo.codProvincia, { timeout: timeout })
									.then( (response) => {
										if (response.data.status == 200) {
											if (response.data.comuni) {
												this.comuni = response.data.comuni;
												this.disabledComune = false;
											}
											else {
												eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
												eventBus.$emit('setLog', "[getComuni] Codice Provincia non trovato");
											}
										}
										else {
											eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
											eventBus.$emit('setLog', "[getComuni] " + response.data.error);
										}
										eventBus.$emit('setLoading', false);
									})
									.catch( (error) => {
										eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
										eventBus.$emit('setLog', "[getComuni] " + error);
										eventBus.$emit('setLoading', false);
									});
								}
								else {
									eventBus.$emit('setLoading', false);
								}
							}
							else {
								eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
								eventBus.$emit('setLog', "[getProvince] Codice Regione non trovato");
								eventBus.$emit('setLoading', false);
							}
						}
						else {
							eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
							eventBus.$emit('setLog', "[getProvince] " + response.data.error);
							eventBus.$emit('setLoading', false);
						}
					})
					.catch( (error) => {
						eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[getProvince] " + error);
						eventBus.$emit('setLoading', false);
					});
				}
			}
		}
		if (this.luogo.codNazione != '000') {
			if (this.datiSoggetto.codNazione == null) {
				this.luogo.codNazione = '';
			}
			this.luogo.codRegione = '';
			this.luogo.codProvincia = '';
			this.luogo.codComune = '';
		}
	},
	methods: {
		checkCodice: function (array, codice) {
			let obj = array.filter( function (item) {
				return item.codice == codice;
			});
			return obj.length ? obj[0].descrizione : '';
		},
		statoControl: function () {
			this.luogo.descNazione = this.checkCodice(this.stati, this.luogo.codNazione);
			if (this.luogo.codNazione != '000') {
				this.disabledRegione = true;
				this.luogo.codRegione = '';
				this.luogo.descRegione = '';

				this.disabledProvincia = true;
				this.luogo.codProvincia = '';
				this.luogo.descProvincia = '';

				this.disabledComune = true;
				this.luogo.codComune = '';
				this.luogo.descComune = '';

				if (this.casistica == 'residenza') {
					this.luogo.cap = '';
					this.luogo.indirizzo = '';
				}
			}
			else {
				this.disabledRegione = false;
				this.luogo.codRegione = '';
				this.luogo.descRegione = '';
			}
		},
		regioneControl: function () {
			this.luogo.descRegione = this.checkCodice(this.regioni, this.luogo.codRegione);
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=province&regione=' + this.luogo.codRegione, { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					if (response.data.province) {
						this.province = response.data.province;
						this.disabledProvincia = false;
						this.luogo.codProvincia = '';
						this.luogo.descProvincia = '';
						this.disabledComune = true;
						this.luogo.codComune = '';
						this.luogo.descComune = '';
						if (this.casistica == 'residenza') {
							this.luogo.cap = '';
							this.luogo.indirizzo = '';
						}
					}
					else {
						eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[getProvince] Codice Regione non trovato");
					}
					eventBus.$emit('setLoading', false);
				}
				else {
					eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getProvince] " + response.data.error);
					eventBus.$emit('setLoading', false);
				}
			})
			.catch( (error) => {
				eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getProvince] " + error);
				eventBus.$emit('setLoading', false);
			});
		},
		provinciaControl: function () {
			this.luogo.descProvincia = this.checkCodice(this.province, this.luogo.codProvincia);
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=comuni&provincia=' + this.luogo.codProvincia, { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					if (response.data.comuni) {
						this.comuni = response.data.comuni;
						this.disabledComune = false;
						this.luogo.codComune = '';
						this.luogo.descComune = '';
						if (this.casistica == 'residenza') {
							this.luogo.cap = '';
							this.luogo.indirizzo = '';
						}
					}
					else {
						eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
						eventBus.$emit('setLog', "[getComuni] Codice Provincia non trovato");
					}
					eventBus.$emit('setLoading', false);
				}
				else {
					eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
					eventBus.$emit('setLog', "[getComuni] " + response.data.error);
					eventBus.$emit('setLoading', false);
				}
			})
			.catch( (error) => {
				eventBus.$emit('showErroreDomanda', ERRORI['NO_SERVIZIO']);
				eventBus.$emit('setLog', "[getComuni] " + error);
				eventBus.$emit('setLoading', false);
			});
		},
		comuneControl: function () {
			this.luogo.descComune = this.checkCodice(this.comuni, this.luogo.codComune);
			if (this.casistica == 'residenza') {
				this.luogo.cap = '';
				this.luogo.indirizzo = '';
			}
		}
	},
	template:`\
		<div>\
			<div class="form-row">\
				<div class="form-group col-sm-12 col-md-3">\
					<label :for="target+index+'-stato-'+casistica" class="col-form-label">Stato di {{casistica}}<sub v-show="required" class="required">*</sub></label>\
					<template v-if="datiSoggetto.codNazione != ''">\
						<select class="form-control" :id="target+index+'-stato-'+casistica" :key="target+index+'-stato-'+casistica" :name="target+index+'-stato-'+casistica" v-model="luogo.descNazione" v-validate.disable="{required:required}" disabled>\
							<option>{{ luogo.descNazione }}</option>\
						</select>\
					</template>\
					<template v-else>\
						<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-stato-'+casistica)}" :id="target+index+'-stato-'+casistica" :key="target+index+'-stato-'+casistica" :name="target+index+'-stato-'+casistica" v-model="luogo.codNazione" v-validate.disable="{required:required}" :disabled="disabledStato" @change="statoControl">\
							<option :disabled="required" value="">- Seleziona lo stato -</option>\
							<option v-for="(stato, index) in stati" :key="index" :value="stato.codice">{{ stato.descrizione }}</option>\
						</select>\
						<span class="invalid-feedback" v-show="errors.has(target+index+'-stato-'+casistica)">{{ errors.first(target+index+'-stato-'+casistica) }}</span>\
					</template>\
				</div>\
				<div class="form-group col-sm-12 col-md-3">\
					<label :for="target+index+'-regione-'+casistica" class="col-form-label">Regione di {{casistica}}<sub v-show="required" class="required">*</sub></label>\
					<template v-if="datiSoggetto.codRegione != ''">\
						<select class="form-control" :id="target+index+'-regione-'+casistica" :key="target+index+'-regione-'+casistica" :name="target+index+'-regione-'+casistica" v-validate.disable="{required:required}" v-model="luogo.descRegione" disabled>\
							<option>{{ luogo.descRegione }}</option>\
						</select>\
					</template>\
					<template v-else>\
						<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-regione-'+casistica)}" :id="target+index+'-regione-'+casistica" :key="target+index+'-regione-'+casistica" :name="target+index+'-regione-'+casistica" v-validate.disable="{required:required}" v-model="luogo.codRegione" :disabled="disabledRegione" @change="regioneControl">\
							<option :disabled="required" value="">- Seleziona la regione -</option>\
							<option v-for="(regione, index) in regioni" :key="index" :value="regione.codice">{{ regione.descrizione }}</option>\
						</select>\
						<span class="invalid-feedback" v-show="errors.has(target+index+'-regione-'+casistica)">{{ errors.first(target+index+'-regione-'+casistica) }}</span>\
					</template>
				</div>\
				<div class="form-group col-sm-12 col-md-3">\
					<label :for="target+index+'-provincia-'+casistica" class="col-form-label">Provincia di {{casistica}}<sub v-show="required" class="required">*</sub></label>\
					<template v-if="datiSoggetto.codProvincia != ''">\
						<select class="form-control" :id="target+index+'-provincia-'+casistica" :key="target+index+'-provincia-'+casistica" :name="target+index+'-provincia-'+casistica" v-validate.disable="{required:required}" v-model="luogo.descProvincia" disabled>\
							<option>{{ luogo.descProvincia }}</option>\
						</select>\
					</template>\
					<template v-else>\
						<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-provincia-'+casistica)}" :id="target+index+'-provincia-'+casistica" :key="target+index+'-provincia-'+casistica" :name="target+index+'-provincia-'+casistica" v-validate.disable="{required:required}" v-model="luogo.codProvincia" :disabled="disabledProvincia" @change="provinciaControl">\
							<option :disabled="required" value="">- Seleziona la provincia -</option>\
							<option v-for="(provincia, index) in province" :key="index" :value="provincia.codice">{{ provincia.descrizione }}</option>\
						</select>\
						<span class="invalid-feedback" v-show="errors.has(target+index+'-provincia-'+casistica)">{{ errors.first(target+index+'-provincia-'+casistica) }}</span>\
					</template>\
				</div>\
				<div class="form-group col-sm-12 col-md-3">\
					<label :for="target+index+'-comune-'+casistica" class="col-form-label">Comune di {{casistica}}<sub v-show="required" class="required">*</sub></label>\
					<template v-if="datiSoggetto.codComune != ''">\
						<select class="form-control" :id="target+index+'-comune-'+casistica" :key="target+index+'-comune-'+casistica" :name="target+index+'-comune-'+casistica" v-validate.disable="{required:required}" v-model="luogo.descComune" disabled>\
							<option>{{ luogo.descComune }}</option>\
						</select>\
					</template>\
					<template v-else>\
						<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-comune-'+casistica)}" :id="target+index+'-comune-'+casistica" :key="target+index+'-comune-'+casistica" :name="target+index+'-comune-'+casistica" v-validate.disable="{required:required}" v-model="luogo.codComune" :disabled="disabledComune" @change="comuneControl">\
							<option :disabled="required" value="">- Seleziona il comune -</option>\
							<option v-for="(comune, index) in comuni" :key="index" :value="comune.codice">{{ comune.descrizione }}</option>\
						</select>\
						<span class="invalid-feedback" v-show="errors.has(target+index+'-comune-'+casistica)">{{ errors.first(target+index+'-comune-'+casistica) }}</span>\
					</template>\
				</div>\
			</div>\
			<div class="form-row" v-if="casistica == 'residenza'">\
				<div class="form-group col-md-3">\
					<label for="target+index+'-cap-residenza'">CAP residenza<sub v-show="required" class="required">*</sub></label>\
					<template v-if="datiSoggetto.cap != ''">\
						<input maxlength="5" type="text" class="form-control" :id="target+index+'-cap-residenza'" :key="target+index+'-cap-residenza'" :name="target+index+'-cap-residenza'" placeholder="Inserisci il cap" v-validate.disable="{required:required,digits:5,is_not:'10100'}" v-model="luogo.cap" disabled />\
					</template>\
					<template v-else>\
						<input maxlength="5" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-cap-residenza')}" :id="target+index+'-cap-residenza'" :key="target+index+'-cap-residenza'" :name="target+index+'-cap-residenza'" placeholder="Inserisci il cap"  v-mask="'#####'" v-validate.disable="{required:required,digits:5,is_not:'10100'}" v-model="luogo.cap" :disabled="disabledComune" />\
					</template>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-cap-residenza')">{{ errors.first(target+index+'-cap-residenza') }}</span>\
				</div>\
				<div class="form-group col-md-9">\
					<label for="target+index+'-indirizzo-residenza'">Indirizzo residenza<sub v-show="required" class="required">*</sub></label>\
					<template v-if="datiSoggetto.indirizzo != ''">\
						<input type="text" class="form-control" :id="target+index+'-indirizzo-residenza'" :key="target+index+'-indirizzo-residenza'" :name="target+index+'-indirizzo-residenza'" placeholder="Inserisci l'indirizzo" v-validate.disable="{required:required}" v-model="luogo.indirizzo" disabled />\
					</template>\
					<template v-else>\
						<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-indirizzo-residenza')}" :id="target+index+'-indirizzo-residenza'" :key="target+index+'-indirizzo-residenza'" :name="target+index+'-indirizzo-residenza'" placeholder="Inserisci l'indirizzo" v-validate.disable="{required:required}" v-model="luogo.indirizzo" :disabled="disabledComune" />\
						<span class="invalid-feedback" v-show="errors.has('minore-indirizzo-'+casistica)">{{ errors.first('minore-indirizzo-'+casistica) }}</span>\
					</template>\
				</div>\
			</div>\
		</div>\
	`,
});

Vue.component('home', {
	props: {
		famiglia: {
			type: Object,
			required: true
		},
	},
	data: function () {
		return {
			tipoDomanda: '',
			statoDomanda: false,
			showDomande: false,
			idDomanda: '',
			statoBozza: ''
		}
	},
	created: function() {
		eventBus.$on('showDomandaNido', (id, bozza) => {
			this.showDomandaNido(id, bozza);
		});
		eventBus.$on('showDomandaMaterna', (id, bozza) => {
			this.showDomandaMaterna(id, bozza);
		});
		eventBus.$on('accettaDomandaNido', (id) => {
			this.accettaDomandaNido(id);
		});
		eventBus.$on('rifiutaDomandaNido', (id) => {
			this.rifiutaDomandaNido(id);
		});
    eventBus.$on('setStatoDomanda', () => {
			this.statoDomanda = true;
		});
    eventBus.$on('indice', () => {
			this.indice();
		});
    eventBus.$on('showElencoDomande', () => {
			this.showElencoDomande();
		});
		this.tipoDomanda = '';
		this.statoBozza = '';
	},
	methods: {
		indice: function (event) {
			if (this.statoDomanda === true || this.tipoDomanda == '') {
				if (event && event.target.id == 'pills-elenco-tab') {
					eventBus.$emit('reloadDomande');
					this.showDomande = true;
				}
				else {
					this.showDomande = false;
				}
				if (event && event.target.id != 'pills-domanda-tab') {
					$('.nav-pills a[id="' + event.target.id + '"]').on('shown.bs.tab', (event) => {
						this.statoDomanda = false;
						this.idDomanda = '';
						this.tipoDomanda = '';
						this.statoBozza = '';
						$('.nav-pills a[id="' + event.target.id + '"]').off('shown.bs.tab');
					});
					$('.nav-pills a[id="' + event.target.id + '"]').tab('show');
				}
				else {
					this.statoDomanda = false;
					this.idDomanda = '';
					this.tipoDomanda = '';
					this.statoBozza = '';
					$('.nav-pills a[href="#domanda"]').tab('show');
				}
			}
			else {
				if (event) {
					event.stopPropagation();
				}
				this.$dialog.confirm({title: 'Attenzione', body: "I dati della domanda non salvati andranno persi.<br />Sei sicuro di voler proseguire?"}, {okText: 'conferma'})
				.then( (response) => {
					if (event && event.target.id != 'pills-domanda-tab') {
						$('.nav-pills a[id="' + event.target.id + '"]').on('shown.bs.tab', (event) => {
							if (event.target.id == 'pills-elenco-tab') {
								this.showDomande = true;
							}
							else {
								this.showDomande = false;
							}
							this.idDomanda = '';
							this.tipoDomanda = '';
							this.statoBozza = '';
							$('.nav-pills a[id="' + event.target.id + '"]').off('shown.bs.tab');
						});
						$('.nav-pills a[id="' + event.target.id + '"]').tab('show');
					}
					else {
						this.showDomande = false;
						this.idDomanda = '';
						this.tipoDomanda = '';
						this.statoBozza = '';
						$('.nav-pills a[href="#domanda"]').tab('show');
					}
				})
				.catch( () => {
				});
				$('.dropdown-menuHight').removeClass("show");						
			}
		},
		cambia: function () {
			let messaggio = "Si vuole veramente cambiare l'utente?";
			if (this.tipoDomanda != '' && this.statoDomanda === false) {
				messaggio = "Cambiando l'utente, i dati della domanda non salvati andranno persi.<br />Sei sicuro di voler proseguire?";
			}
			this.$dialog.confirm({title: 'Attenzione', body: messaggio}, {okText: 'conferma'})
			.then( (response) => {
				this.idDomanda = '';
				this.tipoDomanda = '';
				this.statoBozza = '';
				this.statoDomanda = false;
				eventBus.$emit('cambia');
			})
			.catch( () => {
			});
		},
    showElencoDomande: function () {
			$('.nav-pills a[href="#elenco"]').on('shown.bs.tab', (event) => {
				this.tipoDomanda = '';
				this.statoBozza = '';
				this.statoDomanda = false;
				this.showDomande = true;
				$(window).scrollTop(0);
				$('.nav-pills a[href="#elenco"]').off('shown.bs.tab');
			});
			$('.nav-pills a[href="#elenco"]').tab('show');
		},
		showDomandaNido: function (id = '', bozza = '') {
			this.idDomanda = id;
			this.showDomande = false;
			this.tipoDomanda = 'nido';
			this.statoBozza = bozza;
		},
		showDomandaMaterna: function (id = '', bozza = '') {
			this.idDomanda = id;
			this.showDomande = false;
			this.tipoDomanda = 'materna';
			this.statoBozza = bozza;
		},
	},
});

Vue.component('riepilogo-anagrafica', {
	template:`
		<div class="form-group col-md-12">\
			<strong><big>{{ soggetto.cognome }} {{ soggetto.nome }}</big></strong><br />
			{{ soggetto.codiceFiscale }}<br />\
			<template v-if="soggetto.sesso == 'M'">\
				Nato\
			</template>\
			<template v-else>\
				Nata\
			</template>\
			<template v-if="(luogoNascita.codNazione == '000' && luogoNascita.descComune == luogoNascita.descProvincia)">\
				a {{ luogoNascita.descComune }}\
			</template>\
			<template v-else-if="(luogoNascita.codNazione == '000' && luogoNascita.descComune != luogoNascita.descProvincia)">\
				a {{ luogoNascita.descComune }}, provincia di {{ luogoNascita.descProvincia }},\
			</template>\
			<template v-else-if="luogoNascita.codNazione != '000' && luogoNascita.descComune != ''">\
				a {{ luogoNascita.descComune }} ({{ luogoNascita.descNazione }})\
			</template>
			<template v-else-if="luogoNascita.codNazione != '000'">\
				in {{ luogoNascita.descNazione }}\
			</template>
			il {{ soggetto.dataNascita }}<slot></slot>\
			<template v-if="soggetto.descrizioneCittadinanza != ''">\
				<br />cittadinanza: {{ soggetto.descrizioneCittadinanza }}\
			</template>\
		</div>\
	`,
	props: {
		soggetto: {
			type: Object,
			required: true
		},
		luogoNascita: {
			type: Object,
			required: true
		},
	},
});

Vue.component('riepilogo-residenza', {
	template:`
		<div class="form-group col-md-12">\
			<strong>Residenza</strong>:\
			<template v-if="(residenza.codNazione == '000' && residenza.descComune == residenza.descProvincia)">\
				{{ residenza.indirizzo }} - {{ residenza.cap }} - {{ residenza.descComune }}\
			</template>\
			<template v-else-if="(residenza.codNazione == '000' && residenza.descComune != residenza.descProvincia)">\
				{{ residenza.indirizzo }} - {{ residenza.cap }} - {{ residenza.descComune }}, provincia di {{ residenza.descProvincia }}\
			</template>\
			<template v-else-if="residenza.codNazione != '000'">\
				{{ residenza.descNazione }}\
			</template>\
		</div>\
	`,
	props: {
		residenza: {
			type: Object,
			required: true
		},
	},
});

Vue.component('riepilogo-condizione-occupazionale', {
	template:`
		<div class="form-group col-md-12">\
			<hr />\
			<strong>Condizione occupazionale</strong>:\
			<template v-if="occupazione.stato == 'DIP'">\
				<br />persona con contratto di lavoro dipendente o parasubordinato<br />\
				<div class="m-3">\
					<strong>Azienda/societ&agrave;/ditta</strong>: {{occupazione.dati.dipendente.azienda}}<br />\
					<strong>Comune</strong>: {{occupazione.dati.dipendente.comune}}<br />\
					<strong>Provincia</strong>: {{occupazione.dati.dipendente.provincia}}<br />\
					<strong>Indirizzo</strong>: {{occupazione.dati.dipendente.indirizzo}}\
				</div>\
			</template>\
			<template v-if="occupazione.stato == 'AUT'">\
				<br />persona con lavoro autonomo, coadiuvante o con libera professione<br />\
				<div class="m-3">\
					<strong>Partita IVA</strong>: {{occupazione.dati.autonomo.piva}}<br />\
					<strong>Comune</strong>: {{occupazione.dati.autonomo.comune}}<br />\
					<strong>Provincia</strong>: {{occupazione.dati.autonomo.provincia}}<br />\
					<strong>Indirizzo</strong>: {{occupazione.dati.autonomo.indirizzo}}\
				</div>\
			</template>\
			<template v-if="occupazione.stato =='DIS_LAV'">\
				<br />persona disoccupata/non occupata che ha lavorato almeno 6 mesi nei precedenti 12<br />\
				<div v-for="(periodo, index) in occupazione.dati.nonOccupato" :key="index" :class="['p-3', {'border-bottom': index < occupazione.dati.nonOccupato.length-1}]">\
					<strong>Azienda/società/ditta</strong>: {{periodo.azienda}}<br />\
					<strong>Comune</strong>: {{periodo.comune}}<br />\
					<strong>Indirizzo</strong>: {{periodo.indirizzo}}<br />\
					<strong>Periodo lavorativo</strong>: {{periodo.dataInizio}} - {{periodo.dataFine}}\
				</div>\
			</template>\
			<template v-if="occupazione.stato == 'DIS'">\
				<br />persona disoccupata da almeno 3 mesi<br />\
				<div class="m-3">\
					<strong>Data dichiarazione di immediata disponibilità</strong>: {{occupazione.dati.disoccupato.dataDichiarazione}}<br />\
					<strong>Presentata presso</strong>:\
					<template v-if="occupazione.dati.disoccupato.soggettoDichiarazione == 'CI'">\
						centro per l'impiego del comune di {{occupazione.dati.disoccupato.datiCi.comune}}, provincia di {{occupazione.dati.disoccupato.datiCi.provincia}}<br />\
					</template>\
					<template v-else-if="occupazione.dati.disoccupato.soggettoDichiarazione == 'PA'">\
						Portale ANPAL (con completamento del processo presso Centro per l'impiego)<br />\
					</template>\
					<template v-else-if="occupazione.dati.disoccupato.soggettoDichiarazione == 'PR'">\
						Portale regionale\
					</template>\
					<template v-else-if="occupazione.dati.disoccupato.soggettoDichiarazione == 'PI'">\
						Portale INPS (per domanda NASPI, DIS-COLL, indennità di mobilità)<br />\
					</template>\
				</div>
			</template>\
			<template v-if="occupazione.stato == 'STU'">\
				studente<br />\
				<div class="ml-3">\
					<strong>Tipologia scuola/istituto/università</strong>: <span v-html="$options.filters.tipoCorso(occupazione.dati.studente.corso)" /><br />
					<strong>Nome ed indirizzo della scuola</strong>: {{occupazione.dati.studente.istituto}}\
				</div>\
			</template>\
			<template v-if="occupazione.stato == 'NO_COND'">\
				<br />nessuna delle condizioni elencate<br />\
			</template>\
		</div>\
	`,
	props: {
		occupazione: {
			type: Object,
			required: true
		},
	},
});

Vue.component('riepilogo-documenti', {
	template:`
		<div class="form-group col-md-12">\
			<template v-if="this.$slots.default">\
				<hr />\
				<strong><slot></slot></strong>: {{ soggetto.stato | siNo }}<br />\
			</template>\
			<template v-if="(soggetto.stato === true && riepilogoDocumenti.length)">\
				documenti allegati:\
				<ul class="m-0">\
					<li v-for="(documento, index) in riepilogoDocumenti" :key="index">{{documento.file.name}}</li>\
				</ul>\
			</template>\
		</div>\
	`,
	props: {
		soggetto: {
			type: Object,
			required: true
		},
	},
  computed: {
		riepilogoDocumenti: function () {
			let documenti = this.soggetto.documenti.filter( function (documento) {
				return documento.eliminato === false;
			});
			return documenti;
		}
	}
});

Vue.component('riepilogo-sentenza', {
	template:`
		<div v-if="(sentenza.numero != '' || sentenza.data != '' || sentenza.tribunale != '')" class="form-group col-md-12">\
			<slot></slot>\
			<template v-if="sentenza.numero != ''"><strong>Numero provvedimento</strong>: {{ sentenza.numero }}<br /></template>\
			<template v-if="sentenza.data != ''"><strong>Data provvedimento</strong>: {{ sentenza.data }}<br /></template>\
			<template v-if="sentenza.tribunale != ''"><strong>Tribunale del comune di</strong>: {{ sentenza.tribunale }}</template>\
		</div>\
	`,
	props: {
		sentenza: {
			type: Object,
			required: true
		},
	},
});

Vue.component('anagrafica', {
	inject: ['$validator'],
	props: {
		value: {
			type: Object,
			required: true
		},
		soggetto: {
			type: Object,
			required: false,
			default: function () {
				return  { codiceFiscale: '',
									cognome: '',
									dataNascita: '',
									nome: '',
									oraMinutiNascita: '',
									sesso: '',
									codiceCittadinanza: '',
									descrizioneCittadinanza: ''
								}
			}
		},
		cittadinanza: {
			type: Array,
			required: true
		},
		target: {
			type: String,
			required: true,
      validator: function (value) {
        return ['richiedente', 'minore', 'minoreMat' , 'soggetto1', 'soggetto2', 'soggetto3', 'altroComponente', 'affido', 'fratelloFrequentante'].indexOf(value) !== -1
      }
		},
		ora: {
			type: Boolean,
			required: false
		},
		checkData: {
			type: [Number, Boolean],
			required: false,
			default: false,
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
		required: {
			type: Boolean,
			required: false,
			default: true,
		},
	},
	methods: {
		checkCodice: function (array, codice) {
			let obj = array.filter( function (item) {
				return item.codice == codice;
			});
			this.anagrafica.descrizioneCittadinanza = obj.length ? obj[0].descrizione : '';
		}
	},
  computed: {
    anagrafica: function () {
			return this.value
		},
		getDataValidation: function() {
			let validationString = "required|date_format:DD/MM/YYYY|lt_oggi:eq|data_nascita_cf:"+this.anagrafica.codiceFiscale;
			if (this.target == 'minore') {
				validationString +="|nidi_data_nascita:"+this.checkData;
			}
			else if (this.target == 'minoreMat') {
				validationString += "|materne_data_nascita:"+this.checkData;
			}
			return validationString;
		},
	},
	template:`\
		<div>\
			<div class="form-row">\
				<div class="form-group col-sm-12 col-md-6">\
					<label :for="target+index+'-codice-fiscale'" class="col-form-label">Codice fiscale<sub v-show="required" class="required">*</sub></label>\
					<template v-if="soggetto.codiceFiscale != ''">\
						<input maxlength="16" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-codice-fiscale')}" :id="target+index+'-codice-fiscale'" :key="target+index+'-codice-fiscale'" :name="target+index+'-codice-fiscale'" placeholder="inserisci il codice fiscale" v-model="anagrafica.codiceFiscale" v-validate.disable="{required:required,alpha_num:true,length:16,regex:/^[a-zA-Z0-9]{16}$/,check_cf:true}" disabled />\
					</template>\
					<template v-else>\
						<input maxlength="16" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-codice-fiscale')}" :id="target+index+'-codice-fiscale'" :key="target+index+'-codice-fiscale'" :name="target+index+'-codice-fiscale'" placeholder="inserisci il codice fiscale" v-model="anagrafica.codiceFiscale" v-validate.disable="{required:required,alpha_num:true,length:16,regex:/^[a-zA-Z0-9]{16}$/,check_cf:true}" v-mask="'NNNNNNNNNNNNNNNN'" />\
					</template>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-codice-fiscale')">{{ errors.first(target+index+'-codice-fiscale') }}</span>\
				</div>\
				<div class="form-group col-sm-12 col-md-4">\
					<label :for="target+index+'-cittadinanza'" class="col-form-label">Cittadinanza<sub class="required">*</sub></label>\
					<template v-if="soggetto.codiceCittadinanza != ''">\
						<select class="form-control" :id="target+index+'-cittadinanza'" :key="target+index+'-cittadinanza'" :name="target+index+'-cittadinanza'" v-model="anagrafica.descrizioneCittadinanza" v-validate.disable="'required'" disabled>\
							<option>{{ anagrafica.descrizioneCittadinanza }}</option>\
						</select>\
					</template>\
					<template v-else>\
						<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-cittadinanza')}" :id="target+index+'-cittadinanza'" :key="target+index+'-cittadinanza'" :name="target+index+'-cittadinanza'" v-model="anagrafica.codiceCittadinanza" v-validate.disable="'required'" @change="checkCodice(cittadinanza, anagrafica.codiceCittadinanza)">\
							<option value="" disabled>- Seleziona la cittadinanza -</option>\
							<option v-for="(cittadino, index) in cittadinanza" :key="index" :value="cittadino.codice">{{ cittadino.descrizione }}</option>\
						</select>\
						<span class="invalid-feedback" v-show="errors.has(target+index+'-cittadinanza')">{{ errors.first(target+index+'-cittadinanza') }}</span>\
					</template>\
				</div>\
			</div>\
			<div class="form-row">\
				<div class="form-group col-sm-12 col-md-6">\
					<label :for="target+index+'-cognome'" class="col-form-label">Cognome<sub class="required">*</sub></label>\
					<input type="text" :disabled="soggetto.cognome != ''" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-cognome')}" :id="target+index+'-cognome'" :name="target+index+'-cognome'" :key="target+index+'-cognome'" placeholder="Inserisci il cognome" v-model="anagrafica.cognome" v-validate.disable="'required'" />\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-cognome')">{{ errors.first(target+index+'-cognome') }}</span>\
				</div>\
				<div class="form-group col-sm-12 col-md-6">\
					<label :for="target+index+'-nome'" class="col-form-label">Nome<sub class="required">*</sub></label>\
					<input type="text" :disabled="soggetto.nome != ''" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-nome')}" :id="target+index+'-nome'" :name="target+index+'-nome'" :key="target+index+'-nome'" placeholder="Inserisci il nome" v-model="anagrafica.nome" v-validate.disable="'required'" />\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-nome')">{{ errors.first(target+index+'-nome') }}</span>\
				</div>\
			</div>\
			<div class="form-row">\
				<div :id="target+index+'-sesso'" :class="[{'form-group':true, 'col-sm-12':true}, ora ? 'col-md-3' : 'col-md-6']">\
					<label class="col-form-label col-md-12">Sesso<sub v-show="required" class="required">*</sub></label>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-sesso-m'" :key="target+index+'-sesso-m'" :name="target+index+'-sesso'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-sesso')}" value="M" v-model="anagrafica.sesso" :disabled="soggetto.sesso != ''" v-validate.disable="{required:required}" />\
						<label class="custom-control-label" :for="target+index+'-sesso-m'">Maschio</label>\
					</div>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-sesso-f'" :key="target+index+'-sesso-f'" :name="target+index+'-sesso'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-sesso')}" value="F" v-model="anagrafica.sesso" :disabled="soggetto.sesso != ''" />\
						<label class="custom-control-label" :for="target+index+'-sesso-f'">Femmina</label>\
					</div>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-sesso')">{{ errors.first(target+index+'-sesso') }}</span>\
				</div>\

				<div :class="[{'form-group':true, 'col-sm-12':true}, ora ? 'col-md-5' : 'col-md-6']">\
					<label for="target+index+'-data-nascita'" class="col-form-label">Data di nascita</label><sub class="required">*</sub>\
					<template v-if="soggetto.dataNascita != ''" >\
						<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-data-nascita')}" :id="target+index+'-data-nascita'" :key="target+index+'-data-nascita'" :name="target+index+'-data-nascita'" placeholder="Inserisci la data di nascita nel formato GG/MM/AAAA"  v-validate.disable="{required:true,date_format:'DD/MM/YYYY',lt_oggi:'eq',data_nascita_cf:anagrafica.codiceFiscale}" v-model="anagrafica.dataNascita" disabled />\
					</template>\
					<template v-else>\
						<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-data-nascita')}" :id="target+index+'-data-nascita'" :key="target+index+'-data-nascita'" :name="target+index+'-data-nascita'" placeholder="Inserisci la data di nascita nel formato GG/MM/AAAA"  v-validate.disable="getDataValidation" v-model="anagrafica.dataNascita" v-mask="'##/##/####'" />\
					</template>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-data-nascita')">{{ errors.first(target+index+'-data-nascita') }}</span>\
				</div>\
				
				<div v-if="ora" class="form-group col-sm-12 col-md-4">\
					<label for="target+index+'-ora-nascita'" class="col-form-label">Ora di nascita<sub v-show="required" class="required">*</sub></label>\
					<template v-if="soggetto.oraMinutiNascita != ''">\
						<input maxlength="5" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-ora-nascita')}" :id="target+index+'-ora-nascita'" :key="target+index+'-ora-nascita'" :name="target+index+'-ora-nascita'" placeholder="Inserisci l'ora di nascita nel formato HH:MM" v-model="anagrafica.oraMinutiNascita" v-validate.disable="{required:required,date_format:'HH:mm'}" disabled />\
					</template>\
					<template v-else>\
						<input maxlength="5" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-ora-nascita')}" :id="target+index+'-ora-nascita'" :key="target+index+'-ora-nascita'" :name="target+index+'-ora-nascita'" placeholder="Inserisci l'ora di nascita nel formato HH:MM" v-model="anagrafica.oraMinutiNascita" v-validate.disable="{required:required,date_format:'HH:mm'}" v-mask="'##:##'" />\
					</template>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-ora-nascita')">{{ errors.first(target+index+'-ora-nascita') }}</span>\
				</div>\
			</div>\
		</div>\
	`,
});

Vue.component('stato-gravidanza', {
	inject: ['$validator'],
	props: {
		value: {
			type: Object,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
	},
  computed: {
    gravidanza: function () {
			return this.value
		}
	},
  template: `\
		<div>
			<div class="form-row">\
				<div :id="target+index+'-gravidanza'" class="form-group col-md-12">\
					<slot></slot>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-gravidanza-si'" :key="target+index+'-gravidanza-si'" :name="target+index+'-gravidanza'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-gravidanza')}" :value="true" v-model="gravidanza.stato" v-validate.disable="'required'" />\
						<label class="custom-control-label" :for="target+index+'-gravidanza-si'">Si</label>\
					</div>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-gravidanza-no'" key="target+index+'-gravidanza-no'" :name="target+index+'-gravidanza'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-gravidanza')}" :value="false" v-model="gravidanza.stato" />\
						<label class="custom-control-label" :for="target+index+'-gravidanza-no'">No</label>\
					</div>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-gravidanza')">{{ errors.first(target+index+'-gravidanza') }}</span>\
				</div>\
			</div>\
			<template v-if="gravidanza.stato === true" v-cloak>\
				<div class="card hight col-md-10 mb-7 ml-2">\
					<div class="card-body">\
						<div class="alert alert-info fade show" role="alert">\
							<p>Allegare certificato medico in cui &egrave; indicata la data presunta del parto</p>\
						</div>\
						<documenti v-model="gravidanza.documenti" :target="target+'Gravidanza'" :key="target+'DocumentiGravidanza'"></documenti>\
					</div>
				</div>
			</template>
		</div>
	`,
});

Vue.component('problemi-salute', {
	inject: ['$validator'],
	props: {
		value: {
			type: Object,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
	},
  computed: {
    salute: function () {
			return this.value
		}
	},
  template: `\
		<div>
			<div class="form-row">\
				<div :id="target+index+'-problemi-salute'" class="form-group col-md-12">\
					<slot></slot>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-problemi-salute-si'" :name="target+index+'-problemi-salute'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-problemi-salute')}" :key="target+index+'-problemi-salute-si'" :value="true" v-model="salute.stato" v-validate.disable="'required'" />\
						<label class="custom-control-label" :for="target+index+'-problemi-salute-si'">Si</label>\
					</div>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-problemi-salute-no'" :name="target+index+'-problemi-salute'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-problemi-salute')}" :key="target+index+'-problemi-salute-no'" :value="false" v-model="salute.stato" />\
						<label class="custom-control-label" :for="target+index+'-problemi-salute-no'">No</label>\
					</div>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-problemi-salute')">{{ errors.first(target+index+'-problemi-salute') }}</span>\
				</div>\
			</div>\
			<template v-if="salute.stato === true" v-cloak>\
				<div class="col-md-10 mb-7 ml-2 card hight">\
					<div class="card-body">\
						<div class="alert alert-info fade show" role="alert">\
							<p>Allegare certificati medici recenti, attestanti la grave patologia e lo stato di salute attuale.<br />\
							Gli eventuali certificati di invalidit&agrave; o handicap allegati devono specificare la diagnosi.</p>\
						</div>\
						<documenti v-model="salute.documenti" :target="target+index+'Salute'" :key="target+index+'DocumentiSalute'" :index="index"></documenti>\
					</div>
				</div>
			</template>
		</div>
	`,
});

Vue.component('condizione-occupazionale', {
	inject: ['$validator'],
  data: function () {
    return {
			corsi: [
				{
					value: 'UNI',
					descrizione: 'Università'
				},
				{
					value: 'MUNI',
					descrizione: 'Master post universitari'
				},
				{
					value: 'SEC1',
					descrizione: 'Secondaria I grado'
				},
				{
					value: 'SEC2',
					descrizione: 'Secondaria II grado'
				},
				{
					value: 'FP',
					descrizione: 'Formazione professionale'
				},
				{
					value: 'CPIA',
					descrizione: 'CPIA'
				},
				{
					value: 'TFE',
					descrizione: 'Tirocini formativi extracurriculari'
				},
				{
					value: 'ALFA',
					descrizione: 'Corso Alfabetizzazione'
				}
			],
		}
	},
	props: {
		value: {
			type: Object,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		dataNascita: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
	},
  computed: {
    condizione: function () {
			return this.value
		}
	},
  watch: {
    'condizione.stato': function (newVal, oldVal) {
			if (newVal == 'NN') {
				this.condizione.dati = domandaNido('soggetto1.condizioneOccupazionale.dati');
			}
			else {
				if (newVal != 'DIP') {
					this.condizione.dati.dipendente = domandaNido('soggetto1.condizioneOccupazionale.dati.dipendente');
				}
				if (newVal != 'AUT') {
					this.condizione.dati.autonomo = domandaNido('soggetto1.condizioneOccupazionale.dati.autonomo');
				}
				if (newVal != 'DIS') {
					this.condizione.dati.disoccupato = domandaNido('soggetto1.condizioneOccupazionale.dati.disoccupato');
				}
				if (newVal == 'DIS' && this.condizione.dati.disoccupato.soggettoDichiarazione != 'CI') {
					this.condizione.dati.disoccupato.datiCi = domandaNido('soggetto1.condizioneOccupazionale.dati.disoccupato.datiCi');
				}
				if (newVal != 'DIS_LAV') {
					this.$validator.errors.remove('periodi-occupazione');
					this.condizione.dati.nonOccupato = domandaNido('soggetto1.condizioneOccupazionale.dati.nonOccupato');
				}
				if (newVal != 'STU') {
					this.condizione.dati.studente = domandaNido('soggetto1.condizioneOccupazionale.dati.studente');
				}
			}
		}
	},
  methods: {
    addPeriodo: function (id) {
			this.condizione.dati.nonOccupato.splice(id+1, 0,	domandaNido('soggetto1.condizioneOccupazionale.dati.nonOccupato[0]'));
			this.$validator.reset();
		},
    removePeriodo: function (id) {
			this.$dialog.confirm({title: 'Attenzione', body: "Sei sicuro di voler eliminare il periodo?"}, {okText: 'conferma'})
			.then( (response) => {
				this.condizione.dati.nonOccupato.splice(id, 1);
				this.$validator.reset();
			})
			.catch( () => {
			});
		}
  },
  template: `\
		<div :id="target+index+'-occupazione'" class="form-row">\
			<div class="form-group col-md-12">\
				<slot></slot>\				
				<div class="custom-control custom-radio">\
					<input type="radio" :id="target+index+'-occupazione-dipendente'" :key="target+index+'-occupazione-dipendente'" :name="target+index+'-occupazione'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione')}" value="DIP" v-model="condizione.stato" v-validate.disable="'required'" />\
					<label class="custom-control-label" :for="target+index+'-occupazione-dipendente'">Persona con contratto di lavoro dipendente o parasubordinato</label>\
				</div>\
			</div>\
			<template v-if="condizione.stato == 'DIP'" v-cloak>\
				<div class="card hight col-md-10 mb-4 ml-5">\
					<div class="card-body">\
						<div class="form-row">
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-dipendente-azienda'">Azienda/societ&agrave;/ditta presso cui lavora<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-dipendente-azienda')}" :id="target+index+'-occupazione-dipendente-azienda'" :key="target+index+'-occupazione-dipendente-azienda'" :name="target+index+'-occupazione-dipendente-azienda'" placeholder="Inserisci il nome dell'azienda/societa'/ditta" v-model="condizione.dati.dipendente.azienda" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-dipendente-azienda')">{{ errors.first(target+index+'-occupazione-dipendente-azienda') }}</span>\
							</div>\
							<comune-torino-altro v-model="condizione.dati.dipendente.comune" :target="target+index+'-occupazione-dipendente'" :key="target+index+'-occupazione-dipendente'"></comune-torino-altro>\
							<!-- div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-dipendente-comune'">Comune in cui lavora<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-dipendente-comune')}" :id="target+index+'-occupazione-dipendente-comune'" :key="target+index+'-occupazione-dipendente-comune'" :name="target+index+'-occupazione-dipendente-comune'" placeholder="Inserisci il comune" v-model="condizione.dati.dipendente.comune" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-dipendente-comune')">{{ errors.first(target+index+'-occupazione-dipendente-comune') }}</span>\
							</div -->\
						</div>\
						<div class="form-row">
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-dipendente-provincia'">Provincia in cui lavora<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-dipendente-provincia')}" :id="target+index+'-occupazione-dipendente-provincia'" :key="target+index+'-occupazione-dipendente-provincia'" :name="target+index+'-occupazione-dipendente-provincia'" placeholder="Inserisci la provincia" v-model="condizione.dati.dipendente.provincia" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-dipendente-provincia')">{{ errors.first(target+index+'-occupazione-dipendente-provincia') }}</span>
							</div>\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-dipendente-indirizzo'">Indirizzo luogo di lavoro (via/corso)<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-dipendente-indirizzo')}" :id="target+index+'-occupazione-dipendente-indirizzo'" :key="target+index+'-occupazione-dipendente-indirizzo'" :name="target+index+'-occupazione-dipendente-indirizzo'" placeholder="Inserisci l'indirizzo" v-model="condizione.dati.dipendente.indirizzo" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-dipendente-indirizzo')">{{ errors.first(target+index+'-occupazione-dipendente-indirizzo') }}</span>\
							</div>\
						</div>\
					</div>\
				</div>\
			</template>\
			<div class="form-group col-md-12">\
				<div class="custom-control custom-radio">\
					<input type="radio" :id="target+index+'-occupazione-autonomo'" :key="target+index+'-occupazione-autonomo'" :name="target+index+'-occupazione'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione')}" value="AUT" v-model="condizione.stato" />\
					<label class="custom-control-label" :for="target+index+'-occupazione-autonomo'">Persona con lavoro autonomo, coadiuvante o con libera professione</label>\
				</div>\
			</div>\
			<template v-if="condizione.stato == 'AUT'" v-cloak>\
				<div class="card hight col-md-10 mb-4 ml-5">\
					<div class="card-body">\
						<div class="form-row">\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-autonomo-piva'">Partita IVA<sub class="required">*</sub></label>\
								<input type="text" maxlength="16" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-autonomo-piva')}" :id="target+index+'-occupazione-autonomo-piva'" :key="target+index+'-occupazione-autonomo-piva'" :name="target+index+'-occupazione-autonomo-piva'" placeholder="Inserisci p. iva/codice fiscale" v-model="condizione.dati.autonomo.piva" v-validate.disable="'required|alpha_num|min:11|max:16'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-autonomo-piva')">{{ errors.first(target+index+'-occupazione-autonomo-piva') }}</span>\
							</div>\
							<comune-torino-altro v-model="condizione.dati.autonomo.comune" :target="target+index+'-occupazione-autonomo'" :key="target+index+'-occupazione-autonomo'"></comune-torino-altro>\
							<!-- div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-autonomo-comune'">Comune in cui lavora<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-autonomo-comune')}" :id="target+index+'-occupazione-autonomo-comune'" :key="target+index+'-occupazione-autonomo-comune'" :name="target+index+'-occupazione-autonomo-comune'" placeholder="Inserisci il comune" v-model="condizione.dati.autonomo.comune" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-autonomo-comune')">{{ errors.first(target+index+'-occupazione-autonomo-comune') }}</span>\
							</div -->\
						</div>\
						<div class="form-row">\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-autonomo-provincia'">Provincia in cui lavora<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-autonomo-provincia')}" :id="target+index+'-occupazione-autonomo-provincia'" :key="target+index+'-occupazione-autonomo-provincia'" :name="target+index+'-occupazione-autonomo-provincia'" placeholder="Inserisci la provincia" v-model="condizione.dati.autonomo.provincia" v-validate.disable="'required'"/>\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-autonomo-provincia')">{{ errors.first(target+index+'-occupazione-autonomo-provincia') }}</span>
							</div>\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-autonomo-indirizzo'">Indirizzo luogo di lavoro (via/corso)<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-autonomo-indirizzo')}" :id="target+index+'-occupazione-autonomo-indirizzo'" :key="target+index+'-occupazione-autonomo-indirizzo'" :name="target+index+'-occupazione-autonomo-indirizzo'" placeholder="Inserisci l'indirizzo" v-model="condizione.dati.autonomo.indirizzo" v-validate.disable="'required'"/>\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-autonomo-indirizzo')">{{ errors.first(target+index+'-occupazione-autonomo-indirizzo') }}</span>\
							</div>\
						</div>\
					</div>\
				</div>\
			</template>\
			<div class="form-group col-md-12">\
				<div id="periodi-occupazione" class="custom-control custom-radio">\
					<input type="radio" :id="target+index+'-occupazione-non-occupato'" :key="target+index+'-occupazione-non-occupato'" :name="target+index+'-occupazione'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione') || errors.has('periodi-occupazione')}" value="DIS_LAV" v-model="condizione.stato" />\
					<label class="custom-control-label" :for="target+index+'-occupazione-non-occupato'">Persona disoccupata/non occupata che ha lavorato almeno 6 mesi nei precedenti 12</label>\
					<span class="invalid-feedback" v-show="errors.has('periodi-occupazione')">{{ errors.first('periodi-occupazione') }}</span>\
				</div>\
			</div>\
			<template v-if="condizione.stato == 'DIS_LAV'" v-cloak>\
				<div v-for="(periodo, indice) in condizione.dati.nonOccupato" :key="indice" class="card hight col-md-10 mb-4 ml-5">\
					<div class="card-body">\
						<div class="form-row">\
							<div class="form-group col-sm-12 col-md-9">\
								<label :for="target+index+indice+'-occupazione-non-occupato-azienda'">Azienda/societ&agrave;/ditta presso cui ha lavorato o P.IVA<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+indice+'-occupazione-non-occupato-azienda')}" :id="target+index+indice+'-occupazione-non-occupato-azienda'" :key="target+index+indice+'-occupazione-non-occupato-azienda'" :name="target+index+indice+'-occupazione-non-occupato-azienda'" placeholder="Inserisci azienda/societa'/ditta o P.IVA" v-model="periodo.azienda" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+indice+'-occupazione-non-occupato-azienda')">{{ errors.first(target+index+indice+'-occupazione-non-occupato-azienda') }}</span>\
							</div>\
						</div>\
						<div class="form-row">\
							<h4>Sede datore di lavoro</h4>\
						</div>\
						<div class="form-row">\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+indice+'-occupazione-non-occupato-comune'">Comune<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+indice+'-occupazione-non-occupato-comune')}" :id="target+index+indice+'-occupazione-non-occupato-comune'" :key="target+index+indice+'-occupazione-non-occupato-comune'" :name="target+index+indice+'-occupazione-non-occupato-comune'" placeholder="Inserisci il comune" v-model="periodo.comune" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+indice+'-occupazione-non-occupato-comune')">{{ errors.first(target+index+indice+'-occupazione-non-occupato-comune') }}</span>\
							</div>\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+indice+'-occupazione-non-occupato-indirizzo'">Indirizzo<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+indice+'-occupazione-non-occupato-indirizzo')}" :id="target+index+indice+'-occupazione-non-occupato-indirizzo'" :key="target+index+indice+'-occupazione-non-occupato-indirizzo'" :name="target+index+indice+'-occupazione-non-occupato-indirizzo'" placeholder="Inserisci l'indirizzo" v-model="periodo.indirizzo" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+indice+'-occupazione-non-occupato-indirizzo')">{{ errors.first(target+index+indice+'-occupazione-non-occupato-indirizzo') }}</span>\
							</div>\
						</div>\
						<div class="form-row">\
							<h4>Periodo lavorativo</h4>\
						</div>\
						<div class="form-row">\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+indice+'-occupazione-non-occupato-inizio'">Dal<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+indice+'-occupazione-non-occupato-inizio')}" :id="target+index+indice+'-occupazione-non-occupato-inizio'" :key="target+index+indice+'-occupazione-non-occupato-inizio'" :name="target+index+indice+'-occupazione-non-occupato-inizio'" placeholder="Inserisci data in formato GG/MM/AAAA" v-model="periodo.dataInizio" v-validate.disable="'required|date_format:DD/MM/YYYY|lt_oggi:eq'" v-mask="'##/##/####'" :ref="target+index+indice+'-occupazione-non-occupato-inizio'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+indice+'-occupazione-non-occupato-inizio')">{{ errors.first(target+index+indice+'-occupazione-non-occupato-inizio') }}</span>\
							</div>\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+indice+'-occupazione-non-occupato-fine'">Al<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+indice+'-occupazione-non-occupato-fine')}" :id="target+index+indice+'-occupazione-non-occupato-fine'" :key="target+index+indice+'-occupazione-non-occupato-fine'" :name="target+index+indice+'-occupazione-non-occupato-fine'" placeholder="Inserisci data in formato GG/MM/AAAA" v-model="periodo.dataFine" v-validate.disable="'required|date_format:DD/MM/YYYY|lt_oggi:eq|after:'+target+index+indice+'-occupazione-non-occupato-inizio,true'" v-mask="'##/##/####'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+indice+'-occupazione-non-occupato-fine')">{{ errors.first(target+index+indice+'-occupazione-non-occupato-fine') }}</span>\
							</div>\
						</div>\
						<div class="form-row pt-4">\
							<div class="form-group col-sm-12 text-right">\
								<button type="button" class="btn btn-secondary" @click="addPeriodo(indice)"><i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi periodo</button>\
								<button  v-show="condizione.dati.nonOccupato.length > 1" type="button" class="btn btn-secondary" @click="removePeriodo(indice)"><i class="fa fa-times-circle" aria-hidden="true"></i> Elimina periodo</button>\
							</div>\
						</div>\
					</div>\
				</div>\
			</template>\
			<div class="form-group col-md-12">\
				<div class="custom-control custom-radio">\
					<input type="radio" :id="target+index+'-occupazione-disoccupato'" :key="target+index+'-occupazione-disoccupato'" :name="target+index+'-occupazione'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione')}" value="DIS" v-model="condizione.stato" />\
					<label class="custom-control-label" :for="target+index+'-occupazione-disoccupato'">Persona disoccupata da almeno 3 mesi</label>\
				</div>\
			</div>\
			<template v-if="condizione.stato == 'DIS'" v-cloak>\
				<div class="card hight col-md-10 mb-4 ml-5">\
					<div class="card-body">\
						<div class="form-row">\
							<div class="form-group col-md-12">\
								<label :for="target+index+'-occupazione-disoccupato-data-dichiarazione'">Dichiarazione di immediata disponibilit&agrave; al lavoro presentata in data<sub class="required">*</sub></label>\
								<input maxlength="10" type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-data-dichiarazione')}" :id="target+index+'-occupazione-disoccupato-data-dichiarazione'" :name="target+index+'-occupazione-disoccupato-data-dichiarazione'" :key="target+index+'-occupazione-disoccupato-data-dichiarazione'" placeholder="Inserisci la data nel formato GG/MM/AAAA" v-model="condizione.dati.disoccupato.dataDichiarazione" v-validate.disable="'required|date_format:DD/MM/YYYY|lt_oggi:eq|disoccupazione_data|gt_data:'+this.dataNascita+',false'" v-mask="'##/##/####'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-disoccupato-data-dichiarazione')">{{ errors.first(target+index+'-occupazione-disoccupato-data-dichiarazione') }}</span>
							</div>\
						</div>\
						<div :id="target+index+'-occupazione-disoccupato-soggetto-dichiarazione'" class="form-row">\
							<div class="form-group col-md-12">\
								<div class="custom-control custom-radio">\
									<input type="radio" :id="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-ci'" :name="target+index+'-occupazione-disoccupato-soggetto-dichiarazione'" :key="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-ci'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-soggetto-dichiarazione')}" value="CI" v-model="condizione.dati.disoccupato.soggettoDichiarazione" v-validate.disable="'required'" />\
									<label class="custom-control-label" :for="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-ci'">Centro per l'impiego</label>\
								</div>\
							</div>\
							<template v-if="condizione.dati.disoccupato.soggettoDichiarazione == 'CI'" v-cloak>\
								<div class="form-row col-md-11 ml-5">\
									<div class="form-group col-sm-12 col-md-6">\
										<label :for="target+index+'-occupazione-disoccupato-comune-ci'">Centro per l'impiego del comune di<sub class="required">*</sub></label>\
										<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-comune-ci')}" :id="target+index+'-occupazione-disoccupato-comune-ci'" :key="target+index+'-occupazione-disoccupato-comune-ci'" :name="target+index+'-occupazione-disoccupato-comune-ci'" placeholder="Inserisci comune" v-model="condizione.dati.disoccupato.datiCi.comune" v-validate.disable="'required'" />\
										<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-disoccupato-comune-ci')">{{ errors.first(target+index+'-occupazione-disoccupato-comune-ci') }}</span>
									</div>\
									<div class="form-group col-sm-12 col-md-6">\
										<label :for="target+index+'-occupazione-disoccupato-provincia-ci'">Provincia di<sub class="required">*</sub></label>\
										<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-provincia-ci')}" :id="target+index+'-occupazione-disoccupato-provincia-ci'" :key="target+index+'-occupazione-disoccupato-provincia-ci'" :name="target+index+'-occupazione-disoccupato-provincia-ci'" placeholder="Inserisci la provincia" v-model="condizione.dati.disoccupato.datiCi.provincia" v-validate.disable="'required'" />\
										<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-disoccupato-provincia-ci')">{{ errors.first(target+index+'-occupazione-disoccupato-provincia-ci') }}</span>\
									</div>\
								</div>\
							</template>\
							<div class="form-group col-md-12">\
								<div class="custom-control custom-radio">\
									<input type="radio" :id="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pa'" :name="target+index+'-occupazione-disoccupato-soggetto-dichiarazione'" :key="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pa'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-soggetto-dichiarazione')}" value="PA" v-model="condizione.dati.disoccupato.soggettoDichiarazione" />\
									<label class="custom-control-label" :for="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pa'">Portale ANPAL (con completamento del processo presso Centro per l'impiego)</label>\
								</div>\
							</div>\
							<!-- div class="form-group col-md-12">\
								<div class="custom-control custom-radio">\
									<input type="radio" :id="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pr'" :name="target+index+'-occupazione-disoccupato-soggetto-dichiarazione'" :key="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pr'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-soggetto-dichiarazione')}" value="PR" v-model="condizione.dati.disoccupato.soggettoDichiarazione" />\
									<label class="custom-control-label" :for="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pr'">Portale regionale</label>\
								</div>\
							</div -->\
							<div class="form-group col-md-12">\
								<div class="custom-control custom-radio">\
									<input type="radio" :id="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pi'" :name="target+index+'-occupazione-disoccupato-soggetto-dichiarazione'" :key="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pi'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione-disoccupato-soggetto-dichiarazione')}" value="PI" v-model="condizione.dati.disoccupato.soggettoDichiarazione" />\
									<label class="custom-control-label" :for="target+index+'-occupazione-disoccupato-soggetto-dichiarazione-pi'">Portale INPS (per domanda NASPI, DIS-COLL, indennit&agrave; di mobilit&agrave;)</label>\
								</div>\
							</div>\
							<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-disoccupato-soggetto-dichiarazione')">{{ errors.first(target+index+'-occupazione-disoccupato-soggetto-dichiarazione') }}</span>\
						</div>\
					</div>\
				</div>\
			</template>\
			<div class="form-group col-md-12">\
				<div class="custom-control custom-radio">\
					<input type="radio" :id="target+index+'-occupazione-studente'" :key="target+index+'-occupazione-studente'" :name="target+index+'-occupazione'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione')}" value="STU" v-model="condizione.stato" />\
					<label class="custom-control-label" :for="target+index+'-occupazione-studente'">Studente</label>\
				</div>\
			</div>\
			<template v-if="condizione.stato == 'STU'" v-cloak>\
				<div class="card hight col-md-10 mb-4 ml-5">\
					<div class="card-body">\
						<div class="form-row">\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-studente-corso'">Tipologia scuola/istituto/universit&agrave;<sub class="required">*</sub></label>\
								<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-studente-corso')}" :id="target+index+'-occupazione-studente-corso'" :name="target+index+'-occupazione-studente-corso'" :key="target+index+'-occupazione-studente-corso'" v-model="condizione.dati.studente.corso" v-validate.disable="'required'">\
									<option disabled value="">- Seleziona una tipologia -</option>\
									<option v-for="(corso, index) in corsi" :key="index" :value="corso.value">\
										{{ corso.descrizione }}\
									</option>\
								</select>\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-studente-corso')">{{ errors.first(target+index+'-occupazione-studente-corso') }}</span>\
							</div>\
							<div class="form-group col-sm-12 col-md-6">\
								<label :for="target+index+'-occupazione-studente-istituto'">Nome e indirizzo della scuola<sub class="required">*</sub></label>\
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-occupazione-studente-istituto')}" :id="target+index+'-occupazione-studente-istituto'" :key="target+index+'-occupazione-studente-istituto'" :name="target+index+'-occupazione-studente-istituto'" placeholder="Inserisci nome e indirizzo" v-model="condizione.dati.studente.istituto" v-validate.disable="'required'" />\
								<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione-studente-istituto')">{{ errors.first(target+index+'-occupazione-studente-istituto') }}</span>\
							</div>\
						</div>\
					</div>\
				</div>\
			</template>\
			<div class="form-group col-md-12">\
				<div class="custom-control custom-radio">\
					<input type="radio" :id="target+index+'-occupazione-nulla'" :key="target+index+'-occupazione-nulla'" :name="target+index+'-occupazione'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-occupazione')}" value="NO_COND" v-model="condizione.stato" />\
					<label class="custom-control-label" :for="target+index+'-occupazione-nulla'">Nessuna di queste condizioni</label>\
				</div>\
			</div>\
			<span class="invalid-feedback" v-show="errors.has(target+index+'-occupazione')">campo obbligatorio</span>\
		</div>\
	`,
});

Vue.component('comune-torino-altro', {
	inject: ['$validator'],
	props: {
		value: {
			type: String,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
	},
  data: function () {
    return {
			radio: '',
			altroComune: ''
		}
	},
	created: function() {
		if (this.value != '') {
			this.radio = /^torino$/i.test(this.value) ? true : false,
			this.altroComune = this.radio === false ? this.value : ''
		}
	},
	methods: {
		change: function () {
			if (this.radio === true) {
				this.altroComune = '';
				this.$emit('input', 'TORINO');
			}
			else {
				this.$emit('input', this.altroComune);
			}
		}
	},
  template: `\
		<div :id="target+index+'-comune'" class="form-group col-sm-12 col-md-6">\
			<label>Comune in cui lavora<sub class="required">*</sub></label>\
			<div class="form-row">\
				<div class="form-group col-sm-12 col-md-5">\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-comune-torino'" :key="target+index+'-comune-torino'" :name="target+index+'-comune'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-comune')}" :value="true" v-validate.disable="'required'" v-model="radio" @change="change" />\
						<label class="custom-control-label" :for="target+index+'-comune-torino'">Torino</label>\
					</div>\
					<div class="custom-control custom-radio custom-control-inline">\
						<input type="radio" :id="target+index+'-comune-altro'" key="target+index+'-comune-altro'" :name="target+index+'-comune'" :class="{'custom-control-input':true, 'is-invalid': errors.has(target+index+'-comune')}" :value="false" v-model="radio" @change="change" />\
						<label class="custom-control-label" :for="target+index+'-comune-altro'">Altro</label>\
					</div>\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-comune')">{{ errors.first(target+index+'-comune') }}</span>\
				</div>\
				<div class="form-group col-sm-12 col-md-7" v-if="this.radio === false" >\
					<input type="text" :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-comune-altro-nome')}" :id="target+index+'-comune-altro-nome'" :key="target+index+'-comune-altro-nome'" :name="target+index+'-comune-altro-nome'" placeholder="Inserisci il comune" v-validate.disable="'required'" v-model="altroComune" @input="change" />\
					<span class="invalid-feedback" v-show="errors.has(target+index+'-comune-altro-nome')">{{ errors.first(target+index+'-comune-altro-nome') }}</span>\
				</div>\
			</div>\
		</div>\
	`,
});

Vue.component('dati-sentenza', {
	inject: ['$validator'],
	props: {
		value: {
			type: Object,
			required: true
		},
		id: {
			type: String,
			required: true
		},
		required: {
			type: Boolean,
			required: false,
			default: true,
		}		
	},
  computed: {
    sentenza: function () {
			return this.value
		}
	},
  template: `\
		<div>\
			<slot></slot>\
			<div class="form-row">\
				<div class="form-group col-sm-12 col-md-6">\
					<label :for="'numero-sentenza-'+id">Numero provvedimento<sub v-show="required" class="required">*</sub></label>\
					<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('numero-sentenza-'+id)}" :key="'numero-sentenza-'+id" :name="'numero-sentenza-'+id" :id="'numero-sentenza-'+id" placeholder="Inserisci il numero della sentenza" v-model="sentenza.numero" v-validate.disable="{required:required}" v-mask="'NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN'" />\
					<span class="invalid-feedback" v-show="errors.has('numero-sentenza-'+id)">{{ errors.first('numero-sentenza-'+id) }}</span>\
				</div>\
				<div class="form-group col-sm-12 col-md-6">\
					<label :for="'data-sentenza-'+id">Data provvedimento<sub v-show="required" class="required">*</sub></label>\
					<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('data-sentenza-'+id)}" :key="'data-sentenza-'+id" :name="'data-sentenza-'+id" :id="'data-sentenza-'+id" placeholder="Inserisci la data nel formato GG/MM/AAAA" v-model="sentenza.data" v-validate.disable="{required:required,date_format:'DD/MM/YYYY',lt_oggi:'eq'}" v-mask="'##/##/####'" />\
					<span class="invalid-feedback" v-show="errors.has('data-sentenza-'+id)">{{ errors.first('data-sentenza-'+id) }}</span>\
				</div>\
			</div>\
			<div class="form-row">\
				<div class="form-group col-sm-12 col-md-10">\
					<label :for="'tribunale-sentenza-'+id">Tribunale del comune di<sub v-show="required" class="required">*</sub></label>\
					<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('tribunale-sentenza-'+id)}" :key="'tribunale-sentenza-'+id" :name="'tribunale-sentenza-'+id" :id="'tribunale-sentenza-'+id" placeholder="Inserisci il comune" v-model="sentenza.tribunale" v-validate.disable="{required:required}" />\
					<span class="invalid-feedback" v-show="errors.has('tribunale-sentenza-'+id)">{{ errors.first('tribunale-sentenza-'+id) }}</span>\
				</div>\
			</div>\
		</div>\
	`,
});

Vue.component('grado-parentela', {
	inject: ['$validator'],
  data: function () {
    return {
			grado: this.value,
			relazioni: {
				nucleo: [{
					value: 'FGL',
					descrizione: 'Figlio/figlia'
				},
				{
					value: 'MIN_AFF',
					descrizione: 'Minore in affidamento L.184/83'
				},
				{
					value: 'ALT_COM',
					descrizione: 'Altro componente del nucleo'
				}],
				affido: [{
					value: 'MIN_AFF',
					descrizione: 'Minore in affidamento L.184/83'
				}],
			}
    }
	},
	props: {
		value: {
			type: String,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
		casistica: {
			type: String,
			required: true,
      validator: function (value) {
        return ['nucleo','affido'].indexOf(value) !== -1
      }
		},
	},
	created: function() {
		if (this.casistica == 'affido' && this.grado != 'MIN_AFF') {
			this.grado = 'MIN_AFF';
			this.$emit('input', this.grado);
		}
	},
	methods: {
		select: function () {
			this.$emit('input', this.grado);
		}
	},
  template: `\
		<div class="form-row">\
			<div class="form-group col-md-6">\
				<slot></slot>\
				<select :class="{'form-control':true, 'is-invalid': errors.has(target+index+'-grado-parentela')}" :id="target+index+'-grado-parentela'" :name="target+index+'-grado-parentela'" :key="target+index+'-grado-parentela'" v-model="grado" v-validate.disable="'required'" @change="select">\
					<option disabled value="" v-if="casistica != 'affido'">- Seleziona un grado di parentela -</option>\
					<option v-for="(relazione, index) in relazioni[casistica]" :key="index" :value="relazione.value">\
						{{ relazione.descrizione }}\
					</option>\
				</select>\
				<span class="invalid-feedback" v-show="errors.has(target+index+'-grado-parentela')">{{ errors.first(target+index+'-grado-parentela') }}</span>\
			</div>\
		</div>\
	`,
});

Vue.component('documenti', {
	inject: ['$validator'],
	props: {
		value: {
			type: Array,
			required: true
		},
		target: {
			type: String,
			required: true
		},
		index: {
			type: [String, Number],
			required: false,
			default: '',
		},
	},
  computed: {
    	documenti: function () {
			return this.value
		},
		countDocumenti: function () {
			let documenti = this.documenti.filter( function (documento) {
				return documento.eliminato === false;
			});
			return documenti.length;
		}
	},
	methods: {
		addDocumento: function (event) {
			this.$validator.validate(event.target.name)
			.then(() => {
				if (!this.$validator.errors.has(event.target.name)) {
					let maxLoop = 5 - this.countDocumenti;
					for (let i = 0; i < event.target.files.length; i++) {
						if (i >= maxLoop) { break; }
						this.documenti.push({
							id: '',
							eliminato: false,
							file: event.target.files[i],
							name: event.target.files[i].name,
							type: event.target.files[i].type,
						});
						this.$validator.errors.remove(event.target.name);
					}
				}
				event.target.value = '';
			});
		},
		removeDocumento: function(id, reset) {
			this.$dialog.confirm({title: 'Attenzione', body: 'Sei sicuro di voler eliminare il file <strong>' + this.documenti[id].file.name + '</strong>?'}, {okText: 'conferma'})
			.then( (response) => {
				if (this.documenti[id].id == '') {
					this.documenti.splice(id, 1);
				}
				else {
					this.documenti[id].eliminato = true;
				}
				this.$validator.errors.remove(reset+'-uploadDocumento');
			})
			.catch( () => {
			});
		},
		downloadDocumento: function(documento) {
			eventBus.$emit('setLoading', true);
			axios.get(urlapi + 'service.php?q=file&idDocumento=' + documento.id + '&cf=' + this.$root.$children[0].$children[0].domanda.richiedente.anagrafica.codiceFiscale + '&idDomanda=' + this.$root.$children[0].$children[0].domanda.idDomandaIscrizione, { responseType: 'blob', timeout: timeout })
			.then((response) => {
				if (navigator.msSaveBlob) {
					let blob = new Blob([response.data], {
						type: documento.file.type
					});
					navigator.msSaveBlob(blob, documento.file.name);
				}
				else {
					let link = document.createElement('a');
					link.href = window.URL.createObjectURL(new Blob([response.data], { type: documento.file.type }));
					link.download = documento.file.name;
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
				}
				eventBus.$emit('setLoading', false);
			})
			.catch( (error) => {
				eventBus.$emit('setLog', "[getFile] " + error);
				this.$dialog.alert({title: 'Attenzione', body: "Non &egrave; stato possibile recuperare il file"});
				eventBus.$emit('setLoading', false);
			});
		}
	},
	template:`
		<div class="form-row">\
			<div class="form-group col-sm-12" v-if="!countDocumenti">\
				<div class="input-group col-lg-6 pl-0">\
					<input type="text" class="form-control bg-white" value="Nessun file selezionato" disabled />\
				</div>\
			</div>\
			<template v-else v-cloak>
				<div class="form-group col-sm-12" v-for="(documento, id) in documenti" :key="id" v-if="documento.eliminato === false">\
					<div class="input-group col-lg-6 pl-0">\
						<input type="text" :class="[{'form-control':true,'bg-white':true}, documento.id != '' ? 'border-info' : '']" :id="target+index+id+'-documento'" :key="target+index+id+'-documento'" :name="target+index+id+'-documento'" v-model="documento.file.name" disabled />\
						<div class="input-group-append" v-show="documento.id != ''">\
							<a class="btn btn-secondary" role="button" href='#' @click.prevent="downloadDocumento(documento)"><i class="fas fa-download"></i></a>
						</div>\
						<div class="input-group-append">\
							<span class="btn" role="button" @click.prevent="removeDocumento(id, target+index)"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></span>\
						</div>\
					</div>\
				</div>\
			</template>\
			<div class="form-group space-top-btn col-sm-12">\
				<span class="invalid-feedback mb-1" v-show="errors.has(target+index+'-uploadDocumento')">{{ errors.first(target+index+'-uploadDocumento') }}</span>\
				<label :for="target+index+'-uploadDocumento'" role="button" :class="{btn:true,'btn-secondary':true,disabled:countDocumenti > 4}" >\
					<i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi documento\
					<input style="display:none" type="file" @change="addDocumento($event, target+index)" :id="target+index+'-uploadDocumento'" :key="target+index+'-uploadDocumento'" :name="target+index+'-uploadDocumento'" v-validate.disable="{mimes:'tif|tiff|gif|jpeg|jpg|png|bmp|pdf',size:2048}" :disabled="countDocumenti > 4" multiple />\
				</label>\
			</div>\
			<small class="ml-2">\
				massimo <strong>5</strong> documenti (formato PDF o immagine) con dimensione massima di <strong>2Mb</strong>.<br />\
				<strong>ATTENZIONE</strong>: l\'immagine del documento deve essere leggibile, altrimenti il documento non verr&agrave; preso in considerazione\
			</small>\
		</div>\
	`,
});
