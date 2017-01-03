# PubMed API Wrapper

API wrapper helps you to fetch PubMed articles with following features:

 * Get PubMed article(s) with name(s)
 * Get PubMed article(s) with id(s)

Usage and sample code to get PubMed article(s) by Name(s)! :+1:

```javascript

$name  = "chris";
$count = 5;

print_r( PubMed::getPubMedArticleByName( $name, $count ) );

/*
Parameters:
$name ( Mandatory ), can accommodate multiple names combination with comma separated string like ( "Chris, John" )

$count ( NonMandatory and default count will be 10, This represent how many records need to be retrieved)
*/

```

Usage and sample code to get PubMed article(s) by Id(s)! :+1:

```javascript

// Multiple id(s) can be passed to the api wrapper
$id = array('28030999', '28023346');

print_r( PubMed::getPubMedArticleByIds($id) );

```


App Config:

```javascript

 'providers' => [
        TituGeorge\PubMed\PubmedServiceProvider::class,
    ],

 'aliases'  => [
        'PubMed' => TituGeorge\PubMed\Facade\Pubmed::class,
	],

```

Please feel free to contact me titugeorge@gmail.com

Checkout my online [Portfolio](http://titugeorge.com)

### Reference:

 * [NCBI](https://github.com/markdown-it/markdown-it) National Center for Biotechnology Information
