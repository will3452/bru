<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API DOCS</title>
    <style>
        pre {
            background: #000;
        }
        code{
            background: #000;
            color:rgb(33, 248, 33);
            /* padding: 10px; */
        }
        .block{
            margin-bottom:50px;
        }
    </style>
</head>
<body>
    <h1>API v1</h1>
    <div class="block">
        <h2>Base Url</h2>
        <div>
            
            <code>https:://brumultiverse.ml/api/v1</code>
        </div>    
    </div> 
    
    <div class="block">
        <h2>
            Login/POST
        </h2>
        <div>
            <code>
                /login
            </code>
        </div>
        <h4>Params</h4>
        <div>
            <pre>
                <code>
                    "email": [
                        "The email field is required."
                    ],
                    "password": [
                        "The password field is required."
                    ]
                </code>
            </pre>
        </div>
        <h4>Return Value</h4>
        <div>
            <pre>
                <code>
                    {
                        "user": {
                            "id": 3,
                            "aan_id": null,
                            "aan_string": null,
                            "first_name": "user api",
                            "last_name": "user api",
                            "picture": null,
                            "role": "student",
                            "vip": null,
                            "email": "userapi@gmail.com",
                            "email_verified_at": null,
                            "disabled": null,
                            "created_at": "2021-06-26T15:47:02.000000Z",
                            "updated_at": "2021-06-26T15:47:02.000000Z"
                        },
                        "token": "3|FetYeG8NaKVrYdm2zyijffKEknKluViCbPQCC38g"
                    }
                </code>
            </pre>
        </div>
        <div>
            <em>
                the token should be included in the Authorization header as a Bearer token.
            </em>
        </div>
    </div>
    <div class="block">
        <h2>Register/POST</h2>
        <div>
            <code>
                /register
            </code>
        </div>
        <h4>Params</h4>
        <div>
            <pre>
                <code>
                    "last_name": [
                        "The last name field is required."
                    ],
                    "first_name": [
                        "The first name field is required."
                    ],
                    "email": [
                        "The email field is required."
                    ],
                    "password": [
                        "The password field is required."
                    ],
                    "sex": [
                        "The sex field is required."
                    ],
                    "gender": [
                        "The gender field is required."
                    ],
                    "college": [
                        "The college field is required."
                    ],
                    "course": [
                        "The course field is required."
                    ],
                    "club": [
                        "The club field is required."
                    ],
                    "country": [
                        "The country field is required."
                    ],
                    "city": [
                        "The city field is required."
                    ],
                    "birthdate": [
                        "The birthdate field is required."
                    ]
                </code>
            </pre>
        </div>
        <h4>Return Value</h4>
        <div>
            <pre>
                <code>
                    {
                        "user": {
                            "last_name": "user api",
                            "first_name": "user api",
                            "email": "sampleemail@gmail.com",
                            "role": "student",
                            "updated_at": "2021-06-26T16:36:40.000000Z",
                            "created_at": "2021-06-26T16:36:40.000000Z",
                            "id": 4
                        },
                        "token": "4|RawghnDdqq8MIooXDSOFuYmSkFDspehzcCSLv12t"
                    }
                </code>
            </pre>
        </div>
    </div>
    <div class="block">
        <h2>
            test/GET
        </h2>
        <div>
            <code>
                /test
            </code>
        </div>
        <h4>Return Value</h4>
        <div>
            <pre>
                <code>
                    {
                        "message": "you are authenticated"
                    }
                </code>
            </pre>
        </div>
        <div>
            <em>
                use this end-point to test if you are authenticated. (please include the generated token and pass it as bearer token)
            </em>
        </div>
    </div>

    <div class="block">
        <h2>
            Logout/POST
        </h2>
        <div>
            <code>
                /logout
            </code>
        </div>
        <h4>Return Value</h4>
        <div>
            <pre>
                <code>
                    {
                        "message": "Logged out"
                    }
                </code>
            </pre>
        </div>
        <div>
            <em>
                You can't logout if you're not authenticated yet ((please include the generated token and pass it as bearer token))
            </em>
        </div>
    </div>
    
</body>
</html>