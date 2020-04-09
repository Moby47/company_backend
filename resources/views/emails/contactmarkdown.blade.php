@component('mail::message')

@component('mail::panel')
{{$sendermsg}}
@endcomponent

Thanks,<br>
{{$sendername}}
@endcomponent
