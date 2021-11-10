<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="IKM - BKPPD BALANGAN">
		<meta name="description" content="Indeks Kepuasan Masyarakat (IKM) BKPPD Balangan">
		<meta name="robots" content="index,follow"/>
		<!-- Meta Properti GOOGLE -->
		<meta property="og:title" content="IKM - BKPPD BALANGAN">
		<meta property="og:description" content="Indeks Kepuasan Masyarakat (IKM) BKPPD Balangan">
		<meta property="og:type" content="web">
		<meta property="og:image" content="<?= base_url('assets/images/ikm-bkppd-balangan.png') ?>">
		<meta property="og:url" content="<?= base_url('ikm') ?>">
		<!-- Meta Properti Twitter -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:description" content="Indeks Kepuasan Masyarakat (IKM) BKPPD Balangan">
		<meta name="twitter:type" content="web">
		<meta name="twitter:image" content="<?= base_url('assets/images/ikm-bkppd-balangan.png') ?>">
		<meta name="twitter:url" content="<?= base_url('ikm') ?>">

		<title><?= $title ?></title>
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<link rel="apple-touch-icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<?php if($this->uri->segment(1) === 'survei'): ?>
			<link rel="stylesheet" href="<?= base_url('template/v1/plugin/jquery-form-validator/form-validator/theme-default.min.css') ?>">
		<?php endif; ?>
		<?php if($this->uri->segment(1) === 'skm'): ?>
			<link rel="stylesheet" href="<?= base_url('template/v1/plugin/slick/slick/slick-theme.css') ?>">
		<?php endif; ?>
		<link rel="stylesheet" href="<?= base_url('assets/css/skm.css') ?>">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
	    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-199508931-1"></script>
	    <script>
	      window.dataLayer = window.dataLayer || [];
	      function gtag(){dataLayer.push(arguments);}
	      gtag('js', new Date());

	      gtag('config', 'UA-199508931-1');
	    </script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body id="top" class="position-relative" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="50">
	<div class="main">