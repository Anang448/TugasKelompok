<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WEB SEMANTIK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php
    require_once("sparqllib.php");
    $id = $_GET['id'];
        $data = sparql_get(
            "http://localhost:3030/universitas",
            "
            PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
            PREFIX owl: <http://www.w3.org/2002/07/owl#>
            PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
            PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
            PREFIX data: <http://www.semanticweb.org/asus/ontologies/2022/11/universitas#>
            SELECT  ?Universitas ?Alamat ?Fakultas ?ProgramStudi ?Jenis ?Logo ?ID
                WHERE { 
                    ?attribut data:mempunyai ?logo .
                    ?logo data:Logo ?Logo .
                    ?logo data:dipunyai ?universitas.
                    ?universitas data:NamaUniversitas ?Universitas.
                    ?universitas data:jenis ?jenis .
                    ?jenis data:Jenis ?Jenis .
                    ?universitas data:memiliki ?alamat .
                    ?alamat data:Alamat ?Alamat .
                    ?universitas data:terdapat ?fakultas.
                    ?fakultas data:Fakultas ?Fakultas.
                    OPTIONAL{?fakultas data:ada ?progdi.
                        ?progdi data:ProgramStudi ?ProgramStudi.}
                    OPTIONAL{?progdi data:dapat ?id.
                    ?id data:Id ?ID.}
                 FILTER 
                 (regex (?ID, '$id', 'i'))
            }
            "
        );

    if (!isset($data)) {
        print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
    }
    ?>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="m-0">Daftar PTN/PTS</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="search.php" class="nav-item nav-link active">Search</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                    </div>
                </div>
            </nav>

            <div class="container-xxl bg-primary page-header">
                <div class="container text-center">
                    <h1 class="text-white animated zoomIn mb-3">Detail Informasi Yang Anda Inginkan</h1>
                    <p class="text-white animated zoomIn mb-3">Berikut adalah detail informasi yang kalian butuhkan</p>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-xxl py-6">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <?php foreach ($data as $data) :?>
                    <div class="col-lg-6 wow zoomIn" data-wow-delay="0.1s">
                        <center><img class="img-fluid"   width="300" height="250" alt="" src="<?= $data['Logo'] ?>"></center>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-inline-block border rounded-pill text-primary px-4 mb-3"><?= $data['Fakultas'] ?></div>
                        <table class="table" width="100%">
                                    <tr>
                                        <td>Progdi</td>
                                        <td><?= $data['ProgramStudi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?= $data['Alamat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kampus</td>
                                        <td><?= $data['Jenis'] ?></td>
                                    </tr>
                                </table>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- About End -->
        <!-- Footer Start -->
        </div>
        <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 6rem;">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; Designed By <a class="border-bottom">Kelompok dengan NIM 201951242, 201951243, 201951251, 201951259</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>