<?php

defined('ABSPATH') or die("Por aquí no vamos a ninguna parte");

if (!current_user_can ('administrator')) {
	wp_die (__('No tienes suficientes permisos para acceder a esta página.', 'arcadreams-better-posts'));
}

