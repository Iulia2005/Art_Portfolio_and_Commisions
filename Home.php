<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alte Produse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="Home.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                ALTE PRODUSE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php"><i class="fas fa-home"></i> ACASĂ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categorii.php"><i class="fas fa-th-list"></i> CATEGORII</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="categorii.php"><i class="fas fa-box-open"></i> PRODUSE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="promotii.php"><i class="fas fa-tags"></i> PROMOȚII</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorite.php"><i class="fas fa-heart"></i> FAVORITE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cos.php"><i class="fas fa-shopping-cart"></i> COȘ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="main-content container"> 
        <h1 class="section-title text-center">Alte produse</h1>
        <div class="row g-4 justify-content-center">

        <?php
        include('db.php');

        $cod_categorie = isset($_GET['cod_categorie']) ? $_GET['cod_categorie'] : null;

        if ($cod_categorie) {
            $sql_list_prod = "SELECT * from products where category_id = ?";
            $stmt_list_prod = $conn->prepare($sql_list_prod);  
            $stmt_list_prod->execute([$cod_categorie]); 

            while ($row_list_prod = $stmt_list_prod->fetch(PDO::FETCH_ASSOC)){  
                $cod_produs_list_prod = $row_list_prod['product_code'];
                $nume_produs_list_prod = $row_list_prod['product_name'];
                $pret_vanzare_list_prod = number_format($row_list_prod['sale_price'], 2); 
                $descriere_scurta_list_prod = $row_list_prod['short_description'];
                $imagine = $row_list_prod['main_image'];

                echo "
                  <div class='col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch'>
                      <div class='card product-card h-100'>
                          <img src='$imagine' class='card-img-top product-card-img-top' alt='$nume_produs_list_prod' />
                          <div class='card-body product-card-body d-flex flex-column'>
                              <h5 class='card-title product-card-title'>$nume_produs_list_prod</h5>
                              <span class='product-card-price'>$pret_vanzare_list_prod RON</span>
                              <p class='card-text product-card-text flex-grow-1'>
                                  $descriere_scurta_list_prod
                              </p>
                              <a href='product.php?product_code=$cod_produs_list_prod'
                                 class='btn btn-primary btn-product-details mt-auto'
                                
                                 <i class='fas fa-info-circle me-2'></i> Detalii
                              </a>
                          </div>
                      </div>
                  </div>
                ";
            }
        } else {
            echo "<div class='col-12 text-center'><p class='alert alert-warning'>Nicio categorie selectată.</p></div>";
        }
        ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>