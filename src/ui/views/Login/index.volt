{{ form('login/start') }}
    <fieldset>
        <label for="username">Username</label>
        <div>
            {{ text_field('username') }}
        </div>
        <label for="password">Password</label>
        <div>
            {{ password_field('password') }}
        </div>
        <div>
            {{ submit_button('Login') }}
        </div>
    </fieldset>
{{ endform() }}