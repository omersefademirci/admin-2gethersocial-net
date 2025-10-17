@extends('layout')

@section('afterTitle', true)
@section('title', 'UTM Oluşturucu')

@section('pages-styles')
    <style>
        #successMessageDiv {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: #f9f9f2f2;
            color: #010101;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            font-size: 2rem;
            visibility: hidden;
        }

        body.dark-only #successMessageDiv {
            background-color: #111112f2;
            color: #FFF;
        }

        @media only screen and (max-width: 992px) {
            .page-wrapper.horizontal-wrapper .page-body-wrapper .page-body {
                margin-top: 84px;
            }

            .page-wrapper.horizontal-wrapper .page-body-wrapper .sidebar-wrapper {
                display: none;
            }

            body .page-wrapper .page-header .header-logo-wrapper {
                margin: -9px 0;
            }
        }
    </style>
@endsection
@section('content')
    <div class="page-wrapper horizontal-wrapper" id="pageWrapper">
        @include('includes.topbar')

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            @include('includes.navbar-basic')

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>{{ __('custom.utm_service') }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                            </svg></a></li>
                                    <li class="breadcrumb-item active">{{ __('custom.utm_service') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row seller-wrapper">

                        <div class="col-xl-6">
                            <div class="card height-equal">
                                <div class="card-header border-t-primary">
                                    <h5>{{ __('custom.campaign_utm_info') }}</h5>
                                    <p class="f-m-light mt-1">
                                        {{ __('custom.fill_required_fields') }}
                                    </p>
                                </div>
                                <div class="card-body custom-input">
                                    <form class="form-wizard" id="utmForm1">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="mainWebsiteAddress" type="text"
                                                        placeholder="" value="https://www.">
                                                    <label
                                                        for="mainWebsiteAddress">{{ __('custom.website_address') }}</label>
                                                    <div class="form-text">{{ __('custom.website_address_desc') }}</div>
                                                    <div class="invalid-feedback">{{ __('custom.invalid_website_address') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="campaignId" type="text"
                                                        placeholder="" value="">
                                                    <label for="campaignId">{{ __('custom.campaign_id') }}</label>
                                                    <div class="form-text">{{ __('custom.campaign_id_desc') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="campaignSource" type="text"
                                                        placeholder="" value="">
                                                    <label for="campaignSource">{{ __('custom.campaign_source') }}</label>
                                                    <div class="form-text">{{ __('custom.campaign_source_desc') }}</div>
                                                    <div class="invalid-feedback">
                                                        {{ __('custom.invalid_campaign_source') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="campaignMedium" type="text"
                                                        placeholder="" value="">
                                                    <label for="campaignMedium">{{ __('custom.campaign_medium') }}</label>
                                                    <div class="form-text">{{ __('custom.campaign_medium_desc') }}</div>
                                                    <div class="invalid-feedback">
                                                        {{ __('custom.invalid_campaign_medium') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="campaignName" type="text"
                                                        placeholder="" value="">
                                                    <label for="campaignName">{{ __('custom.campaign_name') }}</label>
                                                    <div class="form-text">{{ __('custom.campaign_name_desc') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="campaignTerm" type="text"
                                                        placeholder="" value="">
                                                    <label for="campaignTerm">{{ __('custom.campaign_term') }}</label>
                                                    <div class="form-text">{{ __('custom.campaign_term_desc') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="campaignContent" type="text"
                                                        placeholder="" value="">
                                                    <label
                                                        for="campaignContent">{{ __('custom.campaign_content') }}</label>
                                                    <div class="form-text">{{ __('custom.campaign_content_desc') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card height-equal">
                                <div class="card-header border-t-danger">
                                    <h5>{{ __('custom.share_generated_campaign') }}</h5>
                                    <p class="f-m-light mt-1">
                                        {{ __('custom.use_this_url') }}
                                    </p>
                                </div>
                                <div class="card-body custom-input">
                                    <form class="form-wizard" id="utmForm2">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <textarea class="form-control" id="campaignAddress" placeholder="" style="height: 100px" disabled></textarea>
                                                    <label
                                                        for="campaignAddress">{{ __('custom.generated_campaign_address') }}</label>
                                                    <div class="form-text">{{ __('custom.generated_url_info') }}</div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="input-group mb-3"><span
                                                        class="input-group-text">https://2gethersocial.net/</span>
                                                    <div class="form-floating">
                                                        <input class="form-control" id="shortLink" type="text">
                                                        <label for="shortLink">{{ __('custom.short_url') }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-text">{{ __('custom.short_url_info') }}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-end pt-3">
                                                <button class="btn btn-danger" id="utmLinkCreate"
                                                    type="button">{{ __('custom.create_short_link') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card height-equal">
                                <div class="card-header border-t-warning">
                                    <h5>{{ __('custom.create_custom_campaign') }}</h5>
                                    <p class="f-m-light mt-1">
                                        {{ __('custom.custom_campaign_desc') }}
                                    </p>
                                </div>
                                <div class="card-body custom-input">
                                    <form class="form-wizard" id="utmForm2">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <textarea class="form-control" id="campaignAddressCustom" placeholder="" style="height: 100px"></textarea>
                                                    <label
                                                        for="campaignAddressCustom">{{ __('custom.custom_campaign_address') }}</label>
                                                    <div class="form-text">{{ __('custom.custom_campaign_desc_2') }}</div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="input-group mb-3"><span
                                                        class="input-group-text">https://2gethersocial.net/</span>
                                                    <div class="form-floating">
                                                        <input class="form-control" id="shortLinkCustom" type="text">
                                                        <label for="shortLinkCustom">{{ __('custom.short_url') }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-text">{{ __('custom.short_url_info') }}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-end pt-3">
                                                <button class="btn btn-warning" id="utmLinkCreateCustom"
                                                    type="button">{{ __('custom.create_custom_short_link') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

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


    <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard/clipboard-script.js') }}?v=2"></script>

    <script>
        $(document).ready(function() {
            window.translations = {
                utmCreatedSuccessfully: "{{ __('custom.utm_created_successfully') }}",
                utmCheckBeforeShare: "{{ __('custom.utm_check_before_share') }}",
                utmCopyLink: "{{ __('custom.utm_copy_link') }}",
                utmCreateNew: "{{ __('custom.utm_create_new') }}",
                utmInvalidCampaignUrl: "{{ __('custom.utm_invalid_campaign_url') }}",
                utmInvalidShortLink: "{{ __('custom.utm_invalid_short_link') }}"
            };
            // CSRF tokenini AJAX isteklerine eklemek
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function generateMessage(message) {
                // Success div'ini oluştur veya zaten varsa al
                var successDiv = document.getElementById('successMessageDiv');

                if (!successDiv) {
                    // Success div'ini oluştur
                    successDiv = document.createElement('div');
                    successDiv.id = 'successMessageDiv';
                    document.body.appendChild(successDiv);
                }

                // Mesajı ayarla
                successDiv.innerHTML = message;

                // Success mesajını göster
                successDiv.style.visibility = 'visible';
            }

            function showSuccessMessage(link) {
                generateMessage(
                    '<h1>' + window.translations.utmCreatedSuccessfully + '</h1>' +
                    '<p style="color:red;">' + window.translations.utmCheckBeforeShare + '</p>' +
                    '<p><a href="' + link + '" target="_blank" id="clipboardTargetShortlink">' + link +
                    '</a></p>' +
                    '<button class="btn btn-primary btn-clipboard" type="button" data-clipboard-action="copy" data-clipboard-target="#clipboardTargetShortlink"><i class="fa fa-copy"></i> ' +
                    window.translations.utmCopyLink + '</button>' +
                    '<button class="btn btn-outline-secondary mt-5" onclick="window.location.reload()">' +
                    window.translations.utmCreateNew + '</button>'
                );
            }


            function hideSuccessMessage() {
                var successDiv = document.getElementById('successMessageDiv');
                if (successDiv) {
                    successDiv.style.visibility = 'hidden';
                }
            }

            function validateAndSubmitCustom() {
                var isValid = true;

                // Validate Custom UTM URL Address
                var campaignAddressCustom = $('#campaignAddressCustom').val().trim();
                if (!campaignAddressCustom.includes('https://') || campaignAddressCustom.length < 13) {
                    $('#campaignAddressCustom').addClass('is-invalid').removeClass('is-valid');
                    isValid = false;
                } else {
                    $('#campaignAddressCustom').addClass('is-valid').removeClass('is-invalid');
                }

                // Validate Short Link
                var shortLink = $('#shortLinkCustom').val().trim();
                if (shortLink.length < 2) {
                    $('#shortLinkCustom').addClass('is-invalid').removeClass('is-valid');
                    isValid = false;
                } else {
                    $('#shortLinkCustom').addClass('is-valid').removeClass('is-invalid');
                }

                // Submit form if all validations are passed
                if (isValid) {
                    var formData = {
                        campaignAddress: $('#campaignAddressCustom').val().trim(),
                        shortLink: shortLink,
                    };

                    $.ajax({
                        url: "{{ route('store_utm_custom') }}",
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                console.log('Success:', response);
                                // Başarılı mesajı göster
                                showSuccessMessage("https://2gethersocial.net/" + response.shortLink);
                            } else if (response.status === 'error') {
                                console.log('Error:', response.message);
                                // Hata mesajını kullanıcıya göster
                                alert(response.message);
                            }
                        },
                        error: function(response) {
                            alert(response.responseJSON.message)
                            console.error('Error:', response.responseJSON);
                        }
                    });
                }
            }

            // Attach event to the button
            $('#utmLinkCreateCustom').click(validateAndSubmitCustom);

            function generateCampaignURL() {
                var websiteAddress = $('#mainWebsiteAddress').val().trim();

                if (websiteAddress == 'https://www.') {
                    $('#campaignAddress').val('');
                    return; // Stop the function if the website address is not properly formatted
                }

                var campaignId = $('#campaignId').val().trim();
                var campaignSource = $('#campaignSource').val().trim();
                var campaignMedium = $('#campaignMedium').val().trim();
                var campaignName = $('#campaignName').val().trim();
                var campaignTerm = $('#campaignTerm').val().trim();
                var campaignContent = $('#campaignContent').val().trim();

                // Construct the URL
                var campaignURL = websiteAddress;
                var params = [];

                if (campaignSource) params.push('utm_source=' + encodeURIComponent(campaignSource));
                if (campaignMedium) params.push('utm_medium=' + encodeURIComponent(campaignMedium));
                if (campaignName) params.push('utm_name=' + encodeURIComponent(campaignName));
                if (campaignId) params.push('utm_campaign=' + encodeURIComponent(campaignId));
                if (campaignContent) params.push('utm_content=' + encodeURIComponent(campaignContent));
                if (campaignTerm) params.push('utm_term=' + encodeURIComponent(campaignTerm));

                // Only add the query string if there are parameters
                if (params.length > 0) {
                    campaignURL += '?' + params.join('&');
                }

                // Update the textarea with the new URL
                $('#campaignAddress').val(campaignURL);
            }

            // Attach the generateCampaignURL function to input events
            $('#utmForm1 input').on('input', generateCampaignURL);

            // Initially generate URL if there are predefined values
            generateCampaignURL();

            function validateAndSubmit() {
                var isValid = true;

                // Validate Main Website Address
                var websiteAddress = $('#mainWebsiteAddress').val().trim();
                if (!websiteAddress.includes('https://www.') || websiteAddress.length < 13) {
                    $('#mainWebsiteAddress').addClass('is-invalid').removeClass('is-valid');
                    isValid = false;
                } else {
                    $('#mainWebsiteAddress').addClass('is-valid').removeClass('is-invalid');
                }

                // Validate Campaign Source
                var campaignSource = $('#campaignSource').val().trim();
                if (campaignSource.length < 2) {
                    $('#campaignSource').addClass('is-invalid').removeClass('is-valid');
                    isValid = false;
                } else {
                    $('#campaignSource').addClass('is-valid').removeClass('is-invalid');
                }

                // Validate Campaign Medium
                var campaignMedium = $('#campaignMedium').val().trim();
                if (campaignMedium.length < 2) {
                    $('#campaignMedium').addClass('is-invalid').removeClass('is-valid');
                    isValid = false;
                } else {
                    $('#campaignMedium').addClass('is-valid').removeClass('is-invalid');
                }

                // Validate Short Link
                var shortLink = $('#shortLink').val().trim();
                if (shortLink.length < 2) {
                    $('#shortLink').addClass('is-invalid').removeClass('is-valid');
                    isValid = false;
                } else {
                    $('#shortLink').addClass('is-valid').removeClass('is-invalid');
                }

                // Submit form if all validations are passed
                if (isValid) {
                    var formData = {
                        websiteAddress: websiteAddress,
                        campaignId: $('#campaignId').val().trim(),
                        campaignSource: campaignSource,
                        campaignMedium: campaignMedium,
                        campaignTerm: $('#campaignTerm').val().trim(),
                        campaignContent: $('#campaignContent').val().trim(),
                        campaignAddress: $('#campaignAddress').val().trim(),
                        shortLink: shortLink,
                    };

                    $.ajax({
                        url: "{{ route('store_utm') }}",
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                console.log('Success:', response);
                                // Başarılı mesajı göster

                                showSuccessMessage("https://2gethersocial.net/" + response.shortLink);
                            } else if (response.status === 'error') {
                                console.log('Error:', response.message);
                                // Hata mesajını kullanıcıya göster
                                alert(response.message);
                            }
                        },
                        error: function(response) {
                            alert(response.responseJSON.message)
                            console.error('Error:', response);
                        }
                    });

                }
            }

            // Attach event to the button
            $('#utmLinkCreate').click(validateAndSubmit);
        });
    </script>
@endsection
