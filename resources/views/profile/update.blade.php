@extends('layouts.app')

@section('content')
<main>
    <div class="login-menu">
        <div class="login-menu__item l-child">
            <a href="{{ route('profile.view.id', ['id' => $user_id]) }}">
                <span>マイページ</span>
                <img src="{{ asset('images/my-page.png') }}" alt="マイページ">
            </a>
        </div>
        <div class="login-menu__item">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <span>{{ __('login.logout') }}</span>
                <img src="{{ asset('images/login.png') }}" alt="ログアウト">
            </a>
        </div>
    
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <div class="photo-section section-con active">
        @if(!@empty($cover_path))
            <div class="photo-section__top-part" style="background-image: url('{{ asset('storage/' . $cover_path) }}')">
        @else
            <div class="photo-section__top-part">    
        @endif
            <div class="photo-section__top-part--lbl dropzone-cover-trigger">カバー写真</div>

            <div class="photo-section__top-part--rmv dropzone-cover-remove-trigger">カバー削除</div>

            <div id="cover_photo_con" class="" style="display: none">
                <input type="text" name="cover_path" id="cover_path" value="{{ $cover_path }}" />
            </div>

            <div class="photo-section__top-part--dropzone">
                <div id="profile_photo" class="dropzone dropzone-trigger-01">
                    <input type="text" name="photo_path" id="photo_path" value="{{ $photo_path }}" />
                </div>
                <div class="dropzone-trigger">
                    <img src="{{ asset('images/photo.png') }}" alt="photo">
                </div>

                <div class="dropzone-trigger-remove">
                    <img src="{{ asset('images/photo_remove.png') }}" alt="photo">
                </div>
            </div>
        </div>
        <div class="photo-section__bottom-part section-inner-con">
            <input type="text" class="m-form-control mb-15" id="name" name="name" placeholder="表示名 or タイトル" value="{{ $name }}" />
            <input type="text" class="m-form-control mb-30" id="title" name="title" placeholder="肩書き or サブタイトル" value="{{ $title }}" />
            <button class="save-btn" data-type="sns-name">Save</button>
        </div>
    </div>
    <div class="intro-section section-con {{ !empty($intro_flag) ? 'active' : '' }}">
        <div class="section-enable-flag">
            <label class="switch">
                <input type="checkbox" class="flag-checkbox" id="intro_flag" name="intro_flag" value="intro_flag" {{ !empty($intro_flag) ? 'checked' : '' }} />
                <span class="slider round"></span>
            </label>
            <label for="intro_flag">経歴・紹介文 or メッセージ</label>
        </div>
        <div class="section-inner-con">
            <textarea class="m-form-control mb-30" name="intro" id="intro" rows="8">{{ $intro }}</textarea>
            <button class="save-btn" data-type="intro-btn">Save</button>
        </div>
    </div>
    <div class="job-section section-con {{ !empty($job_flag) ? 'active' : '' }}">
        <div class="section-enable-flag">
            <label class="switch">
                <input type="checkbox" class="flag-checkbox" id="job_flag" name="job_flag" value="job_flag"  {{ !empty($job_flag) ? 'checked' : '' }} />
                <span class="slider round"></span>
            </label>
            <label for="job_flag">仕事</label>
        </div>
        <div class="section-inner-con">
            <input type="text" class="m-form-control mb-15" id="company" name="company" placeholder="会社名・組織名" value="{{ $company }}" />
            <input type="text" class="m-form-control mb-30" id="director" name="director" placeholder="役職" value="{{ $director }}" />
            <button class="save-btn" data-type="sns-company">Save</button>
        </div>
    </div>
    <div class="job-section section-con {{ !empty($edu_flag) ? 'active' : '' }}">
        <div class="section-enable-flag">
            <label class="switch">
                <input type="checkbox" class="flag-checkbox" id="edu_flag" name="edu_flag" value="edu_flag"  {{ !empty($edu_flag) ? 'checked' : '' }} />
                <span class="slider round"></span>
            </label>
            <label for="edu_flag">学歴</label>
        </div>
        <div class="section-inner-con">
            <input type="text" class="m-form-control mb-15" id="edu" name="edu" placeholder="学校名" value="{{ $edu }}" />
            <input type="text" class="m-form-control mb-30" id="major" name="major" placeholder="専攻・専門" value="{{ $major }}" />
            <button class="save-btn" data-type="sns-edu">Save</button>
        </div>
    </div>
    <div class="job-section section-con {{ !empty($address_flag) ? 'active' : '' }}">
        <div class="section-enable-flag">
            <label class="switch">
                <input type="checkbox" class="flag-checkbox" id="address_flag" name="address_flag" value="address_flag"  {{ !empty($address_flag) ? 'checked' : '' }} />
                <span class="slider round"></span>
            </label>
            <label for="address_flag">居住地</label>
        </div>
        <div class="section-inner-con">
            <input type="text" class="m-form-control mb-30" id="address" name="address" placeholder="住所・地名" value="{{ $address }}" />
            <button class="save-btn" data-type="sns-address">Save</button>
        </div>
    </div>
    <div class="skill-section section-con {{ !empty($skill_flag) ? 'active' : '' }}">
        <div class="section-enable-flag">
            <label class="switch">
                <input type="checkbox" class="flag-checkbox" id="skill_flag" name="skill_flag" value="skill_flag"  {{ !empty($skill_flag) ? 'checked' : '' }} />
                <span class="slider round"></span>
            </label>
            <label for="skill_flag">スキル・資格</label>
        </div>
        <div class="section-inner-con">
            <input type="text" class="m-form-control mb-30" id="skill" name="skill" placeholder="スキル" value="{{ $skill }}" />
            <button class="save-btn" data-type="sns-skill">Save</button>
        </div>
    </div>
    <div class="sns-section section-con {{ !empty($sns_flag) ? 'active' : '' }}">
        <div class="section-enable-flag">
            <label class="switch">
                <input type="checkbox" class="flag-checkbox" id="sns_flag" name="sns_flag" value="sns_flag"  {{ !empty($sns_flag) ? 'checked' : '' }} />
                <span class="slider round"></span>
            </label>
            <label for="sns_flag">SNS・Web・HP・電話番号・メールアドレス</label>
        </div>
        <div class="section-inner-con mb-30">
            <div class="sns-section-con">
                <ul class="enabled-sns-list">
                    @foreach ($sns_arr as $item)
                        <li class="sns-li-{{ $item['id'] }} inc-icon">
                            <div class="sns-item">
                                <div class="sns-item__img">
                                    <img src="{{ url($item['icon_path']) }}" alt="{{ $item['name'] }}" />
                                </div>
                                <div class="sns-item__desc">
                                    <span class="sns-item__desc--ttl">{{ $item['name'] }}</span>
                                    <span class="sns-item__desc--info">{{ $item['value'] }}</span>
                                    <input type="hidden" name="{{ $item['id'] }}" id="{{ $item['id'] }}" data-name="{{ $item['name'] }}" value="{{ $item['value'] }}" />
                                </div>
                            </div>
                            <div class="edit-sc-item">
                                <img src="./images/edit.png" alt="edit" />
                            </div>
                            <div class="delete-sc-item" data-id="{{ $item['id'] }}">
                                <svg class="delete-sns" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-2x">
                                    <path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z" class=""></path>
                                </svg>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="new-sns-item mb-30">
                <div class="new-sns-item__type">
                    <select class="m-form-control" name="sns_type" id="sns_type">
                        @foreach ($socials_datas as $item)
                            <option value="{{ $item['id'] }}" data-name="{{ $item['name'] }}"  data-placeholder="{{ $item['placeholder'] }}" data-img="{{ $item['icon_path'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="new-sns-item__desc">
                    <input type="text" name="sns_desc" id="sns_desc" class="m-form-control" placeholder="ユーザーネームを入力してください。" />
                    <svg class="add-sns" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 0.5C6.1 0.5 0.5 6.1 0.5 13C0.5 19.9 6.1 25.5 13 25.5C19.9 25.5 25.5 19.9 25.5 13C25.5 6.1 19.9 0.5 13 0.5ZM19.25 14.25H14.25V19.25H11.75V14.25H6.75V11.75H11.75V6.75H14.25V11.75H19.25V14.25Z" fill="#8D909E"/>
                    </svg>                        
                </div>
            </div>
            <button class="save-btn" data-type="sns-btn">Save</button>
        </div>
    </div>
</main>

<style type="text/css">
    /*2022.05.27 correction*/
    main .photo-section__top-part--dropzone .dropzone-trigger-remove {
        background: #323232;
        position: absolute;
        top: calc(50% - 5px);
        right: -15px;
        padding: 0px 5px 5px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 9999;
    }

    @media screen and (max-width: 768px) {
        main .photo-section__top-part--rmv {
            right: 5px!important;
        }
    }

    main .photo-section__top-part--rmv {
        position: absolute;
        bottom: 0;
        right: 40px;
        background: #323232;
        color: #FFF;
        font-size: 14px;
        padding: 3px 10px;
        border-radius: 5px 5px 0 0;
        font-weight: 500;
        cursor: pointer;
    }


    main .photo-section__top-part--dropzone .dropzone-trigger {
      left: -15px;
      right: auto;
    }

</style>

<script>
    var current_selected_sns = [];
    var profile_photo = undefined;
    var cover_photo = undefined;

    Dropzone.autoDiscover = false;

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(document).ready(function () {
        current_selected_sns = [];

        @foreach ($sns_arr as $item)
            current_selected_sns.push("{{ $item['id'] }}");
        @endforeach

        profile_photo = new Dropzone("div#profile_photo", {
            url: "{{ route('profile.update.image') }}",
            maxFiles: 1,
            dictDefaultMessage: "",
            //clickable: '.dropzone-trigger, .dropzone-trigger-01',
            clickable: '.dropzone-trigger',  //2022.05.27 correction
            thumbnailWidth: 150,
            thumbnailHeight: 150,

            init: function() {
                @if($photo_path != "")
                    var myDropzone = this;
                    var mockFile = { name: "image", 
                                    size: 0,
                                    imageUrl:'{{ asset("storage") }}' + '/{{ $photo_path }}'};

                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, '{{ asset("storage") }}' + '/{{ $photo_path }}');
                    myDropzone.files.push(mockFile);
                    myDropzone.files.length = 1;
                    
                    $(".dz-progress").css("display", "none");
                @endif

                this.on("maxfilesexceeded", function(file){
                    this.removeAllFiles();
                    this.addFile(file);
                });

         
                this.on("addedfile", function(event) {
                    if(this.files.length > 1) this.removeFile(this.files[0]);
                });

                this.on("sending", function(file, xhr, formData) {
                    // Append all the additional input data of your form here!
                    formData.append("_token", "{{ csrf_token() }}");
                });

                this.on("success", function(file, response) {
                    $('#photo_path').val(response.success);
                });
            }
        });

        //2022.05.27 correction
        $(".dropzone-trigger-remove").click(function(){
            let i;
            for ( i = 0; i < profile_photo.files.length; i++) {
                profile_photo.removeFile(profile_photo.files[i]);
            }
            $('#photo_path').val("");
        });


        cover_photo = new Dropzone("div#cover_photo_con", {
            url: "{{ route('profile.update.image') }}",
            maxFiles: 1,
            dictDefaultMessage: "",
            clickable: '.dropzone-cover-trigger',
            thumbnailWidth: 150,
            thumbnailHeight: 150,

            init: function() {
                @if($cover_path != "")
                    var myDropzone = this;
                    var mockFile = { name: "image", 
                                    size: 0,
                                    imageUrl:'{{ asset("storage") }}' + '/{{ $cover_path }}'};

                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, '{{ asset("storage") }}' + '/{{ $cover_path }}');
                    myDropzone.files.push(mockFile);
                    myDropzone.files.length = 1;
                    
                    $(".dz-progress").css("display", "none");
                @endif

                this.on("maxfilesexceeded", function(file){
                    this.removeAllFiles();
                    this.addFile(file);
                });

                this.on("addedfile", function(event) {
                    if(this.files.length > 1) this.removeFile(this.files[0]);
                });

                this.on("sending", function(file, xhr, formData) {
                    // Append all the additional input data of your form here!
                    formData.append("_token", "{{ csrf_token() }}");
                });

                this.on("success", function(file, response) {
                    $('#cover_path').val(response.success);

                    let cover_url = '{{ asset("storage") }}' + '/' + response.success;
                    $('main .photo-section__top-part').css('background-image', 'url(' + cover_url + ')');
                });
            }
        });

        //2022.05.27 correction
        $(".dropzone-cover-remove-trigger").click(function(){
            let i;
            for ( i = 0; i < cover_photo.files.length; i++) {
                cover_photo.removeFile(cover_photo.files[i]);
            }
            $('#cover_path').val("");
            $('main .photo-section__top-part').css('background-image', '');
        });

        $('.flag-checkbox').each(function(i, obj) {
            if($(this).is(':checked')) {
                $(this).closest(".section-con").addClass('active');
            } else {
                $(this).closest(".section-con").removeClass('active');
            }
        });
    });

    $(document).on('click', '.flag-checkbox', function() {
        let type = $(this).val();
        let status = 0;

        if($(this).is(':checked')) {
            $(this).closest(".section-con").addClass('active');
            status = 1;
        } else {
            $(this).closest(".section-con").removeClass('active');
        }

        setSocialFlag(type, status);
    });

    function setSocialFlag(type, status) {
        showLoader();

        jQuery.ajax({
            url: "{{ route('profile.update.flag') }}",
            dataType: 'json',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "type": type,
                "status": status
            },
            method: "POST",
            success: function(response) {
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('ajax error');
            },
            complete: function() {
                hideLoader();
            }
        });
    }

    function showLoader() {
        $(".loader").css("display", "block");
    }

    function hideLoader() {
        $(".loader").css("display", "none");
    }

    $(document).on('click', '.save-btn', function() {
        let type = $(this).attr('data-type');

        if(type != 'sns-btn') {
            let val_arr = {};

            $(this).closest(".section-con").find("input[type='text'], textarea").each(function(e) {
                val_arr[$(this).attr('name')] = $(this).val();
            });

            showLoader();

            jQuery.ajax({
                url: "{{ route('profile.update.property') }}",
                dataType: 'json',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "attrs": val_arr
                },
                method: "POST",
                success: function(response) {
                    console.log(response);

                    toastr.success('情報は正常に保存されました。');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ajax error');

                    toastr.warning('操作が失敗しました。もう一度試してください。');
                },
                complete: function() {
                    hideLoader();
                }
            });
        } else {
            let val_arr = {};
            let disp_order = 1;
            
            $(this).closest(".section-con").find("input[type='hidden']").each(function(e) {
                // val_arr[$(this).attr('name')] = $(this).val();
                val_arr[$(this).attr('name')] = {
                    'value': $(this).val(),
                    'disp_order': disp_order,
                }

                disp_order ++;
            });

            showLoader();

            jQuery.ajax({
                url: "{{ route('profile.update.sns.property') }}",
                dataType: 'json',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "attrs": val_arr
                },
                method: "POST",
                success: function(response) {
                    console.log(response);

                    toastr.success('情報は正常に保存されました。');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ajax error');

                    toastr.warning('操作が失敗しました。もう一度試してください。');
                },
                complete: function() {
                    hideLoader();
                }
            });
        }
    });

    $(document).on('change', '#sns_type', function() {
        let placeholder = $(this).find('option').filter(':selected').attr('data-placeholder');

        $(this).closest('.new-sns-item').find('input').attr('placeholder', placeholder);
    });
    
    $(document).on('click', '.add-sns', function() {
        let sns_id = $(this).closest('.new-sns-item').find('#sns_type').val();
        let sns_icon = $(this).closest('.new-sns-item').find('#sns_type option').filter(':selected').attr('data-img');
        let sns_name = $(this).closest('.new-sns-item').find('#sns_type option').filter(':selected').attr('data-name');
        let sns_val = $(this).closest('.new-sns-item').find('#sns_desc').val();

        updateSnsItemUI(sns_id, sns_icon, sns_name, sns_val);

        $('#sns_desc').val('');
    });

    function updateSnsItemUI(sns_id, sns_icon, sns_name, sns_val) {
        if(current_selected_sns.includes(sns_id)) {
            let html = `<div class="sns-item">
                            <div class="sns-item__img">
                                <img src="` + sns_icon + `" alt="` + sns_name + `" />
                            </div>
                            <div class="sns-item__desc">
                                <span class="sns-item__desc--ttl">` + sns_name + `</span>
                                <span class="sns-item__desc--info">` + sns_val + `</span>
                                <input type="hidden" data-name="` + sns_name + `"  name="` + sns_id + `" id="` + sns_id + `" value="` + sns_val + `" />
                            </div>
                        </div>
                        <div class="edit-sc-item">
                            <img src="./images/edit.png" alt="edit" />
                        </div>
                        <div class="delete-sc-item" data-id="` + sns_id + `">
                            <svg class="delete-sns" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-2x">
                                <path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z" class=""></path>
                            </svg>
                        </div>`;

            $('.sns-li-' + sns_id).html(html);
        } else {
            let html = `<li class="sns-li-` + sns_id + ` inc-icon">
                    <div class="sns-item">
                        <div class="sns-item__img">
                            <img src="` + sns_icon + `" alt="` + sns_name + `" />
                        </div>
                        <div class="sns-item__desc">
                            <span class="sns-item__desc--ttl">` + sns_name + `</span>
                            <span class="sns-item__desc--info">` + sns_val + `</span>
                            <input type="hidden" name="` + sns_id + `" data-name="` + sns_name + `" id="` + sns_id + `" value="` + sns_val + `" />
                        </div>
                    </div>
                    <div class="edit-sc-item">
                        <img src="./images/edit.png" alt="edit" />
                    </div>
                    <div class="delete-sc-item" data-id="` + sns_id + `">
                        <svg class="delete-sns" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-2x">
                            <path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z" class=""></path>
                        </svg>
                    </div>
                </li>`;

            $('.enabled-sns-list').append(html);

            current_selected_sns.push(sns_id);
        }
    }

    $(document).on('click', '.edit-sc-item', function() {
        let id = $(this).closest('.inc-icon').find('input[type="hidden"]').attr('id');
        let name = $(this).closest('.inc-icon').find('input[type="hidden"]').attr('data-name');
        let val = $(this).closest('.inc-icon').find('input[type="hidden"]').val();

        addEditUI(id, name, val);
        // $('#sns_type').val(id);
        // $('#sns_desc').val(val);
    });

    function addEditUI(id, name, val) {
        let html = `<li class="sns-li-edit" data-id="`+id+`">
                        <div class="new-sns-item mb-30">
                            <div class="new-sns-item__type">
                                <input type="text" class="m-form-control" name="edit_sns_type" id="edit_sns_type" value="`+name+`" readonly />
                            </div>
                            <div class="new-sns-item__desc">
                                <input type="text" class="m-form-control edit-sns-desc" value="`+val+`" />
                                <svg class="edit-sns" data-id="`+id+`" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 0.5C6.1 0.5 0.5 6.1 0.5 13C0.5 19.9 6.1 25.5 13 25.5C19.9 25.5 25.5 19.9 25.5 13C25.5 6.1 19.9 0.5 13 0.5ZM19.25 14.25H14.25V19.25H11.75V14.25H6.75V11.75H11.75V6.75H14.25V11.75H19.25V14.25Z" fill="#8D909E"/>
                                </svg>                            
                            </div>
                        </div>
                    </li>`;

        $('li.sns-li-' + id).find('.edit-sc-item').css('display', 'none');
        $('li.sns-li-' + id).find('.delete-sc-item').css('display', 'inline-block');

        $('li.sns-li-' + id).after(html);
    }

    $(document).on('click', '.delete-sc-item', function() {
        let data_id = $(this).attr('data-id');

        $('.sns-li-edit[data-id="'+data_id+'"]').remove();
        $('.sns-li-'+data_id).remove();

        removeItemOnce(data_id);
    });

    $(document).on('click', '.edit-sns', function() {
        let data_id = $(this).attr('data-id');
        let value = $(this).parent().find('input.edit-sns-desc').val();

        $('.sns-li-'+data_id).find('.sns-item__desc input').val(value);
        $('.sns-li-'+data_id).find('.sns-item__desc .sns-item__desc--info').html(value);

        $('.sns-li-'+data_id).find('.edit-sc-item').css('display', 'inline-block');
        $('.sns-li-'+data_id).find('.delete-sc-item').css('display', 'none');

        $(this).closest('li.sns-li-edit').remove();
    });

    function removeItemOnce(value) {
        var index = current_selected_sns.indexOf(value);
        if (index > -1) {
            current_selected_sns.splice(index, 1);
        }

        return current_selected_sns;
    }
</script>
@endsection
