<?php

namespace App\Common;

class CommonLogic
{
    public function getModels(): array
    {
        return [
            "App\Models\Crew" => [
                'key' => __("App\\Models\\Crew"),
                'label' => 'fullname',
                'id'=>1
            ],
            "App\Models\Hospitality" => [
                'key' => __("App\\Models\\Hospitality"),
                'label' => 'title',
                'id'=>2
            ],
            "App\Models\Client" => [
                'key' => __("App\\Models\\Client"),
                'label' => 'fullname',
                'id'=>3
            ],
            "App\Models\Dormitory" => [
                'key' => __("App\\Models\\Dormitory"),
                'label' => 'title',
                'id'=>4
            ],
            "App\Models\MealType" => [
                'key' => __("App\\Models\\MealType"),
                'label' => 'title',
                'id'=>5
            ],
            "App\Models\Group" => [
                'key' => __("App\\Models\\Group"),
                'label' => 'title',
                'id'=>6
            ],
            "App\Models\Vehicle" => [
                'key' => __("App\\Models\\Vehicle"),
                'label' => 'model',
                'id'=>7
            ],
        ];
    }


    public function getModelTypes($model_type): array
    {
        $model = "App\Models\\" . $model_type;
        $label = [
            "App\Models\Crew" => [
                'key' => __("App\\Models\\Crew"),
                'label' => 'fullname'
            ],
            "App\Models\Hospitality" => [
                'key' => __("App\\Models\\Hospitality"),
                'label' => 'title'
            ],
            "App\Models\Client" => [
                'key' => __("App\\Models\\Client"),
                'label' => 'fullname'
            ],
            "App\Models\Dormitory" => [
                'key' => __("App\\Models\\Dormitory"),
                'label' => 'title'
            ],
            "App\Models\MealType" => [
                'key' => __("App\\Models\\MealType"),
                'label' => 'title'
            ],
            "App\Models\Group" => [
                'key' => __("App\\Models\\Group"),
                'label' => 'title'
            ],
            "App\Models\Vehicle" => [
                'key' => __("App\\Models\\Vehicle"),
                'label' => 'model'
            ],
        ][$model]['label'];
        // TODO: select the label dynamically...
        return (new $model)->select('id', "$label AS label")->get();
    }
}
