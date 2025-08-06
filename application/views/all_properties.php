<style>
    .category-pill {
        font-size: 13px;
        /*border: 1px solid #ddd;*/
        border-radius: 999px;
        padding: 2px 14px;
        background-color: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        color: #333;
        user-select: none;
    }

    .category-pill input[type="checkbox"] {
        display: none;
    }

    .category-pill input[type="checkbox"]:checked+span {
        background-color: #5a1d321c;
        color: #111;
        border: 1px solid #5a1d32;
    }

    .category-pill span {
        display: inline-block;
        border-radius: 999px;
        padding: 2px 10px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    /* When NOT checked — keep light border */
    .category-pill input[type="checkbox"]:not(:checked)+span {
        border-color: #ddd;
    }

    @media (max-width: 767.98px) {
        #mobileFilterCollapse.collapsing {
            transition: height 0.3s ease;
        }
    }
</style>

<div class="pb-4">
    <div class="container-fluid" style="max-width:100%;">
        <div class="search-background">
            <div class="video-container d-none d-sm-block">
                <div class="video-background">
                    <iframe class="iframe_video"
                        src="https://www.youtube.com/embed/mJVuZiK9a6I?controls=0&autoplay=1&mute=1&playsinline=1&loop=1&playlist=mJVuZiK9a6I&rel=0"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>

            <!--<div class="search-decor"></div>-->
            <!--<i class="fas fa-city floating-icon"></i>-->
            <!--<div class="search-container">-->
            <!--    <div class="search-banner">-->
            <!--        <div class="tabs">-->
            <!--            <button class="tab-btn active" onclick="setType('sale')">SALE</button>-->
            <!--            <button class="tab-btn" onclick="setType('rent')">RENT</button>-->
            <!--            <button class="tab-btn" onclick="setType('commercial')">COMMERCIAL</button>-->
            <!--            <button class="tab-btn" onclick="setType('pg')">PG/CO-LIVING</button>-->
            <!--            <button class="tab-btn" onclick="setType('plots')">PLOTS</button>-->
            <!--        </div>-->

            <!--        <div class="search-wrapper">-->
            <!--            <div class="input-wrapper">-->
            <!--                <div class="input-icon">-->
            <!--                    <i class="fas fa-map-marker-alt"></i>-->
            <!--                    <input type="text" id="city-input" placeholder="Select City" oninput="fetchSuggestionsDebounced(this.value)">-->
            <!--                </div>-->

            <!--                <ul id="suggestions" class="autocomplete-list"></ul>-->
            <!--            </div>-->
            <!--            <button id="search-btn" class="search-btn">Search</button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
         <div class="search-container">
                <div class="search-banner">
                    <div class="tabs">
                        <button class="tab-btn active" onclick="setType('sale')">SALE</button>
                        <button class="tab-btn" onclick="setType('rent')">RENT</button>
                        <button class="tab-btn" onclick="setType('commercial')">COMMERCIAL</button>
                        <button class="tab-btn" onclick="setType('pg')">PG/CO-LIVING</button>
                        <button class="tab-btn" onclick="setType('plots')">PLOTS</button>
                    </div>

                    <div class="search-wrapper">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" id="city-input" placeholder="Select City" oninput="fetchSuggestionsDebounced(this.value)">
                            </div>

                            <ul id="suggestions" class="autocomplete-list"></ul>
                        </div>
                        <button id="search-btn" class="search-btn">Search</button>
                    </div>
                </div>
            </div>
        <style>
            .video-container {
                width: 100vw;
                height: 0vh;
            }

            .video-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 90%;
                overflow: hidden;
                z-index: -1;
            }

            .video-iframe {
                width: 100vw;
                height: 56.25vw;
                /* 16:9 aspect ratio */
                min-height: 100vh;
                min-width: 177.77vh;
                /* 16:9 aspect ratio */
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
                /* disables interaction */
            }


            .search-background {
                position: relative;
                width: 100%;
                overflow: hidden;
                /* background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.06), transparent 60%),
					radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.03), transparent 70%),
					linear-gradient(135deg, #3a0d1a, #5B2333, #3a0d1a); */
                background-size: cover;
                background-repeat: no-repeat;
                padding: 100px 0;
                    height: 420px;
            }

            .search-decor::before,
            .search-decor::after {
                content: '';
                position: absolute;
                border-radius: 50%;
                z-index: 0;
                opacity: 0.2;
            }

            .search-decor::before {
                width: 400px;
                height: 400px;
                background: #00e4b3;
                top: -100px;
                left: -100px;
            }

            .search-decor::after {
                width: 500px;
                height: 500px;
                background: #00e4b3;
                bottom: -150px;
                right: -150px;
            }

            /* optional: animated floating icon */
            .search-background .floating-icon {
                position: absolute;
                top: 20%;
                left: 10%;
                font-size: 100px;
                color: #00e4b3;
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .search-container {
                width: 100%;
                display: flex;
                justify-content: center;
                padding: 0px 20px 50px;
                margin-top: -111px;
                /* background: linear-gradient(to right, #5B2333, #842439); */

            }

            .search-banner {
                background: #5B2333;
                border-radius: 25px;
                padding: 30px;
                max-width: 1165px;
                width: 100%;
                color: #fff;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            }


            .tabs {
                display: flex;
                gap: 20px;
                margin-bottom: 20px;
                border-bottom: 1px solid #444;
            }

            .tab-btn {
                background: none;
                border: none;
                color: #ccc;
                font-weight: bold;
                font-size: 14px;
                cursor: pointer;
                padding-bottom: 10px;
                transition: all 0.3s ease;
            }

            .tab-btn.active {
                color: #00e4b3;
                border-bottom: 3px solid #00e4b3;
            }

            .search-wrapper {
                display: flex;
                align-items: center;
                background: #fff;
                border-radius: 50px;
                padding: 5px;
                position: relative;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .input-wrapper {
                width: 100%;
            }

            #city-input {
                width: 95%;
                padding: 15px 20px;
                border: none;
                border-radius: 50px 0 0 50px;
                font-size: 16px;
                outline: none;
                color: #333;
            }

            .search-btn {
                background: linear-gradient(135deg, #00e4b3, #00cfa3);
                color: #fff;
                padding: 14px 25px;
                border: none;
                border-radius: 50px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
                transition: background 0.3s, box-shadow 0.3s;
                margin-left: -10px;
                box-shadow: 0 4px 10px rgba(0, 228, 179, 0.3);
            }

            .search-btn:hover {
                box-shadow: 0 6px 16px rgba(0, 228, 179, 0.5);
            }


            .autocomplete-list {
                display: none;
                position: absolute;
                top: 91%;
                left: 18px;
                width: 82%;
                background: #fff;
                border-radius: 0 0 12px 12px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                max-height: 220px;
                overflow-y: auto;
                z-index: 999;
                margin-top: 2px;
                padding: 10px 0;
                list-style: none;
            }

            .autocomplete-list.visible {
                display: block;
            }


            .autocomplete-list::before {
                content: 'TOP CITIES';
                display: block;
                font-size: 12px;
                color: #777;
                padding: 5px 20px;
                border-bottom: 1px solid #eee;
                margin-bottom: 5px;
            }

            .autocomplete-list li {
                padding: 10px 20px;
                cursor: pointer;
                font-size: 14px;
                color: #555353;
            }

            .autocomplete-list li:hover {
                background-color: #f0f0f0;
            }

            .input-icon {
                position: relative;
                width: 100%;
            }

            .input-icon i {
                position: absolute;
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
                color: #888;
                font-size: 16px;
                z-index: 2;
            }

            .input-icon input {
                padding-left: 45px !important;
            }

            @media (max-width: 900px) {
                .search-banner {
                    padding: 20px;
                    border-radius: 20px;
                }

                .search-wrapper {
                    flex-direction: column;
                    gap: 10px;
                    padding: 10px;
                    border-radius: 20px;
                }

                #city-input {
                    width: 100%;
                    font-size: 14px;
                    padding: 12px 16px;
                    border-radius: 12px;
                }

                .search-btn {
                    width: 100%;
                    font-size: 15px;
                    padding: 12px 16px;
                    border-radius: 12px;
                    margin-left: 0;
                }

                .input-icon i {
                    left: 15px;
                    font-size: 14px;
                }

                .input-icon input {
                    padding-left: 40px !important;
                }

                .tabs {
                    flex-wrap: wrap;
                    gap: 10px;
                }

                .tab-btn {
                    font-size: 13px;
                    padding: 8px 10px;
                }

                .search-decor::before {
                    width: 200px;
                    height: 200px;
                    background: #00e4b3;
                    top: -65px;
                    left: -81px;
                }

                .search-decor::after {
                    width: 200px;
                    height: 200px;
                    background: #00e4b3;
                    bottom: -61px;
                    right: -82px;
                }

                .search-background .floating-icon {
                    position: absolute;
                    top: 9%;
                    left: 15%;
                    font-size: 63px;
                    color: #00e4b3;
                    animation: float 6s ease-in-out infinite;
                }
            }
        </style>
        <script>
            let selectedType = 'sale';
            let debounceTimeout;

            function setType(type) {
                selectedType = type;
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');
                hideSuggestions();
            }

            function fetchSuggestions(query = '') {
                const suggestions = document.getElementById('suggestions');

                fetch('<?= base_url("action/property_search") ?>?type=' + selectedType + '&city=' + encodeURIComponent(query))
                    .then(res => res.json())
                    .then(data => {
                        suggestions.innerHTML = '';
                        suggestions.classList.add('visible');

                        if (!data.length) {
                            const li = document.createElement('li');
                            li.textContent = 'No cities found';
                            li.style.color = '#999';
                            suggestions.appendChild(li);
                            return;
                        }

                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.textContent = item.prop_city_name;
                            li.onclick = () => {
                                document.getElementById('city-input').value = item.prop_city_name;
                                hideSuggestions();
                            };
                            suggestions.appendChild(li);
                        });
                    });
            }

            function fetchSuggestionsDebounced(query) {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => fetchSuggestions(query), 300);
            }

            function hideSuggestions() {
                const suggestions = document.getElementById('suggestions');
                suggestions.classList.remove('visible');
                suggestions.innerHTML = '';
            }

            // On focus: show cities
            document.getElementById('city-input').addEventListener('focus', () => {
                fetchSuggestions();
            });

            // On input: filter suggestions
            document.getElementById('city-input').addEventListener('input', (e) => {
                fetchSuggestionsDebounced(e.target.value);
            });

            // On outside click: hide dropdown
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.input-wrapper')) {
                    hideSuggestions();
                }
            });
            document.getElementById('search-btn').addEventListener('click', function() {
                const city = document.getElementById('city-input').value.trim();
                if (!city) {
                    alert('Please enter a city');
                    return;
                }
                const BASE_URL = "<?= base_url('') ?>";

                // `selectedType` is already handled globally
                const url = `${BASE_URL}properties?type=${encodeURIComponent(selectedType)}&city=${encodeURIComponent(city)}`;
                window.location.href = url;
            });
        </script>



    </div>

    <div class="container-fluid">
        <div class="row position-relative">
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
                <div class="p-2 bg-light offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" data-bs-backdrop="false">
                    <div class="sidebar-nav mb-3">
                        <div class="pb-4">
                            <a href="<?= base_url('home') ?>" class="text-decoration-none">
                                <img src="<?= base_url('assets/avator/logo.png') ?>" class="img-fluid logo" alt="brand-logo">
                            </a>
                        </div>
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item p-2">
                                <a href="<?= base_url('home') ?>" class="nav-link <?= $last_segment == '' ? 'active' : '' ?>"><span class="material-icons me-3">house</span> <span>Home</span></a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="<?= base_url('explore') ?>" class="nav-link <?= $last_segment == 'explore' ? 'active' : '' ?>"><span class="material-icons me-3">location_city</span><span>Articles & News</span></a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="<?= base_url('properties') ?>" class="nav-link <?= $last_segment == 'properties' ? 'active' : '' ?>"><span class="material-icons me-3">real_estate_agent</span> <span>Explore Properties</span></a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="<?= base_url('properties') ?>" class="nav-link <?= $last_segment == 'properties' ? 'active' : '' ?>"><span class="material-icons me-3">domain</span> <span>Hot Investments</span></a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="<?= base_url('calculator') ?>" class="nav-link <?= $last_segment == 'calculator' ? 'active' : '' ?>"><i class="fa-solid fa-calculator me-3"></i> <span>Tools & Calculators</span></a>
                            </li>


                            <li class="nav-item px-2">
                                <a href="<?= base_url('contact') ?>" class="nav-link <?= $last_segment == 'contact' ? 'active' : '' ?>"><span class="material-icons me-3">explore</span> <span>Messages</span></a>
                            </li>

                            <li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'faq' ? 'active' : '' ?>" href="<?= base_url('faq') ?>"><span class="material-icons me-3">question_answer</span> <span>Foreign Investments</span></a></li>
                            <?php if (isset($_SESSION['yid'])) {  ?>
                                <li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'my-property' ? 'active' : '' ?>" href="<?= base_url('my-property') ?>"><i class="fa-solid fa-house-user  me-3"></i><span>My Properties</span></a></li>
                                <li class="nav-item px-2">
                                    <a href="<?= base_url('profile') ?>" class="nav-link <?= $last_segment == 'profile' ? 'active' : '' ?>"><span class="material-icons me-3">account_circle</span> <span>Profile</span></a>
                                </li>
                                <li class="nav-item px-2"><a class="nav-link <?= $last_segment == 'edit' ? 'active' : '' ?>" href="<?= base_url('edit') ?>"><span class="material-icons me-3">manage_accounts</span> <span>Edit Profile</span></a></li>

                                <li class="nav-item px-2">
                                    <a href="<?= base_url('logout') ?>" class="nav-link"><span class="material-icons me-3">logout</span> <span>Logout</span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
                <style>
/* Hide filter on mobile by default */
.mobile-filter-container {
    display: none;
}

/* Show filter when active */
.mobile-filter-container.show {
    display: block;
}

/* Always show filter on desktop */
@media (min-width: 768px) {
    .mobile-filter-container {
        display: block !important;
    }
}
</style>

                <div class="d-md-none mb-3 text-end px-3">
                    <button id="filterToggleBtn" class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 fw-bold">
                        <i class="material-icons md-18 align-middle">tune</i> Filters
                    </button>
                </div>
                <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('filterToggleBtn');
        const filterBox = document.getElementById('customMobileFilter');

        toggleBtn.addEventListener('click', function () {
            filterBox.classList.toggle('show');
        });
    });
</script>

                <div id="customMobileFilter" class="mobile-filter-container d-md-block sidebar-nav bg-white p-3 py-4 shadow-sm rounded-4 mb-3" >
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        <?php


                        // Fetching applied filters
                        $selected_categories = [];

                        if (isset($_GET['categories'])) {
                            if (is_array($_GET['categories'])) {
                                $selected_categories = $_GET['categories'];
                            } else {
                                $selected_categories = explode(',', $_GET['categories']);
                            }
                        }

                        $selected_developers = [];

                        if (isset($_GET['developers'])) {
                            if (is_array($_GET['developers'])) {
                                $selected_developers = $_GET['developers'];
                            } else {
                                $selected_developers = explode(',', $_GET['developers']);
                            }
                        }


                        $price = isset($_GET['price']) ? $_GET['price'] : '';
                        $bedrooms   = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : null;
                        $bathrooms  = isset($_GET['bathrooms']) ? $_GET['bathrooms'] : null;
                        $city       = isset($_GET['city']) ? trim($_GET['city']) : null;
                        $type       = isset($_GET['type']) ? trim($_GET['type']) : null;

                        // Displaying type (sale/rent)
                        if (!empty($type)) {
                            $display_type = strtoupper($type) === 'RENT' ? 'Rent' : 'Sale';
                            echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">Type: ' . ucfirst($display_type) . '</span>';
                        }

                        // Displaying city
                        if (!empty($city)) {
                            echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">City: ' . htmlspecialchars(ucwords($city)) . '</span>';
                        }

                        // Displaying categories
                        if (!empty($selected_categories)) {
                            $categories = $this->db->query("SELECT * FROM yn_site_catagory WHERE display = '1' ORDER BY sid ASC")->result_array();
                            foreach ($categories as $category) {
                                if (in_array($category['ctid'], $selected_categories)) {
                                    echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">' . htmlspecialchars($category['name']) . '</span>';
                                }
                            }
                        }

                        // Displaying developers
                        if (!empty($selected_developers)) {
                            $categories = $this->db->query("SELECT * FROM yn_site_mem WHERE is_vendor= '1' ORDER BY mid ASC")->result_array();
                            foreach ($categories as $category) {
                                if (in_array($category['mid'], $selected_developers)) {
                                    echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">' . htmlspecialchars($category['name']) . '</span>';
                                }
                            }
                        }

                        // Get selected price from URL safely
                        $price = isset($_GET['price']) ? $_GET['price'] : '';

                        // Define the price ranges here again (for label mapping)
                        $price_ranges = [
                            '5000000-10000000' => '50 Lacs - 1 Crore',
                            '10000001-15000000' => '1 Crore - 1.5 Crore',
                            '15000001-20000000' => '1.5 Crore - 2 Crore',
                            '20000001-25000000' => '2 Crore - 2.5 Crore',
                            '25000001-30000000' => '2.5 Crore - 3 Crore',
                            '30000001-40000000' => '3 Crore - 4 Crore',
                            '40000001-50000000' => '4 Crore - 5 Crore',
                            '50000001-100000000' => '5 Crore - 10 Crore',
                            '100000001-150000000' => '10 Crore - 15 Crore',
                            '150000001-200000000' => '15 Crore - 20 Crore',
                            '200000001-300000000' => '20 Crore - 30 Crore',
                            '300000001-999999999' => '30 Crore+'
                        ];

                        // Display the selected price label if available
                        if (!empty($price)) {
                            $label = isset($price_ranges[$price]) ? $price_ranges[$price] : $price;
                            echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">' . htmlspecialchars($label) . '</span>';
                        }


                        // Bedrooms
                        if ($bedrooms) {
                            echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">Bedrooms: ' . htmlspecialchars($bedrooms) . '</span>';
                        }

                        // Bathrooms
                        if ($bathrooms) {
                            echo '<span class="badge rounded-pill bg-primary text-white px-3 py-2">Bathrooms: ' . htmlspecialchars($bathrooms) . '</span>';
                        }
                        ?>
                        <?php if (isset($type)) { ?>
                            <a href="<?= base_url('properties') ?> " class="btn px-4 py-1 rounded-pill border border-primary text-primary">Remove Filters</a>
                        <?php } ?>
                    </div>

                    <style>
                        .btn-group-toggle .btn {
                            text-align: left;
                            font-size: 11px;
                            display: flex;
                            align-items: center;
                            gap: 5px;
                            padding: 4px;
                        }
                    </style>
                    <?php
                    // Getting filter values from URL
                    $price_ranges = [
                        '5000000-10000000' => '50 Lacs - 1 Crore',
                        '10000001-15000000' => '1 Crore - 1.5 Crore',
                        '15000001-20000000' => '1.5 Crore - 2 Crore',
                        '20000001-25000000' => '2 Crore - 2.5 Crore',
                        '25000001-30000000' => '2.5 Crore - 3 Crore',
                        '30000001-40000000' => '3 Crore - 4 Crore',
                        '40000001-50000000' => '4 Crore - 5 Crore',
                        '50000001-100000000' => '5 Crore - 10 Crore',
                        '100000001-150000000' => '10 Crore - 15 Crore',
                        '150000001-200000000' => '15 Crore - 20 Crore',
                        '200000001-300000000' => '20 Crore - 30 Crore',
                        '300000001-999999999' => '30 Crore+'
                    ];

                    $selected_price = isset($_GET['price']) ? $_GET['price'] : '';
                    $type = isset($_GET['type']) ? $_GET['type'] : '';
                    $selected_bedrooms = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '';
                    $selected_bathrooms = isset($_GET['bathrooms']) ? $_GET['bathrooms'] : '';
                    $selected_categories = [];

                    if (isset($_GET['categories'])) {
                        if (is_array($_GET['categories'])) {
                            $selected_categories = $_GET['categories'];
                        } else {
                            $selected_categories = explode(',', $_GET['categories']);
                        }
                    }


                    ?>

                    <form method="get" action="<?= base_url('action/smart_search_props') ?>">
                        <div class="modal-body p-0 mb-3">

                            <!-- Price Range Dropdown -->
                            <div class="mb-4">
                                <label class="form-label h6 text-muted">Price Range</label>
                                <select name="price_range" class="form-control rounded-5">
                                    <option value="">Select Price Range</option>
                                    <?php foreach ($price_ranges as $range => $label): ?>
                                        <option value="<?= $range ?>" <?= ($selected_price == $range) ? 'selected' : '' ?>><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>





                            <!-- Categories as Pill-shaped Checkboxes -->
                            <div class="mb-4">
                                <label class="form-label h6 text-muted">Categories</label>
                                <div class="d-flex flex-wrap">
                                    <?php
                                    $categories = $this->db->query("SELECT * FROM yn_site_catagory WHERE display = '1' ORDER BY sid ASC")->result_array();
                                    foreach ($categories as $category) {
                                        $isChecked = in_array($category['ctid'], $selected_categories) ? 'checked' : '';
                                    ?>
                                        <label class="category-pill">
                                            <input type="checkbox" name="categories[]" value="<?= $category['ctid'] ?>" <?= $isChecked ?>>
                                            <span>+ <?= $category['name'] ?></span>
                                        </label>
                                    <?php } ?>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label class="form-label h6 text-muted">Developers</label>
                                <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
                                    <?php
                                    $categories1 = $this->db->query("SELECT * FROM yn_site_mem WHERE is_vendor = '1' ")->result_array();
                                    foreach ($categories1 as $category) {
                                        $isChecked = in_array($category['mid'], $selected_developers) ? 'checked' : '';
                                    ?>
                                        <label class="btn ">
                                            <input type="checkbox" name="developers[]" value="<?= $category['mid'] ?>" <?= $isChecked ?>> <?= $category['name'] ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Bedrooms Dropdown -->
                            <div class="form-floating mb-3">
                                <select class="form-control rounded-5 border-1 shadow-sm" name="bedrooms" id="bedrooms" style="    font-size: 13px;">
                                    <option value="">Select Number of Bedrooms</option>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?= $i ?>" <?= $selected_bedrooms == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                                <label for="bedrooms" class="h6 text-muted mb-0">Number of Bedrooms</label>
                            </div>


                            <!-- Bathrooms Dropdown -->
                            <div class="form-floating mb-3">
                                <select class="form-control rounded-5 border-1 shadow-sm" name="bathrooms" id="bathrooms" style="    font-size: 13px;">
                                    <option value="">Select Number of Bathrooms</option>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?= $i ?>" <?= $selected_bathrooms == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                                <label for="bathrooms" class="h6 text-muted mb-0">Number of Bathrooms</label>
                            </div>

                            <div class="form-floating mb-4">
                                <select class="form-control rounded-5 border-1 shadow-sm" name="type" id="type" style="    font-size: 13px;">
                                    <option value="">Select Type</option>
                                    <option value="rent" <?= $type == 'rent' ? 'selected' : '' ?>>Rent</option>
                                    <option value="sale" <?= $type == 'sale' ? 'selected' : '' ?>>Sale</option>
                                </select>
                                <label for="type" class="h6 text-muted mb-0">Type</label>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between px-1 py-1 bg-white shadow-sm rounded-5">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold px-3 py-1 fs-8 mb-0 w-100">Apply Filters</button>
                            <!-- <button type="button" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0" data-bs-dismiss="modal">Close</button> -->
                        </div>
                    </form>
                </div>
                <?php if (!isset($_SESSION['yid']) || $_SESSION['plan'] == '') {  ?>
                    <div class="card p-4 text-light mb-4" style=" border-radius: 16px; background: linear-gradient(to bottom, #5A1D32, #5A1D32);">
                        <h5 class="fw-bold text-white">Why Richo Club?</h5>
                        <p class="text-white"> We don’t promise you just properties</p>

                        <ul class=" text-white">
                            <li class="mb-2">India’s First Elite <strong>Real Estate Club!</strong> </li>
                            <li class="mb-2">Exclusive Community of <strong>Top 1% Investors</strong></li>
                            <li class="mb-2"><strong>ZERO Brokerage</strong> - Buy Directly From Developer!</li>
                            <li class="mb-2"><strong>1% Loyalty Benefits</strong> on Every Investment</li>
                            <li class="mb-2">Online + Offline <strong>Legal Support</strong></li>
                        </ul>

                        <a href="<?= base_url('membership') ?>" class="btn  mt-3 py-2" style="background-color: white; color: #5A1D32; border-radius: 30px; font-weight: bold; font-size:12px;">
                            Become a member
                        </a>
                    </div>

                <?php } ?>

                <!-- </div> -->
            </aside>
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-black fw-bold">Recommended Properties</h4>
                            </div>
                            <div>
                                <div class="pt-1 feeds row" id="property-list">
                                    <?php
                                    $total_properties = count($properties);
                                    $initial_limit = 6;
                                    $index = 0;

                                    foreach ($properties as $row) {
                                        $display = ($index < $initial_limit) ? '' : 'style="display:none"';
                                        echo '<div class="col-md-4 mb-4 property-item" ' . $display . '>';
                                        include('inc/inc_shop_product_card.php');
                                        echo '</div>';
                                        $index++;
                                    }
                                    ?>
                                </div>

                                <?php if ($total_properties > $initial_limit): ?>
                                    <div class="text-center mt-3">
                                        <button id="loadMoreBtn" class="btn btn-outline-dark rounded-pill px-4 py-2">See More</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let currentVisible = 6;
                            const step = 9;
                            const items = document.querySelectorAll('.property-item');
                            const loadMoreBtn = document.getElementById('loadMoreBtn');

                            loadMoreBtn?.addEventListener('click', function() {
                                let shown = 0;

                                for (let i = currentVisible; i < items.length && shown < step; i++) {
                                    items[i].style.display = '';
                                    shown++;
                                }

                                currentVisible += shown;

                                if (currentVisible >= items.length) {
                                    loadMoreBtn.style.display = 'none';
                                }
                            });
                        });
                    </script>

                    <section class="py-2">
                        <div class="container">
                            <h4 class="fw-bold mb-2 text-black">Apartments, Villas and more</h4>
                            <!-- <p class="text-muted mb-4">in Gurgaon</p> -->

                            <div class="row">
                                <?php
                                $categories = $this->db->query("SELECT * FROM yn_site_catagory  ORDER BY ctid ASC LIMIT 3")->result_array();
                                foreach ($categories as $cat) { ?>
                                    <div class="col-md-4 mb-4">
                                        <a href="<?= base_url('properties') ?>?categories=<?= $cat['ctid'] ?>" class="text-decoration-none">
                                            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                                                <div style="height: 200px; background-image: url('<?= base_url('assets/avator/upload/' . $cat['img']) ?>'); background-size: cover; background-position: center;"></div>
                                                <div class="card-body text-center" style="background-color: <?= $cat['bg_color'] ?? '#f7f7f7' ?>;">
                                                    <h5 class="fw-semibold text-dark"><?= $cat['name'] ?></h5>
                                                    <!-- <p class="text-muted"><?= number_format($cat['property_count']) ?>+ Properties</p> -->
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold text-black">Most Recent Properties</h4>
                                <!-- <button data-bs-toggle="modal" data-bs-target="#filtersModal" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0 d-flex align-items-center"><i class="fa-solid fa-sliders" style="font-size: 17px;"></i></button>  -->
                            </div>
                            <div>
                                <!-- Feeds -->
                                <div class="pt-1 feeds row">
                                    <?php
                                    $getProperties1 = $this->db->query("SELECT * FROM x_home_property WHERE prop_status='1' ORDER BY prop_id DESC LIMIT 6");
                                    $properties1 = $getProperties1->result_array();
                                    if (count($properties1) > 0) {
                                        foreach ($properties1 as $row) {
                                    ?>
                                            <div class="col-md-4 mb-4">
                                                <?php
                                                include('inc/inc_shop_product_card.php');
                                                ?>
                                            </div>
                                        <?php
                                        }
                                    } else { ?>
                                        <!-- Feed Item -->
                                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
                                            <p class="text-dark m-0">No Property found</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold text-black">Developers</h4>
                                <a href="<?= base_url('developers') ?>" style="font-size: 20px; margin-right: 20px;">See All</a>
                            </div>
                            <div>
                                <!-- Feeds -->
                                <div class="pt-1 feeds row">
                                    <?php

                                    $getdeveloper = $this->db->query("SELECT * FROM yn_site_mem WHERE is_vendor='1' ")->result_array();
                                    if (count($getdeveloper) > 0) {
                                        foreach ($getdeveloper as $developer) {
                                            $mid = $developer['mid'];
                                            $getPropertiess = $this->db->query("SELECT * FROM x_home_property WHERE prop_status='1' AND prop_vendor='$mid' ")->result_array();

                                    ?>
                                            <div class="col-md-4 mb-4 p-3">
                                                <a href="<?= base_url('developer') ?>/<?= $developer['mid'] ?>/<?= url_smart($developer['name']) ?>" style="text-decoration:none;">
                                                    <div class="col-md-12 bg-white d-flex row " style="padding: 25px; border: 1px solid #bdbbbb;border-radius: 10px;align-items: center;">
                                                        <div class="col-md-5">
                                                            <img alt="<?= $developer['name'] ?>" src="<?= base_url('assets') ?>/mem/<?= @$developer['mid'] ?>/img/<?= @$developer['photo'] ?>" style="width:80px !important;height:80px;object-fit:cover;border-radius:50% ;" class="w-100">
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:10px;">
                                                            <p style="font-size: 20px; text-transform: capitalize; color: #161616;"><?= $developer['name'] ?></p>
                                                            <p class="text-muted"> <?= count($getPropertiess) ?> Total Projects</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                    } else { ?>
                                        <!-- Feed Item -->
                                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
                                            <p class="text-dark m-0">No Developer found</p>
                                        </div>
                                    <?php }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>



        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filtersModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 p-4 border-0 bg-light">
            <div class="modal-header d-flex align-items-center justify-content-start border-0 p-0 mb-3">
                <a href="#" class="text-muted text-decoration-none material-icons noload backBtn" data-bs-dismiss="modal">arrow_back_ios_new</a>
                <h5 class="modal-title text-muted ms-3 ln-0" id="staticBackdropLabel">Apply Filters</h5>
            </div>
            <?php
            // Getting filter values from URL
            $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
            $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 500000;
            $selected_bedrooms = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '';
            $selected_bathrooms = isset($_GET['bathrooms']) ? $_GET['bathrooms'] : '';
            $selected_categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
            ?>

            <form method="get" id="property-filter-form" action="<?= base_url('properties') ?>">
                <div class="modal-body p-0 mb-3">

                    <!-- Price Range Sliders -->
                    <div class="mb-4">
                        <label class="form-label h6 text-muted">Price Range</label>
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <label for="minPrice" class="form-label">Minimum Price: <span id="minPriceLabel"><?= $min_price ?></span></label>
                                <input type="range" class="form-range" min="0" max="500000" step="1000" name="min_price" id="minPrice" value="<?= $min_price ?>">
                            </div>
                            <div>
                                <label for="maxPrice" class="form-label">Maximum Price: <span id="maxPriceLabel"><?= $max_price ?></span></label>
                                <input type="range" class="form-range" min="0" max="500000" step="1000" name="max_price" id="maxPrice" value="<?= $max_price ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Categories as Pill-shaped Checkboxes -->
                    <div class="mb-4">
                        <label class="form-label h6 text-muted">Categories</label>
                        <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
                            <?php
                            $categories = $this->db->query("SELECT * FROM yn_site_catagory WHERE display = '1' ORDER BY sid ASC")->result_array();
                            foreach ($categories as $category) {
                                $isChecked = in_array($category['ctid'], $selected_categories) ? 'checked' : '';
                            ?>
                                <label class="btn btn-outline-primary rounded-pill">
                                    <input type="checkbox" name="categories[]" value="<?= $category['ctid'] ?>" <?= $isChecked ?>> <?= $category['name'] ?>
                                </label>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Bedrooms Dropdown -->
                    <div class="form-floating mb-3">
                        <select class="form-control rounded-5 border-0 shadow-sm" name="bedrooms" id="bedrooms">
                            <option value="">Select Number of Bedrooms</option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?= $i ?>" <?= $selected_bedrooms == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <label for="bedrooms" class="h6 text-muted mb-0">Number of Bedrooms</label>
                    </div>

                    <!-- Bathrooms Dropdown -->
                    <div class="form-floating mb-3">
                        <select class="form-control rounded-5 border-0 shadow-sm" name="bathrooms" id="bathrooms">
                            <option value="">Select Number of Bathrooms</option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?= $i ?>" <?= $selected_bathrooms == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <label for="bathrooms" class="h6 text-muted mb-0">Number of Bathrooms</label>
                    </div>
                </div>

                <div class="modal-footer justify-content-between px-1 py-1 bg-white shadow-sm rounded-5">
                    <button type="submit" class="btn btn-primary rounded-5 fw-bold px-3 py-2 fs-6 mb-0">Apply Filters</button>
                    <button type="button" class="btn btn-secondary rounded-5 fw-bold px-3 py-2 fs-6 mb-0" data-bs-dismiss="modal">Close</button>
                </div>
            </form>


        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".enquire-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
            let propertyId = this.getAttribute("data-id");
            let propertyName = this.getAttribute("data-name");

            // Fill hidden input
            document.getElementById("propertyId").value = propertyId;

            // Update select dropdown
            let select = document.getElementById("propertySelect");
            select.innerHTML = `<option value="${propertyName}" selected>${propertyName}</option>`;
        });
    });
});
</script>

<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content p-4 rounded-4">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inquiryModalLabel">Inquiry Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <form class="form-floating-space" action="<?= base_url('index.php/action/contact') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return uploadandform('<?= base_url('index.php/action/contact') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
                                        <!-- Name input-->
                                        <div class=" form-floating mb-3">
                                            <input class="form-control rounded-5" id="name" type="text" name="name" placeholder="Enter your name..." value="<?= @$_SESSION['name'] ?>" data-sb-validations="required">
                                            <label for="name">Full name</label>
                                        </div>
                                        <!-- Email address input-->
                                        <div class="form-floating mb-3 position-relative">
                                            <input class="form-control rounded-5" id="useremail" type="email" name="email" placeholder="name@example.com" value="<?= @$_SESSION['email'] ?>" required>
                                            <label for="useremail">Email address</label>
                                        </div>
                                        <!-- Phone number input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control rounded-5" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" value="<?= @$_SESSION['phone'] ?>" data-sb-validations="required">
                                            <label for="phone">Phone number</label>
                                        </div>


                                        <div class="form-floating mb-3">
                                            <select name="property" id="propertySelect" class="form-control rounded-5">
                                                <option value="">Select Property</option>
                                            </select>

                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-5" name="budget" placeholder="Enter your budget" required>
                                            <label for="budget">Budget</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-5" name="preferences" placeholder="Enter your preferences" required>
                                            <label for="preferences">Preferences</label>
                                        </div>

                                        <!-- Multiple Document Upload Field -->
                                        <div class="mb-3">
                                            <label for="documents" class="form-label">Upload Documents</label>
                                            <input type="file" class="form-control" name="documents[]" id="documents" multiple>
                                        </div>

                                        <input type="hidden" name="property_id" id="propertyId">



                                        <!-- Subject input-->
                                        <div class="form-floating mb-3">
                                            <input class="form-control rounded-5" id="subject" type="text" name="subject" placeholder="Subject" data-sb-validations="required">
                                            <label for="subject">Subject</label>
                                        </div>
                                        <!-- Message input-->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control rounded-5" id="message" name="mess" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                        <!-- Captcha-->
                                        <div class="col-sm-12">
                                            <?php echo get_captcha('caprght_oplkion', 'sign9_form_90_feed'); ?>
                                        </div>
                                        <!-- Submit Button-->
                                        <div class="d-grid"><button class="btn btn-primary w-100 rounded-5 text-decoration-none py-3 fw-bold text-uppercase m-0" id="submitButton" type="submit">Submit</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
