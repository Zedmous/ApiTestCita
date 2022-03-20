
## Acerca de la app
Paso 1 Realizar las migraciones correspondientes junto a los seed
    php artisan migrate:fresh --seed
Paso 2 ejecutar el comando 
    php artisan serve
Pase 3 Loguearse usando los usuarios registrados
                'name' => 'admin',
                'username' => 'admin',
                'password' => '12345678'

                'name' => 'sinacceso',
                'username' => 'sinacceso',
                'password' => '12345678'
     
                'name' => 'Eduardo',
                'username' => 'zedmous',
                'password' => '8565203'
Paso 4 Ruta endpoint para login
    http://127.0.0.1:8000/api/auth/login
    Debe retornar algo como esto
    {
    "data": {
        "user": {
            "id": 1,
            "name": "admin",
            "username": "admin",
            "created_at": "2022-03-20T22:47:02.000000Z",
            "updated_at": "2022-03-20T22:47:02.000000Z"
        },
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY0NzgxNzY5NSwiZXhwIjoxNjQ3ODIxMjk1LCJuYmYiOjE2NDc4MTc2OTUsImp0aSI6InQ4Ykg4WHJTc2RTTlRuclciLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.wqKhI23Ng9prEku_wLmRbQ9bxY4jg00lBhg_KgoCzcg",
        "token_type": "bearer",
        "expires_in": 180000
    }
}
Alli se puede obtener el token y demas cosas para la app