@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::panel')
届いたフレンドコードはこちらです！！
{{ $friend_code }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
