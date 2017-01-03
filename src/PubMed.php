<?php namespace TituGeorge\PubMed;

class PubMed {

    /**
     * @var string
     * Base url to query
     */
    protected $base_url;

    /**
     * @var string
     * Id param
     */
    protected $article_ids_param;

    /**
     * @var string
     * Article param
     */
    protected $article_param;

    /**
     * @var
     * Total record count
     */
    protected $record_count;

    /**
     * @var
     * Response format - json/xml : currently support json
     */
    protected $response_format;

    public function __construct()
    {

        $this->base_url          = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/";

        $this->article_ids_param = "esearch.fcgi?db=pubmed&";

        $this->article_param     = "esummary.fcgi?db=pubmed&id=";

        $this->response_format   = "&retmode=json&usehistory=y";

    }


    /**
     * @param array $ids
     * @return array|string
     * Get PubMed Article with id(s)
     */
    public function getPubMedArticleByIds($ids = []) {

        if(!$ids || empty($ids)) {
            return "PubMed ID not found";
        }

        $articles = [];

        if(!empty($ids)) {
            foreach($ids as $id) {
                $article_query_url = $this->base_url . $this->article_param . $id .$this->response_format;
                $articles_data = $this->initiateCurl($article_query_url);
                $articles_data = json_decode($articles_data);
                $articles_data = json_decode(json_encode($articles_data), true);
                $articles[]    = $articles_data;
            }
        }

        if(empty($articles)) {
            return "No data found";
        }


        return $articles;
    }

    /**
     * @param string $term
     * @param int $count
     * @return array|string
     * Get PubMed Article with name(s)
     */
    public function getPubMedArticleByName($term = '' , $count = 10) {

        if(!$term || empty($term)) {
            return "search term not found";
        }

        $this->record_count = $count;

        $query_url = $this->base_url . $this->article_ids_param . "term=" . $term . "&retmax=" . $count . $this->response_format;

        $response = $this->initiateCurl($query_url);

        if(empty($response)) {
            return "No data found";
        }


        $response = json_decode($response);
        $response = json_decode(json_encode($response), true);


        if(!array_key_exists('esearchresult', $response) && !array_key_exists('idlist', $response['esearchresult']) && empty($response['esearchresult']['idlist'])) {
            return "No data found";
        }

        $ids = $response['esearchresult']['idlist'];

        $articles = [];

        if(!empty($ids)) {
            foreach($ids as $id) {
                if($id && !empty($id)) {
                    $article_query_url = $this->base_url . $this->article_param . $id .$this->response_format;
                    $articles_data = $this->initiateCurl($article_query_url);
                    $articles_data = json_decode($articles_data);
                    $articles_data = json_decode(json_encode($articles_data), true);
                    $articles[]    = $articles_data;
                }
            }
        }

        if(empty($articles)) {
            return "No data found";
        }


        return $articles;
    }


    /**
     * @param $url
     * @return mixed
     * Initiate curl to get data
     */
    public function initiateCurl($url)
    {

        $ch = curl_init();

        $curlConfig = array(
            CURLOPT_URL            => $url,
            CURLOPT_HEADER         => false,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0') ;

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;

    }

}