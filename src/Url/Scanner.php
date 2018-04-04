<?php
  namespace LaravelAcademy\UrlScanner\Url;

  use GuzzleHttp\Client;

  class Scanner
  {
  	protected $urls;

  	protected $httpClient;

  	public function __construct(array $urls)
  	{
  		$this->urls = $urls;
  		$this->httpClient = new Client();
  	}

  	public function getStatusCodeForUrl($url)
  	{
  		$httpResponse = $this->httpClient->get($url);
  		return $httpResponse->getStatusCode();
  	}

  	public function getInvalidUrls()
  	{
  		$invalidUrls = [];
  		foreach($this->urls as $url)
  		{
  			try{
  				$statusCode = $this->getStatusCodeForUrl($url);
  			}
  			catch(\Exception $e)
  			{
  				$statusCode = 500;
  			}
  			if($status >= 400)
  			{
  				array_push($incalidUrls, [
                'url' => $url, 
                'status' => $statusCode
                  					]);
  			}
  		}
  		return $invalidUrls;
  	}
  }
?>