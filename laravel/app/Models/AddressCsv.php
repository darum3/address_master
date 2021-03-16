<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use SplFileInfo;
use SplFileObject;

/**
 * @property Prefecture $prefecture
 * @property City $city
 * @property Town $town
 */
class AddressCsv
{
    // "都道府県コード","都道府県名","都道府県名カナ","都道府県名ローマ字","市区町村コード","市区町村名","市区町村名カナ","市区町村名ローマ字","大字町丁目コード","大字町丁目名","緯度","経度"
    private const COLUMN_PREFECTURE_CODE = 0;
    private const COLUMN_PREFECTURE_NAME = 1;
    private const COLUMN_PREFECTURE_KANA = 2;
    private const COLUMN_PREFECTURE_ROMA = 3;
    private const COLUMN_CITY_CODE = 4;
    private const COLUMN_CITY_NAME = 5;
    private const COLUMN_CITY_KANA = 6;
    private const COLUMN_CITY_ROMA = 7;
    private const COLUMN_TOWN_CODE = 8;
    private const COLUMN_TOWN_NAME = 9;

    public function __construct(array $line) {
        $this->prefecture = Prefecture::create([
            'code' => $line[self::COLUMN_PREFECTURE_CODE],
            'prefecture_name' => $line[self::COLUMN_PREFECTURE_NAME],
            'prefecture_kana' => $line[self::COLUMN_PREFECTURE_KANA],
            'prefecture_roma' => $line[self::COLUMN_PREFECTURE_ROMA],
        ]);
        $this->city = City::create([
            'city_code' => $line[self::COLUMN_CITY_CODE],
            'city_name' => $line[self::COLUMN_CITY_NAME],
            'city_kana' => $line[self::COLUMN_CITY_KANA],
            'city_roma' => $line[self::COLUMN_CITY_ROMA],
        ]);
        $this->town = Town::create([
            'town_code' => $line[self::COLUMN_TOWN_CODE],
            'town_name' => $line[self::COLUMN_TOWN_NAME],
        ]);
    }

    /**
     * @return LazyCollection|self[] 住所データ
     */
    public static function loadCsvFile(string $fileName): LazyCollection
    {
        return LazyCollection::make(function () use ($fileName): iterable {
            $file = new SplFileObject($fileName);
            $file->setFlags(SplFileObject::READ_CSV);

            foreach ($file as $count => $line) {
                if ($count > 0) {
                    yield new static($line);
                }
            }
        });
    }
}
