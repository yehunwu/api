<?php
namespace Yehunwu\api;

class Api
{
	protected $codeKey 			= 'code';

	protected $dataKey 			= 'data';
	protected $useDataKey 		= true;

	protected $listKey 			= 'list';
	protected $objectKey 		= 'object';

	protected $messageKey 		= 'msg';
	protected $messageHandle 	= [Code::class, 'message'];

	protected $hasDataKey 		= 'has_data';

	protected $responseIsReturn = false;

	private $data 	= [];
	private $list 	= [];
	private $object = [];
	private $mergeData = [];

	function __construct(){}

	function response(int $code, string $message = '')
	{

		$message = $message ? : call_user_func_array($this->messageHandle, [$code]);

		$response = [
			$this->codeKey 		=> $code,
			$this->listKey 		=> $this->list,
			$this->objectKey 	=> $this->object ? : new \stdClass,
			$this->messageKey 	=> $message,
			$this->hasDataKey	=> (int) ($this->list || $this->object || $this->data),
		];

		if ($this->useDataKey) {
			$response[$this->dataKey] = $this->data;
		}

		$response = array_merge($response, $this->mergeData);

		if (false == $this->responseIsReturn) throw new ResponseException($code, $response);
		if (true === $this->responseIsReturn) return $response;
	}

	function data(array $data)
	{
		$this->data = $data;
		return $this;
	}

	function list(array $list)
	{
		$this->data = $this->list = $list;
		return $this;
	}

	function object(array $object)
	{
		$this->data = $this->object	= $object ? : new \stdClass;
		return $this;
	}

	function mergeData(array $mergeData)
	{
		$this->mergeData = $mergeData;
		return $this;
	}

	function setAttrs(array $sets = array())
	{
		foreach ($sets as $key => $value) {
			switch ($key) {
				case 'codeKey':
				case 'dataKey':
				case 'useDataKey':
                case 'listKey':
                case 'objectKey':
                case 'messageKey':
                case 'messageHandle':
                case 'hasDataKey':
                case 'responseIsReturn':
					$this->$key = $value;
					break;
				default:
					// code...
					break;
			}
		}

		return $this;
	}

}
