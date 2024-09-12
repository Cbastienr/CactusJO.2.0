<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Sneaker extends Model
{
    protected $table = 'sneakers';

    protected $fillable = [
        'brand', 'colorway', 'estimatedMarketValue', 'gender', 'image', 'links',
        'name', 'release_date', 'release_year', 'retail_price', 'silhouette', 'sku', 'story', 'uid'
    ];

    // Gestion des attributs JSON
    protected $casts = [
        'image' => 'array',
        'links' => 'array'
    ];

    // Récupère un sneaker spécifique depuis l'API
    public static function findFromApi($uid)
    {
        $response = Http::get("http://54.37.12.181:1337/api/sneakers/{$uid}");

        if ($response->successful()) {
            $sneakerData = $response->json();
            return self::createFromApiData($sneakerData['data']);
        }

        return null;
    }

    // Récupère tous les sneakers depuis l'API
    public static function allFromApi()
    {
        $response = Http::get("http://54.37.12.181:1337/api/sneakers");

        if ($response->successful()) {
            $sneakerDataArray = $response->json()['data'];

            return array_map(function ($sneakerData) {
                return self::createFromApiData($sneakerData);
            }, $sneakerDataArray);
        }

        return [];
    }

    // Crée un modèle Sneaker à partir des données de l'API
    public static function createFromApiData($data)
    {
        $attributes = $data['attributes'];

        return new self([
            'brand' => $attributes['brand'] ?? null,
            'colorway' => $attributes['colorway'] ?? null,
            'estimatedMarketValue' => $attributes['estimatedMarketValue'] ?? null,
            'gender' => $attributes['gender'] ?? null,
            'image' => $attributes['image'] ?? [],  // On ne fait plus de json_encode
            'links' => $attributes['links'] ?? [],
            'name' => $attributes['name'] ?? null,
            'release_date' => $attributes['releaseDate'] ?? null,
            'release_year' => $attributes['releaseYear'] ?? null,
            'retail_price' => $attributes['retailPrice'] ?? null,
            'silhouette' => $attributes['silhouette'] ?? null,
            'sku' => $attributes['sku'] ?? null,
            'story' => $attributes['story'] ?? null,
            'uid' => $attributes['UID'] ?? null,
        ]);
    }
}