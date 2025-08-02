<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'label_id',
        'category_id',
        'no_traduible',
    ];

    protected $casts = [
        'no_traduible' => 'boolean',
    ];

    /**
     * Relació: un producte pertany a una categoria
     */
    public function category()
    {
        return $this->belongsTo(ProductsCategory::class, 'category_id');
    }

    /**
     * Relació: un producte pot tenir una etiqueta
     */
    public function label()
    {
        return $this->belongsTo(Label::class, 'label_id');
    }

    /**
     * Relació: un producte té moltes traduccions
     */
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    /**
     * Obtenir la traducció per a un idioma específic
     */
    public function getTranslation($locale = 'ca')
    {
        return $this->translations()->where('locale', $locale)->first();
    }

    /**
     * Obtenir tots els productes amb les seves relacions
     */
    public static function getAllWithRelations()
    {
        return self::with(['category', 'label', 'translations'])->get();
    }

    /**
     * Crear traduccions automàtiques per productes no traduïbles
     */
    public function createSameNameTranslations($locales = ['ca', 'es', 'en', 'fr', 'de'])
    {
        if (!$this->no_traduible) {
            return false;
        }

        foreach ($locales as $locale) {
            ProductTranslation::updateOrCreate(
                [
                    'product_id' => $this->id,
                    'locale' => $locale
                ],
                [
                    'name' => $this->name,
                    'description' => $this->description
                ]
            );
        }

        return true;
    }
}
