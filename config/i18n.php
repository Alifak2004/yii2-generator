<?php

return [
  'languages' => ['en', 'ar'], // Specify the supported languages here
  'translations' => [
    'app*' => [
      'class' => 'yii\i18n\PhpMessageSource',
      'basePath' => '@app/messages',
      'sourceLanguage' => 'en',
      'fileMap' => [
        'app' => 'app.php',
        'app_ar' => 'app.php', // Arabic translation file
      ],
    ],
  ],
];
