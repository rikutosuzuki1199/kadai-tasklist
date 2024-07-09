@if (isset($errors)>0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-error mb-4">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inl" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    {{ $error }}
                </div>
            </div>
        @endforeach
@endif