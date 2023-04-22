<x-layout-user>
    <div class="flex justify-center my-14 max-w-xl w-11/12 mx-auto">
        <form method="POST" action="{{ route('register') }}" class="w-full">
            @csrf
            <div class="mb-10">
                <p class="text-4xl font-bold text-center mb-4">Register</p>
                <p class="text-center">Please fill out the form below to register for our services.</p>
            </div>
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex flex-col items-center justify-end mt-6">
                <button class="w-full border border-black p-2">
                    Register
                </button>
                <p class="text-center mt-3">Already have an account ? <a href="/login"
                        class="text-mainColor">Login<a /></p>
            </div>
        </form>
    </div>
</x-layout-user>
