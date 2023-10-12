<?php

return [
    'model_defaults' => [
        'namespace'       => 'App\Models',
        'base_class_name' => \Illuminate\Database\Eloquent\Model::class,
        //'output_path'     => app_path('Models'),
        'output_path'     => 'Models',
    ],
    'db_types' => [
        'enum' => 'string',
    ],
];
