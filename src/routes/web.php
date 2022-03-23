<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

Route::get(
	'/',
	function () {
		return Inertia::render(
			'Home',
			[
				'title' => 'Homepage',
			]
		);
	}
)->name( 'homepage' );

Route::get(
	'/jobs',
	function () {
		redirect()->to('/')->send();
	}
)->name( 'jobs' );

Route::get(
	'/jobs/{id}',
	function () {
		return Inertia::render(
			'Jobsdetail',
			[
				'title' => 'Job Detail',
			]
		);
	}
)->name( 'jobs.detail' );
