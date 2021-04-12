<h2 class="no-bottom">Scelta scuole d'infanzia</h2>
<div class="form-step">
	<div class="alert alert-info fade show" role="alert">
		<p>Vengono proposte le scuole d'infanzia che hanno la sezione corrispondente all'et&agrave; del bambino o della bambina.</p>
		<p>&Egrave; possibile ricercare le singole scuole d'infanzia per <strong>nome</strong> o per <strong>indirizzo</strong> e selezionarle dalla colonna <strong>Scuole d'infanzia disponibili</strong>.</p>
		<p>Per selezionare la scuola d'infanzia desiderata clicca sul pulsante <strong>Seleziona</strong><br />
		La selezione sar&agrave; aggiunta nella colonna <strong>Scuole d'infanzia selezionate</strong> e potrai poi ordinare le scelte trascinando gli elementi nella lista.</p>
	</div>
	<div class="form-row justify-content-sm-center">
		<div class="form-group col-sm-8">
			<h3>Cerca una scuola d'infanzia per nome o indirizzo</h3>
			<input class="form-control" type="text" id="testo-ricerca" name="testo-ricerca" placeholder="Inserisci nome o indirizzo" v-model="testoRicerca" />
		</div>
		<div class="form-group col-sm-6">
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" id="scuola-convenzionata" name="scuola-convenzionata" class="custom-control-input" value="true" v-model="convenzionata"  />
				<label class="custom-control-label" for="scuola-convenzionata">Scuola convenzionata</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline" >
				<input type="checkbox" id="scuola-comunale" name="scuola-comunale" class="custom-control-input" value="true" v-model="comunale" :disabled="isDisabled" />
				<label class="custom-control-label" for="scuola-comunale">Scuola comunale</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline" >
				<input type="checkbox" id="scuola-statale" name="scuola-statale" class="custom-control-input" value="true" v-model="statale" :disabled="isDisabled" />
				<label class="custom-control-label" for="scuola-statale">Scuola statale</label>
			</div>
		</div>
	</div>
	<hr />
	<div class="form-row mt-4">
		<div class="form-group col-sm-12 col-md-6 pr-3">
			<div id="elencoMaterne">
				<h4 class="ml-2">Scuole d'infanzia disponibili<br /><small>suddivise per circoscrizione</small></h4>
				<template v-if="Object.keys(risultatoRicerca).length">
					<div v-for="(materne, circoscrizione) in risultatoRicerca" :key="circoscrizione" class="card mb-2">
						<div class="card-header" :id="'circoscrizione'+circoscrizione">
							<div data-toggle="collapse" :data-target="'#materne-'+circoscrizione" :aria-expanded="testoRicerca.length > 2 ? 'true' : 'false'" :aria-controls="'materne-'+circoscrizione" role="button" :class="{'accordion-action':true,'mb-0':true,'collapsed':testoRicerca.length < 3}"><strong>Circoscrizione {{ circoscrizione }}</strong></div>
						</div>
						<div :id="'materne-'+circoscrizione" :class="{collapse:true,show:testoRicerca.length > 2}" :aria-labelledby="'circoscrizione'+circoscrizione" data-parent="#elencoMaterne">
							<div class="card-body p-0">
								<ul class="list-group list-group-flush m-0">
									<li v-for="(materna, index) in materne" :key="'materna-'+index" class="list-group-item">
										<big><strong>{{ materna.descrizione }}</strong></big> <span class="badge badge-scuola">{{ materna.codCategoriaScuola | categoriaScuola('MAT') }}</span><br />
										<small>{{ materna.indirizzo }}</small><br />
										<div class="form-row mt-3">
											<div class="btn-group-card col-sm-12 text-right">
												<button :key="'addMaterna'+index" class="btn btn-secondary" v-show="materna" @click="addMaterna(materna)" :disabled="materna.selScuola"><i class="fa fa-plus-circle" aria-hidden="true"></i> Seleziona</button>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</template>
				<template v-else>
					<div class="card" style="min-height:1rem;">
						<div class="card-body">
							Nessun risultato
						</div>
					</div>
				</template>
			</div>
		</div>
		<div id="checkMaterne" class="form-group col-sm-12 col-md-6 pr-3">
			<h4 class="ml-2">Scuole d'infanzia selezionate<br /><small>trascinare gli elementi per ordinare</small></h4>
			<template v-if="domanda.elencoMaterne.length">
				<span class="mb-3 ml-2 invalid-feedback" v-show="errors.firstByRule('checkMaterne', 'min_3')" v-html="errors.firstByRule('checkMaterne', 'min_3')"></span>
				<draggable v-model="domanda.elencoMaterne" group="materne">
					<div v-for="(materna, index) in domanda.elencoMaterne" :key="'selMaterna-'+index" :class="{'card':true, 'mb-2':true, 'border-danger':errors.firstByRule('checkMaterne', 'min_3')}">
						<div class="card-body p-3" style="cursor:move">
							<i class="fa fa-arrows-alt mr-1" aria-hidden="true"></i> <strong>{{ index+1 }}&deg; scelta</strong>
							<div class="ml-4">
								<big><strong>{{ materna.descrizione }}</strong></big> <span class="badge badge-scuola">{{ materna.codCategoriaScuola | categoriaScuola('MAT') }}</span><br />
								{{ materna.indirizzo }}
								<div class="form-row mt-3">
									<div class="form-group col-sm-12 text-right">
										<button :key="'remove'+index" class="btn btn-secondary" @click="removeMaterna(index)"><i class="fa fa-times-circle" aria-hidden="true"></i> Elimina selezione</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</draggable>
			</template>
			<template v-else>
				<div :class="{'card':true, 'mb-2':true, 'border-danger':errors.firstByRule('checkMaterne', 'required')}">
					<div class="card-body">
						Nessun scuola d'infanzia selezionata
					</div>
				</div>
				<span class="invalid-feedback" v-show="errors.firstByRule('checkMaterne', 'required')">{{ errors.firstByRule('checkMaterne', 'required') }}</span>
			</template>
			<input type="hidden" id="hiddenCheck" key="hiddenCheck" name="checkMaterne" v-validate.disable="{required:true,min_3:disabilitaMinore}" v-model="domanda.elencoMaterne" />
		</div>
	</div>
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
