										<h2 class="no-bottom">
											<template v-if="(domanda.richiedente.condizioneCoabitazione == 'E' || domanda.richiedente.condizioneCoabitazione == 'F')">
												Genitore che coabita con il bambino o la bambina
											</template>
											<template v-else>
												Richiedente
											</template>
										</h2>
										<div class="form-step">
											<template v-if="(domanda.richiedente.condizioneCoabitazione == 'E' || domanda.richiedente.condizioneCoabitazione == 'F')">
												<anagrafica v-model="domanda.soggetto1.anagrafica" :cittadinanza="cittadinanza" target="soggetto1" key="soggetto1Anagrafica"></anagrafica>
												<luoghi v-model="domanda.soggetto1.luogoNascita" :stati="stati" :regioni="regioni" casistica="nascita" target="soggetto1" key="soggetto1Nascita"></luoghi>
											</template>
											<template v-if="gravidanzaSoggetto1" v-cloak>
												<stato-gravidanza v-model="domanda.soggetto1.gravidanza" target="soggetto1" key="soggetto1Gravidanza">
													<label class="col-form-label col-md-12">Stato di gravidanza?<sub class="required">*</sub></label>
												</stato-gravidanza>
											</template>
											<problemi-salute v-model="domanda.soggetto1.problemiSalute" target="soggetto1" key="soggetto1Salute">
												<label class="col-form-label col-md-12">Gravi problemi di salute?<sub class="required">*</sub></label>
											</problemi-salute>
											<condizione-occupazionale v-model="domanda.soggetto1.condizioneOccupazionale" target="soggetto1" key="soggetto1Occupazione" :data-nascita="(domanda.richiedente.condizioneCoabitazione == 'E' || domanda.richiedente.condizioneCoabitazione == 'F') ? domanda.soggetto1.anagrafica.dataNascita : domanda.richiedente.anagrafica.dataNascita">
												<label class="col-form-label col-md-12">Condizione occupazionale<sub class="required">*</sub></label>
												<sup>Per il punteggio verr&agrave; presa in considerazione una sola condizione.</sup>
											</condizione-occupazionale>
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
