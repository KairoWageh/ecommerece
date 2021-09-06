<?php

namespace App\Repository\contracts;

/**
 * Interface CountryRepositoryInterface
 * @package App\Repository\contracts
 */
interface CountryRepositoryInterface{

public function get_country_cities($model, $id);
}
