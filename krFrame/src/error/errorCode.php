<?php
    namespace krFrame\src\error;

    final class errorCode
    {
        private static function code($code)
        {
            $tab = array(
                1 => 'Don\'t found settings.json file.',
                2 => 'Syntax error in settings.json file.',
                3 => 'Error in settings.json - "widgets" - don\'t have "name"',
                4 => 'Error in settings.json - "widgets" - don\'t have "before_widget"',
                5 => 'Error in settings.json - "widgets" - don\'t have "after_widget"',
                6 => 'Error in settings.json - "widgets" - don\'t have "before_title"',
                7 => 'Error in settings.json - "widgets" - don\'t have "after_title"',
                8 => 'Error in settings.json - "widgets" - don\'t see widgets array',
                9 => 'Error in settings.json - "menu" - don\'t see menu array',
                10 => 'Error in settings.json - "thumbnail" - don\'t see thumbnail array',
                11 => 'Error in settings.json - "thumbnail" - don\'t see thumbnail width',
                12 => 'Error in settings.json - "thumbnail" - don\'t see thumbnail height',
                13 => 'Error in settings.json - "thumbnail" - don\'t see thumbnail name',
                14 => 'Error in settings.json - "thumbnail" - don\'t see thumbnail crop',
                15 => 'Error in settings.json - "custom-post-type" - check settings',
                16 => 'Error in settings.json - "taxonomies" - check settings',
            );
            return $tab[$code];
        }

        public static function view($code)
        {
            return self::code($code);
        }
    }
