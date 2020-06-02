@if (session()->has('success'))
<div class="alert alert-success">
    <button class="close" data-dismiss="alert">&times;</button>
    <p class="mb-0">{!! session()->get('success') !!}</p>
</div>
@endif
