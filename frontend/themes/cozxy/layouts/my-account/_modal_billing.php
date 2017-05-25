<?php
use kartik\select2\Select2;
?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="gridSystemModalLabel">+ Add New Billing Address</h4>
            </div>
            <!-- Cart -->
            <div class="row">
                <!-- Details -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="size24">&nbsp;</div>
                    <form method="post" action="" class="login-box">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" name="firstname" class="fullwidth" placeholder="FIRSTNAME" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" name="lastname" class="fullwidth" placeholder="LASTNAME" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Compnay (option)</label>
                            <input type="text" name="address" class="fullwidth" placeholder="COMPANY" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" class="fullwidth" placeholder="ADDRESS" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Province</label>
                                    <?= Select2::widget([
                                        'name' => 'province',
                                        'value' => '',
                                        'data' => ['Bangkok', 'Bangkok2', 'Bangkok3'],
                                        'options' => ['placeholder' => 'Select Province']
                                    ]) ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <?= Select2::widget([
                                        'name' => 'city',
                                        'value' => '',
                                        'data' => ['Bang Khen', 'Bang Khen2', 'Bang Khen3'],
                                        'options' => ['placeholder' => 'Select City']
                                    ]) ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Zipcode</label>
                                    <input type="text" name="zip" class="fullwidth" placeholder="ZIP CODE" required>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="size24">&nbsp;</div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px" data-dismiss="modal" aria-label="Close">CANCEL</a>
                &nbsp;
                <a href="#" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>
            </div>
        </div>
    </div>
</div>