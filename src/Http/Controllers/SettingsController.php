<?php

namespace Epigra\NovaSettings\Http\Controllers;

use Epigra\NovaSettings\NovaSettingsTool;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Contracts\Resolvable;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\ResolvesFields;

class SettingsController extends Controller
{
    use ResolvesFields, ConditionallyLoadsAttributes;

    public function get(Request $request)
    {
        $fields = $this->assignToPanels(__('Settings'), $this->availableFields());
        $panels = $this->panelsWithDefaultLabel(__('Settings'), app(NovaRequest::class));

        $addResolveCallback = function (&$field) {
            if (! empty($field->attribute)) {
                $setting = setting($field->attribute);
                $field->resolve([$field->attribute => isset($setting) ? $setting : '']);
            }

            if (! empty($field->meta['fields'])) {
                foreach ($field->meta['fields'] as $_field) {
                    $setting = setting($_field->attribute);
                    $_field->resolve([$_field->attribute => isset($setting) ? $setting : '']);
                }
            }
        };

        $fields->each(function (&$field) use ($addResolveCallback) {
            $addResolveCallback($field);
        });

        return response()->json([
            'panels' => $panels,
            'fields' => $fields->map->jsonSerialize(),
        ], 200);
    }

    public function save(NovaRequest $request)
    {
        $fields = $this->availableFields();

        // NovaDependencyContainer support
        $fields = $fields->map(function ($field) {
            if (! empty($field->attribute)) {
                return $field;
            }
            if (! empty($field->meta['fields'])) {
                return $field->meta['fields'];
            }
        })->filter()->flatten();

        $rules = [];
        foreach ($fields as $field) {
            $fakeResource = new \stdClass;
            $fakeResource->{$field->attribute} = setting($field->attribute);
            $field->resolve($fakeResource, $field->attribute); // For nova-translatable support
            $rules = array_merge($rules, $field->getUpdateRules($request));
        }

        Validator::make($request->all(), $rules)->validate();

        $fields->whereInstanceOf(Resolvable::class)->each(function ($field) use ($request) {
            if (empty($field->attribute)) {
                return;
            }
            if ($field->isReadonly(app(NovaRequest::class))) {
                return;
            }

            // For nova-translatable support
            if (! empty($field->meta['translatable']['original_attribute'])) {
                $field->attribute = $field->meta['translatable']['original_attribute'];
            }

            $tempResource = new \stdClass;
            $field->fill($request, $tempResource);

            if (! property_exists($tempResource, $field->attribute)) {
                return;
            }

            setting([$field->attribute => $tempResource->{$field->attribute}]);
        });

        setting()->save();

        if (config('nova-settings.reload_page_on_save', false) === true) {
            return response()->json(['reload' => true]);
        }

        return response('', 204);
    }

    public function deleteImage(Request $request, $fieldName)
    {
        setting()->forget($fieldName);

        return response('', 204);
    }

    protected function availableFields()
    {
        return new FieldCollection(($this->filter(NovaSettingsTool::getFields())));
    }

    protected function fields(Request $request)
    {
        return NovaSettingsTool::getFields();
    }
}
