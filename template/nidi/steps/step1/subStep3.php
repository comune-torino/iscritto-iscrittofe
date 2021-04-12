<h2 class="no-bottom">Dati bambino o bambina da iscrivere</h2>
<div class="form-step">
	<div class="alert alert-warning fade show" role="alert">
		<p><strong><big>ATTENZIONE</big></strong><br />
		In caso di fratelli o sorelle deve essere fatta una domanda per ogni bambino o bambina</p>
	</div>
	<template v-if="famiglia.minorenniNido.length > 0" v-cloak>
		<div id="minore-presenza-nucleo" class="form-row">
			<div class="form-group col-md-12">
				<label class="col-form-label label-light col-md-12">Il bambino o la bambina &egrave; presente nel tuo nucleo familiare anagrafico?<sub class="required">*</sub></label>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="minore-presenza-nucleo-si" name="minore-presenza-nucleo" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-presenza-nucleo')}" :value="true" v-model="domanda.minore.presenzaNucleo" @change="coabitazioneMinore" v-validate.disable="'required'" />
					<label class="custom-control-label" for="minore-presenza-nucleo-si">Si</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="minore-presenza-nucleo-no" name="minore-presenza-nucleo" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-presenza-nucleo')}" :value="false" v-model="domanda.minore.presenzaNucleo" @change="coabitazioneMinore" />
					<label class="custom-control-label" for="minore-presenza-nucleo-no">No</label>
				</div>
				<span class="invalid-feedback" v-show="errors.has('minore-presenza-nucleo')">{{ errors.first('minore-presenza-nucleo') }}</span>
			</div>
			<template v-if="(famiglia.minorenniNido.length > 0 && domanda.minore.presenzaNucleo === true)" v-cloak>
				<div id="minore-nucleo" class="form-group col-md-12">
					<label class="col-form-label label-light col-md-12">Scegli dal tuo nucleo familiare il bambino o la bambina da iscrivere<sub class="required">*</sub></label>
					<hr />
					<div v-for="(iscritto, index) in famiglia.minorenniNido" :key="index" class="custom-control custom-radio">
						<input type="radio" :id="'nidoMinore'+index" name="minore-nucleo" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-nucleo')}" :value="iscritto.anagrafica.codiceFiscale" v-model="domanda.minore.anagrafica.codiceFiscale" v-validate.disable="'required'" @change="setMinore" />
						<label class="custom-control-label" :for="'nidoMinore'+index">
							<big><strong>{{ iscritto.anagrafica.cognome }} {{ iscritto.anagrafica.nome }}</strong></big><br />
							{{ iscritto.anagrafica.codiceFiscale }}<br />
							<template v-if="iscritto.anagrafica.sesso == 'M'">
								nato a
							</template>
							<template v-else>
								nata a
							</template>
							<template v-if="(iscritto.luogoNascita.codNazione == '000' && iscritto.luogoNascita.descComune == iscritto.luogoNascita.descProvincia)">
								{{ iscritto.luogoNascita.descComune }}
							</template>
							<template v-else-if="(iscritto.luogoNascita.codNazione == '000' && iscritto.luogoNascita.descComune != iscritto.luogoNascita.descProvincia)">
								{{ iscritto.luogoNascita.descComune }}, provincia di {{ iscritto.luogoNascita.descProvincia }},
							</template>
							<template v-else-if="iscritto.luogoNascita.codNazione != '000'">
								{{ iscritto.luogoNascita.descComune }} ({{ iscritto.luogoNascita.descNazione }})
							</template>
							il {{ iscritto.anagrafica.dataNascita }} alle ore {{ iscritto.anagrafica.oraMinutiNascita }}<br />
							cittadinanza: {{ iscritto.anagrafica.descrizioneCittadinanza }}
						</label>
						<span v-show="errors.has('minore-nucleo')" class="invalid-feedback ml-4">{{ errors.first('minore-nucleo') }}</span>
						<hr />
					</div>
				</div>
			</template>
		</div>
	</template>
	<template v-if="showFormMinore" v-cloak>
		<template v-if="showFormAnagraficaMinore" v-cloak>
			<h3>Dati anagrafici</h3>
			<anagrafica v-model="domanda.minore.anagrafica" :ora="true" :check-data="famiglia.annoLimiteNido" :cittadinanza="cittadinanza" target="minore" key="minoreAnagrafica"></anagrafica>
			<luoghi v-model="domanda.minore.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="minore" key="minoreNascita"></luoghi>
			<luoghi v-model="domanda.minore.residenza" :stati="stati" :regioni="regioni" casistica="residenza" target="minore" key="minoreResidenza"></luoghi>
			<div class="form-row mt-6">
				<div id="minore-residenza-richiedente" class="form-group col-md-12">
					<label class="col-form-label col-md-12">Coabiti con il bambino o la bambina?<sub class="required">*</sub></label>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="minore-residenza-richiedente-si" name="minore-residenza-richiedente" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-residenza-richiedente')}" :value="true" v-model="domanda.minore.residenzaConRichiedente" v-validate.disable="'required'" />
						<label class="custom-control-label" for="minore-residenza-richiedente-si">Si</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="minore-residenza-richiedente-no" name="minore-residenza-richiedente" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-residenza-richiedente')}" :value="false" v-model="domanda.minore.residenzaConRichiedente" />
						<label class="custom-control-label" for="minore-residenza-richiedente-no">No</label>
					</div>
					<span class="invalid-feedback" v-show="errors.has('minore-residenza-richiedente')">{{ errors.first('minore-residenza-richiedente') }}</span>
					<p><small>Si intende "coabitante" chi &egrave; presente nello stesso stato di famiglia o chi, pur non risultando nello stesso stato di famiglia, di fatto abita con il bambino o la bambina.</small></p>
				</div>
			</div>
		</template>
		<div class="form-row">
			<div id="richiedente-relazione-minore" class="form-group col-md-12">
				<label class="col-form-label col-md-12">Relazione con il bambino o la bambina<sub class="required">*</sub></label>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="richiedente-relazione-minore-g" name="richiedente-relazione-minore" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-relazione-minore')}" value="GEN" v-model="domanda.richiedente.relazioneConMinore" v-validate.disable="'required'" />
					<label class="custom-control-label" for="richiedente-relazione-minore-g">Genitore</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="richiedente-relazione-minore-a" name="richiedente-relazione-minore" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-relazione-minore')}" value="AFF" v-model="domanda.richiedente.relazioneConMinore" />
					<label class="custom-control-label" for="richiedente-relazione-minore-a">Persona affidataria</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="richiedente-relazione-minore-t" name="richiedente-relazione-minore" :class="{'custom-control-input':true, 'is-invalid': errors.has('richiedente-relazione-minore')}" value="TUT" v-model="domanda.richiedente.relazioneConMinore" />
					<label class="custom-control-label" for="richiedente-relazione-minore-t">Persona tutrice</label>
				</div>
				<span class="invalid-feedback" v-show="errors.has('richiedente-relazione-minore')">{{ errors.first('richiedente-relazione-minore') }}</span>
				<p><small>La definizione Genitore comprende anche Genitrice; nelle pagine successive comprende anche i casi di persona affidataria o tutrice.</small></p>
			</div>
		</div>
		<h3>Condizioni di priorit&agrave;</h3>
		<div class="form-row">
			<div id="minore-disabilita-salute" class="form-group col-md-12">
				<h4>Disabilit&agrave; o problemi di salute</h4>
				<label class="col-form-label label-light col-md-12">Il bambino o la bambina per cui si presenta domanda ha una disabilit&agrave; o gravi problemi di salute?<sub class="required">*</sub></label>
				<div class="custom-control custom-radio">
					<input type="radio" id="minore-disabilita" name="minore-disabilita-salute" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-disabilita-salute')}" :value="true" v-model="domanda.minore.disabilita.stato" v-validate.disable="'required'" @change="domanda.minore.problemiSalute.stato = false" />
					<label class="custom-control-label" for="minore-disabilita">Si, ha una disabilit&agrave;</label>
				</div>
				<template v-if="domanda.minore.disabilita.stato === true" v-cloak>
					<div class="card hight col-md-10 mb-4 ml-2">
						<div class="card-body">
							<div class="alert alert-info fade show" role="alert">
								<p>Allegare il profilo descrittivo di funzionamento o la diagnosi funzionale o il certificato INPS di riconoscimento dell'handicap ovvero certificazioni rilasciate da strutture sanitarie pubbliche di Neuro Psichiatria Infantile</p>
							</div>
							<documenti v-model="domanda.minore.disabilita.documenti" target="minoreDisabilita" key="minoreDocumentiDisabilita" ></documenti>
						</div>
					</div>
				</template>
				<div class="custom-control custom-radio">
					<input type="radio" id="minore-salute" name="minore-disabilita-salute" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-disabilita-salute')}" :value="true" v-model="domanda.minore.problemiSalute.stato" @change="domanda.minore.disabilita.stato = false" />
					<label class="custom-control-label" for="minore-salute">Si, ha gravi problemi di salute</label>
				</div>
				<template v-if="domanda.minore.problemiSalute.stato === true" v-cloak>
					<div class="card hight col-md-10 mb-4 ml-2">
						<div class="card-body">
							<div class="alert alert-info fade show" role="alert">
								<p>Allegare certificati medici recenti, attestanti la grave patologia e lo stato di salute attuale.<br />
								Gli eventuali certificati di invalidit&agrave; o handicap allegati devono specificare la diagnosi.</p>
							</div>
							<documenti v-model="domanda.minore.problemiSalute.documenti" target="minoreSalute" key="minoreDocumentiSalute"></documenti>
						</div>
					</div>
				</template>
				<div class="custom-control custom-radio">
					<input type="radio" id="minore-null" name="minore-disabilita-salute" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-disabilita-salute')}" :checked="domanda.minore.disabilita.stato === false && domanda.minore.problemiSalute.stato === false" @change="domanda.minore.disabilita.stato = domanda.minore.problemiSalute.stato = false" />
					<label class="custom-control-label" for="minore-null">No, nessuna disabilit&agrave; o gravi problemi di salute</label>
				</div>
			</div>
			<span class="invalid-feedback" v-show="errors.has('minore-disabilita-salute')">{{ errors.first('minore-disabilita-salute') }}</span>													
		</div>
		<div class="form-row">
			<div id="minore-servizi" class="form-group col-md-12">
				<h4>Servizi Sociali</h4>
				<label class="col-form-label label-light col-md-12">La famiglia &egrave; seguita dai Servizi Sociali del Comune di Torino o del Ministero di Giustizia?<sub class="required">*</sub></label>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="minore-servizi-si" name="minore-servizi" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-servizi')}" :value="true" v-model="domanda.minore.serviziSociali.stato" v-validate.disable="'required'" />
					<label class="custom-control-label" for="minore-servizi-si">Si</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="minore-servizi-no" name="minore-servizi" :class="{'custom-control-input':true, 'is-invalid': errors.has('minore-servizi')}" :value="false" v-model="domanda.minore.serviziSociali.stato" />
					<label class="custom-control-label" for="minore-servizi-no">No</label>
				</div>
				<span class="invalid-feedback" v-show="errors.has('minore-servizi')">{{ errors.first('minore-servizi') }}</span>
			</div>
			<template v-if="domanda.minore.serviziSociali.stato === true" v-cloak>
				<div class="card hight col-md-10 mb-4 ml-2">
					<div class="card-body">
						<div class="alert alert-info fade show" role="alert">
							<p>Il punteggio viene assegnato se, in seguito a richiesta dei Servizi Educativi, il Servizio Sociale segnala la necessit&agrave; di inserimento prioritario</p>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-12 col-md-6">
								<label for="minore-assistente">Nominativo assistente sociale<sub class="required">*</sub></label>
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('minore-assistente')}" id="minore-assistente" name="minore-assistente" placeholder="Inserisci il nominativo" v-model="domanda.minore.serviziSociali.dati.assistente" v-validate.disable="'required'" />
								<span class="invalid-feedback" v-show="errors.has('minore-assistente')">{{ errors.first('minore-assistente') }}</span>
							</div>
							<div class="form-group col-sm-12 col-md-6">
								<label for="minore-servizio">Servizio in cui opera<sub class="required">*</sub></label>
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('minore-servizio')}" id="minore-servizio" name="minore-servizio" placeholder="Inserisci il servizio" v-model="domanda.minore.serviziSociali.dati.nome" v-validate.disable="'required'" />
								<span class="invalid-feedback" v-show="errors.has('minore-servizio')">{{ errors.first('minore-servizio') }}</span>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-12 col-md-6">
								<label for="minore-indirizzo-servizio">Indirizzo<sub class="required">*</sub></label>
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('minore-indirizzo-servizio')}" id="minore-indirizzo-servizio" name="minore-indirizzo-servizio" placeholder="Inserisci l'indirizzo" v-model="domanda.minore.serviziSociali.dati.indirizzo" v-validate.disable="'required'" />
								<span class="invalid-feedback" v-show="errors.has('minore-indirizzo-servizio')">{{ errors.first('minore-indirizzo-servizio') }}</span>
							</div>
							<div class="form-group col-sm-12 col-md-6">
								<label for="minore-telefono-servizio">Recapito telefonico<sub class="required">*</sub></label>
								<input type="text" :class="{'form-control':true, 'is-invalid': errors.has('minore-telefono-servizio')}" id="minore-telefono-servizio" name="minore-telefono-servizio" placeholder="Inserisci il recapito" v-model="domanda.minore.serviziSociali.dati.telefono" v-validate.disable="'required'" />
								<span class="invalid-feedback" v-show="errors.has('minore-telefono-servizio')">{{ errors.first('minore-telefono-servizio') }}</span>
							</div>
						</div>
						<div class="mt-6 alert alert-info fade show" role="alert">
							<p>Se in possesso di certificazione rilasciata da Servizio Sociale del Comune di Torino o del Ministero di Giustizia allegare il documento/i.</p>
						</div>
						<documenti v-model="domanda.minore.serviziSociali.documenti" target="minoreServizi" key="minoreDocumentiServizi"></documenti>
					</div>
				</div>
			</template>
		</div>
	</template>
	<div class="btn-group row">
		<div class="col-sm-12 col-md-12 col-lg-4">
			<a class="btn btn-secondary" href="#" role="button" @click="prevSubStep">Indietro</a>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-4"><!--space--></div>
		<div class="col-sm-12 col-md-12 col-lg-4 btn-order-primary">
			<a class="btn btn-primary" href="#" role="button" @click="nextSubStep">Prosegui</a>
		</div>
	</div>
</div>
