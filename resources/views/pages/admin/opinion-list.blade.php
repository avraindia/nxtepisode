@extends('layouts.admin')
@section('content')

<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('add_opinion') }}" class="primary-btn"><i class="bx bxs-plus-circle"></i> Add Public Opinion </a>
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
                    <h1 class="card-title m-md-0 mb-3"> All Public Opinions</h1>
                </div>
            </div>
            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                <table class="display coustom-table nowrap w-100 Queries">
                    <thead>
                        <tr>
                            <th style="width: 650px;">Opinon</th>
                            <th>Order</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($opinions as $opinion)
                        <tr class="table-body-tr">
                            <td>
                                <span class="pr-title">
                                    {{$opinion->public_opinion}}
                                </span>
                            </td>
                            
                            <td>
                                <span class="pr-title">
                                    {{$opinion->opinion_order}}
                                </span>
                            </td>
                            <td class="">
                                <div class="btn-group dropstart">
                                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu svg-icon">
                                        <li> <a href="{{route('edit_opinion', $opinion->id)}}">Edit  </a> </li>
                                        <li> <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_opinion', $opinion->id)}}">Delete</a> </li>
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