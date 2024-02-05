@extends('layouts.admin')
@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Products for {{$section_details->section_name}}</h1>
                </div>
            </div>
            <div class="filter_area add-section-product-filter-area">
                <div class="product_filter">
                    <label class="label">Categories :</label>
                    @foreach($categories as $category)
                    <input type="checkbox" class="product_cat" name="product_cat" id="{{$category->name}}" value="{{$category->id}}">
                    <label class="product-filter-label" for="{{$category->name}}">{{$category->name}}</label>
                    @endforeach
                </div>
                <div class="product_filter">
                    <label class="label">Themes :</label>
                    @foreach($all_themes as $theme)
                    <input type="checkbox" class="product_theme" name="product_theme" id="{{$theme->theme_name}}" value="{{$theme->id}}">
                    <label class="product-filter-label" for="{{$theme->theme_name}}">{{$theme->theme_name}}</label>
                    @endforeach
                </div>
                <div class="product_filter">
                    <label class="label">Fitting type :</label>
                    @foreach($types as $type)
                    <input type="radio" id="{{$type->type_name}}" class="fitting_type" name="fitting_type" value="{{$type->id}}">
                    <label class="product-filter-label" for="{{$type->type_name}}">{{$type->type_name}}</label>
                    @endforeach
                </div>
                @foreach($options as $option)
                <div class="product_filter">
                    <label class="label">{{$option->option_name}} :</label>
                    @foreach($option->option_values as $option_value)
                    <input type="checkbox" class="option_value" name="option_value" id="{{$option_value->id}}" value="{{$option_value->id}}">
                    <label class="product-filter-label" for="{{$option_value->option_value}}">{{$option_value->option_value}}</label>
                    @endforeach
                </div>
                @endforeach
                <div class="product_filter">
                    <label class="label">Gender :</label>
                    @foreach($genders as $gender)
                    <input type="radio" id="{{$gender->gender}}" class="product_gender" name="product_gender" value="{{$gender->id}}">
                    <label class="product-filter-label" for="{{$gender->gender}}">{{$gender->gender}}</label>
                    @endforeach
                </div>
            </div>
            @include('pages.admin.section-product-list-child') 
            <input type="hidden" name="section_id" class="section_id" value="{{$section_details->id}}">
        </div>
    </div>
</div>

@stop
@push('scripts')
<script type="text/javascript">
$(document).on("change",".add_product_section_btn",function(e) {
    e.preventDefault();
    if($(this).is(':checked')){
        var is_checked = 'yes';
    }else{
        var is_checked = 'no';
    }
    var section_id = $('.section_id').val();
    var product_id = $(this).attr('value');
    addSectionProduct({is_checked:is_checked, section_id:section_id, product_id:product_id}).then(res=>{
        console.log(res);
    });
});

const addSectionProduct = (options) => {
    var requestOptions = {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        body : JSON.stringify(options),
    };
    return fetch("{{ route('add_homepage_section_product') }}", requestOptions)
    .then(response => {
        return response.json()
    })
    .catch(error => {
        return error
    });
}

$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

$(document).on('click', '.apply_filter', function(){
    get_filtering_body(1);
});

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    if(page!=""){
        get_filtering_body(page);
    }
});

$(document).on('change', '.product_cat', function(e) {
    get_filtering_body(1);
});

$(document).on('change', '.fitting_type', function(e) {
    get_filtering_body(1);
});

$(document).on('change', '.option_value', function(e) {
    get_filtering_body(1);
});

$(document).on('change', '.product_gender', function(e) {
    get_filtering_body(1);
});

$(document).on('change', '.product_theme', function(e) {
    get_filtering_body(1);
});

function get_filtering_body(page){
    var product_cat_ids = [];
    var option_value_ids = [];
    var product_theme_ids = [];
    var product_gender_id = $('input[name="product_gender"]:checked').val();
    var fitting_type_id = $('input[name="fitting_type"]:checked').val();
    var section_id = $('.section_id').val();

    $("input:checkbox[name=product_cat]:checked").each(function(){
        product_cat_ids.push($(this).val());
    });

    $("input:checkbox[name=option_value]:checked").each(function(){
        option_value_ids.push($(this).val());
    });

    $("input:checkbox[name=product_theme]:checked").each(function(){
        product_theme_ids.push($(this).val());
    });

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('filtering_section_product') }}",
        method: 'POST',
        data: {_token: _token, page:page, product_cat_ids:product_cat_ids, option_value_ids:option_value_ids, fitting_type_id:fitting_type_id, product_theme_ids:product_theme_ids, product_gender_id:product_gender_id, section_id:section_id},
        success: function (data) { 
            $('.list-group').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }
    }); 

}

</script>
@endpush