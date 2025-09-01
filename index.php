<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGISTIC 2 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="index-styles.css" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="sidebar-toggle">
            <i class="bi bi-list"></i>
        </div>
        <h1 style="font-family: 'Great Vibes', cursive !important; font-size: 1.5rem; font-weight: 350; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            RAEVOR</h1>
    </header>
    


   <!-- Side Navigation -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Clothing And Fashionwear E-commerce</h3>
        </div>
        <ul class="sidebar-nav">
            

            <!-- Logistic 2 -->
            <li class="sidebar-item has-submenu">
                <a href="#">
                    <i class="bi bi-truck"></i>
                    <span class="menu-text">Logistic 2</span>
                    <i class="bi bi-chevron-down submenu-icon"></i>
                </a>
                <ul class="submenu">
                    <li><a href="vendor_portal.php"><span class="menu-text">Vendor Portal</span></a></li>
                    <li><a href="audit.php"><span class="menu-text">Audit Management</span></a></li>
                    <li><a href="vehicle.php"><span class="menu-text">Vehicle Reservation </span></a></li>
                    <li><a href="fleet.php"><span class="menu-text">Fleet Management</span></a></li>
                    <li><a href="document.php"><span class="menu-text">Document Tracking System</span></a></li>
                </ul>
            </li>

            
        </ul>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <p>Please select a management module from the sidebar menu.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // Toggle sidebar collapse
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
        
        // Toggle submenu visibility
        const menuItems = document.querySelectorAll('.sidebar-item.has-submenu');
        
        menuItems.forEach(item => {
            item.querySelector('a').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Add data-title attribute for tooltip when collapsed
                if (!this.hasAttribute('data-title')) {
                    const menuText = this.querySelector('.menu-text').textContent;
                    this.setAttribute('data-title', menuText);
                }
                
                // If sidebar is collapsed, don't toggle the active class
                if (!document.body.classList.contains('sidebar-collapsed')) {
                    item.classList.toggle('active');
                    
                    // Close other open menus
                    menuItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                        }
                    });
                }
            });
        });
        
        // Add hover functionality for collapsed state
        if (window.innerWidth > 768) {
            menuItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    if (document.body.classList.contains('sidebar-collapsed')) {
                        const menuText = this.querySelector('.menu-text').textContent;
                        this.querySelector('a').setAttribute('data-title', menuText);
                    }
                });
            });
        }
        
        // Intercept submenu link clicks and render content
        const submenuLinks = document.querySelectorAll('.submenu li a');
        const mainContentContainer = document.querySelector('.main-content .container-fluid');
        
        submenuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Mark active submenu link
                submenuLinks.forEach(other => other.classList.remove('active'));
                this.classList.add('active');
                
                const titleText = this.querySelector('.menu-text') ? this.querySelector('.menu-text').textContent.trim() : this.textContent.trim();
                const hrefValue = this.getAttribute('href') || '';
                const isVehicleReservation = hrefValue.toLowerCase().includes('vehicle.php') || titleText.toLowerCase().includes('vehicle reservation');
                
                if (!mainContentContainer) return;

                if (isVehicleReservation) {
                    // Render Vehicle Reservation UI
                    mainContentContainer.innerHTML = `
                        <div class="content-box vehicle-reservation">
                            <div class="content-title">Vehicle Reservation</div>
                            <div class="vr-grid">
                                <div class="vr-col">
                                    <div class="vr-card">
                                        <div class="vr-card-title">Vehicle Request</div>
                                        <form id="vehicleRequestForm" class="vr-form">
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Requester Name</label>
                                                    <input type="text" class="form-control" name="requesterName" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Department</label>
                                                    <input type="text" class="form-control" name="department" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Vehicle Type</label>
                                                    <select class="form-select" name="vehicleType" required>
                                                        <option value="">Select...</option>
                                                        <option>Light Truck</option>
                                                        <option>Heavy Truck</option>
                                                        <option>Van</option>
                                                        <option>Motorcycle</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Passengers</label>
                                                    <input type="number" class="form-control" name="passengers" min="0" value="0">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Cargo Weight (kg)</label>
                                                    <input type="number" class="form-control" name="cargoWeight" min="0" value="0">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Purpose</label>
                                                    <textarea class="form-control" rows="2" name="purpose"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Pickup Location</label>
                                                    <input type="text" class="form-control" name="pickupLocation" required>
                                                    <div class="d-grid mt-2">
                                                        <button type="button" id="pinPickupBtn" class="btn btn-outline-secondary btn-sm">Pin Pickup on Map</button>
                                                    </div>
                                                    <input type="hidden" name="pickupLat" id="pickupLat">
                                                    <input type="hidden" name="pickupLng" id="pickupLng">
                                                    <div class="coord-display" id="pickupCoordsDisplay">No pin set</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Dropoff Location</label>
                                                    <input type="text" class="form-control" name="dropoffLocation" required>
                                                    <div class="d-grid mt-2">
                                                        <button type="button" id="pinDropoffBtn" class="btn btn-outline-secondary btn-sm">Pin Dropoff on Map</button>
                                                    </div>
                                                    <input type="hidden" name="dropoffLat" id="dropoffLat">
                                                    <input type="hidden" name="dropoffLng" id="dropoffLng">
                                                    <div class="coord-display" id="dropoffCoordsDisplay">No pin set</div>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 mt-3">
                                                <button type="submit" class="btn btn-dark">Submit Request</button>
                                                <button type="button" id="vrCheckAvailabilityBtn" class="btn btn-outline-secondary">Check Availability</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="vr-card">
                                        <div class="vr-card-title">Pickup Scheduling</div>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Pickup Date</label>
                                                <input type="date" class="form-control" name="pickupDate">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Pickup Time</label>
                                                <input type="time" class="form-control" name="pickupTime">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Return Date</label>
                                                <input type="date" class="form-control" name="returnDate">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Return Time</label>
                                                <input type="time" class="form-control" name="returnTime">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vr-col">
                                    <div class="vr-card">
                                        <div class="vr-card-title">Availability</div>
                                        <div id="vrCalendar" class="vr-calendar">
                                            <div class="vr-calendar-header">
                                                <button class="btn btn-sm btn-outline-secondary" id="vrPrevMonth" type="button"><i class="bi bi-chevron-left"></i></button>
                                                <div id="vrMonthLabel" class="vr-month-label"></div>
                                                <button class="btn btn-sm btn-outline-secondary" id="vrNextMonth" type="button"><i class="bi bi-chevron-right"></i></button>
                                            </div>
                                            <div class="vr-weekdays">
                                                <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                                            </div>
                                            <div class="vr-calendar-grid" id="vrCalendarGrid"></div>
                                            <div class="small text-muted mt-2">Select dates to request. Unavailable dates are disabled.</div>
                                        </div>
                                    </div>
                                    <div class="vr-card">
                                        <div class="vr-card-title">Live Tracking</div>
                                        <div class="vr-map-placeholder" id="vrMapPlaceholder"></div>
                                        <div class="vr-tracking-status" id="vrTrackingStatus">
                                            <div class="step current">Dispatched</div>
                                            <div class="step">En Route</div>
                                            <div class="step">Near Destination</div>
                                            <div class="step">Delivered</div>
                                        </div>
                                        <button id="vrSimulateTracking" class="btn btn-outline-dark btn-sm mt-2" type="button">Simulate Truck Movement</button>
                                    </div>
                                </div>
                            </div>
                            <!-- DB: On form submit, insert into reservations(requester_name, department, vehicle_type, passengers, cargo_weight, pickup_location, dropoff_location, pickup_datetime, return_datetime, status) -->
                            <!-- API: For availability, query GET /api/vehicles/availability?from=YYYY-MM-DD&to=YYYY-MM-DD and disable unavailable dates. -->
                            <!-- Realtime: Subscribe to WS /tracking/{reservationId} to update status and map marker. -->
                            
                            <!-- Pickup Pin Modal -->
                            <div class="modal fade" id="pickupMapModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pin Pickup Location</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="pickupMap" class="modal-map"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Dropoff Pin Modal -->
                            <div class="modal fade" id="dropoffMapModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pin Dropoff Location</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="dropoffMap" class="modal-map"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    initializeVehicleReservationUI();
                } else {
                    // Render blank rounded box with title placeholder for other modules
                    mainContentContainer.innerHTML = `
                        <div class="content-box">
                            <div class="content-title">${titleText}</div>
                            <div class="content-body"></div>
                        </div>
                    `;
                }
            });
        });

        // Vehicle Reservation: UI initialization and behavior
        function initializeVehicleReservationUI() {
            const formElement = document.getElementById('vehicleRequestForm');
            const checkAvailabilityButton = document.getElementById('vrCheckAvailabilityBtn');
            const pickupDateInput = document.querySelector('input[name="pickupDate"]');
            const returnDateInput = document.querySelector('input[name="returnDate"]');
            const simulateTrackingButton = document.getElementById('vrSimulateTracking');
            
            // Map pinning elements
            const pinPickupBtn = document.getElementById('pinPickupBtn');
            const pinDropoffBtn = document.getElementById('pinDropoffBtn');
            const pickupLatInput = document.getElementById('pickupLat');
            const pickupLngInput = document.getElementById('pickupLng');
            const dropoffLatInput = document.getElementById('dropoffLat');
            const dropoffLngInput = document.getElementById('dropoffLng');
            const pickupCoordsDisplay = document.getElementById('pickupCoordsDisplay');
            const dropoffCoordsDisplay = document.getElementById('dropoffCoordsDisplay');
            
            const pickupModalEl = document.getElementById('pickupMapModal');
            const dropoffModalEl = document.getElementById('dropoffMapModal');
            const pickupModal = new bootstrap.Modal(pickupModalEl);
            const dropoffModal = new bootstrap.Modal(dropoffModalEl);
            
            let pickupMap = null;
            let pickupMarker = null;
            let dropoffMap = null;
            let dropoffMarker = null;
            
            const defaultCenter = [0, 0];
            const defaultZoom = 2;
            
            pinPickupBtn.addEventListener('click', function() { pickupModal.show(); });
            pinDropoffBtn.addEventListener('click', function() { dropoffModal.show(); });
            
            pickupModalEl.addEventListener('shown.bs.modal', function() {
                if (!pickupMap) {
                    pickupMap = L.map('pickupMap').setView(defaultCenter, defaultZoom);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(pickupMap);
                    pickupMap.on('click', function(e) {
                        const { lat, lng } = e.latlng;
                        if (!pickupMarker) {
                            pickupMarker = L.marker([lat, lng], { draggable: true }).addTo(pickupMap);
                            pickupMarker.on('dragend', function(evt) {
                                const pos = evt.target.getLatLng();
                                setPickupCoords(pos.lat, pos.lng);
                            });
                        } else {
                            pickupMarker.setLatLng([lat, lng]);
                        }
                        setPickupCoords(lat, lng);
                        pickupModal.hide();
                    });
                    // Try geolocation for convenience
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(pos) {
                            pickupMap.setView([pos.coords.latitude, pos.coords.longitude], 12);
                        });
                    }
                }
                setTimeout(function() { pickupMap.invalidateSize(); }, 50);
            });
            
            dropoffModalEl.addEventListener('shown.bs.modal', function() {
                if (!dropoffMap) {
                    dropoffMap = L.map('dropoffMap').setView(defaultCenter, defaultZoom);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(dropoffMap);
                    dropoffMap.on('click', function(e) {
                        const { lat, lng } = e.latlng;
                        if (!dropoffMarker) {
                            dropoffMarker = L.marker([lat, lng], { draggable: true }).addTo(dropoffMap);
                            dropoffMarker.on('dragend', function(evt) {
                                const pos = evt.target.getLatLng();
                                setDropoffCoords(pos.lat, pos.lng);
                            });
                        } else {
                            dropoffMarker.setLatLng([lat, lng]);
                        }
                        setDropoffCoords(lat, lng);
                        dropoffModal.hide();
                    });
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(pos) {
                            dropoffMap.setView([pos.coords.latitude, pos.coords.longitude], 12);
                        });
                    }
                }
                setTimeout(function() { dropoffMap.invalidateSize(); }, 50);
            });
            
            function setPickupCoords(lat, lng) {
                if (pickupLatInput) pickupLatInput.value = lat.toFixed(6);
                if (pickupLngInput) pickupLngInput.value = lng.toFixed(6);
                if (pickupCoordsDisplay) pickupCoordsDisplay.textContent = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            }
            function setDropoffCoords(lat, lng) {
                if (dropoffLatInput) dropoffLatInput.value = lat.toFixed(6);
                if (dropoffLngInput) dropoffLngInput.value = lng.toFixed(6);
                if (dropoffCoordsDisplay) dropoffCoordsDisplay.textContent = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            }

            // Initialize calendar
            const calendarState = { monthOffset: 0, selectedDates: new Set() };
            renderCalendar(calendarState);
            document.getElementById('vrPrevMonth').addEventListener('click', () => { calendarState.monthOffset -= 1; renderCalendar(calendarState); });
            document.getElementById('vrNextMonth').addEventListener('click', () => { calendarState.monthOffset += 1; renderCalendar(calendarState); });

            // Form submit handler (mock)
            formElement.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(formElement);
                const payload = Object.fromEntries(formData.entries());

                // DB: POST payload to /api/reservations to create reservation record
                console.log('Would submit reservation payload to backend:', payload);
                alert('Request submitted (mock). Backend integration goes here.');
            });

            // Availability check (mock)
            checkAvailabilityButton.addEventListener('click', function() {
                // API: Fetch availability for selected date range
                if (!pickupDateInput.value) {
                    alert('Select a pickup date (via calendar or input).');
                    return;
                }
                alert('Availability checked (mock). Marked dates indicate availability.');
            });

            // Tracking simulation
            simulateTrackingButton.addEventListener('click', function() {
                const steps = Array.from(document.querySelectorAll('#vrTrackingStatus .step'));
                let currentIndex = steps.findIndex(s => s.classList.contains('current'));
                const advance = () => {
                    steps.forEach(s => s.classList.remove('current'));
                    currentIndex = Math.min(currentIndex + 1, steps.length - 1);
                    steps[currentIndex].classList.add('current');
                    if (currentIndex < steps.length - 1) {
                        setTimeout(advance, 1000);
                    }
                };
                advance();
                // Realtime: Replace with live GPS updates via WebSocket
            });

            function renderCalendar(state) {
                const today = new Date();
                const viewDate = new Date(today.getFullYear(), today.getMonth() + state.monthOffset, 1);
                const year = viewDate.getFullYear();
                const month = viewDate.getMonth();
                const monthLabel = document.getElementById('vrMonthLabel');
                const calendarGrid = document.getElementById('vrCalendarGrid');
                const firstDayOfWeek = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                monthLabel.textContent = viewDate.toLocaleString('default', { month: 'long', year: 'numeric' });
                calendarGrid.innerHTML = '';

                // Mock unavailable dates: weekends are unavailable in this demo
                const isUnavailable = (date) => {
                    const day = date.getDay();
                    return day === 0 || day === 6; // Sunday or Saturday
                };

                // Leading empty cells
                for (let i = 0; i < firstDayOfWeek; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'vr-day empty';
                    calendarGrid.appendChild(emptyCell);
                }

                for (let dayNumber = 1; dayNumber <= daysInMonth; dayNumber++) {
                    const cellDate = new Date(year, month, dayNumber);
                    const dayButton = document.createElement('button');
                    dayButton.type = 'button';
                    dayButton.className = 'vr-day';
                    dayButton.textContent = String(dayNumber);

                    if (isUnavailable(cellDate)) {
                        dayButton.classList.add('unavailable');
                        dayButton.disabled = true;
                    }

                    dayButton.addEventListener('click', function() {
                        // Toggle selected
                        const wasSelected = this.classList.contains('selected');
                        this.classList.toggle('selected');
                        const iso = cellDate.toISOString().slice(0,10);
                        if (wasSelected) {
                            state.selectedDates.delete(iso);
                        } else {
                            state.selectedDates.add(iso);
                        }
                        // Sync first selected date to pickupDate input
                        const firstSelected = Array.from(state.selectedDates).sort()[0] || '';
                        if (firstSelected && pickupDateInput) pickupDateInput.value = firstSelected;
                    });

                    calendarGrid.appendChild(dayButton);
                }
            }
        }
    </script>
</body>
</html>