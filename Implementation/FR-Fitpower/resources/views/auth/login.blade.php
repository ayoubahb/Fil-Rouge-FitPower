<x-layout-user>
    <div class="flex justify-center my-14">
        <div class="max-w-xl w-11/12 p-10 text-black">
            <div class="mb-10">
                <p class="text-4xl font-bold text-center mb-4">Login</p>
                <p class="text-center">Please enter your email and password to access your account</p>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>



                <div class="flex items-center justify-end mt-6">
                    <button class="w-full border border-black p-2">
                        Login
                    </button>
                </div>
                <p class="text-center mt-3">You do not have an account ? <a href="/register" class="text-mainColor">Register<a /></p>
            </form>
        </div>
    </div>
    
</x-layout-user>
