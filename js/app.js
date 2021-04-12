Vue.use(VeeValidate, { events: '' });
Vue.use(VueMask.VueMaskPlugin);
window.Vue.use(VuejsDialog.main.default, {
  html: true,
  loader: false,
  okText: 'chiudi',
  cancelText: 'annulla',
  animation: 'fade'
});

var urlapi = 'proxy/';
var timeout = '30000';

var eventBus = new Vue();

var ERRORI = {
  NO_SERVIZIO: { stato: true, tipo: 'danger',  messaggio: '<strong><big>ERRORE</big></strong><br />Il servizio non &egrave; al momento disponibile a causa di un problema tecnico!<br /> In attesa che venga risolto, invitiamo a riprovare pi&ugrave; tardi' },
	NO_NOTIFICATORE: { stato: true, tipo: 'warning',  messaggio: '<strong><big>ATTENZIONE</big></strong><br />Verificare di aver inserito nel proprio profilo Torinofacile il numero di cellulare e di aver autorizzato l\'invio delle comunicazioni via SMS per il servizio "Iscrizioni On-line Nidi e Scuole dell\'infanzia per la Citt&agrave; di Torino".</p><p><a href="https://servizi.torinofacile.it/cgi-bin/accesso/base/index.cgi?task=impostazioni" target="_blank">Accedi a MIO Torinofacile</a>' },
};
var saveLog = true;

new Vue({
	el: '#app',
	data: {
		showLoading: false,
		showRicerca: null,
		showRisultatoRicerca: false,
		ricercaCf: '',
		user: '',
		famiglia: '',
		errore: {
			stato: false,
			tipo: '',
			messaggio: ''
		}
	},
  created: function () {
		this.$validator.localize('it');
		eventBus.$on('setLoading', status => {
			this.showLoading = status;
		});
		eventBus.$on('cambia', () => {
			this.getRichiedente();
		});
		eventBus.$on('showErrore', (errore) => {
			this.setErrore(errore);
		});
		eventBus.$on('setLog', (testoLog) => {
			this.setLog(testoLog);
		});		
		this.getAuth();
  },	
	methods: {
		getAuth: function () {
			this.showLoading = true;
			axios.get(urlapi + 'service.php?q=auth', { timeout: timeout })
			.then( (response) => {
				if (response.data.status == 200) {
					this.user = response.data.user;
					axios.get(urlapi + 'service.php?q=famiglia', { timeout: timeout })
					.then( (response) => {
						if (response.data.status != 200) {
							this.setErrore(ERRORI['NO_SERVIZIO']);
							this.setLog("[getDatiFamiglia] " + response.data.error);
							this.showLoading = false;
						}
						else {
							this.famiglia = response.data.famiglia;
							if (this.famiglia.richiedente == '') {
								this.showRicerca = true;
							}
							else {
								this.showRicerca = false;
							}
							this.showLoading = false;
						}
					})
					.catch( (error) => {
						this.setErrore(ERRORI['NO_SERVIZIO']);
						this.setLog("[getDatiFamiglia] " + error);
						this.showLoading = false;					
					});
				}
				else {
					this.setErrore(ERRORI['NO_SERVIZIO']);
					this.setLog("[getDatiAuth] Servizio non raggiungibile");
					this.showLoading = false;
				}
			})
			.catch( (error) => {
				this.setErrore(ERRORI['NO_SERVIZIO']);
				this.setLog("[getDatiAuth] " + error);
				this.showLoading = false;
			});
		},
		cercaRichiedente: function () {
			this.showRisultatoRicerca = false;
			this.$validator.validateAll().then(() => {
				if (!this.errors.any()) {
					this.showLoading = true;
					this.ricercaCf = this.ricercaCf.toUpperCase();
					axios.get(urlapi + 'service.php?q=famiglia&cf='+this.ricercaCf, { timeout: timeout })
					.then( (response) => {
						if (response.data.status != 200) {
							this.setErrore(ERRORI['NO_SERVIZIO']);
							this.setLog("[cercaRichiedente] " + response.data.error);
						}
						else {
							this.famiglia = response.data.famiglia;
							this.showRisultatoRicerca = true;
						}
						this.showLoading = false;
					})
					.catch( (error) => {
						this.setErrore(ERRORI['NO_SERVIZIO']);
						this.setLog("[cercaRichiedente] " + error);
						this.showLoading = false;					
					})
				}
			});
		},
		setRichiedente: function () {
			this.ricercaCf = '';
			this.showRicerca = false;
			this.showRisultatoRicerca = false;
		},		
		getRichiedente: function () {
			this.showLoading = true;
			this.showRicerca = null;
			axios.get(urlapi + 'service.php?q=famiglia', { timeout: timeout })
			.then( (response) => {
				if (response.data.status != 200) {
					this.setErrore(ERRORI['NO_SERVIZIO']);
					this.setLog("[getRichiedente] " + response.data.error);
				}
				else {
					this.famiglia = response.data.famiglia;
					this.ricercaCf = '';
					this.showRisultatoRicerca = false;
					this.showRicerca = true;
				}
				this.showLoading = false;
			})
			.catch( (error) => {
				this.setErrore(ERRORI['NO_SERVIZIO']);
				this.setLog("[getRichiedente] " + error);
				this.showLoading = false;					
			});
		},
		setErrore: function (errore) {
			this.errore.stato = errore.stato;
			if (errore.stato) {
				this.errore.tipo = errore.tipo;
				this.errore.messaggio = errore.messaggio;
				this.showRicerca = false;
				this.showRisultatoRicerca = false;
			}
			else {
				this.errore.tipo = '';
				this.errore.messaggio = '';
			}
		},
		setLog: function (testoLog) {
			if (saveLog) {
				console.log(testoLog);
			}
		},
	},
});
