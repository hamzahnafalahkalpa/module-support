<?php

use Hanafalah\ModuleSupport\{
    Models as ModuleSupportModels,
    Commands as ModuleSupportCommands,
    Contracts
};

return [
    'namespace' => 'Hanafalah\\ModuleSupport',
    'app' => [
        'contracts' => [
        ],
    ],
    'commands'  => [
        ModuleSupportCommands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources'
    ],
    'database' => [
        'models' => [
        ]
    ]
];
