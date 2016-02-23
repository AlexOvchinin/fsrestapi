<!DOCTYPE html>
<html>
    <head>
        <title>fsrestapi client</title>
    </head>
    <body>
        {{ form('login/logout') }}
            {{ submit_button('Logout') }}
        {{ endform() }}
        {{ form(files/deleteFile) }}
            <table>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                {% for item in items %}
                    <tr>
                        <td>{{ loop.index }}</td>
                        <td>{{ item }}</td>
                        <td> {{ submit_button('Login') }}</td>
                    </tr>
                {% endfor %}
            </table>
        {{ endform() }}
        {% if result is defined %}
            <textarea rows = "5" cols = "50">
                {{ result }}
            </textarea>
        {% endif %}
    </body>
</html>