@extends('layouts.admin')
@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Type and select your product</label>
                                <input type="text" class="form-control search_key" placeholder="Ex: FIRST100" value="" name="search_key">
                                <input type="hidden" name="product_id" class="product_id" value="">
                                <div class="search-dropdown">
                                    <ul id="product_search_result"></ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 add-edit-stock-area" style="display:none;">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="form-group">
                                    <label class="label">Product Option</label>
                                        <select class="form-select select product_option" name="product_option" aria-label="Default select example" required>
                                            <option value="0" selected> Select Option</option>
                                            @foreach($options as $option)
                                            <option value="{{$option->id}}">{{$option->option_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="form-group">
                                    <label class="label">Option Value</label>
                                        <select class="form-select select option_value" name="option_value" aria-label="Default select example" required>
                                            <option value="0" selected> Select Value</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="form-group">
                                        <label class="label">Default Price</label>
                                        <label class="default_price"></label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="form-group">
                                        <label class="label">Price(Optional)</label>
                                        <input type="text" class="form-control inventory_price" placeholder="Ex: 100.00" value="" name="inventory_price" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 existing_stock_area" style="display:none;">
                                    <div class="form-group">
                                        <label class="label">Existing Stock</label>
                                        <label class="existing_stock"></label>
                                        <input type="hidden" name="existing_stock_value" class="existing_stock_value" value="0">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="form-group">
                                        <label class="label">New Stock</label>
                                        <input type="text" class="form-control inventory_stock" placeholder="Ex: 10,20" value="" name="inventory_stock" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="form-group">
                                        <label class="label"></label>
                                        <button class="btn-theme-blue me-3 save_inventory_value">Save</button>
                                        <input type="hidden" name="inventory_id" class="inventory_id" value="0">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label class="label"></label>
                                        <div class="alert stock_resp"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bottom">
    <div class="d-flex justify-content-end">
        <button class="btn-theme-blue me-3">Cancel</button>
    </div>
</div>    
@stop

@push('scripts')
<script type="text/javascript">
$('.search_key').keyup(delay(function (e) {
	$('.product_id').val("");
    $('.add-edit-stock-area').hide();
    $('.stock_resp').removeClass('alert-success').html('');
    var search_term = $(this).val();
    var search_term_len = search_term.length;
    if(search_term_len != '' & search_term_len > 1){
		$('#product_search_result').show();
        $('#product_search_result').html('');
        
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('search_inventory_product') }}",
            method: 'POST',
            data: {_token: _token, search_term:search_term},
            success: function (data) { 
                if(data.resp == true){
                    var product_data = data.data;
                    if(product_data.length > 0){
                        for(var i=0; i<product_data.length; i++){
                            var single_record = product_data[i];
                            var search_single_body = '<li product_id="'+single_record.id+'" mrp="'+single_record.product_mrp+'">'+single_record.product_title+'</li>';
                            $('#product_search_result').append(search_single_body);
                        }
                    }else{
                        $('#product_search_result').html('');
                    }
                }
            }
        }); 
    }else{
		$('#product_search_result').html('');
	}
}, 500));

$(document).on("click","#product_search_result li",function(e) {
    var product_id = $(this).attr('product_id');
    var mrp = $(this).attr('mrp');
    var product_title = $(this).text();
    $('.search_key').val(product_title);
    $('.product_id').val(product_id);
    $('.default_price').html(mrp);
    $('#product_search_result').html('');

    $(".product_option").val($(".product_option option:first").val());
    $('.option_value').html('<option value="0" selected> Select Value</option>');
    $(".inventory_price").val('');
    $(".inventory_stock").val('');
    $(".inventory_price").attr("readonly", true); 
    $(".inventory_stock").attr("readonly", true);

    $('.stock_resp').removeClass('alert-success').html('');

    $('.add-edit-stock-area').show();
});

$(document).on("change",".product_option",function(e) {
    $(".inventory_price").val('');
    $(".inventory_stock").val('');
    $(".inventory_price").attr("readonly", true); 
    $(".inventory_stock").attr("readonly", true); 
    $('.stock_resp').removeClass('alert-success').html('');
    var option_id = $(this).val();
    if(option_id != '0'){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('inventory_option_value') }}",
            method: 'POST',
            data: {_token: _token, option_id:option_id},
            success: function (data) { 
                if(data.resp == true){
                    var option_value = data.data;
                    if(option_value.length > 0){
                        var html = '<option value="0" selected> Select Value</option>';
                        for(var i=0; i<option_value.length; i++){
                            var single_record = option_value[i];
                            html += '<option value="'+single_record['id']+'"> '+single_record['option_value']+'</option>';
                        }
                        $('.option_value').html(html);
                    }else{
                        $('.option_value').html('<option value="0" selected> Select Value</option>');
                    }
                }
            }
        }); 
    }else{
        $('.option_value').html('<option value="0" selected> Select Value</option>');
    }
    
});

$(document).on("change",".option_value",function(e) {
    $('.stock_resp').removeClass('alert-success').html('');
    filling_form_value();
});

$(document).on("click",".save_inventory_value",function(e) {
    if(validate_form() == true){
        var option_id = $('.product_option').val();
        var option_value_id = $('.option_value').val();
        var product_id = $('.product_id').val();
        var inventory_price = $('.inventory_price').val();
        var inventory_stock = $('.inventory_stock').val();
        var inventory_id = $('.inventory_id').val();
        var existing_stock_value = $('.existing_stock_value').val();

        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('save_inventory_value') }}",
            method: 'POST',
            data: {_token: _token, option_id:option_id, option_value_id:option_value_id, product_id:product_id, inventory_price:inventory_price, inventory_stock:inventory_stock, inventory_id:inventory_id, existing_stock_value:existing_stock_value},
            success: function (data) { 
                if(data.resp == true){
                    $('.inventory_id').val(data.inventory_id);
                    $('.stock_resp').addClass('alert-success').html(data.msg);
                    filling_form_value();
                }
            }
        });
    }
});

function filling_form_value(){
    var option_id = $('.product_option').val();
    var option_value_id = $('.option_value').val();
    var product_id = $('.product_id').val();
    //$('.stock_resp').removeClass('alert-success').html('');
    //$('.option_value').css('border-color', '');

    if(option_id!='0' && option_value_id!='0' && product_id!=""){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('check_existing_stock') }}",
            method: 'POST',
            data: {_token: _token, option_id:option_id, option_value_id:option_value_id, product_id:product_id},
            success: function (data) { 
                if(data.resp == true){
                    $('.inventory_id').val(data.inventory_id);
                    $('.inventory_price').val(data.inventory_price);
                    $(".inventory_price").attr("readonly", false); 
                    $('.inventory_stock').val(0);
                    $(".inventory_stock").attr("readonly", false); 
                    
                    if(data.inventory_id == '0'){
                        $('.existing_stock_value').val(0);
                        $('.existing_stock').html('');
                        $(".existing_stock_area").hide(); 
                    }else{
                        $('.existing_stock_value').val(data.inventory_stock);
                        $('.existing_stock').html(data.inventory_stock);
                        $(".existing_stock_area").show(); 
                    }
                }
            }
        });
    }else{
        $(".inventory_price").val('');
        $(".inventory_stock").val('');
        $(".inventory_price").attr("readonly", true); 
        $(".inventory_stock").attr("readonly", true); 
        $('.existing_stock_value').val(0);
        $('.existing_stock').html('');
        $('.inventory_id').val(0);
        $(".existing_stock_area").hide(); 
    }
}

function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}

function validate_form(){
    var valid = true;
    var option_id = $('.product_option').val();
    var option_value_id = $('.option_value').val();

    if(option_id == '0'){
        $('.product_option').css('border-color', 'red');
        valid = false;
    }else{
        $('.product_option').css('border-color', '');
    }

    if(option_value_id == '0'){
        $('.option_value').css('border-color', 'red');
        valid = false;
    }else{
        $('.option_value').css('border-color', '');
    }

    return valid;
}
</script>
@endpush