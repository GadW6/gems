<div id="loginDiv" class="-mt-20 fixed hidden top-0 w-screen z-30" style="background-color: rgba(0, 0, 0, 0.35); height: -webkit-fill-available;">
    <div id="loginChild" class="bg-white border border-gray-500 md:w-1/2 mt-32 mx-auto p-8 sm:mt-40 sm:w-2/3 w-9/12 z-10" style="max-height: 85vh; overflow: auto;">
        <a id="closeLogin" class="-mt-4 cursor-pointer float-right hover:text-black text-gray-800 text-xl">X</a>
        <div class="modal">
            <div id="login-wrap" class="block">
                <h2 class="font-light mb-8 text-2xl text-center text-gray-800">Sign in</h2>
                <form action="{{ url('/user/signin') }}" method="POST" id="signin" autocomplete="off" novalidate="novalidate">
                    @csrf
                    <span id="em-cred-signin" class="block font-thin mx-auto text-center text-red-600 text-sm w-3/4"></span>

                    <p class="my-4">
                        <label class="block font-thin mb-2 text-gray-700" for="email">Email address
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="block border border-gray-500 input-text p-2 w-full font-thin text-gray-900" name="email"
                            id="signin_email" value="" autofocus>
                        <span id="em-email-signin" class="font-thin text-red-600 text-sm"></span>
                    </p>
                    <p class="my-4">
                        <label class="block font-thin mb-2 text-gray-700" for="password">Password
                            <span class="text-red-500">*</span>
                        </label>
                        <input class="block border border-gray-500 input-text p-2 w-full font-thin text-gray-900" type="password"
                            name="password" id="signin_password">
                        <span id="em-password-signin" class="font-thin text-red-600 text-sm"></span>
                    </p>
                    <p class="">
                        <label class="font-thin inline text-gray-700">
                            <input class="" name="rememberme" type="checkbox" id="rememberme" value="forever">
                            <span>Remember me</span>
                        </label>
                        <span class="font-thin inline text-gray-700 float-right">
                            <a href="#">Lost your password?</a>
                        </span>
                    </p>
                    <p class="my-4">
                        <button type="submit" onclick="formSend(event)"
                            class="bg-gray-900 border font-light hover:bg-gray-800 py-3 text-white w-full"
                            name="login">Signin</button>
                    </p>
                    <div class="text-center">
                        <span class="font-thin text-gray-700">Or</span>
                    </div>
                    <p class="my-4">
                        <button id="registerBtn" type="button"
                            class="border border-gray-500 font-thin hover:border-gray-600 py-2 text-gray-700 w-full"
                            name="register">Create an
                            account</button>
                    </p>
                </form>
            </div>
            <div id="register-wrap" class="hidden">
                <h2 class="font-light mb-8 text-2xl text-center text-gray-800">Register</h2>
                <form action="{{ url('/user/register') }}" method="POST" id="register" autocomplete="off" novalidate="novalidate">
                    @csrf
                    <p class="my-4">
                        <label class="block font-thin mb-2 text-gray-700" for="username">Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="block border border-gray-500 input-text p-2 w-full font-thin text-gray-900" name="username"
                            id="register_username" value="">
                        <span id="em-name-register" class="font-thin text-red-600 text-sm"></span>
                    </p>
                    <p class="my-4">
                        <label class="block font-thin mb-2 text-gray-700" for="email">Email address
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="block border border-gray-500 input-text p-2 w-full font-thin text-gray-900" name="email"
                            id="register_email" value="" autofocus>
                        <span id="em-email-register" class="font-thin text-red-600 text-sm"></span>
                    </p>
                    <p class="my-4">
                        <label class="block font-thin mb-2 text-gray-700" for="password">Password
                            <span class="text-red-500">*</span>
                        </label>
                        <input class="block border border-gray-500 input-text p-2 w-full font-thin text-gray-900" type="password"
                            name="password" id="register_password">
                        <span id="em-password-register" class="font-thin text-red-600 text-sm"></span>
                    </p>
                    <p class="my-4">
                    <button type="submit" onclick="formSend(event)"
                            class="bg-gray-900 border font-light hover:bg-gray-800 py-3 text-white w-full"
                            name="login">Register</button>
                    </p>
                    <div class="text-center">
                        <span class="font-thin text-gray-700">Or</span>
                    </div>
                    <p class="my-4">
                        <button id="loginBtn" type="button"
                            class="border border-gray-500 font-thin hover:border-gray-600 py-2 text-gray-700 w-full"
                            name="register">Signin</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@section('jsdependancy')
  @parent
    <script>
        const formSend = (e) => {
            e.preventDefault();
            const formClosest = e.target.closest('form')
            if(formClosest.id === 'register'){
                axios.post("{{ url('/user/register') }}", {
                    name: formClosest.querySelector('#register_username').value,
                    email: formClosest.querySelector('#register_email').value,
                    password: formClosest.querySelector('#register_password').value
                }).then(function (response) {
                        const res = response.data
                        if ( res === 'Register successful' ) {
                            return window.location.reload()
                        }
                    })
                    .catch(function (error) {
                        const res = error.response
                        const dest = res.config.url.split('/').reverse()[0]
                        for (const [key, value] of Object.entries(res.data.errors)) {
                            const element = document.querySelector(`#em-${key}-${dest}`)
                            element.innerText = value
                            element.previousElementSibling.classList.remove('border-gray-500')
                            element.previousElementSibling.classList.add('border-red-500')
                        }
                    })
            } else if (formClosest.id === 'signin') {
                axios.post("{{ url('/user/signin') }}", {
                    email: formClosest.querySelector('#signin_email').value,
                    password: formClosest.querySelector('#signin_password').value
                }).then(function (response) {
                        const res = response.data
                        if ( res === 'Signin successful' ) {
                            return window.location.reload()
                        }
                    })
                    .catch(function (error) {
                        const res = error.response
                        if (res.data.message === 'View [signin] not found.') {
                            const element = document.querySelector('#em-cred-signin')
                            return element.innerHTML = `Wrong credentials for ${formClosest.querySelector('#signin_email').value}. <p>Make sure email and password are correct.</p>`
                        }
                        const dest = res.config.url.split('/').reverse()[0]
                        for (const [key, value] of Object.entries(res.data.errors)) {
                            const element = document.querySelector(`#em-${key}-${dest}`)
                            element.innerText = value
                            element.previousElementSibling.classList.remove('border-gray-500')
                            element.previousElementSibling.classList.add('border-red-500')
                        }
                    })
            }
        }
    </script>
    <script src="{{ asset('/js/login.js') }}"></script>
@endsection
