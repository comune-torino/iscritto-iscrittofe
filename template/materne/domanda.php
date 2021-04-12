									<div>
										<template v-if="erroreMaterna.stato" v-cloak>
											<div :class="'alert fade show alert-'+erroreMaterna.tipo" role="alert">
												<p v-html="erroreMaterna.messaggio"></p>
											</div>
										</template>
										<template v-else-if="checkNotificatore === false" v-cloak>
											<template v-if="(!domanda.statoDomanda || domanda.statoDomanda == 'BOZ')" v-cloak>
												<div class="areaAccodion" id="collapseMobile-01">															
													<div class="box-nav">
														<a class="back-home" href="#" @click="indice">
															<span class="sr-only">Ritorna all'homepage </span>
														</a>
														<p class="type-registration scuola-infanzia">Scuole d'infanzia</p>
													</div>
													<div :class="['item-list-tab-step', 'step-'+steps.corrente, {'mb-5':steps.corrente > 2}]">
														<ul>
															<li :class="{ active: steps.corrente == 1, past: steps.corrente > 1, disable: steps.corrente == 4}" @click="setStep(1)">
																<span>Inserimento dati</span>
																<template v-if="steps.corrente == 1">
																	<ul>
																		<li :class="{ active: steps[steps.corrente].corrente == 1, past: steps[steps.corrente].corrente > 1, 'last-step': steps[steps.corrente].corrente == 2}" @click="setSubStep(1)">
																			<span>
																				<span class="sr-only">Sezione 1.1</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 2, past: steps[steps.corrente].corrente > 2, 'last-step': steps[steps.corrente].corrente == 3}" @click="setSubStep(2)">
																			<span>
																				<span class="sr-only">Sezione 1.2</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 3, past: steps[steps.corrente].corrente > 3, 'last-step': steps[steps.corrente].corrente == 4}" @click="setSubStep(3)">
																			<span>
																				<span class="sr-only">Sezione 1.3</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 4, past: steps[steps.corrente].corrente > 4, 'last-step': steps[steps.corrente].corrente == 5}" @click="setSubStep(4)">
																			<span>
																				<span class="sr-only">Sezione 1.4</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 5, past: steps[steps.corrente].corrente > 5, 'last-step': steps[steps.corrente].corrente == 6}" @click="setSubStep(5)">
																			<span>
																				<span class="sr-only">Sezione 1.5</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 6, past: steps[steps.corrente].corrente > 6, 'last-step': steps[steps.corrente].corrente == 7}" @click="setSubStep(6)">
																			<span>
																				<span class="sr-only">Sezione 1.6</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 7, past: steps[steps.corrente].corrente > 7, 'last-step': steps[steps.corrente].corrente == 8}" @click="setSubStep(7)">
																			<span>
																				<span class="sr-only">Sezione 1.7</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 8, past: steps[steps.corrente].corrente > 8, 'last-step': steps[steps.corrente].corrente == 9}" @click="setSubStep(8)">
																			<span>
																				<span class="sr-only">Sezione 1.8</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 9, past: steps[steps.corrente].corrente > 9, 'last-step': steps[steps.corrente].corrente == 10}" @click="setSubStep(9)">
																			<span>
																				<span class="sr-only">Sezione 1.9</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 10, past: steps[steps.corrente].corrente > 10, 'last-step': steps[steps.corrente].corrente == 11}" @click="setSubStep(10)">
																			<span>
																				<span class="sr-only">Sezione 1.10</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 11, past: steps[steps.corrente].corrente > 11}" @click="setSubStep(11)">
																			<span>
																				<span class="sr-only">Sezione 1.11</span>
																			</span>
																		</li>
																	</ul>
																</template>
															</li>
															<li :class="{ active: steps.corrente == 2, past: steps.corrente > 2, disable: steps.corrente == 4}" @click="setStep(2)">
																<span>Scelta scuole</span>
																<template v-if="steps.corrente == 2">
																	<ul>
																		<li :class="{ active: steps[steps.corrente].corrente == 1, past: steps[steps.corrente].corrente > 1, 'last-step': steps[steps.corrente].corrente == 2}" @click="setSubStep(1)">
																			<span>
																				<span class="sr-only">Sezione 2.1</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 2, past: steps[steps.corrente].corrente > 2, 'last-step': steps[steps.corrente].corrente == 3}" @click="setSubStep(2)">
																			<span>
																				<span class="sr-only">Sezione 2.2</span>
																			</span>
																		</li>
																		<li :class="{ active: steps[steps.corrente].corrente == 3, past: steps[steps.corrente].corrente > 3}" @click="setSubStep(3)">
																			<span>
																				<span class="sr-only">Sezione 2.3</span>
																			</span>
																		</li>
																	</ul>
																</template>
															</li>
															<li :class="{ active: steps.corrente == 3, past: steps.corrente > 3, disable: steps.corrente == 4}" @click="setStep(4)">
																<span>Riepilogo conferma</span>
															</li>
															<li :class="{ active: steps.corrente == 4, past: steps.corrente > 4}">
																<span>Ricevuta</span>
															</li>
														</ul>
													</div>
												</div>
											</template>
											<template v-if="steps.corrente == 1">
												<template v-if="steps[steps.corrente].corrente == 1">
													<?php require_once('template/materne/steps/step1/subStep1.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 2">
													<?php require_once('template/materne/steps/step1/subStep2.php'); ?>										
												</template>
												<template v-if="steps[steps.corrente].corrente == 3">
													<?php require_once('template/materne/steps/step1/subStep3.php'); ?>											
												</template>
												<template v-if="steps[steps.corrente].corrente == 4">
													<?php require_once('template/materne/steps/step1/subStep4.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 5">
													<?php require_once('template/materne/steps/step1/subStep5.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 6">
													<?php require_once('template/materne/steps/step1/subStep6.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 7">
													<?php require_once('template/materne/steps/step1/subStep7.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 8">
													<?php require_once('template/materne/steps/step1/subStep8.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 9">
													<?php require_once('template/materne/steps/step1/subStep9.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 10">
													<?php require_once('template/materne/steps/step1/subStep10.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 11">
													<?php require_once('template/materne/steps/step1/subStep11.php'); ?>
												</template>
											</template>
											<template v-if="steps.corrente == 2">
												<template v-if="steps[steps.corrente].corrente == 1">
													<?php require_once('template/materne/steps/step2/subStep1.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 2">
													<?php require_once('template/materne/steps/step2/subStep2.php'); ?>
												</template>
												<template v-if="steps[steps.corrente].corrente == 3">
													<?php require_once('template/materne/steps/step2/subStep3.php'); ?>
												</template>
											</template>
											<template v-if="steps.corrente == 3">
												<template v-if="steps[steps.corrente].corrente == 1">
													<?php require_once('template/materne/steps/step3/subStep1.php'); ?>
												</template>
											</template>
											<template v-if="steps.corrente == 4">
												<template v-if="steps[steps.corrente].corrente == 1">
													<?php require_once('template/materne/steps/step4/subStep1.php'); ?>
												</template>
											</template>
										</template>
									</div>					