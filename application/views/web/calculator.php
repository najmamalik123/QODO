
  <div class="container mt-2 vh-100" style="max-width: 650px;">
    <div class=" shadow_2 p-4 mt-4">
      
      <h3 class="text-center mb-4">Website Price Calculator</h3>
      <p>Get to know Approx cost for your website requirement. Please note the price is not exact may change on final quote.</p>
      <hr/>
    <form id="priceCalculatorForm">
      <div class="form-group">
        <label for="websiteType">Website Type:</label>
        <select class="form-control" id="websiteType" name="websiteType" onchange="updatePrices()">
          <option value="ecom">E-commerce</option>
          <option value="business">Business Website</option>
          <option value="portfolio">Portfolio</option>
          <option value="school">School</option>
          <option value="landing">Landing Page</option>
          <option value="custom">Custom Development</option>
        </select>
      </div>
      <div class="form-group">
        <label for="websiteFeatures">Website Features:</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="paymentGateway" name="websiteFeatures[]" value="paymentGateway" onchange="updatePrices()">
          <label class="form-check-label" for="paymentGateway">Payment Gateway</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="whatsappIntegration" name="websiteFeatures[]" value="whatsappIntegration" onchange="updatePrices()">
          <label class="form-check-label" for="whatsappIntegration">WhatsApp Integration</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="adminPanel" name="websiteFeatures[]" value="adminPanel" onchange="updatePrices()">
          <label class="form-check-label" for="adminPanel">Admin Panel</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="smsGateway" name="websiteFeatures[]" value="smsGateway" onchange="updatePrices()">
          <label class="form-check-label" for="smsGateway">SMS Gateway</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="searchFunctionality" name="websiteFeatures[]" value="searchFunctionality" onchange="updatePrices()">
          <label class="form-check-label" for="searchFunctionality">Search Functionality</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="filters" name="websiteFeatures[]" value="filters" onchange="updatePrices()">
          <label class="form-check-label" for="filters">Filters</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="portfolio" name="websiteFeatures[]" value="portfolio" onchange="updatePrices()">
          <label class="form-check-label" for="portfolio">Portfolio</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gallery" name="websiteFeatures[]" value="gallery" onchange="updatePrices()">
          <label class="form-check-label" for="gallery">Gallery</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="quoteSystem" name="websiteFeatures[]" value="quoteSystem" onchange="updatePrices()">
          <label class="form-check-label" for="quoteSystem">Quote System</label>
        </div><div class="form-check">
          <input class="form-check-input" type="checkbox" id="hybridAPP" name="websiteFeatures[]" value="hybridAPP" onchange="updatePrices()">
          <label class="form-check-label" for="hybridAPP">Hybrid Android APP</label>
        </div>
      </div>
      <div class="form-group">
        <label for="websitePrice">Website Price:</label>
        <input type="text" class="form-control" id="websitePrice" name="websitePrice" readonly>
      </div>
      <!-- <button type="submit" class="btn btn-primary">Download PDF</button> -->
    </form>
  </div>
  </div>

  <script>
    function updatePrices() {
      var websiteType = document.getElementById("websiteType").value;
      var websiteFeatures = document.getElementsByName("websiteFeatures[]");
      var websitePrice = calculateWebsitePrice(websiteType, websiteFeatures);
      document.getElementById("websitePrice").value = websitePrice;
    }

    function calculateWebsitePrice(websiteType, websiteFeatures) {
      var basePrice = 0;
      var featurePrices = {
        paymentGateway: 5200,
        whatsappIntegration: 2000,
        adminPanel: 5000,
        smsGateway: 2500,
        searchFunctionality: 2000,
        filters: 2000,
        portfolio: 2100,
        gallery: 2500,
        quoteSystem: 2900,
        hybridAPP: 5500
      };

      // Calculate base price based on website type
      switch (websiteType) {
        case "ecom":
          basePrice = 17000;
          break;
        case "business":
          basePrice = 12000;
          break;
        case "portfolio":
          basePrice = 10000;
          break;
        case "school":
          basePrice = 14000;
          break;
        case "landing":
          basePrice = 8000;
          break;
        case "custom":
          basePrice = 44000;
          break;
      }

      // Calculate additional feature prices
      for (var i = 0; i < websiteFeatures.length; i++) {
        if (websiteFeatures[i].checked) {
          var feature = websiteFeatures[i].value;
          basePrice += featurePrices[feature];
        }
      }

      return basePrice;
    }

    // Submit form and download PDF
    document.getElementById("priceCalculatorForm").addEventListener("submit", function(event) {
      event.preventDefault();
      var websitePrice = document.getElementById("websitePrice").value;
      // Add logic to generate PDF and download
      alert("PDF download functionality is not implemented in this demo.");
    });
  </script>
