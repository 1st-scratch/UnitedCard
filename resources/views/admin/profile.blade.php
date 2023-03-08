@extends('admin.layouts.default')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>プロフィール
                    <div class="page-title-subheading">
                        メールアドレスやパスワードを変更できます。
                    </div>
                </div>
            </div>
            <div class="page-title-actions"></div>
        </div>
    </div>
    <div class="page-content">
        <div class="main-card mb-3 card">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session()->get('message') }}</li>
                        </ul>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('admin.info.update') }}" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <div class="form-row mb-10">
                        <div class="col-md-3 mb-3">
                            <label for="name">名前<span class="red">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $name }}" required />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="email">Eメール<span class="red">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $email }}" required />
                        </div>
                    </div>
                    <div class="form-row mb-10">
                        <div class="col-md-3 mb-3">
                            <label for="current_password">現在のパスワード</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" value="" />
                        </div>
                    </div>
                    <div class="form-row mb-10">
                        <div class="col-md-3 mb-3">
                            <label for="new_password">新しいパスワード</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" value="" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="confirm_password">新しいパスワードの確認</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" />
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection