<form method="get" name="price-filters">
    <span class="clear" id="clearPrice" >Clear price</span>
    <div class="price-btns">
        <button class="btn btn-black btn-sm" value="below 50$">below 50฿</button><br/>
        <button class="btn btn-black btn-sm disabled" value="50$-100$">from 50฿ to 100฿</button><br/>
        <button class="btn btn-black btn-sm" value="100$-300$">from 100฿ to 300฿</button><br/>
        <button class="btn btn-black btn-sm" value="300$-1000$">from 300฿ to 1000฿</button>
    </div>
    <div class="price-slider">
        <div id="price-range"></div>
        <div class="values group">
            <!--data-min-val represent minimal price and data-max-val maximum price respectively in pricing slider range; value="" - default values-->
            <input class="form-control" name="minVal" id="minVal" type="text" data-min-val="10" value="180">
            <span class="labels">฿ - </span>
            <input class="form-control" name="maxVal" id="maxVal" type="text" data-max-val="2500" value="1400">
            <span class="labels">฿</span>
        </div>
        <input class="btn btn-primary btn-sm" type="submit" value="Filter">
    </div>
</form>