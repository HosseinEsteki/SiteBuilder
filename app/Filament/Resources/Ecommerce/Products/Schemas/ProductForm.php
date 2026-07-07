<?php

namespace App\Filament\Resources\Ecommerce\Products\Schemas;

use App\Filament\Components\Inputs\BrandInput;
use App\Filament\Components\Inputs\CategoryInput;
use App\Filament\Components\Inputs\ContentInput;
use App\Filament\Components\Inputs\DescriptionInput;
use App\Filament\Components\Inputs\ImageInput;
use App\Filament\Components\Inputs\KeywordsInput;
use App\Filament\Components\Inputs\NameInput;
use App\Filament\Components\Inputs\PriceInputs;
use App\Filament\Components\Inputs\ProductTypeInput;
use App\Filament\Components\Inputs\SlugInput;
use App\Filament\Components\Inputs\StockInput;
use Ecommerce\Models\Feature;
use Ecommerce\Models\FeatureOption;
use Ecommerce\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make()->schema([
                /*
                |--------------------------------------------------------------------------
                | تب اطلاعات اصلی
                |--------------------------------------------------------------------------
                */
                Tab::make(trans('public.tabs.mainInformation'))->schema([
                    //TODO: بخش ذخیره تصویر شاخص مشکل داره. وقتی تصویر شاخص رو حذف میکنی و یک تصویر جدید جایگزین میکنی، تصاویر گالری محصول میپرن.
                    ImageInput::make('ecommerce.product.thumbnail'),
                    ImageInput::makeGallery('ecommerce.product.gallery'),
                    NameInput::make()->columnSpan(2),
                    SlugInput::make()->columnSpan(2),
                    KeywordsInput::make(new Product())->columnSpan(2),
                    // قیمت فقط برای محصول ساده
                    ...PriceInputs::make(),
                    StockInput::make(),
                    ProductTypeInput::make(),
                    CategoryInput::make(),
                    BrandInput::make(),
                    DescriptionInput::make(),
                ])->columns(4),

                /*
                |--------------------------------------------------------------------------
                | تب محتوا
                |--------------------------------------------------------------------------
                */
                Tab::make(trans('public.tabs.content'))->schema([
                    ContentInput::make(),
                ]),

                /*
                |--------------------------------------------------------------------------
                | تب ویژگی‌ها و واریانت‌ها
                |--------------------------------------------------------------------------
                */
                Tab::make(trans('public.tabs.features'))
                    ->schema([

                        /*
                        |-------------------------
                        | انتخاب ویژگی‌ها
                        |-------------------------
                        */
                        Select::make('features')
                            ->label(trans('ecommerce::ecommerce.features.index'))
                            ->multiple()
                            ->relationship('features', 'name')
                            ->options(Feature::all()->pluck('name', 'id'))
                            ->preload()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                // state = آرایه id های feature های انتخاب‌شده

                                $selectedFeatures = $state ?? [];

                                // فیلتر کردن featureOptions فعلی
                                $currentOptions = $get('featureOptions') ?? [];

                                if (!empty($currentOptions)) {
                                    $validOptionIds = FeatureOption::whereIn('feature_id', $selectedFeatures)
                                        ->pluck('id')
                                        ->toArray();

                                    $newOptions = array_values(
                                        array_intersect($currentOptions, $validOptionIds)
                                    );

                                    $set('featureOptions', $newOptions);
                                }

                                // پاک‌سازی options واریانت‌ها
                                $variants = $get('variants') ?? [];

                                foreach ($variants as $index => $variant) {
                                    $variantOptions = $variant['options'] ?? [];

                                    if (!empty($variantOptions)) {
                                        $validVariantOptionIds = FeatureOption::whereIn('feature_id', $selectedFeatures)
                                            ->pluck('id')
                                            ->toArray();

                                        $newVariantOptions = array_values(
                                            array_intersect($variantOptions, $validVariantOptionIds)
                                        );

                                        $set("variants.$index.options", $newVariantOptions);
                                    }
                                }
                            })
                            ->createOptionForm([
                                TextInput::make('name')->label(trans('ecommerce::ecommerce.features.featureName'))->required(),
                                SlugInput::make(),
                            ])
                            ->createOptionAction(fn($action) => $action->modalHeading(trans('ecommerce::ecommerce.features.create'))
                            ),

                        /*
                        |-------------------------
                        | انتخاب مقدارهای ویژگی
                        |-------------------------
                        */
                        Select::make('featureOptions')
                            ->label(trans('ecommerce::ecommerce.features.values.index'))
                            ->multiple()
                            ->relationship('featureOptions', 'value')
                            ->options(function (callable $get) {
                                $selectedFeatures = $get('features');

                                if (!$selectedFeatures) return [];

                                return FeatureOption::whereIn('feature_id', $selectedFeatures)
                                    ->get()
                                    ->mapWithKeys(fn($opt) => [
                                        $opt->id => "{$opt->feature->name} - {$opt->value}"
                                    ]);
                            })
                            ->disabled(fn($get) => empty($get('features')))
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {

                                // مقدارهای معتبر
                                $validOptionIds = $state ?? [];

                                // واریانت‌ها
                                $variants = $get('variants') ?? [];

                                foreach ($variants as $index => $variant) {
                                    $variantOptions = $variant['options'] ?? [];

                                    // حذف گزینه‌های نامعتبر
                                    $newVariantOptions = array_values(
                                        array_intersect($variantOptions, $validOptionIds)
                                    );

                                    $set("variants.$index.options", $newVariantOptions);
                                }
                            })
                            ->preload()
                            ->createOptionForm(function (callable $get) {
                                return [
                                    Select::make('feature_id')
                                        ->label(trans('ecommerce::ecommerce.features.show'))
                                        ->options(
                                            Feature::whereIn('id', $get('features') ?? [])
                                                ->pluck('name', 'id')
                                        )
                                        ->required(),

                                    TextInput::make('value')->label(trans('public.value'))->required(),
                                    SlugInput::make(),
                                ];
                            })
                            ->createOptionAction(fn($action) => $action->modalHeading(trans('ecommerce::ecommerce.features.values.create'))
                            ),

                        /*
                        |-------------------------
                        | مدیریت واریانت‌ها
                        |-------------------------
                        */
                        Repeater::make('variants')
                            ->label(trans('ecommerce::ecommerce.variants.index'))
                            ->visible(fn($get) => $get('is_variable'))
                            ->relationship('variants')
                            ->schema([

                                ImageInput::makeVariant('ecommerce.product.variants.thumbnail'),

                                TextInput::make('sku')->label(trans('ecommerce::ecommerce.sku')),

                                ...PriceInputs::make(),

                                StockInput::make(),

                                Select::make('options')
                                    ->label(trans('ecommerce::ecommerce.variants.values'))
                                    ->multiple()
                                    ->relationship('options', 'value')
                                    ->options(function (callable $get) {
                                        $selectedOptionIds = $get('../../featureOptions') ?? [];

                                        if (empty($selectedOptionIds)) return [];

                                        return FeatureOption::with('feature')
                                            ->whereIn('id', $selectedOptionIds)
                                            ->get()
                                            ->mapWithKeys(fn($opt) => [
                                                $opt->id => "{$opt->feature->name} - {$opt->value}"
                                            ]);
                                    })
                                    ->disabled(fn($get) => empty($get('../../featureOptions')))
                                    ->reactive()
                                    ->preload()
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->addActionLabel(trans('ecommerce::ecommerce.variants.create')),
                    ]),
            ])->columnSpanFull()
        ]);
    }
}
