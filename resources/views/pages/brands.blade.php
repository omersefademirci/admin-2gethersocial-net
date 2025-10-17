@extends('layout')

@section('afterTitle', true)
@section('title', __('custom.brands_title'))

@section('pages-styles')
<style>
@media only screen and (max-width: 992px) {
    .page-wrapper.horizontal-wrapper .page-body-wrapper .page-body{margin-top:84px;}
    .page-wrapper.horizontal-wrapper .page-body-wrapper .sidebar-wrapper{display: none;}
    body .page-wrapper .page-header .header-logo-wrapper { margin: -9px 0; }
}
</style>
@endsection
@section('content')
    <!-- page-wrapper Start-->
    <div class="page-wrapper horizontal-wrapper" id="pageWrapper"> {{-- page-wrapper compact-wrapper --}}
        @include('includes.topbar')

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            {{-- @include('includes.navbar') --}}

            @include('includes.navbar-basic')

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>{{ __('custom.brands_title') }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                            </svg></a></li>
                                    <li class="breadcrumb-item active">{{ __('custom.breadcrumb_brand_list') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('utm.creator') }}" class="btn btn-warning my-4 mx-3 d-block d-sm-none">{{ __('custom.utm_service_button') }}</a>

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row seller-wrapper">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header common-space">
                                    <div class="common-f-start">
                                        <div class="input-group common-searchbox"><span class="input-group-text"><i
                                                    class="search-icon text-gray" data-feather="search"></i></span>
                                            <input class="form-control" type="text" id="searchBrand"
                                                placeholder="{{ __('custom.search_brand_placeholder') }}">
                                        </div>
                                    </div>
                                    @if(Auth::user()->user_type != 'brand')
                                    <div class="right-vendor">
                                        <a class="btn btn-primary" href="seller-list.html#!" data-bs-toggle="modal"
                                            data-bs-target="#brand-pill-modal"><i class="me-2 fa fa-plus"></i>{{ __('custom.add_brand_button') }}</a>
                                        <a class="btn btn-primary" href="seller-list.html#!" data-bs-toggle="modal"
                                            data-bs-target="#datafile-pill-modal"><i class="me-2 fa fa-plus"></i>{{ __('custom.add_data_button') }}</a>
                                    </div>
                                    @endif
                                    <div class="modal fade" id="brand-pill-modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaldashboard">{{ __('custom.add_brand_modal_title') }}</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body basic-wizard important-validation">
                                                    <div id="brandFormContainer">
                                                        <form id="brandUploadForm"
                                                            class="stepper-two row g-3 needs-validation custom-input"
                                                            novalidate="" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-sm-6">
                                                                <label class="form-label" for="companyLogo">{{ __('custom.brand_logo_label') }}</label>
                                                                <input class="form-control" id="companyLogo"
                                                                    name="companyLogo" type="file" required="">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" for="companyName">{{ __('custom.brand_name_label') }}</label>
                                                                <input class="form-control" id="companyName"
                                                                    name="companyName" type="text" required=""
                                                                    placeholder="{{ __('custom.enter_brand_name_placeholder') }}">
                                                            </div>
                                                            <div class="wizard-footer d-flex gap-2 justify-content-end">
                                                                <button class="btn btn-primary"
                                                                    id="brandUploadButton">{{ __('custom.save_brand_button') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="brandUploadStatus" class="mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="datafile-pill-modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaldashboard">{{ __('custom.add_data_modal_title') }}</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body basic-wizard important-validation">
                                                    <div id="msform">
                                                        <form id="campaignUploadForm"
                                                            class="stepper-two row g-3 needs-validation custom-input"
                                                            novalidate="" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-sm-6 col-12">
                                                                <label class="form-label" for="brandSelect">{{ __('custom.select_brand_label') }}</label>
                                                                <select class="form-control" id="brandSelect"
                                                                    name="brandSelect">
                                                                    <option><!-- buraya markaları döndür veritabanından -->
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                                <label class="form-label" for="campaignFile">{{ __('custom.data_file_label') }}</label>
                                                                <input class="form-control" id="campaignFile"
                                                                    name="campaignFile" type="file" required="">
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">{{ __('custom.data_note_label') }}</label>
                                                                <textarea class="form-control" name="note"
                                                                    placeholder="{{ __('custom.data_note_placeholder') }}" required=""
                                                                    rows="3"></textarea>
                                                                <div class="invalid-feedback">{{ __('custom.invalid_feedback_note') }}</div>
                                                            </div>
                                                            <div class="wizard-footer d-flex gap-2 justify-content-end">
                                                                <button class="btn btn-primary" id="dataUploadButton">{{ __('custom.upload_data_button') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="dataUploadStatus" class="mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <ul class="seller-cards" id="brandList">
                                <!-- .. -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div> <!-- ./page-body-->

            @include('includes.footer')

        </div>
    </div>
@endsection


@section('pages-scripts')
    {{-- Page specific scripts --}}
    {{--
    Sayfaya özel scriptleri aşağıdaki örnekler gibi ekleyin
    Bir contact section'ı kullanılacaksa javascripti main.js'e tanımlanıp
    her yerden "çağrılmamalı". contact.js gibi ona özel bir custom script
    gerekir. Ayrıca varsa Nocaptcha gibi ek ihtiyaçlar da ilgili dosyadan
    önce bu alana eklenmeli.
    --}}

    <script>
        $(document).ready(function() {
            // CSRF tokenini AJAX isteklerine eklemek
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Marka ekleme işlemi
            $('#brandUploadButton').click(function(e) {
                e.preventDefault();

                var formData = new FormData($('#brandUploadForm')[0]);

                // Butonları gizle
                $('#brandUploadButton, #backbtn').hide();

                $('#brandUploadForm').hide(); // Formu gizle
                $('#brandUploadStatus').html('<p style="color:blue;">{{ __('custom.loading_message') }}</p>');

                $.ajax({
                    url: "{{ route('store_brand') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#brandUploadStatus').html(
                            '<p style="color:green;">{{ __('custom.upload_success_message') }}</p>'
                        );

                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    },
                    error: function(response) {
                        $('#brandUploadStatus').html(
                            '<p style="color:red;">{{ __('custom.upload_fail_message') }}</p>'
                            );
                        $('#brandUploadForm').show(); // Hata durumunda formu tekrar göster
                    }
                });
            });

            // Veri dosyası yükleme işlemi
            $('#dataUploadButton').click(function(e) {
                e.preventDefault();

                var formData = new FormData($('#campaignUploadForm')[0]);

                $('#campaignUploadForm').hide(); // Formu gizle
                $('#dataUploadStatus').html('<p style="color:blue;">{{ __('custom.loading_message') }}</p>');

                $.ajax({
                    url: "{{ route('import_campaigns') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#dataUploadStatus').html(
                            '<p style="color:green;">{{ __('custom.upload_success_message') }}</p>'
                        );

                        setTimeout(function(){
                            location.reload();
                        }, 500);
                    },
                    error: function(response) {
                        $('#dataUploadStatus').html(
                            '<p style="color:red;">{{ __('custom.upload_fail_message') }}</p>'
                            );
                        $('#campaignUploadForm').show(); // Hata durumunda formu tekrar göster
                    }
                });
            });

            // Markaları hem dropdown hem de sayfada listeler
            function updateBrandListAndDropdown() {
                $.ajax({
                    url: "{{ route('json_brands') }}",
                    type: 'GET',
                    success: function(data) {
                        $('#brandSelect').empty();
                        $('#brandSelect').append('<option value="">{{ __('custom.select_brand_label') }}</option>');
                        $('#brandList').empty();

                        $.each(data, function(key, value) {
                            // Dropdown listesine ekle
                            $('#brandSelect').append('<option value="' + value.id + '">' + value
                                .name + '</option>');

                            // Sayfa listesine ekle
                            $('#brandList').append(`
                        <li class="seller-box" data-name="${value.name}">
                            <div>
                                <img src="${value.logo}" class="brand-logo" width="100" style="max-height:100px; border-radius:50%; object-fit:contain;">
                                <div>
                                    <h5>${value.name}</h5><span class="f-light">{{ __('custom.brand') }}</span>
                                </div>
                            </div>
                            <ul class="seller-profits">
                                <li>
                                    <div class="common-space"><span>{{ __('custom.total_budget_label') }}</span><span>${value.total_planned}₺</span></div>
                                </li>
                                <li>
                                    <div class="common-space"><span>{{ __('custom.total_spent_label') }}</span><span>${value.total_spent}₺</span></div>
                                </li>
                                @if(Auth::user()->user_type != 'brand')
                                <li>
                                    <div class="common-space"><span>{{ __('custom.total_groups_label') }}</span><span>${value.total_groups}</span></div>
                                </li>
                                @endif
                            </ul>
                            <a class="btn btn-primary btn-hover-effect" href="/dashboard/${value.id}">{{ __('custom.view_brand_button') }}</a>
                            @if(Auth::user()->user_type != 'brand')
                            <button class="btn btn-danger delete-brand" data-id="${value.id}">{{ __('custom.delete_brand_button') }}</button>
                            @endif
                        </li>
                    `);
                        });

                        // Silme butonuna tıklama işlemi
                        $('.delete-brand').click(function() {
                            var brandId = $(this).data('id');
                            if (confirm('{{ __('custom.delete_brand_confirmation') }}')) {
                                deleteBrand(brandId);
                            }
                        });
                    }
                });
            }

            // Marka silme işlemi
            function deleteBrand(brandId) {
                $.ajax({
                    url: '/brands/' + brandId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('{{ __('custom.brand_deleted_success_message') }}');
                        updateBrandListAndDropdown();
                    },
                    error: function(response) {
                        alert('{{ __('custom.brand_deleted_fail_message') }}');
                    }
                });
            }

            // Sayfa yüklendiğinde markaları listeler
            updateBrandListAndDropdown();

            // Search alanını kullanarak listeyi filtreler
            $('#searchBrand').on('keyup', function() {
                var value = $(this).val().toLowerCase();

                $('#brandList .seller-box').filter(function() {
                    $(this).toggle($(this).data('name').toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
