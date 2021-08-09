<div class="panel-heading">
    <h5 class="text-center">Add Your Cart Base Coupon</h5>
</div>
<div class="form-group">
    <label class="col-md-6 control-label" for="coupon_code">Coupon code</label>
    <div class="col-md-6">
        <input type="text" placeholder="Coupon code" id="coupon_code" name="coupon_code" class="form-control"
               required>
    </div>
</div>
<div class="form-group">
    <label class="col-md-6 control-label">Minimum Shopping</label>
    <div class="col-md-6">
        <input type="number" min="0" step="0.01" placeholder="Minimum Shopping" name="min_buy"
               class="form-control"
               required>
    </div>
</div>
<div class="form-group">

    <label class="col-md-6 control-label d-flex">Discount</label>
    <div class="col-md-6">
        <input type="number" min="0" step="0.01" placeholder="Discount" name="discount" class="form-control"
               required>
    </div>
    <div class="col-md-3">
        <select class="form-control" name="discount_type">
            <option value="amount">Fixed</option>
            <option value="percent">%</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-6 control-label">Maximum Discount Amount</label>
    <div class="col-md-6">
        <input type="number" min="0" step="0.01" placeholder="Maximum Discount Amount" name="max_discount"
               class="form-control" required>
    </div>
</div>
<div class="form-group">
    <label class="col-md-6 control-label" for="start_date">Date</label>
    <div class="col-md-6">
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date">
                <span class="input-group-addon">To</span>
                <input type="text" class="form-control" name="end_date">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('.demo-select2').select2();
    });

</script>
