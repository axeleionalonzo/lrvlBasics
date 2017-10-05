@if(count($errors->all())) {{-- handled by withErrors --}}
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li> {{-- validation errors are located @\resources\lang\en\validation --}}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif