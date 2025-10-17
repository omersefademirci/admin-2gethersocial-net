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
                                <h3>{{ __('custom.breadcrumb_report_list') }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                            </svg></a></li>
                                    <li class="breadcrumb-item active">{{ __('custom.breadcrumb_report_list') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <a href="{{ route('utm.creator') }}" class="btn btn-warning my-4 mx-3 d-block d-sm-none">{{ __('custom.utm_service_button') }}</a> --}}

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
                                        <a class="btn btn-primary" href="seller-list.html#!" data-bs-toggle="modal" data-bs-target="#brand-pill-modal"><i class="me-2 fa fa-plus"></i>{{ __('custom.add_brand_button') }}</a>
                                        <a class="btn btn-primary" href="seller-list.html#!" data-bs-toggle="modal" data-bs-target="#datafile-pill-modal"><i class="me-2 fa fa-plus"></i>{{ __('custom.add_data_button') }}</a>
                                        <a class="btn btn-primary" href="seller-list.html#!" data-bs-toggle="modal" data-bs-target="#brand-user-modal"><i class="me-2 fa fa-plus"></i>{{ __('custom.add_brand_user_button') }}</a>
                                        <a class="btn btn-primary" href="seller-list.html#!" data-bs-toggle="modal" data-bs-target="#brand-member-modal"><i class="me-2 fa fa-user-plus"></i>{{ __('custom.add_brand_members_button') }}</a>
                                        <a class="btn btn-outline-primary" href="seller-list.html#!" data-bs-toggle="modal" data-bs-target="#brand-members-list-modal"><i class="me-2 fa fa-users"></i>{{ __('custom.view_brand_members_button') }}</a>
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
                                                                    name="companyLogo" type="file" accept="image/png" required="">
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
                                    <div class="modal fade" id="brand-user-modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="brandUserModalLabel">{{ __('custom.add_brand_user_modal_title') }}</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body basic-wizard important-validation">
                                                    <form id="brandUserForm" class="row g-3 needs-validation custom-input" novalidate>
                                                        @csrf
                                                        <div class="col-12">
                                                            <label class="form-label" for="brandUserName">{{ __('custom.brand_user_form_name_label') }}</label>
                                                            <input class="form-control" id="brandUserName" name="name" type="text" required autocomplete="name">
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label" for="brandUserEmail">{{ __('custom.brand_user_form_email_label') }}</label>
                                                            <input class="form-control" id="brandUserEmail" name="email" type="email" required autocomplete="email">
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="brandUserPassword">{{ __('custom.brand_user_form_password_label') }}</label>
                                                            <input class="form-control" id="brandUserPassword" name="password" type="password" required autocomplete="new-password">
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label" for="brandUserPasswordConfirmation">{{ __('custom.brand_user_form_password_confirmation_label') }}</label>
                                                            <input class="form-control" id="brandUserPasswordConfirmation" name="password_confirmation" type="password" required autocomplete="new-password">
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label" for="brandUserRegistrationKey">{{ __('custom.brand_user_form_registration_key_label') }}</label>
                                                            <input class="form-control" id="brandUserRegistrationKey" name="registration_key" type="text" required autocomplete="off">
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="wizard-footer d-flex gap-2 justify-content-end">
                                                            <button class="btn btn-primary" id="brandUserSubmitButton" type="submit">{{ __('custom.brand_user_save_button') }}</button>
                                                        </div>
                                                    </form>
                                                    <div id="brandUserStatus" class="mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="brand-member-modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="brandMemberModalLabel">{{ __('custom.add_brand_members_modal_title') }}</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body basic-wizard important-validation">
                                                    <form id="brandMemberForm" class="row g-3 needs-validation custom-input" novalidate>
                                                        @csrf
                                                        <div class="col-12">
                                                            <label class="form-label" for="brandMemberBrandSelect">{{ __('custom.brand_member_form_brand_label') }}</label>
                                                            <select class="form-select" id="brandMemberBrandSelect" name="brand_id" required>
                                                                <option value="">{{ __('custom.select_brand_label') }}</option>
                                                            </select>
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label" for="brandMemberUserSelect">{{ __('custom.brand_member_form_users_label') }}</label>
                                                            <select class="form-select" id="brandMemberUserSelect" name="user_ids[]" multiple required size="6">
                                                            </select>
                                                            <small class="form-text text-muted">{{ __('custom.brand_member_form_users_help') }}</small>
                                                            <div class="invalid-feedback d-none"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">{{ __('custom.brand_member_assigned_title') }}</label>
                                                            <div id="brandMemberAssignments" class="list-group small"></div>
                                                        </div>
                                                        <div class="wizard-footer d-flex gap-2 justify-content-end">
                                                            <button class="btn btn-primary" id="brandMemberSubmitButton" type="submit">{{ __('custom.brand_member_save_button') }}</button>
                                                        </div>
                                                    </form>
                                                    <div id="brandMemberStatus" class="mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="brand-members-list-modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="brandMembersListModalLabel">{{ __('custom.brand_members_list_modal_title') }}</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="brandMembersListStatus" class="mb-3"></div>
                                                    <div id="brandMembersList" class="list-group"></div>
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
            const brandUserForm = $('#brandUserForm');
            if (brandUserForm.length) {
                const brandUserStatus = $('#brandUserStatus');
                const brandUserSubmitButton = $('#brandUserSubmitButton');
                const brandUserModalElement = document.getElementById('brand-user-modal');
                const brandUserMessages = {
                    success: @json(__('custom.brand_user_success_message')),
                    error: @json(__('custom.brand_user_fail_message')),
                    forbidden: @json(__('custom.brand_user_forbidden_message')),
                };

                function resetBrandUserFeedback() {
                    brandUserForm.find('.is-invalid').removeClass('is-invalid');
                    brandUserForm.find('.invalid-feedback').text('').addClass('d-none');
                }

                brandUserForm.on('submit', function(e) {
                    e.preventDefault();

                    resetBrandUserFeedback();
                    brandUserStatus.empty();
                    brandUserSubmitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('brand_users.store') }}",
                        type: 'POST',
                        data: brandUserForm.serialize(),
                        success: function(response) {
                            const message = response.message ? response.message : brandUserMessages.success;
                            brandUserStatus.html('<p class="text-success mb-0">' + message + '</p>');
                            brandUserForm[0].reset();

                            setTimeout(function() {
                                if (brandUserModalElement) {
                                    const modalInstance = bootstrap.Modal.getInstance(brandUserModalElement) || new bootstrap.Modal(brandUserModalElement);
                                    modalInstance.hide();
                                }
                            }, 1000);
                        },
                        error: function(xhr) {
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
                                Object.keys(errors).forEach(function(field) {
                                    const input = brandUserForm.find('[name="' + field + '"]');
                                    if (input.length) {
                                        input.addClass('is-invalid');
                                        const feedback = input.siblings('.invalid-feedback');
                                        if (feedback.length) {
                                            feedback.text(errors[field][0]).removeClass('d-none');
                                        }
                                    }
                                });
                            } else if (xhr.status === 403) {
                                brandUserStatus.html('<p class="text-danger mb-0">' + brandUserMessages.forbidden + '</p>');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                brandUserStatus.html('<p class="text-danger mb-0">' + xhr.responseJSON.message + '</p>');
                            } else {
                                brandUserStatus.html('<p class="text-danger mb-0">' + brandUserMessages.error + '</p>');
                            }
                        },
                        complete: function() {
                            brandUserSubmitButton.prop('disabled', false);
                        }
                    });
                });

                if (brandUserModalElement) {
                    brandUserModalElement.addEventListener('hidden.bs.modal', function () {
                        brandUserForm[0].reset();
                        brandUserStatus.empty();
                        resetBrandUserFeedback();
                        brandUserSubmitButton.prop('disabled', false);
                    });
                }
            }

            const brandMemberForm = $('#brandMemberForm');
            const brandMemberStatus = $('#brandMemberStatus');
            const brandMemberSubmitButton = $('#brandMemberSubmitButton');
            const brandMemberModalElement = document.getElementById('brand-member-modal');
            const brandMemberBrandSelect = $('#brandMemberBrandSelect');
            const brandMemberUserSelect = $('#brandMemberUserSelect');
            const brandMemberAssignments = $('#brandMemberAssignments');
            const brandMembersListModalElement = document.getElementById('brand-members-list-modal');
            const brandMembersList = $('#brandMembersList');
            const brandMembersListStatus = $('#brandMembersListStatus');
            const brandMembersBaseUrl = "{{ url('/brands') }}";
            const brandUsersBaseUrl = "{{ url('/brand-users') }}";
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const ajaxJsonHeaders = {
                'Accept': 'application/json',
            };

            const brandMemberMessages = {
                success: @json(__('custom.brand_member_success_message')),
                error: @json(__('custom.brand_member_fail_message')),
                forbidden: @json(__('custom.brand_member_forbidden_message')),
                noUsers: @json(__('custom.brand_member_no_users_message')),
                noAvailableUsers: @json(__('custom.brand_member_no_available_users_message')),
                selectBrand: @json(__('custom.brand_member_select_brand_message')),
                loadingMembers: @json(__('custom.brand_member_loading_members_message')),
                noMembers: @json(__('custom.brand_member_no_members_message')),
                removeButton: @json(__('custom.brand_member_remove_button')),
                removeConfirm: @json(__('custom.brand_member_remove_confirm')),
                removed: @json(__('custom.brand_member_removed_message')),
                allLoading: @json(__('custom.brand_members_list_loading_message')),
                allEmpty: @json(__('custom.brand_members_list_empty_message')),
                noBrands: @json(__('custom.brand_members_list_no_brands_message')),
                deleteUserButton: @json(__('custom.brand_user_delete_button')),
                deleteUserConfirm: @json(__('custom.brand_user_delete_confirm')),
                deleteUserSuccess: @json(__('custom.brand_user_deleted_message')),
                deleteUserFail: @json(__('custom.brand_user_delete_fail_message')),
            };

            let brandMemberAllUsers = [];
            let brandMemberAssignedUserIds = new Set();

            function populateBrandMemberUserOptions() {
                if (!brandMemberUserSelect.length) {
                    return;
                }

                brandMemberUserSelect.empty();

                if (!Array.isArray(brandMemberAllUsers) || brandMemberAllUsers.length === 0) {
                    brandMemberUserSelect.prop('disabled', true);
                    brandMemberSubmitButton.prop('disabled', true);
                    return;
                }

                const selectedBrandId = brandMemberBrandSelect.length ? brandMemberBrandSelect.val() : null;
                let availableUsers = brandMemberAllUsers;

                if (selectedBrandId) {
                    availableUsers = brandMemberAllUsers.filter(function(user) {
                        return !brandMemberAssignedUserIds.has(user.id);
                    });
                }

                if (availableUsers.length === 0) {
                    brandMemberUserSelect.prop('disabled', true);

                    if (selectedBrandId) {
                        const hasAlertMessage = brandMemberStatus.find('.text-success, .text-danger').length > 0;

                        if (!hasAlertMessage) {
                            brandMemberStatus.html('<p class="text-muted mb-0">' + brandMemberMessages.noAvailableUsers + '</p>');
                            brandMemberStatus.data('brand-member-status', 'no-available');
                        }
                    }

                    brandMemberSubmitButton.prop('disabled', true);
                    return;
                }

                availableUsers.forEach(function(user) {
                    const label = user.name + ' (' + user.email + ')';
                    const option = $('<option></option>').val(user.id).text(label);
                    brandMemberUserSelect.append(option);
                });

                if (brandMemberStatus.data('brand-member-status') === 'no-available') {
                    brandMemberStatus.removeData('brand-member-status');
                    brandMemberStatus.empty();
                }

                brandMemberUserSelect.prop('disabled', false);

                if (!brandMemberBrandSelect.length || brandMemberBrandSelect.val()) {
                    brandMemberSubmitButton.prop('disabled', false);
                }
            }

            function resetBrandMemberFeedback() {
                if (!brandMemberForm.length) {
                    return;
                }

                brandMemberForm.find('.is-invalid').removeClass('is-invalid');
                brandMemberForm.find('.invalid-feedback').text('').addClass('d-none');
            }

            function showBrandMemberAssignmentsMessage(message, type = 'muted') {
                if (!brandMemberAssignments.length) {
                    return;
                }

                const textClass = type === 'danger' ? 'text-danger' : (type === 'success' ? 'text-success' : 'text-muted');
                const paragraph = $('<p></p>').addClass(textClass + ' mb-0').text(message);
                brandMemberAssignments.empty().append(paragraph);
            }

            function setBrandMembersListStatus(message, type = 'muted') {
                if (!brandMembersListStatus.length) {
                    return;
                }

                const textClass = type === 'danger' ? 'text-danger' : (type === 'success' ? 'text-success' : 'text-muted');
                brandMembersListStatus.html('<p class="' + textClass + ' mb-0">' + message + '</p>');
            }

            function refreshAllBrandMembersList() {
                if (!brandMembersList.length) {
                    return;
                }

                const hasAlertMessage = brandMembersListStatus.length
                    ? brandMembersListStatus.find('.text-success, .text-danger').length > 0
                    : false;

                if (brandMembersListStatus.length && !hasAlertMessage) {
                    setBrandMembersListStatus(brandMemberMessages.allLoading);
                }

                brandMembersList.empty();

                $.ajax({
                    url: "{{ route('brand_users.all') }}",
                    type: 'GET',
                    headers: ajaxJsonHeaders,
                    success: function(members) {
                        if (brandMembersListStatus.length && !hasAlertMessage) {
                            brandMembersListStatus.empty();
                        }

                        if (!Array.isArray(members) || members.length === 0) {
                            const emptyItem = $('<div></div>').addClass('list-group-item text-muted').text(brandMemberMessages.allEmpty);
                            brandMembersList.append(emptyItem);
                            return;
                        }

                        members.forEach(function(member) {
                            const item = $('<div></div>').addClass('list-group-item d-flex flex-column gap-2');
                            const header = $('<div></div>').addClass('d-flex justify-content-between align-items-center gap-2 flex-wrap w-100');
                            const details = $('<div></div>').addClass('flex-grow-1');
                            const name = $('<div></div>').addClass('fw-semibold').text(member.name);
                            const email = $('<div></div>').addClass('text-muted small mb-0').text(member.email);
                            details.append(name).append(email);

                            const deleteButton = $('<button type="button"></button>')
                                .addClass('btn btn-sm btn-outline-danger')
                                .text(brandMemberMessages.deleteUserButton)
                                .on('click', function() {
                                    handleDeleteBrandUser(member.user_id, $(this));
                                });

                            header.append(details).append(deleteButton);

                            const brandList = $('<div></div>').addClass('d-flex flex-wrap gap-2');

                            if (Array.isArray(member.brands) && member.brands.length > 0) {
                                member.brands.forEach(function(brand) {
                                    const brandBadge = $('<span></span>').addClass('badge bg-primary').text(brand.brand_name);
                                    brandList.append(brandBadge);
                                });
                            } else {
                                const noBrandText = $('<span></span>').addClass('text-muted small').text(brandMemberMessages.noBrands);
                                brandList.append(noBrandText);
                            }

                            item.append(header);
                            item.append(brandList);
                            brandMembersList.append(item);
                        });
                    },
                    error: function(xhr, textStatus) {
                        let message = brandMemberMessages.error;
                        if (textStatus !== 'parsererror' && xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        setBrandMembersListStatus(message, 'danger');
                    }
                });
            }

            function refreshBrandMemberUsers() {
                if (!brandMemberUserSelect.length) {
                    return;
                }

                brandMemberStatus.empty();
                brandMemberStatus.removeData('brand-member-status');
                brandMemberUserSelect.empty();
                brandMemberUserSelect.prop('disabled', true);
                brandMemberSubmitButton.prop('disabled', true);

                $.ajax({
                    url: "{{ route('brand_users.index') }}",
                    type: 'GET',
                    headers: ajaxJsonHeaders,
                    success: function(users) {
                        if (!Array.isArray(users) || users.length === 0) {
                            brandMemberAllUsers = [];
                            brandMemberStatus.removeData('brand-member-status');
                            brandMemberStatus.html('<p class="text-muted mb-0">' + brandMemberMessages.noUsers + '</p>');
                            return;
                        }

                        brandMemberStatus.empty();
                        brandMemberAllUsers = users;
                        populateBrandMemberUserOptions();
                    },
                    error: function(xhr, textStatus) {
                        let message = brandMemberMessages.error;
                        if (textStatus !== 'parsererror' && xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        brandMemberStatus.html('<p class="text-danger mb-0">' + message + '</p>');
                    }
                });
            }

            function refreshBrandMemberAssignments(brandId) {
                if (!brandMemberAssignments.length) {
                    return;
                }

                if (!brandId) {
                    brandMemberAssignedUserIds = new Set();
                    populateBrandMemberUserOptions();
                    showBrandMemberAssignmentsMessage(brandMemberMessages.selectBrand);
                    return;
                }

                showBrandMemberAssignmentsMessage(brandMemberMessages.loadingMembers);

                $.ajax({
                    url: brandMembersBaseUrl + '/' + brandId + '/members',
                    type: 'GET',
                    headers: ajaxJsonHeaders,
                    success: function(members) {
                        if (!Array.isArray(members) || members.length === 0) {
                            brandMemberAssignedUserIds = new Set();
                            populateBrandMemberUserOptions();
                            showBrandMemberAssignmentsMessage(brandMemberMessages.noMembers);
                            return;
                        }

                        brandMemberAssignedUserIds = new Set(members.map(function(member) {
                            return member.user_id;
                        }));
                        populateBrandMemberUserOptions();

                        brandMemberAssignments.empty();

                        members.forEach(function(member) {
                            const item = $('<div></div>').addClass('list-group-item d-flex justify-content-between align-items-center gap-2');
                            const details = $('<div></div>').addClass('me-2 flex-grow-1');
                            details.append($('<div></div>').addClass('fw-semibold').text(member.name));
                            details.append($('<div></div>').addClass('text-muted small mb-0').text(member.email));

                            const removeButton = $('<button type="button"></button>')
                                .addClass('btn btn-sm btn-outline-danger')
                                .text(brandMemberMessages.removeButton)
                                .data('user-id', member.user_id)
                                .on('click', function() {
                                    handleRemoveBrandMember(brandId, member.user_id, $(this));
                                });

                            item.append(details).append(removeButton);
                            brandMemberAssignments.append(item);
                        });
                    },
                    error: function(xhr, textStatus) {
                        let message = brandMemberMessages.error;
                        if (textStatus !== 'parsererror' && xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        showBrandMemberAssignmentsMessage(message, 'danger');
                    }
                });
            }

 function handleRemoveBrandMember(brandId, userId, button, options = {}) {
                if (!brandId || !userId) {
                    return;
                }

                if (!window.confirm(brandMemberMessages.removeConfirm)) {
                    return;
                }

                const statusTarget = options.statusElement && options.statusElement.length ? options.statusElement : brandMemberStatus;

                if (statusTarget.length) {
                    statusTarget.empty();
                }

                button.prop('disabled', true);

                $.ajax({
                    url: brandMembersBaseUrl + '/' + brandId + '/members/' + userId,
                    type: 'DELETE',
                    headers: ajaxJsonHeaders,
                    data: {
                        _token: csrfToken,
                    },
                    success: function(response) {
                        const message = response.message ? response.message : brandMemberMessages.removed;
                        if (statusTarget.length) {
                            statusTarget.html('<p class="text-success mb-0">' + message + '</p>');
                        }

                        if (typeof options.onComplete === 'function') {
                            options.onComplete(true, message);
                        } else {
                            refreshBrandMemberAssignments(brandId);
                        }
                    },
                    error: function(xhr, textStatus) {
                        let message = brandMemberMessages.error;
                        if (textStatus !== 'parsererror' && xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        if (statusTarget.length) {
                            statusTarget.html('<p class="text-danger mb-0">' + message + '</p>');
                        }

                        if (typeof options.onComplete === 'function') {
                            options.onComplete(false, message);
                        } else {
                            refreshBrandMemberAssignments(brandId);
                        }
                    },
                    complete: function() {
                        button.prop('disabled', false);
                    }
                });
            }

            function handleDeleteBrandUser(userId, button) {
                if (!userId) {
                    return;
                }

                if (!window.confirm(brandMemberMessages.deleteUserConfirm)) {
                    return;
                }

                if (brandMembersListStatus.length) {
                    brandMembersListStatus.empty();
                }

                button.prop('disabled', true);

                $.ajax({
                    url: brandUsersBaseUrl + '/' + userId,
                    type: 'DELETE',
                    headers: ajaxJsonHeaders,
                    data: {
                        _token: csrfToken,
                    },
                    success: function(response) {
                        const message = response.message ? response.message : brandMemberMessages.deleteUserSuccess;
                        setBrandMembersListStatus(message, 'success');
                        refreshAllBrandMembersList();
                        refreshBrandMemberUsers();
                        refreshBrandMemberAssignments(brandMemberBrandSelect.val());
                    },
                    error: function(xhr, textStatus) {
                        let message = brandMemberMessages.deleteUserFail;
                        if (textStatus !== 'parsererror' && xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        setBrandMembersListStatus(message, 'danger');
                    },
                    complete: function() {
                        button.prop('disabled', false);
                    }
                });
            }

            if (brandMemberForm.length) {
                brandMemberForm.on('submit', function(e) {
                    e.preventDefault();

                    resetBrandMemberFeedback();
                    brandMemberStatus.empty();
                    brandMemberSubmitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('brand_users.assign') }}",
                        type: 'POST',
                        headers: ajaxJsonHeaders,
                        data: brandMemberForm.serialize(),
                        success: function(response) {
                            const message = response.message ? response.message : brandMemberMessages.success;
                            brandMemberStatus.html('<p class="text-success mb-0">' + message + '</p>');
                            brandMemberForm[0].reset();
                            brandMemberUserSelect.val([]);

                            setTimeout(function() {
                                if (brandMemberModalElement) {
                                    const modalInstance = bootstrap.Modal.getInstance(brandMemberModalElement) || new bootstrap.Modal(brandMemberModalElement);
                                    modalInstance.hide();
                                }
                            }, 1000);
                        },
                        error: function(xhr, textStatus) {
                            if (textStatus === 'parsererror') {
                                brandMemberStatus.html('<p class="text-danger mb-0">' + brandMemberMessages.error + '</p>');
                                return;
                            }

                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
                                Object.keys(errors).forEach(function(field) {
                                    let normalizedField = field;
                                    if (field.indexOf('.') !== -1) {
                                        normalizedField = field.split('.')[0];
                                    }

                                    if (normalizedField === 'user_ids') {
                                        normalizedField = 'user_ids[]';
                                    }

                                    const input = brandMemberForm.find('[name="' + normalizedField + '"]');
                                    if (input.length) {
                                        input.addClass('is-invalid');
                                        const feedback = input.siblings('.invalid-feedback');
                                        if (feedback.length) {
                                            feedback.text(errors[field][0]).removeClass('d-none');
                                        }
                                    }
                                });
                            } else if (xhr.status === 403) {
                                brandMemberStatus.html('<p class="text-danger mb-0">' + brandMemberMessages.forbidden + '</p>');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                brandMemberStatus.html('<p class="text-danger mb-0">' + xhr.responseJSON.message + '</p>');
                            } else {
                                brandMemberStatus.html('<p class="text-danger mb-0">' + brandMemberMessages.error + '</p>');
                            }
                        },
                        complete: function() {
                            brandMemberSubmitButton.prop('disabled', false);
                        }
                    });
                });

                if (brandMemberModalElement) {
                    brandMemberModalElement.addEventListener('show.bs.modal', function () {
                        brandMemberForm[0].reset();
                        brandMemberStatus.empty();
                        resetBrandMemberFeedback();
                        brandMemberSubmitButton.prop('disabled', true);
                        refreshBrandMemberUsers();
                        refreshBrandMemberAssignments(brandMemberBrandSelect.val());
                    });

                    brandMemberModalElement.addEventListener('hidden.bs.modal', function () {
                        brandMemberForm[0].reset();
                        brandMemberStatus.empty();
                        resetBrandMemberFeedback();
                        brandMemberSubmitButton.prop('disabled', false);
                        brandMemberUserSelect.val([]);
                        if (brandMemberAssignments.length) {
                            brandMemberAssignments.empty();
                        }
                    });
                }
            }
            if (brandMembersListModalElement) {
                brandMembersListModalElement.addEventListener('show.bs.modal', function () {
                    if (brandMembersListStatus.length) {
                        setBrandMembersListStatus(brandMemberMessages.allLoading);
                    }

                    if (brandMembersList.length) {
                        brandMembersList.empty();
                    }

                    refreshAllBrandMembersList();
                });

                brandMembersListModalElement.addEventListener('hidden.bs.modal', function () {
                    if (brandMembersListStatus.length) {
                        brandMembersListStatus.empty();
                    }

                    if (brandMembersList.length) {
                        brandMembersList.empty();
                    }
                });
            }
            if (brandMemberBrandSelect.length) {
                brandMemberBrandSelect.on('change', function() {
                    const selectedBrandId = $(this).val();
                    if (brandMemberUserSelect.length) {
                        brandMemberUserSelect.val([]);
                        brandMemberUserSelect.prop('disabled', true);
                    }
                    brandMemberSubmitButton.prop('disabled', true);
                    refreshBrandMemberAssignments(selectedBrandId);

                    if (!selectedBrandId) {
                        brandMemberAssignedUserIds = new Set();
                        populateBrandMemberUserOptions();
                        brandMemberSubmitButton.prop('disabled', true);
                    } else if (!brandMemberUserSelect.prop('disabled')) {
                        brandMemberSubmitButton.prop('disabled', false);
                    }
                });
            }
            function formatBrandLabel(brand) {
                if (!brand || !brand.name) {
                    return '';
                }

                const parts = [];
                const code = brand.currency ? String(brand.currency).trim() : '';
                const symbol = brand.currency_symbol ? String(brand.currency_symbol).trim() : '';

                if (code && symbol) {
                    parts.push(code + ' ' + symbol);
                } else if (symbol) {
                    parts.push(symbol);
                } else if (code) {
                    parts.push(code);
                }

                if (parts.length === 0) {
                    return brand.name;
                }

                return brand.name + ' (' + parts.join(' ') + ')';
            }

            if (brandMemberBrandSelect.length) {
                brandMemberBrandSelect.on('change', function() {
                    const selectedBrandId = $(this).val();
                    if (brandMemberUserSelect.length) {
                        brandMemberUserSelect.val([]);
                        brandMemberUserSelect.prop('disabled', true);
                    }
                    brandMemberSubmitButton.prop('disabled', true);
                    refreshBrandMemberAssignments(selectedBrandId);

                    if (!selectedBrandId) {
                        brandMemberAssignedUserIds = new Set();
                        populateBrandMemberUserOptions();
                        brandMemberSubmitButton.prop('disabled', true);
                    } else if (!brandMemberUserSelect.prop('disabled')) {
                        brandMemberSubmitButton.prop('disabled', false);
                    }
                });
            }
            const brandCurrencyLabelText = @json(__('custom.brand_currency_label'));
            const brandCurrencyLabel = @json(__('custom.brand_currency_label'));
            const currencyMessages = {
                success: @json(__('custom.brand_currency_update_success')),
                error: @json(__('custom.brand_currency_update_error'))
            };
            const currencyOptions = [
                { code: 'TRY', symbol: '₺' },
                { code: 'USD', symbol: '$' },
                { code: 'EUR', symbol: '€' },
                { code: 'RUB', symbol: '₽' },
            ];
            var suffixCurrencyCodes = @json(['TRY', 'TRL']);

            function buildCurrencyOptions(selectedCode) {
                var normalized = (selectedCode || '').toUpperCase();
                return currencyOptions.map(function(option) {
                    var selectedAttribute = option.code === normalized ? ' selected' : '';
                    return '<option value="' + option.code + '"' + selectedAttribute + '>' + option.code + ' (' + option.symbol + ')</option>';
                }).join('');
            }

            function getCurrencySymbol(currencyCode) {
                var normalized = (currencyCode || '').toUpperCase();
                for (var i = 0; i < currencyOptions.length; i++) {
                    if (currencyOptions[i].code === normalized) {
                        return currencyOptions[i].symbol;
                    }
                }
                return '₺';
            }

            function resetCurrencyStatus(statusElement) {
                if (!statusElement || !statusElement.length) {
                    return;
                }
                statusElement.stop(true, true)
                    .removeClass('text-success text-danger')
                    .addClass('text-muted')
                    .text('');
            }

            function showCurrencyStatus(statusElement, message, type) {
                if (!statusElement || !statusElement.length) {
                    return;
                }

                statusElement.stop(true, true)
                    .removeClass('text-muted text-success text-danger')
                    .addClass(type === 'error' ? 'text-danger' : 'text-success')
                    .text(message);

                if (type !== 'error') {
                    setTimeout(function() {
                        statusElement.fadeOut(200, function() {
                            $(this)
                                .removeClass('text-success text-danger')
                                .addClass('text-muted')
                                .text('')
                                .show();
                        });
                    }, 2500);
                }
            }

            function updateBrandCardCurrency(cardElement, currencyCode, currencySymbol) {
                if (!cardElement || !cardElement.length) {
                    return;
                }

                cardElement.find('.brand-currency-value').each(function() {
                    var numericValue = Number($(this).data('value'));
                    $(this).text(formatCurrency(numericValue, currencyCode, currencySymbol));
                });

                var badge = cardElement.find('.brand-currency-badge');
                if (badge.length) {
                    badge.text(brandCurrencyLabel + ': ' + currencySymbol + ' ' + currencyCode.toUpperCase());
                }
            }

            function bindCurrencySelectHandlers() {
                $('.brand-currency-select').off('change').on('change', function() {
                    var selectElement = $(this);
                    var brandId = selectElement.data('id');
                    var newCurrency = selectElement.val();
                    var cardElement = selectElement.closest('.seller-box');
                    var statusElement = selectElement.closest('.brand-currency-control').find('[data-role="currency-status"]');

                    resetCurrencyStatus(statusElement);
                    selectElement.prop('disabled', true);

                    $.ajax({
                        url: '/brands/' + brandId + '/currency',
                        type: 'PATCH',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            currency: newCurrency
                        },
                        success: function(response) {
                            var resolvedCurrency = response && response.currency ? response.currency : newCurrency;
                            var resolvedSymbol = response && response.currency_symbol ? response.currency_symbol : getCurrencySymbol(resolvedCurrency);

                            updateBrandCardCurrency(cardElement, resolvedCurrency, resolvedSymbol);
                            showCurrencyStatus(statusElement, currencyMessages.success, 'success');
                        },
                        error: function() {
                            showCurrencyStatus(statusElement, currencyMessages.error, 'error');
                        },
                        complete: function() {
                            selectElement.prop('disabled', false);
                        }
                    });
                });
            }

            function formatCurrency(amount, currencyCode, currencySymbol) {
                var numericAmount = Number(amount);

                if (!isFinite(numericAmount)) {
                    numericAmount = 0;
                }

                var formattedNumber;

                try {
                    formattedNumber = new Intl.NumberFormat(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    }).format(numericAmount);
                } catch (error) {
                    formattedNumber = numericAmount.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                }

                var resolvedCode = typeof currencyCode === 'string' ? currencyCode.toUpperCase() : '';
                var resolvedSymbol = typeof currencySymbol === 'string' ? currencySymbol : '';

                if (!resolvedSymbol && resolvedCode) {
                    resolvedSymbol = getCurrencySymbol(resolvedCode);
                }

                if (!resolvedSymbol) {
                    return formattedNumber;
                }

                var symbolUpper = resolvedSymbol.toUpperCase ? resolvedSymbol.toUpperCase() : resolvedSymbol;
                var suffixList = Array.isArray(suffixCurrencyCodes) ? suffixCurrencyCodes : ['TRY', 'TRL'];
                var isSuffixCurrency = (resolvedCode && suffixList.indexOf(resolvedCode) !== -1)
                    || symbolUpper === 'TL'
                    || symbolUpper === '₺';
                var isAlphabeticSymbol = /^[A-Za-z]+$/.test(resolvedSymbol);
                var requiresExtraSpace = resolvedSymbol.length > 1 && !isAlphabeticSymbol;
                var prefixSpacer = (!isSuffixCurrency && (isAlphabeticSymbol || requiresExtraSpace)) ? ' ' : '';
                var suffixSpacer = isSuffixCurrency ? ' ' : '';

                if (isSuffixCurrency) {
                    return formattedNumber + suffixSpacer + resolvedSymbol;
                }

                return resolvedSymbol + prefixSpacer + formattedNumber;
            }
            
            function buildCurrencyOptions(selectedCode) {
                var normalized = (selectedCode || '').toUpperCase();
                return currencyOptions.map(function(option) {
                    var selectedAttribute = option.code === normalized ? ' selected' : '';
                    return '<option value="' + option.code + '"' + selectedAttribute + '>' + option.code + ' (' + option.symbol + ')</option>';
                }).join('');
            }

            function getCurrencySymbol(currencyCode) {
                var normalized = (currencyCode || '').toUpperCase();
                for (var i = 0; i < currencyOptions.length; i++) {
                    if (currencyOptions[i].code === normalized) {
                        return currencyOptions[i].symbol;
                    }
                }
                return '₺';
            }

            function resetCurrencyStatus(statusElement) {
                if (!statusElement || !statusElement.length) {
                    return;
                }
                statusElement.stop(true, true)
                    .removeClass('text-success text-danger')
                    .addClass('text-muted')
                    .text('');
            }

            function showCurrencyStatus(statusElement, message, type) {
                if (!statusElement || !statusElement.length) {
                    return;
                }

                statusElement.stop(true, true)
                    .removeClass('text-muted text-success text-danger')
                    .addClass(type === 'error' ? 'text-danger' : 'text-success')
                    .text(message);

                if (type !== 'error') {
                    setTimeout(function() {
                        statusElement.fadeOut(200, function() {
                            $(this)
                                .removeClass('text-success text-danger')
                                .addClass('text-muted')
                                .text('')
                                .show();
                        });
                    }, 2500);
                }
            }

            function updateBrandCardCurrency(cardElement, currencyCode, currencySymbol) {
                if (!cardElement || !cardElement.length) {
                    return;
                }

                cardElement.find('.brand-currency-value').each(function() {
                    var numericValue = Number($(this).data('value'));
                    $(this).text(formatCurrency(numericValue, currencyCode, currencySymbol));
                });

                var badge = cardElement.find('.brand-currency-badge');
                if (badge.length) {
                    badge.text(brandCurrencyLabel + ': ' + currencySymbol + ' ' + currencyCode.toUpperCase());
                }
            }

            function bindCurrencySelectHandlers() {
                $('.brand-currency-select').off('change').on('change', function() {
                    var selectElement = $(this);
                    var brandId = selectElement.data('id');
                    var newCurrency = selectElement.val();
                    var cardElement = selectElement.closest('.seller-box');
                    var statusElement = selectElement.closest('.brand-currency-control').find('[data-role="currency-status"]');

                    resetCurrencyStatus(statusElement);
                    selectElement.prop('disabled', true);

                    $.ajax({
                        url: '/brands/' + brandId + '/currency',
                        type: 'PATCH',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            currency: newCurrency
                        },
                        success: function(response) {
                            var resolvedCurrency = response && response.currency ? response.currency : newCurrency;
                            var resolvedSymbol = response && response.currency_symbol ? response.currency_symbol : getCurrencySymbol(resolvedCurrency);

                            updateBrandCardCurrency(cardElement, resolvedCurrency, resolvedSymbol);
                            showCurrencyStatus(statusElement, currencyMessages.success, 'success');
                        },
                        error: function() {
                            showCurrencyStatus(statusElement, currencyMessages.error, 'error');
                        },
                        complete: function() {
                            selectElement.prop('disabled', false);
                        }
                    });
                });
            }

            // Marka ekleme işlemi
$('#brandUploadButton').click(function(e) {
                e.preventDefault();

                const brandUploadButton = $('#brandUploadButton');
                const formData = new FormData($('#brandUploadForm')[0]);

                brandUploadButton.prop('disabled', true).addClass('disabled');

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
                        brandUploadButton.prop('disabled', false).removeClass('disabled');
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
                        const currentBrandSelection = $('#brandSelect').val();
                        $('#brandSelect').empty();
                        $('#brandSelect').append('<option value="">{{ __('custom.select_brand_label') }}</option>');

                        let previousBrandMemberSelection = null;
                        if (brandMemberBrandSelect.length) {
                            previousBrandMemberSelection = brandMemberBrandSelect.val();
                            brandMemberBrandSelect.empty();
                            brandMemberBrandSelect.append('<option value="">{{ __('custom.select_brand_label') }}</option>');
                        }

                        $('#brandList').empty();

                        const canManageBrands = @json(Auth::user()->user_type != 'brand');

                        $.each(data, function(key, value) {
                            var currencyCode = value.currency != null ? value.currency : 'TRY';
                            var currencySymbol = value.currency_symbol != null ? value.currency_symbol : getCurrencySymbol(currencyCode);
                            var totalPlanned = Number(value.total_planned != null ? value.total_planned : 0);
                            var totalSpent = Number(value.total_spent != null ? value.total_spent : 0);
                            var formattedTotalPlanned = formatCurrency(totalPlanned, currencyCode, currencySymbol);
                            var formattedTotalSpent = formatCurrency(totalSpent, currencyCode, currencySymbol);
                            var updateCountRaw = value.update_count != null ? value.update_count : (value.total_groups != null ? value.total_groups : 0);
                            var updateCount = parseInt(updateCountRaw, 10);

                            if (isNaN(updateCount)) {
                                updateCount = 0;
                            }

                            // Dropdown listesine ekle
                            const brandLabel = formatBrandLabel(value) || value.name;

                            $('#brandSelect').append('<option value="' + value.id + '">' + brandLabel + '</option>');
                            if (brandMemberBrandSelect.length) {
                                const memberLabel = formatBrandLabel(value) || value.name;
                                const brandOption = $('<option></option>').val(value.id).text(memberLabel);
                                brandMemberBrandSelect.append(brandOption);
                            }
                            // Sayfa listesine ekle
                            var brandCard = '';
                            brandCard += '<li class="seller-box" data-name="' + value.name + '" data-brand-id="' + value.id + '">';
                            brandCard += '    <div>';
                            brandCard += '        <img src="' + value.logo + '" class="brand-logo" width="100" style="max-height:100px; border-radius:50%; object-fit:contain;">';
                            brandCard += '        <div>';
                            brandCard += '            <h5>' + value.name + '</h5><span class="f-light">{{ __("custom.brand") }}</span>';
                            brandCard += '        </div>';
                            brandCard += '    </div>';
                            brandCard += '    <ul class="seller-profits">';
                            brandCard += '        <li>';
                            brandCard += '            <div class="common-space"><span>{{ __("custom.total_budget_label") }}</span><span class="brand-currency-value" data-value="' + totalPlanned + '">' + formattedTotalPlanned + '</span></div>';
                            brandCard += '        </li>';
                            brandCard += '        <li>';
                            brandCard += '            <div class="common-space"><span>{{ __("custom.total_spent_label") }}</span><span class="brand-currency-value" data-value="' + totalSpent + '">' + formattedTotalSpent + '</span></div>';
                            brandCard += '        </li>';

                            if (canManageBrands) {
                                brandCard += '        <li>';
                                brandCard += '            <div class="common-space"><span>{{ __("custom.total_groups_label") }}</span><span>' + updateCount + '</span></div>';
                                brandCard += '        </li>';
                            }

                            brandCard += '    </ul>';
                            brandCard += '    <div class="d-flex flex-wrap align-items-center gap-2 mt-3">';
                            brandCard += "        <a class=\"btn btn-primary btn-hover-effect\" href=\"/dashboard/" + value.id + "\">{{ __('custom.view_brand_button') }}</a>";

                            if (canManageBrands) {
                                brandCard += '        <div class="brand-currency-control flex-grow-1" style="min-width: 160px;">';
                                brandCard += '            <label class="form-label text-muted small mb-1">' + brandCurrencyLabelText + '</label>';
                                brandCard += '            <select class="form-select brand-currency-select" data-id="' + value.id + '">';
                                brandCard +=                  buildCurrencyOptions(currencyCode);
                                brandCard += '            </select>';
                                brandCard += '            <div class="brand-currency-status small text-muted mt-1" data-role="currency-status"></div>';
                                brandCard += '        </div>';
                                brandCard += "        <button class=\"btn btn-danger delete-brand\" data-id=\"" + value.id + "\">{{ __('custom.delete_brand_button') }}</button>";
                            } else {
                                brandCard += '        <span class="badge bg-light text-dark border brand-currency-badge">' + brandCurrencyLabelText + ': ' + currencySymbol + ' ' + currencyCode.toUpperCase() + '</span>';
                            }

                            brandCard += '    </div>';
                            brandCard += '</li>';

                            $('#brandList').append(brandCard);
                        });

                        if (currentBrandSelection) {
                            $('#brandSelect').val(currentBrandSelection);
                        }

                        // Silme butonuna tıklama işlemi
                        if (brandMemberBrandSelect.length && previousBrandMemberSelection) {
                            brandMemberBrandSelect.val(previousBrandMemberSelection).trigger('change');
                        }

                        bindCurrencySelectHandlers();

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
