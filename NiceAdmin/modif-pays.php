<?php

use App\Pays;
use App\Zone;

require_once '../bootstrap.php';

$paysId = $_GET['id'] ?? null;
/* if (!$paysId) {
    header("Location: gestion_pays.php?error=Aucun pays sélectionné");
    exit;
} */

$pays = $entityManager->find(Pays::class, $paysId);
/* if (!$pays) {
    header("Location: gestion_pays.php?error=Pays introuvable");
    exit;
} */

// Récupérer toutes les zones
$zonesList = $entityManager->getRepository(Zone::class)->findAll();

// Récupérer les IDs des zones déjà associées au pays
$paysZones = $pays->getZones();
//$paysZoneIds = array_map(fn($z) => $z->getId(), $paysZones);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pays / Modifier </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/ISI.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    @keyframes moveText {
      0% {
        transform: translateX(-100%);
        color: red;
        /* Change color to check */
      }

      50% {
        transform: translateX(0);
        color: blue;
        /* Midway color change */
      }

      100% {
        transform: translateX(100%);
        color: green;
        /* Final color change */
      }
    }

    #name {
      font-size: 1rem;
      font-weight: bold;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      animation: moveText 4s infinite alternate;
    }
  </style>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/Hsante.jpg" alt=""> &nbsp;
        <span class="d-none d-lg-block">Epidemia &nbsp; <img src="assets/img/sante.jpg" alt=""> </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="position-absolute start-50 translate-middle text-center">
      <span id="name">Gilles Junior Koanga - DITI4</span>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="d-flex align-items-center">
          <!-- Ajout de l'image ici -->
          <img src="assets/img/ISI.jpg" alt="Description de l'image" class="img-fluid me-2" style="max-width: 50px; height: auto;">
        </li>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/Gisi.jfif" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Gilles Jr K.</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Gilles Jr Koanga</h6>
              <span>Ingénieur Informatique</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Présentation</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-pays" data-bs-toggle="collapse" href="#">
          <i class="bi bi-globe"></i><span>Pays Surveillés</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-pays" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="elements-pays.php">
              <i class="bi bi-circle"></i><span>Liste des Pays surveillés</span>
            </a>
          </li>
          <li>
            <a href="forms-pays.php">
              <i class="bi bi-circle"></i><span>Ajouter des Pays</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-zones" data-bs-toggle="collapse" href="#">
          <i class="bi bi-map"></i><span>Zones Surveillées</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-zones" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="elements-zones.php">
              <i class="bi bi-circle"></i><span>Liste des Zones</span>
            </a>
          </li>
          <li>
            <a href="forms-zones.php">
              <i class="bi bi-circle"></i><span>Ajouter des Zones</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-stats" data-bs-toggle="collapse" href="#">
          <i class="bi bi-buildings"></i><span>Points Surveillance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-stats" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="elements-points.php">
              <i class="bi bi-circle"></i><span>Liste Points
                surveillance</span>
            </a>
          </li>
          <li>
            <a href="forms-points.php">
              <i class="bi bi-circle"></i><span>Gestion des
                Points de Surveillance
              </span>
            </a>
          </li>
        </ul>
      </li>
  </aside><!-- End Sidebar-->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pays Surveillés</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
          <li class="breadcrumb-item">Modifier - Pays</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php
    // Vérifier si le 'message' est bien pris dans l'URL
    if (isset($_GET['message'])) {
      // Récupérer et afficher le message
      $message = htmlspecialchars($_GET['message']);
      echo "<div class='alert alert-success' role='alert'>$message</div>";
    }
    ?>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          <div class="container mt-5">
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Modification d'un pays</h5>

                <form action="../test/modification_pays.php" method="POST">
                  <input type="hidden" name="id" value="<?= $pays ? htmlspecialchars($pays->getId()) : '' ?>">

                  <!-- Sélection du pays -->
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom du pays</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="<?= $pays ? htmlspecialchars($pays->getNom()) : '' ?>" required>
                  </div>

                  <!-- Sélection des zones -->
                  <div class="mb-3">
                    <label for="zones" class="form-label">Zones associées</label>
                    <select name="zones[]" id="zones" class="form-select" multiple>
                      <?php foreach ($zonesList as $zone) : ?>
                        <option value="<?= htmlspecialchars($zone->getId()) ?>" <?= ($pays && $pays->getZones()->contains($zone)) ? 'selected' : '' ?>>
                          <?= htmlspecialchars($zone->getNom()) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="text-end">
                    <button type="submit" class="btn btn-success fw-bold">Modifier</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Groupe ISI</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">DITI4-Gilles_jr</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>