<?php
/**
 * @package   narovinu-online.
 * @author    Vlado Mečiar vmeciar@buttonsystems.eu
 * @since     Date: 11/07/2023
 * @copyright Copyright (c) 2023 Button Systems, s.r.o. www.ButtonSystems.eu All rights reserved.
 * @version
 */

namespace l20\Enum;

/**
 *
 */
class Url
{
	/**
	 * @var string
	 */
	private string $url;
	/**
	 * @var bool|mixed
	 */
	private bool $pathOnly;

	/**
	 * @param string $url
	 * @param bool $pathOnly
     * @throws \InvalidArgumentException
	 */
	public function __construct(string $url, bool $pathOnly = false)
	{
		$this->pathOnly = $pathOnly;

		if (!$pathOnly && !filter_var($url, FILTER_VALIDATE_URL)) {
			throw new \InvalidArgumentException('Invalid url');
		}

		$this->url = $url;
	}

	/**
	 * @return string|null
	 */
	public function getScheme(): ?string
	{
		if ($this->pathOnly)
			return null;

		return parse_url($this->url, PHP_URL_SCHEME);
	}

	/**
	 * @return string|null
	 */
	public function getHost(): ?string
	{
		if ($this->pathOnly)
			return null;

		return parse_url($this->url, PHP_URL_HOST);
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return parse_url($this->url, PHP_URL_PATH);
	}

	/**
	 * @return string
	 */
	public function getQuery(): string
	{
		return parse_url($this->url, PHP_URL_QUERY);
	}

	/**
	 * @return string
	 */
	public function getFragment(): string
	{
		return parse_url($this->url, PHP_URL_FRAGMENT);
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->url;
	}

	/**
	 * @return string|null
	 */
	public function getDomain(): ?string
	{
		if ($this->pathOnly)
			return null;

		return $this->getScheme() . '://' . $this->getHost();
	}
}