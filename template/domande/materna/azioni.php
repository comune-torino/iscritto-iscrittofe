												<div>
													<template v-if="preferenza.azione == 'accetta'" v-cloak>
														<?php require_once('template/domande/materna/accetta.php'); ?>
													</template>
													<template v-else-if="preferenza.azione == 'rinuncia'" v-cloak>
														<?php require_once('template/domande/materna/rinuncia.php'); ?>
													</template>
												</div>