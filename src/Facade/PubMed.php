<?php namespace TituGeorge\PubMed\Facade;

use Illuminate\Support\Facades\Facade;

class PubMed extends Facade {

    protected static function getFacadeAccessor() { return 'pubmed'; }

}