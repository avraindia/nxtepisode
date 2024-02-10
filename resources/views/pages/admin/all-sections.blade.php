@extends('layouts.admin')
@section('content')

<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('add_homepage_section') }}" class="primary-btn"><i class="bx bxs-plus-circle"></i> Add Section </a>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Border End Topbar ================== -->

<div class="body">
    <div class="card">
        <div class="card-body">
            @if (\Session::has('errmsg'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('errmsg') !!}</li>
                    </ul>
                </div>
            @endif

            @if (\Session::has('successmsg'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('successmsg') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> All Sections</h1>
                </div>
            </div>
            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                <table class="display coustom-table nowrap w-100 Queries">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Order</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                        <tr class="table-body-tr">
                            <td>
                                <span class="pr-title">
                                    {{$section->section_name}}
                                </span>
                            </td>
                            <td>
                                <span class="pr-title">
                                    {{$section->section_type}}
                                </span>
                            </td>
                            <td>
                                <span class="pr-title">
                                    {{$section->section_order}}
                                </span>
                            </td>
                            <td class="">
                                <div class="btn-group dropstart">
                                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu svg-icon">
                                        <li> <a href="{{route('edit_homepage_section', $section->id)}}">Edit  </a> </li>
                                        <?php 
                                        if($section->section_type == 'collection'){
                                        ?>
                                        <li> <a href="{{route('collection_list', $section->id)}}">Collection Item </a> </li>
                                        <?php
                                        }
                                        if($section->section_type == 'product'){
                                        ?>
                                        <li> <a href="{{route('add_section_product', $section->id)}}">Add Product  </a> </li>
                                        <?php
                                        }
                                        ?>
                                        <li> <a onclick="return confirm('Are you sure to delete?')" href="">Delete</a> </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
</script>
@endpush