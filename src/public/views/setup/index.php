<?php
require __DIR__ . "/../template/LandingHeader.php"
?>
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card" id="logCard">
                    <?php
                    if (is_null($system)) {
                    ?>
                        <form class="theme-form login-form" hx-post="<?= $this->basePath ?>nextSetup" hx-target="#logCard" hx-trigger="submit" hx-encoding="multipart/form-data">
                            <h4>First System Setup: Step 1</h4>
                            <h6>Please Fill in the Necessary Information for the System.</h6>
                            <input type="hidden" name="process" value="1">
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div id="drop-zone" class="border rounded d-flex align-items-center justify-content-center flex-column"
                                        style="width: 100%; height: 200px; border-style: dashed; cursor: pointer; position: relative;">
                                        <img id="logo-preview" src="" alt="Logo Preview" style="max-width: 100%; max-height: 100%; display: none; position: absolute; object-fit: contain;" />
                                        <span id="drop-message" class="text-muted text-center">Drag & Drop Logo Here<br>or Click to Upload</span>
                                        <input type="file" id="logoUpload" accept="image/*" name="logo" style="display: none;">
                                    </div>
                                </div>
                                <div class="text-center mt-2 fw-bold">Logo</div>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-layers"></i></span>
                                    <input class="form-control" type="text" required="" name="name" value="phpTemplate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Acronym</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-tag"></i></span>
                                    <input class="form-control" type="text" name="slug" required="" value="Temp">
                                    <!-- <div class="show-hide"><span class="show"></span></div> -->

                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Next <i class="icon-arrow-right"></i></button>
                            </div>
                        </form>
                    <?php
                    } else if (is_null($user)) {
                        require __DIR__ . "/../../../app/components/setup/next.php";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const dropZone = document.getElementById("drop-zone");
    const fileInput = document.getElementById("logoUpload");
    const logoPreview = document.getElementById("logo-preview");
    const dropMessage = document.getElementById("drop-message");

    // Click to open file dialog
    dropZone.addEventListener("click", () => fileInput.click());

    // File selected via file input
    fileInput.addEventListener("change", function() {
        if (this.files && this.files[0]) {
            showPreview(this.files[0]);
        }
    });

    // Drag and drop logic
    dropZone.addEventListener("dragover", function(e) {
        e.preventDefault();
        dropZone.classList.add("bg-light");
    });

    dropZone.addEventListener("dragleave", function() {
        dropZone.classList.remove("bg-light");
    });

    dropZone.addEventListener("drop", function(e) {
        e.preventDefault();
        dropZone.classList.remove("bg-light");
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith("image/")) {
            fileInput.files = e.dataTransfer.files;
            showPreview(file);
        }
    });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            logoPreview.src = e.target.result;
            logoPreview.style.display = "block";
            dropMessage.style.display = "none";
        };
        reader.readAsDataURL(file);
    }
</script>
<?php
require __DIR__ . "/../template/LandingFooter.php"
?>