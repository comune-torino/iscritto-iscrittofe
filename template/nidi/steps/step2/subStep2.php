<h2 class="no-bottom">Scelta nidi</h2>
<div class="form-step">
	<div class="alert alert-info fade show" role="alert">
		<p>Vengono proposte le strutture che hanno la sezione corrispondente all'et&agrave; del bambino o della bambina.</p>
		<p>&Egrave; possibile eseguire la ricerca per <strong>nome</strong>, per <strong>indirizzo</strong> o per <strong>tempo di frequenza</strong> ed effettuare la selezione dalla colonna <strong>Nidi disponibili</strong>.</p>
		<p>Per selezionare la struttura e il tempo di frequenza desiderati clicca sul pulsante <strong>Seleziona tempo breve</strong> o <strong>lungo</strong>.<br />
		La selezione sar&agrave; aggiunta nella colonna <strong>Nidi selezionati</strong> e potrai poi ordinare le scelte trascinando gli elementi nella lista.</p>
	</div>
	<div class="form-row">
		<div class="form-group col-sm-12 col-md-8 offset-md-2">
			<h3>Cerca un nido per nome o indirizzo</h3>
			<input class="form-control" type="text" id="testo-ricerca" name="testo-ricerca" placeholder="Inserisci nome o indirizzo" v-model="testoRicerca" />
		</div>
		<div class="form-group col-sm-12 col-md-5 offset-md-4">
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" id="tempo-breve" name="tempo-breve" class="custom-control-input" value="true" v-model="tempoBreve" />
				<label class="custom-control-label" for="tempo-breve">Tempo breve</label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" id="tempo-lungo" name="tempo-lungo" class="custom-control-input" value="true" v-model="tempoLungo" />
				<label class="custom-control-label" for="tempo-lungo">Tempo lungo</label>
			</div>
		</div>
	</div>
	<hr />
	<div class="form-row mt-4">
		<div class="form-group col-sm-12 col-md-6 pr-3">
			<div id="elencoNidi">
				<h4 class="ml-2">Nidi disponibili<br /><small>suddivisi per circoscrizione</small></h4>
				<template v-if="Object.keys(risultatoRicerca).length">
					<div v-for="(nidi, circoscrizione) in risultatoRicerca" :key="circoscrizione" class="card mb-2">
						<div class="card-header" :id="'circoscrizione'+circoscrizione">
							<div data-toggle="collapse" :data-target="'#nidi-'+circoscrizione" :aria-expanded="testoRicerca.length > 2 ? 'true' : 'false'" :aria-controls="'nidi-'+circoscrizione" role="button" :class="{'accordion-action':true,'mb-0':true,'collapsed':testoRicerca.length < 3}"><strong>Circoscrizione {{ circoscrizione }}</strong></div>
						</div>
						<div :id="'nidi-'+circoscrizione" :class="{collapse:true,show:testoRicerca.length > 2}" :aria-labelledby="'circoscrizione'+circoscrizione" data-parent="#elencoNidi">
							<div class="card-body p-0">
								<ul class="list-group list-group-flush m-0">
									<li v-for="(nido, index) in nidi" :key="'nido-'+index" class="list-group-item">
										<big><strong>{{ nido.descrizione }}</strong></big> <span class="badge badge-scuola" v-if="['C','P'].indexOf(nido.codCategoriaScuola) !== -1">{{ nido.codCategoriaScuola | categoriaScuola }}</span><br />
										<small>{{ nido.indirizzo }}</small><br />
										<div class="form-row mt-3">
											<div class="btn-group-card col-sm-12 text-right">
												<button :key="'breve'+index" class="btn btn-secondary" v-show="nido.tempoBreve" @click="addNido(nido, 'BRV')" :disabled="nido.selTempoBreve"><i class="fa fa-plus-circle" aria-hidden="true"></i> Seleziona tempo breve</button>
												<button :key="'lungo'+index" class="btn btn-secondary" v-show="nido.tempoLungo" @click="addNido(nido, 'LNG')" :disabled="nido.selTempoLungo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Seleziona tempo lungo</button>
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
		<div id="checkNidi" class="form-group col-sm-12 col-md-6 pr-3">
			<h4 class="ml-2">Nidi selezionati<br /><small>trascinare gli elementi per ordinare</small></h4>
			<template v-if="domanda.elencoNidi.length">
				<span class="mb-3 ml-2 invalid-feedback" v-show="errors.firstByRule('checkNidi', 'min_3')" v-html="errors.firstByRule('checkNidi', 'min_3')"></span>
				<draggable v-model="domanda.elencoNidi" group="nidi">
					<div v-for="(nido, index) in domanda.elencoNidi" :key="'selNido-'+index" :class="{'card':true, 'mb-2':true, 'border-danger':errors.firstByRule('checkNidi', 'min_3')}">
						<div class="card-body p-3" style="cursor:move">
							<i class="fa fa-arrows-alt mr-1" aria-hidden="true"></i> <strong>{{ index+1 }}&deg; scelta</strong>
							<div class="ml-4">
								<big><strong>{{ nido.descrizione }}</strong></big> <span class="badge badge-scuola" v-if="['C','P'].indexOf(nido.codCategoriaScuola) !== -1">{{ nido.codCategoriaScuola | categoriaScuola }}</span><br />
								{{ nido.indirizzo }}<br />
								<small><strong>Tempo {{ nido.codTipoFrequenza | tipoFrequenza }}</strong></small>
								<div class="form-row mt-3">
									<div class="form-group col-sm-12 text-right">
										<button :key="'remove'+index" class="btn btn-secondary" @click="removeNido(index)"><i class="fa fa-times-circle" aria-hidden="true"></i> Elimina selezione</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</draggable>
			</template>
			<template v-else>
				<div :class="{'card':true, 'mb-2':true, 'border-danger':errors.firstByRule('checkNidi', 'required')}">
					<div class="card-body">
						Nessun nido selezionato
					</div>
				</div>
				<span class="invalid-feedback" v-show="errors.firstByRule('checkNidi', 'required')">{{ errors.firstByRule('checkNidi', 'required') }}</span>
			</template>
			<input type="hidden" id="hiddenCheck" key="hiddenCheck" name="checkNidi" v-validate.disable="{required:true,min_3:disabilitaMinore}" v-model="domanda.elencoNidi" />
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
