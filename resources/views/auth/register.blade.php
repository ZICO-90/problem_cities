<x-guest-layout>

<script>
    function ChooseFile()
    {

        // Change Images in Choose File
        var output = document.getElementById('imges');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        };

    };
</script>

    <x-auth-card>
        <x-slot name="logo">
            <img id="imges" class="w-20 h-20 fill-current text-gray-500"  src="{{asset('admindashboard/staticAvatar/Register.png')}}"  >
           
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="phone" :value="__('phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="numeric"  name="phone" maxlength="11" size="11"  :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-label for="ChooseCity" :value="__('City')" />
                {!!   Form::select('city_id',  isset($DropDwonCity) ?['' => 'City select'] + $DropDwonCity: ['' => 'list is empty']

                           ,  null , ['class' => 'block mt-1 w-full' ,'id' => 'ChooseCity' ] ,
                         [ '' => [ "disabled" => true ] ] ); !!}

            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
            <x-label for="FileUser" :value="__('avatar')" />
            {!! Form::file('avatar',['onchange' =>'ChooseFile()'  ,'accept'=>'image/*' , 'id' => 'FileUser' , 'class' => 'block mt-1 w-full']  )  !!}
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
