<!-- Custom Styles -->
<style>
    /* Tabs */
   main .nav-tabs {
        border-bottom: none;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 8px;
    }
   main .nav-tabs .nav-link {
        font-weight: 600;
        color: #495057;
        border-radius: 8px;
        margin: 0 4px;
        transition: all 0.3s ease;
    }
   main .nav-tabs .nav-link:hover {
        background: #e9ecef;
    }
   main .nav-tabs .nav-link.active {
        background: #f8ead8;
        color: #fff;
    }

    /* Card Sections */
    .calc-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease-in-out;
    }
    .calc-card:hover {
        transform: translateY(-2px);
    }

    /* Form Controls */
    .form-floating>.form-control, 
    .form-floating>.form-select {
        border-radius: 8px;
    }
    .form-floating label {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Results */
    #emiResult strong, 
    #roiResult strong, 
    #loanResult strong,
    #areaResult strong {
        font-size: 1.1rem;
        color: #198754;
    }

    /* Recommendation Cards */
    .property-card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
        background: #fff;
        cursor: pointer;
    }
    .property-card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        background: #f8f9fa;
    }
</style>

<div class="py-4">
    <div class="container">
        <div class="row justify-content-center">
              <?php include 'inc/_lsidebar.php' ?>
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <ul class="nav nav-tabs mb-4" id="calculatorTabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#emi">EMI</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#roi">ROI</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#loan">Loan</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#area">Area</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#recommendation">Recommendations</button></li>
                </ul>

                <div class="tab-content" id="calculatorTabsContent">
                    <!-- EMI -->
                    <div class="tab-pane fade show active" id="emi">
                        <div class="calc-card mb-4">
                            <h4 class="mb-3">💰 Calculate EMI</h4>
                            <div class="form-floating mb-3">
                                <input type="number" id="loanAmount" class="form-control" placeholder="Loan Amount">
                                <label for="loanAmount">Loan Amount</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="interestRate" class="form-control" placeholder="Interest Rate">
                                <label for="interestRate">Interest Rate (%)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="loanTenure" class="form-control" placeholder="Tenure">
                                <label for="loanTenure">Tenure (Years)</label>
                            </div>
                            <div id="emiResult" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- ROI -->
                    <div class="tab-pane fade" id="roi">
                        <div class="calc-card mb-4">
                            <h4 class="mb-3">📈 Calculate ROI</h4>
                            <div class="form-floating mb-3">
                                <input type="number" id="investmentAmount" class="form-control" placeholder="Investment">
                                <label for="investmentAmount">Investment Amount</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="returnAmount" class="form-control" placeholder="Returns">
                                <label for="returnAmount">Return Amount</label>
                            </div>
                            <div id="roiResult" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- Loan -->
                    <div class="tab-pane fade" id="loan">
                        <div class="calc-card mb-4">
                            <h4 class="mb-3">🏦 Loan Calculator</h4>
                            <div class="form-floating mb-3">
                                <input type="number" id="monthlyPayment" class="form-control" placeholder="Monthly EMI">
                                <label for="monthlyPayment">Monthly EMI</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="loanRate" class="form-control" placeholder="Interest Rate">
                                <label for="loanRate">Interest Rate (%)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="loanTerm" class="form-control" placeholder="Loan Term">
                                <label for="loanTerm">Loan Term (Years)</label>
                            </div>
                            <div id="loanResult" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- Area -->
                    <div class="tab-pane fade" id="area">
                        <div class="calc-card mb-4">
                            <h4 class="mb-3">📐 Area Converter</h4>
                            <div class="form-floating mb-3">
                                <input type="number" id="sqFeet" class="form-control" placeholder="Square Feet">
                                <label for="sqFeet">Square Feet</label>
                            </div>
                            <div id="areaResult" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- Recommendation -->
                    <div class="tab-pane fade" id="recommendation">
                        <div class="calc-card mb-4">
                            <h4 class="mb-3">🏠 Property Recommendations</h4>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="budget">
                                    <option selected disabled>Select Max Budget</option>
                                    <option value="500000">500,000</option>
                                    <option value="1000000">1,000,000</option>
                                    <option value="2000000">2,000,000</option>
                                    <option value="3000000">3,000,000</option>
                                    <option value="4000000">4,000,000</option>
                                    <option value="5000000">5,000,000</option>
                                </select>
                                <label for="budget">Budget</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="preference">
                                    <option value="">Select Preference</option>
                                    <option value="1-1">1 Bed, 1 Bath</option>
                                    <option value="2-2">2 Bed, 2 Bath</option>
                                    <option value="3-2">3 Bed, 2 Bath</option>
                                    <option value="4-3">4 Bed, 3 Bath</option>
                                    <option value="studio">Studio</option>
                                </select>
                                <label for="preference">Preference</label>
                            </div>

                            <div id="recommendationResults" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </main>

          
            <?php include 'inc/_rsidebar.php' ?>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    // Live EMI
    ['loanAmount', 'interestRate', 'loanTenure'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateEMI);
    });

    function calculateEMI() {
        const P = parseFloat(loanAmount.value);
        const R = parseFloat(interestRate.value) / 12 / 100;
        const N = parseFloat(loanTenure.value) * 12;
        if (P && R && N) {
            const emi = (P * R * Math.pow(1 + R, N)) / (Math.pow(1 + R, N) - 1);
            emiResult.innerHTML = `<strong>EMI: â‚¹${emi.toFixed(2)}</strong>`;
        } else {
            emiResult.innerHTML = '';
        }
    }

    // Live ROI
    ['investmentAmount', 'returnAmount'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateROI);
    });

    function calculateROI() {
        const invest = parseFloat(investmentAmount.value);
        const returns = parseFloat(returnAmount.value);
        if (invest && returns) {
            const roi = ((returns - invest) / invest) * 100;
            roiResult.innerHTML = `<strong>ROI: ${roi.toFixed(2)}%</strong>`;
        } else {
            roiResult.innerHTML = '';
        }
    }

    // Live Loan Amount
    ['monthlyPayment', 'loanRate', 'loanTerm'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateLoanAmount);
    });

    function calculateLoanAmount() {
        const EMI = parseFloat(monthlyPayment.value);
        const R = parseFloat(loanRate.value) / 12 / 100;
        const N = parseFloat(loanTerm.value) * 12;
        if (EMI && R && N) {
            const loan = EMI * (Math.pow(1 + R, N) - 1) / (R * Math.pow(1 + R, N));
            loanResult.innerHTML = `<strong>Loan Amount: â‚¹${loan.toFixed(2)}</strong>`;
        } else {
            loanResult.innerHTML = '';
        }
    }

    // Live Area Conversion
    document.getElementById('sqFeet').addEventListener('input', convertArea);

    function convertArea() {
        const sqft = parseFloat(sqFeet.value);
        if (sqft) {
            const sqm = sqft * 0.092903;
            const acres = sqft / 43560;
            areaResult.innerHTML = `<strong>${sqm.toFixed(2)} mÂ²</strong><br><strong>${acres.toFixed(4)} acres</strong>`;
        } else {
            areaResult.innerHTML = '';
        }
    }

    // Live Property Recommendations
    document.getElementById('budget').addEventListener('input', getRecommendations);
    document.getElementById('preference').addEventListener('change', getRecommendations);

    function getRecommendations() {
        const budget = document.getElementById('budget').value;
        const pref = document.getElementById('preference').value;
        let bedrooms = '',
            bathrooms = '';

        if (pref && pref !== 'studio') {
            [bedrooms, bathrooms] = pref.split('-');
        } else if (pref === 'studio') {
            bedrooms = '0';
            bathrooms = '1';
        }

        const url = `<?= base_url('action/get_recommendations') ?>?budget=${budget}&bedrooms=${bedrooms}&bathrooms=${bathrooms}`;
        console.log("Fetching URL:", url); // ðŸ‘ˆ This helps verify what you're sending

        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log("Received data:", data); // ðŸ‘ˆ This shows what server returns

                const box = document.getElementById('recommendationResults');
                box.innerHTML = '';

                if (!data.length) {
                    box.innerHTML = '<div class="alert alert-info">No properties found.</div>';
                    return;
                }

                function urlSmart(text) {
                    return text.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '') // remove invalid characters
                        .replace(/\s+/g, '-') // replace whitespace with dashes
                        .replace(/-+/g, '-') // collapse multiple dashes
                        .trim();
                }

                data.forEach(prop => {
                    const url = `<?= base_url('property') ?>/${prop.prop_id}/${urlSmart(prop.prop_name)}`;


                    box.innerHTML += `
        <div class="card mb-3 hover-shadow" style="cursor: pointer;" onclick="window.location.href='${url}'">
            <div class="card-body">
                <h5 class="mb-1">${prop.prop_name}</h5>
                <p class="mb-0">â‚¹${Number(prop.prop_price).toLocaleString()}<br>
                ${prop.prop_bedroom} Bed | ${prop.prop_bathroom} Bath | ${prop.prop_area} sq.ft</p>
            </div>
        </div>`;
                });

            })
            .catch(err => {
                console.error("Fetch error:", err);
            });
    }
</script>