<?php

namespace Epigra\NovaSettings;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaSettingsTool extends Tool
{
    protected static $fields = [];

    public function boot()
    {
        Nova::script('nova-settings', __DIR__.'/../dist/js/tool.js');
    }

    public function renderNavigation()
    {
        return view('novasettings::navigation');
    }

    /**
     * Define settings fields.
     *
     * @param array|callable $fields Array of fields/panels to be displayed or callable that returns an array.
     **/
    public static function addSettingsFields($fields = [])
    {
        if (is_callable($fields)) {
            $fields = [$fields];
        }
        self::$fields = array_merge(self::$fields, $fields ?? []);
    }

    public static function getFields()
    {
        $rawFields = array_map(function ($fieldItem) {
            return is_callable($fieldItem) ? call_user_func($fieldItem) : $fieldItem;
        }, self::$fields);

        $fields = [];
        foreach ($rawFields as $rawField) {
            if (is_array($rawField)) {
                $fields = array_merge($fields, $rawField);
            } else {
                $fields[] = $rawField;
            }
        }

        return $fields;
    }
}
