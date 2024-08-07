<div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php">Lab Elements</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a href="http://localhost/labelements.shop/build2v">Home</a></li>
              <li class="dropdown"><a href="http://localhost/labelements.shop/build2v/about_page.php">About</a></li>
              <li class="dropdown"><a href="http://localhost/labelements.shop/build2v/contact_page.php">Contact</a></li>
              <li class="dropdown"><a href="http://localhost/labelements.shop/build2v/rfq_page.php">Request for Quotation</a></li>
              <li><a href="http://localhost/labelements.shop/build2v/products_page.php">Products</a>

              <li class="dropdown"><a class="dropdown-toggle" href="http://localhost/labelements.shop/build2v/products_page.php" data-toggle="dropdown">Products</a>
                <ul class="dropdown-menu" role="menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Laboratory</a>
                    <ul class="dropdown-menu">
                      <?php
                      $servername = "localhost";
                      $username = "root";
                      $password = "leverage.138";
                      $dbname = "lab_elem_v1";

                      try {
                          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                          $stmt = $conn->prepare("SELECT * 
                            FROM product_category_sub
                            WHERE product_category_sub.category_main_id = 2
                            AND product_category_sub.is_active = 1");
                          $stmt->execute();

                          $navigationItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      } catch (PDOException $e) {
                          echo "Connection failed: " . $e->getMessage();
                      }

                      if (!empty($navigationItems)) {
                          // echo '<ul>';
                          foreach ($navigationItems as $item) {
                              echo '<li><a href="http://localhost/labelements.shop/build2v/products_page.php' . $item['id'] . '">' . $item['subcategory_name'] . '</a></li>';
                          }
                          // echo '</ul>';
                      } else {
                          echo 'No navigation items found.';
                      }
                      ?>
                    </ul>
                  </li>
                  <li><a href="#">Medical</a></li>
                  <li><a href="#">PPE</a></li>
                </ul>
              </li>
              
            </ul>
          </div>
        </div>