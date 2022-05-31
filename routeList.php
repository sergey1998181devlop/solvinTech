+--------+----------+---------------------------+------+------------------------------------------------------------+--------------------------------------------+
| Domain | Method   | URI                       | Name | Action                                                     | Middleware                                 |
+--------+----------+---------------------------+------+------------------------------------------------------------+--------------------------------------------+
|        | GET|HEAD | /                         |      | Closure                                                    | web                                        |
|        | POST     | api/auth/login            |      | App\Http\Controllers\AuthController@login                  | api                                        |
|        | POST     | api/auth/logout           |      | App\Http\Controllers\AuthController@logout                 | api                                        |
|        |          |                           |      |                                                            | App\Http\Middleware\Authenticate:api       |
|        | POST     | api/auth/me               |      | App\Http\Controllers\AuthController@me                     | api                                        |
|        |          |                           |      |                                                            | App\Http\Middleware\Authenticate:api       |
|        | POST     | api/auth/quotation/{data} |      | App\Http\Controllers\Cbr\CbrController@checkCbr            | api                                        |
|        |          |                           |      |                                                            | Tymon\JWTAuth\Http\Middleware\Authenticate |
|        | POST     | api/auth/refresh          |      | App\Http\Controllers\AuthController@refresh                | api                                        |
|        |          |                           |      |                                                            | App\Http\Middleware\Authenticate:api       |
|        | POST     | api/auth/registration     |      | App\Http\Controllers\AuthController@registration           | api                                        |
|        | GET|HEAD | api/user                  |      | Closure                                                    | api                                        |
|        |          |                           |      |                                                            | App\Http\Middleware\Authenticate:sanctum   |
|        | GET|HEAD | sanctum/csrf-cookie       |      | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                        |
+--------+----------+---------------------------+------+------------------------------------------------------------+--------------------------------------------+
