@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => url(adminURL('admin/reset/password/'.$data['token']))])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
