<?php
$config = [
    'database_env' => [
        'server_name' => 'localhost',
        'user_name' => 'root',
        'passwork' => '',
        'db_name' => 'simple_news_website'
    ],
    'routes' => [
        // test routes
        '/test' => '/Test/customer.php',
        '/admin/test' => '/Test/admin.php',
        '/superadmin/test' => '/Test/super_admin.php',

        // customer routes
        '/' => __DIR__ . '/view/customer/index.php',
        '/signup' => __DIR__ . '/view/customer/sign_up_form.php',
        '/login' => __DIR__ . '/view/customer/login_form.php',
        '/post' => __DIR__ . '/view/customer/post_details.php',
        '/signupProcess' => __DIR__ . '/customer/sign_up_process.php',
        '/loginProcess' => __DIR__ . '/customer/login_process.php',
        '/logoutProcess' => __DIR__ . '/customer/logout_process.php',

        // admin routes
        '/admin/' => __DIR__ . '/view/admin/index.php',
        '/admin/login' => __DIR__ . '/view/admin/login_form.php',
        '/admin/loginProcess' => __DIR__ . '/admin/login_process.php',
        '/admin/logoutProcess' => __DIR__ . '/admin/logout_process.php',
    ]
];
