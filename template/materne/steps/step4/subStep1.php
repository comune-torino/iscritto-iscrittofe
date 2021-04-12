<h2 class="no-bottom">Ricevuta</h2>
<div class="form-step">
	<div class="alert alert-success fade show" role="alert">
		<h3 class="alert-heading">Domanda inviata!</h3>
		<p>L'invio della domanda di iscrizione n&deg; <strong>{{ protocolloRicevuto }}</strong> per l'anno scolastico <strong>{{ annoScolasticoRicevuto }}</strong> &egrave; andato a buon fine.</p>
		<p>Potrai vedere e stampare la domanda inviata selezionandola dalla voce <strong>"Le tue domande".</strong></p>
		<p>Sarai avvisato dell'ammissione alla scuola con un SMS al numero indicato nei dati di contatto di Torino Facile.<br />
		Dovrai confermare l'ammissione accedendo a Torino Facile - Iscrizione Scuole d'infanzia, sezione "le tue domande".<br />
		La mancata conferma nei termini stabiliti verr&agrave; considerata rinuncia al posto.</p>
		<p>Per frequentare la scuola d'infanzia il bambino o la bambina deve essere in regola con gli obblighi vaccinali.</p>
		<p>Se nella domanda non &egrave; stata allegata la documentazione necessaria per la valutazione delle dichiarate
		condizioni di disabilit&agrave; o sanitarie del bambino, di problemi sanitari di un componente del nucleo o di stato di gravidanza,
		la documentazione potr&agrave; essere allegata secondo le modalit&agrave; indicate alla pagina delle <a href="http://www.comune.torino.it/servizieducativi/36/" target="blank">Scuole d'infanzia</a> del Comune di Torino.<br />
		In mancanza della documentazione le condizioni citate non saranno prese in considerazione per la valutazione del punteggio.</p>
		<p>Tutte le informazioni relative alle graduatorie e all'accettazione del posto sono reperibili sul <a href="http://www.comune.torino.it/servizieducativi/36/" target="blank">sito del Comune di Torino</a>.</p>
	</div>
	<div class="btn-group row">
		<div class="col-sm-12 col-md-12 col-lg-8"><!--space--></div>
		<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
			<a class="btn btn-primary" href="#" role="button" @click.prevent.stop="showElencoDomande">Vai alle tue domande</a>
		</div>
	</div>
</div>
