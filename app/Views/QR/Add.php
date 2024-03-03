<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>


    <div>
        <!--    add operator -->
        <div class="mb-4 d-flex justify-content-end">
            <a href="/qr" class="btn btn-primary " role="button">
                <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah QR Data</h6>
            </div>
            <div class="card-body">
                <!--            flash data if error -->
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <!--  add operator-->
                <form action="/qr/add" method="post">

                    <!--                    code, data, type-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="code">Code</label>
                        <div class="input-group col-sm-10 px-0">
                            <input type="text" class="form-control " id="code" name="code"
                                   placeholder="Code"
                                   required>
                            <div class="input-group-append " style="cursor: pointer">
                                <button class="input-group-text btn btn-outline-primary" type="button"
                                        id="generate-code">Generate
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="type">Type</label>
                        <!--                       select [mesin, seal]-->
                        <select class="form-control col-sm-10" id="type" disabled name="type">
                            <option value="mesin" selected="selected">Mesin</option>
                            <option value="seal">Seal</option>
                        </select>

                    </div>


                    <hr/>

                    <div class="text title mb-3">Data QR</div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="job">Job</label>
                        <input type="text"
                               class="form-control col-sm-10"
                               id="job" name="job"
                               value="Curring"
                               disabled
                               placeholder="Job">
                    </div>

                    <!--                    no job desk-->
                    <div class="form-group row">
                        <label for="noJobDesk" class="col-form-label col-sm-2 text-dark">
                            No Job Desk
                        </label>
                        <input type="text" class="form-control col-sm-10" id="noJobDesk" name="noJobDesk"
                               placeholder="No Job Desk"/>
                    </div>

                    <!--                    item-->
                    <div class="form-group row">
                        <label for="item" class="col-form-label col-sm-2 text-dark">
                            Item
                        </label>
                        <input type="text" class="form-control col-sm-10" id="noJobDesk" name="item"
                               placeholder="Item"/>
                    </div>

                    <!--                    cav-->
                    <div class="form-group row">
                        <label for="cav" class="col-form-label col-sm-2 text-dark">
                            CAV
                        </label>
                        <input type="number" class="form-control col-sm-10" id="noJobDesk" name="cav"
                        />
                    </div>

                    <!--                    target cycle-->
                    <div class="form-group row">
                        <label for="targetCycle" class="col-form-label col-sm-2 text-dark">
                            Target Cycle
                        </label>
                        <input type="number" class="form-control col-sm-10" id="targetCycle" name="targetCycle"
                        />
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>


    <script>

        function generateRandomCode() {
            // generate random code using combination alphabet and number
            // ex: A123456
            let code = '';
            for (let i = 0; i < 10; i++) {
                let randomChar = Math.floor(Math.random() * 26);
                let charCode = String.fromCharCode(randomChar + 65);
                code += charCode;
            }
            return code;
        }

        window.onload = function () {
            console.log("asd")
            $("#generate-code").click(function () {
                let code = generateRandomCode();
                $("#code").val("QR-" + code);
            })
        }
    </script>


<?= $this->endSection() ?>