@extends('layouts.app')

@section('content')
<main>
    <div class="login-menu">
        @auth
            <div class="login-menu__item l-child">
                <a href="{{ route('profile.get') }}">
                    <span>プロファイル編集</span>
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
        @endauth

        @guest
            <div class="login-menu__item">
                <a href="{{ route('login') }}">
                    <span>{{ __('login.login') }}</span>
                    <img src="{{ asset('images/login.png') }}" alt="ログイン">
                </a>
            </div>
        @endguest
    </div>
    <div class="photo-section section-con active">
        @if(!@empty($cover_path))
            <div class="photo-section__top-part" style="background-image: url('{{ asset('storage/' . $cover_path) }}')">
        @else
            <div class="photo-section__top-part">    
        @endif
            <div class="profile-photo">
                @if(!empty($photo_path))
                    <img src="{{ asset("storage") . '/' . $photo_path }}" alt="{{ $name }}" />
                @endif
            </div>
        </div>
        <div class="photo-section__bottom-part section-inner-con">
            <div class="view-item">
                <p class="profile-name">{{ $name }}</p>
                <p>{{ $title }}</p>
                <p class="profile-intro">{{ $intro }}</p>
            </div>
            @if(!empty($company) || !empty($director))
            <div class="view-item">
                <p class="view-item_txt">{{ $company }}</p>
                <p class="view-item_txt">{{ $director }}</p>
            </div>
            @endif
            @if(!empty($edu) || !empty($major))
            <div class="view-item">
                <p class="view-item_txt">{{ $edu }}</p>
                <p class="view-item_txt">{{ $major }}</p>
            </div>
            @endif
            @if(!empty($address))
            <div class="view-item">
                <p class="view-item_txt">{{ $address }}</p>
            </div>
            @endif
            @if(!empty($skill))
            <div class="view-item">
                <p class="view-item_txt">{{ $skill }}</p>
            </div>
            @endif
        </div>
    </div>
    
    <div class="sns-section sns-profile-section section-con">
        <div class="sns-profile-top-btn">
            <div class="sns-arrow-down">
                <img src="{{url('/images/social-arrow-down.png')}}" alt="arrow-down">
            </div>
            <span>Download</span>
        </div>
        <div class="sns-section-con">
            <ul>
                @foreach ($sns_arr as $item)
                    <li class="inc-icon">
                        <?php if(!empty($item['base_url'])) { ?>
                        <a href="<?php echo $item['base_url'] . $item['value']; ?>">
                        <?php } elseif(strtolower($item['name']) == 'website') { ?>
                            <a href="<?php echo $item['value']; ?>">
                        <?php } elseif($item['name'] == '名刺管理アプリ') { ?>
                            <a class="jp-txt" href="<?php echo $item['value']; ?>">
                        <?php } elseif(strtolower($item['name']) == 'line') { ?>
                            <?php 
                                // if(strpos($item['value'], '/lin.ee/') === false) { 
                                if(false) {
                            ?>
                                
                            <?php } else { ?>
                                <a href="<?php echo $item['value']; ?>">
                            <?php } ?>
                        <?php } ?>
                            <div class="sns-item">
                                <div class="sns-item__img">
                                    <img src="{{ url($item['icon_path']) }}" alt="{{ $item['name'] }}" />
                                </div>
                                <div class="sns-item__desc">
                                    <span class="sns-item__desc--ttl">{{ $item['name'] }}</span>
                                    <span class="sns-item__desc--info">{{ $item['value'] }}</span>
                                </div>
                            </div>
                            <div class="edit-sc-item arrow-item">
                                <img src="{{url('/images/social-arrow.png')}}" alt="arrow" />
                            </div>
                        <?php if(!empty($item['base_url']) || $item['name'] == '名刺管理アプリ' || strtolower($item['name']) == 'website' || (strtolower($item['name']) == 'line' && strpos($item['value'], '/lin.ee/') !== false)) { ?>
                        </a>
                        <?php }?>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</main>

<form id="vcf_down_form" method="post" target="vcf_down_frame" action="{{ route('profile.download') }}">
    @csrf
    <input type="hidden" name="user_id" id="user_id" value="" />
</form>
<iframe name="vcf_down_frame" id="vcf_down_frame" style="display: none;">
</iframe>

<script>
    $(document).on('click', '.sns-profile-top-btn', function() {
        let user_id = '{{ $user_id }}';

        $('#user_id').val(user_id);
        $('#vcf_down_form').submit();
    });
</script>
@endsection