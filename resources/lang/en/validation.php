<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを受け入れる必要があります。',
    'accepted_if' => ':otherが:valueの場合、:attributeを受け入れる必要があります。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:dateの後の日付である必要があります。',
    'after_or_equal' => ':attributeは:date以降の日付である必要があります。',
    'alpha' => ':attributeには文字のみを含める必要があります。',
    'alpha_dash' => ':attributeには、文字、数字、ダッシュ、アンダースコアのみを含める必要があります。',
    'alpha_num' => ':attributeには文字と数字のみを含める必要があります。',
    'array' => ':attributeは配列でなければなりません。',
    'before' => ':attributeは:dateより前の日付である必要があります。',
    'before_or_equal' => ':attributeは:date以前の日付である必要があります。',
    'between' => [
        'numeric' => ':attributeは:minと:maxの間にある必要があります。',
        'file' => ':attributeは:minから:maxキロバイトの間でなければなりません。',
        'string' => ':attributeは:min文字と:max文字の間にある必要があります。',
        'array' => ':attributeは:minと:maxの間にある必要があります。',
    ],
    'boolean' => ':attributeフィールドはtrueまたはfalseである必要があります。',
    'confirmed' => ':属性の確認が一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeは:dateと等しい日付である必要があります。',
    'date_format' => ':attributeがフォーマット:formatと一致しません。',
    'different' => ':attributeと:otherは異なっている必要があります。',
    'digits' => ':attributeは:digits Digitsである必要があります。',
    'digits_between' => ':attributeは:minと:maxの数字の間でなければなりません。',
    'dimensions' => ':attributeの画像の寸法が無効です。',
    'distinct' => ':attributeフィールドの値が重複しています。',
    'email' => ':attributeは有効な電子メールアドレスである必要があります。',
    'ends_with' => ':attributeは:value以上である必要があります。',
    'exists' => '選択した:attributeは無効です。',
    'file' => ':attributeはファイルである必要があります。',
    'filled' => ':attributeフィールドには値が必要です。',
    'gt' => [
        'numeric' => ':attributeは:valueより大きくなければなりません。',
        'file' => ':attributeは:valueキロバイトより大きくなければなりません。',
        'string' => ':attributeは:value文字より大きくなければなりません。',
        'array' => ':attributeには:value以上のアイテムが必要です。',
    ],
    'gte' => [
        'numeric' => ':attributeは:value以上である必要があります。',
        'file' => ':attributeは:valueキロバイト以上である必要があります。',
        'string' => ':attributeは:value文字以上である必要があります。',
        'array' => ':attributeには:value項目以上が必要です。',
    ],
    'image' => ':attributeは画像である必要があります。',
    'in' => '選択した:attributeは無効です。',
    'in_array' => ':attributeフィールドは:otherに存在しません。',
    'integer' => ':attributeは整数でなければなりません。',
    'ip' => ':attributeは有効なIPアドレスである必要があります。',
    'ipv4' => ':attributeは有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attributeは有効なIPv6アドレスである必要があります。',
    'json' => ':attributeは有効なJSON文字列である必要があります。',
    'lt' => [
        'numeric' => ':attributeは:valueより小さくなければなりません。',
        'file' => ':attributeは:valueキロバイト未満である必要があります。',
        'string' => ':attributeは:value文字未満である必要があります。',
        'array' => ':attributeには:value未満のアイテムが必要です。',
    ],
    'lte' => [
        'numeric' => ':attributeは:value以下である必要があります。',
        'file' => ':attributeは:valueキロバイト以下である必要があります。',
        'string' => ':attributeは:value文字以下である必要があります。',
        'array' => ':attributeには:value項目を超えてはなりません。',
    ],
    'max' => [
        'numeric' => ':attributeは:maxより大きくてはなりません。',
        'file' => ':attributeは:maxキロバイトを超えてはなりません。',
        'string' => ':attributeは:max文字より大きくてはなりません。',
        'array' => ':attributeには:maxを超えるアイテムを含めることはできません。',
    ],
    'mimes' => ':attributeは、タイプ: :valuesのファイルである必要があります。',
    'mimetypes' => ':attributeはタイプ: :valuesのファイルである必要があります。',
    'min' => [
        'numeric' => ':attributeは少なくとも:minである必要があります。',
        'file' => ':attributeは少なくとも:minキロバイトでなければなりません。',
        'string' => ':attributeは少なくとも:min文字である必要があります。',
        'array' => ':attributeには少なくとも:minアイテムが必要です。',
    ],
    'multiple_of' => ':attributeは:valueの倍数でなければなりません。',
    'not_in' => '選択した:attributeは無効です。',
    'not_regex' => ':attribute形式が無効です。',
    'numeric' => ':attributeは数値でなければなりません。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attributeフィールドが存在する必要があります。',
    'regex' => ':attribute形式が無効です。',
    'required' => ':attributeフィールドは必須です。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesにない限り、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'prohibited' => ':attributeフィールドは禁止されています。',
    'prohibited_if' => ':otherが:valueの場合、:attributeフィールドは禁止されます。',
    'prohibited_unless' => ':otherが:valuesにない限り、:attributeフィールドは禁止されています。',
    'prohibits' => ':attributeフィールドは:otherの存在を禁止します。',
    'same' => ':attributeと:otherは一致する必要があります。',
    'size' => [
        'numeric' => ':attributeは:sizeでなければなりません。',
        'file' => ':attributeは:sizeキロバイトでなければなりません。',
        'string' => ':attributeは:size文字である必要があります。',
        'array' => ':attributeには:sizeアイテムが含まれている必要があります。',
    ],
    'starts_with' => ':attributeは次のいずれかで始まる必要があります: :values。',
    'string' => ':attributeは文字列である必要があります。',
    'timezone' => ':attributeは有効なタイムゾーンである必要があります。',
    'unique' => ':attributeはすでに取得されています。',
    'uploaded' => ':attributeはアップロードに失敗しました。',
    'url' => ':attributeは有効なURLである必要があります。',
    'uuid' => ':attributeは有効なUUIDである必要があります。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
