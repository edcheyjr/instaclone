@component('mail::message')
# Welcome to {{config('app.name')}} world

Thank you for joining our world.

Now we just need to confirm your account.

@component('mail::button', ['url' => ''])
Confirm
@endcomponent

have fun,<br>
CEO {{config('app.name')}} Name
@endcomponent
