<h2 class="no-bottom">
	<template v-if="domanda.richiedente.condizioneCoabitazione == 'A'">
		Altro genitore coabitante
	</template>
	<template v-else-if="domanda.richiedente.condizioneCoabitazione == 'B'">
		Altro genitore (non coabitante)
	</template>
	<template v-else-if="domanda.richiedente.condizioneCoabitazione == 'G'">
		Genitore che coabita con il bambino o la bambina
	</template>
	<template v-else-if="domanda.richiedente.condizioneCoabitazione == 'C'">
		Persona coniugata o unita civilmente o convivente di fatto con richiedente
	</template>
	<template v-else-if="domanda.richiedente.condizioneCoabitazione == 'E'">
		Persona coniugata o unita civilmente o convivente di fatto con il genitore che coabita con il bambino o la bambina
	</template>
	<template v-else-if="(domanda.richiedente.condizioneCoabitazione == 'D' || domanda.richiedente.condizioneCoabitazione == 'F')">
		Dichiarazione relativa all'unico genitore coabitante con il bambino o la bambina
	</template>
</h2>
<div class="form-step">
	<template v-if="(domanda.richiedente.condizioneCoabitazione == 'D' || domanda.richiedente.condizioneCoabitazione == 'F')">
		<div id="soggetto1-genitore-solo" class="form-row">
			<template v-if="domanda.richiedente.condizioneCoabitazione == 'D'" v-cloak>
				<div class="form-group col-md-12">
					<div class="custom-control custom-radio">
						<input type="radio" id="soggetto1-genitore-solo-a" key="genitore-solo-a" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="GEN_DEC" v-model="domanda.soggetto1.genitoreSolo.stato" v-validate.disable="'required'" @change="resetSentenzaSoggetto3" />
						<label class="custom-control-label" for="soggetto1-genitore-solo-a">L'altro genitore &egrave; deceduto</label>
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class="custom-control custom-radio">
						<input type="radio" id="soggetto1-genitore-solo-b" key="genitore-solo-b" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="NUB_CEL_NO_RIC" v-model="domanda.soggetto1.genitoreSolo.stato" @change="resetSentenzaSoggetto3" />
						<label class="custom-control-label" for="soggetto1-genitore-solo-b">Celibe/nubile con figlio/a non riconosciuto/a dall'altro genitore</label>
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class="custom-control custom-radio">
						<input type="radio" id="soggetto1-genitore-solo-c" key="genitore-solo-c" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="NO_RES_GEN" v-model="domanda.soggetto1.genitoreSolo.stato" @change="resetSentenzaSoggetto3" />
						<label class="custom-control-label" for="soggetto1-genitore-solo-c">All'altro genitore &egrave; stata tolta la responsabilit&agrave; genitoriale</label>
					</div>
				</div>
				<template v-if="domanda.soggetto1.genitoreSolo.stato == 'NO_RES_GEN'">
					<div class="card hight col-md-10 mb-4 ml-5">
						<div class="card-body">
							<dati-sentenza v-model="domanda.soggetto1.genitoreSolo.sentenza" id="C" key="genitoreSoloSentenza-C"></dati-sentenza>
						</div>
					</div>
				</template>
			</template>
			<div class="form-group col-md-12">
				<div class="custom-control custom-radio">
					<input type="radio" id="soggetto1-genitore-solo-d" key="genitore-solo-d" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="NUB_CEL_RIC" v-model="domanda.soggetto1.genitoreSolo.stato" @change="resetSentenzaSoggetto3" />
					<label class="custom-control-label" for="soggetto1-genitore-solo-d">Celibe/nubile con figlio/a riconosciuto/a dall'altro genitore e non coabitante con lui/lei</label>
				</div>
			</div>
			<div class="form-group col-md-12">
				<div class="custom-control custom-radio">
					<input type="radio" id="soggetto1-genitore-solo-e" key="genitore-solo-e" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="DIV" v-model="domanda.soggetto1.genitoreSolo.stato" @change="resetSentenzaSoggetto3" />
					<label class="custom-control-label" for="soggetto1-genitore-solo-e">Divorziato/a</label>
				</div>
			</div>
			<template v-if="domanda.soggetto1.genitoreSolo.stato == 'DIV'">
				<div class="card hight col-md-10 mb-4 ml-5">
					<div class="card-body">
						<dati-sentenza v-model="domanda.soggetto1.genitoreSolo.sentenza" id="E" key="genitoreSoloSentenza-E"></dati-sentenza>
					</div>
				</div>
			</template>
			<div class="form-group col-md-12">
				<div class="custom-control custom-radio">
					<input type="radio" id="soggetto1-genitore-solo-f" key="genitore-solo-f" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="IST_SEP" v-model="domanda.soggetto1.genitoreSolo.stato" @change="resetSentenzaSoggetto3" />
					<label class="custom-control-label" for="soggetto1-genitore-solo-f">Presentata istanza di separazione</label>
				</div>
			</div>
			<template v-if="domanda.soggetto1.genitoreSolo.stato == 'IST_SEP'">
				<div class="card hight col-md-10 mb-4 ml-5">
					<div class="card-body">
						<dati-sentenza v-model="domanda.soggetto1.genitoreSolo.sentenza" id="F" key="genitoreSoloSentenza-F"></dati-sentenza>
					</div>
				</div>
			</template>
			<div class="form-group col-md-12">
				<div class="custom-control custom-radio">
					<input type="radio" id="soggetto1-genitore-solo-g" key="genitore-solo-g" name="soggetto1-genitore-solo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto1-genitore-solo')}" value="SEP" v-model="domanda.soggetto1.genitoreSolo.stato" @change="resetSentenzaSoggetto3" />
					<label class="custom-control-label" for="soggetto1-genitore-solo-g">Persona legalmente separata</label>
				</div>
			</div>
			<template v-if="domanda.soggetto1.genitoreSolo.stato == 'SEP'">
				<div class="card hight col-md-10 mb-4 ml-5">
					<div class="card-body">
						<dati-sentenza v-model="domanda.soggetto1.genitoreSolo.sentenza" id="G" key="genitoreSoloSentenza-G"></dati-sentenza>
					</div>
				</div>
			</template>
			<span class="invalid-feedback" v-show="errors.has('soggetto1-genitore-solo')">{{ errors.first('soggetto1-genitore-solo') }}</span>
		</div>
	</template>
	<template v-else>
		<template v-if="(domanda.richiedente.condizioneCoabitazione == 'A' && famiglia.maggiorenni.length > 0)">
			<div class="form-row">
				<div id="soggetto2-presenza-nucleo" class="form-group col-md-12">
					<label class="col-form-label label-light col-md-12">L'altro genitore &egrave; presente nel nucleo anagrafico del bambino o bambina da iscrivere?<sub class="required">*</sub></label>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="soggetto2-presenza-nucleo-si" name="soggetto2-presenza-nucleo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto2-presenza-nucleo')}" :value="true" v-model="domanda.soggetto2.presenzaNucleo" @change="coabitazioneSoggetto2" v-validate.disable="'required'" />
						<label class="custom-control-label" for="soggetto2-presenza-nucleo-si">Si</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="soggetto2-presenza-nucleo-no" name="soggetto2-presenza-nucleo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto2-presenza-nucleo')}" :value="false" v-model="domanda.soggetto2.presenzaNucleo" @change="coabitazioneSoggetto2" />
						<label class="custom-control-label" for="soggetto2-presenza-nucleo-no">No</label>
					</div>
					<span class="invalid-feedback" v-show="errors.has('soggetto2-presenza-nucleo')">{{ errors.first('soggetto2-presenza-nucleo') }}</span>
				</div>
				<template v-if="domanda.soggetto2.presenzaNucleo === true">
					<div id="soggetto2-nucleo" class="form-group col-md-12" v-cloak>
						<label class="col-form-label label-light col-md-12">Scegli dal nucleo familiare l'altro genitore<sub class="required">*</sub></label>
						<hr />
						<div v-for="(soggetto2, index) in famiglia.maggiorenni" :key="index" class="custom-control custom-radio">
							<input type="radio" :id="'soggetto2'+index" name="soggetto2-nucleo" :class="{'custom-control-input':true, 'is-invalid': errors.has('soggetto2-nucleo')}" :value="soggetto2.anagrafica.codiceFiscale" v-model="domanda.soggetto2.anagrafica.codiceFiscale" v-validate.disable="'required'" @change="setSoggetto2" />
							<label class="custom-control-label" :for="'soggetto2'+index">
								<big><strong>{{ soggetto2.anagrafica.cognome }} {{ soggetto2.anagrafica.nome }}</strong></big><br />
								{{ soggetto2.anagrafica.codiceFiscale }}<br />
								<template v-if="soggetto2.anagrafica.sesso == 'M'">
									nato a
								</template>
								<template v-else>
									nata a
								</template>
								<template v-if="(soggetto2.luogoNascita.codNazione == '000' && soggetto2.luogoNascita.descComune == soggetto2.luogoNascita.descProvincia)">
									{{ soggetto2.luogoNascita.descComune }}
								</template>
								<template v-else-if="(soggetto2.luogoNascita.codNazione == '000' && soggetto2.luogoNascita.descComune != soggetto2.luogoNascita.descProvincia)">
									{{ soggetto2.luogoNascita.descComune }}, provincia di {{ soggetto2.luogoNascita.descProvincia }},
								</template>
								<template v-else-if="soggetto2.luogoNascita.codNazione != '000'">
									{{ soggetto2.luogoNascita.descComune }} ({{ soggetto2.luogoNascita.descNazione }})
								</template>
								il {{ soggetto2.anagrafica.dataNascita }}<br />
								cittadinanza: {{ soggetto2.anagrafica.descrizioneCittadinanza }}
							</label>
							<span v-show="errors.has('soggetto2-nucleo')" class="invalid-feedback ml-4">{{ errors.first('soggetto2-nucleo') }}</span>
							<hr />
						</div>
					</div>
				</template>
			</div>
		</template>
		<template v-if="showFormSoggetto2" v-cloak>
			<template v-if="showFormAnagraficaSoggetto2" v-cloak>
				<anagrafica v-model="domanda.soggetto2.anagrafica" :cittadinanza="cittadinanza" target="soggetto2" key="soggetto2Anagrafica"></anagrafica>
				<luoghi v-model="domanda.soggetto2.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="soggetto2" key="soggetto2Nascita"></luoghi>
				<luoghi v-model="domanda.soggetto2.residenza" :stati="stati" :regioni="regioni" casistica="residenza" target="soggetto2" key="soggetto2Residenza"></luoghi>
			</template>
			<template v-if="domanda.soggetto2.anagrafica.sesso == 'F'" v-cloak>
				<stato-gravidanza v-model="domanda.soggetto2.gravidanza" target="soggetto2" key="soggetto2Gravidanza">
					<label class="col-form-label col-md-12">Stato di gravidanza?<sub class="required">*</sub></label>
				</stato-gravidanza>
			</template>
			<problemi-salute v-model="domanda.soggetto2.problemiSalute" target="soggetto2" key="soggetto2Salute">
				<label class="col-form-label col-md-12">Gravi problemi di salute?<sub class="required">*</sub></label>
			</problemi-salute>
			<condizione-occupazionale v-model="domanda.soggetto2.condizioneOccupazionale" target="soggetto2" key="soggetto2Occupazione" :data-nascita="domanda.soggetto2.anagrafica.dataNascita">
				<label class="col-form-label col-md-12">Condizione occupazionale<sub class="required">*</sub></label>
				<sup>Per il punteggio verr&agrave; presa in considerazione una sola condizione.</sup>
			</condizione-occupazionale>
		</template>
	</template>
	<template v-if="(domanda.richiedente.condizioneCoabitazione == 'C' || (domanda.richiedente.condizioneCoabitazione == 'D' && ['NUB_CEL_RIC','DIV','IST_SEP','SEP'].indexOf(domanda.soggetto1.genitoreSolo.stato) !== -1))">
		<h2 class="section-space mt-7">Altro genitore del bambino o bambina</h2>
		<anagrafica v-model="domanda.soggetto3.anagrafica" :cittadinanza="cittadinanza" target="soggetto3" key="soggetto3Anagrafica" :required="false"></anagrafica>
		<luoghi v-model="domanda.soggetto3.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="soggetto3" key="soggetto3Nascita"></luoghi>
		<luoghi v-model="domanda.soggetto3.residenza" :stati="stati" :regioni="regioni" casistica="residenza" target="soggetto3" key="soggetto3Residenza" :required="false"></luoghi>
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
