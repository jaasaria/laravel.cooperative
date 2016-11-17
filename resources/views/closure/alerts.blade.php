
@if (session('success'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
@endif


{{-- @if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif --}}




{{-- Documentation plese visit this link 
https://github.com/laracasts/flash --}}
