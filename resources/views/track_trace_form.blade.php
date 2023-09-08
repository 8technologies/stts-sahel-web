
  
    <style>
        .details {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px;
        }
        /* Custom CSS for alignment */
.details-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px; /* Adjust as needed */
}

.details-col {
    flex: 1;
    margin-left: 80px; /* Adjust as needed */
}

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('admin.form.Track and Trace') }}</div>

                    <div class="panel-body">
                        <form id="myform" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" name="lot_number" id="lot_number" class="form-control"
                                    placeholder="Enter lot number">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" id="btnscan" type="button"
                                        onclick="startScan()">{{ __('admin.form.Scan QR Code') }}</button>
                                </div>
                            </div>
                            <div id="qr-reader" style="width: 100%; margin-top: 20px;"></div>
                            <p id="scan-error" style="color: red; display: none;">{{ __('admin.form.QR code scanning failed. Please
                                ensure the QR code is visible and try again.') }}</p>
                                <div class="button-container">
                                <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                    data-target="#trackModal" onclick="openModal('trackModal')">{{ __('admin.form.Track') }}</button>
                                <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                    data-target="#traceModal" onclick="openModal('traceModal')">{{ __('admin.form.Trace') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/dist/html5-qrcode.min.js"></script>
     
        <script>
            let html5QrCode;
            let qrCodeSuccessCallback;
            let selectedModal;

            function startScan() {
                html5QrCode = new Html5Qrcode("qr-reader");
                qrCodeSuccessCallback = (decodedText, decodedResult) => {
                    console.log(`Scan result: ${decodedText}`, decodedResult);
                    document.getElementById('lot_number').value = decodedText;
                    openModal(decodedText);
                    html5QrCode.stop();
                };

                const qrCodeErrorCallback = (error) => {
                    console.error(error);
                    document.getElementById('scan-error').style.display = 'block';
                };

                const config = {
                    fps: 10,
                    qrbox: 250
                };
                html5QrCode.start({
                    facingMode: "environment"
                }, config, qrCodeSuccessCallback, qrCodeErrorCallback);
            }

            function openModal(modal) {
        
                // Determine which modal to open based on the selected button
                if (modal === "traceModal") {
                 console.log('hi im tracking');
                    // Submit to track endpoint and load data into the modal
                  // Send the AJAX request
                    $.ajax({
                    url: "/trace", 
                    type: "POST",
                    data: new FormData($("#myform")[0]), 
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle the response from the backend
                        console.log(response);

                        // Access and use the returned data  
                        // document.getElementById("result-container").textContent = response.id;
                        document.getElementById("crop").textContent = response.crop;
                        document.getElementById("crop_variety").textContent = response.crop_variety;
                        document.getElementById("generation").textContent = response.generation;
                        document.getElementById("lab_test_number").textContent = response.lab_test_number;
                        document.getElementById("germination").textContent = response.germination;
                        document.getElementById("purity").textContent = response.purity;
                        document.getElementById("testing_methods").textContent = response.testing_methods;
                        document.getElementById("decision").textContent = response.test_decision;
                        document.getElementById("mother_lot").textContent = response.mother_lot;
                        document.getElementById("seed_lot_number").textContent = response.lot_number;
                      
                       
                        if (response.report_recommendation == 11) {
                            document.getElementById("status").textContent = "Marketable";
                        } else {
                            document.getElementById("status").textContent = "Not Marketable";
                        }
                        document.getElementById("test").textContent = response.tests_required;
                    },
                    error: function(error) {
                        // Handle the error
                        console.error(error);
                    }
                });


                } else if (modal === "trackModal") {
                console.log('hi im tracing');
                    // Submit to track endpoint and load data into the modal
                    lot_number = new FormData($("#myform")[0]);
                    $.ajax({
                        url: "/track", 
                        type: "POST",
                        data: lot_number, 
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Handle the response from the backend and populate the modal
                            console.log(response);
                            var lot_number = $("#lot_number").val(); 
                            var tableHTML = "<table>";
                        
                            tableHTML += "<tbody>";
                            
                            response.forEach(function(item) {
                                tableHTML += "<tr>";
                                tableHTML += "<td>"+ lot_number + "</td>";
                                tableHTML += "<td><a href='http://127.0.0.1:8000/admin/seed-lab-tests/" + item.id + "' onclick='closeModalAndRedirect(this)' data-dismiss='modal'>" + item.lot_number + "</a></td>";

                                tableHTML += "</tr>";
                            });
                            
                            tableHTML += "</tbody></table>";
                            
                            document.getElementById("trace_result-container").innerHTML = tableHTML;
                        },
                            
                        error: function(error) {
                            // Handle the error
                            console.error(error);
                        }
                    });
                }
            }
            function closeModalAndRedirect(link) {
                window.location.href = link.href; // Redirect to the link
            }

      
        </script>

    </div>

    <!-- Trace Modal -->
    <div class="modal fade" id="traceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <!-- Trace Modal content goes here -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.form.Batch details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">{{ __('admin.form.Seed Details')}}</a></li>
                        <li><a data-toggle="tab" href="#profile">{{ __('admin.form.Seed Lab Details')}}</a></li>
                        <li><a data-toggle="tab" href="#contact">{{ __('admin.form.Mother Lot Number')}}</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="details-row">
                            <div class="details-col">
                                <strong>{{ __('admin.form.Lot Number:')}}</strong>
                                <p class="text-muted" id="seed_lot_number"></p>
                            </div>
                            <div class="details-col">
                                <strong>{{ __('admin.form.Crop:')}}</strong>
                                <p class="text-muted" id="crop"></p>
                            </div>
                        </div>
                        <div class="details-row">
                            <div class="details-col">
                                <strong>{{ __('admin.form.Crop Variety:')}}</strong>
                                <p class="text-muted" id="crop_variety"></p>
                            </div>
                            <div class="details-col">
                                <strong>{{ __('admin.form.Seed Generation:')}}</strong>
                                <p class="text-muted" id="generation"></p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="profile">
                        <div class="card">
                            <div class="card-body">
                                <div class="details-row">
                                    <div class="details-col">
                                        <strong>{{ __('admin.form.Lab Test Number:')}}</strong>
                                        <p class="text-muted" id="lab_test_number"></p>
                                    </div>
                                    <div class="details-col">
                                        <strong>{{ __('admin.form.Germination Test Result:')}}</strong>
                                        <p class="text-muted" id="germination"></p>
                                    </div>
                                </div>
                                <div class="details-row">
                                    <div class="details-col">
                                        <strong>{{ __('admin.form.Purity Test Result:')}}</strong>
                                        <p class="text-muted" id="purity"></p>
                                    </div>
                                    <div class="details-col">
                                        <strong>{{ __('admin.form.Testing Method:')}}</strong>
                                        <p class="text-muted" id="testing_methods"></p>
                                    </div>
                                </div>
                                <div class="details-row">
                                    <div class="details-col">
                                        <strong>{{ __('admin.form.Test Decision:')}}</strong>
                                        <p class="text-muted" id="decision"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="tab-pane" id="contact">
                            <div class="card">
                                <div class="card-body">
                                    <div class="details">
                                        <strong>{{ __('admin.form.Mother Lot Number:')}}</strong>
                                        <p class="text-muted" id="mother_lot"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('admin.form.Close')}}</button>
                </div>
            </div>
        </div>
    </div>

<!-- Track Modal -->
<div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.form.Batch details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.form.Mother Lot Number')}}</th>
                            <th>{{ __('admin.form.Child Lot Number')}}</th>
                        </tr>
                    </thead>
                    <tbody id="trace_result-container">
                        <!-- Table rows will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.form.Close')}}</button>
            </div>
        </div>
    </div>
</div>





          