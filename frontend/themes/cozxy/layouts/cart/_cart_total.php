<div class="col-xs-12 bg-black" style="padding:18px;">
    <div class="rela">
        <input type="text" name="coupon-code" id="coupon-code" style="border: 0px solid #999; padding: 8px; width: 60%;" class="fullwidth" placeholder="Promo code">
        <input type="button" value="APPLY" onclick="proceed('apply_coupon')" class="abs btn-yellow" style="padding: 7px 24px; right: 0; font-weight: 700">
    </div>
</div>
<div class="col-xs-12 total-price bg-white">
    <div class="row">
        <div class="price-detail">SUBTOTAL
            <div class="pull-right  totalFormatText"><?= number_format($this->params['cart']['total'], 2) ?> THB</div>
        </div>
        <div class="price-detail">SHIPPING
            <div class="pull-right"><?= (isset($this->params['cart']['shippingRate']) && $this->params['cart']['shippingRate'] == 0) ? "FREE" : number_format($this->params['cart']['shippingRate'], 2) ?></div>
        </div>
        <div class="price-detail">PROMO CODE
            <div class="pull-right promo-coupon-codes discountFormatText" style="color: #f65d35;vertical-align: top">- <?= isset($this->params['cart']['discount']) ? number_format($this->params['cart']['discount'], 2) : '' ?> THB</div>
            <div class="row">
                <div class="col-lg-6"><?= isset($this->params['cart']['couponCode']) ? "<span class='label label-primary'>" . $this->params['cart']['couponCode'] . "</span>" : "" ?></div>
                <div class="col-lg-6 pull-right">
                    <a class='text-danger'><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
        <div class="price-detail b size20 size18-sm size18-xs">TOTAL
            <div class="pull-right summaryFormatText"><?= isset($this->params ['cart']['summary']) ? number_format($this->params ['cart']['summary'], 2) : '' ?> THB</div>
        </div>
    </div>
</div>