								<template v-if="tipoDomanda == 'nido'">
									<nido ref="domandaNido" :famiglia="famiglia" :id="idDomanda" :bozza="statoBozza" inline-template v-cloak>
										<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === true)) : ?>
											<?php require_once('template/nidi/domanda.php'); ?>
										<?php else: ?>
											<div class="alert fade show alert-warning" role="alert">
												<p><strong><big>ATTENZIONE</big></strong><br />
												<?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] ?></p>
											</div>
										<?php endif; ?>
									</nido>
								</template>
								<template v-else-if="tipoDomanda == 'materna'">
									<materna ref="domandaMaterna" :famiglia="famiglia" :id="idDomanda" :bozza="statoBozza" inline-template v-cloak>
										<?php if ($_SESSION['ISCRIZIONI']['user']['authprovider'] != 'IPA' || ($_SESSION['ISCRIZIONI']['user']['authprovider'] == 'IPA' && $_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === true)) : ?>
											<?php require_once('template/materne/domanda.php'); ?>
										<?php else: ?>
											<div class="alert fade show alert-warning" role="alert">
												<p><strong><big>ATTENZIONE</big></strong><br />
												<?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] ?></p>
											</div>
										<?php endif; ?>
									</materna>
								</template>
								<template v-else v-cloak>
									<h2 class="titleMobile noDesktop">
										Nuova domanda
									</h2>
									<div class="areaAccodion" id="collapseMobile-01">
										<?php if ($_SESSION['ISCRIZIONI']['user']['profilazione']['nidi'] === true) : ?>
											<div class="list-link-home list-link nido-infanzia">
												<h3>Servizi educativi 0-2: Nidi d'infanzia e sezioni primavera</h3> 
												<p><?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] ?></p>
												<a href="#" @click="showDomandaNido()">
													<span class="sr-only"><?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] ?></span>
												</a>
											</div>
										<?php else: ?>
											<div class="list-link-home list-link list-link-disabled nido-infanzia">
												<h3>Servizi educativi 0-2: Nidi d'infanzia e sezioni primavera</h3>
												<p class="w-75 font-weight-bold"><?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_nidi'] ?></p>
											</div>										
										<?php endif; ?>
										<?php if ($_SESSION['ISCRIZIONI']['user']['profilazione']['materne'] === true) : ?>
											<div class="list-link-home list-link scuola-infanzia">
												<h3>Servizi educativi 3-5: Scuole d'infanzia</h3>
												<p><?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] ?></p>
												<a href="#" @click="showDomandaMaterna()">
													<span class="sr-only"><?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] ?></span>
												</a>
											</div>
										<?php else: ?>
											<div class="list-link-home list-link list-link-disabled scuola-infanzia">
												<h3>Servizi educativi 3-5: Scuola d'infanzia</h3>
												<p class="w-75 font-weight-bold"><?php echo $_SESSION['ISCRIZIONI']['user']['profilazione']['msg_materne'] ?></p>
											</div>
										<?php endif; ?>
									</div>
								</template>
