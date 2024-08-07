<h6 class="font-alt">Business Details</h6>
                 <section class="rfqForm_business">
                 <div class="form-group">
                    <label class="form_label" for="business_name">Business / Company Name *</label>
                    <input class="form-control" type="text" id="business_name" name="business_name" placeholder="" required="required" data-validation-required-message="Please enter your registered business name."/>
                    <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                    <label class="form_label" for="business_address">Shipping Address *</label>
                    <input class="form-control" type="text" id="business_address" name="business_address" placeholder="" required="required" data-validation-required-message="Please enter your business address."/>
                    <p class="help-block text-danger"></p>
                  </div>
                </section>
<h6 class="font-alt">Contact Details</h6>
                <section class="rfqForm_business">
                  <div class="inline-form">
                    <label class="form_label" for="contact_first_name">First Name *</label>
                    <input class="form-input" type="text" id="contact_first_name" name="contact_first_name" placeholder="" required="required" data-validation-required-message="Please enter your contact person first name."/>
                    <p class="help-block text-danger"></p>
                 </div>

                 <div class="inline-form">
                    <label class="form_label" for="contact_last_name">Last Name *</label>
                    <input class="form-input" type="text" id="contact_last_name" name="contact_last_name" placeholder="" required="required" data-validation-required-message="Please enter your contact person first name."/>   
                    <p class="help-block text-danger"></p>
                  </div>

                  <div class="inline-form">
                    <label class="form_label" for="email">Email *</label>
                    <input class="form-input" type="email" id="email" name="email" placeholder="" required="required" data-validation-required-message="Please enter your email address."/>
                    <p class="help-block text-danger"></p>
                  </div>

                  <div class="inline-form">
                    <label class="form_label" for="mobile_no">Mobile No.</label>
                    <input class="form-input" type="mobile_no" id="mobile_no" name="mobile_no" placeholder="" required="required" data-validation-required-message="Please enter your mobile_no address."/>
                    <p class="help-block text-danger"></p>
                  </div>
                </section>

<!-- version List Start -->
<!-- <h6 class="font-alt">Select Product From Our List</h6>
                <section class="rfqForm_business">
                  <div class="product-description">
                    <label class="form_label" for="mobile_no">Product / Description *</label>
                    <select class="form-input" id="product_name" name="product_name">
                    <option value='manually_typed_product'>Type or Select Product</option>
                        <?php
                           // include_once 'controller/rfq/selectProductName.php';
                        ?>      
                    </select>
                    <p class="help-block text-danger"></p>
                  </div>

                 <div class="unit-quantity">         
                    <div class="inline-form">
                        <label class="form_label" for="product_unit">Unit</label>
                        <select class="form-input" id="product_unit" name="unit">
                            <?php
                             // include_once 'controller/rfq/selectProductUnit_PDO.php';
                            ?>      
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="inline-form">
                        <label class="form_label" for="quantity">Quantity</label>
                        <input class="form-input" id="quantity" type="number" id="quantity" name="quantity" placeholder="" data-validation-required-message="Please enter quantity."/>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                </section> -->
<!-- version List end -->


<!-- version dynamic search start -->
<h6 class="font-alt">Enter Product</h6>
                <section class="rfqForm_business">
                  <div class="product-description">
                    <label class="form_label" for="mobile_no">Product / Description *</label>
                    
                        <div class="search-container">
                            <input class="form-input" id="search" type="text" placeholder="Search Product" name="product_search">
                            <button id="clearBtn" class="clear-btn">&times;</button>
                            <div id="search-results"></div>
                        </div>
                        <div id="unit-price"></div>
                        <div><button id="add-quote" class="" hidden>Add to Quote</button></div>
                  </div>
                  <br>
                </section>
<!-- version dynamic search end -->

<!-- SUBMIT RESET START -->
<div class="">
                    <div class="add-button">
                        <button class="btn btn-small btn-round" id="addProduct" type="add">Add Product</button>
                        <span id="message"></span>
                    </div>
                </div>
                </br>
                </br>
                <div class="text-center">
                    <button class="btn btn-small btn-round btn-d" id="cfsubmit" type="submit">Submit</button>&nbsp;&nbsp;
                    <button class="btn small btn-round btn-d" type="reset" name="reset">Reset</button>
                </div>
<!-- SUBMIT RESET END -->


<script>
    let message = document.getElementById('message');
    let addProduct = document.getElementById('addProduct');    
    addProduct.onclick = function() {
    message.innerHTML = "Add product message."
}
</script>

<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    var searchBox = document.getElementById('search');
    var resultsContainer = document.getElementById('search-results');

    searchBox.addEventListener('input', function() {
        var searchValue = this.value.trim();

        if (searchValue.length >= 3) {
            fetch('search.php', {
                method: 'POST',
                body: JSON.stringify({ search: searchValue })
            })
            .then(response => response.json())
            .then(data => {
                resultsContainer.innerHTML = '';
                data.forEach(item => {
                    resultsContainer.innerHTML += '<div class="item" style="cursor: pointer; :hover {background-color: d8dce9;}">' + item.product_name + " _____ Unit/" + item.unit_id +'</div>';
                });
            });
        } else {
            resultsContainer.innerHTML = '';
        }
    });
});
</script> -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    var searchBox = document.getElementById('search');
    var resultsContainer = document.getElementById('search-results');
    var clearBtn = document.getElementById('clearBtn');
    var unitPrice = document.getElementById('unit-price');

    // Function to handle click on search result item
    function handleClick(item) {
        // alert("You clicked on: " + item.innerText);
        // Add your custom action here, e.g., redirect to a page, display more info, etc.
        
        // Put the clicked item in the search box
        searchBox.value = item.innerText;
        // Clear search results
        resultsContainer.innerHTML = '';
        // Focus on the search box
        searchBox.focus();


        document.getElementById("add-quote").hidden = false;

    }

    searchBox.addEventListener('input', function() {
        var searchValue = this.value.trim();

        if (searchValue.length >= 3) {
            fetch('search.php', {
                method: 'POST',
                body: JSON.stringify({ search: searchValue })
            })
            .then(response => response.json())
            .then(data => {
                resultsContainer.innerHTML = '';
                data.forEach(item => {
                    var resultItem = document.createElement('div');
                    resultItem.classList.add('item');
                    resultItem.setAttribute("rel","stylesheet");
                    resultItem.setAttribute("href","http://localhost/labelements.shop/build2v/assets/css/style.css");
                    // resultItem.innerText = item.product_name;
                    // resultItem.innerText = item.product_name + " _____ Unit: " + item.unit_id;
                    resultItem.innerText = item.product_name + " ....... " + item.value + "/" + item.unit_id;
                    resultItem.addEventListener('click', function() {
                        handleClick(this);
                    });
                    resultsContainer.appendChild(resultItem);
                });
            });
        } else {
            resultsContainer.innerHTML = '';
        }
    });

    // Clear input field when clear button is clicked
    clearBtn.addEventListener('click', function() {
        searchBox.value = '';
        resultsContainer.innerHTML = '';
        document.getElementById("add-quote").hidden = true;
    });
});
</script>

